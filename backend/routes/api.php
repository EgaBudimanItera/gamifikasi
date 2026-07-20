<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Public Routes
Route::post('/auth/login', [LoginController::class, 'login']);
Route::post('/auth/register', function () {
    return response()->json(['message' => 'Register hanya melalui admin'], 403);
});

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [LoginController::class, 'logout']);
    Route::get('/auth/user', [LoginController::class, 'user']);

    // Admin Only Routes
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('users', \App\Http\Controllers\Api\UserController::class);
        Route::apiResource('schools', \App\Http\Controllers\Api\SchoolController::class);
        Route::apiResource('academic-years', \App\Http\Controllers\Api\AcademicYearController::class);
        Route::apiResource('classes', \App\Http\Controllers\Api\ClassController::class);
        Route::get('classes/{class}/students', [\App\Http\Controllers\Api\ClassController::class, 'students']);
        Route::get('classes/{class}/subjects', [\App\Http\Controllers\Api\ClassSubjectController::class, 'classSubjects']);
        Route::apiResource('subjects', \App\Http\Controllers\Api\SubjectController::class);
        Route::apiResource('class-subject-assignments', \App\Http\Controllers\Api\ClassSubjectController::class);
        Route::apiResource('quests', \App\Http\Controllers\Api\QuestController::class)->except('index', 'show');
        Route::get('activity-logs', [\App\Http\Controllers\Api\ActivityController::class, 'index']);
    });

    // Guru Routes
    Route::middleware('role:guru,admin')->group(function () {
        Route::apiResource('materials', \App\Http\Controllers\Api\MaterialController::class)->except(['index', 'show']);
        Route::post('materials/{material}/publish', [\App\Http\Controllers\Api\MaterialController::class, 'publish']);
        Route::apiResource('assignments', \App\Http\Controllers\Api\AssignmentController::class)->except(['index', 'show']);
        Route::post('submissions/{submission}/grade', [\App\Http\Controllers\Api\SubmissionController::class, 'grade']);
        Route::get('dashboard/teacher', [\App\Http\Controllers\Api\DashboardController::class, 'teacher']);
        Route::get('my-subjects', [\App\Http\Controllers\Api\ClassSubjectController::class, 'mySubjects']);
    });

    // Submissions - accessible by all (controller filters by role)
    Route::get('assignments/{assignment}/submissions', [\App\Http\Controllers\Api\SubmissionController::class, 'index']);

    // Materials & Assignments - All Users (read)
    Route::get('materials', [\App\Http\Controllers\Api\MaterialController::class, 'index']);
    Route::get('materials/{material}', [\App\Http\Controllers\Api\MaterialController::class, 'show']);
    Route::get('assignments', [\App\Http\Controllers\Api\AssignmentController::class, 'index']);
    Route::get('assignments/{assignment}', [\App\Http\Controllers\Api\AssignmentController::class, 'show']);

    // Siswa Routes
    Route::middleware('role:siswa,admin')->group(function () {
        Route::post('assignments/{assignment}/submissions', [\App\Http\Controllers\Api\SubmissionController::class, 'store']);
        Route::get('submissions/{submission}', [\App\Http\Controllers\Api\SubmissionController::class, 'show']);
        Route::post('submissions/{submission}/revise', [\App\Http\Controllers\Api\SubmissionController::class, 'revise']);
        Route::get('dashboard/student', [\App\Http\Controllers\Api\DashboardController::class, 'student']);
        Route::get('my-classes', [\App\Http\Controllers\Api\StudentClassController::class, 'myClasses']);
    });

    // Gamification - All Authenticated Users
    Route::get('gamification/profile', [\App\Http\Controllers\Api\GamificationController::class, 'profile']);
    Route::get('gamification/xp-logs', [\App\Http\Controllers\Api\GamificationController::class, 'xpLogs']);
    Route::get('gamification/my-badges', [\App\Http\Controllers\Api\GamificationController::class, 'myBadges']);
    Route::get('gamification/streak', [\App\Http\Controllers\Api\GamificationController::class, 'streak']);
    Route::post('gamification/streak/check-in', [\App\Http\Controllers\Api\GamificationController::class, 'checkIn']);
    Route::get('gamification/my-quests', [\App\Http\Controllers\Api\GamificationController::class, 'myQuests']);

    // Badges & Quests
    Route::get('badges', [\App\Http\Controllers\Api\BadgeController::class, 'index']);
    Route::get('badges/{badge}', [\App\Http\Controllers\Api\BadgeController::class, 'show']);
    Route::get('quests', [\App\Http\Controllers\Api\QuestController::class, 'index']);
    Route::get('quests/{quest}', [\App\Http\Controllers\Api\QuestController::class, 'show']);
    Route::post('quests/{quest}/accept', [\App\Http\Controllers\Api\QuestController::class, 'accept']);

    // Leaderboard
    Route::get('leaderboard/class/{classId}', [\App\Http\Controllers\Api\LeaderboardController::class, 'classLeaderboard']);
    Route::get('leaderboard/school', [\App\Http\Controllers\Api\LeaderboardController::class, 'schoolLeaderboard']);

    // Notifications
    Route::get('notifications', [\App\Http\Controllers\Api\GamificationController::class, 'notifications']);
    Route::put('notifications/{notification}/read', [\App\Http\Controllers\Api\GamificationController::class, 'markNotificationRead']);
    Route::put('notifications/read-all', [\App\Http\Controllers\Api\GamificationController::class, 'markAllNotificationsRead']);

    // Challenges
    Route::get('challenges/daily', [\App\Http\Controllers\Api\ChallengeController::class, 'daily']);
    Route::get('challenges/weekly', [\App\Http\Controllers\Api\ChallengeController::class, 'weekly']);
});
