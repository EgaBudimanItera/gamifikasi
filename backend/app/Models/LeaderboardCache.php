<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaderboardCache extends Model
{
    use HasFactory;

    protected $table = 'leaderboard_cache';
    protected $fillable = [
        'user_id', 'class_id', 'scope', 'period',
        'total_xp', 'rank', 'cached_at',
    ];

    protected $casts = [
        'cached_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class);
    }
}
