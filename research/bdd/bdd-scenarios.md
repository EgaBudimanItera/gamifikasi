# BDD Scenarios Catalog — EduQuest

## Authentication

### BDD-01 Login
```gherkin
Feature: User Login
  As a pengguna
  I want to login menggunakan email dan password
  So that saya dapat mengakses sistem

  Scenario: Login berhasil
    Given pengguna berada di halaman login
    And pengguna memiliki akun dengan email "siswa@test.com" dan password "password123"
    When pengguna memasukkan email "siswa@test.com" dan password "password123"
    And pengguna mengklik tombol "Login"
    Then pengguna diarahkan ke dashboard siswa
    And token autentikasi tersimpan di localStorage

  Scenario: Login gagal - password salah
    Given pengguna berada di halaman login
    When pengguna memasukkan email "siswa@test.com" dan password "wrongpassword"
    And pengguna mengklik tombol "Login"
    Then sistem menampilkan pesan "Email atau password salah"
    Dan pengguna tetap di halaman login
```

### BDD-02 Logout
```gherkin
Feature: User Logout
  As a pengguna yang sudah login
  I want to logout dari sistem
  So that sesi saya aman

  Scenario: Logout berhasil
    Given pengguna sedang login sebagai siswa
    When pengguna mengklik tombol "Logout"
    Then token autentikasi dihapus dari localStorage
    And pengguna diarahkan ke halaman login
```

### BDD-03 Reset Password
```gherkin
Feature: Password Reset
  As a pengguna yang lupa password
  I want to mengatur ulang password melalui email
  So that saya dapat mengakses akun kembali

  Scenario: Request reset password
    Given pengguna berada di halaman forgot password
    When pengguna memasukkan email "siswa@test.com"
    And pengguna mengklik "Kirim Link Reset"
    Then sistem menampilkan pesan "Link reset telah dikirim ke email Anda"

  Scenario: Reset password berhasil
    Given pengguna menerima email reset password
    When pengguna mengklik link reset
    And pengguna memasukkan password baru "newpassword123"
    And pengguna mengkonfirmasi password baru
    Then password berhasil diubah
    And pengguna dapat login dengan password baru
```

### BDD-04 Role Management
```gherkin
Feature: Role Management
  As a admin
  I want to menetapkan peran pada pengguna
  So that hak akses sesuai

  Scenario: Admin menetapkan role siswa
    Given admin sedang login
    When admin membuat pengguna baru "Ahmad" dengan role "siswa"
    Then pengguna "Ahmad" memiliki role siswa
    And pengguna hanya dapat mengakses fitur siswa
```

### BDD-05 Access Control
```gherkin
Feature: Access Control
  As a sistem
  I want to membatasi akses berdasarkan peran
  So that keamanan terjaga

  Scenario: Siswa tidak dapat akses endpoint admin
    Given siswa sedang login
    When siswa mengirim request ke "/api/users"
    Then sistem mengembalikan status 403 Forbidden

  Scenario: Guru dapat mengakses data kelas
    Given guru sedang login
    When guru mengirim request ke "/api/classes"
    Then sistem mengembalikan status 200 OK dengan data kelas
```

## Master Data

### BDD-06 Student Management
```gherkin
Feature: Student Management
  As a admin
  I want to mengelola data siswa
  So that data akurat

  Scenario: Admin menambah siswa baru
    Given admin sedang login
    When admin mengisi form siswa dengan nama "Budi", email "budi@test.com", kelas "XII RPL 1"
    And admin mengklik "Simpan"
    Then siswa "Budi" tersimpan di database
    And profil gamifikasi (XP=0, level=1) otomatis dibuat

  Scenario: Admin menghapus siswa
    Given admin sedang login
    And siswa "Budi" ada di database
    When admin mengklik "Hapus" pada siswa "Budi"
    Then siswa "Budi" terhapus dari database
```

### BDD-07 Teacher Management
```gherkin
Feature: Teacher Management
  As a admin
  I want to mengelola data guru
  So that data akurat

  Scenario: Admin menambah guru baru
    Given admin sedang login
    When admin mengisi form guru dengan nama "Pak Ahmad", email "ahmad@test.com"
    And admin mengklik "Simpan"
    Then guru "Pak Ahmad" tersimpan dengan role guru
```

### BDD-08 Class Management
```gherkin
Feature: Class Management
  As a admin
  I want to membuat kelas dan mendaftarkan siswa
  So that siswa terorganisir

  Scenario: Admin membuat kelas baru
    Given admin sedang login
    When admin membuat kelas "XII RPL 1" tahun ajaran "2024/2025"
    Then kelas "XII RPL 1" tersimpan

  Scenario: Admin mendaftarkan siswa ke kelas
    Given admin sedang login
    And kelas "XII RPL 1" sudah ada
    When admin mendaftarkan siswa "Budi" ke kelas "XII RPL 1"
    Then siswa "Budi" terdaftar di kelas "XII RPL 1"
```

