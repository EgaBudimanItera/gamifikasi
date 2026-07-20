<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'type', 'xp_reward',
        'badge_id', 'criteria', 'start_date', 'end_date', 'is_active',
    ];

    protected $casts = [
        'criteria' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function badge(): BelongsTo
    {
        return $this->belongsTo(Badge::class);
    }

    public function userQuests(): HasMany
    {
        return $this->hasMany(UserQuest::class);
    }
}
