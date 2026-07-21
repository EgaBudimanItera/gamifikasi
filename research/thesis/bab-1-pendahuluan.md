# BAB I: PENDAHULUAN

## 1.1 Latar Belakang

Pendidikan merupakan pilar utama dalam pembangunan sumber daya manusia yang berkualitas. Di era digital saat ini, perkembangan teknologi informasi telah membawa perubahan signifikan dalam dunia pendidikan, termasuk dalam metode dan media pembelajaran. Kurikulum Merdeka yang diterapkan oleh Kementerian Pendidikan Indonesia menekankan pada pendekatan pembelajaran yang berpusat pada siswa, memberikan fleksibilitas bagi guru untuk mengembangkan kreativitas dalam proses belajar mengajar.

Namun demikian, dalam praktiknya, guru dan siswa masih menghadapi berbagai tantangan. Siswa SMP kelas VII berada dalam fase transisi dari pendidikan dasar ke pendidikan menengah, di mana mereka perlu beradaptasi dengan lingkungan belajar baru, mata pelajaran yang lebih beragam, dan ekspektasi akademik yang lebih tinggi. Usia 12–13 tahun merupakan periode kritis di mana motivasi intrinsik siswa rentan menurun akibat transisi sekolah, perubahan tubuh, dan tuntutan sosial yang meningkat. Siswa sering kali mengalami penurunan motivasi belajar, keterlambatan dalam menyelesaikan tugas, dan partisipasi yang rendah dalam kegiatan kelas. Di sisi lain, guru kesulitan dalam memantau progres belajar dan engagement siswa secara real-time.

Gamifikasi, yaitu penerapan elemen-elemen permainan dalam konteks non-permainan, telah terbukti efektif dalam meningkatkan motivasi dan keterlibatan pengguna dalam berbagai bidang, termasuk pendidikan. Elemen gamifikasi seperti Experience Points (XP), level, badge, streak, dan leaderboard dapat memberikan insentif intrinsik dan ekstrinsik yang mendorong siswa untuk lebih aktif dalam proses pembelajaran. Lampropoulos & Sidiropoulos (2024) melalui studi longitudinal 3 tahun membuktikan bahwa gamifikasi meningkatkan hasil belajar secara signifikan.

Namun demikian, sebagian besar sistem gamifikasi pendidikan yang ada bersifat statis — mekanisme reward dan tantangan tidak berubah berdasarkan profil dan perilaku individu siswa. Dicheva et al. (2015) dalam systematic mapping study menemukan bahwa penelitian gamifikasi pendidikan masih banyak berfokus pada mekanisme points, leaderboards, dan badges tanpa personalisasi adaptif. NPC (Non-Player Character) sebagai mentor virtual dapat memberikan quest kontekstual yang disesuaikan dengan progres dan kemampuan siswa. Mekanisme affinity antara siswa dan mentor memungkinkan adaptivitas: semakin dekat hubungan siswa dengan mentor, semakin menantang dan berharga quest yang diberikan. Di sisi lain, guild sebagai komunitas belajar kolaboratif mendorong siswa untuk saling mendukung dan berkontribusi bersama.

Penelitian ini bertujuan untuk mengembangkan model gamifikasi pada sistem pembelajaran berbasis web yang mendukung Kurikulum Merdeka untuk siswa SMP kelas VII, dengan menggunakan pendekatan Requirement Engineering, User Story, dan Behavior-Driven Development (BDD). Sistem yang dikembangkan, yang disebut EduQuest, mengintegrasikan berbagai mekanisme gamifikasi termasuk NPC Mentor Affinity, Guild Collaborative Reward, XP, level, badge, streak, quest, leaderboard, adaptive challenge quiz, dan material reading.

## 1.2 Rumusan Masalah

Berdasarkan latar belakang yang telah diuraikan, rumusan masalah dalam penelitian ini adalah:

1. Bagaimana memodelkan kebutuhan sistem gamifikasi pembelajaran adaptif untuk siswa SMP kelas VII menggunakan pendekatan Requirement Engineering?
2. Bagaimana menerjemahkan kebutuhan sistem ke dalam User Story, Acceptance Criteria, dan skenario Behavior-Driven Development yang dapat diuji secara otomatis?
3. Bagaimana mengimplementasikan mekanisme NPC Mentor Affinity dan Guild Collaborative Reward pada sistem pembelajaran berbasis web?
4. Bagaimana usability dan user engagement siswa SMP terhadap sistem gamifikasi yang dikembangkan?

## 1.3 Tujuan Penelitian

Tujuan penelitian ini adalah mengembangkan dan memvalidasi model sistem gamifikasi pembelajaran adaptif berbasis web untuk siswa SMP kelas VII menggunakan pendekatan Requirement Engineering, User Story, dan Behavior-Driven Development.

Tujuan khusus penelitian:

1. Mengidentifikasi kebutuhan sistem gamifikasi pembelajaran adaptif untuk siswa SMP kelas VII.
2. Menyusun User Story dan Acceptance Criteria berdasarkan kebutuhan sistem.
3. Membangun skenario BDD yang dapat diuji secara otomatis.
4. Mengimplementasikan mekanisme NPC Mentor Affinity dan Guild Collaborative Reward.
5. Mengevaluasi usability dan engagement pengguna terhadap sistem yang dikembangkan.

## 1.4 Manfaat Penelitian

