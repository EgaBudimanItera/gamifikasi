<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // =================================================================
        // MATERIALS — Kelas VII SMP
        // =================================================================
        $materials = [
            // VII A (class 2) — Bahasa Indonesia (Putri Oktaria)
            ['class_id' => 2, 'subject_id' => 1, 'user_id' => 2,  'title' => 'Teks Eksposisi',                     'content' => 'Teks eksposisi adalah teks yang bertujuan memberikan informasi atau penjelasan. Strukturnya: tesis, argumen, dan penegasan ulang...', 'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 1, 'user_id' => 2,  'title' => 'Teks Deskripsi',                     'content' => 'Teks deskripsi menggambarkan suatu objek, tempat, atau peristiwa secara rinci sehingga pembaca seolah-olah melihat sendiri...', 'semester' => 'ganjil'],

            // VII A — Matematika (Putri Oktaria)
            ['class_id' => 2, 'subject_id' => 2, 'user_id' => 2,  'title' => 'Bilangan Bulat dan Pecahan',        'content' => 'Bilangan bulat meliputi positif, negatif, dan nol. Pecahan biasa dan desimal adalah representasi dari angka tidak bulat...', 'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 2, 'user_id' => 2,  'title' => 'Aljabar Sederhana',                  'content' => 'Aljabar menggunakan simbol dan huruf untuk mewakili angka. Persamaan linear satu variabel: ax + b = c...', 'semester' => 'ganjil'],

            // VII A — Bahasa Inggris (Ibu Ratna)
            ['class_id' => 2, 'subject_id' => 3, 'user_id' => 10, 'title' => 'Greetings and Introductions',        'content' => 'Greetings adalah sapaan dalam bahasa Inggris. "How are you?", "Nice to meet you", "What is your name?"...', 'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 3, 'user_id' => 10, 'title' => 'Simple Present Tense',               'content' => 'Simple present tense digunakan untuk menyatakan kebiasaan, fakta, dan kondisi. S + V1 + O...', 'semester' => 'ganjil'],

            // VII A — IPA (Bapak Ahmad)
            ['class_id' => 2, 'subject_id' => 4, 'user_id' => 9,  'title' => 'Sistem Organ Tubuh Manusia',         'content' => 'Organ tubuh manusia meliputi sistem pencernaan, pernapasan, peredaran darah, dan lainnya...', 'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 4, 'user_id' => 9,  'title' => 'Energi dan Perubahannya',            'content' => 'Energi adalah kemampuan untuk melakukan kerja. Energi dapat berubah bentuk: potensial, kinetik, panas...', 'semester' => 'ganjil'],

            // VII A — IPS (Ibu Ratna)
            ['class_id' => 2, 'subject_id' => 5, 'user_id' => 10, 'title' => 'Keragaman Sosial Budaya Indonesia',  'content' => 'Indonesia memiliki keberagaman suku, agama, budaya, dan bahasa. Bhinneka Tunggal Ika...', 'semester' => 'ganjil'],

            // VII A — Informatika (Putri Oktaria)
            ['class_id' => 2, 'subject_id' => 6, 'user_id' => 2,  'title' => 'Pengenalan Komputer',               'content' => 'Komputer terdiri dari hardware dan software. Input, process, output, storage adalah komponen dasar...', 'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 6, 'user_id' => 2,  'title' => 'Pengolahan Teks dengan Word',       'content' => 'Pengolahan teks menggunakan aplikasi seperti Microsoft Word. Format teks, paragraf, tabel...', 'semester' => 'ganjil'],

            // VII B (class 3) — materials
            ['class_id' => 3, 'subject_id' => 1, 'user_id' => 2,  'title' => 'Puisi dan Ciri-Cirinya',            'content' => 'Puisi adalah karya sastra yang terikat oleh rima, irama, dan mempunyai makna mendalam...', 'semester' => 'ganjil'],
            ['class_id' => 3, 'subject_id' => 1, 'user_id' => 2,  'title' => 'Membaca Kritis Teks Eksposisi',     'content' => 'Membaca kritis adalah membaca dengan sikap mengevaluasi informasi, membandingkan fakta dan opini...', 'semester' => 'ganjil'],
            ['class_id' => 3, 'subject_id' => 2, 'user_id' => 2,  'title' => 'Statistika Sederhana',              'content' => 'Statistika adalah ilmu yang berkaitan dengan pengumpulan, pengolahan, dan analisis data...', 'semester' => 'ganjil'],
            ['class_id' => 3, 'subject_id' => 3, 'user_id' => 10, 'title' => 'Describing People and Things',      'content' => 'Describing menggunakan kata sifat: tall, short, kind, brave. "She is tall. He has brown eyes"...', 'semester' => 'ganjil'],
            ['class_id' => 3, 'subject_id' => 4, 'user_id' => 9,  'title' => 'Ekosistem dan Lingkungan',          'content' => 'Ekosistem adalah interaksi makhluk hidup dengan lingkungannya. rantai makanan, jaring-jaring makanan...', 'semester' => 'ganjil'],

            // VII C (class 4) — materials
            ['class_id' => 4, 'subject_id' => 1, 'user_id' => 2,  'title' => 'Menulis Karangan Narasi',           'content' => 'Narasi adalah teks yang menceritakan suatu peristiwa atau kejadian secara urut...', 'semester' => 'ganjil'],
            ['class_id' => 4, 'subject_id' => 2, 'user_id' => 2,  'title' => 'Bangun Datar dan Ruang',            'content' => 'Bangun datar: persegi, persegi panjang, segitiga, lingkaran. Rumus luas dan keliling...', 'semester' => 'ganjil'],
            ['class_id' => 4, 'subject_id' => 6, 'user_id' => 2,  'title' => 'Pengenalan Internet',               'content' => 'Internet adalah jaringan komputer global. Browser, search engine, website, email...', 'semester' => 'ganjil'],

            // VII D (class 5) — materials
            ['class_id' => 5, 'subject_id' => 3, 'user_id' => 10, 'title' => 'Numbers and Days',                  'content' => 'Ordinal numbers: first, second, third. Days: Monday through Sunday...', 'semester' => 'ganjil'],
            ['class_id' => 5, 'subject_id' => 5, 'user_id' => 10, 'title' => 'Peta dan Pemetaan',                  'content' => 'Peta adalah gambaran permukaan bumi pada bidang datar. Legenda, skala, orientasi mata angin...', 'semester' => 'ganjil'],
        ];

        foreach ($materials as $m) {
            DB::table('materials')->insert(array_merge($m, [
                'is_published' => true, 'published_at' => $now,
                'created_at' => $now, 'updated_at' => $now,
            ]));
        }

        // =================================================================
        // ASSIGNMENTS — Kelas VII SMP
        // =================================================================
        $assignments = [
            // VII A (class 2) — Putri Oktaria's subjects
            ['class_id' => 2, 'subject_id' => 1, 'user_id' => 2,  'title' => 'Analisis Teks Eksposisi',            'description' => 'Baca teks eksposisi dan identifikasi tesis, argumen, penegasan ulang...', 'xp_reward' => 50,  'deadline_offset' => -28, 'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 1, 'user_id' => 2,  'title' => 'Menulis Teks Deskripsi',             'description' => 'Buat teks deskripsi tentang sekolahmu...', 'xp_reward' => 50,  'deadline_offset' => -20, 'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 2, 'user_id' => 2,  'title' => 'Latihan Bilangan Bulat',              'description' => 'Kerjakan soal penjumlahan, pengurangan, perkalian, dan pembagian bilangan bulat...', 'xp_reward' => 40,  'deadline_offset' => -10, 'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 2, 'user_id' => 2,  'title' => 'Persamaan Linear Sederhana',         'description' => 'Selesaikan persamaan linear satu variabel: 2x + 5 = 15...', 'xp_reward' => 60,  'deadline_offset' => -3,  'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 6, 'user_id' => 2,  'title' => 'Membuat Dokumen Sederhana',          'description' => 'Buat dokumen dengan Microsoft Word yang berisi biodata diri...', 'xp_reward' => 45,  'deadline_offset' => 5,   'semester' => 'ganjil'],

            // VII A — Bahasa Inggris (Ibu Ratna)
            ['class_id' => 2, 'subject_id' => 3, 'user_id' => 10, 'title' => 'Greetings Dialogue',                 'description' => 'Buat dialog sapaan dalam bahasa Inggris...', 'xp_reward' => 40,  'deadline_offset' => -15, 'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 3, 'user_id' => 10, 'title' => 'Simple Present Tense Quiz',          'description' => 'Kerjakan kuis simple present tense...', 'xp_reward' => 35,  'deadline_offset' => 2,   'semester' => 'ganjil'],

            // VII A — IPA (Bapak Ahmad)
            ['class_id' => 2, 'subject_id' => 4, 'user_id' => 9,  'title' => 'Diagram Organ Tubuh',               'description' => 'Buat diagram sistem organ tubuh manusia...', 'xp_reward' => 50,  'deadline_offset' => -7,  'semester' => 'ganjil'],
            ['class_id' => 2, 'subject_id' => 4, 'user_id' => 9,  'title' => 'Laporan Energi dalam Kehidupan',     'description' => 'Buat laporan tentang macam-macam energi...', 'xp_reward' => 55,  'deadline_offset' => 4,   'semester' => 'ganjil'],

            // VII A — IPS (Ibu Ratna)
            ['class_id' => 2, 'subject_id' => 5, 'user_id' => 10, 'title' => 'Peta Keberagaman Suku',             'description' => 'Buat peta keberagaman suku bangsa di Indonesia...', 'xp_reward' => 45,  'deadline_offset' => 7,   'semester' => 'ganjil'],

            // VII B (class 3)
            ['class_id' => 3, 'subject_id' => 1, 'user_id' => 2,  'title' => 'Analisis Struktur Puisi',            'description' => 'Analisis puisi karya penyair Indonesia...', 'xp_reward' => 50,  'deadline_offset' => -25, 'semester' => 'ganjil'],
            ['class_id' => 3, 'subject_id' => 2, 'user_id' => 2,  'title' => 'Latihan Statistika',                 'description' => 'Hitung mean, median, dan modus dari data...', 'xp_reward' => 45,  'deadline_offset' => -12, 'semester' => 'ganjil'],
            ['class_id' => 3, 'subject_id' => 4, 'user_id' => 9,  'title' => 'Rantai Makanan',                    'description' => 'Buat diagram rantai makanan di ekosistem hutan...', 'xp_reward' => 50,  'deadline_offset' => 3,   'semester' => 'ganjil'],

            // VII C (class 4)
            ['class_id' => 4, 'subject_id' => 1, 'user_id' => 2,  'title' => 'Menulis Narasi Pengalaman',          'description' => 'Tulis narasi tentang pengalaman pertama sekolah...', 'xp_reward' => 40,  'deadline_offset' => -18, 'semester' => 'ganjil'],
            ['class_id' => 4, 'subject_id' => 2, 'user_id' => 2,  'title' => 'Menghitung Luas Bangun Datar',       'description' => 'Hitung luas persegi, segitiga, dan lingkaran...', 'xp_reward' => 45,  'deadline_offset' => -8,  'semester' => 'ganjil'],

            // VII D (class 5)
            ['class_id' => 5, 'subject_id' => 3, 'user_id' => 10, 'title' => 'Writing About My Family',           'description' => 'Write a short paragraph about your family...', 'xp_reward' => 35,  'deadline_offset' => -10, 'semester' => 'ganjil'],
            ['class_id' => 5, 'subject_id' => 5, 'user_id' => 10, 'title' => 'Membaca Peta Indonesia',            'description' => 'Identifikasi provinsi dan ibu kota dari peta...', 'xp_reward' => 40,  'deadline_offset' => -5,  'semester' => 'ganjil'],
        ];

        foreach ($assignments as $a) {
            DB::table('assignments')->insert([
                'class_id'     => $a['class_id'],
                'subject_id'   => $a['subject_id'],
                'user_id'      => $a['user_id'],
                'title'        => $a['title'],
                'description'  => $a['description'],
                'max_score'    => 100,
                'xp_reward'    => $a['xp_reward'],
                'semester'     => $a['semester'],
                'deadline'     => $now->addDays($a['deadline_offset']),
                'is_published' => true,
                'created_at'   => $now, 'updated_at' => $now,
            ]);
        }

        // =================================================================
        // SUBMISSIONS & GRADES — VII A submissions
        // =================================================================
        $submissions = [
            // Budi (id=3) — VII A
            ['assignment_id' => 1,  'user_id' => 3, 'answer_text' => 'Tesis: Pentingnya membaca. Argumen: Meningkatkan kosakata, menambah wawasan.', 'status' => 'graded',    'days_ago' => 25, 'score' => 88, 'feedback' => 'Struktur eksposisi sudah benar. Argumen kuat.', 'grader_days_ago' => 24],
            ['assignment_id' => 3,  'user_id' => 3, 'answer_text' => 'Penjumlahan bilangan bulat: -5 + 3 = -2, -8 + 10 = 2. Pengurangan: 7 - (-3) = 10.', 'status' => 'graded',    'days_ago' => 18, 'score' => 92, 'feedback' => 'Semua jawaban benar. Kerja rapi.', 'grader_days_ago' => 17],
            ['assignment_id' => 6,  'user_id' => 3, 'answer_text' => 'Hi! My name is Budi. Nice to meet you. How are you today?', 'status' => 'graded',    'days_ago' => 12, 'score' => 85, 'feedback' => 'Dialog sudah natural. Percaya diri!', 'grader_days_ago' => 11],
            ['assignment_id' => 8,  'user_id' => 3, 'answer_text' => 'Diagram: jantung, paru-paru, lambung, usus, hati. Fungsi masing-masing sudah dijelaskan.', 'status' => 'graded',   'days_ago' => 5,  'score' => 90, 'feedback' => 'Diagram lengkap dan penjelasan jelas.', 'grader_days_ago' => 4],

            // Siti (id=4) — VII A
            ['assignment_id' => 1,  'user_id' => 4, 'answer_text' => 'Teks eksposisi tentang pentingnya menjaga kebersihan lingkungan.', 'status' => 'graded',    'days_ago' => 22, 'score' => 82, 'feedback' => 'Tesis jelas. Perlu perkuat argumen.', 'grader_days_ago' => 21],
            ['assignment_id' => 3,  'user_id' => 4, 'answer_text' => 'Pecahan: 1/2 + 1/3 = 5/6. Desimal: 0.75 = 3/4.', 'status' => 'graded',    'days_ago' => 15, 'score' => 90, 'feedback' => 'Konversi pecahan benar. Bagus.', 'grader_days_ago' => 14],
            ['assignment_id' => 4,  'user_id' => 4, 'answer_text' => '3x + 6 = 15, x = 3. 2x - 4 = 10, x = 7.', 'status' => 'graded',   'days_ago' => 6,  'score' => 88, 'feedback' => 'Penyelesaian tepat.', 'grader_days_ago' => 5],

            // Adi (id=5) — VII A
            ['assignment_id' => 2,  'user_id' => 5, 'answer_text' => 'Deskripsi tentang taman sekolah: pohon rindang, bunga warna-warni, lapangan basket.', 'status' => 'graded',    'days_ago' => 20, 'score' => 75, 'feedback' => 'Deskripsi cukup hidup. Tambahkan detail sensori.', 'grader_days_ago' => 19],
            ['assignment_id' => 5,  'user_id' => 5, 'answer_text' => 'Dokumen biodata dengan format: nama, alamat, hobi, foto.', 'status' => 'graded',    'days_ago' => 8,  'score' => 78, 'feedback' => 'Format sudah benar. Desain bisa lebih menarik.', 'grader_days_ago' => 7],

            // Andi (id=11) — top performer, VII A
            ['assignment_id' => 1,  'user_id' => 11, 'answer_text' => 'Tesis: Literasi digital penting di era modern. Argumen: akses informasi, literasi media, keamanan data.', 'status' => 'graded',   'days_ago' => 27, 'score' => 98, 'feedback' => 'Luar biasa! Argumen mendalam dan relevan.', 'grader_days_ago' => 26],
            ['assignment_id' => 3,  'user_id' => 11, 'answer_text' => 'Semua soal benar. Bilangan bulat dan pecahan dikerjakan lengkap.', 'status' => 'graded',  'days_ago' => 17, 'score' => 100, 'feedback' => 'Nilai sempurna!', 'grader_days_ago' => 16],
            ['assignment_id' => 4,  'user_id' => 11, 'answer_text' => 'Persamaan linear diselesaikan dengan benar: x=3, x=7, x=-2. Pembuktian disertakan.', 'status' => 'graded',  'days_ago' => 6,  'score' => 99, 'feedback' => 'Pembuktian sempurna.', 'grader_days_ago' => 5],
            ['assignment_id' => 7,  'user_id' => 11, 'answer_text' => 'She is very kind. She has long black hair. She likes reading books.', 'status' => 'graded',  'days_ago' => 3,  'score' => 95, 'feedback' => 'Present tense sudah tepat semua.', 'grader_days_ago' => 2],

            // Maya (id=12) — VII A
            ['assignment_id' => 1,  'user_id' => 12, 'answer_text' => 'Teks eksposisi tentang manfaat olahraga bagi kesehatan.', 'status' => 'graded',    'days_ago' => 20, 'score' => 80, 'feedback' => 'Struktur eksposisi benar. Bagus.', 'grader_days_ago' => 19],
            ['assignment_id' => 8,  'user_id' => 12, 'answer_text' => 'Diagram organ pencernaan: mulut, kerongkongan, lambung, usus.', 'status' => 'graded',    'days_ago' => 7,  'score' => 85, 'feedback' => 'Diagram rapi. Penjelasan lengkap.', 'grader_days_ago' => 6],

            // Rizky (id=13) — VII A
            ['assignment_id' => 2,  'user_id' => 13, 'answer_text' => 'Deskripsi kamar: meja belajar, buku bertumpuk, jendela menghadap timur.', 'status' => 'graded',    'days_ago' => 16, 'score' => 68, 'feedback' => 'Cukup bagus. Perlu lebih detail.', 'grader_days_ago' => 15],
            ['assignment_id' => 5,  'user_id' => 13, 'answer_text' => 'Dokumen Word sederhana dengan biodata.', 'status' => 'graded',    'days_ago' => 5,  'score' => 72, 'feedback' => 'Dasar sudah oke.', 'grader_days_ago' => 4],

            // Dian (id=14) — VII A
            ['assignment_id' => 1,  'user_id' => 14, 'answer_text' => 'Teks eksposisi tentang pentingnya belajar bahasa Inggris.', 'status' => 'graded',   'days_ago' => 13, 'score' => 74, 'feedback' => 'Tesis jelas. Perlu perkuat argumen.', 'grader_days_ago' => 12],

            // Fajar (id=15) — VII A
            ['assignment_id' => 3,  'user_id' => 15, 'answer_text' => 'Penjumlahan: -3 + 5 = 2. Pengurangan: 8 - (-2) = 10.', 'status' => 'graded',   'days_ago' => 10, 'score' => 70, 'feedback' => 'Sebagian benar. Perlu latihan lagi.', 'grader_days_ago' => 9],

            // Arif (id=23) — VII A
            ['assignment_id' => 3,  'user_id' => 23, 'answer_text' => 'Jawaban bilangan bulat sebagian benar.', 'status' => 'graded',   'days_ago' => 8,  'score' => 60, 'feedback' => 'Perlu belajar lagi tentang bilangan negatif.', 'grader_days_ago' => 7],

            // Dewi (id=24) — VII A
            ['assignment_id' => 6,  'user_id' => 24, 'answer_text' => 'Hi, my name is Dewi. I am 12 years old.', 'status' => 'graded',   'days_ago' => 4,  'score' => 78, 'feedback' => 'Good. Simple and correct.', 'grader_days_ago' => 3],

            // --- VII B submissions ---
            // Rina (id=6)
            ['assignment_id' => 11, 'user_id' => 6, 'answer_text' => 'Analisis puisi: tema, rima, majas dalam puisi "Tanah Air" karya Chairil Anwar.', 'status' => 'graded',   'days_ago' => 20, 'score' => 85, 'feedback' => 'Analisis mendalam. Majas teridentifikasi benar.', 'grader_days_ago' => 19],

            // Dimas (id=7)
            ['assignment_id' => 12, 'user_id' => 7, 'answer_text' => 'Mean: 15, Median: 14, Modus: 12 dari data yang diberikan.', 'status' => 'graded',   'days_ago' => 14, 'score' => 78, 'feedback' => 'Mean dan median benar. Modus perlu dicek lagi.', 'grader_days_ago' => 13],

            // Citra (id=8)
            ['assignment_id' => 13, 'user_id' => 8, 'answer_text' => 'Rantai makanan: rumput → belalaj → kucing → elang.', 'status' => 'graded',   'days_ago' => 10, 'score' => 80, 'feedback' => 'Rantai makanan benar. Tambahkan penjelasan.', 'grader_days_ago' => 9],

            // Yoga (id=16)
            ['assignment_id' => 12, 'user_id' => 16, 'answer_text' => 'Mean: 20, Median: 18, Modus: 15. Semua perhitungan disertakan.', 'status' => 'graded',     'days_ago' => 12, 'score' => 92, 'feedback' => 'Lengkap dan benar semua.', 'grader_days_ago' => 11],

            // Angga (id=17)
            ['assignment_id' => 11, 'user_id' => 17, 'answer_text' => 'Puisi tentang alam. Identifikasi rima AABB.', 'status' => 'graded',   'days_ago' => 16, 'score' => 70, 'feedback' => 'Analisis dasar sudah benar.', 'grader_days_ago' => 15],

            // Novi (id=18)
            ['assignment_id' => 13, 'user_id' => 18, 'answer_text' => 'Diagram rantai makanan dan jaring-jaring makanan.', 'status' => 'graded',  'days_ago' => 8,  'score' => 88, 'feedback' => 'Diagram lengkap. Jaring-jaring makanan bagus.', 'grader_days_ago' => 7],

            // Bayu (id=19)
            ['assignment_id' => 11, 'user_id' => 19, 'answer_text' => 'Puisi sederhana.', 'status' => 'graded',  'days_ago' => 14, 'score' => 65, 'feedback' => 'Perlu perkuat analisis.', 'grader_days_ago' => 13],

            // Intan (id=20)
            ['assignment_id' => 12, 'user_id' => 20, 'answer_text' => 'Statistika: perhitungan lengkap mean, median, modus.', 'status' => 'graded',  'days_ago' => 10, 'score' => 82, 'feedback' => 'Perhitungan benar. Rapi.', 'grader_days_ago' => 9],

            // Galih (id=21) — pending
            ['assignment_id' => 11, 'user_id' => 21, 'answer_text' => 'Sedang mengerjakan analisis puisi.', 'status' => 'pending',  'days_ago' => 3,  'score' => null, 'feedback' => null, 'grader_days_ago' => null],

            // Wulan (id=22) — pending
            ['assignment_id' => 12, 'user_id' => 22, 'answer_text' => 'Mengerjakan soal statistika.', 'status' => 'pending',  'days_ago' => 2,  'score' => null, 'feedback' => null, 'grader_days_ago' => null],
        ];

        foreach ($submissions as $sub) {
            $submissionId = DB::table('submissions')->insertGetId([
                'assignment_id' => $sub['assignment_id'],
                'user_id'       => $sub['user_id'],
                'answer_text'   => $sub['answer_text'],
                'submitted_at'  => $now->copy()->subDays($sub['days_ago']),
                'status'        => $sub['status'],
                'created_at'    => $now->copy()->subDays($sub['days_ago']),
                'updated_at'    => $now->copy()->subDays(max(0, $sub['days_ago'] - 1)),
            ]);

            if ($sub['status'] === 'graded' && $sub['score'] !== null) {
                DB::table('grades')->insert([
                    'submission_id' => $submissionId,
                    'user_id'       => 2, // Putri Oktaria as grader
                    'score'         => $sub['score'],
                    'feedback'      => $sub['feedback'],
                    'graded_at'     => $now->copy()->subDays($sub['grader_days_ago']),
                    'created_at'    => $now->copy()->subDays($sub['grader_days_ago']),
                    'updated_at'    => $now->copy()->subDays($sub['grader_days_ago']),
                ]);
            }
        }
    }
}
