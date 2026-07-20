<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AssignmentResource;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AssignmentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Assignment::with(['subject', 'creator', 'class'])
            ->withCount('submissions')
            ->when($request->subject_id, fn($q, $id) => $q->where('subject_id', $id))
            ->when($request->user()->isSiswa(), fn($q) => $q->where('is_published', true));

        if ($request->user()->isSiswa()) {
            $query->with(['submissions' => function ($q) use ($request) {
                $q->where('submissions.user_id', $request->user()->id);
                $q->with('grade');
            }]);
        }

        $assignments = $query->paginate(15);

        return response()->json([
            'success' => true,
            'data' => AssignmentResource::collection($assignments),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'max_score' => 'nullable|numeric|min:0',
            'xp_reward' => 'required|integer|min:0',
            'deadline' => 'required|date|after:now',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['is_published'] = true;

        $assignment = Assignment::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tugas berhasil dibuat',
            'data' => new AssignmentResource($assignment->load(['subject', 'creator'])),
        ], 201);
    }

    public function show(Assignment $assignment): JsonResponse
    {
        $assignment->load(['subject', 'creator', 'submissions']);

        return response()->json([
            'success' => true,
            'data' => new AssignmentResource($assignment),
        ]);
    }

    public function update(Request $request, Assignment $assignment): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'max_score' => 'nullable|numeric|min:0',
            'xp_reward' => 'sometimes|integer|min:0',
            'deadline' => 'sometimes|date',
        ]);

        $assignment->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tugas berhasil diupdate',
            'data' => new AssignmentResource($assignment->load(['subject', 'creator'])),
        ]);
    }

    public function destroy(Assignment $assignment): JsonResponse
    {
        $assignment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tugas berhasil dihapus',
        ], 204);
    }
}
