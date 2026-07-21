<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Gamification\LeagueQuizService;
use App\Services\Gamification\XpService;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Role;
use App\Models\LeagueQuizSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LeagueQuizServiceTest extends TestCase
{
    protected LeagueQuizService $service;
    protected User $user;
    protected User $teacher;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new LeagueQuizService(new XpService());

        $roleSiswa = Role::where('name', 'siswa')->first();
        $roleGuru = Role::where('name', 'guru')->first();

        $this->teacher = User::factory()->create(['role_id' => $roleGuru->id]);

        $this->user = User::factory()->create(['role_id' => $roleSiswa->id]);
        UserProfile::create([
            'user_id' => $this->user->id,
            'total_xp' => 0,
            'current_level' => 1,
        ]);
    }

    protected function seedNpcQuests(int $count, string $difficulty): int
    {
        $npcId = DB::table('npcs')->insertGetId([
            'subject_id' => 2,
            'name' => 'Test NPC ' . Str::random(5),
            'personality' => 'friendly',
            'dialogs' => json_encode(['greeting' => 'Halo!']),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($i = 0; $i < $count; $i++) {
            DB::table('npc_quests')->insert([
                'npc_id' => $npcId,
                'question' => "Soal {$difficulty} nomor {$i}?",
                'options' => json_encode(["Jawaban A {$i}", "Jawaban B {$i}", "Jawaban C {$i}", "Jawaban D {$i}"]),
                'correct_answer' => "Jawaban A {$i}",
                'difficulty' => $difficulty,
                'xp_reward' => 10,
                'required_affinity_level' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $npcId;
    }

    public function test_create_class_session(): void
    {
        $this->seedNpcQuests(10, 'easy');

        $session = $this->service->createSession($this->teacher, [
            'title' => 'Quiz Matematika',
            'mode' => 'class',
            'class_id' => 2,
            'duration_minutes' => 5,
            'questions_count' => 5,
        ]);

        $this->assertEquals('Quiz Matematika', $session->title);
        $this->assertEquals('class', $session->mode);
        $this->assertEquals(5, $session->duration_minutes);
        $this->assertEquals('active', $session->status);
        $this->assertEquals(5, $session->questions()->count());
    }

    public function test_create_guild_session(): void
    {
        $this->seedNpcQuests(15, 'hard');

        $session = $this->service->createSession($this->teacher, [
            'title' => 'Guild Challenge',
            'mode' => 'guild',
            'guild_id' => 1,
            'duration_minutes' => 15,
            'questions_count' => 10,
        ]);

        $this->assertEquals(15, $session->duration_minutes);
        $this->assertEquals(75, $session->xp_reward);
        $this->assertEquals(10, $session->questions()->count());
    }

    public function test_auto_pick_easy_questions(): void
    {
        $this->seedNpcQuests(15, 'easy');

        $session = $this->service->createSession($this->teacher, [
            'title' => 'Quiz Easy',
            'mode' => 'class',
            'questions_count' => 5,
            'difficulty' => 'easy',
        ]);

        $questions = $session->questions()->get();
        foreach ($questions as $q) {
            $this->assertContains($q->difficulty, ['easy', 'medium']);
        }
    }

    public function test_auto_pick_hard_questions(): void
    {
        $this->seedNpcQuests(15, 'hard');

        $session = $this->service->createSession($this->teacher, [
            'title' => 'Quiz Hard',
            'mode' => 'guild',
            'questions_count' => 5,
            'difficulty' => 'hard',
        ]);

        $questions = $session->questions()->get();
        foreach ($questions as $q) {
            $this->assertContains($q->difficulty, ['hard', 'legendary']);
        }
    }

    public function test_join_session_returns_questions_without_answers(): void
    {
        $this->seedNpcQuests(5, 'easy');
        $session = $this->service->createSession($this->teacher, [
            'title' => 'Test',
            'mode' => 'class',
            'questions_count' => 5,
        ]);

        $result = $this->service->joinSession($this->user, $session);

        $this->assertCount(5, $result['questions']);
        foreach ($result['questions'] as $q) {
            $this->assertArrayNotHasKey('correct_answer', $q);
            $this->assertArrayHasKey('options', $q);
        }
        $this->assertArrayHasKey('session', $result);
        $this->assertEquals($session->id, $result['session']['id']);
    }

    public function test_cannot_join_twice(): void
    {
        $this->seedNpcQuests(5, 'easy');
        $session = $this->service->createSession($this->teacher, [
            'title' => 'Test',
            'mode' => 'class',
            'questions_count' => 5,
        ]);

        $this->service->joinSession($this->user, $session);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Kamu sudah bergabung');
        $this->service->joinSession($this->user, $session);
    }

    public function test_cannot_join_expired_session(): void
    {
        $this->seedNpcQuests(5, 'easy');
        $session = $this->service->createSession($this->teacher, [
            'title' => 'Test',
            'mode' => 'class',
            'questions_count' => 5,
            'starts_at' => now()->subHour(),
            'ends_at' => now()->subMinutes(30),
        ]);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Sesi quiz sudah berakhir');
        $this->service->joinSession($this->user, $session);
    }

    public function test_submit_correct_answers_earns_xp(): void
    {
        $this->seedNpcQuests(5, 'easy');
        $session = $this->service->createSession($this->teacher, [
            'title' => 'Test',
            'mode' => 'class',
            'questions_count' => 5,
            'xp_reward' => 30,
            'pass_threshold' => 60,
        ]);

        $this->service->joinSession($this->user, $session);

        $questions = $session->questions()->get();
        $answers = [];
        foreach ($questions as $q) {
            $answers[$q->id] = $q->correct_answer;
        }

        $result = $this->service->submitAnswer($this->user, $session, $answers);

        $this->assertEquals(5, $result['correct_count']);
        $this->assertEquals(5, $result['total_questions']);
        $this->assertEquals(100.0, $result['pass_percentage']);
        $this->assertTrue($result['passed']);
        $this->assertEquals(30, $result['xp_earned']);
        $this->assertEquals('completed', $result['status']);
    }

    public function test_submit_wrong_answers_earns_no_xp(): void
    {
        $this->seedNpcQuests(5, 'easy');
        $session = $this->service->createSession($this->teacher, [
            'title' => 'Test',
            'mode' => 'class',
            'questions_count' => 5,
            'xp_reward' => 30,
            'pass_threshold' => 60,
        ]);

        $this->service->joinSession($this->user, $session);

        $questions = $session->questions()->get();
        $answers = [];
        foreach ($questions as $q) {
            $answers[$q->id] = 'Jawaban Yang Salah Sekali';
        }

        $result = $this->service->submitAnswer($this->user, $session, $answers);

        $this->assertEquals(0, $result['correct_count']);
        $this->assertFalse($result['passed']);
        $this->assertEquals(0, $result['xp_earned']);
    }

    public function test_cannot_submit_twice(): void
    {
        $this->seedNpcQuests(5, 'easy');
        $session = $this->service->createSession($this->teacher, [
            'title' => 'Test',
            'mode' => 'class',
            'questions_count' => 5,
        ]);

        $this->service->joinSession($this->user, $session);

        $questions = $session->questions()->get();
        $answers = [];
        foreach ($questions as $q) {
            $answers[$q->id] = $q->correct_answer;
        }

        $this->service->submitAnswer($this->user, $session, $answers);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Kamu sudah submit jawaban');
        $this->service->submitAnswer($this->user, $session, $answers);
    }

    public function test_session_results_ranking(): void
    {
        $this->seedNpcQuests(5, 'easy');
        $session = $this->service->createSession($this->teacher, [
            'title' => 'Test',
            'mode' => 'class',
            'questions_count' => 5,
        ]);

        $user2 = User::factory()->create(['role_id' => Role::where('name', 'siswa')->first()->id]);
        UserProfile::create(['user_id' => $user2->id, 'total_xp' => 0, 'current_level' => 1]);

        $this->service->joinSession($this->user, $session);
        $this->service->joinSession($user2, $session);

        $questions = $session->questions()->get();

        $answers1 = [];
        foreach ($questions as $q) {
            $answers1[$q->id] = $q->correct_answer;
        }
        $this->service->submitAnswer($this->user, $session, $answers1);

        $answers2 = [];
        foreach ($questions as $q) {
            $answers2[$q->id] = 'Salah';
        }
        $firstQ = $questions->first();
        $answers2[$firstQ->id] = $firstQ->correct_answer;
        $this->service->submitAnswer($user2, $session, $answers2);

        $results = $this->service->getSessionResults($session);

        $this->assertCount(2, $results['ranking']);
        $this->assertEquals($this->user->id, $results['ranking'][0]['user_id']);
        $this->assertEquals(1, $results['ranking'][0]['rank']);
    }
}
