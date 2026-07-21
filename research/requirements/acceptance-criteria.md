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

## Battle Quiz PvP (AC-41 to AC-50)

### AC-41 Quick Match Battle
- **FR Ref:** FR-41
- **Scenarios:**
  1. Given siswa berada di halaman Battle Quiz
  2. When siswa mengklik "Quick Match"
  3. Then sistem mencari lawan dengan level yang seimbang (+/- 1 level)
  4. And lawan harus berasal dari mata pelajaran yang sama
  5. When lawan ditemukan, then battle dimulai dalam 3 detik countdown

### AC-42 Invite Friend Battle
- **FR Ref:** FR-42
- **Scenarios:**
  1. Given siswa berada di halaman Battle Quiz
  2. When siswa memilih teman dan mengklik "Invite to Battle"
  3. Then undangan battle dikirim ke teman
  4. When teman menerima undangan, then battle dimulai
  5. When teman menolak atau tidak merespon dalam 30 detik, then undangan dibatalkan

### AC-43 Battle Gameplay
- **FR Ref:** FR-43
- **Scenarios:**
  1. Given battle antara dua siswa sedang berlangsung
  2. When soal muncul untuk siswa pertama
  3. Then timer 30 detik dimulai
  4. When siswa menjawab benar, then +10 poin
  5. When siswa menjawab salah atau waktu habis, then +0 poin
  6. When soal selesai untuk siswa pertama, then giliran berpindah ke siswa kedua
  7. When semua soal selesai, then battle berakhir

### AC-44 Battle Result & Reward
- **FR Ref:** FR-44
- **Scenarios:**
  1. Given battle telah selesai
  2. When sistem menghitung skor akhir
  3. Then pemenang ditentukan berdasarkan total poin tertinggi
  4. And pemenang mendapatkan +30 XP
  5. And peserta yang kalah mendapatkan +15 XP (partisipasi)
  6. And jika semua jawaban benar (perfect), bonus +10 XP diberikan
  7. And hasil battle disimpan di riwayat

### AC-45 Battle History
- **FR Ref:** FR-45
- **Scenarios:**
  1. Given siswa membuka halaman Battle History
  2. Then siswa melihat daftar battle yang pernah diikuti
  3. And setiap entry menampilkan: lawan, skor, hasil (menang/kalah/seri), tanggal
  4. And riwayat diurutkan dari yang terbaru

### AC-46 Battle Leaderboard
- **FR Ref:** FR-46
- **Scenarios:**
  1. Given siswa membuka Battle Leaderboard
  2. When siswa memilih scope (kelas/sekolah)
  3. Then siswa melihat peringkat berdasarkan jumlah kemenangan
  4. And win rate (persentase kemenangan) ditampilkan
  5. And peringkat diurutkan dari kemenangan terbanyak

### AC-47 Battle Badge
- **FR Ref:** FR-47
- **Scenarios:**
  1. Given siswa mencapai kriteria badge battle
  2. When badge "Battle Champion" diberikan setelah 10 kemenangan
  3. Then badge muncul di profil dan notifikasi dikirim
  4. When badge "Unstoppable" diberikan setelah 5 kemenangan berturut-turut
  5. Then badge muncul di profil dan notifikasi dikirim

### AC-48 Teacher Battle Statistics
- **FR Ref:** FR-48
- **Scenarios:**
  1. Given guru membuka halaman Battle Statistics
  2. When guru memilih kelas dan mata pelajaran
  3. Then guru melihat: jumlah battle per siswa, rata-rata skor, tingkat partisipasi
  4. And guru dapat melihat distribusi menang/kalah per siswa

### AC-49 Question Bank Management
- **FR Ref:** FR-49
- **Scenarios:**
  1. Given guru membuka halaman Question Bank
  2. When guru membuat soal baru dengan 4 pilihan ganda
  3. Then soal tersimpan dengan jawaban benar yang ditandai
  4. And soal memiliki tingkat kesulitan (easy/medium/hard)
  5. When battle dimulai, then sistem mengambil soal acak dari bank soal

