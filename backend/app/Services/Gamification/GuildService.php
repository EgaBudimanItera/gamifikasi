<?php

namespace App\Services\Gamification;

use App\Models\Guild;
use App\Models\GuildMember;
use App\Models\GuildQuest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GuildService
{
    protected XpService $xpService;

    public function __construct(XpService $xpService)
    {
        $this->xpService = $xpService;
    }

    public function createGuild(User $leader, string $name, ?string $description, ?string $icon, ?int $classId): Guild
    {
        $guild = Guild::create([
            'name' => $name,
            'description' => $description,
            'icon' => $icon ?? '🛡️',
            'leader_id' => $leader->id,
            'class_id' => $classId,
        ]);

        GuildMember::create([
            'guild_id' => $guild->id,
            'user_id' => $leader->id,
            'role' => 'leader',
        ]);

        return $guild->load('members.user');
    }

    public function joinGuild(User $user, int $guildId): array
    {
        $guild = Guild::withCount('members')->find($guildId);

        if (!$guild) {
            return ['success' => false, 'message' => 'Guild tidak ditemukan'];
        }

        if ($guild->members_count >= $guild->max_members) {
            return ['success' => false, 'message' => 'Guild sudah penuh'];
        }

        $existingMember = GuildMember::where('user_id', $user->id)->first();
        if ($existingMember) {
            return ['success' => false, 'message' => 'Kamu sudah bergabung di guild lain'];
        }

        GuildMember::create([
            'guild_id' => $guildId,
            'user_id' => $user->id,
            'role' => 'member',
        ]);

        return ['success' => true, 'message' => 'Berhasil bergabung!'];
    }

    public function leaveGuild(User $user): array
    {
        $member = GuildMember::where('user_id', $user->id)->first();

        if (!$member) {
            return ['success' => false, 'message' => 'Kamu tidak ada di guild manapun'];
        }

        if ($member->role === 'leader') {
            $memberCount = GuildMember::where('guild_id', $member->guild_id)->count();
            if ($memberCount > 1) {
                // Transfer leadership to oldest member
                $newLeader = GuildMember::where('guild_id', $member->guild_id)
                    ->where('user_id', '!=', $user->id)
                    ->orderBy('created_at')
                    ->first();

                if ($newLeader) {
                    $newLeader->update(['role' => 'leader']);
                    Guild::where('id', $member->guild_id)->update(['leader_id' => $newLeader->user_id]);
                }
            }
        }

        $member->delete();

        // If guild is empty, delete it
        $remainingMembers = GuildMember::where('guild_id', $member->guild_id)->count();
        if ($remainingMembers === 0) {
            Guild::where('id', $member->guild_id)->delete();
        }

        return ['success' => true, 'message' => 'Berhasil keluar dari guild'];
    }

    public function getMyGuild(User $user): ?Guild
    {
        $member = GuildMember::where('user_id', $user->id)->first();

        if (!$member) return null;

        return Guild::with(['members.user', 'guildQuests.quest', 'leader'])
            ->find($member->guild_id);
    }

    public function getGuildMembers(int $guildId): array
    {
        return GuildMember::with('user')
            ->where('guild_id', $guildId)
            ->orderBy('role', 'desc')
            ->orderBy('contributed_xp', 'desc')
            ->get()
            ->toArray();
    }

    public function contributeXp(User $user, int $amount): void
    {
        $member = GuildMember::where('user_id', $user->id)->first();
        if (!$member) return;

        $member->increment('contributed_xp', $amount);
        Guild::where('id', $member->guild_id)->increment('total_guild_xp', $amount);
    }

    public function getGuildLeaderboard(int $classId = null): array
    {
        $query = Guild::withCount('members')
            ->orderBy('total_guild_xp', 'desc');

        if ($classId) {
            $query->where('class_id', $classId);
        }

        return $query->get()->toArray();
    }

    public function getAvailableGuilds(User $user, ?int $classId = null): array
    {
        $query = Guild::withCount('members')
            ->where('max_members', '>', DB::raw('(select count(*) from guild_members where guild_id = guilds.id)'))
            ->orderBy('total_guild_xp', 'desc');

        if ($classId) {
            $query->where('class_id', $classId);
        }

        // Exclude guilds user is already in
        $memberGuildIds = GuildMember::where('user_id', $user->id)->pluck('guild_id')->toArray();
        if (!empty($memberGuildIds)) {
            $query->whereNotIn('id', $memberGuildIds);
        }

        return $query->get()->toArray();
    }
}
