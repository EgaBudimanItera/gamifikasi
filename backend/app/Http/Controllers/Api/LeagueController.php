<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserLeague;
use App\Services\Gamification\LeagueService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LeagueController extends Controller
{
    protected LeagueService $leagueService;

    public function __construct(LeagueService $leagueService)
    {
        $this->leagueService = $leagueService;
    }

    public function myLeague(Request $request): JsonResponse
    {
        $league = $this->leagueService->getCurrentLeague($request->user());

        if (!$league) {
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'Belum ada liga minggu ini',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $league,
        ]);
    }

    public function standings(Request $request): JsonResponse
    {
        $weekRange = $this->leagueService->getCurrentWeekRange();
        $standings = $this->leagueService->getLeaderboardByWeek($weekRange['start']);

        return response()->json([
            'success' => true,
            'data' => [
                'week_start' => $weekRange['start'],
                'week_end' => $weekRange['end'],
                'leagues' => $standings,
            ],
        ]);
    }

    public function history(Request $request): JsonResponse
    {
        $history = $this->leagueService->getMyLeagueHistory($request->user());

        return response()->json([
            'success' => true,
            'data' => $history,
        ]);
    }

    public function myLeagueStanding(Request $request): JsonResponse
    {
        $league = $this->leagueService->getCurrentLeague($request->user());

        if (!$league) {
            return response()->json([
                'success' => true,
                'data' => null,
            ]);
        }

        $weekRange = $this->leagueService->getCurrentWeekRange();
        $standings = $this->leagueService->getLeagueStandings($league->league_id, $weekRange['start']);

        $rank = $standings->pluck('user_id')->search($request->user()->id) + 1;
        $totalPlayers = $standings->count();

        return response()->json([
            'success' => true,
            'data' => [
                'league' => $league->league,
                'rank' => $rank,
                'total_players' => $totalPlayers,
                'weekly_xp' => $league->weekly_xp,
                'status' => $league->status,
                'week_start' => $weekRange['start'],
                'week_end' => $weekRange['end'],
            ],
        ]);
    }
}
