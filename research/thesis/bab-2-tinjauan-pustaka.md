# BAB II: TINJAUAN PUSTAKA

## 2.1 Gamifikasi dalam Pendidikan

### 2.1.1 Definisi Gamifikasi
Gamifikasi adalah penerapan elemen-elemen desain permainan dalam konteks non-permainan untuk meningkatkan partisipasi dan motivasi pengguna (Deterding et al., 2011). Dalam konteks pendidikan, gamifikasi bertujuan untuk membuat proses belajar lebih menarik dan memotivasi siswa.

### 2.1.2 Elemen Gamifikasi
Elemen-elemen gamifikasi yang relevan dengan pendidikan meliputi:

1. **Experience Points (XP):** Sistem poin yang diberikan kepada siswa sebagai reward atas aktivitas pembelajaran.
2. **Level:** Tingkatan yang dicapai siswa berdasarkan akumulasi XP.
3. **Badge:** Penghargaan digital yang diberikan atas pencapaian tertentu.
4. **Streak:** Pelacakan konsistensi aktivitas harian siswa.
5. **Quest:** Misi atau tantangan yang harus diselesaikan siswa.
6. **Leaderboard:** Papan peringkat yang menunjukkan posisi siswa.
7. **Guild:** Kelompok siswa yang saling mendukung dalam pencapaian tujuan bersama.
8. **Battle Quiz PvP:** Mekanisme kompetisi langsung antar siswa melalui quiz materi pelajaran.

### 2.1.3 Teori Motivasi
Implementasi gamifikasi didasarkan pada beberapa teori motivasi:

- **Self-Determination Theory (SDT):** Teori yang menjelaskan tiga kebutuhan psikologis dasar: autonomi, kompetensi, dan relasionalitas. Battle Quiz PvP secara langsung memenuhi kebutuhan relasionalitas melalui interaksi peer-to-peer.
- **Flow Theory:** Kondisi optimal saat seseorang terlibat penuh dalam aktivitas yang seimbang antara tantangan dan kemampuan. Matchmaking Battle Quiz berdasarkan level menjaga keseimbangan ini.
- **Behavioral Psychology:** Penggunaan reinforcement untuk membentuk perilaku positif. XP reward dari battle quiz merupakan bentuk positive reinforcement.
- **Social Comparison Theory (Festinger, 1954):** Individu mengevaluasi diri mereka dengan membandingkan pencapaian mereka dengan orang lain. Battle Quiz dan leaderboard memberikan dasar komparasi sosial yang konstruktif.

## 2.2 Kompetisi Peer-to-Peer dalam Pendidikan

### 2.2.1 Konsep PvP dalam Konteks Edukasi
Peer-to-peer competition (PvP) dalam pendidikan mengacu pada mekanisme di mana siswa berkompetisi secara langsung satu sama lain untuk mencapai tujuan pembelajaran. Berbeda dengan kompetisi terhadap sistem (seperti leaderboard statis), PvP melibatkan interaksi langsung antara dua atau lebih peserta.

Penelitian oleh Topping (2005) tentang peer tutoring menunjukkan bahwa interaksi langsung antar siswa dapat meningkatkan hasil belajar hingga 0,4 standar deviasi di atas instruksi tradisional. Dalam konteks quiz, kompetisi langsung mengaktifkan mekanisme active recall dan spaced repetition yang merupakan dua teknik paling efektif dalam ilmu kognitiv (Roediger & Butler, 2011).

### 2.2.2 Battle Quiz sebagai Mekanisme PvP
Battle Quiz menggabungkan konsep quiz materi pelajaran dengan mekanisme kompetisi langsung. Dalam sistem EduQuest, Battle Quiz menggunakan pendekatan turn-based di mana dua siswa menjawab soal secara bergantian dengan batas waktu. Pendekatan ini memiliki beberapa keunggulan:

1. **Active Recall:** Siswa harus mengingat materi saat menjawab soal, yang terbukti meningkatkan retensi.
2. **Peer Competition:** Tekanan kompetisi langsung meningkatkan fokus dan motivasi.
3. **Instant Feedback:** Siswa langsung mengetahui jawaban benar/salah setelah menjawab.
4. **Social Learning:** Siswa dapat belajar dari materi soal yang dijawab lawan.
5. **Gamification Integration:** Hasil battle dimasukkan ke dalam sistem XP, level, badge, dan leaderboard.

### 2.2.3 Efektivitas PvP terhadap Retensi Materi
Meta-analysis oleh Hamari et al. (2014) menunjukkan bahwa gamifikasi dengan elemen kompetisi memiliki efek positif terhadap engagement. Lebih spesifik, Sailer et al. (2017) menemukan bahwa poin, badge, dan leaderboard paling berpengaruh dalam meningkatkan motivasi. Battle Quiz PvP memperkuat ketiga elemen ini dengan menambahkan dimensi kompetisi langsung yang membuat poin dan peringkat lebih bermakna karena diperoleh melalui kemenangan langsung.

## 2.3 Requirement Engineering

### 2.3.1 Definisi
Requirement Engineering adalah proses sistematis untuk mendokumentasikan, memelihara, dan menegosiasikan kebutuhan sistem perangkat lunak (Sommerville, 2016).

