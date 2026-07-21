<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Roles
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'admin', 'description' => 'System Administrator', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'guru',  'description' => 'Teacher',              'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'siswa', 'description' => 'Student',              'created_at' => $now, 'updated_at' => $now],
        ]);

        // Schools
        DB::table('schools')->insert([
            [
                'id' => 1, 'name' => 'SMPN 1 Nusantara', 'address' => 'Jl. Pendidikan No. 1, Jakarta Selatan',
                'phone' => '021-1234567', 'email' => 'info@smpn1nusantara.sch.id',
                'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'id' => 2, 'name' => 'SMPN 2 Teknologi', 'address' => 'Jl. Teknologi No. 45, Jakarta Barat',
                'phone' => '021-7654321', 'email' => 'info@smpn2teknologi.sch.id',
                'created_at' => $now, 'updated_at' => $now,
            ],
        ]);

        // Academic Years
        DB::table('academic_years')->insert([
            [
                'id' => 1, 'school_id' => 1, 'name' => '2023/2024',
                'start_date' => '2023-07-01', 'end_date' => '2024-06-30',
                'is_active' => false, 'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'id' => 2, 'school_id' => 1, 'name' => '2024/2025',
                'start_date' => '2024-07-01', 'end_date' => '2025-06-30',
                'is_active' => true, 'created_at' => $now, 'updated_at' => $now,
            ],
        ]);

        // Subjects — Kelas VII SMP
        DB::table('subjects')->insert([
            ['id' => 1, 'school_id' => 1, 'name' => 'Bahasa Indonesia',  'code' => 'BIN-7',  'description' => 'Bahasa Indonesia kelas VII',              'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'school_id' => 1, 'name' => 'Matematika',        'code' => 'MTK-7',  'description' => 'Matematika kelas VII',                   'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'school_id' => 1, 'name' => 'Bahasa Inggris',    'code' => 'BIG-7',  'description' => 'Bahasa Inggris kelas VII',              'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'school_id' => 1, 'name' => 'IPA',               'code' => 'IPA-7',  'description' => 'Ilmu Pengetahuan Alam kelas VII',       'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'school_id' => 1, 'name' => 'IPS',               'code' => 'IPS-7',  'description' => 'Ilmu Pengetahuan Sosial kelas VII',     'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'school_id' => 1, 'name' => 'Informatika',       'code' => 'TIK-7',  'description' => 'Teknologi Informasi dan Komunikasi VII', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
