<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================================
        // 1. MASTER DATA
        // =====================================================================

        // Roles
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'admin', 'description' => 'System Administrator', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'guru', 'description' => 'Teacher', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'siswa', 'description' => 'Student', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // School
        DB::table('schools')->insert([
            'id' => 1,
            'name' => 'SMK Nusantara',
            'address' => 'Jl. Pendidikan No. 1, Jakarta',
            'phone' => '021-1234567',
            'email' => 'info@smknusantara.sch.id',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Academic Years
        DB::table('academic_years')->insert([
            [
                'id' => 1, 'school_id' => 1, 'name' => '2023/2024',
                'start_date' => '2023-07-01', 'end_date' => '2024-06-30',
                'is_active' => false, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'id' => 2, 'school_id' => 1, 'name' => '2024/2025',
                'start_date' => '2024-07-01', 'end_date' => '2025-06-30',
                'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // Subjects
        DB::table('subjects')->insert([
            ['id' => 1, 'school_id' => 1, 'name' => 'Pemrograman Web', 'code' => 'PW-12', 'description' => 'Mata pelajaran pemrograman web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'school_id' => 1, 'name' => 'Basis Data', 'code' => 'BD-12', 'description' => 'Mata pelajaran basis data', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'school_id' => 1, 'name' => 'Pemrograman Berorientasi Objek', 'code' => 'PBO-12', 'description' => 'Mata pelajaran pemrograman berorientasi objek', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // =====================================================================
        // 2. USERS
        // =====================================================================

        // Admin
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin EduQuest',
            'email' => 'admin@eduquest.com',
            'password' => Hash::make('password'),
            'role_id' => 1, 'school_id' => 1,
            'email_verified_at' => now(),
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // Guru — Ibu Niken, mengajar semua mapel di semua kelas
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Ibu Niken Probondani',
            'email' => 'guru@eduquest.com',
            'password' => Hash::make('password'),
            'role_id' => 2, 'school_id' => 1,
            'email_verified_at' => now(),
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // Students (6 orang)
        $students = [
            // XII RPL 1 — naik dari XI RPL 1 (angkatan 2023/2024)
            ['id' => 3,  'name' => 'Budi Santoso',       'email' => 'siswa1@eduquest.com'],
            ['id' => 4,  'name' => 'Siti Rahmawati',     'email' => 'siswa2@eduquest.com'],
            ['id' => 5,  'name' => 'Adi Pratama',        'email' => 'siswa3@eduquest.com'],
            // XII RPL 2 — siswa baru angkatan 2024/2025
            ['id' => 6,  'name' => 'Rina Maryani',       'email' => 'siswa4@eduquest.com'],
            ['id' => 7,  'name' => 'Dimas Ardiansyah',   'email' => 'siswa5@eduquest.com'],
            ['id' => 8,  'name' => 'Citra Lestari',      'email' => 'siswa6@eduquest.com'],
        ];

        foreach ($students as $s) {
            DB::table('users')->insert([
                'id' => $s['id'],
                'name' => $s['name'],
                'email' => $s['email'],
                'password' => Hash::make('password'),
                'role_id' => 3, 'school_id' => 1,
                'email_verified_at' => now(),
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // =====================================================================
        // 3. CLASSES
        // =====================================================================

        // Year 2023/2024 (history — kelas 11)
        DB::table('classes')->insert([
            ['id' => 1, 'school_id' => 1, 'academic_year_id' => 1, 'name' => 'XI RPL 1', 'grade_level' => 11, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Year 2024/2025 (active — kelas 12)
        DB::table('classes')->insert([
            ['id' => 2, 'school_id' => 1, 'academic_year_id' => 2, 'name' => 'XII RPL 1', 'grade_level' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'school_id' => 1, 'academic_year_id' => 2, 'name' => 'XII RPL 2', 'grade_level' => 12, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // =====================================================================
        // 4. TEACHER ASSIGNMENTS (class_subject)
        // =====================================================================

        // Ibu Niken mengajar di XI RPL 1 (history) — 2 mapel
        DB::table('class_subject')->insert([
            ['class_id' => 1, 'subject_id' => 1, 'user_id' => 2, 'semester' => 'ganjil', 'created_at' => now()->subYear(), 'updated_at' => now()->subYear()],
            ['class_id' => 1, 'subject_id' => 2, 'user_id' => 2, 'semester' => 'ganjil', 'created_at' => now()->subYear(), 'updated_at' => now()->subYear()],
        ]);

        // Ibu Niken mengajar di XII RPL 1 (sekarang) — 3 mapel
        DB::table('class_subject')->insert([
            ['class_id' => 2, 'subject_id' => 1, 'user_id' => 2, 'semester' => 'ganjil', 'created_at' => now(), 'updated_at' => now()],
            ['class_id' => 2, 'subject_id' => 2, 'user_id' => 2, 'semester' => 'ganjil', 'created_at' => now(), 'updated_at' => now()],
            ['class_id' => 2, 'subject_id' => 3, 'user_id' => 2, 'semester' => 'genap',  'created_at' => now(), 'updated_at' => now()],
        ]);

        // Ibu Niken mengajar di XII RPL 2 (sekarang) — 2 mapel
        DB::table('class_subject')->insert([
            ['class_id' => 3, 'subject_id' => 1, 'user_id' => 2, 'semester' => 'ganjil', 'created_at' => now(), 'updated_at' => now()],
            ['class_id' => 3, 'subject_id' => 2, 'user_id' => 2, 'semester' => 'genap',  'created_at' => now(), 'updated_at' => now()],
        ]);

        // =====================================================================
        // 5. STUDENT ENROLLMENT (student_classes)
        // =====================================================================

        // History: 3 siswa di XI RPL 1 (class id 1) — tahun lalu
        DB::table('student_classes')->insert([
            ['user_id' => 3, 'class_id' => 1, 'created_at' => now()->subYear(), 'updated_at' => now()->subYear()],
            ['user_id' => 4, 'class_id' => 1, 'created_at' => now()->subYear(), 'updated_at' => now()->subYear()],
            ['user_id' => 5, 'class_id' => 1, 'created_at' => now()->subYear(), 'updated_at' => now()->subYear()],
        ]);

        // Sekarang: 3 siswa naik ke XII RPL 1 (class id 2)
        DB::table('student_classes')->insert([
            ['user_id' => 3, 'class_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'class_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 5, 'class_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Sekarang: 3 siswa di XII RPL 2 (class id 3)
        DB::table('student_classes')->insert([
            ['user_id' => 6, 'class_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 7, 'class_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 8, 'class_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // =====================================================================
        // 6. USER PROFILES + XP LOGS (history gamification)
        // =====================================================================

        $profiles = [
            // Budi — level 5, rajin
            ['user_id' => 3, 'total_xp' => 2850, 'current_level' => 6, 'current_streak' => 12, 'longest_streak' => 21],
            // Siti — level 4, cukup rajin
            ['user_id' => 4, 'total_xp' => 1820, 'current_level' => 5, 'current_streak' => 7, 'longest_streak' => 14],
            // Adi — level 3, lumayan
            ['user_id' => 5, 'total_xp' => 950,  'current_level' => 4, 'current_streak' => 3, 'longest_streak' => 8],
            // Rina — level 2, baru
            ['user_id' => 6, 'total_xp' => 520,  'current_level' => 3, 'current_streak' => 5, 'longest_streak' => 5],
            // Dimas — level 2
            ['user_id' => 7, 'total_xp' => 380,  'current_level' => 2, 'current_streak' => 2, 'longest_streak' => 4],
            // Citra — level 1, baru banget
            ['user_id' => 8, 'total_xp' => 120,  'current_level' => 2, 'current_streak' => 1, 'longest_streak' => 3],
        ];

        $profileIds = [];
        foreach ($profiles as $p) {
            DB::table('user_profiles')->insert([
                'user_id' => $p['user_id'],
                'total_xp' => $p['total_xp'],
                'current_level' => $p['current_level'],
                'current_streak' => $p['current_streak'],
                'longest_streak' => $p['longest_streak'],
                'last_login_at' => now(),
                'created_at' => now()->subMonths(3),
                'updated_at' => now(),
            ]);
            $profileIds[] = DB::getPdo()->lastInsertId();
        }

        // XP Logs — detail breakdown untuk Budi (user_id=3)
        $xpLogs = [
            // Budi — 2850 XP = 1500 assignment + 450 login + 400 streak + 400 quest + 100 penalty
            ['user_id' => 3, 'amount' => 50,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas Portfolio', 'reference_type' => 'assignment', 'reference_id' => 5, 'created_at' => now()->subDays(30)],
            ['user_id' => 3, 'amount' => 50,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas Flexbox', 'reference_type' => 'assignment', 'reference_id' => 6, 'created_at' => now()->subDays(28)],
            ['user_id' => 3, 'amount' => 75,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas Kalkulator JS', 'reference_type' => 'assignment', 'reference_id' => 7, 'created_at' => now()->subDays(25)],
            ['user_id' => 3, 'amount' => 60,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas ERD', 'reference_type' => 'assignment', 'reference_id' => 8, 'created_at' => now()->subDays(22)],
            ['user_id' => 3, 'amount' => 50,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas CSS Layout', 'reference_type' => 'assignment', 'reference_id' => 6, 'created_at' => now()->subDays(18)],
            ['user_id' => 3, 'amount' => 50,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas HTML Dasar', 'reference_type' => 'assignment', 'reference_id' => 5, 'created_at' => now()->subDays(15)],
            ['user_id' => 3, 'amount' => 75,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas OOP Java', 'reference_type' => 'assignment', 'reference_id' => 10, 'created_at' => now()->subDays(12)],
            ['user_id' => 3, 'amount' => 20,  'type' => 'assignment', 'description' => 'Bonus early submission', 'reference_type' => 'assignment', 'reference_id' => 10, 'created_at' => now()->subDays(12)],
            ['user_id' => 3, 'amount' => 60,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas Normalisasi', 'reference_type' => 'assignment', 'reference_id' => 9, 'created_at' => now()->subDays(10)],
            ['user_id' => 3, 'amount' => 50,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas JS DOM', 'reference_type' => 'assignment', 'reference_id' => 7, 'created_at' => now()->subDays(7)],
            ['user_id' => 3, 'amount' => 60,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas UML', 'reference_type' => 'assignment', 'reference_id' => 10, 'created_at' => now()->subDays(5)],
            ['user_id' => 3, 'amount' => 10,  'type' => 'login', 'description' => 'Login harian', 'created_at' => now()->subDays(30)],
            ['user_id' => 3, 'amount' => 10,  'type' => 'login', 'description' => 'Login harian', 'created_at' => now()->subDays(29)],
            ['user_id' => 3, 'amount' => 10,  'type' => 'login', 'description' => 'Login harian', 'created_at' => now()->subDays(28)],
            ['user_id' => 3, 'amount' => 10,  'type' => 'login', 'description' => 'Login harian', 'created_at' => now()->subDays(27)],
            ['user_id' => 3, 'amount' => 10,  'type' => 'login', 'description' => 'Login harian', 'created_at' => now()->subDays(26)],
            ['user_id' => 3, 'amount' => 10,  'type' => 'login', 'description' => 'Login harian', 'created_at' => now()->subDays(25)],
            ['user_id' => 3, 'amount' => 10,  'type' => 'login', 'description' => 'Login harian', 'created_at' => now()->subDays(24)],
            ['user_id' => 3, 'amount' => 10,  'type' => 'login', 'description' => 'Login harian', 'created_at' => now()->subDays(23)],
            ['user_id' => 3, 'amount' => 10,  'type' => 'login', 'description' => 'Login harian', 'created_at' => now()->subDays(22)],
            ['user_id' => 3, 'amount' => 100, 'type' => 'streak', 'description' => 'Streak 7 hari', 'created_at' => now()->subDays(21)],
            ['user_id' => 3, 'amount' => 100, 'type' => 'streak', 'description' => 'Streak 14 hari', 'created_at' => now()->subDays(14)],
            ['user_id' => 3, 'amount' => 100, 'type' => 'streak', 'description' => 'Streak 21 hari', 'created_at' => now()->subDays(7)],
            ['user_id' => 3, 'amount' => 100, 'type' => 'streak', 'description' => 'Streak 28 hari', 'created_at' => now()->subDays(1)],
            ['user_id' => 3, 'amount' => 30,  'type' => 'quest', 'description' => 'Quest harian: Selesaikan 1 tugas', 'created_at' => now()->subDays(20)],
            ['user_id' => 3, 'amount' => 30,  'type' => 'quest', 'description' => 'Quest harian: Selesaikan 1 tugas', 'created_at' => now()->subDays(13)],
            ['user_id' => 3, 'amount' => 100, 'type' => 'quest', 'description' => 'Quest mingguan: 3 tugas seminggu', 'created_at' => now()->subDays(10)],
            ['user_id' => 3, 'amount' => 150, 'type' => 'quest', 'description' => 'Quest mingguan: Login 5 hari', 'created_at' => now()->subDays(8)],
            ['user_id' => 3, 'amount' => -50, 'type' => 'penalty', 'description' => 'Terlambat mengumpulkan tugas', 'created_at' => now()->subDays(15)],
            ['user_id' => 3, 'amount' => -50, 'type' => 'penalty', 'description' => 'Terlambat mengumpulkan tugas', 'created_at' => now()->subDays(6)],

            // Siti — 1820 XP
            ['user_id' => 4, 'amount' => 50,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas Portfolio', 'reference_type' => 'assignment', 'reference_id' => 5, 'created_at' => now()->subDays(25)],
            ['user_id' => 4, 'amount' => 50,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas Flexbox', 'reference_type' => 'assignment', 'reference_id' => 6, 'created_at' => now()->subDays(22)],
            ['user_id' => 4, 'amount' => 75,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas Kalkulator JS', 'reference_type' => 'assignment', 'reference_id' => 7, 'created_at' => now()->subDays(18)],
            ['user_id' => 4, 'amount' => 60,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas ERD', 'reference_type' => 'assignment', 'reference_id' => 8, 'created_at' => now()->subDays(15)],
            ['user_id' => 4, 'amount' => 50,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas CSS Layout', 'reference_type' => 'assignment', 'reference_id' => 6, 'created_at' => now()->subDays(10)],
            ['user_id' => 4, 'amount' => 60,  'type' => 'assignment', 'description' => 'Menyelesaikan tugas Normalisasi', 'reference_type' => 'assignment', 'reference_id' => 9, 'created_at' => now()->subDays(5)],
            ['user_id' => 4, 'amount' => 10,  'type' => 'login', 'description' => 'Login harian x14', 'created_at' => now()->subDays(14)],
            ['user_id' => 4, 'amount' => 100, 'type' => 'streak', 'description' => 'Streak 7 hari', 'created_at' => now()->subDays(7)],
            ['user_id' => 4, 'amount' => 100, 'type' => 'streak', 'description' => 'Streak 14 hari', 'created_at' => now()->subDays(1)],
            ['user_id' => 4, 'amount' => 30,  'type' => 'quest', 'description' => 'Quest harian', 'created_at' => now()->subDays(10)],
            ['user_id' => 4, 'amount' => 100, 'type' => 'quest', 'description' => 'Quest mingguan', 'created_at' => now()->subDays(8)],
            ['user_id' => 4, 'amount' => 50,  'type' => 'quest', 'description' => 'Quest mingguan: Login', 'created_at' => now()->subDays(3)],
            ['user_id' => 4, 'amount' => 50,  'type' => 'quest', 'description' => 'Bonus quest', 'created_at' => now()->subDays(2)],
        ];

        // Ambil profile IDs
        $profileMap = [];
        $profilesFromDb = DB::table('user_profiles')->get();
        foreach ($profilesFromDb as $pf) {
            $profileMap[$pf->user_id] = $pf->id;
        }

        foreach ($xpLogs as $log) {
            $insert = [
                'user_id' => $log['user_id'],
                'user_profile_id' => $profileMap[$log['user_id']],
                'amount' => $log['amount'],
                'type' => $log['type'],
                'description' => $log['description'],
                'created_at' => $log['created_at'],
                'updated_at' => $log['created_at'],
            ];
            if (isset($log['reference_type'])) {
                $insert['reference_type'] = $log['reference_type'];
                $insert['reference_id'] = $log['reference_id'];
            }
            DB::table('xp_logs')->insert($insert);
        }

        // =====================================================================
        // 7. BADGES
        // =====================================================================

        DB::table('badges')->insert([
            [
                'name' => 'First Task', 'description' => 'Menyelesaikan tugas pertama',
                'icon' => 'first-task.png', 'category' => 'achievement',
                'criteria' => json_encode(['tasks_completed' => 1]), 'xp_reward' => 10,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Streak Master', 'description' => 'Login 7 hari berturut-turut',
                'icon' => 'streak-7.png', 'category' => 'streak',
                'criteria' => json_encode(['streak_days' => 7]), 'xp_reward' => 100,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Top Performer', 'description' => 'Masuk top 3 leaderboard mingguan',
                'icon' => 'top-3.png', 'category' => 'rank',
                'criteria' => json_encode(['weekly_rank' => 3]), 'xp_reward' => 200,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Rajin Belajar', 'description' => 'Menyelesaikan 5 tugas',
                'icon' => 'rajin.png', 'category' => 'achievement',
                'criteria' => json_encode(['tasks_completed' => 5]), 'xp_reward' => 50,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Bintang Kelas', 'description' => 'XP tertinggi di kelas selama sebulan',
                'icon' => 'bintang.png', 'category' => 'rank',
                'criteria' => json_encode(['monthly_rank' => 1]), 'xp_reward' => 300,
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // Assign badges ke Budi & Siti
        DB::table('user_badges')->insert([
            ['user_id' => 3, 'badge_id' => 1, 'earned_at' => now()->subDays(30), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'badge_id' => 2, 'earned_at' => now()->subDays(21), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'badge_id' => 3, 'earned_at' => now()->subDays(7), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'badge_id' => 4, 'earned_at' => now()->subDays(10), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'badge_id' => 1, 'earned_at' => now()->subDays(25), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'badge_id' => 2, 'earned_at' => now()->subDays(7), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'badge_id' => 4, 'earned_at' => now()->subDays(10), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 5, 'badge_id' => 1, 'earned_at' => now()->subDays(18), 'created_at' => now(), 'updated_at' => now()],
        ]);

        // =====================================================================
        // 8. STREAK DATA
        // =====================================================================

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            if ($i % 2 == 0) continue;

            DB::table('streaks')->insert([
                'user_id' => 3, 'date' => $date, 'login_count' => 1,
                'activities' => json_encode(['viewed_materials' => rand(1, 3), 'submitted' => rand(0, 1)]),
                'created_at' => $date, 'updated_at' => $date,
            ]);
        }

        // =====================================================================
        // 9. MATERIALS & ASSIGNMENTS per kelas
        // =====================================================================

        $materials = [
            // XI RPL 1 (history) — PW (ganjil)
            ['class_id' => 1, 'subject_id' => 1, 'title' => 'Pengenalan HTML Dasar',       'content' => 'HTML adalah bahasa markup untuk membuat struktur halaman web...', 'semester' => 'ganjil'],
            ['class_id' => 1, 'subject_id' => 1, 'title' => 'CSS Dasar - Styling',          'content' => 'CSS digunakan untuk mempercantik tampilan halaman web...',        'semester' => 'ganjil'],
            // XI RPL 1 (history) — BD (ganjil)
            ['class_id' => 1, 'subject_id' => 2, 'title' => 'Konsep Basis Data',            'content' => 'Basis data adalah kumpulan data yang terorganisir...',            'semester' => 'ganjil'],
            ['class_id' => 1, 'subject_id' => 2, 'title' => 'SQL Dasar - SELECT & JOIN',    'content' => 'SQL digunakan untuk memanipulasi data dalam database...',        'semester' => 'ganjil'],
            // XII RPL 1 — PW (ganjil)
            ['class_id' => 2, 'subject_id' => 1, 'title' => 'Pengenalan HTML5',             'content' => 'HTML5 adalah standar terbaru untuk membuat struktur halaman web...', 'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 1, 'title' => 'Dasar CSS3 - Selectors',       'content' => 'CSS3 selectors digunakan untuk memilih element HTML yang akan di-style...', 'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 1, 'title' => 'Flexbox Layout',               'content' => 'Flexbox adalah layout module CSS3 yang memudahkan penyusunan element...', 'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 1, 'title' => 'Intro JavaScript ES6+',        'content' => 'ES6 membawa banyak fitur baru ke JavaScript...',                  'semester' => 'ganjil'],
            // XII RPL 1 — BD (genap)
            ['class_id' => 2, 'subject_id' => 2, 'title' => 'Konsep Normalisasi Database',  'content' => 'Normalisasi adalah proses mengorganisasi database...',            'semester' => 'genap'],
            ['class_id' => 2, 'subject_id' => 2, 'title' => 'ERD dan Relational Model',     'content' => 'Entity Relationship Diagram (ERD) adalah visualisasi hubungan antar entitas...', 'semester' => 'genap'],
            // XII RPL 1 — PBO (genap)
            ['class_id' => 2, 'subject_id' => 3, 'title' => 'Konsep OOP',                   'content' => 'Object-Oriented Programming adalah paradigma pemrograman berbasis objek...', 'semester' => 'genap'],
            ['class_id' => 2, 'subject_id' => 3, 'title' => 'Inheritance & Polymorphism',   'content' => 'Inheritance memungkinkan suatu kelas mewarisi sifat dari kelas lain...', 'semester' => 'genap'],
            // XII RPL 2 — PW (ganjil)
            ['class_id' => 3, 'subject_id' => 1, 'title' => 'Dasar HTML dan CSS',           'content' => 'HTML adalah kerangka dan CSS adalah styling dari halaman web...',    'semester' => 'ganjil'],
            ['class_id' => 3, 'subject_id' => 1, 'title' => 'JavaScript Dasar',             'content' => 'JavaScript adalah bahasa pemrograman untuk web interaktif...',     'semester' => 'ganjil'],
            // XII RPL 2 — BD (genap)
            ['class_id' => 3, 'subject_id' => 2, 'title' => 'Pengenalan Database',          'content' => 'Database adalah kumpulan data terorganisir yang disimpan secara elektronik...', 'semester' => 'genap'],
            ['class_id' => 3, 'subject_id' => 2, 'title' => 'SQL Dasar',                    'content' => 'SQL adalah bahasa standar untuk mengelola database relasional...', 'semester' => 'genap'],
        ];

        foreach ($materials as $m) {
            DB::table('materials')->insert([
                'class_id' => $m['class_id'], 'subject_id' => $m['subject_id'],
                'user_id' => 2, 'title' => $m['title'], 'content' => $m['content'],
                'semester' => $m['semester'],
                'is_published' => true, 'published_at' => now(),
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        $assignments = [
            // XI RPL 1 (history) — PW (ganjil)
            ['class_id' => 1, 'subject_id' => 1, 'title' => 'Halaman Web Pertama',         'desc' => 'Buat halaman web sederhana dengan HTML dan CSS...', 'xp' => 40, 'deadline' => 7,  'semester' => 'ganjil'],
            ['class_id' => 1, 'subject_id' => 1, 'title' => 'CSS Layout Sederhana',         'desc' => 'Implementasikan layout halaman menggunakan flexbox...', 'xp' => 45, 'deadline' => 14, 'semester' => 'ganjil'],
            // XI RPL 1 (history) — BD (ganjil)
            ['class_id' => 1, 'subject_id' => 2, 'title' => 'Tabel SQL Dasar',             'desc' => 'Buat query CREATE TABLE dan INSERT data...', 'xp' => 40, 'deadline' => 7,  'semester' => 'ganjil'],
            ['class_id' => 1, 'subject_id' => 2, 'title' => 'Query JOIN SQL',              'desc' => 'Buat query menggunakan INNER JOIN, LEFT JOIN...', 'xp' => 50, 'deadline' => 12, 'semester' => 'ganjil'],
            // XII RPL 1 — PW (ganjil)
            ['class_id' => 2, 'subject_id' => 1, 'title' => 'Buat Halaman Portfolio',       'desc' => 'Buat halaman portfolio pribadi menggunakan HTML5 dan CSS3...', 'xp' => 50, 'deadline' => 7,  'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 1, 'title' => 'Implementasi Flexbox Layout',  'desc' => 'Buat halaman web yang menggunakan Flexbox untuk layout...', 'xp' => 50, 'deadline' => 10, 'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 1, 'title' => 'Kalkulator Sederhana dengan JS','desc' => 'Buat aplikasi kalkulator menggunakan HTML, CSS, dan JavaScript...', 'xp' => 75, 'deadline' => 14, 'semester' => 'ganjil'],
            // XII RPL 1 — BD (genap)
            ['class_id' => 2, 'subject_id' => 2, 'title' => 'Buat ERD Perpustakaan',        'desc' => 'Buat ERD untuk sistem perpustakaan...', 'xp' => 60, 'deadline' => 5,  'semester' => 'genap'],
            ['class_id' => 2, 'subject_id' => 2, 'title' => 'Normalisasi Database',         'desc' => 'Lakukan normalisasi dari 1NF hingga 3NF...', 'xp' => 60, 'deadline' => 12, 'semester' => 'genap'],
            // XII RPL 1 — PBO (genap)
            ['class_id' => 2, 'subject_id' => 3, 'title' => 'Buat Class Diagram',           'desc' => 'Buat class diagram untuk sistem perpustakaan...', 'xp' => 60, 'deadline' => 8,  'semester' => 'genap'],
            ['class_id' => 2, 'subject_id' => 3, 'title' => 'Implementasi Inheritance',     'desc' => 'Buat program Java yang mengimplementasikan inheritance...', 'xp' => 75, 'deadline' => 15, 'semester' => 'genap'],
            // XII RPL 2 — PW (ganjil)
            ['class_id' => 3, 'subject_id' => 1, 'title' => 'Buat Halaman Web Sederhana',   'desc' => 'Buat halaman web dengan HTML dan CSS...', 'xp' => 40, 'deadline' => 7,  'semester' => 'ganjil'],
            ['class_id' => 3, 'subject_id' => 1, 'title' => 'Form Input dengan JavaScript', 'desc' => 'Buat form input dengan validasi JavaScript...', 'xp' => 50, 'deadline' => 14, 'semester' => 'ganjil'],
            // XII RPL 2 — BD (genap)
            ['class_id' => 3, 'subject_id' => 2, 'title' => 'Query SQL Dasar',              'desc' => 'Buat query SELECT, INSERT, UPDATE, DELETE...', 'xp' => 40, 'deadline' => 7,  'semester' => 'genap'],
            ['class_id' => 3, 'subject_id' => 2, 'title' => 'Design Database Sederhana',    'desc' => 'Rancang database untuk sistem inventory...', 'xp' => 60, 'deadline' => 14, 'semester' => 'genap'],
        ];

        foreach ($assignments as $a) {
            DB::table('assignments')->insert([
                'class_id' => $a['class_id'], 'subject_id' => $a['subject_id'],
                'user_id' => 2, 'title' => $a['title'], 'description' => $a['desc'],
                'max_score' => 100, 'xp_reward' => $a['xp'],
                'semester' => $a['semester'],
                'deadline' => now()->addDays($a['deadline']),
                'is_published' => true,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // =====================================================================
        // 10. SUBMISSIONS & GRADES
        // =====================================================================

        // Budi sudah submit beberapa tugas sebelumnya
        DB::table('submissions')->insert([
            [
                'assignment_id' => 5, 'user_id' => 3,
                'answer_text' => 'Saya sudah membuat portfolio dengan HTML dan CSS. Link: github.com/budi/portfolio',
                'submitted_at' => now()->subDays(5), 'status' => 'graded',
                'created_at' => now()->subDays(5), 'updated_at' => now()->subDays(4),
            ],
            [
                'assignment_id' => 6, 'user_id' => 3,
                'answer_text' => 'Implementasi flexbox sudah selesai dengan navbar, cards, dan sidebar.',
                'submitted_at' => now()->subDays(3), 'status' => 'graded',
                'created_at' => now()->subDays(3), 'updated_at' => now()->subDays(2),
            ],
            [
                'assignment_id' => 8, 'user_id' => 3,
                'answer_text' => 'ERD perpustakaan sudah dibuat dengan entitas Buku, Anggota, Peminjaman.',
                'submitted_at' => now()->subDays(1), 'status' => 'pending',
                'created_at' => now()->subDays(1), 'updated_at' => now()->subDays(1),
            ],
        ]);

        DB::table('grades')->insert([
            [
                'submission_id' => 1, 'user_id' => 2,
                'score' => 88, 'feedback' => 'Bagus! Struktur HTML rapi. Tingkatkan styling CSS.',
                'graded_at' => now()->subDays(4),
                'created_at' => now()->subDays(4), 'updated_at' => now()->subDays(4),
            ],
            [
                'submission_id' => 2, 'user_id' => 2,
                'score' => 92, 'feedback' => 'Flexbox sudah tepat. Layout responsive bagus.',
                'graded_at' => now()->subDays(2),
                'created_at' => now()->subDays(2), 'updated_at' => now()->subDays(2),
            ],
        ]);

        // =====================================================================
        // 11. QUESTS
        // =====================================================================

        DB::table('quests')->insert([
            [
                'title' => 'Selesaikan 1 Tugas Hari Ini',
                'description' => 'Kumpulkan minimal 1 tugas hari ini untuk mendapatkan XP bonus',
                'type' => 'daily', 'xp_reward' => 30,
                'criteria' => json_encode(['tasks_per_day' => 1]),
                'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'title' => 'Baca 2 Materi Baru',
                'description' => 'Baca minimal 2 materi yang belum pernah dibaca sebelumnya',
                'type' => 'daily', 'xp_reward' => 20,
                'criteria' => json_encode(['materials_read' => 2]),
                'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'title' => 'Selesaikan 3 Tugas Minggu Ini',
                'description' => 'Kumpulkan minimal 3 tugas dalam seminggu',
                'type' => 'weekly', 'xp_reward' => 100,
                'criteria' => json_encode(['tasks_per_week' => 3]),
                'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'title' => 'Login 5 Hari Berturut-turut',
                'description' => 'Login ke platform selama 5 hari tanpa putus',
                'type' => 'weekly', 'xp_reward' => 150,
                'criteria' => json_encode(['streak_days' => 5]),
                'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'title' => 'Raih Level 3',
                'description' => 'Kumpulkan XP hingga mencapai level 3',
                'type' => 'special', 'xp_reward' => 200,
                'criteria' => json_encode(['reach_level' => 3]),
                'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'title' => 'Top 3 Leaderboard Kelas',
                'description' => 'Masuk peringkat 3 besar di leaderboard kelas',
                'type' => 'special', 'xp_reward' => 300,
                'criteria' => json_encode(['weekly_rank' => 3]),
                'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // =====================================================================
        // 12. DAILY & WEEKLY CHALLENGES
        // =====================================================================

        DB::table('daily_challenges')->insert([
            [
                'title' => 'Submit Tugas Hari Ini',
                'description' => 'Kumpulkan minimal 1 tugas hari ini',
                'criteria' => json_encode(['tasks_submitted' => 1]),
                'xp_reward' => 25, 'date' => now()->toDateString(),
                'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'title' => 'Login dan Baca Materi',
                'description' => 'Login dan buka minimal 1 materi hari ini',
                'criteria' => json_encode(['materials_viewed' => 1]),
                'xp_reward' => 15, 'date' => now()->toDateString(),
                'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        DB::table('weekly_challenges')->insert([
            [
                'title' => 'Semangat Belajar Mingguan',
                'description' => 'Selesaikan minimal 2 tugas dalam minggu ini',
                'criteria' => json_encode(['tasks_completed_weekly' => 2]),
                'xp_reward' => 75,
                'week_start' => now()->startOfWeek()->toDateString(),
                'week_end' => now()->endOfWeek()->toDateString(),
                'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // =====================================================================
        // 13. LEADERBOARD CACHE
        // =====================================================================

        DB::table('leaderboard_cache')->insert([
            ['user_id' => 3, 'class_id' => 2, 'scope' => 'class', 'total_xp' => 2850, 'period' => 'weekly', 'rank' => 1, 'cached_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'class_id' => 2, 'scope' => 'class', 'total_xp' => 1820, 'period' => 'weekly', 'rank' => 2, 'cached_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 5, 'class_id' => 2, 'scope' => 'class', 'total_xp' => 950,  'period' => 'weekly', 'rank' => 3, 'cached_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 6, 'class_id' => 3, 'scope' => 'class', 'total_xp' => 520,  'period' => 'weekly', 'rank' => 1, 'cached_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 7, 'class_id' => 3, 'scope' => 'class', 'total_xp' => 380,  'period' => 'weekly', 'rank' => 2, 'cached_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 8, 'class_id' => 3, 'scope' => 'class', 'total_xp' => 120,  'period' => 'weekly', 'rank' => 3, 'cached_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'class_id' => 2, 'scope' => 'class', 'total_xp' => 2850, 'period' => 'monthly', 'rank' => 1, 'cached_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'class_id' => 2, 'scope' => 'class', 'total_xp' => 1820, 'period' => 'monthly', 'rank' => 2, 'cached_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'class_id' => 2, 'scope' => 'school', 'total_xp' => 2850, 'period' => 'all_time', 'rank' => 1, 'cached_at' => now(), 'created_at' => now(), 'updated_at' => now()],
        ]);

        // =====================================================================
        // 14. USER QUESTS (active & completed)
        // =====================================================================

        DB::table('user_quests')->insert([
            ['user_id' => 3, 'quest_id' => 1, 'assignment_id' => null, 'status' => 'completed', 'progress' => 100, 'completed_at' => now()->subDays(1), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'quest_id' => 3, 'assignment_id' => null, 'status' => 'active', 'progress' => 66,   'completed_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'quest_id' => 5, 'assignment_id' => null, 'status' => 'completed', 'progress' => 100, 'completed_at' => now()->subDays(10), 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'quest_id' => 1, 'assignment_id' => null, 'status' => 'active', 'progress' => 50,   'completed_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 5, 'quest_id' => 1, 'assignment_id' => null, 'status' => 'active', 'progress' => 30,   'completed_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 6, 'quest_id' => 1, 'assignment_id' => null, 'status' => 'active', 'progress' => 10,   'completed_at' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // =====================================================================
        // 15. NOTIFICATIONS
        // =====================================================================

        DB::table('notifications')->insert([
            ['user_id' => 3, 'title' => 'Badge Baru!', 'message' => 'Kamu mendapatkan badge First Task!', 'type' => 'achievement', 'created_at' => now()->subDays(30), 'updated_at' => now()->subDays(30)],
            ['user_id' => 3, 'title' => 'Streak 7 Hari!', 'message' => 'Kamu berhasil login 7 hari berturut-turut. +100 XP', 'type' => 'reward', 'created_at' => now()->subDays(21), 'updated_at' => now()->subDays(21)],
            ['user_id' => 3, 'title' => 'Tugas Dinilai', 'message' => 'Tugas Portfolio-mu sudah dinilai: 88/100', 'type' => 'system', 'created_at' => now()->subDays(4), 'updated_at' => now()->subDays(4)],
            ['user_id' => 4, 'title' => 'Badge Baru!', 'message' => 'Kamu mendapatkan badge First Task!', 'type' => 'achievement', 'created_at' => now()->subDays(25), 'updated_at' => now()->subDays(25)],
        ]);

        // =====================================================================
        // 16. GAMIFICATION RULES CONFIG
        // =====================================================================

        $rules = [
            'xp' => [
                'assignment_completed' => 50,
                'early_submission' => 20,
                'daily_login' => 10,
                'streak_7_days' => 100,
                'streak_30_days' => 500,
            ],
            'level' => [
                'formula' => 'floor(sqrt(total_xp / 100)) + 1',
                'base_xp' => 100,
            ],
        ];

        \File::put(
            config_path('gamification-rules.json'),
            json_encode($rules, JSON_PRETTY_PRINT)
        );
    }
}
