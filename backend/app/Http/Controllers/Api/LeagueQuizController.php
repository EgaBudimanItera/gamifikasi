<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LeagueQuizSession;
use App\Services\Gamification\LeagueQuizService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LeagueQuizController extends Controller
{
    protected LeagueQuizService $quizService;

    public function __construct(LeagueQuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    public function index(Request $request): JsonResponse
    {
        $sessions = $this->quizService->getAvailableSessions($request->user());

        return response()->json([
            'success' => true,
            'data' => $sessions,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'mode' => 'required|in:class,guild',
            'class_id' => 'nullable|integer|exists:classes,id',
            'guild_id' => 'nullable|integer|exists:guilds,id',
            'duration_minutes' => 'nullable|integer|min:1|max:60',
            'questions_count' => 'nullable|integer|min:3|max:20',
            'difficulty' => 'nullable|in:easy,hard',
            'pass_threshold' => 'nullable|integer|min:1|max:100',
            'xp_reward' => 'nullable|integer|min:0',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after:starts_at',
        ]);

        $session = $this->quizService->createSession($request->user(), $validated);

        return response()->json([
            'success' => true,
            'data' => $session->load(['creator', 'class', 'guild', 'questions']),
        ], 201);
    }

    public function show(LeagueQuizSession $session): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $session->id,
                'title' => $session->title,
                'mode' => $session->mode,
                'difficulty' => $session->difficulty,
                'duration_minutes' => $session->duration_minutes,
                'questions_count' => $session->questions_count,
                'xp_reward' => $session->xp_reward,
                'pass_threshold' => $session->pass_threshold,
                'status' => $session->status,
                'starts_at' => $session->starts_at->toIso8601String(),
                'ends_at' => $session->ends_at->toIso8601String(),
                'time_remaining' => max(0, $session->ends_at->diffInSeconds(now())),
                'creator_name' => $session->creator->name ?? 'Unknown',
                'class_name' => $session->class->name ?? null,
                'guild_name' => $session->guild->name ?? null,
                'participant_count' => $session->participants()->count(),
            ],
        ]);
    }

    public function join(LeagueQuizSession $session, Request $request): JsonResponse
    {
        try {
            $result = $this->quizService->joinSession($request->user(), $session);

            return response()->json([
                'success' => true,
                'data' => $result,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function submit(LeagueQuizSession $session, Request $request): JsonResponse
    {
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string',
        ]);

        try {
            $result = $this->quizService->submitAnswer(
                $request->user(),
                $session,
                $validated['answers']
            );

            return response()->json([
                'success' => true,
                'data' => $result,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function results(LeagueQuizSession $session): JsonResponse
    {
        $results = $this->quizService->getSessionResults($session);

        return response()->json([
            'success' => true,
            'data' => $results,
        ]);
    }
}
