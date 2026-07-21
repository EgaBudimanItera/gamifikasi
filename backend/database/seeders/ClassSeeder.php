<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Classes — Kelas VII
        DB::table('classes')->insert([
            ['id' => 1, 'school_id' => 1, 'academic_year_id' => 1, 'name' => 'VII A', 'grade_level' => 7, 'created_at' => $now->copy()->subYear(), 'updated_at' => $now->copy()->subYear()],
            ['id' => 2, 'school_id' => 1, 'academic_year_id' => 2, 'name' => 'VII A', 'grade_level' => 7, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'school_id' => 1, 'academic_year_id' => 2, 'name' => 'VII B', 'grade_level' => 7, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'school_id' => 1, 'academic_year_id' => 2, 'name' => 'VII C', 'grade_level' => 7, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'school_id' => 1, 'academic_year_id' => 2, 'name' => 'VII D', 'grade_level' => 7, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // Teacher Assignments (class_subject)
        // Putri Oktaria (id=2) — Bahasa Indonesia, Matematika, Informatika
        DB::table('class_subject')->insert([
            // Putri Oktaria — VII A (class 2, tahun ajaran aktif)
            ['class_id' => 2, 'subject_id' => 1, 'user_id' => 2, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            ['class_id' => 2, 'subject_id' => 2, 'user_id' => 2, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            ['class_id' => 2, 'subject_id' => 6, 'user_id' => 2, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            // Putri Oktaria — VII B (class 3)
            ['class_id' => 3, 'subject_id' => 1, 'user_id' => 2, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            ['class_id' => 3, 'subject_id' => 2, 'user_id' => 2, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            ['class_id' => 3, 'subject_id' => 6, 'user_id' => 2, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],

            // Bapak Ahmad Fauzi (id=9) — IPA
            ['class_id' => 2, 'subject_id' => 4, 'user_id' => 9, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            ['class_id' => 3, 'subject_id' => 4, 'user_id' => 9, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            ['class_id' => 4, 'subject_id' => 4, 'user_id' => 9, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            ['class_id' => 5, 'subject_id' => 4, 'user_id' => 9, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],

            // Ibu Ratna Sari (id=10) — Bahasa Inggris, IPS
            ['class_id' => 2, 'subject_id' => 3, 'user_id' => 10, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            ['class_id' => 2, 'subject_id' => 5, 'user_id' => 10, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            ['class_id' => 3, 'subject_id' => 3, 'user_id' => 10, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            ['class_id' => 3, 'subject_id' => 5, 'user_id' => 10, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            ['class_id' => 4, 'subject_id' => 3, 'user_id' => 10, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            ['class_id' => 4, 'subject_id' => 5, 'user_id' => 10, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            ['class_id' => 5, 'subject_id' => 3, 'user_id' => 10, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
            ['class_id' => 5, 'subject_id' => 5, 'user_id' => 10, 'semester' => 'ganjil', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // Student Enrollment (student_classes) — kelas VII tahun ajaran aktif
        DB::table('student_classes')->insert([
            // VII A (class 2) — 10 siswa
            ['user_id' => 3,  'class_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 4,  'class_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 5,  'class_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 11, 'class_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 12, 'class_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 13, 'class_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 14, 'class_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 15, 'class_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 23, 'class_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 24, 'class_id' => 2, 'created_at' => $now, 'updated_at' => $now],

            // VII B (class 3) — 10 siswa
            ['user_id' => 6,  'class_id' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 7,  'class_id' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 8,  'class_id' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 16, 'class_id' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 17, 'class_id' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 18, 'class_id' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 19, 'class_id' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 20, 'class_id' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 21, 'class_id' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 22, 'class_id' => 3, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
