<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamificationSeeder extends Seeder
{
    public function run(): void
    {
        $now = \Carbon\Carbon::now();

        // =================================================================
        // 1. USER PROFILES (20 siswa VII SMP)
        // =================================================================
        $profiles = [
            // VII A (class_id=2)
            ['user_id' => 3,  'total_xp' => 2850, 'current_level' => 6, 'current_streak' => 12, 'longest_streak' => 21],
            ['user_id' => 4,  'total_xp' => 1820, 'current_level' => 5, 'current_streak' => 7,  'longest_streak' => 14],
            ['user_id' => 5,  'total_xp' => 950,  'current_level' => 4, 'current_streak' => 3,  'longest_streak' => 8],
            ['user_id' => 11, 'total_xp' => 3200, 'current_level' => 7, 'current_streak' => 15, 'longest_streak' => 25],
            ['user_id' => 12, 'total_xp' => 1150, 'current_level' => 4, 'current_streak' => 4,  'longest_streak' => 10],
            ['user_id' => 13, 'total_xp' => 680,  'current_level' => 3, 'current_streak' => 2,  'longest_streak' => 5],
            ['user_id' => 14, 'total_xp' => 450,  'current_level' => 3, 'current_streak' => 6,  'longest_streak' => 6],
            ['user_id' => 15, 'total_xp' => 280,  'current_level' => 2, 'current_streak' => 1,  'longest_streak' => 3],
            ['user_id' => 23, 'total_xp' => 150,  'current_level' => 2, 'current_streak' => 0,  'longest_streak' => 2],
            ['user_id' => 24, 'total_xp' => 75,   'current_level' => 1, 'current_streak' => 1,  'longest_streak' => 1],
            // VII B (class_id=3)
            ['user_id' => 6,  'total_xp' => 520,  'current_level' => 3, 'current_streak' => 5,  'longest_streak' => 5],
            ['user_id' => 7,  'total_xp' => 380,  'current_level' => 2, 'current_streak' => 2,  'longest_streak' => 4],
            ['user_id' => 8,  'total_xp' => 120,  'current_level' => 2, 'current_streak' => 1,  'longest_streak' => 3],
            ['user_id' => 16, 'total_xp' => 2100, 'current_level' => 5, 'current_streak' => 10, 'longest_streak' => 18],
            ['user_id' => 17, 'total_xp' => 850,  'current_level' => 3, 'current_streak' => 3,  'longest_streak' => 7],
            ['user_id' => 18, 'total_xp' => 1350, 'current_level' => 4, 'current_streak' => 8,  'longest_streak' => 12],
            ['user_id' => 19, 'total_xp' => 300,  'current_level' => 2, 'current_streak' => 1,  'longest_streak' => 2],
            ['user_id' => 20, 'total_xp' => 600,  'current_level' => 3, 'current_streak' => 4,  'longest_streak' => 6],
            ['user_id' => 21, 'total_xp' => 180,  'current_level' => 2, 'current_streak' => 0,  'longest_streak' => 1],
            ['user_id' => 22, 'total_xp' => 50,   'current_level' => 1, 'current_streak' => 0,  'longest_streak' => 1],
        ];

        foreach ($profiles as $p) {
            DB::table('user_profiles')->insert(array_merge($p, [
                'last_login_at' => $now,
                'created_at'    => now()->subMonths(3),
                'updated_at'    => $now,
            ]));
        }

        $profileMap = [];
        foreach (DB::table('user_profiles')->get() as $pf) {
            $profileMap[$pf->user_id] = $pf->id;
        }

        // =================================================================
        // 2. XP LOGS — updated for class VII SMP subjects
        // =================================================================
        $xpLogs = [
            // --- Andi (id=11, 3200 XP — #1) ---
            11 => [
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Analisis Teks Eksposisi',    'days_ago' => 27],
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Bilangan Bulat',               'days_ago' => 17],
                ['amount' => 75,  'type' => 'assignment', 'description' => 'Tugas Persamaan Linear',            'days_ago' => 6],
                ['amount' => 20,  'type' => 'assignment', 'description' => 'Bonus early submission',             'days_ago' => 6],
                ['amount' => 60,  'type' => 'assignment', 'description' => 'Tugas Greetings Dialogue',          'days_ago' => 15],
                ['amount' => 60,  'type' => 'assignment', 'description' => 'Tugas Simple Present Tense',        'days_ago' => 3],
                ['amount' => 75,  'type' => 'assignment', 'description' => 'Tugas Diagram Organ Tubuh',         'days_ago' => 4],
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Pengenalan Komputer',         'days_ago' => 1],
            ],
            // --- Budi (id=3, 2850 XP — #2) ---
            3 => [
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Analisis Teks Eksposisi',    'days_ago' => 25],
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Bilangan Bulat',               'days_ago' => 18],
                ['amount' => 75,  'type' => 'assignment', 'description' => 'Tugas Greetings Dialogue',          'days_ago' => 12],
                ['amount' => 20,  'type' => 'assignment', 'description' => 'Bonus early submission',             'days_ago' => 12],
                ['amount' => 60,  'type' => 'assignment', 'description' => 'Tugas Diagram Organ Tubuh',         'days_ago' => 5],
                ['amount' => 60,  'type' => 'assignment', 'description' => 'Tugas Persamaan Linear',            'days_ago' => 3],
                ['amount' => -50, 'type' => 'penalty',    'description' => 'Terlambat submit tugas',             'days_ago' => 6],
            ],
            // --- Siti (id=4, 1820 XP — #3) ---
            4 => [
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Analisis Teks Eksposisi',    'days_ago' => 22],
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Bilangan Bulat dan Pecahan',  'days_ago' => 15],
                ['amount' => 75,  'type' => 'assignment', 'description' => 'Tugas Persamaan Linear',            'days_ago' => 6],
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Peta Keberagaman',            'days_ago' => 2],
                ['amount' => 60,  'type' => 'assignment', 'description' => 'Tugas Diagram Organ Tubuh',         'days_ago' => 1],
            ],
            // --- Yoga (id=16, 2100 XP — #4) ---
            16 => [
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Analisis Puisi',              'days_ago' => 20],
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Statistika',                  'days_ago' => 12],
                ['amount' => 40,  'type' => 'assignment', 'description' => 'Tugas Rantai Makanan',              'days_ago' => 7],
                ['amount' => 20,  'type' => 'assignment', 'description' => 'Bonus early submission',             'days_ago' => 7],
            ],
            // --- Novi (id=18, 1350 XP) ---
            18 => [
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Analisis Puisi',              'days_ago' => 19],
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Statistika',                  'days_ago' => 11],
                ['amount' => 40,  'type' => 'assignment', 'description' => 'Tugas Rantai Makanan',              'days_ago' => 5],
            ],
            // --- Maya (id=12, 1150 XP) ---
            12 => [
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Analisis Teks Eksposisi',    'days_ago' => 20],
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Menulis Teks Deskripsi',      'days_ago' => 14],
                ['amount' => 75,  'type' => 'assignment', 'description' => 'Tugas Diagram Organ Tubuh',         'days_ago' => 4],
            ],
            // --- Adi (id=5, 950 XP) ---
            5 => [
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Menulis Teks Deskripsi',      'days_ago' => 20],
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Membuat Dokumen Sederhana',   'days_ago' => 8],
            ],
            // --- Angga (id=17, 850 XP) ---
            17 => [
                ['amount' => 40,  'type' => 'assignment', 'description' => 'Tugas Analisis Puisi',              'days_ago' => 16],
            ],
            // --- Rizky (id=13, 680 XP) ---
            13 => [
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Menulis Teks Deskripsi',      'days_ago' => 16],
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Membuat Dokumen Sederhana',   'days_ago' => 5],
            ],
            // --- Intan (id=20, 600 XP) ---
            20 => [
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Statistika',                  'days_ago' => 17],
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Rantai Makanan',              'days_ago' => 9],
            ],
            // --- Rina (id=6, 520 XP) ---
            6 => [
                ['amount' => 40,  'type' => 'assignment', 'description' => 'Tugas Analisis Puisi',              'days_ago' => 20],
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Statistika',                  'days_ago' => 12],
                ['amount' => 40,  'type' => 'assignment', 'description' => 'Tugas Rantai Makanan',              'days_ago' => 8],
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Menulis Narasi',              'days_ago' => 3],
            ],
            // --- Dian (id=14, 450 XP) ---
            14 => [
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Menulis Teks Eksposisi',      'days_ago' => 13],
            ],
            // --- Dimas (id=7, 380 XP) ---
            7 => [
                ['amount' => 40,  'type' => 'assignment', 'description' => 'Tugas Analisis Puisi',              'days_ago' => 18],
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Statistika',                  'days_ago' => 10],
            ],
            // --- Bayu (id=19, 300 XP) ---
            19 => [
                ['amount' => 40,  'type' => 'assignment', 'description' => 'Tugas Analisis Puisi',              'days_ago' => 14],
            ],
            // --- Fajar (id=15, 280 XP) ---
            15 => [
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Persamaan Linear',            'days_ago' => 10],
            ],
            // --- Galih (id=21, 180 XP) ---
            21 => [],
            // --- Arif (id=23, 150 XP) ---
            23 => [
                ['amount' => 50,  'type' => 'assignment', 'description' => 'Tugas Bilangan Bulat',               'days_ago' => 6],
            ],
            // --- Citra (id=8, 120 XP) ---
            8 => [
                ['amount' => 40,  'type' => 'assignment', 'description' => 'Tugas Rantai Makanan',              'days_ago' => 15],
            ],
            // --- Dewi (id=24, 75 XP) ---
            24 => [],
            // --- Wulan (id=22, 50 XP) ---
            22 => [],
        ];

        foreach ($xpLogs as $userId => $logs) {
            if (!isset($profileMap[$userId])) continue;
            $profileId = $profileMap[$userId];

            foreach ($logs as $log) {
                DB::table('xp_logs')->insert([
                    'user_id'         => $userId,
                    'user_profile_id' => $profileId,
                    'amount'          => $log['amount'],
                    'type'            => $log['type'],
                    'description'     => $log['description'],
                    'created_at'      => $now->copy()->subDays($log['days_ago']),
                    'updated_at'      => $now->copy()->subDays($log['days_ago']),
                ]);
            }
        }

        // Login XP logs for active students
        $loginXpUsers = [
            3 => 30, 4 => 14, 5 => 8, 11 => 25, 12 => 10, 13 => 5,
            14 => 12, 15 => 3, 6 => 10, 7 => 5, 8 => 3, 16 => 15,
            17 => 5, 18 => 12, 19 => 3, 20 => 8, 23 => 2, 24 => 1,
        ];

        foreach ($loginXpUsers as $userId => $days) {
            if (!isset($profileMap[$userId])) continue;
            $profileId = $profileMap[$userId];
            for ($i = $days; $i >= 1; $i--) {
                DB::table('xp_logs')->insert([
                    'user_id' => $userId, 'user_profile_id' => $profileId,
                    'amount' => 10, 'type' => 'login', 'description' => 'Login harian',
                    'created_at' => $now->copy()->subDays($i), 'updated_at' => $now->copy()->subDays($i),
                ]);
            }
        }

        // Streak XP logs
        $streakXp = [
            3 => [21 => 7, 14 => 14, 7 => 21, 1 => 28],
            4 => [7 => 7, 1 => 14],
            5 => [7 => 7],
            11 => [21 => 7, 14 => 14, 7 => 21, 1 => 28],
            12 => [7 => 7],
            14 => [7 => 7],
            6 => [5 => 5],
            16 => [14 => 7, 7 => 14, 1 => 21],
            18 => [12 => 7, 5 => 14, 1 => 21],
        ];

        foreach ($streakXp as $userId => $streaks) {
            if (!isset($profileMap[$userId])) continue;
            $profileId = $profileMap[$userId];
            foreach ($streaks as $daysAgo => $streakDay) {
                DB::table('xp_logs')->insert([
                    'user_id' => $userId, 'user_profile_id' => $profileId,
                    'amount' => 100, 'type' => 'streak', 'description' => "Streak {$streakDay} hari",
                    'created_at' => $now->copy()->subDays($daysAgo), 'updated_at' => $now->copy()->subDays($daysAgo),
                ]);
            }
        }

        // Quest XP logs
        $questXp = [
            3 => [20 => 'Quest harian: Selesaikan 1 tugas', 13 => 'Quest harian: Selesaikan 1 tugas', 10 => 'Quest mingguan: 3 tugas', 8 => 'Quest mingguan: Login 5 hari'],
            4 => [10 => 'Quest harian', 8 => 'Quest mingguan', 3 => 'Bonus quest'],
            5 => [4 => 'Quest harian'],
            11 => [15 => 'Quest harian', 10 => 'Quest mingguan x3', 7 => 'Quest mingguan Login 5h', 5 => 'Quest spesial: Raih Lv 5', 2 => 'Quest spesial: Top 3'],
            12 => [5 => 'Quest harian', 3 => 'Quest mingguan'],
            13 => [3 => 'Quest harian'],
            6 => [6 => 'Quest harian', 4 => 'Quest mingguan'],
            16 => [8 => 'Quest harian', 5 => 'Quest mingguan'],
            18 => [7 => 'Quest harian', 3 => 'Quest mingguan'],
        ];

        foreach ($questXp as $userId => $quests) {
            if (!isset($profileMap[$userId])) continue;
            $profileId = $profileMap[$userId];
            foreach ($quests as $daysAgo => $desc) {
                DB::table('xp_logs')->insert([
                    'user_id' => $userId, 'user_profile_id' => $profileId,
                    'amount' => 30, 'type' => 'quest', 'description' => $desc,
                    'created_at' => $now->copy()->subDays($daysAgo), 'updated_at' => $now->copy()->subDays($daysAgo),
                ]);
            }
        }

        // =================================================================
        // 3. BADGES (10 badge)
        // =================================================================
        DB::table('badges')->insert([
            ['name' => 'First Task',       'description' => 'Menyelesaikan tugas pertama',         'icon' => 'first-task.png',   'category' => 'achievement', 'criteria' => json_encode(['tasks_completed' => 1]),  'xp_reward' => 10,  'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Streak Master',    'description' => 'Login 7 hari berturut-turut',          'icon' => 'streak-7.png',     'category' => 'streak',      'criteria' => json_encode(['streak_days' => 7]),        'xp_reward' => 100, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Top Performer',    'description' => 'Masuk top 3 leaderboard mingguan',     'icon' => 'top-3.png',        'category' => 'rank',        'criteria' => json_encode(['weekly_rank' => 3]),        'xp_reward' => 200, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Rajin Belajar',    'description' => 'Menyelesaikan 5 tugas',                'icon' => 'rajin.png',        'category' => 'achievement', 'criteria' => json_encode(['tasks_completed' => 5]),   'xp_reward' => 50,  'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Bintang Kelas',    'description' => 'XP tertinggi di kelas selama sebulan', 'icon' => 'bintang.png',      'category' => 'rank',        'criteria' => json_encode(['monthly_rank' => 1]),      'xp_reward' => 300, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Speed Demon',      'description' => 'Submit tugas sebelum deadline 3x',     'icon' => 'speed.png',        'category' => 'achievement', 'criteria' => json_encode(['early_submissions' => 3]), 'xp_reward' => 75,  'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Streak Legend',    'description' => 'Login 14 hari berturut-turut',          'icon' => 'streak-14.png',    'category' => 'streak',      'criteria' => json_encode(['streak_days' => 14]),       'xp_reward' => 200, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Quest Hunter',     'description' => 'Selesaikan 5 quest',                    'icon' => 'quest-hunter.png', 'category' => 'achievement', 'criteria' => json_encode(['quests_completed' => 5]),  'xp_reward' => 150, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Perfect Score',    'description' => 'Mendapat nilai 100',                    'icon' => 'perfect.png',      'category' => 'special',     'criteria' => json_encode(['perfect_score' => 1]),     'xp_reward' => 250, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Guild Leader',     'description' => 'Memimpin guild',                         'icon' => 'guild-leader.png', 'category' => 'special',     'criteria' => json_encode(['guild_leader' => true]),   'xp_reward' => 100, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // User Badges
        DB::table('user_badges')->insert([
            ['user_id' => 11, 'badge_id' => 1, 'earned_at' => $now->copy()->subDays(27), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 11, 'badge_id' => 2, 'earned_at' => $now->copy()->subDays(21), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 11, 'badge_id' => 3, 'earned_at' => $now->copy()->subDays(5),  'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 11, 'badge_id' => 4, 'earned_at' => $now->copy()->subDays(8),  'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 11, 'badge_id' => 9, 'earned_at' => $now->copy()->subDays(2),  'created_at' => $now, 'updated_at' => $now],

            ['user_id' => 3,  'badge_id' => 1, 'earned_at' => $now->copy()->subDays(25), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 3,  'badge_id' => 2, 'earned_at' => $now->copy()->subDays(21), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 3,  'badge_id' => 4, 'earned_at' => $now->copy()->subDays(10), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 3,  'badge_id' => 6, 'earned_at' => $now->copy()->subDays(8),  'created_at' => $now, 'updated_at' => $now],

            ['user_id' => 4,  'badge_id' => 1, 'earned_at' => $now->copy()->subDays(22), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 4,  'badge_id' => 2, 'earned_at' => $now->copy()->subDays(7),  'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 4,  'badge_id' => 4, 'earned_at' => $now->copy()->subDays(6),  'created_at' => $now, 'updated_at' => $now],

            ['user_id' => 16, 'badge_id' => 1, 'earned_at' => $now->copy()->subDays(22), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 16, 'badge_id' => 2, 'earned_at' => $now->copy()->subDays(14), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 16, 'badge_id' => 6, 'earned_at' => $now->copy()->subDays(7),  'created_at' => $now, 'updated_at' => $now],

            ['user_id' => 18, 'badge_id' => 1, 'earned_at' => $now->copy()->subDays(19), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 18, 'badge_id' => 2, 'earned_at' => $now->copy()->subDays(12), 'created_at' => $now, 'updated_at' => $now],

            ['user_id' => 5,  'badge_id' => 1, 'earned_at' => $now->copy()->subDays(20), 'created_at' => $now, 'updated_at' => $now],

            ['user_id' => 6,  'badge_id' => 1, 'earned_at' => $now->copy()->subDays(20), 'created_at' => $now, 'updated_at' => $now],

            // Guild leaders
            ['user_id' => 3,  'badge_id' => 10, 'earned_at' => $now->subMonths(2), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 6,  'badge_id' => 10, 'earned_at' => $now->subMonth(),   'created_at' => $now, 'updated_at' => $now],
        ]);

        // =================================================================
        // 4. STREAKS
        // =================================================================
        $streakData = [
            11 => 25, 3 => 21, 4 => 14, 16 => 18, 18 => 12, 12 => 10,
            14 => 6, 5 => 8, 6 => 5, 20 => 8,
            7 => 4, 13 => 5, 17 => 5, 19 => 3, 15 => 3, 8 => 3, 23 => 2, 24 => 1,
        ];

        foreach ($streakData as $userId => $days) {
            for ($i = $days - 1; $i >= 0; $i--) {
                $date = $now->copy()->subDays($i)->toDateString();
                DB::table('streaks')->insert([
                    'user_id'     => $userId,
                    'date'        => $date,
                    'login_count' => 1,
                    'activities'  => json_encode([
                        'viewed_materials' => rand(0, 3),
                        'submitted'        => rand(0, 1),
                    ]),
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }

        // =================================================================
        // 5. STREAK FREEZES
        // =================================================================
        DB::table('streak_freezes')->insert([
            ['user_id' => 11, 'freeze_date' => $now->copy()->subDays(18)->toDateString(), 'used_at_date' => $now->copy()->subDays(18)->toDateString(), 'created_at' => $now->copy()->subDays(18), 'updated_at' => $now->copy()->subDays(18)],
            ['user_id' => 3,  'freeze_date' => $now->copy()->subDays(16)->toDateString(), 'used_at_date' => $now->copy()->subDays(16)->toDateString(), 'created_at' => $now->copy()->subDays(16), 'updated_at' => $now->copy()->subDays(16)],
            ['user_id' => 4,  'freeze_date' => $now->copy()->subDays(10)->toDateString(), 'used_at_date' => $now->copy()->subDays(10)->toDateString(), 'created_at' => $now->copy()->subDays(10), 'updated_at' => $now->copy()->subDays(10)],
            ['user_id' => 16, 'freeze_date' => $now->copy()->subDays(12)->toDateString(), 'used_at_date' => $now->copy()->subDays(12)->toDateString(), 'created_at' => $now->copy()->subDays(12), 'updated_at' => $now->copy()->subDays(12)],
        ]);

        // =================================================================
        // 6. QUESTS (8 quest)
        // =================================================================
        DB::table('quests')->insert([
            ['title' => 'Selesaikan 1 Tugas Hari Ini',  'description' => 'Kumpulkan minimal 1 tugas hari ini',       'type' => 'daily',   'xp_reward' => 30,  'criteria' => json_encode(['tasks_per_day' => 1]),        'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Baca 2 Materi Baru',            'description' => 'Baca minimal 2 materi baru',              'type' => 'daily',   'xp_reward' => 20,  'criteria' => json_encode(['materials_read' => 2]),        'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Selesaikan 3 Tugas Minggu Ini', 'description' => 'Kumpulkan minimal 3 tugas dalam seminggu', 'type' => 'weekly',  'xp_reward' => 100, 'criteria' => json_encode(['tasks_per_week' => 3]),       'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Login 5 Hari Berturut-turut',   'description' => 'Login selama 5 hari tanpa putus',          'type' => 'weekly',  'xp_reward' => 150, 'criteria' => json_encode(['streak_days' => 5]),           'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Raih Level 3',                  'description' => 'Kumpulkan XP hingga level 3',             'type' => 'special', 'xp_reward' => 200, 'criteria' => json_encode(['reach_level' => 3]),           'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Top 3 Leaderboard Kelas',       'description' => 'Masuk peringkat 3 besar leaderboard',      'type' => 'special', 'xp_reward' => 300, 'criteria' => json_encode(['weekly_rank' => 3]),           'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Submit Sebelum Deadline',       'description' => 'Kumpulkan tugas sebelum deadline',         'type' => 'daily',   'xp_reward' => 25,  'criteria' => json_encode(['early_submission' => 1]),     'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Jaga Streak 7 Hari',            'description' => 'Pertahankan streak login 7 hari',          'type' => 'weekly',  'xp_reward' => 120, 'criteria' => json_encode(['maintain_streak' => 7]),      'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // User Quests
        DB::table('user_quests')->insert([
            ['user_id' => 3,  'quest_id' => 1, 'status' => 'completed', 'progress' => 100, 'completed_at' => $now->copy()->subDays(1), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 3,  'quest_id' => 3, 'status' => 'active',    'progress' => 66,  'completed_at' => null,            'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 3,  'quest_id' => 5, 'status' => 'completed', 'progress' => 100, 'completed_at' => $now->copy()->subDays(10),'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 4,  'quest_id' => 1, 'status' => 'active',    'progress' => 50,  'completed_at' => null,            'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 4,  'quest_id' => 4, 'status' => 'completed', 'progress' => 100, 'completed_at' => $now->copy()->subDays(1), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 11, 'quest_id' => 1, 'status' => 'completed', 'progress' => 100, 'completed_at' => $now->copy()->subDays(1), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 11, 'quest_id' => 3, 'status' => 'completed', 'progress' => 100, 'completed_at' => $now->copy()->subDays(2), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 11, 'quest_id' => 5, 'status' => 'completed', 'progress' => 100, 'completed_at' => $now->copy()->subDays(5), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 11, 'quest_id' => 6, 'status' => 'completed', 'progress' => 100, 'completed_at' => $now->copy()->subDays(2), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 16, 'quest_id' => 1, 'status' => 'completed', 'progress' => 100, 'completed_at' => $now->copy()->subDays(1), 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 16, 'quest_id' => 5, 'status' => 'active',    'progress' => 80,  'completed_at' => null,            'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 18, 'quest_id' => 1, 'status' => 'active',    'progress' => 60,  'completed_at' => null,            'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 5,  'quest_id' => 1, 'status' => 'active',    'progress' => 30,  'completed_at' => null,            'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 6,  'quest_id' => 1, 'status' => 'active',    'progress' => 40,  'completed_at' => null,            'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 12, 'quest_id' => 1, 'status' => 'completed', 'progress' => 100, 'completed_at' => $now->copy()->subDays(1), 'created_at' => $now, 'updated_at' => $now],
        ]);

        // =================================================================
        // 7. DAILY CHALLENGES
        // =================================================================
        DB::table('daily_challenges')->insert([
            ['title' => 'Submit Tugas Hari Ini',       'description' => 'Kumpulkan minimal 1 tugas hari ini',   'criteria' => json_encode(['tasks_submitted' => 1]),  'xp_reward' => 25, 'date' => $now->toDateString(),              'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Login dan Baca Materi',       'description' => 'Login dan buka minimal 1 materi',      'criteria' => json_encode(['materials_viewed' => 1]), 'xp_reward' => 15, 'date' => $now->toDateString(),              'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Raih 50 XP Hari Ini',         'description' => 'Dapatkan minimal 50 XP hari ini',      'criteria' => json_encode(['xp_earned' => 50]),       'xp_reward' => 30, 'date' => $now->toDateString(),              'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Submit 2 Tugas',              'description' => 'Kumpulkan 2 tugas hari ini',          'criteria' => json_encode(['tasks_submitted' => 2]),  'xp_reward' => 40, 'date' => $now->copy()->subDays(1)->toDateString(),   'is_active' => false, 'created_at' => $now->subDay(), 'updated_at' => $now->subDay()],
            ['title' => 'Baca 3 Materi',               'description' => 'Baca 3 materi berbeda hari ini',      'criteria' => json_encode(['materials_viewed' => 3]), 'xp_reward' => 35, 'date' => $now->copy()->subDays(2)->toDateString(),   'is_active' => false, 'created_at' => $now->copy()->subDays(2), 'updated_at' => $now->copy()->subDays(2)],
        ]);

        // =================================================================
        // 8. WEEKLY CHALLENGES
        // =================================================================
        DB::table('weekly_challenges')->insert([
            ['title' => 'Semangat Belajar Mingguan',  'description' => 'Selesaikan minimal 2 tugas minggu ini',  'criteria' => json_encode(['tasks_completed_weekly' => 2]), 'xp_reward' => 75,  'week_start' => $now->copy()->startOfWeek()->toDateString(), 'week_end' => $now->copy()->endOfWeek()->toDateString(), 'is_active' => true,  'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Login Konsisten',            'description' => 'Login 5 hari dalam minggu ini',           'criteria' => json_encode(['weekly_logins' => 5]),          'xp_reward' => 100, 'week_start' => $now->copy()->startOfWeek()->toDateString(), 'week_end' => $now->copy()->endOfWeek()->toDateString(), 'is_active' => true,  'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Master Materi Minggu Ini',   'description' => 'Baca semua materi baru minggu ini',       'criteria' => json_encode(['materials_read_weekly' => 4]),  'xp_reward' => 80,  'week_start' => $now->copy()->startOfWeek()->toDateString(), 'week_end' => $now->copy()->endOfWeek()->toDateString(), 'is_active' => true,  'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Challenge Minggu Lalu',      'description' => 'Selesaikan 3 tugas minggu lalu',         'criteria' => json_encode(['tasks_completed_weekly' => 3]), 'xp_reward' => 75,  'week_start' => $now->copy()->subWeek()->startOfWeek()->toDateString(), 'week_end' => $now->copy()->subWeek()->endOfWeek()->toDateString(), 'is_active' => false, 'created_at' => $now->copy()->subWeek(), 'updated_at' => $now->copy()->subWeek()],
        ]);

        // =================================================================
        // 9. LEADERBOARD CACHE
        // =================================================================
        DB::table('leaderboard_cache')->insert([
            // VII A (class_id=2) — weekly
            ['user_id' => 11, 'class_id' => 2, 'scope' => 'class',    'period' => 'weekly',   'total_xp' => 3200, 'rank' => 1, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 3,  'class_id' => 2, 'scope' => 'class',    'period' => 'weekly',   'total_xp' => 2850, 'rank' => 2, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 4,  'class_id' => 2, 'scope' => 'class',    'period' => 'weekly',   'total_xp' => 1820, 'rank' => 3, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 12, 'class_id' => 2, 'scope' => 'class',    'period' => 'weekly',   'total_xp' => 1150, 'rank' => 4, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 5,  'class_id' => 2, 'scope' => 'class',    'period' => 'weekly',   'total_xp' => 950,  'rank' => 5, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
            // VII A (class_id=2) — monthly
            ['user_id' => 11, 'class_id' => 2, 'scope' => 'class',    'period' => 'monthly',  'total_xp' => 3200, 'rank' => 1, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 3,  'class_id' => 2, 'scope' => 'class',    'period' => 'monthly',  'total_xp' => 2850, 'rank' => 2, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
            // VII B (class_id=3) — weekly
            ['user_id' => 16, 'class_id' => 3, 'scope' => 'class',    'period' => 'weekly',   'total_xp' => 2100, 'rank' => 1, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 18, 'class_id' => 3, 'scope' => 'class',    'period' => 'weekly',   'total_xp' => 1350, 'rank' => 2, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 6,  'class_id' => 3, 'scope' => 'class',    'period' => 'weekly',   'total_xp' => 520,  'rank' => 3, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
            // School — all_time
            ['user_id' => 11, 'class_id' => null, 'scope' => 'school', 'period' => 'all_time', 'total_xp' => 3200, 'rank' => 1, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 3,  'class_id' => null, 'scope' => 'school', 'period' => 'all_time', 'total_xp' => 2850, 'rank' => 2, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 16, 'class_id' => null, 'scope' => 'school', 'period' => 'all_time', 'total_xp' => 2100, 'rank' => 3, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 4,  'class_id' => null, 'scope' => 'school', 'period' => 'all_time', 'total_xp' => 1820, 'rank' => 4, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 18, 'class_id' => null, 'scope' => 'school', 'period' => 'all_time', 'total_xp' => 1350, 'rank' => 5, 'cached_at' => $now, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // =================================================================
        // 10. NOTIFICATIONS
        // =================================================================
        $notifications = [
            ['user_id' => 11, 'title' => 'Badge Baru!',     'message' => 'Kamu mendapatkan badge First Task!',                    'type' => 'achievement', 'days_ago' => 27],
            ['user_id' => 11, 'title' => 'Streak 7 Hari!',  'message' => 'Kamu berhasil login 7 hari berturut-turut. +100 XP',   'type' => 'reward',      'days_ago' => 21],
            ['user_id' => 11, 'title' => 'Top Performer!',  'message' => 'Kamu masuk top 3 leaderboard! +200 XP',               'type' => 'achievement', 'days_ago' => 5],
            ['user_id' => 11, 'title' => 'Tugas Dinilai',   'message' => 'Tugas Analisis Teks Eksposisi: 98/100',               'type' => 'system',      'days_ago' => 26],
            ['user_id' => 11, 'title' => 'Tugas Dinilai',   'message' => 'Tugas Bilangan Bulat: 100/100 — Perfect!',            'type' => 'system',      'days_ago' => 16],
            ['user_id' => 3,  'title' => 'Badge Baru!',     'message' => 'Kamu mendapatkan badge First Task!',                   'type' => 'achievement', 'days_ago' => 25],
            ['user_id' => 3,  'title' => 'Streak 7 Hari!',  'message' => 'Login 7 hari berturut! +100 XP',                      'type' => 'reward',      'days_ago' => 21],
            ['user_id' => 3,  'title' => 'Tugas Dinilai',   'message' => 'Tugas Analisis Teks Eksposisi: 88/100',              'type' => 'system',      'days_ago' => 24],
            ['user_id' => 3,  'title' => 'Tugas Dinilai',   'message' => 'Tugas Bilangan Bulat: 92/100',                        'type' => 'system',      'days_ago' => 17],
            ['user_id' => 3,  'title' => 'Penalty!',        'message' => 'XP dikurangi -50 karena terlambat submit',              'type' => 'system',      'days_ago' => 6],
            ['user_id' => 4,  'title' => 'Badge Baru!',     'message' => 'Kamu mendapatkan badge First Task!',                   'type' => 'achievement', 'days_ago' => 22],
            ['user_id' => 4,  'title' => 'Tugas Dinilai',   'message' => 'Tugas Analisis Teks Eksposisi: 82/100',              'type' => 'system',      'days_ago' => 21],
            ['user_id' => 4,  'title' => 'Streak 7 Hari!',  'message' => 'Login 7 hari berturut! +100 XP',                       'type' => 'reward',      'days_ago' => 7],
            ['user_id' => 16, 'title' => 'Badge Baru!',     'message' => 'Kamu mendapatkan badge First Task!',                   'type' => 'achievement', 'days_ago' => 22],
            ['user_id' => 16, 'title' => 'Tugas Dinilai',   'message' => 'Tugas Analisis Puisi: 92/100',                        'type' => 'system',      'days_ago' => 19],
            ['user_id' => 16, 'title' => 'Streak 7 Hari!',  'message' => 'Login 7 hari berturut! +100 XP',                       'type' => 'reward',      'days_ago' => 14],
            ['user_id' => 18, 'title' => 'Badge Baru!',     'message' => 'Kamu mendapatkan badge First Task!',                   'type' => 'achievement', 'days_ago' => 19],
            ['user_id' => 18, 'title' => 'Streak 7 Hari!',  'message' => 'Login 7 hari berturut! +100 XP',                       'type' => 'reward',      'days_ago' => 12],
            ['user_id' => 6,  'title' => 'Badge Baru!',     'message' => 'Kamu mendapatkan badge First Task!',                   'type' => 'achievement', 'days_ago' => 20],
            ['user_id' => 6,  'title' => 'Tugas Dinilai',   'message' => 'Tugas Analisis Puisi: 85/100',                        'type' => 'system',      'days_ago' => 19],
            ['user_id' => 5,  'title' => 'Badge Baru!',     'message' => 'Kamu mendapatkan badge First Task!',                   'type' => 'achievement', 'days_ago' => 20],
            ['user_id' => 5,  'title' => 'Tugas Dinilai',   'message' => 'Tugas Menulis Teks Deskripsi: 75/100',               'type' => 'system',      'days_ago' => 19],
        ];

        foreach ($notifications as $n) {
            $daysAgo = $n['days_ago'];
            DB::table('notifications')->insert([
                'user_id'    => $n['user_id'],
                'title'      => $n['title'],
                'message'    => $n['message'],
                'type'       => $n['type'],
                'data'       => null,
                'read_at'    => $daysAgo > 10 ? now()->subDays($daysAgo - 1) : null,
                'created_at' => now()->subDays($daysAgo),
                'updated_at' => now()->subDays($daysAgo),
            ]);
        }

        // =================================================================
        // 11. ACTIVITY LOGS
        // =================================================================
        $activities = [
            ['user_id' => 1,  'action' => 'login',            'description' => 'Admin login ke sistem',                                   'days_ago' => 0],
            ['user_id' => 2,  'action' => 'login',            'description' => 'Putri Oktaria login ke sistem',                           'days_ago' => 0],
            ['user_id' => 2,  'action' => 'create_material',  'description' => 'Membuat materi: Teks Eksposisi',                          'days_ago' => 30],
            ['user_id' => 2,  'action' => 'create_assignment', 'description' => 'Membuat tugas: Analisis Teks Eksposisi',                 'days_ago' => 30],
            ['user_id' => 2,  'action' => 'grade_submission',  'description' => 'Menilai tugas Budi Santoso: 88/100',                    'days_ago' => 24],
            ['user_id' => 2,  'action' => 'grade_submission',  'description' => 'Menilai tugas Siti Rahmawati: 82/100',                 'days_ago' => 21],
            ['user_id' => 3,  'action' => 'login',            'description' => 'Budi login ke sistem',                                   'days_ago' => 0],
            ['user_id' => 3,  'action' => 'view_material',    'description' => 'Budi membaca materi: Bilangan Bulat dan Pecahan',        'days_ago' => 1],
            ['user_id' => 3,  'action' => 'submit_assignment', 'description' => 'Budi submit tugas: Persamaan Linear Sederhana',        'days_ago' => 1],
            ['user_id' => 11, 'action' => 'login',            'description' => 'Andi login ke sistem',                                   'days_ago' => 0],
            ['user_id' => 11, 'action' => 'submit_assignment', 'description' => 'Andi submit tugas: Persamaan Linear Sederhana',        'days_ago' => 1],
            ['user_id' => 16, 'action' => 'login',            'description' => 'Yoga login ke sistem',                                   'days_ago' => 0],
            ['user_id' => 16, 'action' => 'submit_assignment', 'description' => 'Yoga submit tugas: Rantai Makanan',                   'days_ago' => 1],
        ];

        foreach ($activities as $a) {
            DB::table('activity_logs')->insert([
                'user_id'      => $a['user_id'],
                'action'       => $a['action'],
                'entity_type'  => null,
                'entity_id'    => null,
                'description'  => $a['description'],
                'ip_address'   => '192.168.1.' . rand(1, 254),
                'user_agent'   => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0',
                'created_at'   => $now->copy()->subDays($a['days_ago']),
                'updated_at'   => $now->copy()->subDays($a['days_ago']),
            ]);
        }

        // =================================================================
        // 12. LEAGUES (8 tier)
        // =================================================================
        DB::table('leagues')->insert([
            ['name' => 'Perunggu',  'tier' => 'bronze',   'order' => 1, 'icon' => '🥉', 'color' => 'from-amber-600 to-amber-800',            'min_xp' => 0,    'max_xp' => 99,    'promote_count' => 5, 'demote_count' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Perak',     'tier' => 'silver',   'order' => 2, 'icon' => '🥈', 'color' => 'from-gray-400 to-gray-600',             'min_xp' => 100,  'max_xp' => 299,   'promote_count' => 5, 'demote_count' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Emas',      'tier' => 'gold',     'order' => 3, 'icon' => '🥇', 'color' => 'from-yellow-400 to-yellow-600',         'min_xp' => 300,  'max_xp' => 599,   'promote_count' => 5, 'demote_count' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Safir',     'tier' => 'sapphire', 'order' => 4, 'icon' => '💎', 'color' => 'from-blue-400 to-blue-600',             'min_xp' => 600,  'max_xp' => 999,   'promote_count' => 5, 'demote_count' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ruby',      'tier' => 'ruby',     'order' => 5, 'icon' => '🔴', 'color' => 'from-red-400 to-red-600',               'min_xp' => 1000, 'max_xp' => 1499,  'promote_count' => 5, 'demote_count' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Zamrud',    'tier' => 'emerald',  'order' => 6, 'icon' => '🟢', 'color' => 'from-emerald-400 to-emerald-600',       'min_xp' => 1500, 'max_xp' => 2499,  'promote_count' => 5, 'demote_count' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Amethyst',  'tier' => 'amethyst', 'order' => 7, 'icon' => '🟣', 'color' => 'from-purple-400 to-purple-600',         'min_xp' => 2500, 'max_xp' => 3999,  'promote_count' => 5, 'demote_count' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Diamant',   'tier' => 'diamond',  'order' => 8, 'icon' => '💠', 'color' => 'from-cyan-300 to-cyan-500',             'min_xp' => 4000, 'max_xp' => 99999, 'promote_count' => 3, 'demote_count' => 5, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // User Leagues — current week
        $weekStart = $now->copy()->startOfWeek(\Carbon\Carbon::MONDAY)->toDateString();
        $weekEnd   = $now->copy()->endOfWeek(\Carbon\Carbon::SUNDAY)->toDateString();

        DB::table('user_leagues')->insert([
            ['user_id' => 11, 'league_id' => 7, 'week_start' => $weekStart, 'week_end' => $weekEnd, 'weekly_xp' => 280, 'rank' => 1, 'status' => 'active',   'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 3,  'league_id' => 7, 'week_start' => $weekStart, 'week_end' => $weekEnd, 'weekly_xp' => 220, 'rank' => 2, 'status' => 'active',   'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 4,  'league_id' => 6, 'week_start' => $weekStart, 'week_end' => $weekEnd, 'weekly_xp' => 180, 'rank' => 1, 'status' => 'active',   'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 16, 'league_id' => 6, 'week_start' => $weekStart, 'week_end' => $weekEnd, 'weekly_xp' => 150, 'rank' => 2, 'status' => 'active',   'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 18, 'league_id' => 5, 'week_start' => $weekStart, 'week_end' => $weekEnd, 'weekly_xp' => 130, 'rank' => 1, 'status' => 'active',   'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 12, 'league_id' => 5, 'week_start' => $weekStart, 'week_end' => $weekEnd, 'weekly_xp' => 100, 'rank' => 2, 'status' => 'active',   'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 5,  'league_id' => 4, 'week_start' => $weekStart, 'week_end' => $weekEnd, 'weekly_xp' => 80,  'rank' => 1, 'status' => 'active',   'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 6,  'league_id' => 4, 'week_start' => $weekStart, 'week_end' => $weekEnd, 'weekly_xp' => 70,  'rank' => 2, 'status' => 'active',   'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 17, 'league_id' => 3, 'week_start' => $weekStart, 'week_end' => $weekEnd, 'weekly_xp' => 50,  'rank' => 1, 'status' => 'active',   'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 20, 'league_id' => 3, 'week_start' => $weekStart, 'week_end' => $weekEnd, 'weekly_xp' => 40,  'rank' => 2, 'status' => 'active',   'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 7,  'league_id' => 2, 'week_start' => $weekStart, 'week_end' => $weekEnd, 'weekly_xp' => 30,  'rank' => 1, 'status' => 'active',   'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 8,  'league_id' => 1, 'week_start' => $weekStart, 'week_end' => $weekEnd, 'weekly_xp' => 10,  'rank' => 1, 'status' => 'active',   'created_at' => $now, 'updated_at' => $now],
        ]);

        // User Leagues — previous week
        $prevWeekStart = $now->copy()->subWeek()->startOfWeek(\Carbon\Carbon::MONDAY)->toDateString();
        $prevWeekEnd   = $now->copy()->subWeek()->endOfWeek(\Carbon\Carbon::SUNDAY)->toDateString();

        DB::table('user_leagues')->insert([
            ['user_id' => 11, 'league_id' => 6, 'week_start' => $prevWeekStart, 'week_end' => $prevWeekEnd, 'weekly_xp' => 450, 'rank' => 1, 'status' => 'promoted', 'created_at' => $now->copy()->subWeek(), 'updated_at' => $now->copy()->subWeek()],
            ['user_id' => 3,  'league_id' => 6, 'week_start' => $prevWeekStart, 'week_end' => $prevWeekEnd, 'weekly_xp' => 380, 'rank' => 2, 'status' => 'promoted', 'created_at' => $now->copy()->subWeek(), 'updated_at' => $now->copy()->subWeek()],
            ['user_id' => 4,  'league_id' => 5, 'week_start' => $prevWeekStart, 'week_end' => $prevWeekEnd, 'weekly_xp' => 280, 'rank' => 1, 'status' => 'promoted', 'created_at' => $now->copy()->subWeek(), 'updated_at' => $now->copy()->subWeek()],
            ['user_id' => 16, 'league_id' => 5, 'week_start' => $prevWeekStart, 'week_end' => $prevWeekEnd, 'weekly_xp' => 200, 'rank' => 2, 'status' => 'promoted', 'created_at' => $now->copy()->subWeek(), 'updated_at' => $now->copy()->subWeek()],
            ['user_id' => 5,  'league_id' => 3, 'week_start' => $prevWeekStart, 'week_end' => $prevWeekEnd, 'weekly_xp' => 120, 'rank' => 3, 'status' => 'active',    'created_at' => $now->copy()->subWeek(), 'updated_at' => $now->copy()->subWeek()],
            ['user_id' => 6,  'league_id' => 3, 'week_start' => $prevWeekStart, 'week_end' => $prevWeekEnd, 'weekly_xp' => 90,  'rank' => 2, 'status' => 'active',    'created_at' => $now->copy()->subWeek(), 'updated_at' => $now->copy()->subWeek()],
            ['user_id' => 17, 'league_id' => 2, 'week_start' => $prevWeekStart, 'week_end' => $prevWeekEnd, 'weekly_xp' => 40,  'rank' => 1, 'status' => 'demoted',   'created_at' => $now->copy()->subWeek(), 'updated_at' => $now->copy()->subWeek()],
            ['user_id' => 8,  'league_id' => 1, 'week_start' => $prevWeekStart, 'week_end' => $prevWeekEnd, 'weekly_xp' => 10,  'rank' => 1, 'status' => 'active',    'created_at' => $now->copy()->subWeek(), 'updated_at' => $now->copy()->subWeek()],
        ]);

        // =================================================================
        // 13. GUILDS (3 guild)
        // =================================================================
        DB::table('guilds')->insert([
            [
                'id' => 1, 'name' => 'Penjelajah Ilmu',  'description' => 'Tim belajar yang suka tantangan!',
                'icon' => '📚', 'leader_id' => 3, 'class_id' => 2,
                'total_guild_xp' => 4670, 'max_members' => 5,
                'created_at' => $now->subMonths(2), 'updated_at' => $now,
            ],
            [
                'id' => 2, 'name' => 'Siswa Aktif',   'description' => 'Siswa yang rajin dan aktif belajar',
                'icon' => '🌟', 'leader_id' => 6, 'class_id' => 3,
                'total_guild_xp' => 900, 'max_members' => 5,
                'created_at' => $now->subMonth(), 'updated_at' => $now,
            ],
            [
                'id' => 3, 'name' => 'Tim Kreatif',    'description' => 'Siswa kreatif dan inovatif',
                'icon' => '🎨', 'leader_id' => 11, 'class_id' => 2,
                'total_guild_xp' => 3200, 'max_members' => 5,
                'created_at' => $now->subMonths(2), 'updated_at' => $now,
            ],
        ]);

        DB::table('guild_members')->insert([
            ['guild_id' => 1, 'user_id' => 3,  'role' => 'leader', 'contributed_xp' => 2850, 'created_at' => $now->subMonths(2), 'updated_at' => $now],
            ['guild_id' => 1, 'user_id' => 4,  'role' => 'member', 'contributed_xp' => 1820, 'created_at' => $now->subMonths(2), 'updated_at' => $now],
            ['guild_id' => 1, 'user_id' => 5,  'role' => 'member', 'contributed_xp' => 950,  'created_at' => $now->subMonths(1), 'updated_at' => $now],
            ['guild_id' => 2, 'user_id' => 6,  'role' => 'leader', 'contributed_xp' => 520,  'created_at' => $now->subMonth(),   'updated_at' => $now],
            ['guild_id' => 2, 'user_id' => 7,  'role' => 'member', 'contributed_xp' => 380,  'created_at' => $now->subMonth(),   'updated_at' => $now],
            ['guild_id' => 2, 'user_id' => 8,  'role' => 'member', 'contributed_xp' => 120,  'created_at' => $now->copy()->subWeek(),    'updated_at' => $now],
            ['guild_id' => 3, 'user_id' => 11, 'role' => 'leader', 'contributed_xp' => 3200, 'created_at' => $now->subMonths(2), 'updated_at' => $now],
            ['guild_id' => 3, 'user_id' => 12, 'role' => 'member', 'contributed_xp' => 1150, 'created_at' => $now->subMonths(1), 'updated_at' => $now],
            ['guild_id' => 3, 'user_id' => 14, 'role' => 'member', 'contributed_xp' => 450,  'created_at' => $now->copy()->subWeek(),    'updated_at' => $now],
        ]);

        // Guild Quests
        DB::table('guild_quests')->insert([
            ['guild_id' => 1, 'quest_id' => 5, 'current_progress' => 100, 'target_progress' => 100, 'status' => 'completed', 'completed_at' => $now->copy()->subDays(3), 'created_at' => $now, 'updated_at' => $now],
            ['guild_id' => 1, 'quest_id' => 3, 'current_progress' => 80,  'target_progress' => 100, 'status' => 'active',    'completed_at' => null, 'created_at' => $now, 'updated_at' => $now],
            ['guild_id' => 2, 'quest_id' => 3, 'current_progress' => 40,  'target_progress' => 100, 'status' => 'active',    'completed_at' => null, 'created_at' => $now, 'updated_at' => $now],
            ['guild_id' => 3, 'quest_id' => 4, 'current_progress' => 100, 'target_progress' => 100, 'status' => 'completed', 'completed_at' => $now->copy()->subDays(5), 'created_at' => $now, 'updated_at' => $now],
            ['guild_id' => 3, 'quest_id' => 3, 'current_progress' => 90,  'target_progress' => 100, 'status' => 'active',    'completed_at' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // =================================================================
        // 14. GAMIFICATION RULES CONFIG
        // =================================================================
        $rules = [
            'xp' => [
                'assignment_completed' => 50,
                'early_submission'     => 20,
                'daily_login'          => 10,
                'streak_7_days'        => 100,
                'streak_30_days'       => 500,
            ],
            'level' => [
                'formula'  => 'floor(sqrt(total_xp / 100)) + 1',
                'base_xp' => 100,
            ],
        ];

        \File::put(
            config_path('gamification-rules.json'),
            json_encode($rules, JSON_PRETTY_PRINT)
        );
    }
}
