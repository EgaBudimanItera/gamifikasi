<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LeaderboardCache;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\Gamification\LeaderboardService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LeaderboardController extends Controller
{
    protected LeaderboardService $leaderboardService;

    public function __construct(LeaderboardService $leaderboardService)
    {
        $this->leaderboardService = $leaderboardService;
    }

    public function classLeaderboard(Request $request, int $classId): JsonResponse
    {
        $leaderboard = $this->leaderboardService->getClassLeaderboard($classId);

        return response()->json([
            'success' => true,
            'data' => $leaderboard,
        ]);
    }

    public function schoolLeaderboard(Request $request): JsonResponse
    {
        $leaderboard = $this->leaderboardService->getSchoolLeaderboard(
            $request->user()->school_id
        );

        return response()->json([
            'success' => true,
            'data' => $leaderboard,
        ]);
    }
}
