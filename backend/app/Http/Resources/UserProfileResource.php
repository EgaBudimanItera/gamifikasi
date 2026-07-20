<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'total_xp' => $this->total_xp,
            'current_level' => $this->current_level,
            'current_streak' => $this->current_streak,
            'longest_streak' => $this->longest_streak,
            'xp_for_next_level' => $this->xpForNextLevel(),
            'xp_progress' => $this->xpProgress(),
            'last_login_at' => $this->last_login_at,
        ];
    }
}
