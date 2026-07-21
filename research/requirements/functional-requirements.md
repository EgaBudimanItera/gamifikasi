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

## Battle Quiz PvP (FR-41 to FR-50)

### FR-41 Quick Match Battle
- **ID:** FR-41
- **Name:** Quick Match Battle
- **Description:** Siswa dapat memulai battle quiz cepat dengan sistem matchmaking otomatis berdasarkan level dan mata pelajaran yang sama. Sistem mencocokkan dua siswa dengan level yang seimbang.
- **Priority:** High
- **Module:** Battle Quiz PvP
- **Actor:** Siswa

### FR-42 Invite Friend Battle
- **ID:** FR-42
- **Name:** Invite Friend Battle
- **Description:** Siswa dapat mengundang teman sekelas atau teman satu sekolah untuk melakukan battle quiz secara langsung melalui undangan (invitation).
- **Priority:** Medium
- **Module:** Battle Quiz PvP
- **Actor:** Siswa

### FR-43 Battle Gameplay
- **ID:** FR-43
- **Name:** Battle Gameplay
- **Description:** Sistem menyediakan mekanisme battle turn-based di mana dua siswa menjawab soal bergantian. Setiap soal memiliki batas waktu 30 detik. Jawaban benar mendapat 10 poin, jawaban salah 0 poin. Battle terdiri dari 5-10 soal.
- **Priority:** High
- **Module:** Battle Quiz PvP
- **Actor:** Siswa

### FR-44 Battle Result & Reward
- **ID:** FR-44
- **Name:** Battle Result & Reward
- **Description:** Sistem menampilkan hasil battle (skor, pemenang, statistik jawaban) dan memberikan reward XP: pemenang +30 XP, peserta +15 XP, perfect battle (semua benar) +10 bonus XP. Hasil masuk ke leaderboard.
- **Priority:** High
- **Module:** Battle Quiz PvP
- **Actor:** System

### FR-45 Battle History
- **ID:** FR-45
- **Name:** Battle History
- **Description:** Siswa dapat melihat riwayat pertandingan battle quiz yang pernah diikutinya, termasuk lawan, skor, hasil (menang/kalah/seri), dan tanggal pertandingan.
- **Priority:** Medium
- **Module:** Battle Quiz PvP
- **Actor:** Siswa

### FR-46 Battle Leaderboard
- **ID:** FR-46
- **Name:** Battle Leaderboard
- **Description:** Sistem menampilkan peringkat siswa berdasarkan jumlah kemenangan battle (win count) dan win rate (rasio menang/kalah). Terdapat leaderboard per kelas dan per sekolah.
- **Priority:** Medium
- **Module:** Battle Quiz PvP
- **Actor:** System

### FR-47 Battle Badge
- **ID:** FR-47
- **Name:** Battle Badge
- **Description:** Sistem memberikan badge khusus pencapaian battle: "Battle Champion" (10 kemenangan), "Unstoppable" (5 kemenangan berturut-turut), "Perfect Battle" (semua jawaban benar), "Battle Veteran" (50 battle diikuti).
- **Priority:** Medium
- **Module:** Battle Quiz PvP
- **Actor:** System

### FR-48 Teacher Battle Statistics
- **ID:** FR-48
- **Name:** Teacher Battle Statistics
- **Description:** Guru dapat melihat statistik battle quiz siswa di kelasnya, termasuk jumlah battle yang diikuti, rata-rata skor, tingkat partisipasi, dan performa per mata pelajaran.
- **Priority:** Medium
- **Module:** Battle Quiz PvP
- **Actor:** Guru

### FR-49 Question Bank Management
- **ID:** FR-49
- **Name:** Question Bank Management
- **Description:** Guru/admin dapat membuat dan mengelola bank soal untuk battle quiz per mata pelajaran. Setiap soal memiliki pilihan ganda (4 opsi), benar/salah, dan tingkat kesulitan (easy/medium/hard).
- **Priority:** High
- **Module:** Battle Quiz PvP
- **Actor:** Guru, Admin

### FR-50 Battle Timer & Anti-Cheat
- **ID:** FR-50
- **Name:** Battle Timer & Anti-Cheat
- **Description:** Sistem menerapkan timer server-side 30 detik per soal dengan validasi jawaban di server. Semua request jawaban divalidasi di backend untuk mencegah manipulasi. Data timing dikirim untuk analisis pola kecurangan.
- **Priority:** High
- **Module:** Battle Quiz PvP
- **Actor:** System

---

## Quick Quiz Liga (FR-63 to FR-66)

### FR-63 Quick Quiz Session Management
- **ID:** FR-63
- **Name:** Quick Quiz Session Management
- **Description:** Guru dapat membuat sesi quiz cepat (Quick Quiz) untuk kelas atau guild. Untuk mode kelas: durasi 5 menit, 5 soal easy/medium, reward 30 XP. Untuk mode guild: durasi 15 menit, 10 soal hard/legendary, reward 75 XP. Soal diambil otomatis dari bank soal NPC Quest berdasarkan difficulty.
- **Priority:** High
- **Module:** Quick Quiz Liga
- **Actor:** Guru

