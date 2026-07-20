<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guild;
use App\Models\GuildMember;
use App\Services\Gamification\GuildService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GuildController extends Controller
{
    protected GuildService $guildService;

    public function __construct(GuildService $guildService)
    {
        $this->guildService = $guildService;
    }

    public function myGuild(Request $request): JsonResponse
    {
        $guild = $this->guildService->getMyGuild($request->user());

        return response()->json([
            'success' => true,
            'data' => $guild,
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:10',
            'class_id' => 'nullable|integer',
        ]);

        $existing = GuildMember::where('user_id', $request->user()->id)->first();
        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu sudah ada di guild lain',
            ], 400);
        }

        $guild = $this->guildService->createGuild(
            $request->user(),
            $request->name,
            $request->description,
            $request->icon,
            $request->class_id
        );

        return response()->json([
            'success' => true,
            'data' => $guild,
        ], 201);
    }

    public function join(Request $request, int $guildId): JsonResponse
    {
        $result = $this->guildService->joinGuild($request->user(), $guildId);

        return response()->json([
            'success' => $result['success'],
            'message' => $result['message'],
        ], $result['success'] ? 200 : 400);
    }

    public function leave(Request $request): JsonResponse
    {
        $result = $this->guildService->leaveGuild($request->user());

        return response()->json([
            'success' => $result['success'],
            'message' => $result['message'],
        ]);
    }

    public function available(Request $request): JsonResponse
    {
        $classId = $request->user()->studentClasses->first()?->class_id;
        $guilds = $this->guildService->getAvailableGuilds($request->user(), $classId);

        return response()->json([
            'success' => true,
            'data' => $guilds,
        ]);
    }

    public function leaderboard(Request $request): JsonResponse
    {
        $classId = $request->user()->studentClasses->first()?->class_id;
        $leaderboard = $this->guildService->getGuildLeaderboard($classId);

        return response()->json([
            'success' => true,
            'data' => $leaderboard,
        ]);
    }

    public function members(Request $request, int $guildId): JsonResponse
    {
        $members = $this->guildService->getGuildMembers($guildId);

        return response()->json([
            'success' => true,
            'data' => $members,
        ]);
    }
}
