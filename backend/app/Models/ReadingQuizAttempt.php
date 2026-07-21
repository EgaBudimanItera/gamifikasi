<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReadingQuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'material_id', 'total_questions', 'correct_answers',
        'passed', 'xp_earned',
    ];

    protected $casts = [
        'passed' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