### BDD-09 Subject Management
```gherkin
Feature: Subject Management
  As a admin
  I want to mengelola mata pelajaran
  So that kurikulum terorganisir

  Scenario: Admin membuat mata pelajaran
    Given admin sedang login
    When admin membuat mata pelajaran "Pemrograman Web" dengan kode "PW-12"
    Then mata pelajaran tersimpan dengan kode unik "PW-12"
```

### BDD-10 Academic Year Management
```gherkin
Feature: Academic Year Management
  As a admin
  I want to mengelola tahun ajaran
  So that data terpisah per tahun

  Scenario: Admin membuat tahun ajaran baru
    Given admin sedang login
    When admin membuat tahun ajaran "2024/2025" dari "2024-07-01" sampai "2025-06-30"
    Then tahun ajaran tersimpan dan dapat ditandai aktif
```

## Learning

### BDD-11 Create Material
```gherkin
Feature: Create Material
  As a guru
  I want to membuat materi pembelajaran
  So that siswa memiliki referensi

  Scenario: Guru membuat materi baru
    Given guru sedang login
    When guru membuat materi "HTML Fundamentals" dengan konten "Belajar HTML..."
    Then materi tersimpan sebagai draft
    And status published adalah false
```

### BDD-12 Edit Material
```gherkin
Feature: Edit Material
  As a guru
  I want to mengedit materi
  So that materi akurat

  Scenario: Guru mengedit materi draft
    Given guru sedang login
    And materi "HTML Fundamentals" adalah draft
    When guru mengubah konten materi
    Then perubahan tersimpan
```

### BDD-13 Publish Material
```gherkin
Feature: Publish Material
  As a guru
  I want to mempublikasikan materi
  So that siswa dapat mengakses

  Scenario: Guru mempublikasikan materi
    Given guru sedang login
    And materi "HTML Fundamentals" adalah draft
    When guru mengklik "Publikasikan"
    Then status materi berubah menjadi published
    And siswa dapat melihat materi
```

### BDD-14 Create Assignment
```gherkin
Feature: Create Assignment
  As a guru
  I want to membuat tugas dengan deadline dan XP reward
  So that siswa termotivasi

  Scenario: Guru membuat tugas baru
    Given guru sedang login
    When guru membuat tugas "Latihan CSS" dengan XP reward 50 dan deadline "2025-01-20"
    Then tugas tersimpan
    And XP reward tercatat = 50
    And deadline tercatat = "2025-01-20"
```

### BDD-15 Edit Assignment
```gherkin
Feature: Edit Assignment
  As a guru
  I want to mengedit tugas
  So that tugas sesuai kebutuhan

  Scenario: Guru mengedit tugas
    Given guru sedang login
    And tugas "Latihan CSS" sudah ada
    When guru mengubah judul menjadi "Latihan CSS Level 2"
    Then judul tugas berubah
```

### BDD-16 Set Deadline
```gherkin
Feature: Set Deadline
  As a guru
  I want to mengatur deadline tugas
  So that siswa tahu batas waktu

  Scenario: Guru mengatur deadline
    Given guru sedang login
    When guru mengatur deadline tugas "Latihan CSS" ke "2025-01-20 23:59:00"
    Then deadline ditampilkan pada tugas
    And sistem menghitung waktu tersisa
```

### BDD-17 Submit Answer
```gherkin
Feature: Submit Answer
  As a siswa
  I want to mengumpulkan jawaban tugas
  So that tugas selesai

  Scenario: Siswa mengumpulkan jawaban teks
    Given siswa sedang login
    And tugas "Latihan CSS" tersedia
    When siswa mengisi jawaban "Ini adalah jawaban CSS saya"
    And siswa mengklik "Kumpulkan"
    Then jawaban tersimpan dengan status "pending"
    And waktu submit tercatat

  Scenario: Siswa mengumpulkan jawaban file
    Given siswa sedang login
    And tugas "Latihan CSS" tersedia
    When siswa upload file "jawaban.pdf"
    And siswa mengklik "Kumpulkan"
    Then file tersimpan
    And status submission "pending"
```

### BDD-18 Grade Assignment
```gherkin
Feature: Grade Assignment
  As a guru
  I want to memberikan nilai pada jawaban siswa
  So that siswa tahu hasil

  Scenario: Guru menilai jawaban
    Given guru sedang login
    And siswa "Budi" telah mengumpulkan tugas "Latihan CSS"
    When guru memberikan nilai 85
    Then nilai tersimpan
    And status submission berubah "graded"
    And siswa "Budi" mendapatkan +50 XP
    And total_xp siswa "Budi" bertambah 50
```

### BDD-19 Assignment Feedback
```gherkin
Feature: Assignment Feedback
  As a guru
  I want to memberikan feedback pada jawaban
  So that siswa mendapat bimbingan

  Scenario: Guru memberikan feedback
    Given guru sedang login
    And siswa "Budi" telah dinilai
    When guru menulis feedback "Bagus, pertahankan!"
    Then feedback tersimpan
    And siswa dapat melihat feedback
```