### FR-64 Quick Quiz Participation & Timer
- **ID:** FR-64
- **Name:** Quick Quiz Participation & Timer
- **Description:** Siswa dapat bergabung ke sesi quiz yang aktif. Sistem menerapkan timer countdown server-side. Ketika waktu habis, jawaban otomatis dikirim. Siswa hanya memiliki 1 attempt per sesi — tidak bisa mengulang.
- **Priority:** High
- **Module:** Quick Quiz Liga
- **Actor:** Siswa

### FR-65 Quick Quiz Scoring & Ranking
- **ID:** FR-65
- **Name:** Quick Quiz Scoring & Ranking
- **Description:** Sistem menghitung skor berdasarkan jumlah jawaban benar. Pass threshold default 60%. Siswa yang lulus mendapatkan XP reward. Sistem menampilkan ranking peserta berdasarkan jumlah jawaban benar.
- **Priority:** High
- **Module:** Quick Quiz Liga
- **Actor:** System

### FR-66 Quick Quiz Anti-Cheat
- **ID:** FR-66
- **Name:** Quick Quiz Anti-Cheat
- **Description:** Sistem menerapkan anti-cheat: satu sesi hanya bisa diikuti satu kali (unique constraint session_id + user_id), jawaban tidak bisa diubah setelah submit, validasi dilakukan server-side, pertanyaan tanpa jawaban benar dikirim ke client.
- **Priority:** High
- **Module:** Quick Quiz Liga
- **Actor:** System

---

## Pet System (FR-54 to FR-56)

### FR-54 Pet Adoption & Evolution
- **ID:** FR-54
- **Name:** Pet Adoption & Evolution
- **Description:** Siswa mendapatkan telur pet saat mendaftar. Pet menetas setelah mencapai level 3 (100+ XP). Pet berevolusi berdasarkan total XP siswa: Stage 1 Egg (Lv1), Stage 2 Baby (Lv3), Stage 3 Teen (Lv5), Stage 4 Adult (Lv8). Setiap evolusi membuka fitur baru (bergerak, aksesori, skill). Pet memiliki stats: happiness, hunger, energy yang dipengaruhi aktivitas siswa.
- **Priority:** High
- **Module:** Pet System
- **Actor:** Siswa

### FR-55 Pet Interaction & Mood
- **ID:** FR-55
- **Name:** Pet Interaction & Mood
- **Description:** Siswa dapat berinteraksi dengan pet: memberi makan (+1 hunger recovery), bermain (+1 happiness), istirahat (+1 energy). Mood pet dipengaruhi aktivitas siswa: login harian +1 happiness, streak +2 happiness, battle win +1 happiness, tidak aktif 1 hari -2 happiness. Pet yang bahagia memberikan bonus kecil (+5% XP).
- **Priority:** Medium
- **Module:** Pet System
- **Actor:** Siswa

### FR-56 Pet Accessories & Skills
- **ID:** FR-56
- **Name:** Pet Accessories & Skills
- **Description:** Siswa dapat memberikan aksesori kepada pet (diperoleh dari crafting, quest, atau battle). Aksesori: topi, baju, alas kaki, props. Pet Stage 3+ memiliki skill pasif: "Study Buddy" (+5% XP dari reading), "Battle Companion" (+5 detik timer), "Streak Guardian" (1x streak freeze). Skill diaktifkan otomatis saat pet equip.
- **Priority:** Medium
- **Module:** Pet System
- **Actor:** Siswa

---

## Quest NPC (FR-57 to FR-58) ✅ Implemented

### FR-57 Quest NPC Contextual
- **ID:** FR-57
- **Name:** Quest NPC Contextual
- **Description:** Setiap mata pelajaran memiliki NPC unik dengan personality berbeda. NPC muncul di halaman materi dan memberikan quest berdasarkan konteks materi yang sedang dipelajari siswa. Quest bersifat contextual: saat baca materi HTML → NPC kasih tantangan coding, setelah 3 tugas CSS → NPC kasih tantangan layout. Quest memiliki difficulty (easy/medium/hard) dan reward XP berbeda.
- **Priority:** High
- **Module:** Quest NPC
- **Actor:** Guru, System
- **Status:** ✅ Implemented
- **Implementation:**
  - Table: `npcs` (migration `2024_01_01_000036`) — NPC definitions
  - Table: `npc_quests` (migration `2024_01_01_000037`) — Quest per NPC
  - Table: `user_npc_affinity` (migration `2024_01_01_000038`) — XP/level per user
  - Model: `Npc`, `NpcQuest`, `UserNpcAffinity`
  - Seeder: `NpcSeeder` — 3 NPCs, `NpcQuestSeeder` — 30 quests
  - Encounter rate: 33% random on materials page
  - Frontend: `NpcChatBubble` component integrated in materials page

