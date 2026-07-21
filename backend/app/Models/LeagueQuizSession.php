<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeagueQuizSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by', 'title', 'mode', 'class_id', 'guild_id',
        'duration_minutes', 'questions_count', 'difficulty',
        'pass_threshold', 'xp_reward', 'status', 'starts_at', 'ends_at', 'is_active',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'duration_minutes' => 'integer',
        'questions_count' => 'integer',
        'pass_threshold' => 'integer',
        'xp_reward' => 'integer',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class);
    }

    public function guild(): BelongsTo
    {
        return $this->belongsTo(Guild::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(LeagueQuizQuestion::class, 'session_id');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(LeagueQuizParticipant::class, 'session_id');
    }

    public function isExpired(): bool
    {
        return $this->ends_at->isPast();
    }

    public function timeRemaining(): int
    {
        return max(0, $this->ends_at->diffInSeconds(now()));
    }
}