### BDD-20 Revision Submission
```gherkin
Feature: Revision Submission
  As a siswa
  I want to merevisi jawaban tugas
  So that nilai dapat diperbaiki

  Scenario: Siswa merevisi jawaban
    Given siswa "Budi" telah dinilai tugas "Latihan CSS"
    When siswa mengajukan revisi dengan jawaban baru
    Then revisi tersimpan dengan status "revised"
    And guru mendapat notifikasi revisi
```

## Gamification

### BDD-21 Award XP
```gherkin
Feature: Award XP
  As a siswa
  I want to mendapatkan XP dari aktivitas
  So that saya termotivasi

  Scenario: Siswa mendapat XP dari tugas selesai
    Given siswa "Budi" memiliki total_xp = 100
    When tugas "Latihan CSS" dinilai selesai
    Then total_xp siswa "Budi" = 150 (+50 XP)
    And log XP tersimpan dengan type "assignment"

  Scenario: Siswa mendapat XP submit awal
    Given tugas "Latihan CSS" deadline "2025-01-20"
    And sekarang "2025-01-18"
    When siswa mengumpulkan tugas
    Then siswa mendapat bonus +20 XP

  Scenario: Siswa mendapat XP login harian
    Given siswa "Budi" belum login hari ini
    When siswa login
    Then siswa mendapat +10 XP
```

### BDD-22 Deduct XP
```gherkin
Feature: Deduct XP
  As a sistem
  I want to mengurangi XP siswa
  So that ada konsekuensi

  Scenario: XP dikurangi karena pelanggaran
    Given siswa "Budi" memiliki total_xp = 200
    When sistem mendeteksi pelanggaran
    Then total_xp siswa "Budi" berkurang
    And log XP tersimpan dengan type "penalty"
```

### BDD-23 Level Calculation
```gherkin
Feature: Level Calculation
  As a siswa
  I want to melihat level berdasarkan XP
  So that saya tahu progres

  Scenario: Perhitungan level
    Given siswa "Budi" memiliki total_xp = 500
    When sistem menghitung level
    Then level = floor(sqrt(500/100)) + 1 = 3

  Scenario: Level bertambah saat XP cukup
    Given siswa "Budi" memiliki total_xp = 99 dan level = 1
    When total_xp bertambah menjadi 100
    Then level = floor(sqrt(100/100)) + 1 = 2
```

### BDD-24 Award Badge
```gherkin
Feature: Award Badge
  As a siswa
  I want to mendapatkan badge pencapaian
  So that saya punya penghargaan

  Scenario: Siswa mendapat badge "First Task"
    Given siswa "Budi" menyelesaikan tugas pertama
    When sistem mendeteksi pencapaian
    Then siswa "Budi" mendapat badge "First Task"
    And notifikasi badge dikirim
```

### BDD-25 Track Streak
```gherkin
Feature: Track Streak
  As a siswa
  I want to melacak streak login harian
  So that saya konsisten login

  Scenario: Streak bertambah saat login harian
    Given siswa "Budi" login 6 hari berturut-turut
    When siswa login pada hari ke-7
    Then streak = 7
    And bonus +100 XP diberikan

  Scenario: Streak milestone 30 hari
    Given siswa "Budi" login 29 hari berturut-turut
    When siswa login pada hari ke-30
    Then streak = 30
    And bonus +500 XP diberikan
```

### BDD-26 Reset Streak
```gherkin
Feature: Reset Streak
  As a sistem
  I want to mereset streak yang putus
  So data akurat

  Scenario: Streak direset karena tidak login
    Given siswa "Budi" memiliki streak = 5
    When siswa tidak login selama 1 hari
    Then streak direset ke 0
```

### BDD-27 Create Quest
```gherkin
Feature: Create Quest
  As a admin/guru
  I want to membuat quest
  So that siswa punya tantangan

  Scenario: Admin membuat quest harian
    Given admin sedang login
    When admin membuat quest "Selesaikan 1 tugas hari ini" tipe "daily" dengan XP reward 30
    Then quest aktif
    And siswa dapat menerima quest
```

### BDD-28 Complete Quest
```gherkin
Feature: Complete Quest
  As a siswa
  I want to menyelesaikan quest
  So that saya mendapat reward

  Scenario: Siswa menyelesaikan quest
    Given siswa "Budi" menerima quest "Selesaikan 1 tugas"
    When siswa menyelesaikan 1 tugas
    Then status quest "completed"
    And +30 XP ditambahkan ke total_xp
```

