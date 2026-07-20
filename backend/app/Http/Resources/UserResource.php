<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role->name ?? null,
            'school' => $this->school->name ?? null,
            'avatar' => $this->avatar,
            'created_at' => $this->created_at,
        ];

        if ($this->relationLoaded('teachings')) {
            $data['teachings'] = $this->teachings->map(fn($t) => [
                'class_id' => $t->class_id,
                'class_name' => $t->class->name ?? null,
                'subject_id' => $t->subject_id,
                'subject_name' => $t->subject->name ?? null,
            ]);
        }

        if ($this->relationLoaded('profile')) {
            $data['profile'] = $this->profile;
        }

        return $data;
    }
}
