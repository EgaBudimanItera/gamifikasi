<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Npc;
use App\Models\NpcQuest;
use App\Models\Material;
use App\Services\Gamification\NpcService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NpcController extends Controller
{
    private NpcService $npcService;

    public function __construct(NpcService $npcService)
    {
        $this->npcService = $npcService;
    }

    public function index(): JsonResponse
    {
        $npcs = $this->npcService->getAllNpcs();

        return response()->json([
            'success' => true,
            'data' => $npcs,
        ]);
    }

    public function show(Npc $npc): JsonResponse
    {
        $npc->load('subject:id,name');

        return response()->json([
            'success' => true,
            'data' => $npc,
        ]);
    }

    public function encounter(Request $request, Material $material): JsonResponse
    {
        $user = $request->user();
        $result = $this->npcService->checkEncounter($user, $material);

        if (!$result) {
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'Tidak ada NPC yang muncul',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    public function quest(Npc $npc, Request $request): JsonResponse
    {
        $user = $request->user();
        $quest = $this->npcService->getNpcQuest($npc, $user);

        if (!$quest) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada quest tersedia',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $quest,
        ]);
    }

    public function completeQuest(Npc $npc, Request $request): JsonResponse
    {
        $validated = $request->validate([
            'quest_id' => 'required|exists:npc_quests,id',
            'answer' => 'required|string',
        ]);

        $quest = NpcQuest::findOrFail($validated['quest_id']);

        if ($quest->npc_id !== $npc->id) {
            return response()->json([
                'success' => false,
                'message' => 'Quest bukan milik NPC ini',
            ], 400);
        }

        $isCorrect = $quest->correct_answer === $validated['answer'];

        if (!$isCorrect) {
            return response()->json([
                'success' => true,
                'data' => [
                    'correct' => false,
                    'correct_answer' => $quest->correct_answer,
                    'message' => 'Jawaban kurang tepat. Coba lagi!',
                ],
            ]);
        }

        $user = $request->user();
        $result = $this->npcService->completeQuest($user, $quest);

        return response()->json([
            'success' => true,
            'data' => array_merge(['correct' => true], $result),
        ]);
    }

    public function myAffinities(Request $request): JsonResponse
    {
        $user = $request->user();
        $affinities = $this->npcService->getMyAffinities($user);

        return response()->json([
            'success' => true,
            'data' => $affinities,
        ]);
    }
}
