<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubmissionResource;
use App\Models\Assignment;
use App\Models\Grade;
use App\Models\Submission;
use App\Services\Gamification\XpService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SubmissionController extends Controller
{
    protected XpService $xpService;

    public function __construct(XpService $xpService)
    {
        $this->xpService = $xpService;
    }

    public function index(Request $request, Assignment $assignment): JsonResponse
    {
        $submissions = Submission::with(['student', 'grade'])
            ->where('assignment_id', $assignment->id)
            ->when($request->user()->isSiswa(), function ($q) use ($request) {
                $q->where('user_id', $request->user()->id);
            })
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => SubmissionResource::collection($submissions),
        ]);
    }

    public function store(Request $request, Assignment $assignment): JsonResponse
    {
        $validated = $request->validate([
            'file_path' => 'nullable|string',
            'answer_text' => 'nullable|string',
        ]);

        // Check if already submitted
        $existing = Submission::where('assignment_id', $assignment->id)
            ->where('user_id', $request->user()->id)
            ->first();

        if ($existing && $existing->status !== 'revised') {
            return response()->json(['message' => 'Sudah mengumpulkan tugas ini'], 422);
        }

        $submission = Submission::create([
            'assignment_id' => $assignment->id,
            'user_id' => $request->user()->id,
            'file_path' => $validated['file_path'] ?? null,
            'answer_text' => $validated['answer_text'] ?? null,
            'submitted_at' => now(),
            'status' => 'pending',
        ]);

        // Award early submission XP
        if ($assignment->deadline->isFuture()) {
            $this->xpService->award(
                $request->user(),
                20,
                'assignment',
                'Submit awal tugas: ' . $assignment->title
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Jawaban berhasil dikumpulkan',
            'data' => new SubmissionResource($submission->load('student')),
        ], 201);
    }

    public function show(Submission $submission): JsonResponse
    {
        $submission->load(['student', 'grade.grader', 'assignment']);

        return response()->json([
            'success' => true,
            'data' => new SubmissionResource($submission),
        ]);
    }

    public function grade(Request $request, Submission $submission): JsonResponse
    {
        $validated = $request->validate([
            'score' => 'required|numeric|min:0|max:' . $submission->assignment->max_score,
            'feedback' => 'nullable|string',
        ]);

        $grade = Grade::create([
            'submission_id' => $submission->id,
            'user_id' => $request->user()->id,
            'score' => $validated['score'],
            'feedback' => $validated['feedback'] ?? null,
            'graded_at' => now(),
        ]);

        $submission->update(['status' => 'graded']);

        // Award assignment XP
        $this->xpService->award(
            $submission->student,
            $submission->assignment->xp_reward,
            'assignment',
            'Penyelesaian tugas: ' . $submission->assignment->title
        );

        return response()->json([
            'success' => true,
            'message' => 'Penilaian berhasil disimpan',
            'data' => new SubmissionResource($submission->load(['student', 'grade'])),
        ]);
    }

    public function revise(Request $request, Submission $submission): JsonResponse
    {
        $validated = $request->validate([
            'file_path' => 'nullable|string',
            'answer_text' => 'nullable|string',
        ]);

        $submission->update([
            'file_path' => $validated['file_path'] ?? $submission->file_path,
            'answer_text' => $validated['answer_text'] ?? $submission->answer_text,
            'submitted_at' => now(),
            'status' => 'revised',
        ]);

        // Delete old grade
        $submission->grade()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Revisi berhasil dikumpulkan',
            'data' => new SubmissionResource($submission->load('student')),
        ]);
    }
}
