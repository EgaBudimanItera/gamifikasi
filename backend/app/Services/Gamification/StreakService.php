<?php

namespace App\Services\Gamification;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Streak;

class StreakService
{
    protected XpService $xpService;

    public function __construct(XpService $xpService)
    {
        $this->xpService = $xpService;
    }

    public function checkIn(User $user): array
    {
        $profile = $user->profile;
        if (!$profile) {
            $profile = UserProfile::create(['user_id' => $user->id]);
        }

        $today = now()->toDateString();
        $yesterday = now()->subDay()->toDateString();

        // Check if already checked in today
        $todayStreak = Streak::where('user_id', $user->id)
            ->where('date', $today)
            ->first();

        if ($todayStreak) {
            return [
                'message' => 'Sudah check-in hari ini',
                'streak' => $profile->current_streak,
                'xp_earned' => 0,
            ];
        }

        // Check yesterday's streak
        $yesterdayStreak = Streak::where('user_id', $user->id)
            ->where('date', $yesterday)
            ->first();

        if ($yesterdayStreak) {
            // Continue streak
            $newStreak = $profile->current_streak + 1;
        } else {
            // Reset streak
            $newStreak = 1;
        }

        // Create today's streak record
        Streak::create([
            'user_id' => $user->id,
            'date' => $today,
            'login_count' => 1,
        ]);

        // Update profile
        $longestStreak = max($profile->longest_streak, $newStreak);
        $profile->update([
            'current_streak' => $newStreak,
            'longest_streak' => $longestStreak,
        ]);

        // Award daily login XP
        $xpResult = $this->xpService->award(
            $user,
            10,
            'login',
            'Login harian'
        );

        $xpEarned = 10;

        // Check streak milestones
        if ($newStreak === 7) {
            $this->xpService->award($user, 100, 'streak', 'Streak 7 hari!');
            $xpEarned += 100;
        } elseif ($newStreak === 30) {
            $this->xpService->award($user, 500, 'streak', 'Streak 30 hari!');
            $xpEarned += 500;
        }

        return [
            'message' => 'Check-in berhasil! Streak: ' . $newStreak . ' hari',
            'streak' => $newStreak,
            'xp_earned' => $xpEarned,
        ];
    }

    public function resetStreak(User $user): void
    {
        $profile = $user->profile;
        if ($profile && $profile->current_streak > 0) {
            $profile->update(['current_streak' => 0]);
        }
    }

    public function checkAndResetStreaks(): void
    {
        $yesterday = now()->subDay()->toDateString();

        // Find users who didn't login yesterday
        $inactiveUsers = UserProfile::where('current_streak', '>', 0)
            ->whereDoesntHave('user.streaks', function ($query) use ($yesterday) {
                $query->where('date', $yesterday);
            })
            ->get();

        foreach ($inactiveUsers as $profile) {
            $profile->update(['current_streak' => 0]);
        }
    }
}
