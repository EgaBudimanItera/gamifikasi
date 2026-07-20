# Acceptance Criteria Catalog — EduQuest

## Authentication (AC-01 to AC-05)

### AC-01 Login
- **FR Ref:** FR-01
- **Scenarios:**
  1. Given pengguna berada di halaman login
  2. When pengguna memasukkan email dan password yang valid
  3. Then sistem mengarahkan ke dashboard sesuai peran
  4. And token autentikasi disimpan di localStorage

### AC-02 Logout
- **FR Ref:** FR-02
- **Scenarios:**
  1. Given pengguna sedang login
  2. When pengguna mengklik tombol logout
  3. Then token autentikasi dihapus
  4. And pengguna diarahkan ke halaman login

### AC-03 Reset Password
- **FR Ref:** FR-03
- **Scenarios:**
  1. Given pengguna berada di halaman forgot password
  2. When pengguna memasukkan email yang terdaftar
  3. Then sistem mengirimkan email reset password
  4. When pengguna mengklik link reset dan memasukkan password baru
  5. Then password berhasil diubah

### AC-04 Manajemen Peran
- **FR Ref:** FR-04
- **Scenarios:**
  1. Given admin berada di halaman manajemen pengguna
  2. When admin membuat pengguna baru dengan role tertentu
  3. Then pengguna memiliki hak akses sesuai peran

### AC-05 Pembatasan Akses
- **FR Ref:** FR-05
- **Scenarios:**
  1. Given siswa mencoba mengakses endpoint admin
  2. When request dikirim
  3. Then sistem mengembalikan status 403 Forbidden

## Master Data (AC-06 to AC-10)

### AC-06 Kelola Siswa
- **FR Ref:** FR-06
- **Scenarios:**
  1. Given admin berada di halaman manajemen siswa
  2. When admin menambahkan siswa baru dengan data valid
  3. Then siswa tersimpan di database
  4. And profil gamifikasi (XP, level) otomatis dibuat

### AC-07 Kelola Guru
- **FR Ref:** FR-07
- **Scenarios:**
  1. Given admin berada di halaman manajemen guru
  2. When admin menambahkan guru baru dengan data valid
  3. Then guru tersimpan di database dengan role guru

### AC-08 Kelola Kelas
- **FR Ref:** FR-08
- **Scenarios:**
  1. Given admin berada di halaman manajemen kelas
  2. When admin membuat kelas baru dan mendaftarkan siswa
  3. Then kelas terbentuk dengan siswa yang terdaftar

### AC-09 Kelola Mata Pelajaran
- **FR Ref:** FR-09
- **Scenarios:**
  1. Given admin berada di halaman manajemen mata pelajaran
  2. When admin membuat mata pelajaran baru
  3. Then mata pelajaran tersimpan dengan kode unik

### AC-10 Kelola Tahun Ajaran
- **FR Ref:** FR-10
- **Scenarios:**
  1. Given admin berada di halaman tahun ajaran
  2. When admin membuat tahun ajaran baru
  3. Then tahun ajaran tersimpan dan dapat ditandai aktif

## Learning (AC-11 to AC-20)

### AC-11 Buat Materi
- **FR Ref:** FR-11
- **Scenarios:**
  1. Given guru berada di halaman materi
  2. When guru membuat materi baru dengan judul, konten, dan lampiran
  3. Then materi tersimpan sebagai draft

### AC-12 Edit Materi
- **FR Ref:** FR-12
- **Scenarios:**
  1. Given guru memiliki materi draft
  2. When guru mengedit konten materi
  3. Then perubahan tersimpan

### AC-13 Publikasi Materi
- **FR Ref:** FR-13
- **Scenarios:**
  1. Given guru memiliki materi draft
  2. When guru mengklik publikasikan
  3. Then materi menjadi visible untuk siswa

### AC-14 Buat Tugas
- **FR Ref:** FR-14
- **Scenarios:**
  1. Given guru berada di halaman tugas
  2. When guru membuat tugas baru dengan judul, deskripsi, deadline, dan XP reward
  3. Then tugas tersimpan dan siswa dapat melihatnya

### AC-15 Edit Tugas
- **FR Ref:** FR-15
- **Scenarios:**
  1. Given guru memiliki tugas
  2. When guru mengedit detail tugas
  3. Then perubahan tersimpan

### AC-16 Atur Deadline
- **FR Ref:** FR-16
- **Scenarios:**
  1. Given guru membuat tugas
  2. When guru mengatur deadline
  3. Then deadline ditampilkan pada tugas
  4. And sistem menghitung waktu tersisa

### AC-17 Upload Jawaban
- **FR Ref:** FR-17
- **Scenarios:**
  1. Given siswa melihat tugas yang tersedia
  2. When siswa mengumpulkan jawaban (file atau teks)
  3. Then jawaban tersimpan dengan status "pending"

### AC-18 Penilaian Tugas
- **FR Ref:** FR-18
- **Scenarios:**
  1. Given guru melihat jawaban siswa
  2. When guru memberikan nilai
  3. Then nilai tersimpan
  4. And status submission berubah menjadi "graded"
  5. And XP otomatis ditambahkan ke profil siswa

### AC-19 Feedback Tugas
- **FR Ref:** FR-19
- **Scenarios:**
  1. Given guru menilai jawaban siswa
  2. When guru menambahkan feedback tertulis
  3. Then feedback tersimpan dan siswa dapat melihatnya

