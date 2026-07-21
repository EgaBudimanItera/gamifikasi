<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserNpcAffinity extends Model
{
    use HasFactory;

    protected $table = 'user_npc_affinity';

    protected $fillable = [
        'user_id', 'npc_id', 'affinity_level', 'affinity_xp',
        'total_quests_completed', 'last_interaction_at',
    ];

    protected $casts = [
        'last_interaction_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function npc(): BelongsTo
    {
        return $this->belongsTo(Npc::class);
    }

    public function calculateLevel(): int
    {
        $xp = $this->affinity_xp;
        if ($xp >= 50) return 5;
        if ($xp >= 30) return 4;
        if ($xp >= 15) return 3;
        if ($xp >= 5) return 2;
        return 1;
    }
}
