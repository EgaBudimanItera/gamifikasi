<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Gamification\LevelService;

class LevelServiceTest extends TestCase
{
    protected LevelService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new LevelService();
    }

    public function test_level_calculation_with_zero_xp(): void
    {
        $level = $this->service->calculate(0);
        $this->assertEquals(1, $level);
    }

    public function test_level_calculation_with_100_xp(): void
    {
        $level = $this->service->calculate(100);
        $this->assertEquals(2, $level);
    }

    public function test_level_calculation_with_500_xp(): void
    {
        $level = $this->service->calculate(500);
        $this->assertEquals(3, $level);
    }

    public function test_level_calculation_with_1000_xp(): void
    {
        $level = $this->service->calculate(1000);
        $this->assertEquals(4, $level);
    }

    public function test_xp_for_level_1(): void
    {
        $xp = $this->service->xpForLevel(1);
        $this->assertEquals(0, $xp);
    }

    public function test_xp_for_level_2(): void
    {
        $xp = $this->service->xpForLevel(2);
        $this->assertEquals(100, $xp);
    }

    public function test_xp_for_level_3(): void
    {
        $xp = $this->service->xpForLevel(3);
        $this->assertEquals(400, $xp);
    }
}
