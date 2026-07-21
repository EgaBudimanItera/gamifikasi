<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Npc extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id', 'name', 'personality', 'avatar_url', 'dialogs', 'is_active',
    ];

    protected $casts = [
        'dialogs' => 'array',
        'is_active' => 'boolean',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function quests(): HasMany
    {
        return $this->hasMany(NpcQuest::class);
    }

    public function affinities(): HasMany
    {
        return $this->hasMany(UserNpcAffinity::class);
    }

    public function getDialogForLevel(int $level): string
    {
        $dialogs = $this->dialogs ?? [];
        $key = "level_{$level}";
        return $dialogs[$key] ?? $dialogs['level_1'] ?? "Halo!";
    }
}
