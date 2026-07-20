<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MaterialController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $materials = Material::with(['subject', 'creator', 'class'])
            ->when($request->subject_id, fn($q, $id) => $q->where('subject_id', $id))
            ->when($request->user()->isSiswa(), fn($q) => $q->where('is_published', true))
            ->orderBy('class_id')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $materials,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'file_path' => 'nullable|string',
        ]);

        $validated['user_id'] = $request->user()->id;

        $material = Material::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Materi berhasil dibuat',
            'data' => $material,
        ], 201);
    }

    public function show(Material $material): JsonResponse
    {
        $material->load(['subject', 'creator', 'class']);

        return response()->json([
            'success' => true,
            'data' => $material,
        ]);
    }

    public function update(Request $request, Material $material): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'file_path' => 'nullable|string',
        ]);

        $material->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Materi berhasil diupdate',
            'data' => $material,
        ]);
    }

    public function destroy(Material $material): JsonResponse
    {
        $material->delete();

        return response()->json([
            'success' => true,
            'message' => 'Materi berhasil dihapus',
        ], 204);
    }

    public function publish(Material $material): JsonResponse
    {
        $material->update([
            'is_published' => true,
            'published_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Materi berhasil dipublikasikan',
            'data' => $material,
        ]);
    }
}