### AC-50 Battle Timer & Anti-Cheat
- **FR Ref:** FR-50
- **Scenarios:**
  1. Given battle sedang berlangsung
  2. When timer server-side mencapai 0 detik
  3. Then jawaban otomatis dianggap salah
  4. When request jawaban dikirim ke server
  5. Then server memvalidasi timestamp jawaban
   6. When timestamp jawaban lebih cepat dari 3 detik (kemungkinan bot)
   7. Then server mencatat anomaly untuk review

## Quick Quiz Liga (AC-63 to AC-66)

### AC-63 Quick Quiz Session Management
- **FR Ref:** FR-63
- **Scenarios:**
  1. Given guru berada di halaman Quick Quiz
  2. When guru mengklik "Buat Quiz" dan mengisi judul, mode (kelas/guild), kelas/guild target
  3. Then sesi quiz terbuat dengan status aktif
  4. And soal diambil otomatis dari bank soal NPC Quest berdasarkan difficulty mode
  5. And siswa yang terdaftar di kelas/guild dapat melihat sesi quiz

### AC-64 Quick Quiz Participation & Timer
- **FR Ref:** FR-64
- **Scenarios:**
  1. Given siswa melihat sesi quiz aktif
  2. When siswa mengklik "Ikut Quiz"
  3. Then siswa mendapat daftar soal tanpa jawaban benar
  4. And timer countdown dimulai dari durasi sesi
  5. When waktu habis, then jawaban otomatis dikirim
  6. When siswa sudah submit, then tidak bisa join lagi ke sesi yang sama

### AC-65 Quick Quiz Scoring & Ranking
- **FR Ref:** FR-65
- **Scenarios:**
  1. Given siswa telah submit jawaban
  2. When sistem menghitung skor
  3. Then jumlah jawaban benar ditampilkan
  4. And pass percentage dihitung
  5. When pass percentage >= 60%, then XP reward ditambahkan
  6. And ranking peserta ditampilkan berdasarkan jumlah benar

### AC-66 Quick Quiz Anti-Cheat
- **FR Ref:** FR-66
- **Scenarios:**
  1. Given siswa sudah submit jawaban di sesi tertentu
  2. When siswa mencoba join sesi yang sama lagi
  3. Then sistem menolak dengan pesan "Kamu sudah bergabung"
  4. When siswa mencoba submit jawaban lagi
  5. Then sistem menolak dengan pesan "Kamu sudah submit jawaban"
  6. When pertanyaan dikirim ke client, then field correct_answer tidak disertakan

## Pet System (AC-54 to AC-56)

### AC-54 Pet Adoption & Evolution
- **FR Ref:** FR-54
- **Scenarios:**
  1. Given siswa baru mendaftar
  2. When siswa menyelesaikan tutorial
  3. Then siswa mendapatkan telur pet
  4. When total_xp siswa mencapai 100 (level 3)
  5. Then telur menetas menjadi baby pet
  6. When total_xp mencapai 500 (level 5)
  7. Then pet berevolusi menjadi teen pet
  8. And teen pet membuka fitur aksesori

### AC-55 Pet Interaction & Mood
- **FR Ref:** FR-55
- **Scenarios:**
  1. Given siswa membuka halaman Pet
  2. When siswa mengklik "Feed" pada pet
  3. Then hunger pet meningkat +1
  4. And happiness pet meningkat +1
  5. When siswa login harian
  6. Then happiness pet meningkat +1
  7. When siswa tidak aktif 1 hari
  8. Then happiness pet berkurang -2

### AC-56 Pet Accessories & Skills
- **FR Ref:** FR-56
- **Scenarios:**
  1. Given siswa memiliki teen pet
  2. And siswa memiliki aksesori "Topi Cerdas" dari crafting
  3. When siswa mengequip "Topi Cerdas" ke pet
  4. Then pet menampilkan topi di dashboard
  5. And pet mendapat skill "Study Buddy" (+5% XP dari reading)
  6. When siswa membaca materi dengan pet equipped
  7. Then XP reading bertambah 5%

## Quest NPC (AC-57 to AC-58) ✅ Implemented

