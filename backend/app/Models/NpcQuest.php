<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NpcQuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'npc_id', 'question', 'options', 'correct_answer', 'difficulty',
        'xp_reward', 'required_affinity_level', 'is_active',
    ];

    protected $casts = [
        'options' => 'array',
        'is_active' => 'boolean',
    ];

    public function npc(): BelongsTo
    {
        return $this->belongsTo(Npc::class);
    }
}