### BDD-29 Class Leaderboard
```gherkin
Feature: Class Leaderboard
  As a siswa
  I want to melihat peringkat kelas
  So that termotivasi bersaing

  Scenario: Melihat leaderboard kelas
    Given siswa "Budi" berada di kelas "XII RPL 1"
    When siswa membuka leaderboard kelas
    Then siswa melihat peringkat berdasarkan total_xp dalam kelas
    Dan peringkat diurutkan dari tertinggi ke terendah
```

### BDD-30 School Leaderboard
```gherkin
Feature: School Leaderboard
  As a siswa
  I want to melihat peringkat sekolah
  So that termotivasi

  Scenario: Melihat leaderboard sekolah
    Given siswa "Budi" berada di sekolah "SMP Nusantara"
    When siswa membuka leaderboard sekolah
    Then siswa melihat peringkat berdasarkan total_xp seluruh sekolah
```

## Engagement

### BDD-31 Reward Notification
```gherkin
Feature: Reward Notification
  As a siswa
  I want to menerima notifikasi reward
  So that saya merasa dihargai

  Scenario: Notifikasi XP diterima
    Given siswa "Budi" mendapatkan +50 XP
    When XP ditambahkan
    Then notifikasi "Anda mendapatkan +50 XP!" dikirim
    And notifikasi muncul di dashboard

  Scenario: Notifikasi badge diterima
    Given siswa "Budi" mendapat badge "First Task"
    When badge diberikan
    Then notifikasi "Selamat! Anda mendapat badge First Task!" dikirim
```

### BDD-32 Progress Bar
```gherkin
Feature: Progress Bar
  As a siswa
  I want to melihat progress bar XP
  So that tahu progres level

  Scenario: Progress bar ditampilkan
    Given siswa "Budi" memiliki total_xp = 250 dan level = 2
    When siswa membuka dashboard
    Then progress bar menunjukkan 250/400 XP menuju level 3
    Dan persentase = 62.5%
```

### BDD-33 Daily Challenge
```gherkin
Feature: Daily Challenge
  As a siswa
  I want to menyelesaikan challenge harian
  So that dapat bonus XP

  Scenario: Challenge harian baru muncul
    Given hari ini "2025-01-19"
    When siswa membuka halaman challenge
    Then challenge harian "Selesaikan 2 soal latihan" tersedia
    Dan hadiah XP = 30
```

### BDD-34 Weekly Challenge
```gherkin
Feature: Weekly Challenge
  As a siswa
  I want to menyelesaikan challenge mingguan
  So that dapat reward besar

  Scenario: Challenge mingguan baru muncul
    Given minggu ini "2025-01-13" s/d "2025-01-19"
    When siswa membuka halaman challenge
    Then challenge mingguan "Selesaikan 5 tugas" tersedia
    Dan hadiah XP = 200
```

## Analytics & Audit

### BDD-35 Teacher Dashboard
```gherkin
Feature: Teacher Dashboard
  As a guru
  I want to melihat dashboard statistik kelas
  So that memantau siswa

  Scenario: Guru melihat dashboard
    Given guru sedang login
    When guru membuka dashboard
    Then guru melihat jumlah siswa aktif
    And jumlah tugas aktif
    And rata-rata nilai kelas
    And engagement rate
```

### BDD-36 Student Dashboard
```gherkin
Feature: Student Dashboard
  As a siswa
  I want to melihat dashboard gamifikasi saya
  So that memantau pencapaian

  Scenario: Siswa melihat dashboard
    Given siswa sedang login
    When siswa membuka dashboard
    Then siswa melihat total_xp, level, badge count, streak
    And progress bar level
    And quest yang sedang aktif
```

### BDD-37 Completion Statistics
```gherkin
Feature: Completion Statistics
  As a guru
  I want to melihat statistik penyelesaian tugas
  So that identifikasi siswa tertinggal

  Scenario: Guru melihat completion rate
    Given guru sedang login
    When guru memilih kelas "XII RPL 1" dan mata pelajaran "Pemrograman Web"
    Then sistem menampilkan completion rate per tugas
    Dan persentase penyelesaian
```

### BDD-38 Engagement Statistics
```gherkin
Feature: Engagement Statistics
  As a guru
  I want to melihat statistik engagement
  So that evaluasi gamifikasi

  Scenario: Guru melihat engagement
    Given guru sedang login
    When guru memilih rentang waktu "Januari 2025"
    Then sistem menampilkan jumlah login, total XP earned, badge earned
    Dan tren engagement
```

### BDD-39 Activity Audit
```gherkin
Feature: Activity Audit
  As a admin
  I want to melihat log aktivitas
  So that audit keamanan

  Scenario: Admin melihat audit log
    Given admin sedang login
    When admin membuka halaman audit
    Then sistem menampilkan log aktivitas dengan timestamp, user, action
    Dan admin dapat memfilter berdasarkan user atau action
```

