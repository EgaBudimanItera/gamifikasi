<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'total_xp', 'current_level',
        'current_streak', 'longest_streak', 'last_login_at',
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function xpLogs(): HasMany
    {
        return $this->hasMany(XpLog::class);
    }

    public function calculateLevel(): int
    {
        return (int) floor(sqrt($this->total_xp / 100)) + 1;
    }

    public function xpForNextLevel(): int
    {
        $nextLevel = $this->current_level + 1;
        return (int) pow($nextLevel - 1, 2) * 100;
    }

    public function xpProgress(): int
    {
        $currentLevelXp = (int) pow($this->current_level - 1, 2) * 100;
        $nextLevelXp = $this->xpForNextLevel();
        $range = $nextLevelXp - $currentLevelXp;
        if ($range <= 0) return 100;
        $progress = $this->total_xp - $currentLevelXp;
        return (int) min(100, max(0, ($progress / $range) * 100));
    }
}
