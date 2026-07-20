# BAB I: PENDAHULUAN

## 1.1 Latar Belakang

Pendidikan merupakan pilar utama dalam pembangunan sumber daya manusia yang berkualitas. Di era digital saat ini, perkembangan teknologi informasi telah membawa perubahan signifikan dalam dunia pendidikan, termasuk dalam metode dan media pembelajaran. Kurikulum Merdeka yang diterapkan oleh Kementerian Pendidikan Indonesia menekankan pada pendekatan pembelajaran yang berpusat pada siswa, memberikan fleksibilitas bagi guru untuk mengembangkan kreativitas dalam proses belajar mengajar.

Namun demikian, dalam praktiknya, guru dan siswa masih menghadapi berbagai tantangan. Siswa sering kali mengalami penurunan motivasi belajar, keterlambatan dalam menyelesaikan tugas, dan partisipasi yang rendah dalam kegiatan kelas. Di sisi lain, guru kesulitan dalam memantau progres belajar dan engagement siswa secara real-time. Sistem pembelajaran konvensional yang belum terintegrasi dengan teknologi sering kali tidak memberikan feedback instan yang diperlukan siswa untuk memahami perkembangan belajar mereka.

Gamifikasi, yaitu penerapan elemen-elemen permainan dalam konteks non-permainan, telah terbukti efektif dalam meningkatkan motivasi dan keterlibatan pengguna dalam berbagai bidang, termasuk pendidikan.Elemen gamifikasi seperti Experience Points (XP), level, badge, streak, dan leaderboard dapat memberikan insentif intrinsik dan ekstrinsik yang mendorong siswa untuk lebih aktif dalam proses pembelajaran.

Penelitian ini bertujuan untuk mengembangkan model gamifikasi pada sistem pembelajaran berbasis web yang mendukung Kurikulum Merdeka, dengan menggunakan pendekatan Requirement Engineering, User Story, dan Behavior-Driven Development (BDD).

Sistem yang dikembangkan mengadopsi model relasi data yang mencakup: (1) setiap guru dapat mengajar banyak kelas dan banyak mata pelajaran melalui tabel pivot `class_subject`, (2) setiap siswa terdaftar pada satu kelas melalui tabel pivot `student_classes`, (3) materi dan tugas dapat di-scope per kelas (melalui `class_id`) maupun per mata pelajaran (melalui `subject_id`), dan (4) detail perolehan poin (XP breakdown) dilacak per sumber: tugas, login harian, streak, quest, dan penalty.

## 1.2 Rumusan Masalah

Berdasarkan latar belakang yang telah diuraikan, rumusan masalah dalam penelitian ini adalah:

1. Bagaimana mengidentifikasi kebutuhan sistem gamifikasi pendidikan yang sesuai dengan Kurikulum Merdeka?
2. Bagaimana memodelkan kebutuhan sistem menggunakan User Story?
3. Bagaimana menerjemahkan kebutuhan sistem menjadi skenario Behavior-Driven Development (BDD)?
4. Bagaimana efektivitas sistem gamifikasi terhadap peningkatan motivasi dan engagement siswa?
5. Bagaimana usability sistem gamifikasi yang dikembangkan?

## 1.3 Tujuan Penelitian

Tujuan penelitian ini adalah:

1. Mengidentifikasi kebutuhan sistem gamifikasi pendidikan yang mendukung Kurikulum Merdeka.
2. Memodelkan kebutuhan sistem menggunakan format User Story.
3. Menerjemahkan kebutuhan sistem menjadi skenario BDD yang dapat dijalankan secara otomatis.
4. Membangun prototipe sistem gamifikasi pembelajaran berbasis web.
5. Mengevaluasi usability dan engagement sistem yang dikembangkan.

## 1.4 Manfaat Penelitian

### 1.4.1 Manfaat Akademik
- Memberikan kontribusi ilmiah dalam bidang Requirement Engineering dan Gamification di pendidikan.
- Menjadi referensi bagi peneliti lain yang tertarik dengan topik serupa.
- Menghasilkan artefak penelitian (User Story, BDD, Traceability Matrix) yang dapat direplikasi.

### 1.4.2 Manfaat Praktis
- Membantu guru dalam memotivasi siswa melalui mekanisme gamifikasi.
- Membantu siswa dalam memantau progres belajar mereka.
- Menyediakan solusi teknologi yang dapat diterapkan di sekolah-sekolah.

## 1.5 Batasan Masalah

Penelitian ini dibatasi pada:
1. Platform web dengan stack Laravel 10 dan Next.js 15.
2. Pengguna: siswa SMA/SMK kelas XII.
3. Materi pelajaran: Pemrograman Web dan Basis Data.
4. Durasi pengamatan: 4-8 minggu.
5. Lokasi: Sekolah mitra di wilayah peneliti.
6. Model relasi: satu guru dapat mengajar banyak kelas dan banyak mata pelajaran; satu siswa terdaftar pada satu kelas.

## 1.6 Sistematika Penulisan

Bab I: Pendahuluan - Latar belakang, rumusan masalah, tujuan, manfaat, dan batasan penelitian.
Bab II: Tinjauan Pustaka - Konsep gamifikasi, Requirement Engineering, User Story, BDD, dan studi terkait.
Bab III: Metodologi Penelitian - Desain penelitian, instrument pengumpulan data, dan teknik analisis data.
Bab IV: Hasil dan Pembahasan - Hasil analisis kebutuhan, desain sistem, implementasi, dan evaluasi.
Bab V: Simpulan dan Saran - Simpulan penelitian dan saran untuk penelitian selanjutnya.
