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

    // Admin Dashboard
    Route::get('dashboard/admin', [\App\Http\Controllers\Api\DashboardController::class, 'admin']);

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

        // Material Reading
        Route::post('materials/{material}/reading/start', [\App\Http\Controllers\Api\MaterialReadingController::class, 'start']);
        Route::post('materials/{material}/reading/heartbeat', [\App\Http\Controllers\Api\MaterialReadingController::class, 'heartbeat']);
        Route::post('materials/{material}/reading/complete', [\App\Http\Controllers\Api\MaterialReadingController::class, 'complete']);
        Route::get('materials/{material}/reading/quiz', [\App\Http\Controllers\Api\MaterialReadingController::class, 'quiz']);
        Route::post('materials/{material}/reading/quiz/submit', [\App\Http\Controllers\Api\MaterialReadingController::class, 'submitQuiz']);
        Route::get('reading/stats', [\App\Http\Controllers\Api\MaterialReadingController::class, 'stats']);
    });

    // Gamification - All Authenticated Users
    Route::get('gamification/profile', [\App\Http\Controllers\Api\GamificationController::class, 'profile']);
    Route::get('gamification/xp-logs', [\App\Http\Controllers\Api\GamificationController::class, 'xpLogs']);
    Route::get('gamification/my-badges', [\App\Http\Controllers\Api\GamificationController::class, 'myBadges']);
    Route::get('gamification/streak', [\App\Http\Controllers\Api\GamificationController::class, 'streak']);
    Route::get('gamification/streak/calendar', [\App\Http\Controllers\Api\GamificationController::class, 'streakCalendar']);
    Route::get('gamification/streak/freeze-status', [\App\Http\Controllers\Api\GamificationController::class, 'freezeStatus']);
    Route::post('gamification/streak/freeze', [\App\Http\Controllers\Api\GamificationController::class, 'useFreeze']);
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

    // League System
    Route::get('league/my', [\App\Http\Controllers\Api\LeagueController::class, 'myLeague']);
    Route::get('league/standings', [\App\Http\Controllers\Api\LeagueController::class, 'standings']);
    Route::get('league/history', [\App\Http\Controllers\Api\LeagueController::class, 'history']);
    Route::get('league/my-standing', [\App\Http\Controllers\Api\LeagueController::class, 'myLeagueStanding']);

    // Guild / Team System
    Route::get('guild/my', [\App\Http\Controllers\Api\GuildController::class, 'myGuild']);
    Route::post('guild', [\App\Http\Controllers\Api\GuildController::class, 'create']);
    Route::post('guild/{guildId}/join', [\App\Http\Controllers\Api\GuildController::class, 'join']);
    Route::post('guild/leave', [\App\Http\Controllers\Api\GuildController::class, 'leave']);
    Route::get('guild/available', [\App\Http\Controllers\Api\GuildController::class, 'available']);
    Route::get('guild/leaderboard', [\App\Http\Controllers\Api\GuildController::class, 'leaderboard']);
    Route::get('guild/{guildId}/members', [\App\Http\Controllers\Api\GuildController::class, 'members']);

    // NPC System
    Route::get('npcs', [\App\Http\Controllers\Api\NpcController::class, 'index']);
    Route::get('npcs/{npc}', [\App\Http\Controllers\Api\NpcController::class, 'show']);
    Route::get('my-npc-affinities', [\App\Http\Controllers\Api\NpcController::class, 'myAffinities']);

    // NPC - Siswa Routes
    Route::middleware('role:siswa,admin')->group(function () {
        Route::post('materials/{material}/npc/encounter', [\App\Http\Controllers\Api\NpcController::class, 'encounter']);
        Route::get('npcs/{npc}/quest', [\App\Http\Controllers\Api\NpcController::class, 'quest']);
        Route::post('npcs/{npc}/quest/complete', [\App\Http\Controllers\Api\NpcController::class, 'completeQuest']);
    });

    // Quick Quiz (League Quiz)
    Route::get('quick-quiz/sessions', [\App\Http\Controllers\Api\LeagueQuizController::class, 'index']);
    Route::get('quick-quiz/sessions/{session}', [\App\Http\Controllers\Api\LeagueQuizController::class, 'show']);
    Route::get('quick-quiz/sessions/{session}/results', [\App\Http\Controllers\Api\LeagueQuizController::class, 'results']);

    Route::middleware('role:guru,admin')->group(function () {
        Route::post('quick-quiz/sessions', [\App\Http\Controllers\Api\LeagueQuizController::class, 'store']);
    });

    Route::middleware('role:siswa')->group(function () {
        Route::post('quick-quiz/sessions/{session}/join', [\App\Http\Controllers\Api\LeagueQuizController::class, 'join']);
        Route::post('quick-quiz/sessions/{session}/submit', [\App\Http\Controllers\Api\LeagueQuizController::class, 'submit']);
    });
});
