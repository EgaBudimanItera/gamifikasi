<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\Models\Badge;
use App\Models\Notification;
use App\Models\UserBadge;
use App\Models\UserProfile;
use App\Models\UserQuest;
use App\Models\XpLog;
use App\Services\Gamification\StreakService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GamificationController extends Controller
{
    protected StreakService $streakService;

    public function __construct(StreakService $streakService)
    {
        $this->streakService = $streakService;
    }

    public function profile(Request $request): JsonResponse
    {
        $profile = $request->user()->profile;

        if (!$profile) {
            $profile = UserProfile::create(['user_id' => $request->user()->id]);
        }

        return response()->json([
            'success' => true,
            'data' => new UserProfileResource($profile),
        ]);
    }

    public function xpLogs(Request $request): JsonResponse
    {
        $logs = XpLog::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $logs,
        ]);
    }

    public function myBadges(Request $request): JsonResponse
    {
        $badges = UserBadge::with('badge')
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $badges,
        ]);
    }

    public function streak(Request $request): JsonResponse
    {
        $profile = $request->user()->profile;

        return response()->json([
            'success' => true,
            'data' => [
                'current_streak' => $profile->current_streak ?? 0,
                'longest_streak' => $profile->longest_streak ?? 0,
            ],
        ]);
    }

    public function streakCalendar(Request $request): JsonResponse
    {
        $calendar = $this->streakService->getStreakCalendar($request->user());

        return response()->json([
            'success' => true,
            'data' => $calendar,
        ]);
    }

    public function useFreeze(Request $request): JsonResponse
    {
        $result = $this->streakService->useFreeze($request->user());

        return response()->json([
            'success' => $result['success'],
            'message' => $result['message'],
            'data' => [
                'streak' => $result['streak'] ?? null,
            ],
        ]);
    }

    public function freezeStatus(Request $request): JsonResponse
    {
        $status = $this->streakService->getFreezeStatus($request->user());

        return response()->json([
            'success' => true,
            'data' => $status,
        ]);
    }

    public function checkIn(Request $request): JsonResponse
    {
        $result = $this->streakService->checkIn($request->user());

        return response()->json([
            'success' => true,
            'message' => $result['message'],
            'data' => [
                'current_streak' => $result['streak'],
                'xp_earned' => $result['xp_earned'] ?? 0,
            ],
        ]);
    }

    public function myQuests(Request $request): JsonResponse
    {
        $quests = UserQuest::with('quest')
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $quests,
        ]);
    }

    public function notifications(Request $request): JsonResponse
    {
        $notifications = Notification::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $notifications,
        ]);
    }

    public function markNotificationRead(Notification $notification): JsonResponse
    {
        $notification->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi ditandai sudah dibaca',
        ]);
    }

    public function markAllNotificationsRead(Request $request): JsonResponse
    {
        Notification::where('user_id', $request->user()->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Semua notifikasi ditandai sudah dibaca',
        ]);
    }
}
