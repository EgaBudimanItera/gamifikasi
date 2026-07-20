# Functional Requirements Catalog — EduQuest

## Authentication (FR-01 to FR-05)

### FR-01 Login
- **ID:** FR-01
- **Name:** User Login
- **Description:** Sistem harus memungkinkan pengguna untuk melakukan autentikasi menggunakan email dan password.
- **Priority:** High
- **Module:** Authentication
- **Actor:** All Users

### FR-02 Logout
- **ID:** FR-02
- **Name:** User Logout
- **Description:** Sistem harus memungkinkan pengguna untuk mengakhiri sesi dan logout dari sistem.
- **Priority:** High
- **Module:** Authentication
- **Actor:** All Users

### FR-03 Reset Password
- **ID:** FR-03
- **Name:** Password Reset
- **Description:** Sistem harus memungkinkan pengguna untuk mengatur ulang password melalui email.
- **Priority:** Medium
- **Module:** Authentication
- **Actor:** All Users

### FR-04 Manajemen Peran
- **ID:** FR-04
- **Name:** Role Management
- **Description:** Sistem harus mendukung tiga peran: admin, guru, dan siswa dengan hak akses berbeda.
- **Priority:** High
- **Module:** Authentication
- **Actor:** Admin

### FR-05 Pembatasan Akses
- **ID:** FR-05
- **Name:** Access Control
- **Description:** Sistem harus membatasi akses pengguna berdasarkan peran yang dimiliki.
- **Priority:** High
- **Module:** Authentication
- **Actor:** System

## Master Data (FR-06 to FR-10)

### FR-06 Kelola Siswa
- **ID:** FR-06
- **Name:** Student Management
- **Description:** Admin dapat membuat, mengedit, dan menghapus data siswa.
- **Priority:** High
- **Module:** Master Data
- **Actor:** Admin

### FR-07 Kelola Guru
- **ID:** FR-07
- **Name:** Teacher Management
- **Description:** Admin dapat membuat, mengedit, dan menghapus data guru.
- **Priority:** High
- **Module:** Master Data
- **Actor:** Admin

### FR-08 Kelola Kelas
- **ID:** FR-08
- **Name:** Class Management
- **Description:** Admin dapat membuat, mengedit, dan menghapus data kelas serta mendaftarkan siswa.
- **Priority:** High
- **Module:** Master Data
- **Actor:** Admin

### FR-09 Kelola Mata Pelajaran
- **ID:** FR-09
- **Name:** Subject Management
- **Description:** Admin dapat membuat, mengedit, dan menghapus data mata pelajaran.
- **Priority:** High
- **Module:** Master Data
- **Actor:** Admin

### FR-10 Kelola Tahun Ajaran
- **ID:** FR-10
- **Name:** Academic Year Management
- **Description:** Admin dapat membuat, mengedit, dan menghapus data tahun ajaran.
- **Priority:** Medium
- **Module:** Master Data
- **Actor:** Admin

## Learning (FR-11 to FR-20)

### FR-11 Buat Materi
- **ID:** FR-11
- **Name:** Create Material
- **Description:** Guru dapat membuat materi pembelajaran baru dengan konten teks dan lampiran file.
- **Priority:** High
- **Module:** Learning
- **Actor:** Guru

### FR-12 Edit Materi
- **ID:** FR-12
- **Name:** Edit Material
- **Description:** Guru dapat mengedit materi yang telah dibuat sebelum dipublikasikan.
- **Priority:** Medium
- **Module:** Learning
- **Actor:** Guru

### FR-13 Publikasi Materi
- **ID:** FR-13
- **Name:** Publish Material
- **Description:** Guru dapat mempublikasikan materi agar siswa dapat mengaksesnya.
- **Priority:** High
- **Module:** Learning
- **Actor:** Guru

### FR-14 Buat Tugas
- **ID:** FR-14
- **Name:** Create Assignment
- **Description:** Guru dapat membuat tugas baru dengan deadline dan hadiah XP.
- **Priority:** High
- **Module:** Learning
- **Actor:** Guru

### FR-15 Edit Tugas
- **ID:** FR-15
- **Name:** Edit Assignment
- **Description:** Guru dapat mengedit tugas yang telah dibuat.
- **Priority:** Medium
- **Module:** Learning
- **Actor:** Guru

### FR-16 Atur Deadline
- **ID:** FR-16
- **Name:** Set Deadline
- **Description:** Guru dapat mengatur dan mengubah batas waktu pengumpulan tugas.
- **Priority:** High
- **Module:** Learning
- **Actor:** Guru

### FR-17 Upload Jawaban
- **ID:** FR-17
- **Name:** Submit Answer
- **Description:** Siswa dapat mengumpulkan jawaban tugas melalui upload file atau teks.
- **Priority:** High
- **Module:** Learning
- **Actor:** Siswa

### FR-18 Penilaian Tugas
- **ID:** FR-18
- **Name:** Grade Assignment
- **Description:** Guru dapat memberikan nilai pada jawaban siswa.
- **Priority:** High
- **Module:** Learning
- **Actor:** Guru

### FR-19 Feedback Tugas
- **ID:** FR-19
- **Name:** Assignment Feedback
- **Description:** Guru dapat memberikan feedback tertulis pada jawaban siswa.
- **Priority:** Medium
- **Module:** Learning
- **Actor:** Guru

### FR-20 Revisi Tugas
- **ID:** FR-20
- **Name:** Revision Submission
- **Description:** Siswa dapat melakukan revisi jawaban tugas yang telah dinilai.
- **Priority:** Medium
- **Module:** Learning
- **Actor:** Siswa

## Gamification (FR-21 to FR-30)

