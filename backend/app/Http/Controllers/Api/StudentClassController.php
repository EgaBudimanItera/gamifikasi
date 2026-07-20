<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\StudentClass;
use App\Models\XpLog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StudentClassController extends Controller
{
    public function myClasses(Request $request): JsonResponse
    {
        $user = $request->user();

        $enrollments = StudentClass::where('user_id', $user->id)
            ->with(['class.academicYear', 'class.classSubjects.subject', 'class.classSubjects.teacher'])
            ->orderBy('created_at', 'desc')
            ->get();

        $data = $enrollments->map(function ($enrollment) use ($user) {
            $class = $enrollment->class;

            $materials = $class->materials()->where('is_published', true)->get();
            $assignments = $class->assignments()->where('is_published', true)->with('subject')->get();
            $submissions = $user->submissions()
                ->whereIn('assignment_id', $assignments->pluck('id'))
                ->with('assignment.subject', 'grade')
                ->get();

            $assignmentIds = $assignments->pluck('id');
            $xpInClass = XpLog::where('user_id', $user->id)
                ->where('reference_type', 'assignment')
                ->whereIn('reference_id', $assignmentIds)
                ->sum('amount');

            return [
                'class_id' => $class->id,
                'class_name' => $class->name,
                'grade_level' => $class->grade_level,
                'academic_year' => $class->academicYear ? [
                    'id' => $class->academicYear->id,
                    'name' => $class->academicYear->name,
                ] : null,
                'subjects' => $class->classSubjects->map(fn($cs) => [
                    'id' => $cs->subject->id,
                    'name' => $cs->subject->name,
                    'code' => $cs->subject->code,
                    'teacher' => $cs->teacher ? $cs->teacher->name : null,
                    'semester' => $cs->semester,
                ]),
                'materials' => $materials->map(fn($m) => [
                    'id' => $m->id,
                    'title' => $m->title,
                    'subject_id' => $m->subject_id,
                    'semester' => $m->semester,
                    'created_at' => $m->created_at,
                ]),
                'assignments' => $assignments->map(fn($a) => [
                    'id' => $a->id,
                    'title' => $a->title,
                    'subject' => $a->subject ? $a->subject->name : null,
                    'semester' => $a->semester,
                    'due_date' => $a->due_date,
                    'submission' => $submissions->firstWhere('assignment_id', $a->id) ? [
                        'status' => $submissions->firstWhere('assignment_id', $a->id)->status,
                        'score' => $submissions->firstWhere('assignment_id', $a->id)->grade?->score,
                    ] : null,
                ]),
                'xp_total' => (int) $xpInClass,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
