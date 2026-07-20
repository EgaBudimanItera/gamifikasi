<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClassController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $classes = ClassModel::with(['academicYear', 'students'])
            ->when($request->school_id, fn($q, $id) => $q->where('school_id', $id))
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $classes,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'school_id' => 'required|exists:schools,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'name' => 'required|string|max:50',
            'grade_level' => 'required|integer|min:7|max:12',
        ]);

        $class = ClassModel::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kelas berhasil dibuat',
            'data' => $class,
        ], 201);
    }

    public function show(ClassModel $class): JsonResponse
    {
        $class->load(['academicYear', 'students', 'classSubjects.subject', 'classSubjects.teacher']);

        return response()->json([
            'success' => true,
            'data' => $class,
        ]);
    }

    public function update(Request $request, ClassModel $class): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:50',
            'grade_level' => 'sometimes|integer|min:7|max:12',
        ]);

        $class->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kelas berhasil diupdate',
            'data' => $class,
        ]);
    }

    public function destroy(ClassModel $class): JsonResponse
    {
        $class->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kelas berhasil dihapus',
        ], 204);
    }

    public function students(ClassModel $class): JsonResponse
    {
        $students = $class->students()->with('profile')->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $students,
        ]);
    }
}
