<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $mySubmission = null;
        if ($request->user()) {
            $submission = $this->relationLoaded('submissions')
                ? $this->submissions->first()
                : \App\Models\Submission::with('grade')
                    ->where('assignment_id', $this->id)
                    ->where('user_id', $request->user()->id)
                    ->first();

            if ($submission) {
                $mySubmission = [
                    'id' => $submission->id,
                    'status' => $submission->status,
                    'answer_text' => $submission->answer_text,
                    'submitted_at' => $submission->submitted_at,
                    'grade' => $submission->grade ? [
                        'score' => $submission->grade->score,
                        'feedback' => $submission->grade->feedback,
                    ] : null,
                ];
            }
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'subject' => ['name' => $this->subject->name ?? null],
            'semester' => $this->semester,
            'class' => $this->whenLoaded('class', fn() => [
                'id' => $this->class->id,
                'name' => $this->class->name,
            ]),
            'max_score' => $this->max_score,
            'xp_reward' => $this->xp_reward,
            'deadline' => $this->deadline,
            'is_published' => $this->is_published,
            'submissions_count' => $this->whenCounted('submissions'),
            'my_submission' => $mySubmission,
            'created_at' => $this->created_at,
        ];
    }
}
