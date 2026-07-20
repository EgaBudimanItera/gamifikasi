<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyChallenge extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'criteria', 'xp_reward', 'week_start', 'week_end', 'is_active'];

    protected $casts = [
        'criteria' => 'array',
        'week_start' => 'date',
        'week_end' => 'date',
        'is_active' => 'boolean',
    ];
}
