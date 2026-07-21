<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Services\Gamification\MaterialReadingService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MaterialReadingController extends Controller
{
    private MaterialReadingService $readingService;

    public function __construct(MaterialReadingService $readingService)
    {
        $this->readingService = $readingService;
    }

    public function start(Material $material): JsonResponse
    {
        $user = request()->user();
        $log = $this->readingService->startReading($user, $material);

        return response()->json([
            'success' => true,
            'data' => $log,
        ]);
    }

    public function heartbeat(Request $request, Material $material): JsonResponse
    {
        $validated = $request->validate([
            'scroll_depth' => 'required|integer|min:0|max:100',
            'time_spent' => 'required|integer|min:0',
        ]);

        $user = $request->user();
        $log = $this->readingService->updateProgress(
            $user,
            $material,
            $validated['scroll_depth'],
            $validated['time_spent']
        );

        return response()->json([
            'success' => true,
            'data' => $log,
        ]);
    }

    public function complete(Request $request, Material $material): JsonResponse
    {
        $validated = $request->validate([
            'scroll_depth' => 'required|integer|min:0|max:100',
            'duration_seconds' => 'required|integer|min:0',
        ]);

        $user = $request->user();
        $result = $this->readingService->completeReading(
            $user,
            $material,
            $validated['scroll_depth'],
            $validated['duration_seconds']
        );

        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    public function quiz(Material $material): JsonResponse
    {
        $questions = $this->readingService->getQuiz($material);

        return response()->json([
            'success' => true,
            'data' => $questions,
        ]);
    }

    public function submitQuiz(Request $request, Material $material): JsonResponse
    {
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'string',
        ]);

        $user = $request->user();
        $result = $this->readingService->submitQuiz($user, $material, $validated['answers']);

        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    public function stats(): JsonResponse
    {
        $user = request()->user();
        $stats = $this->readingService->getReadingStats($user);

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }
}
