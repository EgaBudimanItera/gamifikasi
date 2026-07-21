<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReadingLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'material_id', 'started_at', 'duration_seconds',
        'scroll_depth', 'is_completed', 'xp_earned', 'is_anomaly', 'anomaly_reason',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'is_completed' => 'boolean',
        'is_anomaly' => 'boolean',
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
