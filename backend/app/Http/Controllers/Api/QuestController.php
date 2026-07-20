<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class QuestController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $quests = Quest::where('is_active', true)->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $quests,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:daily,weekly,special',
            'xp_reward' => 'required|integer|min:0',
            'badge_id' => 'nullable|exists:badges,id',
            'criteria' => 'required|array',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $quest = Quest::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Quest berhasil dibuat',
            'data' => $quest,
        ], 201);
    }

    public function show(Quest $quest): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $quest,
        ]);
    }

    public function accept(Request $request, Quest $quest): JsonResponse
    {
        $existing = \App\Models\UserQuest::where('user_id', $request->user()->id)
            ->where('quest_id', $quest->id)
            ->first();

        if ($existing) {
            return response()->json(['message' => 'Quest sudah diterima'], 422);
        }

        $userQuest = \App\Models\UserQuest::create([
            'user_id' => $request->user()->id,
            'quest_id' => $quest->id,
            'status' => 'active',
            'progress' => 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Quest berhasil diterima',
            'data' => $userQuest,
        ], 201);
    }
}
