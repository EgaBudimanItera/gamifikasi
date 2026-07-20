<?php

namespace App\Services\Gamification;

use App\Models\LeaderboardCache;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;

class LeaderboardService
{
    public function getClassLeaderboard(int $classId): array
    {
        $cache = LeaderboardCache::where('class_id', $classId)
            ->where('scope', 'class')
            ->where('period', 'all_time')
            ->where('cached_at', '>', now()->subHour())
            ->with('user')
            ->orderBy('rank')
            ->get();

        if ($cache->isNotEmpty()) {
            return $cache->toArray();
        }

        return $this->refreshClassLeaderboard($classId);
    }

    public function refreshClassLeaderboard(int $classId): array
    {
        // Get students in class with their XP
        $students = DB::table('student_classes')
            ->join('users', 'student_classes.user_id', '=', 'users.id')
            ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->where('student_classes.class_id', $classId)
            ->select('users.id as user_id', 'user_profiles.total_xp')
            ->orderByDesc('user_profiles.total_xp')
            ->get();

        $rank = 1;
        $leaderboard = [];

        foreach ($students as $student) {
            // Update or create cache
            LeaderboardCache::updateOrCreate(
                [
                    'user_id' => $student->user_id,
                    'class_id' => $classId,
                    'scope' => 'class',
                    'period' => 'all_time',
                ],
                [
                    'total_xp' => $student->total_xp,
                    'rank' => $rank,
                    'cached_at' => now(),
                ]
            );

            $leaderboard[] = [
                'rank' => $rank,
                'user_id' => $student->user_id,
                'total_xp' => $student->total_xp,
            ];

            $rank++;
        }

        return $leaderboard;
    }

    public function getSchoolLeaderboard(int $schoolId): array
    {
        $cache = LeaderboardCache::where('scope', 'school')
            ->where('period', 'all_time')
            ->where('cached_at', '>', now()->subHour())
            ->whereHas('user', fn($q) => $q->where('school_id', $schoolId))
            ->orderBy('rank')
            ->get();

        if ($cache->isNotEmpty()) {
            return $cache->toArray();
        }

        return $this->refreshSchoolLeaderboard($schoolId);
    }

    public function refreshSchoolLeaderboard(int $schoolId): array
    {
        $students = DB::table('users')
            ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->where('users.school_id', $schoolId)
            ->select('users.id as user_id', 'user_profiles.total_xp')
            ->orderByDesc('user_profiles.total_xp')
            ->limit(100)
            ->get();

        $rank = 1;
        $leaderboard = [];

        foreach ($students as $student) {
            LeaderboardCache::updateOrCreate(
                [
                    'user_id' => $student->user_id,
                    'class_id' => null,
                    'scope' => 'school',
                    'period' => 'all_time',
                ],
                [
                    'total_xp' => $student->total_xp,
                    'rank' => $rank,
                    'cached_at' => now(),
                ]
            );

            $leaderboard[] = [
                'rank' => $rank,
                'user_id' => $student->user_id,
                'total_xp' => $student->total_xp,
            ];

            $rank++;
        }

        return $leaderboard;
    }
}
