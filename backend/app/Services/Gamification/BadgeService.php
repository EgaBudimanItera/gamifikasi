<?php

namespace App\Services\Gamification;

use App\Models\Badge;
use App\Models\User;
use App\Models\UserBadge;
use App\Models\Notification;

class BadgeService
{
    public function checkAndAward(User $user): array
    {
        $awarded = [];
        $profile = $user->profile;

        if (!$profile) {
            return $awarded;
        }

        $badges = Badge::all();

        foreach ($badges as $badge) {
            $alreadyHas = UserBadge::where('user_id', $user->id)
                ->where('badge_id', $badge->id)
                ->exists();

            if ($alreadyHas) {
                continue;
            }

            $criteria = $badge->criteria;
            $earned = false;

            switch ($badge->category) {
                case 'achievement':
                    $earned = $this->checkAchievement($user, $criteria);
                    break;
                case 'streak':
                    $earned = $this->checkStreak($profile, $criteria);
                    break;
                case 'rank':
                    // Rank badges are awarded by LeaderboardService
                    break;
            }

            if ($earned) {
                UserBadge::create([
                    'user_id' => $user->id,
                    'badge_id' => $badge->id,
                    'earned_at' => now(),
                ]);

                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Badge Earned!',
                    'message' => "Selamat! Anda mendapat badge: {$badge->name}",
                    'type' => 'achievement',
                    'data' => ['badge_id' => $badge->id, 'badge_name' => $badge->name],
                ]);

                $awarded[] = $badge;
            }
        }

        return $awarded;
    }

    protected function checkAchievement(User $user, array $criteria): bool
    {
        if (isset($criteria['tasks_completed'])) {
            $completed = $user->submissions()->where('status', 'graded')->count();
            return $completed >= $criteria['tasks_completed'];
        }
        return false;
    }

    protected function checkStreak($profile, array $criteria): bool
    {
        if (isset($criteria['streak_days'])) {
            return $profile->longest_streak >= $criteria['streak_days'];
        }
        return false;
    }
}
