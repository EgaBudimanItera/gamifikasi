<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\ClassModel;
use App\Models\Grade;
use App\Models\User;
use App\Models\UserBadge;
use App\Models\UserProfile;
use App\Models\UserQuest;
use App\Models\XpLog;
use App\Models\ClassSubject;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function teacher(Request $request): JsonResponse
    {
        $user = $request->user();

        $teachings = ClassSubject::where('user_id', $user->id)
            ->with(['class.academicYear', 'subject'])
            ->get();

        $classIds = $teachings->pluck('class_id')->unique();
        $subjectIds = $teachings->pluck('subject_id')->unique();

        $totalStudents = User::where('role_id', 3)
            ->where('school_id', $user->school_id)
            ->whereHas('studentClasses', fn($q) => $q->whereIn('class_id', $classIds))
            ->count();

        $myAssignments = Assignment::whereIn('subject_id', $subjectIds)
            ->where('user_id', $user->id)
            ->where('is_published', true);

        $activeAssignments = (clone $myAssignments)->count();

        $myMaterials = \App\Models\Material::whereIn('subject_id', $subjectIds)
            ->where('user_id', $user->id)
            ->where('is_published', true)
            ->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_students' => $totalStudents,
                'active_assignments' => $activeAssignments,
                'total_materials' => $myMaterials,
                'teachings' => $teachings->groupBy(fn($t) => $t->class->id)->values()->map(function ($items) {
                    $first = $items->first();
                    return [
                        'class_id' => $first->class_id,
                        'class_name' => $first->class->name,
                        'academic_year' => $first->class->academicYear ? $first->class->academicYear->name : null,
                        'subjects' => $items->map(fn($t) => [
                            'subject_id' => $t->subject->id,
                            'subject_name' => $t->subject->name,
                            'subject_code' => $t->subject->code,
                            'semester' => $t->semester,
                        ]),
                    ];
                }),
            ],
        ]);
    }

    public function student(Request $request): JsonResponse
    {
        $user = $request->user();
        $profile = $user->profile;

        if (!$profile) {
            $profile = UserProfile::create(['user_id' => $user->id]);
        }

        $completedAssignments = $user->submissions()->where('status', 'graded')->count();
        $totalBadges = $user->badges()->count();
        $activeQuests = UserQuest::where('user_id', $user->id)
            ->where('status', 'active')
            ->count();

        $xpBreakdown = XpLog::where('user_id', $user->id)
            ->selectRaw('type, SUM(amount) as total')
            ->groupBy('type')
            ->pluck('total', 'type');

        $classIds = $user->studentClasses()->pluck('class_id');
        $myClasses = ClassModel::whereIn('id', $classIds)->with('academicYear')->get()->map(fn($c) => [
            'class_id' => $c->id,
            'class_name' => $c->name,
            'grade_level' => $c->grade_level,
            'academic_year' => $c->academicYear?->name,
        ]);

        $pendingSubmissions = $user->submissions()->where('status', 'pending')->count();
        $scoreAverage = Grade::whereHas('submission', fn($q) => $q->where('user_id', $user->id))
            ->avg('score') ?? 0;

        return response()->json([
            'success' => true,
            'data' => [
                'profile' => [
                    'total_xp' => $profile->total_xp,
                    'current_level' => $profile->current_level,
                    'current_streak' => $profile->current_streak,
                    'longest_streak' => $profile->longest_streak,
                    'xp_for_next_level' => $profile->xpForNextLevel(),
                    'xp_progress' => $profile->xpProgress(),
                ],
                'xp_breakdown' => [
                    'assignment' => (int) ($xpBreakdown['assignment'] ?? 0),
                    'login' => (int) ($xpBreakdown['login'] ?? 0),
                    'streak' => (int) ($xpBreakdown['streak'] ?? 0),
                    'quest' => (int) ($xpBreakdown['quest'] ?? 0),
                    'penalty' => (int) ($xpBreakdown['penalty'] ?? 0),
                ],
                'my_classes' => $myClasses,
                'completed_assignments' => $completedAssignments,
                'pending_submissions' => $pendingSubmissions,
                'score_average' => round($scoreAverage, 2),
                'total_badges' => $totalBadges,
                'active_quests' => $activeQuests,
            ],
        ]);
    }
}
