<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassSubject;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClassSubjectController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $assignments = ClassSubject::with(['class', 'subject', 'teacher'])
            ->when($request->class_id, fn($q, $id) => $q->where('class_id', $id))
            ->when($request->teacher_id, fn($q, $id) => $q->where('user_id', $id))
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $assignments,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'user_id' => 'required|exists:users,id',
            'semester' => 'sometimes|in:ganjil,genap',
        ]);

        $teacher = User::findOrFail($validated['user_id']);
        if (!$teacher->isGuru()) {
            return response()->json([
                'success' => false,
                'message' => 'User harus memiliki role guru',
            ], 422);
        }

        $exists = ClassSubject::where('class_id', $validated['class_id'])
            ->where('subject_id', $validated['subject_id'])
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Mata pelajaran sudah ditugaskan di kelas ini',
            ], 409);
        }

        $assignment = ClassSubject::create($validated);
        $assignment->load(['class', 'subject', 'teacher']);

        return response()->json([
            'success' => true,
            'message' => 'Guru berhasil ditugaskan ke kelas dan mata pelajaran',
            'data' => $assignment,
        ], 201);
    }

    public function show(ClassSubject $classSubject): JsonResponse
    {
        $classSubject->load(['class', 'subject', 'teacher']);

        return response()->json([
            'success' => true,
            'data' => $classSubject,
        ]);
    }

    public function update(Request $request, ClassSubject $classSubject): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
        ]);

        if (isset($validated['user_id'])) {
            $teacher = User::findOrFail($validated['user_id']);
            if (!$teacher->isGuru()) {
                return response()->json([
                    'success' => false,
                    'message' => 'User harus memiliki role guru',
                ], 422);
            }
        }

        $classSubject->update($validated);
        $classSubject->load(['class', 'subject', 'teacher']);

        return response()->json([
            'success' => true,
            'message' => 'Penugasan guru berhasil diupdate',
            'data' => $classSubject,
        ]);
    }

    public function destroy(ClassSubject $classSubject): JsonResponse
    {
        $classSubject->delete();

        return response()->json([
            'success' => true,
            'message' => 'Penugasan guru berhasil dihapus',
        ], 204);
    }

    public function classSubjects(ClassModel $class): JsonResponse
    {
        $subjects = $class->classSubjects()->with(['subject', 'teacher'])->get();

        return response()->json([
            'success' => true,
            'data' => $subjects,
        ]);
    }

    public function bySemester(ClassModel $class, string $semester): JsonResponse
    {
        $subjects = $class->classSubjects()
            ->where('semester', $semester)
            ->with(['subject', 'teacher'])
            ->get();

        return response()->json([
            'success' => true,
            'data' => $subjects,
        ]);
    }

    public function mySubjects(Request $request): JsonResponse
    {
        $user = $request->user();

        $subjects = ClassSubject::where('user_id', $user->id)
            ->with(['class', 'subject'])
            ->get()
            ->groupBy(fn($item) => $item->class->name)
            ->map(fn($items, $className) => [
                'class_name' => $className,
                'class_id' => $items->first()->class_id,
                'subjects' => $items->map(fn($item) => [
                    'id' => $item->subject->id,
                    'name' => $item->subject->name,
                    'code' => $item->subject->code,
                    'semester' => $item->semester,
                ]),
            ])
            ->values();

        return response()->json([
            'success' => true,
            'data' => $subjects,
        ]);
    }
}
