<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaderboardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'rank' => $this->rank,
            'user_id' => $this->user_id,
            'name' => $this->whenLoaded('user', fn() => $this->user->name),
            'total_xp' => $this->total_xp,
            'level' => $this->whenLoaded('user', fn() => $this->user->profile->current_level ?? 1),
        ];
    }
}
