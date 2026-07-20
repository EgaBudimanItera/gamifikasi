<?php

namespace App\Services\Gamification;

use App\Models\League;
use App\Models\User;
use App\Models\UserLeague;
use App\Models\XpLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LeagueService
{
    public function getCurrentLeague(User $user): ?UserLeague
    {
        $now = Carbon::now();
        $weekStart = $now->copy()->startOfWeek(Carbon::MONDAY)->toDateString();

        return UserLeague::with('league')
            ->where('user_id', $user->id)
            ->where('week_start', $weekStart)
            ->first();
    }

    public function getCurrentWeekRange(): array
    {
        $now = Carbon::now();
        $weekStart = $now->copy()->startOfWeek(Carbon::MONDAY);
        $weekEnd = $now->copy()->endOfWeek(Carbon::SUNDAY);

        return [
            'start' => $weekStart->toDateString(),
            'end' => $weekEnd->toDateString(),
        ];
    }

    public function getLeagueStandings(int $leagueId, string $weekStart): array
    {
        return UserLeague::with('user')
            ->where('league_id', $leagueId)
            ->where('week_start', $weekStart)
            ->orderBy('weekly_xp', 'desc')
            ->get();
    }

    public function assignUsersToLeagues(string $weekStart, string $weekEnd): void
    {
        $leagues = League::orderBy('order')->get();
        if ($leagues->isEmpty()) return;

        $allStudents = DB::table('users')
            ->where('role_id', 3)
            ->get();

        // Calculate weekly XP for each student
        $weeklyXp = XpLog::select('user_id', DB::raw('SUM(amount) as total_xp'))
            ->where('created_at', '>=', $weekStart)
            ->where('created_at', '<=', $weekEnd . ' 23:59:59')
            ->groupBy('user_id')
            ->pluck('total_xp', 'user_id');

        // Assign students to leagues based on their weekly XP
        foreach ($allStudents as $student) {
            $xp = $weeklyXp->get($student->id, 0);

            // Find appropriate league
            $league = $leagues->filter(function ($l) use ($xp) {
                return $xp >= $l->min_xp && $xp <= $l->max_xp;
            })->first();

            // Default to lowest league if no match
            if (!$league) {
                $league = $leagues->first();
            }

            UserLeague::updateOrCreate(
                [
                    'user_id' => $student->id,
                    'week_start' => $weekStart,
                ],
                [
                    'league_id' => $league->id,
                    'week_end' => $weekEnd,
                    'weekly_xp' => $xp,
                ]
            );
        }
    }

    public function processPromotionDemotion(string $weekStart): void
    {
        $leagues = League::orderBy('order')->get();

        foreach ($leagues as $league) {
            $standings = $this->getLeagueStandings($league->id, $weekStart);

            // Promote top N
            $promoted = $standings->take($league->promote_count);
            foreach ($promoted as $ul) {
                $nextLeague = $leagues->firstWhere('order', $league->order + 1);
                if ($nextLeague) {
                    $ul->update(['status' => 'promoted', 'league_id' => $nextLeague->id]);
                } else {
                    $ul->update(['status' => 'promoted']); // Already at top
                }
            }

            // Demote bottom N
            $demoted = $standings->take(-$league->demote_count);
            foreach ($demoted as $ul) {
                $prevLeague = $leagues->firstWhere('order', $league->order - 1);
                if ($prevLeague) {
                    $ul->update(['status' => 'demoted', 'league_id' => $prevLeague->id]);
                } else {
                    $ul->update(['status' => 'demoted']); // Already at bottom
                }
            }

            // Mark remaining as active
            $remaining = $standings->slice($league->promote_count, -$league->demote_count);
            foreach ($remaining as $ul) {
                $ul->update(['status' => 'active']);
            }
        }
    }

    public function getMyLeagueHistory(User $user, int $limit = 5): array
    {
        return UserLeague::with('league')
            ->where('user_id', $user->id)
            ->orderBy('week_start', 'desc')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    public function getLeaderboardByWeek(string $weekStart): array
    {
        $leagues = League::orderBy('order')->get();
        $result = [];

        foreach ($leagues as $league) {
            $standings = $this->getLeagueStandings($league->id, $weekStart);
            $result[] = [
                'league' => $league,
                'players' => $standings->map(fn($ul) => [
                    'user_id' => $ul->user->id ?? $ul->user_id,
                    'name' => $ul->user->name ?? 'Unknown',
                    'weekly_xp' => $ul->weekly_xp,
                    'rank' => $ul->rank,
                    'status' => $ul->status,
                ])->toArray(),
            ];
        }

        return $result;
    }
}