### AC-57 Quest NPC Contextual ✅ Implemented
- **FR Ref:** FR-57
- **Status:** ✅ Implemented
- **Implementation:** `NpcService::encounter()` — 33% dice roll, `getQuestsByLevel()` filters by affinity level. NpcSeeder: 3 NPCs, NpcQuestSeeder: 30 quests
- **Scenarios:**
  1. Given siswa membuka materi "HTML Fundamentals"
  2. When halaman materi dimuat (33% chance)
  3. Then NPC "Pak HTML" muncul dengan quest contextual
  4. And quest: "Buat halaman HTML sederhana" (difficulty: easy, reward: 20 XP)
  5. When siswa menerima quest
  6. Then quest masuk ke daftar quest aktif
  7. And NPC memberikan hint untuk menyelesaikan quest

### AC-58 Quest NPC Dialogue & Reward ✅ Implemented
- **FR Ref:** FR-58
- **Status:** ✅ Implemented
- **Implementation:** `UserNpcAffinity::calculateLevel()` — XP thresholds [5,15,30,50], `Npc::getDialogForLevel()` — 5 dialog levels per NPC
- **Scenarios:**
  1. Given siswa pertama kali bertemu NPC "Pak HTML"
  2. When dialog intro ditampilkan
  3. Then NPC berkenalan dengan dialog level 1
  4. When siswa menyelesaikan quest
  5. Then NPC memberikan dialog celebration
  6. And reward: 20 XP + affinity XP +5
  7. When affinity XP reaches threshold
  8. Then NPC affinity level naik dan quest harder terbuka

## Material Reading (AC-59 to AC-62)

### AC-59 Material Reading Points ✅ Implemented
- **FR Ref:** FR-59
- **Status:** ✅ Implemented
- **Implementation:** `MaterialReadingService::calculateXp()` — XP breakdown: open_bonus (+5), first_read_bonus (+20), time_bonus (+10), scroll_completion_bonus (+5)
- **Scenarios:**
  1. Given siswa membuka materi "CSS Box Model" untuk pertama kali
  2. When materi terbuka
  3. Then siswa mendapat +5 XP (open bonus)
  4. And siswa mendapat +20 XP (first read bonus)
  5. When siswa membaca selama 3 menit
  6. Then siswa mendapat +10 XP (time bonus)
  7. When siswa scroll ke akhir materi
  8. Then siswa mendapat +5 XP (completion bonus)
  9. Total: +40 XP

### AC-60 Reading Time Tracking ✅ Implemented
- **FR Ref:** FR-60
- **Status:** ✅ Implemented
- **Implementation:** `reading_logs` table + `ReadingTracker` frontend component (heartbeat tiap 30 detik)
- **Scenarios:**
  1. Given siswa membuka materi
  2. When timestamp buka materi tercatat
  3. And sistem mulai menghitung waktu_baca
  4. When siswa menutup materi
  5. Then data dikirim ke backend: {material_id, timestamp_buka, waktu_total, scroll_depth, interaksi_count}
  6. And data tersimpan di tabel reading_logs

### AC-61 Material Reading Quiz ✅ Implemented
- **FR Ref:** FR-61
- **Status:** ✅ Implemented
- **Implementation:** `ReadingQuizSeeder` (60 soal) + `MaterialReadingService::getQuiz()` dan `submitQuiz()` + `ReadingQuiz` frontend component
- **Scenarios:**
  1. Given siswa telah membaca materi > 3 menit dan scroll to bottom
  2. When quiz singkat ditampilkan (3 soal pilihan ganda)
  3. When siswa menjawab benar 2 dari 3 soal
  4. Then siswa mendapat +15 XP bonus
  5. When siswa menjawab benar kurang dari 2 soal
  6. Then siswa dapat mengulang setelah 10 menit

### AC-62 Reading Anti-Cheat ✅ Implemented
- **FR Ref:** FR-62
- **Status:** ✅ Implemented
- **Implementation:** `MaterialReadingService::detectAnomalies()` — scroll 80%+ < 10 detik = anomaly, max 10 materi/jam
- **Scenarios:**
  1. Given siswa membuka materi
  2. When siswa mencoba langsung scroll ke bawah dalam < 3 detik per paragraf
  3. Then sistem menolak time bonus
  4. When siswa mengirim data dengan scroll_depth = 100% tapi waktu < 10 detik
  5. Then server mencatat anomali
  6. And anomali masuk ke log untuk review admin
  7. When siswa membaca > 10 materi dalam 1 jam
  8. Then sistem menampilkan pesan "Batas reading tercapai, coba lagi nanti"
