<?php

namespace App\Services\Gamification;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Streak;
use App\Models\StreakFreeze;
use Carbon\Carbon;

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

        // Check if yesterday's streak exists
        $yesterdayStreak = Streak::where('user_id', $user->id)
            ->where('date', $yesterday)
            ->first();

        if ($yesterdayStreak) {
            $newStreak = $profile->current_streak + 1;
        } else {
            // Check if streak freeze was used for yesterday
            $freezeUsed = StreakFreeze::where('user_id', $user->id)
                ->where('freeze_date', $yesterday)
                ->first();

            if ($freezeUsed) {
                // Streak continues with freeze
                $newStreak = $profile->current_streak + 1;
            } else {
                // Reset streak
                $newStreak = 1;
            }
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

        // Check streak milestones with escalating rewards
        $milestones = [
            7   => ['xp' => 100,  'message' => 'Streak 7 hari! 🔥'],
            14  => ['xp' => 150,  'message' => 'Streak 14 hari! 🔥🔥'],
            30  => ['xp' => 500,  'message' => 'Streak 30 hari! Streak Master! 🔥🔥🔥'],
            60  => ['xp' => 750,  'message' => 'Streak 60 hari! Legendaris! ⭐'],
            100 => ['xp' => 1500, 'message' => 'Streak 100 hari! Centurion! 💎'],
            365 => ['xp' => 5000, 'message' => 'Streak 365 hari! Seumur hidup! 👑'],
        ];

        if (isset($milestones[$newStreak])) {
            $milestone = $milestones[$newStreak];
            $this->xpService->award($user, $milestone['xp'], 'streak', $milestone['message']);
            $xpEarned += $milestone['xp'];
        }

        return [
            'message' => 'Check-in berhasil! Streak: ' . $newStreak . ' hari',
            'streak' => $newStreak,
            'xp_earned' => $xpEarned,
            'milestone' => isset($milestones[$newStreak]) ? $milestones[$newStreak] : null,
        ];
    }

    public function useFreeze(User $user): array
    {
        $profile = $user->profile;
        if (!$profile) {
            return ['success' => false, 'message' => 'Profile tidak ditemukan'];
        }

        // Check if already has a freeze for today
        $today = now()->toDateString();
        $existingFreeze = StreakFreeze::where('user_id', $user->id)
            ->where('used_at_date', $today)
            ->first();

        if ($existingFreeze) {
            return ['success' => false, 'message' => 'Sudah menggunakan freeze hari ini'];
        }

        // Check freeze limit (max 1 per week)
        $weekStart = now()->copy()->startOfWeek(Carbon::MONDAY)->toDateString();
        $weekFreezes = StreakFreeze::where('user_id', $user->id)
            ->where('used_at_date', '>=', $weekStart)
            ->count();

        if ($weekFreezes >= 1) {
            return ['success' => false, 'message' => 'Batas freeze mingguan sudah tercapai (1/minggu)'];
        }

        // Check if user didn't login yesterday
        $yesterday = now()->subDay()->toDateString();
        $yesterdayStreak = Streak::where('user_id', $user->id)
            ->where('date', $yesterday)
            ->first();

        if ($yesterdayStreak) {
            return ['success' => false, 'message' => 'Kamu sudah login kemarin, tidak perlu freeze'];
        }

        // Check if streak is active
        if ($profile->current_streak <= 0) {
            return ['success' => false, 'message' => 'Tidak ada streak yang bisa diproteksi'];
        }

        // Apply freeze for yesterday
        StreakFreeze::create([
            'user_id' => $user->id,
            'freeze_date' => $yesterday,
            'used_at_date' => $today,
        ]);

        return [
            'success' => true,
            'message' => 'Freeze berhasil! Streak kamu terlindungi untuk kemarin',
            'streak' => $profile->current_streak,
        ];
    }

    public function getFreezeStatus(User $user): array
    {
        $weekStart = now()->copy()->startOfWeek(Carbon::MONDAY)->toDateString();
        $weekFreezes = StreakFreeze::where('user_id', $user->id)
            ->where('used_at_date', '>=', $weekStart)
            ->count();

        $profile = $user->profile;

        return [
            'used_this_week' => $weekFreezes,
            'max_per_week' => 1,
            'available' => $weekFreezes < 1,
            'current_streak' => $profile ? $profile->current_streak : 0,
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

        $inactiveUsers = UserProfile::where('current_streak', '>', 0)
            ->whereDoesntHave('user.streaks', function ($query) use ($yesterday) {
                $query->where('date', $yesterday);
            })
            ->get();

        foreach ($inactiveUsers as $profile) {
            // Check if user has a freeze applied for yesterday
            $hasFreeze = StreakFreeze::where('user_id', $profile->user_id)
                ->where('freeze_date', $yesterday)
                ->exists();

            if (!$hasFreeze) {
                $profile->update(['current_streak' => 0]);
            }
        }
    }

    public function getStreakCalendar(User $user, int $months = 3): array
    {
        $startDate = now()->subMonths($months)->startOfMonth()->toDateString();
        $endDate = now()->endOfMonth()->toDateString();

        $streaks = Streak::where('user_id', $user->id)
            ->whereBetween('date', [$startDate, $endDate])
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d'))
            ->toArray();

        $freezes = StreakFreeze::where('user_id', $user->id)
            ->whereBetween('freeze_date', [$startDate, $endDate])
            ->pluck('freeze_date')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d'))
            ->toArray();

        return [
            'streaks' => $streaks,
            'freezes' => $freezes,
        ];
    }
}
