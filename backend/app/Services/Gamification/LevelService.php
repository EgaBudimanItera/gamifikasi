<?php

namespace App\Services\Gamification;

use App\Models\UserProfile;

class LevelService
{
    /**
     * Calculate level from total XP
     * Formula: level = floor(sqrt(total_xp / 100)) + 1
     */
    public function calculate(int $totalXp): int
    {
        if ($totalXp <= 0) {
            return 1;
        }
        return (int) floor(sqrt($totalXp / 100)) + 1;
    }

    /**
     * Get XP required for a specific level
     */
    public function xpForLevel(int $level): int
    {
        if ($level <= 1) {
            return 0;
        }
        return (int) pow($level - 1, 2) * 100;
    }

    /**
     * Get XP needed to reach next level
     */
    public function xpToNextLevel(UserProfile $profile): int
    {
        $nextLevelXp = $this->xpForLevel($profile->current_level + 1);
        return max(0, $nextLevelXp - $profile->total_xp);
    }

    /**
     * Get XP progress percentage to next level
     */
    public function progressPercentage(UserProfile $profile): int
    {
        $currentLevelXp = $this->xpForLevel($profile->current_level);
        $nextLevelXp = $this->xpForLevel($profile->current_level + 1);
        $range = $nextLevelXp - $currentLevelXp;

        if ($range <= 0) {
            return 100;
        }

        $progress = $profile->total_xp - $currentLevelXp;
        return (int) min(100, max(0, ($progress / $range) * 100));
    }

    /**
     * Update user level based on current XP
     */
    public function updateLevel(UserProfile $profile): bool
    {
        $newLevel = $this->calculate($profile->total_xp);

        if ($newLevel !== $profile->current_level) {
            $profile->update(['current_level' => $newLevel]);
            return true;
        }

        return false;
    }
}