### FR-58 Quest NPC Dialogue & Reward
- **ID:** FR-58
- **Name:** Quest NPC Dialogue & Reward
- **Description:** NPC memiliki dialog yang dinamis dan berubah seiring progress siswa. Dialog: intro saat pertama kali bertemu, encouragement saat menyelesaikan quest, hint saat siswa stuck, celebration saat mencapai milestone. NPC memberikan reward eksklusif: aksesori pet, badge khusus NPC, dan XP bonus. NPC punya affinity level dengan siswa yang meningkat seiring interaksi.
- **Priority:** Medium
- **Module:** Quest NPC
- **Actor:** System
- **Status:** ✅ Implemented
- **Implementation:**
  - Service: `NpcService::getDialogForLevel()`, `getQuestsByLevel()`
  - Affinity XP thresholds: [5, 15, 30, 50] → levels 1-5
  - 5-level affinity (Mentor Affinity Score): Stranger → Acquaintance → Friend → Trusted → Master
  - NPC Gallery page: `/npcs`
  - NPC Sidebar link for siswa

---

## Material Reading (FR-59 to FR-62) ✅ Implemented

### FR-59 Material Reading Points
- **ID:** FR-59
- **Name:** Material Reading Points
- **Description:** Siswa mendapatkan XP saat membaca materi pembelajaran: +5 XP saat pertama kali membuka materi (open bonus), +10 XP setelah membaca minimal 3 menit (time bonus), +5 XP saat scroll ke akhir materi (completion bonus). First read bonus: +20 XP pertama kali baca materi baru. Total potensi XP per materi: 40 XP (open 5 + time 10 + scroll 5 + first read 20).
- **Priority:** High
- **Module:** Material Reading
- **Actor:** System
- **Status:** ✅ Implemented
- **Implementation:**
  - Service: `MaterialReadingService::calculateXp()` in `backend/app/Services/Gamification/MaterialReadingService.php`
  - Controller: `MaterialReadingController::complete()` in `backend/app/Http/Controllers/Api/MaterialReadingController.php`
  - XP awarded via `XpService::award()` with type `'reading'`

### FR-60 Reading Time Tracking
- **ID:** FR-60
- **Name:** Reading Time Tracking
- **Description:** Sistem melacak waktu baca siswa per materi: timestamp buka materi, total waktu di halaman, scroll depth (persentase materi yang di-scroll), dan interaksi (klik, highlight). Data dikirim ke backend setelah siswa menutup materi atau mencapai threshold 3 menit. Data disimpan di tabel reading_logs untuk analisis engagement.
- **Priority:** High
- **Module:** Material Reading
- **Actor:** System
- **Status:** ✅ Implemented
- **Implementation:**
  - Table: `reading_logs` (migration `2024_01_01_000033`)
  - Columns: `user_id`, `material_id`, `started_at`, `duration_seconds`, `scroll_depth`, `is_completed`, `xp_earned`, `is_anomaly`, `anomaly_reason`
  - Model: `ReadingLog` in `backend/app/Models/ReadingLog.php`
  - Frontend Tracker: `ReadingTracker` component sends heartbeat every 30s via `POST /materials/{id}/reading/heartbeat`

### FR-61 Material Reading Quiz
- **ID:** FR-61
- **Name:** Material Reading Quiz
- **Description:** Setelah menyelesaikan bacaan (scroll to bottom + waktu > 3 menit), sistem menampilkan quiz singkat 3 soal pilihan ganda dari materi yang baru dibaca. Siswa harus benar minimal 2 dari 3 soal untuk mendapatkan +15 XP bonus. Soal diambil acak dari pool soal materi. Jika gagal, siswa bisa mengulang quiz setelah 10 menit.
- **Priority:** Medium
- **Module:** Material Reading
- **Actor:** System
- **Status:** ✅ Implemented
- **Implementation:**
  - Table: `reading_quizzes` (migration `2024_01_01_000034`)
  - Table: `reading_quiz_attempts` (migration `2024_01_01_000035`)
  - Seeder: `ReadingQuizSeeder` — 60 soal (20 materi × 3 soal)
  - Service: `MaterialReadingService::getQuiz()` dan `submitQuiz()`
  - Frontend: `ReadingQuiz` modal component

### FR-62 Reading Anti-Cheat
- **ID:** FR-62
- **Name:** Reading Anti-Cheat
- **Description:** Sistem menerapkan anti-cheat untuk material reading: timer minimal 3 detik per paragraf (tidak bisa langsung scroll ke bawah), validasi scroll depth di server-side, deteksi automation (rapid scroll pattern), dan batasan maksimal 10 materi per jam untuk mencegah farming. Anomali dicatat untuk review admin.
- **Priority:** High
- **Module:** Material Reading
- **Actor:** System
- **Status:** ✅ Implemented
- **Implementation:**
  - Service: `MaterialReadingService::detectAnomalies()` dan `calculateXp()`
  - Anti-cheat rules:
    - Scroll 80%+ dalam < 10 detik → anomaly
    - Max 10 materi per jam → blocked
  - Config: `config/gamification-rules.json` → `reading` section
  - Anomaly flags stored in `reading_logs.is_anomaly` dan `reading_logs.anomaly_reason`
