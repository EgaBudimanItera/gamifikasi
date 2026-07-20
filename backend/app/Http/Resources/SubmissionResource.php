<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubmissionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'assignment_id' => $this->assignment_id,
            'user_id' => $this->user_id,
            'student' => [
                'id' => $this->student->id ?? null,
                'name' => $this->student->name ?? null,
            ],
            'file_path' => $this->file_path,
            'answer_text' => $this->answer_text,
            'submitted_at' => $this->submitted_at,
            'status' => $this->status,
            'grade' => [
                'score' => $this->grade->score ?? null,
                'feedback' => $this->grade->feedback ?? null,
                'graded_at' => $this->grade->graded_at ?? null,
            ],
            'created_at' => $this->created_at,
        ];
    }
}
