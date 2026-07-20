<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class League extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'tier', 'order', 'icon', 'color',
        'min_xp', 'max_xp', 'promote_count', 'demote_count',
    ];

    public function userLeagues(): HasMany
    {
        return $this->hasMany(UserLeague::class);
    }
}
