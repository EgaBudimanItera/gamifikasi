<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $password = Hash::make('password');

        // Admin
        DB::table('users')->insert([
            'id' => 1, 'name' => 'Admin EduQuest', 'email' => 'admin@eduquest.com',
            'password' => $password, 'role_id' => 1, 'school_id' => 1,
            'email_verified_at' => $now, 'created_at' => $now, 'updated_at' => $now,
        ]);

        // Guru (3 orang)
        $teachers = [
            ['id' => 2,  'name' => 'Putri Oktaria',        'email' => 'putri.oktaria@eduquest.com'],
            ['id' => 9,  'name' => 'Bapak Ahmad Fauzi',    'email' => 'ahmad.fauzi@eduquest.com'],
            ['id' => 10, 'name' => 'Ibu Ratna Sari',       'email' => 'ratna.sari@eduquest.com'],
        ];

        foreach ($teachers as $t) {
            DB::table('users')->insert([
                'id' => $t['id'], 'name' => $t['name'], 'email' => $t['email'],
                'password' => $password, 'role_id' => 2, 'school_id' => 1,
                'email_verified_at' => $now, 'created_at' => $now, 'updated_at' => $now,
            ]);
        }

        // Siswa (20 orang)
        $students = [
            ['id' => 3,  'name' => 'Budi Santoso',        'email' => 'siswa1@eduquest.com'],
            ['id' => 4,  'name' => 'Siti Rahmawati',      'email' => 'siswa2@eduquest.com'],
            ['id' => 5,  'name' => 'Adi Pratama',         'email' => 'siswa3@eduquest.com'],
            ['id' => 6,  'name' => 'Rina Maryani',        'email' => 'siswa4@eduquest.com'],
            ['id' => 7,  'name' => 'Dimas Ardiansyah',    'email' => 'siswa5@eduquest.com'],
            ['id' => 8,  'name' => 'Citra Lestari',       'email' => 'siswa6@eduquest.com'],
            ['id' => 11, 'name' => 'Andi Wijaya',         'email' => 'siswa7@eduquest.com'],
            ['id' => 12, 'name' => 'Maya Putri',          'email' => 'siswa8@eduquest.com'],
            ['id' => 13, 'name' => 'Rizky Prasetyo',      'email' => 'siswa9@eduquest.com'],
            ['id' => 14, 'name' => 'Dian Kusuma',         'email' => 'siswa10@eduquest.com'],
            ['id' => 15, 'name' => 'Fajar Nugroho',       'email' => 'siswa11@eduquest.com'],
            ['id' => 16, 'name' => 'Yoga Pratama',        'email' => 'siswa12@eduquest.com'],
            ['id' => 17, 'name' => 'Angga Firmansyah',    'email' => 'siswa13@eduquest.com'],
            ['id' => 18, 'name' => 'Novi Anggraini',      'email' => 'siswa14@eduquest.com'],
            ['id' => 19, 'name' => 'Bayu Setiawan',       'email' => 'siswa15@eduquest.com'],
            ['id' => 20, 'name' => 'Intan Permata',       'email' => 'siswa16@eduquest.com'],
            ['id' => 21, 'name' => 'Galih Purnama',       'email' => 'siswa17@eduquest.com'],
            ['id' => 22, 'name' => 'Wulan Sari',          'email' => 'siswa18@eduquest.com'],
            ['id' => 23, 'name' => 'Arif Rahman',         'email' => 'siswa19@eduquest.com'],
            ['id' => 24, 'name' => 'Dewi Sartika',        'email' => 'siswa20@eduquest.com'],
        ];

        foreach ($students as $s) {
            DB::table('users')->insert([
                'id' => $s['id'], 'name' => $s['name'], 'email' => $s['email'],
                'password' => $password, 'role_id' => 3, 'school_id' => 1,
                'email_verified_at' => $now, 'created_at' => $now, 'updated_at' => $now,
            ]);
        }
    }
}
