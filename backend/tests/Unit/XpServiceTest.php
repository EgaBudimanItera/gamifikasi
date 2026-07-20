<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Gamification\XpService;

class XpServiceTest extends TestCase
{
    protected XpService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new XpService();
    }

    public function test_xp_award_increases_total(): void
    {
        $user = \App\Models\User::factory()->create();
        $role = \App\Models\Role::where('name', 'siswa')->first();
        $user->update(['role_id' => $role->id]);

        \App\Models\UserProfile::create(['user_id' => $user->id, 'total_xp' => 0, 'current_level' => 1]);

        $result = $this->service->award($user, 50, 'assignment', 'Test assignment');

        $this->assertEquals(50, $result['xp_earned']);
        $this->assertEquals(50, $result['total_xp']);
    }

    public function test_xp_deduct_decreases_total(): void
    {
        $user = \App\Models\User::factory()->create();
        $role = \App\Models\Role::where('name', 'siswa')->first();
        $user->update(['role_id' => $role->id]);

        \App\Models\UserProfile::create(['user_id' => $user->id, 'total_xp' => 100, 'current_level' => 2]);

        $result = $this->service->deduct($user, 30, 'Test penalty');

        $this->assertEquals(30, $result['xp_deducted']);
        $this->assertEquals(70, $result['total_xp']);
    }

    public function test_get_total_xp(): void
    {
        $user = \App\Models\User::factory()->create();
        $role = \App\Models\Role::where('name', 'siswa')->first();
        $user->update(['role_id' => $role->id]);

        \App\Models\UserProfile::create(['user_id' => $user->id, 'total_xp' => 250, 'current_level' => 2]);

        $totalXp = $this->service->getTotalXp($user);

        $this->assertEquals(250, $totalXp);
    }
}