### BDD-40 Export Report
```gherkin
Feature: Export Report
  As a guru/admin
  I want to mengekspor laporan
  So that analisis di luar sistem

  Scenario: Export laporan CSV
    Given guru sedang login
    When guru mengklik "Export CSV" pada halaman laporan
    Then file CSV terdownload
    Dan file berisi data yang sesuai

  Scenario: Export laporan PDF
    Given admin sedang login
    When admin mengklik "Export PDF" pada halaman laporan
    Then file PDF terdownload
    Dan file berisi data yang sesuai
```

## Battle Quiz PvP

### BDD-41 Quick Match Battle
```gherkin
Feature: Quick Match Battle
  As a siswa
  I want to memulai battle quiz cepat dengan lawan otomatis
  So that saya dapat berkompetisi dengan siswa lain

  Scenario: Quick match berhasil menemukan lawan
    Given siswa "Budi" berada di halaman Battle Quiz
    And siswa "Budi" memiliki level 3
    When siswa "Budi" mengklik "Quick Match"
    Then sistem mencari lawan dengan level 2-4
    And lawan ditemukan: "Andi" level 3
    And countdown 3 detik dimulai
    And battle dimulai

  Scenario: Quick match tidak menemukan lawan
    Given siswa "Budi" berada di halaman Battle Quiz
    When siswa "Budi" mengklik "Quick Match"
    And tidak ada lawan yang tersedia dalam 30 detik
    Then sistem menampilkan pesan "Tidak ada lawan yang tersedia"
    And siswa kembali ke halaman Battle Quiz
```

### BDD-42 Invite Friend Battle
```gherkin
Feature: Invite Friend Battle
  As a siswa
  I want to mengundang teman untuk battle quiz
  So that saya dapat berkompetisi dengan teman

  Scenario: Mengundang teman untuk battle
    Given siswa "Budi" berada di halaman Battle Quiz
    When siswa "Budi" memilih teman "Andi" dan mengklik "Invite to Battle"
    Then undangan battle dikirim ke "Andi"
    And "Andi" melihat notifikasi undangan battle

  Scenario: Teman menerima undangan
    Given "Andi" menerima undangan battle dari "Budi"
    When "Andi" mengklik "Accept"
    Then battle antara "Budi" dan "Andi" dimulai

  Scenario: Teman menolak undangan
    Given "Andi" menerima undangan battle dari "Budi"
    When "Andi" mengklik "Decline"
    Then undangan dibatalkan
    And "Budi" mendapat notifikasi undangan ditolak
```

### BDD-43 Battle Gameplay
```gherkin
Feature: Battle Gameplay
  As a siswa
  I want to menjawab soal battle secara bergantian
  So that battle terasa seru

  Scenario: Siswa menjawab soal dengan benar
    Given battle antara "Budi" dan "Andi" sedang berlangsung
    And soal pertama: "Apa kepanjangan HTML?"
    When "Budi" menjawab "HyperText Markup Language" dalam 15 detik
    Then "Budi" mendapat +10 poin
    And giliran berpindah ke "Andi"

  Scenario: Siswa menjawab soal dengan salah
    Given battle antara "Budi" dan "Andi" sedang berlangsung
    When "Budi" menjawab dengan jawaban yang salah
    Then "Budi" mendapat +0 poin
    And giliran berpindah ke "Andi"

  Scenario: Waktu habis
    Given battle antara "Budi" dan "Andi" sedang berlangsung
    When timer mencapai 0 detik
    Then jawaban otomatis dianggap salah
    And +0 poin diberikan
```

### BDD-44 Battle Result & Reward
```gherkin
Feature: Battle Result & Reward
  As a siswa
  I want to melihat hasil battle dan mendapatkan reward
  So that saya tahu hasilnya

  Scenario: Battle selesai - pemenang ditentukan
    Given battle antara "Budi" dan "Andi" telah selesai
    And "Budi" memiliki total poin = 40
    And "Andi" memiliki total poin = 30
    When sistem menghitung hasil
    Then "Budi" dinyatakan sebagai pemenang
    And "Budi" mendapatkan +30 XP
    And "Andi" mendapatkan +15 XP (partisipasi)
    And hasil disimpan di riwayat

  Scenario: Perfect battle
    Given battle antara "Budi" dan "Andi" telah selesai
    And "Budi" menjawab semua soal dengan benar
    When battle berakhir
    Then "Budi" mendapatkan bonus +10 XP (perfect battle)
    And badge "Perfect Battle" diberikan jika belum punya
```

### BDD-45 Battle History
```gherkin
Feature: Battle History
  As a siswa
  I want to melihat riwayat battle saya
  So that saya dapat melacak performa

  Scenario: Melihat riwayat battle
    Given siswa "Budi" telah mengikuti 5 battle
    When siswa "Budi" membuka halaman Battle History
    Then siswa melihat 5 entri riwayat battle
    Dan setiap entri menampilkan: lawan, skor, hasil, tanggal
    Dan riwayat diurutkan dari yang terbaru
```