### 2.3.2 Tahapan Requirement Engineering
1. Elicitation: Pengumpulan kebutuhan dari stakeholder.
2. Analysis: Analisis dan validasi kebutuhan.
3. Specification: Dokumentasi kebutuhan dalam format yang terstruktur.
4. Validation: Verifikasi bahwa kebutuhan lengkap dan konsisten.

Dalam penelitian ini, 50 functional requirements telah diidentifikasi dan dikelompokkan dalam 7 modul: Authentication (5 FR), Master Data (5 FR), Learning (10 FR), Gamification (10 FR), Engagement (4 FR), Analytics (6 FR), dan Battle Quiz PvP (10 FR).

## 2.4 User Story

### 2.4.1 Definisi
User Story adalah deskripsi sederhana tentang fitur sistem dari sudut pandang pengguna akhir. Format standar User Story:
"As a [role], I want [feature], so that [benefit]"

### 2.4.2 Komponen User Story
- **Card:** Deskripsi singkat tentang kebutuhan.
- **Conversation:** Diskusi tentang detail kebutuhan.
- **Confirmation:** Kriteria penerimaan (Acceptance Criteria).

## 2.5 Behavior-Driven Development (BDD)

### 2.5.1 Definisi
BDD adalah metodologi pengembangan perangkat lunak yang menggabungkan praktik terbaik dari TDD dan DDD, dengan fokus pada kolaborasi antara developer, QA, dan bisnis.

### 2.5.2 Gherkin Syntax
```
Feature: [Nama Fitur]
  As a [role]
  I want [feature]
  So that [benefit]

  Scenario: [Skenario]
    Given [kondisi awal]
    When [aksi]
    Then [hasil]
```

## 2.6 Studi Terkait

### 2.6.1 Penelitian Gamifikasi di Pendidikan
Berikut beberapa penelitian terkait gamifikasi dalam pendidikan:

| Peneliti | Tahun | Temuan |
|----------|-------|--------|
| Dicheva et al. | 2015 | Gamifikasi efektif meningkatkan engagement |
| Hamari et al. | 2014 | Hasil gamifikasi bervariasi tergantung konteks |
| Sailer et al. | 2017 | Poin, badge, dan leaderboard paling berpengaruh |
| Toda et al. | 2019 | Personalisasi gamifikasi meningkatkan efektivitas |
| Topping | 2005 | Peer tutoring meningkatkan hasil belajar 0.4 SD |
| Roediger & Butler | 2011 | Active recall lebih efektif dari re-reading |

## 2.7 Model Relasi Data dalam Sistem Pembelajaran

Perancangan basis data pada sistem pembelajaran multi-kelas memerlukan model relasi yang dapat mengakomodasi hubungan many-to-many antara guru, kelas, dan mata pelajaran. Dalam sistem yang dikembangkan, relasi ini diimplementasikan melalui tabel pivot `class_subject` yang menghubungkan tiga entitas: guru (user dengan role guru), kelas, dan mata pelajaran. Setiap baris pada tabel ini merepresentasikan penugasan seorang guru untuk mengajar suatu mata pelajaran di suatu kelas tertentu.

Relasi siswa dengan kelas menggunakan tabel pivot `student_classes` yang memungkinkan seorang siswa terdaftar pada satu kelas. Materi pembelajaran dan tugas dapat di-scope secara fleksibel — baik secara global per mata pelajaran maupun spesifik per kelas — melalui foreign key `class_id` yang bersifat opsional (nullable).

Untuk mendukung fitur Battle Quiz PvP, model relasi data diperluas dengan tabel-tabel baru:
- `battle_quizzes`: menyimpan data pertandingan battle (peserta, skor, hasil, tanggal).
- `battle_questions`: menyimpan soal-soal yang digunakan dalam battle.
- `question_banks`: bank soal per mata pelajaran dengan tingkat kesulitan.
- `battle_leaderboards`: cache peringkat battle berdasarkan kemenangan dan win rate.

Pendekatan ini sejalan dengan konsep database normalization (Codd, 1970) yang menghindari redundansi data dengan memisahkan entitas ke dalam tabel-tabel terpisah dan menghubungkannya melalui foreign key.

## 2.8 Teknologi yang Digunakan

### 2.8.1 Laravel 10
Laravel adalah framework PHP yang menyediakan arsitektur MVC, ORM (Eloquent), autentikasi, dan fitur lainnya untuk pengembangan web. Untuk Battle Quiz PvP, Laravel digunakan sebagai backend API yang menangani validasi jawaban, perhitungan skor, dan matchmaking server-side.

### 2.8.2 Next.js 15
Next.js adalah framework React yang mendukung server-side rendering, static generation, dan API routes. Untuk Battle Quiz PvP, Next.js digunakan sebagai frontend yang menampilkan antarmuka battle, timer countdown, dan animasi hasil.

### 2.8.3 MySQL 8
MySQL adalah sistem manajemen basis data relasional yang populer untuk aplikasi web. MySQL 8 mendukung JSON columns yang digunakan untuk menyimpan data soal dan jawaban battle secara fleksibel.