### AC-20 Revisi Tugas
- **FR Ref:** FR-20
- **Scenarios:**
  1. Given siswa menerima nilai dari tugas
  2. When siswa mengajukan revisi dengan jawaban baru
  3. Then revisi tersimpan dengan status "revised"

## Gamification (AC-21 to AC-30)

### AC-21 Pemberian XP
- **FR Ref:** FR-21
- **Scenarios:**
  1. Given siswa menyelesaikan tugas
  2. When tugas dinilai
  3. Then XP (+50) ditambahkan ke total_xp
  4. And log XP tersimpan di xp_logs

### AC-22 Pengurangan XP
- **FR Ref:** FR-22
- **Scenarios:**
  1. Given siswa memiliki total_xp > 0
  2. When sistem mendeteksi pelanggaran
  3. Then XP dikurangi dan log tersimpan

### AC-23 Perhitungan Level
- **FR Ref:** FR-23
- **Scenarios:**
  1. Given siswa memiliki total_xp = 500
  2. When sistem menghitung level
  3. Then level = floor(sqrt(500/100)) + 1 = 3

### AC-24 Pemberian Badge
- **FR Ref:** FR-24
- **Scenarios:**
  1. Given siswa mencapai kriteria badge
  2. When sistem mendeteksi pencapaian
  3. Then badge diberikan dan notifikasi dikirim

### AC-25 Pemberian Streak
- **FR Ref:** FR-25
- **Scenarios:**
  1. Given siswa login setiap hari
  2. When login ke-7 berturut-turut
  3. Then bonus +100 XP diberikan
  4. And streak counter bertambah

### AC-26 Reset Streak
- **FR Ref:** FR-26
- **Scenarios:**
  1. Given siswa memiliki streak > 0
  2. When siswa tidak login selama 1 hari
  3. Then streak direset ke 0

### AC-27 Pembuatan Quest
- **FR Ref:** FR-27
- **Scenarios:**
  1. Given admin/guru berada di halaman quest
  2. When admin/guru membuat quest baru dengan kriteria
  3. Then quest aktif dan siswa dapat menerimanya

### AC-28 Penyelesaian Quest
- **FR Ref:** FR-28
- **Scenarios:**
  1. Given siswa menerima quest
  2. When siswa memenuhi kriteria quest
  3. Then status quest berubah "completed"
  4. And reward XP diberikan

### AC-29 Leaderboard Kelas
- **FR Ref:** FR-29
- **Scenarios:**
  1. Given siswa berada di dashboard
  2. When siswa membuka leaderboard kelas
  3. Then siswa melihat peringkat berdasarkan total_xp dalam kelas

### AC-30 Leaderboard Sekolah
- **FR Ref:** FR-30
- **Scenarios:**
  1. Given siswa berada di dashboard
  2. When siswa membuka leaderboard sekolah
  3. Then siswa melihat peringkat berdasarkan total_xp seluruh sekolah

## Engagement (AC-31 to AC-34)

### AC-31 Notifikasi Reward
- **FR Ref:** FR-31
- **Scenarios:**
  1. Given siswa mendapatkan XP, badge, atau menyelesaikan quest
  2. When reward diberikan
  3. Then notifikasi muncul di dashboard
  4. And notifikasi tersimpan di tabel notifications

### AC-32 Progress Bar
- **FR Ref:** FR-32
- **Scenarios:**
  1. Given siswa berada di dashboard
  2. When dashboard ditampilkan
  3. Then progress bar menunjukkan XP saat ini vs XP untuk level berikutnya

### AC-33 Daily Challenge
- **FR Ref:** FR-33
- **Scenarios:**
  1. Given siswa membuka halaman challenge
  2. When hari baru dimulai
  3. Then challenge harian baru tersedia
  4. And hadiah XP ditampilkan

### AC-34 Weekly Challenge
- **FR Ref:** FR-34
- **Scenarios:**
  1. Given siswa membuka halaman challenge
  2. When minggu baru dimulai
  3. Then challenge mingguan baru tersedia
  4. And hadiah XP lebih besar dari daily challenge

## Analytics & Audit (AC-35 to AC-40)

### AC-35 Dashboard Guru
- **FR Ref:** FR-35
- **Scenarios:**
  1. Given guru login
  2. When guru membuka dashboard
  3. Then guru melihat statistik: jumlah siswa, tugas aktif, rata-rata nilai, engagement rate

### AC-36 Dashboard Siswa
- **FR Ref:** FR-36
- **Scenarios:**
  1. Given siswa login
  2. When siswa membuka dashboard
  3. Then siswa melihat: total_xp, level, badge, streak, progress bar, quest aktif

### AC-37 Statistik Penyelesaian
- **FR Ref:** FR-37
- **Scenarios:**
  1. Given guru membuka halaman statistik
  2. When guru memilih kelas dan mata pelajaran
  3. Then sistem menampilkan completion rate per tugas

### AC-38 Statistik Engagement
- **FR Ref:** FR-38
- **Scenarios:**
  1. Given guru membuka halaman statistik
  2. When guru memilih rentang waktu
  3. Then sistem menampilkan data login, XP earned, badge earned

### AC-39 Audit Aktivitas
- **FR Ref:** FR-39
- **Scenarios:**
  1. Given admin membuka halaman audit
  2. When admin memilih filter
  3. Then sistem menampilkan log aktivitas dengan timestamp dan detail

### AC-40 Ekspor Laporan
- **FR Ref:** FR-40
- **Scenarios:**
  1. Given guru/admin berada di halaman laporan
  2. When guru/admin mengklik export
  3. Then file CSV/PDF terdownload dengan data yang sesuai