### BDD-46 Battle Leaderboard
```gherkin
Feature: Battle Leaderboard
  As a siswa
  I want to melihat peringkat battle
  So that termotivasi menang

  Scenario: Melihat leaderboard battle kelas
    Given siswa "Budi" berada di kelas "XII RPL 1"
    When siswa membuka Battle Leaderboard kelas
    Then siswa melihat peringkat berdasarkan jumlah kemenangan
    Dan win rate ditampilkan
    Dan peringkat diurutkan dari kemenangan terbanyak
```

### BDD-47 Battle Badge
```gherkin
Feature: Battle Badge
  As a siswa
  I want to mendapatkan badge pencapaian battle
  So that saya punya penghargaan

  Scenario: Mendapat badge Battle Champion
    Given siswa "Budi" memiliki 9 kemenangan battle
    When siswa "Budi" memenangkan battle ke-10
    Then badge "Battle Champion" diberikan
    And notifikasi "Selamat! Anda mendapat badge Battle Champion!" dikirim

  Scenario: Mendapat badge Unstoppable
    Given siswa "Budi" memiliki 4 kemenangan berturut-turut
    When siswa "Budi" memenangkan battle ke-5 berturut-turut
    Then badge "Unstoppable" diberikan
```

### BDD-48 Teacher Battle Statistics
```gherkin
Feature: Teacher Battle Statistics
  As a guru
  I want to melihat statistik battle siswa
  So that evaluasi engagement

  Scenario: Guru melihat statistik battle
    Given guru sedang login
    When guru membuka halaman Battle Statistics
    And guru memilih kelas "XII RPL 1"
    Then guru melihat jumlah battle per siswa
    Dan rata-rata skor kelas
    Dan tingkat partisipasi battle
```

### BDD-49 Question Bank Management
```gherkin
Feature: Question Bank Management
  As a guru
  I want to mengelola bank soal battle quiz
  So that soal bervariasi

  Scenario: Guru membuat soal battle quiz
    Given guru sedang login
    When guru membuat soal "Apa kepanjangan CSS?" dengan 4 pilihan
    And jawaban benar "Cascading Style Sheets"
    And tingkat kesulitan "easy"
    Then soal tersimpan di bank soal
    And soal dapat digunakan di battle quiz

  Scenario: Sistem mengambil soal acak
    Given bank soal memiliki 20 soal
    When battle dimulai
    Then sistem mengambil 5 soal secara acak
    Dan urutan soal berbeda untuk setiap battle
```

### BDD-50 Battle Timer & Anti-Cheat
```gherkin
Feature: Battle Timer & Anti-Cheat
  As a sistem
  I want to memvalidasi jawaban dengan timer
  So that battle adil

  Scenario: Timer server-side habis
    Given battle sedang berlangsung
    When timer server-side mencapai 0 detik
    Then jawaban otomatis dianggap salah
    And poin = 0

  Scenario: Deteksi anomali jawaban terlalu cepat
    Given battle sedang berlangsung
    When siswa mengirim jawaban dalam waktu kurang dari 3 detik
    Then server mencatat anomali timing
    And jawaban tetap diproses
    Dan data anomali disimpan untuk review admin
```

## Quick Quiz Liga

### BDD-63 Quick Quiz Session Management
```gherkin
Feature: Quick Quiz Session Management

  Scenario: Guru membuat sesi quiz kelas
    Given guru "Putri" berada di halaman Quick Quiz
    When guru mengklik "Buat Quiz"
    And guru mengisi judul "Kuis Matematika VII-A", mode "Kelas", kelas "VII-A"
    And guru mengklik "Buat Quiz"
    Then sesi quiz terbuat dengan 5 soal
    And status sesi adalah "active"
    And durasi sesi adalah 5 menit

  Scenario: Guru membuat sesi quiz guild
    Given guru "Putri" berada di halaman Quick Quiz
    When guru membuat sesi quiz mode "Guild" untuk "Penjelajah Ilmu"
    Then sesi quiz terbuat dengan 10 soal
    And difficulty sesi adalah "hard"
    And xp_reward sesi adalah 75
```

### BDD-64 Quick Quiz Participation & Timer
```gherkin
Feature: Quick Quiz Participation & Timer

  Scenario: Siswa bergabung ke sesi quiz
    Given siswa "Budi" berada di halaman Quick Quiz
    And terdapat sesi quiz aktif "Kuis Matematika VII-A"
    When siswa mengklik "Ikut Quiz"
    Then siswa mendapat 5 soal tanpa jawaban benar
    And timer countdown dimulai dari 5 menit

  Scenario: Siswa tidak bisa join dua kali
    Given siswa "Budi" sudah bergabung di sesi quiz
    When siswa mencoba join lagi
    Then sistem menolak dengan pesan "Kamu sudah bergabung"

  Scenario: Waktu habis otomatis submit
    Given siswa "Budi" sedang mengerjakan quiz
    When timer mencapai 0
    Then jawaban otomatis dikirim
    Dan hasil quiz ditampilkan
```

