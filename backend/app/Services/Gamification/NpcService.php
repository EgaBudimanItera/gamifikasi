<?php

namespace App\Services\Gamification;

use App\Models\Npc;
use App\Models\NpcQuest;
use App\Models\User;
use App\Models\UserNpcAffinity;
use App\Models\Material;

class NpcService
{
    private XpService $xpService;

    public function __construct(XpService $xpService)
    {
        $this->xpService = $xpService;
    }

    public function getAllNpcs(): \Illuminate\Database\Eloquent\Collection
    {
        return Npc::with('subject:id,name')->where('is_active', true)->get();
    }

    public function getNpc(int $npcId): ?Npc
    {
        return Npc::with('subject:id,name')->find($npcId);
    }

    public function checkEncounter(User $user, Material $material): ?array
    {
        $npc = Npc::where('subject_id', $material->subject_id)
            ->where('is_active', true)
            ->first();

        if (!$npc) {
            return null;
        }

        $roll = rand(1, 100);
        if ($roll > 33) {
            return null;
        }

        $affinity = UserNpcAffinity::firstOrCreate(
            ['user_id' => $user->id, 'npc_id' => $npc->id],
            ['affinity_level' => 1, 'affinity_xp' => 0]
        );

        $dialog = $npc->getDialogForLevel($affinity->affinity_level);
        $personalizedDialog = str_replace('{name}', $user->name, $dialog);

        return [
            'npc' => $npc,
            'affinity' => $affinity,
            'dialog' => $personalizedDialog,
            'has_quest' => $this->hasAvailableQuest($npc, $affinity),
        ];
    }

    public function getNpcQuest(Npc $npc, User $user): ?array
    {
        $affinity = UserNpcAffinity::where('user_id', $user->id)
            ->where('npc_id', $npc->id)
            ->first();

        if (!$affinity) {
            return null;
        }

        $quest = NpcQuest::where('npc_id', $npc->id)
            ->where('is_active', true)
            ->where('required_affinity_level', '<=', $affinity->affinity_level)
            ->inRandomOrder()
            ->first();

        if (!$quest) {
            return null;
        }

        return [
            'id' => $quest->id,
            'question' => $quest->question,
            'options' => $quest->options,
            'difficulty' => $quest->difficulty,
            'xp_reward' => $quest->xp_reward,
        ];
    }

    public function completeQuest(User $user, NpcQuest $quest): array
    {
        $affinity = UserNpcAffinity::firstOrCreate(
            ['user_id' => $user->id, 'npc_id' => $quest->npc_id],
            ['affinity_level' => 1, 'affinity_xp' => 0]
        );

        $result = $this->xpService->award(
            $user,
            $quest->xp_reward,
            'npc_quest',
            "Quest NPC: {$quest->npc->name}",
            $quest->id,
            NpcQuest::class
        );

        $affinityXp = $this->getAffinityXpForDifficulty($quest->difficulty);
        $affinity->increment('affinity_xp', $affinityXp);
        $affinity->increment('total_quests_completed');
        $affinity->update(['last_interaction_at' => now()]);

        $newLevel = $affinity->calculateLevel();
        $levelUp = $newLevel > $affinity->affinity_level;
        $affinity->update(['affinity_level' => $newLevel]);

        $npc = $quest->npc;
        $nextDialog = $npc->getDialogForLevel($newLevel);

        return [
            'xp_earned' => $quest->xp_reward,
            'total_xp' => $result['total_xp'],
            'affinity_xp_gained' => $affinityXp,
            'affinity_level' => $newLevel,
            'affinity_level_up' => $levelUp,
            'next_dialog' => str_replace('{name}', $user->name, $nextDialog),
            'total_quests_completed' => $affinity->total_quests_completed,
        ];
    }

    public function getMyAffinities(User $user): array
    {
        return UserNpcAffinity::where('user_id', $user->id)
            ->with('npc:id,name,personality,avatar_url,subject_id')
            ->get()
            ->map(fn($a) => [
                'npc' => $a->npc,
                'affinity_level' => $a->affinity_level,
                'affinity_xp' => $a->affinity_xp,
                'total_quests_completed' => $a->total_quests_completed,
                'last_interaction_at' => $a->last_interaction_at,
                'xp_to_next_level' => $this->getXpToNextLevel($a->affinity_level),
            ])
            ->toArray();
    }

    private function hasAvailableQuest(Npc $npc, UserNpcAffinity $affinity): bool
    {
        return NpcQuest::where('npc_id', $npc->id)
            ->where('is_active', true)
            ->where('required_affinity_level', '<=', $affinity->affinity_level)
            ->exists();
    }

    private function getAffinityXpForDifficulty(string $difficulty): int
    {
        return match ($difficulty) {
            'easy' => 1,
            'medium' => 2,
            'hard' => 3,
            'legendary' => 5,
            default => 1,
        };
    }

    private function getXpToNextLevel(int $currentLevel): int
    {
        $thresholds = [0, 5, 15, 30, 50];
        if ($currentLevel >= 5) return 0;
        return $thresholds[$currentLevel] - ($thresholds[$currentLevel - 1] ?? 0);
    }
}
