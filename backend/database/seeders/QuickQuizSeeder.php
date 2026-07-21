<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuickQuizSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Session 1: Class Quiz (Matematika, VII A, active)
        $sessionId1 = DB::table('league_quiz_sessions')->insertGetId([
            'created_by'       => 2, // Putri Oktaria
            'title'            => 'Kuis Cepat Matematika VII-A',
            'mode'             => 'class',
            'class_id'         => 2, // VII A
            'guild_id'         => null,
            'duration_minutes' => 5,
            'questions_count'  => 5,
            'difficulty'       => 'easy',
            'pass_threshold'   => 60,
            'xp_reward'        => 30,
            'status'           => 'completed',
            'starts_at'        => $now->copy()->subHour(),
            'ends_at'          => $now->copy()->subMinutes(30),
            'created_at'       => $now->copy()->subHour(),
            'updated_at'       => $now,
        ]);

        // Pick 5 easy/medium questions from Kak Angka (npc_id=2)
        $mathQuests = DB::table('npc_quests')
            ->where('npc_id', 2)
            ->whereIn('difficulty', ['easy', 'medium'])
            ->limit(5)
            ->get();

        $order = 1;
        foreach ($mathQuests as $q) {
            DB::table('league_quiz_questions')->insert([
                'session_id'     => $sessionId1,
                'npc_quest_id'   => $q->id,
                'question'       => $q->question,
                'options'        => $q->options,
                'correct_answer' => $q->correct_answer,
                'difficulty'     => $q->difficulty,
                'order'          => $order++,
                'created_at'     => $now, 'updated_at' => $now,
            ]);
        }

        $this->insertParticipant($sessionId1, 3, $mathQuests, $now);  // Budi
        $this->insertParticipant($sessionId1, 4, $mathQuests, $now, 3); // Siti
        $this->insertParticipant($sessionId1, 5, $mathQuests, $now, 2); // Adi

        // Session 2: Guild Quiz (active, Penjelajah Ilmu, in progress)
        $sessionId2 = DB::table('league_quiz_sessions')->insertGetId([
            'created_by'       => 2, // Putri Oktaria
            'title'            => 'Guild Challenge: Bhs Indonesia',
            'mode'             => 'guild',
            'class_id'         => null,
            'guild_id'         => 1, // Penjelajah Ilmu
            'duration_minutes' => 15,
            'questions_count'  => 4,
            'difficulty'       => 'hard',
            'pass_threshold'   => 60,
            'xp_reward'        => 75,
            'status'           => 'active',
            'starts_at'        => $now->copy()->subMinutes(10),
            'ends_at'          => $now->copy()->addMinutes(5),
            'created_at'       => $now->copy()->subMinutes(10),
            'updated_at'       => $now,
        ]);

        // Pick 10 hard/legendary questions from Kak Sastra (npc_id=3)
        $langQuests = DB::table('npc_quests')
            ->where('npc_id', 3)
            ->whereIn('difficulty', ['hard', 'legendary'])
            ->limit(10)
            ->get();

        $order = 1;
        foreach ($langQuests as $q) {
            DB::table('league_quiz_questions')->insert([
                'session_id'     => $sessionId2,
                'npc_quest_id'   => $q->id,
                'question'       => $q->question,
                'options'        => $q->options,
                'correct_answer' => $q->correct_answer,
                'difficulty'     => $q->difficulty,
                'order'          => $order++,
                'created_at'     => $now, 'updated_at' => $now,
            ]);
        }

        // Andi joined but not yet submitted
        DB::table('league_quiz_participants')->insert([
            'session_id'     => $sessionId2,
            'user_id'        => 11, // Andi
            'answers'        => null,
            'correct_count'  => 0,
            'total_questions'=> 4,
            'xp_earned'      => 0,
            'started_at'     => $now->copy()->subMinutes(8),
            'completed_at'   => null,
            'status'         => 'in_progress',
            'created_at'     => $now->copy()->subMinutes(8), 'updated_at' => $now,
        ]);

        $this->command->info("QuickQuizSeeder: 2 sessions seeded (math: {$sessionId1}, lang: {$sessionId2})");
    }

    protected function insertParticipant(
        int $sessionId,
        int $userId,
        $quests,
        $now,
        ?int $correctCount = null
    ): void {
        $total = $quests->count();
        $correct = $correctCount ?? $total;

        $answers = [];
        $i = 0;
        foreach ($quests as $q) {
            $answers[$q->id] = $i < $correct ? $q->correct_answer : 'Jawaban Salah';
            $i++;
        }

        $passThreshold = DB::table('league_quiz_sessions')->where('id', $sessionId)->value('pass_threshold');
        $xpReward = DB::table('league_quiz_sessions')->where('id', $sessionId)->value('xp_reward');
        $passPct = $total > 0 ? ($correct / $total) * 100 : 0;
        $xp = $passPct >= $passThreshold ? $xpReward : 0;

        DB::table('league_quiz_participants')->insert([
            'session_id'     => $sessionId,
            'user_id'        => $userId,
            'answers'        => json_encode($answers),
            'correct_count'  => $correct,
            'total_questions'=> $total,
            'xp_earned'      => $xp,
            'started_at'     => $now->copy()->subMinutes(45),
            'completed_at'   => $now->copy()->subMinutes(40),
            'status'         => 'completed',
            'created_at'     => $now->copy()->subMinutes(45), 'updated_at' => $now,
        ]);
    }
}