### BDD-65 Quick Quiz Scoring & Ranking
```gherkin
Feature: Quick Quiz Scoring & Ranking

  Scenario: Siswa lulus quiz
    Given siswa "Budi" menjawab 4 dari 5 soal dengan benar
    When siswa submit jawaban
    Then pass percentage adalah 80%
    And status "passed"
    And xp_earned adalah 30

  Scenario: Siswa gagal quiz
    Given siswa "Adi" menjawab 2 dari 5 soal dengan benar
    When siswa submit jawaban
    Then pass percentage adalah 40%
    And status "failed"
    And xp_earned adalah 0

  Scenario: Ranking ditampilkan
    Given terdapat 3 peserta yang sudah selesai
    When siswa melihat hasil
    Then ranking ditampilkan berdasarkan jumlah benar
```

### BDD-66 Quick Quiz Anti-Cheat
```gherkin
Feature: Quick Quiz Anti-Cheat

  Scenario: Submit jawaban tanpa correct_answer
    Given siswa "Budi" bergabung ke sesi quiz
    When soal dikirim ke client
    Then setiap soal memiliki field: id, question, options, difficulty, order
    And field correct_answer tidak disertakan

  Scenario: Tidak bisa submit dua kali
    Given siswa "Budi" sudah submit jawaban
    When siswa mencoba submit lagi
    Then sistem menolak dengan pesan "Kamu sudah submit jawaban"

  Scenario: Validasi server-side
    Given siswa "Budi" mengirim jawaban
    When server memvalidasi
    Then jawaban dicocokkan dengan correct_answer di database
    Dan skor dihitung di server
```

## Pet System

### BDD-54 Pet Adoption & Evolution
```gherkin
Feature: Pet Adoption & Evolution
  As a siswa
  I want to memiliki pet yang tumbuh
  So that saya punya motivasi tambahan

  Scenario: Siswa mendapatkan telur pet
    Given siswa "Budi" baru mendaftar
    When siswa menyelesaikan tutorial
    Then siswa mendapatkan telur pet
    And telur ditampilkan di dashboard

  Scenario: Pet menetas
    Given siswa "Budi" memiliki telur pet
    And total_xp = 100 (level 3)
    When sistem mengecek evolusi
    Then telur menetas menjadi baby pet
    And baby pet bisa bergerak di dashboard

  Scenario: Pet berevolusi ke teen
    Given siswa "Budi" memiliki baby pet
    And total_xp = 500 (level 5)
    When sistem mengecek evolusi
    Then pet berevolusi menjadi teen pet
    And fitur aksesori terbuka
```

### BDD-55 Pet Interaction & Mood
```gherkin
Feature: Pet Interaction & Mood
  As a siswa
  I want to berinteraksi dengan pet
  So that pet bahagia

  Scenario: Memberi makan pet
    Given siswa "Budi" memiliki baby pet dengan hunger = 3
    When siswa mengklik "Feed"
    Then hunger pet = 4
    And happiness pet meningkat +1

  Scenario: Pet bahagia karena login
    Given siswa "Budi" login hari ini
    When login tercatat
    Then happiness pet meningkat +1

  Scenario: Pet sedih karena tidak aktif
    Given siswa "Budi" tidak login kemarin
    When sistem mengecek mood pet
    Then happiness pet berkurang -2
```

### BDD-56 Pet Accessories & Skills
```gherkin
Feature: Pet Accessories & Skills
  As a siswa
  I want to memberikan aksesori ke pet
  So that pet lebih kuat

  Scenario: Equip aksesori ke pet
    Given siswa "Budi" memiliki teen pet
    And siswa memiliki aksesori "Topi Cerdas"
    When siswa mengequip "Topi Cerdas" ke pet
    Then pet menampilkan topi di dashboard
    And pet mendapat skill "Study Buddy"

  Scenario: Skill pet aktif saat reading
    Given pet "Budi" memiliki skill "Study Buddy" (+5% XP)
    When siswa membaca materi
    Then XP reading ditambah 5%
```

## Quest NPC

### BDD-57 Quest NPC Contextual ✅ Implemented
```gherkin
Feature: Quest NPC Contextual
  As a siswa
  I want to menerima quest dari NPC sesuai materi
  So that belajar lebih terarah

  Scenario: NPC muncul saat baca materi
    Given siswa "Budi" membuka materi "HTML Fundamentals"
    When halaman materi dimuat
    Then NPC "Pak HTML" muncul dengan 33% encounter rate
    And quest: "Buat halaman HTML sederhana" (easy, 20 XP)

  Scenario: Siswa menerima quest NPC
    Given NPC "Pak HTML" menampilkan quest
    When siswa mengklik "Accept Quest"
    Then quest masuk ke daftar quest aktif
    And NPC memberikan hint
```

