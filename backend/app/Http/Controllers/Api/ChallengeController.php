<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\DailyChallenge;
use App\Models\WeeklyChallenge;
use App\Models\UserQuest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ChallengeController extends Controller
{
    public function daily(Request $request): JsonResponse
    {
        $challenge = DailyChallenge::where('date', today())
            ->where('is_active', true)
            ->first();

        return response()->json([
            'success' => true,
            'data' => $challenge,
        ]);
    }

    public function weekly(Request $request): JsonResponse
    {
        $challenge = WeeklyChallenge::where('week_start', '<=', now())
            ->where('week_end', '>=', now())
            ->where('is_active', true)
            ->first();

        return response()->json([
            'success' => true,
            'data' => $challenge,
        ]);
    }
}