### FR-21 Pemberian XP
- **ID:** FR-21
- **Name:** Award XP
- **Description:** Sistem harus memberikan XP kepada siswa berdasarkan aktivitas yang dilakukan (tugas selesai +50, submit awal +20, login harian +10).
- **Priority:** High
- **Module:** Gamification
- **Actor:** System

### FR-22 Pengurangan XP
- **ID:** FR-22
- **Name:** Deduct XP
- **Description:** Sistem harus dapat mengurangi XP siswa sebagai konsekuensi pelanggaran.
- **Priority:** Low
- **Module:** Gamification
- **Actor:** System

### FR-23 Perhitungan Level
- **ID:** FR-23
- **Name:** Level Calculation
- **Description:** Sistem harus menghitung level siswa menggunakan rumus: level = floor(sqrt(total_xp / 100)) + 1.
- **Priority:** High
- **Module:** Gamification
- **Actor:** System

### FR-24 Pemberian Badge
- **ID:** FR-24
- **Name:** Award Badge
- **Description:** Sistem harus memberikan badge kepada siswa yang mencapai kriteria tertentu.
- **Priority:** High
- **Module:** Gamification
- **Actor:** System

### FR-25 Pemberian Streak
- **ID:** FR-25
- **Name:** Track Streak
- **Description:** Sistem harus melacak streak login harian siswa dan memberikan bonus XP pada milestone.
- **Priority:** High
- **Module:** Gamification
- **Actor:** System

### FR-26 Reset Streak
- **ID:** FR-26
- **Name:** Reset Streak
- **Description:** Sistem harus mereset streak menjadi 0 jika siswa tidak login selama satu hari.
- **Priority:** Medium
- **Module:** Gamification
- **Actor:** System

### FR-27 Pembuatan Quest
- **ID:** FR-27
- **Name:** Create Quest
- **Description:** Admin/guru dapat membuat quest harian, mingguan, atau khusus.
- **Priority:** High
- **Module:** Gamification
- **Actor:** Admin, Guru

### FR-28 Penyelesaian Quest
- **ID:** FR-28
- **Name:** Complete Quest
- **Description:** Sistem harus mendeteksi dan menandai quest yang telah diselesaikan siswa.
- **Priority:** High
- **Module:** Gamification
- **Actor:** System

### FR-29 Leaderboard Kelas
- **ID:** FR-29
- **Name:** Class Leaderboard
- **Description:** Sistem harus menampilkan peringkat siswa berdasarkan total XP dalam satu kelas.
- **Priority:** High
- **Module:** Gamification
- **Actor:** System

### FR-30 Leaderboard Sekolah
- **ID:** FR-30
- **Name:** School Leaderboard
- **Description:** Sistem harus menampilkan peringkat siswa berdasarkan total XP di seluruh sekolah.
- **Priority:** Medium
- **Module:** Gamification
- **Actor:** System

## Engagement (FR-31 to FR-34)

### FR-31 Notifikasi Reward
- **ID:** FR-31
- **Name:** Reward Notification
- **Description:** Sistem harus mengirimkan notifikasi ketika siswa mendapatkan XP, badge, atau menyelesaikan quest.
- **Priority:** High
- **Module:** Engagement
- **Actor:** System

### FR-32 Progress Bar
- **ID:** FR-32
- **Name:** Progress Bar
- **Description:** Sistem harus menampilkan progress bar XP menuju level berikutnya.
- **Priority:** Medium
- **Module:** Engagement
- **Actor:** System

### FR-33 Daily Challenge
- **ID:** FR-33
- **Name:** Daily Challenge
- **Description:** Sistem harus menyediakan challenge harian yang dapat diselesaikan siswa untuk mendapatkan bonus XP.
- **Priority:** Medium
- **Module:** Engagement
- **Actor:** System

### FR-34 Weekly Challenge
- **ID:** FR-34
- **Name:** Weekly Challenge
- **Description:** Sistem harus menyediakan challenge mingguan dengan reward lebih besar.
- **Priority:** Medium
- **Module:** Engagement
- **Actor:** System

## Analytics & Audit (FR-35 to FR-40)

### FR-35 Dashboard Guru
- **ID:** FR-35
- **Name:** Teacher Dashboard
- **Description:** Guru dapat melihat dashboard berisi statistik kelas, tugas, dan engagement siswa.
- **Priority:** High
- **Module:** Analytics
- **Actor:** Guru

### FR-36 Dashboard Siswa
- **ID:** FR-36
- **Name:** Student Dashboard
- **Description:** Siswa dapat melihat dashboard berisi XP, level, badge, streak, dan progress tugas.
- **Priority:** High
- **Module:** Analytics
- **Actor:** Siswa

### FR-37 Statistik Penyelesaian
- **ID:** FR-37
- **Name:** Completion Statistics
- **Description:** Sistem harus menyediakan statistik tingkat penyelesaian tugas per kelas dan per mata pelajaran.
- **Priority:** Medium
- **Module:** Analytics
- **Actor:** Guru, Admin

### FR-38 Statistik Engagement
- **ID:** FR-38
- **Name:** Engagement Statistics
- **Description:** Sistem harus menyediakan statistik engagement siswa berdasarkan aktivitas gamifikasi.
- **Priority:** Medium
- **Module:** Analytics
- **Actor:** Guru, Admin

### FR-39 Audit Aktivitas
- **ID:** FR-39
- **Name:** Activity Audit
- **Description:** Sistem harus mencatat semua aktivitas pengguna untuk audit trail.
- **Priority:** High
- **Module:** Analytics
- **Actor:** System

### FR-40 Ekspor Laporan
- **ID:** FR-40
- **Name:** Export Report
- **Description:** Guru/admin dapat mengekspor laporan dalam format CSV atau PDF.
- **Priority:** Low
- **Module:** Analytics
- **Actor:** Guru, Admin