### BDD-58 Quest NPC Dialogue & Reward ✅ Implemented
```gherkin
Feature: Quest NPC Dialogue & Reward
  As a siswa
  I want to berinteraksi dengan NPC dan mendapat reward
  So that saya termotivasi

  Scenario: Dialog intro NPC
    Given siswa pertama kali bertemu NPC "Pak HTML"
    When dialog intro ditampilkan
    Then NPC berkenalan dengan dialog level 1
    And NPC menjelaskan quest pertama

  Scenario: Reward dari NPC
    Given siswa "Budi" menyelesaikan quest NPC
    When quest selesai
    Then NPC memberikan dialog celebration
    And reward: 20 XP
    And affinity XP +5

  Scenario: NPC buka quest legendary
    Given affinity level siswa "Budi" dengan NPC = 4
    When siswa membuka halaman quest NPC
    Then quest legendary muncul
    And quest harder tapi reward lebih besar

  Scenario: NPC gallery menampilkan affinity
    Given siswa membuka halaman /npcs
    When halaman dimuat
    Then 3 NPC ditampilkan dengan level affinity
    And progress bar XP affinity

## Material Reading ✅ Implemented

### BDD-59 Material Reading Points ✅ Implemented
```gherkin
Feature: Material Reading Points
  As a siswa
  I want to mendapat XP saat membaca materi
  So that saya termotivasi membaca

  Scenario: First read bonus
    Given siswa "Budi" membuka materi "CSS Box Model" untuk pertama kali
    When materi terbuka
    Then siswa mendapat +5 XP (open bonus)
    And siswa mendapat +20 XP (first read bonus)

  Scenario: Time bonus
    Given siswa "Budi" sedang membaca materi
    When waktu baca mencapai 3 menit
    Then siswa mendapat +10 XP (time bonus)

  Scenario: Completion bonus
    Given siswa "Budi" membaca materi
    When siswa scroll ke akhir materi
    Then siswa mendapat +5 XP (completion bonus)

  Scenario: Total XP reading
    Given siswa "Budi" pertama kali baca materi dan selesai
    When semua bonus dikalkulasi
    Then total XP = 5 (open) + 20 (first) + 10 (time) + 5 (scroll) = 40 XP
```
**Implementation:** `MaterialReadingService::calculateXp()` + `ReadingTracker` component + `POST /materials/{id}/reading/complete`

### BDD-60 Reading Time Tracking ✅ Implemented
```gherkin
Feature: Reading Time Tracking
  As a sistem
  I want melacak waktu baca siswa
  So that data akurat

  Scenario: Tracking waktu baca
    Given siswa "Budi" membuka materi
    When timestamp buka tercatat
    And sistem mulai hitung waktu_baca
    When siswa menutup materi setelah 5 menit
    Then data dikirim: {material_id, waktu: 300s, scroll_depth: 100%}
    And data tersimpan di reading_logs
```
**Implementation:** `ReadingTracker` component (heartbeat tiap 30 detik) + `reading_logs` table + `POST /materials/{id}/reading/heartbeat`

### BDD-61 Material Reading Quiz ✅ Implemented
```gherkin
Feature: Material Reading Quiz
  As a siswa
  I want to quiz setelah baca materi
  So that saya uji pemahaman

  Scenario: Quiz muncul setelah baca
    Given siswa "Budi" telah baca materi > 3 menit
    And scroll ke bawah
    When quiz ditampilkan (3 soal)
    And siswa menjawab benar 2 dari 3
    Then siswa mendapat +15 XP bonus

  Scenario: Quiz gagal
    Given siswa "Budi" menjawab benar kurang dari 2 soal
    When quiz selesai
    Then pesan "Coba lagi setelah 10 menit" ditampilkan
    And siswa dapat mengulang nanti
```
**Implementation:** `ReadingQuiz` modal component + `MaterialReadingService::getQuiz()` dan `submitQuiz()` + `ReadingQuizSeeder` (60 soal)

### BDD-62 Reading Anti-Cheat ✅ Implemented
```gherkin
Feature: Reading Anti-Cheat
  As a sistem
  I want memvalidasi bacaan siswa
  So that adil

  Scenario: Scroll terlalu cepat
    Given siswa "Budi" membuka materi
    When siswa scroll ke bawah dalam < 3 detik per paragraf
    Then sistem menolak time bonus
    And hanya open bonus yang diberikan

  Scenario: Deteksi anomali
    Given siswa "Budi" mengirim data reading
    When scroll_depth = 100% tapi waktu < 10 detik
    Then server mencatat anomali
    And anomali masuk ke log admin

  Scenario: Batas reading per jam
    Given siswa "Budi" telah membaca 10 materi dalam 1 jam
    When siswa membuka materi baru
    Then pesan "Batas reading tercapai, coba lagi nanti" ditampilkan
    And XP tidak diberikan sampai batas reset
```
**Implementation:** `MaterialReadingService::detectAnomalies()` — scroll 80%+ < 10 detik = anomaly, max 10 materi/jam, flags stored in `reading_logs.is_anomaly`
