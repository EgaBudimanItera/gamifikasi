<?php

namespace App\Services\Gamification;

use App\Models\User;
use App\Models\UserQuest;
use App\Models\Notification;

class QuestService
{
    protected XpService $xpService;

    public function __construct(XpService $xpService)
    {
        $this->xpService = $xpService;
    }

    public function completeQuest(User $user, UserQuest $userQuest): array
    {
        if ($userQuest->status !== 'active') {
            return ['success' => false, 'message' => 'Quest sudah selesai atau gagal'];
        }

        $userQuest->update([
            'status' => 'completed',
            'progress' => 100,
            'completed_at' => now(),
        ]);

        // Award XP
        $xpResult = $this->xpService->award(
            $user,
            $userQuest->quest->xp_reward,
            'quest',
            'Penyelesaian quest: ' . $userQuest->quest->title
        );

        // Send notification
        Notification::create([
            'user_id' => $user->id,
            'title' => 'Quest Completed!',
            'message' => "Quest \"{$userQuest->quest->title}\" selesai! +{$userQuest->quest->xp_reward} XP",
            'type' => 'reward',
            'data' => [
                'quest_id' => $userQuest->quest_id,
                'xp_earned' => $userQuest->quest->xp_reward,
            ],
        ]);

        return [
            'success' => true,
            'message' => 'Quest selesai!',
            'xp_earned' => $userQuest->quest->xp_reward,
        ];
    }

    public function updateProgress(User $user, UserQuest $userQuest, int $progress): void
    {
        $progress = min(100, max(0, $progress));
        $userQuest->update(['progress' => $progress]);

        if ($progress >= 100) {
            $this->completeQuest($user, $userQuest);
        }
    }
}
