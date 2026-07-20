<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyChallenge extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'criteria', 'xp_reward', 'date', 'is_active'];

    protected $casts = [
        'criteria' => 'array',
        'date' => 'date',
        'is_active' => 'boolean',
    ];
}
