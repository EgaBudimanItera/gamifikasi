<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeagueQuizParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id', 'user_id', 'answers', 'correct_count',
        'total_questions', 'xp_earned', 'started_at', 'completed_at', 'status',
    ];

    protected $casts = [
        'answers' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'correct_count' => 'integer',
        'total_questions' => 'integer',
        'xp_earned' => 'integer',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(LeagueQuizSession::class, 'session_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
