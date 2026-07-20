<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SchoolController extends Controller
{
    public function index(): JsonResponse
    {
        $schools = School::paginate(15);

        return response()->json([
            'success' => true,
            'data' => $schools,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
        ]);

        $school = School::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Sekolah berhasil dibuat',
            'data' => $school,
        ], 201);
    }

    public function show(School $school): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $school,
        ]);
    }

    public function update(Request $request, School $school): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
        ]);

        $school->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Sekolah berhasil diupdate',
            'data' => $school,
        ]);
    }

    public function destroy(School $school): JsonResponse
    {
        $school->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sekolah berhasil dihapus',
        ], 204);
    }
}
