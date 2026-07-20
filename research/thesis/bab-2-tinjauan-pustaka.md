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

### 2.1.3 Teori Motivasi
Implementasi gamifikasi didasarkan pada beberapa teori motivasi:

- **Self-Determination Theory (SDT):** Teori yang menjelaskan tiga kebutuhan psikologis dasar: autonomi, kompetensi, dan relasionalitas.
- **Flow Theory:** Kondisi optimal saat seseorang terlibat penuh dalam aktivitas yang seimbang antara tantangan dan kemampuan.
- **Behavioral Psychology:** Penggunaan reinforcement untuk membentuk perilaku positif.

## 2.2 Requirement Engineering

### 2.2.1 Definisi
Requirement Engineering adalah proses sistematis untuk mendokumentasikan, memelihara, dan menegosiasikan kebutuhan sistem perangkat lunak (Sommerville, 2016).

### 2.2.2 Tahapan Requirement Engineering
1. Elicitation: Pengumpulan kebutuhan dari stakeholder.
2. Analysis: Analisis dan validasi kebutuhan.
3. Specification: Dokumentasi kebutuhan dalam format yang terstruktur.
4. Validation: Verifikasi bahwa kebutuhan lengkap dan konsisten.

## 2.3 User Story

### 2.3.1 Definisi
User Story adalah deskripsi sederhana tentang fitur sistem dari sudut pandang pengguna akhir. Format standar User Story:
"As a [role], I want [feature], so that [benefit]"

### 2.3.2 Komponen User Story
- **Card:** Deskripsi singkat tentang kebutuhan.
- **Conversation:** Diskusi tentang detail kebutuhan.
- **Confirmation:** Kriteria penerimaan (Acceptance Criteria).

## 2.4 Behavior-Driven Development (BDD)

### 2.4.1 Definisi
BDD adalah metodologi pengembangan perangkat lunak yang menggabungkan praktik terbaik dari TDD dan DDD, dengan fokus pada kolaborasi antara developer, QA, dan bisnis.

### 2.4.2 Gherkin Syntax
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

## 2.5 Studi Terkait

### 2.5.1 Penelitian Gamifikasi di Pendidikan
Berikut beberapa penelitian terkait gamifikasi dalam pendidikan:

| Peneliti | Tahun | Temuan |
|----------|-------|--------|
| Dicheva et al. | 2015 | Gamifikasi efektif meningkatkan engagement |
| Hamari et al. | 2014 | Hasil gamifikasi bervariasi tergantung konteks |
| Sailer et al. | 2017 | Poin, badge, dan leaderboard paling berpengaruh |
| Toda et al. | 2019 | Personalisasi gamifikasi meningkatkan efektivitas |

## 2.6 Model Relasi Data dalam Sistem Pembelajaran

Perancangan basis data pada sistem pembelajaran multi-kelas memerlukan model relasi yang dapat mengakomodasi hubungan many-to-many antara guru, kelas, dan mata pelajaran. Dalam sistem yang dikembangkan, relasi ini diimplementasikan melalui tabel pivot `class_subject` yang menghubungkan tiga entitas: guru (user dengan role guru), kelas, dan mata pelajaran. Setiap baris pada tabel ini merepresentasikan penugasan seorang guru untuk mengajar suatu mata pelajaran di suatu kelas tertentu.

Relasi siswa dengan kelas menggunakan tabel pivot `student_classes` yang memungkinkan seorang siswa terdaftar pada satu kelas. Materi pembelajaran dan tugas dapat di-scope secara fleksibel — baik secara global per mata pelajaran maupun spesifik per kelas — melalui foreign key `class_id` yang bersifat opsional (nullable).

Pendekatan ini sejalan dengan konsep database normalization (Codd, 1970) yang menghindari redundansi data dengan memisahkan entitas ke dalam tabel-tabel terpisah dan menghubungkannya melalui foreign key.

## 2.7 Teknologi yang Digunakan

### 2.6.1 Laravel 10
Laravel adalah framework PHP yang menyediakan arsitektur MVC, ORM (Eloquent), autentikasi, dan fitur lainnya untuk pengembangan web.

### 2.6.2 Next.js 15
Next.js adalah framework React yang mendukung server-side rendering, static generation, dan API routes.

### 2.6.3 MySQL 8
MySQL adalah sistem manajemen basis data relasional yang populer untuk aplikasi web.
