<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NpcQuestSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $quests = [
            // Kak Kode (NPC id=1, subject_id=6 Informatika) — 10 quests
            ['npc_id' => 1, 'question' => 'Apa komponen utama komputer untuk memproses data?', 'options' => ['CPU', 'Monitor', 'Keyboard', 'Printer'], 'correct_answer' => 'CPU', 'difficulty' => 'easy', 'xp_reward' => 10, 'required_affinity_level' => 1],
            ['npc_id' => 1, 'question' => 'Apa kepanjangan dari RAM?', 'options' => ['Random Access Memory', 'Read Access Memory', 'Run All Memory', 'Random Action Memory'], 'correct_answer' => 'Random Access Memory', 'difficulty' => 'easy', 'xp_reward' => 10, 'required_affinity_level' => 1],
            ['npc_id' => 1, 'question' => 'Perangkat lunak untuk mengetik teks disebut?', 'options' => ['Word Processor', 'Spreadsheet', 'Browser', 'Media Player'], 'correct_answer' => 'Word Processor', 'difficulty' => 'easy', 'xp_reward' => 12, 'required_affinity_level' => 1],
            ['npc_id' => 1, 'question' => 'Apa fungsi dari browser?', 'options' => ['Menjelajahi website', 'Mengedit foto', 'Memutar musik', 'Menghitung angka'], 'correct_answer' => 'Menjelajahi website', 'difficulty' => 'medium', 'xp_reward' => 20, 'required_affinity_level' => 2],
            ['npc_id' => 1, 'question' => 'Apa itu search engine?', 'options' => ['Mesin pencari informasi', 'Program olahraga', 'Alat musik', 'Jenis komputer'], 'correct_answer' => 'Mesin pencari informasi', 'difficulty' => 'medium', 'xp_reward' => 20, 'required_affinity_level' => 2],
            ['npc_id' => 1, 'question' => 'Apa dampak negatif penggunaan internet yang berlebihan?', 'options' => ['Kecanduan dan kelelahan mata', 'Menambah tinggi badan', 'Meningkatkan kekuatan', 'Membuat otak lebih kecil'], 'correct_answer' => 'Kecanduan dan kelelahan mata', 'difficulty' => 'medium', 'xp_reward' => 25, 'required_affinity_level' => 2],
            ['npc_id' => 1, 'question' => 'Apa itu phishing?', 'options' => ['Penipuan online untuk mencuri data', 'Teknik memancing ikan', 'Jenis virus', 'Program antivirus'], 'correct_answer' => 'Penipuan online untuk mencuri data', 'difficulty' => 'hard', 'xp_reward' => 30, 'required_affinity_level' => 3],
            ['npc_id' => 1, 'question' => 'Apa itu cloud computing?', 'options' => ['Komputasi berbasis internet', 'Komputer awan cuaca', 'Jenis database', 'Program presentasi'], 'correct_answer' => 'Komputasi berbasis internet', 'difficulty' => 'hard', 'xp_reward' => 35, 'required_affinity_level' => 3],
            ['npc_id' => 1, 'question' => 'Apa itu keamanan siber (cybersecurity)?', 'options' => ['Melindungi sistem dari ancaman digital', 'Bermain game online', 'Membuat website', 'Menginstall printer'], 'correct_answer' => 'Melindungi sistem dari ancaman digital', 'difficulty' => 'legendary', 'xp_reward' => 50, 'required_affinity_level' => 4],
            ['npc_id' => 1, 'question' => 'Cara membuat password yang aman adalah?', 'options' => ['Kombinasi huruf, angka, simbol, minimal 8 karakter', 'Gunakan tanggal lahir', 'Gunakan nama sendiri', 'Gunakan "123456"'], 'correct_answer' => 'Kombinasi huruf, angka, simbol, minimal 8 karakter', 'difficulty' => 'legendary', 'xp_reward' => 60, 'required_affinity_level' => 4],

            // Kak Angka (NPC id=2, subject_id=2 Matematika) — 10 quests
            ['npc_id' => 2, 'question' => 'Hasil dari -5 + 3 adalah?', 'options' => ['-2', '2', '-8', '8'], 'correct_answer' => '-2', 'difficulty' => 'easy', 'xp_reward' => 10, 'required_affinity_level' => 1],
            ['npc_id' => 2, 'question' => 'Pecahan dari 0.5 adalah?', 'options' => ['1/2', '1/3', '2/3', '1/4'], 'correct_answer' => '1/2', 'difficulty' => 'easy', 'xp_reward' => 10, 'required_affinity_level' => 1],
            ['npc_id' => 2, 'question' => 'Rumus luas persegi adalah?', 'options' => ['sisi × sisi', 'panjang × lebar', '2 × (p+l)', 'π × r²'], 'correct_answer' => 'sisi × sisi', 'difficulty' => 'easy', 'xp_reward' => 12, 'required_affinity_level' => 1],
            ['npc_id' => 2, 'question' => 'Jika 2x + 6 = 14, maka x = ?', 'options' => ['4', '5', '6', '3'], 'correct_answer' => '4', 'difficulty' => 'medium', 'xp_reward' => 20, 'required_affinity_level' => 2],
            ['npc_id' => 2, 'question' => 'Mean dari data 4, 6, 8, 10, 12 adalah?', 'options' => ['8', '7', '9', '10'], 'correct_answer' => '8', 'difficulty' => 'medium', 'xp_reward' => 20, 'required_affinity_level' => 2],
            ['npc_id' => 2, 'question' => 'Rumus luas lingkaran adalah?', 'options' => ['π × r²', '2 × π × r', 'π × d', 'r² × 2'], 'correct_answer' => 'π × r²', 'difficulty' => 'medium', 'xp_reward' => 25, 'required_affinity_level' => 2],
            ['npc_id' => 2, 'question' => 'Nilai dari 2³ adalah?', 'options' => ['8', '6', '9', '12'], 'correct_answer' => '8', 'difficulty' => 'hard', 'xp_reward' => 30, 'required_affinity_level' => 3],
            ['npc_id' => 2, 'question' => 'Median dari data 3, 5, 7, 9, 11 adalah?', 'options' => ['7', '5', '9', '6'], 'correct_answer' => '7', 'difficulty' => 'hard', 'xp_reward' => 35, 'required_affinity_level' => 3],
            ['npc_id' => 2, 'question' => 'Jika x² = 49, maka x = ?', 'options' => ['7', '-7', '7 atau -7', '24'], 'correct_answer' => '7 atau -7', 'difficulty' => 'legendary', 'xp_reward' => 50, 'required_affinity_level' => 4],
            ['npc_id' => 2, 'question' => 'Modus dari data 2, 3, 3, 5, 7, 3, 8 adalah?', 'options' => ['3', '5', '4', '7'], 'correct_answer' => '3', 'difficulty' => 'legendary', 'xp_reward' => 60, 'required_affinity_level' => 4],

            // Kak Sastra (NPC id=3, subject_id=1 Bahasa Indonesia) — 10 quests
            ['npc_id' => 3, 'question' => 'Teks eksposisi bertujuan untuk?', 'options' => ['Memberikan informasi', 'Menghibur', 'Membujuk', 'Menceritakan'], 'correct_answer' => 'Memberikan informasi', 'difficulty' => 'easy', 'xp_reward' => 10, 'required_affinity_level' => 1],
            ['npc_id' => 3, 'question' => 'Struktur teks eksposisi yang pertama adalah?', 'options' => ['Tesis', 'Argumen', 'Penegasan', 'Kesimpulan'], 'correct_answer' => 'Tesis', 'difficulty' => 'easy', 'xp_reward' => 10, 'required_affinity_level' => 1],
            ['npc_id' => 3, 'question' => 'Teks deskripsi menggambarkan sesuatu secara?', 'options' => ['Rinci dan detail', 'Singkat saja', 'Berupa dialog', 'Hanya judul'], 'correct_answer' => 'Rinci dan detail', 'difficulty' => 'easy', 'xp_reward' => 12, 'required_affinity_level' => 1],
            ['npc_id' => 3, 'question' => 'Majas metafora adalah?', 'options' => ['Perbandingan tidak menggunakan kata seperti/as', 'Perulangan kata', 'Pertanyaan tanpa jawaban', 'Pengulangan bunyi'], 'correct_answer' => 'Perbandingan tidak menggunakan kata seperti/as', 'difficulty' => 'medium', 'xp_reward' => 20, 'required_affinity_level' => 2],
            ['npc_id' => 3, 'question' => 'Ciri khas puisi adalah?', 'options' => ['Memiliki rima dan irama', 'Memiliki banyak paragraf', 'Berisi dialog', 'Seperti artikel'], 'correct_answer' => 'Memiliki rima dan irama', 'difficulty' => 'medium', 'xp_reward' => 20, 'required_affinity_level' => 2],
            ['npc_id' => 3, 'question' => 'Teks narasi menceritakan suatu?', 'options' => ['Peristiwa atau kejadian', 'Deskripsi tempat', 'Argumen pendapat', 'Fakta ilmiah'], 'correct_answer' => 'Peristiwa atau kejadian', 'difficulty' => 'medium', 'xp_reward' => 25, 'required_affinity_level' => 2],
            ['npc_id' => 3, 'question' => 'Majas personifikasi adalah?', 'options' => ['Benda mati diperlakukan seperti manusia', 'Perbandingan langsung', 'Pengulangan kata', 'Suara binatang'], 'correct_answer' => 'Benda mati diperlakukan seperti manusia', 'difficulty' => 'hard', 'xp_reward' => 30, 'required_affinity_level' => 3],
            ['npc_id' => 3, 'question' => 'Unsur intrinsic sastra meliputi?', 'options' => ['Tema, amanat, sudut pandang', 'Judul, pengarang, tahun', 'Harga, berat, warna', 'Halaman, bab, jilid'], 'correct_answer' => 'Tema, amanat, sudut pandang', 'difficulty' => 'hard', 'xp_reward' => 35, 'required_affinity_level' => 3],
            ['npc_id' => 3, 'question' => 'Apa itu retorika?', 'options' => ['Seni berbicara atau menulis yang efektif', 'Jenis puisi lama', 'Alat musik tradisional', 'Nama tokoh sastra'], 'correct_answer' => 'Seni berbicara atau menulis yang efektif', 'difficulty' => 'legendary', 'xp_reward' => 50, 'required_affinity_level' => 4],
            ['npc_id' => 3, 'question' => 'Perbedaan fakta dan opini dalam teks eksposisi adalah?', 'options' => ['Fakta bisa dibuktikan, opini pendapat pribadi', 'Tidak ada bedanya', 'Fiksi dan nonfiksi', 'Puisi dan prosa'], 'correct_answer' => 'Fakta bisa dibuktikan, opini pendapat pribadi', 'difficulty' => 'legendary', 'xp_reward' => 60, 'required_affinity_level' => 4],
        ];

        foreach ($quests as $q) {
            DB::table('npc_quests')->insert(array_merge($q, [
                'options'      => json_encode($q['options']),
                'is_active'    => true,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]));
        }
    }
}
