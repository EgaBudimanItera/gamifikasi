<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NpcSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $npcs = [
            [
                'subject_id' => 6,
                'name' => 'Kak Kode',
                'personality' => 'Encouraging mentor yang suka tantangan informatika dan komputer',
                'dialogs' => json_encode([
                    'level_1' => 'Halo {name}! Saya Kak Kode. Mau tantangan informatika hari ini?',
                    'level_2' => 'Hei {name}! Kamu sudah lebih baik. Coba tantangan yang lebih sulit!',
                    'level_3' => '{name}! Kamu sudah jauh berkembang. Siap untuk tantangan hard?',
                    'level_4' => '{name} adalah murid terbaikku! Quest LEGENDARY terbuka untukmu!',
                    'level_5' => '{name}, kamu sudah melebihi ekspektasiku. Mari berbagi rahasia coding!',
                ]),
            ],
            [
                'subject_id' => 2,
                'name' => 'Kak Angka',
                'personality' => 'Puzzle master yang suka teka-teki matematika dan angka',
                'dialogs' => json_encode([
                    'level_1' => 'Halo {name}! Saya Kak Angka. Mau coba teka-teki matematika?',
                    'level_2' => '{name}! Kamu sudah paham dasarnya. Coba yang lebih menantang!',
                    'level_3' => 'Keren {name}! Kamu sudah jago. Siap untuk puzzle sulit?',
                    'level_4' => '{name}! Kamu adalah master matematika! Quest LEGENDARY menunggu!',
                    'level_5' => '{name}, kamu sudah seperti rekan kerjaku. Mari kita solve mystery bersama!',
                ]),
            ],
            [
                'subject_id' => 1,
                'name' => 'Kak Sastra',
                'personality' => 'Wise mentor yang suka sastra, puisi, dan teks Indonesia',
                'dialogs' => json_encode([
                    'level_1' => 'Halo {name}! Saya Kak Sastra. Bahasa adalah jendela dunia. Mau uji kemampuanmu?',
                    'level_2' => '{name}! Pemahamanmu sudah tajam. Coba tantangan yang lebih kompleks!',
                    'level_3' => 'Luar biasa {name}! Kamu sudah seperti penulis muda. Siap harder?',
                    'level_4' => '{name}! Kamu adalah bintang sastra! Quest LEGENDARY terbuka!',
                    'level_5' => '{name}, kamu sudah setara denganku. Mari kita create karya bersama!',
                ]),
            ],
        ];

        foreach ($npcs as $npc) {
            DB::table('npcs')->insert(array_merge($npc, [
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}
