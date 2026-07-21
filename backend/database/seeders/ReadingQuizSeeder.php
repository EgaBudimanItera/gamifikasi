<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReadingQuizSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $quizzes = [
            // Material 1: Teks Eksposisi (id:1, class VII A)
            ['material_id' => 1, 'question' => 'Apa tujuan utama teks eksposisi?', 'options' => ['Menghibur', 'Memberikan informasi', 'Membujuk', 'Menceritakan'], 'correct_answer' => 'Memberikan informasi', 'difficulty' => 'easy'],
            ['material_id' => 1, 'question' => 'Struktur teks eksposisi yang pertama adalah?', 'options' => ['Tesis', 'Argumen', 'Penegasan', 'Kesimpulan'], 'correct_answer' => 'Tesis', 'difficulty' => 'easy'],
            ['material_id' => 1, 'question' => 'Teks eksposisi bersifat?', 'options' => ['Objektif', 'Subjektif', 'Emosional', 'Fiksi'], 'correct_answer' => 'Objektif', 'difficulty' => 'easy'],

            // Material 2: Teks Deskripsi (id:2)
            ['material_id' => 2, 'question' => 'Teks deskripsi menggambarkan sesuatu secara?', 'options' => ['Rinci dan detail', 'Singkat saja', 'Berupa dialog', 'Hanya judul'], 'correct_answer' => 'Rinci dan detail', 'difficulty' => 'easy'],
            ['material_id' => 2, 'question' => 'Ciri khas teks deskripsi adalah?', 'options' => ['Menggunakan panca indra', 'Hanya penglihatan', 'Hanya pendengaran', 'Tanpa gambaran'], 'correct_answer' => 'Menggunakan panca indra', 'difficulty' => 'medium'],
            ['material_id' => 2, 'question' => 'Teks deskripsi bertujuan untuk?', 'options' => ['Membuat pembaca seolah melihat', 'Menghibur saja', 'Membujuk pembaca', 'Memberi berita'], 'correct_answer' => 'Membuat pembaca seolah melihat', 'difficulty' => 'easy'],

            // Material 3: Bilangan Bulat dan Pecahan (id:3)
            ['material_id' => 3, 'question' => 'Hasil dari -8 + 5 adalah?', 'options' => ['-3', '3', '-13', '13'], 'correct_answer' => '-3', 'difficulty' => 'easy'],
            ['material_id' => 3, 'question' => '0.75 sama dengan pecahan?', 'options' => ['3/4', '7/5', '5/7', '4/3'], 'correct_answer' => '3/4', 'difficulty' => 'medium'],
            ['material_id' => 3, 'question' => 'Hasil dari 6 × (-4) adalah?', 'options' => ['-24', '24', '-10', '10'], 'correct_answer' => '-24', 'difficulty' => 'easy'],

            // Material 4: Aljabar Sederhana (id:4)
            ['material_id' => 4, 'question' => 'Jika 3x = 15, maka x = ?', 'options' => ['5', '4', '6', '3'], 'correct_answer' => '5', 'difficulty' => 'easy'],
            ['material_id' => 4, 'question' => 'Persamaan linear satu variabel memiliki?', 'options' => ['Satu variabel', 'Dua variabel', 'Tiga variabel', 'Tanpa variabel'], 'correct_answer' => 'Satu variabel', 'difficulty' => 'easy'],
            ['material_id' => 4, 'question' => 'Jika 2x + 4 = 10, maka x = ?', 'options' => ['3', '4', '2', '5'], 'correct_answer' => '3', 'difficulty' => 'medium'],

            // Material 5: Greetings and Introductions (id:5)
            ['material_id' => 5, 'question' => '"How are you?" adalah contoh?', 'options' => ['Sapaan (greeting)', 'Perintah', 'Pertanyaan aritmatika', 'Nama'], 'correct_answer' => 'Sapaan (greeting)', 'difficulty' => 'easy'],
            ['material_id' => 5, 'question' => '"Nice to meet you" berarti?', 'options' => ['Senang berkenalan', 'Selamat tinggal', 'Terima kasih', 'Maaf'], 'correct_answer' => 'Senang berkenalan', 'difficulty' => 'easy'],
            ['material_id' => 5, 'question' => 'Jawaban yang tepat untuk "What is your name?" adalah?', 'options' => ['My name is...', 'I am fine', 'Yes, I do', 'Thank you'], 'correct_answer' => 'My name is...', 'difficulty' => 'easy'],

            // Material 6: Simple Present Tense (id:6)
            ['material_id' => 6, 'question' => '"She ___ to school every day." Isi yang benar?', 'options' => ['goes', 'go', 'going', 'gone'], 'correct_answer' => 'goes', 'difficulty' => 'easy'],
            ['material_id' => 6, 'question' => 'Simple present tense digunakan untuk?', 'options' => ['Kebiasaan dan fakta', 'Kejadian masa lalu', 'Kejadian masa depan', 'Sedang terjadi'], 'correct_answer' => 'Kebiasaan dan fakta', 'difficulty' => 'medium'],
            ['material_id' => 6, 'question' => '"They ___ football on weekends." Isi yang benar?', 'options' => ['play', 'plays', 'playing', 'played'], 'correct_answer' => 'play', 'difficulty' => 'easy'],

            // Material 7: Sistem Organ Tubuh Manusia (id:7)
            ['material_id' => 7, 'question' => 'Organ untuk memompa darah adalah?', 'options' => ['Jantung', 'Paru-paru', 'Lambung', 'Hati'], 'correct_answer' => 'Jantung', 'difficulty' => 'easy'],
            ['material_id' => 7, 'question' => 'Organ untuk bernapas adalah?', 'options' => ['Paru-paru', 'Jantung', 'Ginjal', 'Usus'], 'correct_answer' => 'Paru-paru', 'difficulty' => 'easy'],
            ['material_id' => 7, 'question' => 'Sistem pencernaan dimulai dari?', 'options' => ['Mulut', 'Lambung', 'Usus', 'Kerongkongan'], 'correct_answer' => 'Mulut', 'difficulty' => 'medium'],

            // Material 8: Energi dan Perubahannya (id:8)
            ['material_id' => 8, 'question' => 'Energi saat benda bergerak disebut?', 'options' => ['Energi kinetik', 'Energi potensial', 'Energi panas', 'Energi listrik'], 'correct_answer' => 'Energi kinetik', 'difficulty' => 'easy'],
            ['material_id' => 8, 'question' => 'Energi karena ketinggian disebut?', 'options' => ['Energi potensial', 'Energi kinetik', 'Energi nuklir', 'Energi kimia'], 'correct_answer' => 'Energi potensial', 'difficulty' => 'easy'],
            ['material_id' => 8, 'question' => 'Energi tidak dapat?', 'options' => ['Diciptakan dan dimusnahkan', 'Berubah bentuk', 'Pindah tempat', 'Diukur'], 'correct_answer' => 'Diciptakan dan dimusnahkan', 'difficulty' => 'medium'],

            // Material 9: Keragaman Sosial Budaya Indonesia (id:9)
            ['material_id' => 9, 'question' => 'Semboyan Indonesia adalah?', 'options' => ['Bhinneka Tunggal Ika', 'Merdeka atau Mati', ' Pancasila', 'Garuda Pancasila'], 'correct_answer' => 'Bhinneka Tunggal Ika', 'difficulty' => 'easy'],
            ['material_id' => 9, 'question' => 'Indonesia memiliki suku bangsa sekitar?', 'options' => ['Lebih dari 300', '100', '50', '1000'], 'correct_answer' => 'Lebih dari 300', 'difficulty' => 'medium'],
            ['material_id' => 9, 'question' => 'Keberagaman budaya merupakan?', 'options' => ['Kekayaan bangsa', 'Masalah negara', 'Hal yang harus dihilangkan', 'Tidak penting'], 'correct_answer' => 'Kekayaan bangsa', 'difficulty' => 'easy'],

            // Material 10: Pengenalan Komputer (id:10)
            ['material_id' => 10, 'question' => 'Hardware adalah?', 'options' => ['Perangkat keras komputer', 'Perangkat lunak', 'Program', 'Data'], 'correct_answer' => 'Perangkat keras komputer', 'difficulty' => 'easy'],
            ['material_id' => 10, 'question' => 'Software adalah?', 'options' => ['Perangkat lunak/program', 'Hardware', 'Monitor', 'Keyboard'], 'correct_answer' => 'Perangkat lunak/program', 'difficulty' => 'easy'],
            ['material_id' => 10, 'question' => 'Bagian komputer untuk menampilkan gambar adalah?', 'options' => ['Monitor', 'CPU', 'Keyboard', 'Mouse'], 'correct_answer' => 'Monitor', 'difficulty' => 'easy'],

            // Material 11: Pengolahan Teks dengan Word (id:11)
            ['material_id' => 11, 'question' => 'Aplikasi pengolahan teks dari Microsoft adalah?', 'options' => ['Microsoft Word', 'Microsoft Excel', 'Microsoft PowerPoint', 'Notepad'], 'correct_answer' => 'Microsoft Word', 'difficulty' => 'easy'],
            ['material_id' => 11, 'question' => 'Tombol untuk membuat teks tebal adalah?', 'options' => ['Ctrl+B', 'Ctrl+I', 'Ctrl+U', 'Ctrl+S'], 'correct_answer' => 'Ctrl+B', 'difficulty' => 'medium'],
            ['material_id' => 11, 'question' => 'Untuk menyimpan dokumen gunakan shortcut?', 'options' => ['Ctrl+S', 'Ctrl+C', 'Ctrl+V', 'Ctrl+X'], 'correct_answer' => 'Ctrl+S', 'difficulty' => 'easy'],

            // Material 12: Puisi dan Ciri-Cirinya (id:12)
            ['material_id' => 12, 'question' => 'Ciri khas puisi adalah?', 'options' => ['Memiliki rima dan irama', 'Hanya prosa panjang', 'Tanpa struktur', 'Hanya berisi dialog'], 'correct_answer' => 'Memiliki rima dan irama', 'difficulty' => 'easy'],
            ['material_id' => 12, 'question' => 'Sajak adalah?', 'options' => ['Irama bunyi akhir baris', 'Judul puisi', 'Nama penyair', 'Jenis prosa'], 'correct_answer' => 'Irama bunyi akhir baris', 'difficulty' => 'medium'],
            ['material_id' => 12, 'question' => 'Puisi lama memiliki aturan?', 'options' => ['Jumlah kata dan sajak', 'Tanpa aturan', 'Hanya satu baris', 'Minimal 100 kata'], 'correct_answer' => 'Jumlah kata dan sajak', 'difficulty' => 'easy'],

            // Material 13: Membaca Kritis Teks Eksposisi (id:13)
            ['material_id' => 13, 'question' => 'Membaca kritis adalah?', 'options' => ['Membaca dengan mengevaluasi', 'Membaca cepat', 'Membaca keras', 'Membaca sekilas'], 'correct_answer' => 'Membaca dengan mengevaluasi', 'difficulty' => 'easy'],
            ['material_id' => 13, 'question' => 'Fakta dalam teks adalah?', 'options' => ['Informasi yang bisa dibuktikan', 'Pendapat pribadi', 'Cerita fiksi', 'Puisi'], 'correct_answer' => 'Informasi yang bisa dibuktikan', 'difficulty' => 'medium'],
            ['material_id' => 13, 'question' => 'Opini adalah?', 'options' => ['Pendapat atau pandangan pribadi', 'Fakta ilmiah', 'Data statistik', 'Judul berita'], 'correct_answer' => 'Pendapat atau pandangan pribadi', 'difficulty' => 'easy'],

            // Material 14: Statistika Sederhana (id:14)
            ['material_id' => 14, 'question' => 'Mean adalah?', 'options' => ['Rata-rata', 'Nilai tengah', 'Nilai terbanyak', 'Selisih'], 'correct_answer' => 'Rata-rata', 'difficulty' => 'easy'],
            ['material_id' => 14, 'question' => 'Median adalah?', 'options' => ['Nilai tengah data', 'Rata-rata', 'Modus', 'Jangkauan'], 'correct_answer' => 'Nilai tengah data', 'difficulty' => 'easy'],
            ['material_id' => 14, 'question' => 'Modus adalah?', 'options' => ['Nilai yang paling sering muncul', 'Rata-rata', 'Median', 'Jumlah'], 'correct_answer' => 'Nilai yang paling sering muncul', 'difficulty' => 'medium'],

            // Material 15: Describing People and Things (id:15)
            ['material_id' => 15, 'question' => '"She is tall" menggunakan kata?', 'options' => ['Adjective (kata sifat)', 'Verb', 'Noun', 'Adverb'], 'correct_answer' => 'Adjective (kata sifat)', 'difficulty' => 'easy'],
            ['material_id' => 15, 'question' => 'Kata sifat untuk menggambarkan orang ramah adalah?', 'options' => ['kind', 'fast', 'big', 'heavy'], 'correct_answer' => 'kind', 'difficulty' => 'easy'],
            ['material_id' => 15, 'question' => '"He has brown eyes" menunjukkan?', 'options' => ['Kepemilikan (has/have)', 'Kebiasaan', 'Perintah', 'Pertanyaan'], 'correct_answer' => 'Kepemilikan (has/have)', 'difficulty' => 'medium'],

            // Material 16: Ekosistem dan Lingkungan (id:16)
            ['material_id' => 16, 'question' => 'Ekosistem adalah interaksi?', 'options' => ['Makhluk hidup dengan lingkungannya', 'Manusia dengan komputer', 'Air dengan tanah', 'Matahari dengan bumi'], 'correct_answer' => 'Makhluk hidup dengan lingkungannya', 'difficulty' => 'easy'],
            ['material_id' => 16, 'question' => 'Rantai makanan dimulai dari?', 'options' => ['Produsen (tumbuhan)', 'Konsumen', 'Pengurai', 'Predator'], 'correct_answer' => 'Produsen (tumbuhan)', 'difficulty' => 'medium'],
            ['material_id' => 16, 'question' => 'Organisme pengurai disebut?', 'options' => ['Decomposer/pengurai', 'Produsen', 'Konsumen', 'Predator'], 'correct_answer' => 'Decomposer/pengurai', 'difficulty' => 'easy'],

            // Material 17: Menulis Karangan Narasi (id:17)
            ['material_id' => 17, 'question' => 'Narasi menceritakan suatu?', 'options' => ['Peristiwa secara urut', 'Deskripsi tempat', 'Argumen pendapat', 'Fakta ilmiah'], 'correct_answer' => 'Peristiwa secara urut', 'difficulty' => 'easy'],
            ['material_id' => 17, 'question' => 'Struktur narasi meliputi?', 'options' => ['Abstrak, orientasi, komplikasi, resolusi', 'Tesis, argumen', 'Deskripsi, analisis', 'Judul, kesimpulan'], 'correct_answer' => 'Abstrak, orientasi, komplikasi, resolusi', 'difficulty' => 'medium'],
            ['material_id' => 17, 'question' => 'Tokoh dalam narasi disebut?', 'options' => ['Character/tokoh', 'Setting', 'Theme', 'Plot'], 'correct_answer' => 'Character/tokoh', 'difficulty' => 'easy'],

            // Material 18: Bangun Datar dan Ruang (id:18)
            ['material_id' => 18, 'question' => 'Rumus keliling persegi adalah?', 'options' => ['4 × sisi', 'sisi × sisi', '2 × (p+l)', 'π × d'], 'correct_answer' => '4 × sisi', 'difficulty' => 'easy'],
            ['material_id' => 18, 'question' => 'Luas segitiga adalah?', 'options' => ['½ × alas × tinggi', 'alas × tinggi', '2 × alas', 'alas + tinggi'], 'correct_answer' => '½ × alas × tinggi', 'difficulty' => 'easy'],
            ['material_id' => 18, 'question' => 'Keliling lingkaran rumusnya?', 'options' => ['2 × π × r', 'π × r²', '2 × r', 'π × d²'], 'correct_answer' => '2 × π × r', 'difficulty' => 'medium'],

            // Material 19: Pengenalan Internet (id:19)
            ['material_id' => 19, 'question' => 'Internet adalah?', 'options' => ['Jaringan komputer global', 'Jenis komputer', 'Program', 'Hardware'], 'correct_answer' => 'Jaringan komputer global', 'difficulty' => 'easy'],
            ['material_id' => 19, 'question' => 'Untuk mengakses website menggunakan?', 'options' => ['Browser', 'Word', 'Excel', 'PowerPoint'], 'correct_answer' => 'Browser', 'difficulty' => 'easy'],
            ['material_id' => 19, 'question' => 'Protokol keamanan website dimulai dengan?', 'options' => ['https://', 'http://', 'ftp://', 'www.'], 'correct_answer' => 'https://', 'difficulty' => 'medium'],

            // Material 20: Numbers and Days (id:20)
            ['material_id' => 20, 'question' => 'Urutan angkaordinal "ketiga" dalam bahasa Inggris adalah?', 'options' => ['Third', 'Three', 'Thirteen', 'Thirty'], 'correct_answer' => 'Third', 'difficulty' => 'easy'],
            ['material_id' => 20, 'question' => 'Hari pertama dalam seminggu (Inggris) adalah?', 'options' => ['Monday', 'Sunday', 'Saturday', 'Friday'], 'correct_answer' => 'Sunday', 'difficulty' => 'easy'],
            ['material_id' => 20, 'question' => '"Tuesday" adalah hari ke-?', 'options' => ['3', '2', '4', '1'], 'correct_answer' => '3', 'difficulty' => 'easy'],

            // Material 21: Peta dan Pemetaan (id:21)
            ['material_id' => 21, 'question' => 'Bagian peta yang menjelaskan simbol disebut?', 'options' => ['Legenda', 'Skala', 'Judul', 'Arah mata angin'], 'correct_answer' => 'Legenda', 'difficulty' => 'easy'],
            ['material_id' => 21, 'question' => 'Skala peta 1:100.000 berarti?', 'options' => ['1 cm = 1 km', '1 cm = 100 km', '1 m = 100 cm', '1 mm = 1 cm'], 'correct_answer' => '1 cm = 1 km', 'difficulty' => 'medium'],
            ['material_id' => 21, 'question' => 'Arah utara pada peta selalu di?', 'options' => ['Bagian atas', 'Bagian bawah', 'Bagian kanan', 'Bagian kiri'], 'correct_answer' => 'Bagian atas', 'difficulty' => 'easy'],
        ];

        foreach ($quizzes as $q) {
            DB::table('reading_quizzes')->insert(array_merge($q, [
                'options'      => json_encode($q['options']),
                'is_active'    => true,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]));
        }
    }
}
