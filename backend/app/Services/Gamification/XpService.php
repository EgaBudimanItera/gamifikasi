<?php

namespace App\Services\Gamification;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\XpLog;
use App\Models\Notification;

class XpService
{
    public function award(User $user, int $amount, string $type, string $description, $referenceId = null, $referenceType = null): array
    {
        $profile = $user->profile;
        if (!$profile) {
            $profile = UserProfile::create(['user_id' => $user->id]);
        }

        $profile->increment('total_xp', $amount);

        // Recalculate level
        $newLevel = $profile->calculateLevel();
        $levelChanged = $newLevel > $profile->current_level;
        $profile->update(['current_level' => $newLevel]);

        // Log XP
        XpLog::create([
            'user_id' => $user->id,
            'user_profile_id' => $profile->id,
            'amount' => $amount,
            'type' => $type,
            'description' => $description,
            'reference_id' => $referenceId,
            'reference_type' => $referenceType,
        ]);

        // Send notification
        Notification::create([
            'user_id' => $user->id,
            'title' => 'XP Earned!',
            'message' => "Anda mendapatkan +{$amount} XP: {$description}",
            'type' => 'reward',
            'data' => [
                'xp_amount' => $amount,
                'type' => $type,
                'level_changed' => $levelChanged,
                'new_level' => $newLevel,
            ],
        ]);

        // Check badges
        if ($levelChanged) {
            app(BadgeService::class)->checkAndAward($user);
        }

        return [
            'xp_earned' => $amount,
            'total_xp' => $profile->fresh()->total_xp,
            'level' => $newLevel,
            'level_changed' => $levelChanged,
        ];
    }

    public function deduct(User $user, int $amount, string $description): array
    {
        $profile = $user->profile;
        if (!$profile) {
            return ['xp_deducted' => 0, 'total_xp' => 0];
        }

        $profile->decrement('total_xp', $amount);
        $profile->update(['current_level' => $profile->calculateLevel()]);

        XpLog::create([
            'user_id' => $user->id,
            'user_profile_id' => $profile->id,
            'amount' => -$amount,
            'type' => 'penalty',
            'description' => $description,
        ]);

        return [
            'xp_deducted' => $amount,
            'total_xp' => $profile->fresh()->total_xp,
        ];
    }

    public function getTotalXp(User $user): int
    {
        $profile = $user->profile;
        return $profile ? $profile->total_xp : 0;
    }
}
