<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\JsonResponse;

class BadgeQuestController extends Controller
{
    public function index(): JsonResponse
    {
        $badges = Badge::all();

        return response()->json([
            'success' => true,
            'data' => $badges,
        ]);
    }

    public function show(Badge $badge): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $badge,
        ]);
    }
}
