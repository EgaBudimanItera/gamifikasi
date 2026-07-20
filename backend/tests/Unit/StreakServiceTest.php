<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Gamification\StreakService;
use App\Services\Gamification\XpService;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Role;

class StreakServiceTest extends TestCase
{
    protected StreakService $streakService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->streakService = app(StreakService::class);
    }

    protected function createStudent(): User
    {
        $user = User::factory()->create();
        $role = Role::where('name', 'siswa')->first();
        $user->update(['role_id' => $role->id]);
        UserProfile::create(['user_id' => $user->id, 'total_xp' => 0, 'current_level' => 1, 'current_streak' => 0, 'longest_streak' => 0]);
        return $user;
    }

    public function test_checkin_increments_streak(): void
    {
        $user = $this->createStudent();

        $result = $this->streakService->checkIn($user);

        $this->assertArrayHasKey('streak', $result);
        $this->assertEquals(1, $result['streak']);
    }

    public function test_checkin_awards_daily_xp(): void
    {
        $user = $this->createStudent();

        $result = $this->streakService->checkIn($user);

        $this->assertGreaterThan(0, $result['xp_earned']);
    }

    public function test_double_checkin_returns_same_streak(): void
    {
        $user = $this->createStudent();

        $result1 = $this->streakService->checkIn($user);
        $result2 = $this->streakService->checkIn($user);

        $this->assertEquals($result1['streak'], $result2['streak']);
    }
}