### 1.4.1 Manfaat Akademik
- Memberikan kontribusi ilmiah dalam bidang Requirement Engineering dan Gamifikasi di pendidikan.
- Menjadi referensi bagi peneliti lain yang tertarik dengan topik serupa, khususnya terkait penerapan NPC Mentor Affinity dan Guild Collaborative Reward dalam gamifikasi pendidikan.
- Menghasilkan artefak penelitian (User Story, BDD, Traceability Matrix) yang dapat direplikasi.
- Memperkaya kajian tentang integrasi mekanisme personalisasi dan kolaborasi dalam satu sistem gamifikasi.

### 1.4.2 Manfaat Praktis
- Membantu guru dalam memotivasi siswa melalui mekanisme gamifikasi yang adaptif dan kolaboratif.
- Membantu siswa SMP kelas VII dalam memantau progres belajar mereka melalui mentor virtual dan komunitas belajar.
- Menyediakan solusi teknologi yang dapat diterapkan di sekolah-sekolah menengah pertama.

## 1.5 Batasan Masalah

Penelitian ini dibatasi pada:
1. Platform web dengan stack Laravel 10 dan Next.js 15.
2. Pengguna: siswa SMP kelas VII usia 12–13 tahun.
3. Mata pelajaran: Informatika, Matematika, Bahasa Indonesia, dan IPA.
4. Durasi pengamatan: 4–6 minggu.
5. Lokasi: Sekolah menengah pertama (SMP) mitra di wilayah Bandar Lampung.
6. NPC Mentor Affinity Score (MAS) sebagai mekanisme personalisasi.
7. Guild Collaborative Reward sebagai mekanisme kolaborasi.
8. Desain penelitian: quasi-experimental one-group pretest-posttest tanpa kelompok kontrol.

## 1.6 Research Gap

Tabel berikut menyajikan analisis penelitian terdahulu untuk mengidentifikasi celah penelitian (research gap) yang akan diisi oleh penelitian ini:

| Penelitian | Gamifikasi Pendidikan | NPC Adaptif / Mentor | Guild Kolaboratif | Traceability RE–BDD |
|---|:---:|:---:|:---:|:---:|
| Deterding et al. (2011) | ✓ | ✗ | ✗ | ✗ |
| Dicheva et al. (2015) | ✓ | ✗ | ✗ | ✗ |
| Hamari et al. (2014) | ✓ | ✗ | ✗ | ✗ |
| Saleem et al. (2022) | ✓ | ✗ | ✗ | ✗ |
| Lampropoulos & Sidiropoulos (2024) | ✓ | ✗ | ✗ | ✗ |
| Nascimento et al. (2020) | ✗ | ✗ | ✗ | ✓ |
| García et al. (2023) | ✗ | ✗ | ✗ | ✓ |
| Sommerville (2016) | ✗ | ✗ | ✗ | ✓ |
| **Penelitian ini** | **✓** | **✓** | **✓** | **✓** |

Berdasarkan tabel di atas, terlihat bahwa penelitian gamifikasi pendidikan selama ini berfokus pada mekanisme dasar seperti points, badges, dan leaderboards tanpa integrasi personalisasi NPC atau kolaborasi guild. Di sisi lain, penelitian RE dan BDD belum diintegrasikan ke dalam konteks gamifikasi pendidikan. Belum ditemukan penelitian yang mengintegrasikan NPC Mentor Affinity, Guild Collaborative Reward, dan traceability Requirement Engineering–BDD dalam satu sistem gamifikasi pembelajaran adaptif untuk siswa SMP kelas VII.

## 1.7 Keterbatasan Penelitian

Desain one-group pretest-posttest memiliki beberapa ancaman validitas internal yang perlu diakui, antara lain novelty effect (pengaruh kebaruan yang membuat siswa lebih antusias di awal), history effect (peristiwa eksternal yang memengaruhi selama periode penelitian), dan maturation effect (perubahan alami pada siswa selama 4–6 minggu).

Untuk meminimalkan bias tersebut, penelitian ini menggunakan beberapa strategi mitigasi:
1. System logs longitudinal — data penggunaan sistem dikumpulkan selama periode 4–6 minggu sehingga perubahan perilaku penggunaan dapat diamati secara berkelanjutan.
2. Observasi partisipatif — pengamatan terhadap aktivitas siswa selama periode treatment.
3. Durasi treatment cukup panjang — 4–6 minggu dirasakan cukup panjang untuk mengurangi efek novelty.

Meskipun demikian, penelitian ini tidak mengklaim kausalitas yang kuat karena tidak ada kelompok kontrol. Temuan penelitian dipandang sebagai bukti awal (preliminary evidence) yang membutuhkan replikasi dengan desain yang lebih kuat pada penelitian selanjutnya.

## 1.8 Sistematika Penulisan

Bab I: Pendahuluan — Latar belakang, rumusan masalah, tujuan, manfaat, batasan penelitian, research gap, dan keterbatasan penelitian.
Bab II: Tinjauan Pustaka — Konsep gamifikasi, Requirement Engineering, User Story, BDD, NPC mentor affinity, guild collaborative reward, dan studi terkait.
Bab III: Metodologi Penelitian — Desain penelitian, instrumen pengumpulan data, dan teknik analisis data.
Bab IV: Hasil dan Pembahasan — Hasil analisis kebutuhan, desain sistem, implementasi NPC Mentor Affinity dan Guild Collaborative Reward, serta evaluasi.
Bab V: Simpulan dan Saran — Simpulan penelitian dan saran untuk penelitian selanjutnya.
