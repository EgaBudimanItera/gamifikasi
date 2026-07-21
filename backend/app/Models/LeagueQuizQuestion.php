<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeagueQuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id', 'npc_quest_id', 'question', 'options',
        'correct_answer', 'difficulty', 'order',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(LeagueQuizSession::class, 'session_id');
    }

    public function npcQuest(): BelongsTo
    {
        return $this->belongsTo(NpcQuest::class);
    }
}
