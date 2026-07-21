<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Gamification\MaterialReadingService;
use App\Services\Gamification\XpService;
use App\Models\User;
use App\Models\Material;
use App\Models\UserProfile;
use App\Models\Role;
use App\Models\ReadingLog;
use App\Models\ReadingQuiz;

class MaterialReadingServiceTest extends TestCase
{
    protected MaterialReadingService $service;
    protected User $user;
    protected Material $material;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new MaterialReadingService(new XpService());

        $this->user = User::factory()->create();
        $role = Role::where('name', 'siswa')->first();
        $this->user->update(['role_id' => $role->id]);

        UserProfile::create([
            'user_id' => $this->user->id,
            'total_xp' => 0,
            'current_level' => 1,
        ]);

        $this->material = Material::create([
            'subject_id' => 1,
            'user_id' => 2,
            'title' => 'Test Material',
            'content' => 'Test content for reading',
            'is_published' => true,
        ]);
    }

    public function test_start_reading_creates_log(): void
    {
        $log = $this->service->startReading($this->user, $this->material);

        $this->assertNotNull($log);
        $this->assertEquals($this->user->id, $log->user_id);
        $this->assertEquals($this->material->id, $log->material_id);
        $this->assertNull($log->duration_seconds);
    }

    public function test_start_reading_reuses_existing_incomplete_log(): void
    {
        $log1 = $this->service->startReading($this->user, $this->material);
        $log2 = $this->service->startReading($this->user, $this->material);

        $this->assertEquals($log1->id, $log2->id);
    }

    public function test_complete_reading_awards_xp(): void
    {
        $result = $this->service->completeReading($this->user, $this->material, 100, 300);

        $this->assertArrayHasKey('total_xp', $result);
        $this->assertGreaterThan(0, $result['total_xp']);
        $this->assertArrayHasKey('xp_breakdown', $result);
    }

    public function test_complete_reading_first_time_gives_first_read_bonus(): void
    {
        $result = $this->service->completeReading($this->user, $this->material, 100, 300);

        $this->assertArrayHasKey('first_read_bonus', $result['xp_breakdown']);
        $this->assertEquals(20, $result['xp_breakdown']['first_read_bonus']);
    }

    public function test_complete_reading_anomaly_detected(): void
    {
        $result = $this->service->completeReading($this->user, $this->material, 100, 5);

        $this->assertTrue($result['is_anomaly']);
        $this->assertNotEmpty($result['anomaly_reasons']);
    }

    public function test_get_quiz_returns_questions(): void
    {
        ReadingQuiz::create([
            'material_id' => $this->material->id,
            'question' => 'Test question?',
            'options' => ['A', 'B', 'C', 'D'],
            'correct_answer' => 'A',
            'difficulty' => 'easy',
        ]);

        $quizzes = $this->service->getQuiz($this->material);

        $this->assertIsArray($quizzes);
        $this->assertNotEmpty($quizzes);
    }

    public function test_submit_quiz_passes(): void
    {
        $quiz = ReadingQuiz::create([
            'material_id' => $this->material->id,
            'question' => 'Test question?',
            'options' => ['A', 'B', 'C', 'D'],
            'correct_answer' => 'A',
            'difficulty' => 'easy',
        ]);

        $result = $this->service->submitQuiz($this->user, $this->material, [
            $quiz->id => 'A',
        ]);

        $this->assertArrayHasKey('passed', $result);
        $this->assertArrayHasKey('xp_earned', $result);
    }

    public function test_get_reading_stats(): void
    {
        $stats = $this->service->getReadingStats($this->user);

        $this->assertArrayHasKey('total_materials_read', $stats);
        $this->assertArrayHasKey('total_xp_earned', $stats);
        $this->assertArrayHasKey('total_reading_time_seconds', $stats);
        $this->assertEquals(0, $stats['total_materials_read']);
    }
}
