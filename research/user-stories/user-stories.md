# User Stories Catalog — EduQuest

## Authentication (US-01 to US-05)

### US-01 Login
- **ID:** US-01
- **FR Ref:** FR-01
- **As a** pengguna
- **I want to** login menggunakan email dan password
- **So that** saya dapat mengakses fitur sesuai peran saya
- **Priority:** High

### US-02 Logout
- **ID:** US-02
- **FR Ref:** FR-02
- **As a** pengguna yang sudah login
- **I want to** logout dari sistem
- **So that** sesi saya aman dan tidak dapat diakses orang lain
- **Priority:** High

### US-03 Reset Password
- **ID:** US-03
- **FR Ref:** FR-03
- **As a** pengguna yang lupa password
- **I want to** mengatur ulang password melalui email
- **So that** saya dapat kembali mengakses akun saya
- **Priority:** Medium

### US-04 Manajemen Peran
- **ID:** US-04
- **FR Ref:** FR-04
- **As a** admin
- **I want to** menetapkan peran (admin/guru/siswa) pada pengguna
- **So that** setiap pengguna memiliki hak akses yang tepat
- **Priority:** High

### US-05 Pembatasan Akses
- **ID:** US-05
- **FR Ref:** FR-05
- **As a** sistem
- **I want to** membatasi akses berdasarkan peran
- **So that** hanya pengguna dengan otorisasi yang dapat mengakses fitur tertentu
- **Priority:** High

## Master Data (US-06 to US-10)

### US-06 Kelola Siswa
- **ID:** US-06
- **FR Ref:** FR-06
- **As a** admin
- **I want to** membuat, mengedit, dan menghapus data siswa
- **So that** data siswa selalu akurat dan terkini
- **Priority:** High

### US-07 Kelola Guru
- **ID:** US-07
- **FR Ref:** FR-07
- **As a** admin
- **I want to** membuat, mengedit, dan menghapus data guru
- **So that** data guru selalu akurat dan terkini
- **Priority:** High

### US-08 Kelola Kelas
- **ID:** US-08
- **FR Ref:** FR-08
- **As a** admin
- **I want to** membuat kelas dan mendaftarkan siswa ke dalamnya
- **So that** siswa terorganisir dalam kelas yang benar
- **Priority:** High

### US-09 Kelola Mata Pelajaran
- **ID:** US-09
- **FR Ref:** FR-09
- **As a** admin
- **I want to** membuat dan mengelola mata pelajaran
- **So that** struktur kurikulum terorganisir dengan baik
- **Priority:** High

### US-10 Kelola Tahun Ajaran
- **ID:** US-10
- **FR Ref:** FR-10
- **As a** admin
- **I want to** mengelola tahun ajaran
- **So that** data akademik terpisah per tahun ajaran
- **Priority:** Medium

## Learning (US-11 to US-20)

### US-11 Buat Materi
- **ID:** US-11
- **FR Ref:** FR-11
- **As a** guru
- **I want to** membuat materi pembelajaran dengan konten dan lampiran
- **So that** siswa memiliki referensi belajar yang lengkap
- **Priority:** High

### US-12 Edit Materi
- **ID:** US-12
- **FR Ref:** FR-12
- **As a** guru
- **I want to** mengedit materi yang sudah dibuat
- **So that** materi dapat diperbaiki sebelum dipublikasikan
- **Priority:** Medium

### US-13 Publikasi Materi
- **ID:** US-13
- **FR Ref:** FR-13
- **As a** guru
- **I want to** mempublikasikan materi
- **So that** siswa dapat mengakses dan membacanya
- **Priority:** High

### US-14 Buat Tugas
- **ID:** US-14
- **FR Ref:** FR-14
- **As a** guru
- **I want to** membuat tugas dengan deadline dan hadiah XP
- **So that** siswa termotivasi untuk menyelesaikan tugas tepat waktu
- **Priority:** High

### US-15 Edit Tugas
- **ID:** US-15
- **FR Ref:** FR-15
- **As a** guru
- **I want to** mengedit tugas yang sudah dibuat
- **So that** tugas dapat diperbaiki sesuai kebutuhan
- **Priority:** Medium

### US-16 Atur Deadline
- **ID:** US-16
- **FR Ref:** FR-16
- **As a** guru
- **I want to** mengatur batas waktu pengumpulan tugas
- **So that** siswa mengetahui kapan harus mengumpulkan
- **Priority:** High

### US-17 Upload Jawaban
- **ID:** US-17
- **FR Ref:** FR-17
- **As a** siswa
- **I want to** mengumpulkan jawaban tugas melalui upload file atau teks
- **So that** saya dapat menyelesaikan tugas yang diberikan
- **Priority:** High

### US-18 Penilaian Tugas
- **ID:** US-18
- **FR Ref:** FR-18
- **As a** guru
- **I want to** memberikan nilai pada jawaban siswa
- **So that** siswa mengetahui hasil kerja mereka
- **Priority:** High

### US-19 Feedback Tugas
- **ID:** US-19
- **FR Ref:** FR-19
- **As a** guru
- **I want to** memberikan feedback tertulis pada jawaban siswa
- **So that** siswa mendapat bimbingan untuk perbaikan
- **Priority:** Medium

### US-20 Revisi Tugas
- **ID:** US-20
- **FR Ref:** FR-20
- **As a** siswa
- **I want to** merevisi jawaban tugas yang sudah dinilai
- **So that** saya dapat memperbaiki nilai saya
- **Priority:** Medium

## Gamification (US-21 to US-30)

### US-21 Pemberian XP
- **ID:** US-21
- **FR Ref:** FR-21
- **As a** siswa
- **I want to** mendapatkan XP ketika menyelesaikan aktivitas
- **So that** saya termotivasi untuk aktif belajar
- **Priority:** High

### US-22 Pengurangan XP
- **ID:** US-22
- **FR Ref:** FR-22
- **As a** sistem
- **I want to** mengurangi XP siswa saat pelanggaran
- **So that** ada konsekuensi atas perilaku negatif
- **Priority:** Low

### US-23 Perhitungan Level
- **ID:** US-23
- **FR Ref:** FR-23
- **As a** siswa
- **I want to** melihat level saya berdasarkan total XP
- **So that** saya dapat melihat progres kemajuan saya
- **Priority:** High

### US-24 Pemberian Badge
- **ID:** US-24
- **FR Ref:** FR-24
- **As a** siswa
- **I want to** mendapatkan badge pencapaian
- **So that** saya memiliki penghargaan atas prestasi saya
- **Priority:** High

### US-25 Pemberian Streak
- **ID:** US-25
- **FR Ref:** FR-25
- **As a** siswa
- **I want to** melacak streak login harian saya
- **So that** saya termotivasi untuk login setiap hari
- **Priority:** High

### US-26 Reset Streak
- **ID:** US-26
- **FR Ref:** FR-26
- **As a** sistem
- **I want to** mereset streak jika siswa tidak login sehari
- **So that** streak benar-benar mencerminkan konsistensi
- **Priority:** Medium

### US-27 Pembuatan Quest
- **ID:** US-27
- **FR Ref:** FR-27
- **As a** admin/guru
- **I want to** membuat quest harian, mingguan, atau khusus
- **So that** siswa memiliki tantangan untuk diselesaikan
- **Priority:** High

### US-28 Penyelesaian Quest
- **ID:** US-28
- **FR Ref:** FR-28
- **As a** siswa
- **I want to** menyelesaikan quest dan mendapatkan reward
- **So that** saya mendapat bonus XP dan penghargaan
- **Priority:** High

### US-29 Leaderboard Kelas
- **ID:** US-29
- **FR Ref:** FR-29
- **As a** siswa
- **I want to** melihat peringkat saya di kelas berdasarkan XP
- **So that** saya termotivasi untuk bersaing secara sehat
- **Priority:** High

### US-30 Leaderboard Sekolah
- **ID:** US-30
- **FR Ref:** FR-30
- **As a** siswa
- **I want to** melihat peringkat saya di sekolah berdasarkan XP
- **So that** saya termotivasi untuk berprestasi lebih tinggi
- **Priority:** Medium

## Engagement (US-31 to US-34)

### US-31 Notifikasi Reward
- **ID:** US-31
- **FR Ref:** FR-31
- **As a** siswa
- **I want to** menerima notifikasi saat mendapatkan reward
- **So that** saya merasa dihargai atas pencapaian saya
- **Priority:** High

### US-32 Progress Bar
- **ID:** US-32
- **FR Ref:** FR-32
- **As a** siswa
- **I want to** melihat progress bar XP menuju level berikutnya
- **So that** saya tahu seberapa dekat dengan level berikutnya
- **Priority:** Medium

### US-33 Daily Challenge
- **ID:** US-33
- **FR Ref:** FR-33
- **As a** siswa
- **I want to** menyelesaikan challenge harian untuk bonus XP
- **So that** saya memiliki aktivitas harian yang menantang
- **Priority:** Medium

### US-34 Weekly Challenge
- **ID:** US-34
- **FR Ref:** FR-34
- **As a** siswa
- **I want to** menyelesaikan challenge mingguan untuk reward besar
- **So that** saya termotivasi untuk konsisten belajar sepanjang minggu
- **Priority:** Medium

## Analytics & Audit (US-35 to US-40)

### US-35 Dashboard Guru
- **ID:** US-35
- **FR Ref:** FR-35
- **As a** guru
- **I want to** melihat dashboard statistik kelas
- **So that** saya dapat memantau progres dan engagement siswa
- **Priority:** High

### US-36 Dashboard Siswa
- **ID:** US-36
- **FR Ref:** FR-36
- **As a** siswa
- **I want to** melihat dashboard XP, level, badge, dan streak saya
- **So that** saya dapat memantau pencapaian gamifikasi saya
- **Priority:** High

### US-37 Statistik Penyelesaian
- **ID:** US-37
- **FR Ref:** FR-37
- **As a** guru
- **I want to** melihat statistik penyelesaian tugas per kelas
- **So that** saya dapat mengidentifikasi siswa yang tertinggal
- **Priority:** Medium

### US-38 Statistik Engagement
- **ID:** US-38
- **FR Ref:** FR-38
- **As a** guru
- **I want to** melihat statistik engagement siswa
- **So that** saya dapat mengevaluasi efektivitas gamifikasi
- **Priority:** Medium

### US-39 Audit Aktivitas
- **ID:** US-39
- **FR Ref:** FR-39
- **As a** admin
- **I want to** melihat log aktivitas semua pengguna
- **So that** saya dapat melakukan audit keamanan
- **Priority:** High

### US-40 Ekspor Laporan
- **ID:** US-40
- **FR Ref:** FR-40
- **As a** guru/admin
- **I want to** mengekspor laporan dalam format CSV/PDF
- **So that** saya dapat menganalisis data di luar sistem
- **Priority:** Low

## Battle Quiz PvP (US-41 to US-50)

### US-41 Quick Match Battle
- **ID:** US-41
- **FR Ref:** FR-41
- **As a** siswa
- **I want to** memulai battle quiz cepat dengan lawan otomatis
- **So that** saya dapat berkompetisi dengan siswa lain yang selevel
- **Priority:** High

### US-42 Invite Friend Battle
- **ID:** US-42
- **FR Ref:** FR-42
- **As a** siswa
- **I want to** mengundang teman untuk battle quiz
- **So that** saya dapat berkompetisi langsung dengan teman yang saya kenal
- **Priority:** Medium

### US-43 Battle Gameplay
- **ID:** US-43
- **FR Ref:** FR-43
- **As a** siswa
- **I want to** menjawab soal battle secara bergantian dengan timer
- **So that** battle terasa seru dan kompetitif
- **Priority:** High

### US-44 Battle Result & Reward
- **ID:** US-44
- **FR Ref:** FR-44
- **As a** siswa
- **I want to** melihat hasil battle dan mendapatkan reward XP
- **So that** saya tahu siapa yang menang dan mendapat penghargaan
- **Priority:** High

### US-45 Battle History
- **ID:** US-45
- **FR Ref:** FR-45
- **As a** siswa
- **I want to** melihat riwayat battle saya
- **So that** saya dapat melacak perkembangan performa battle saya
- **Priority:** Medium

### US-46 Battle Leaderboard
- **ID:** US-46
- **FR Ref:** FR-46
- **As a** siswa
- **I want to** melihat peringkat battle di kelas dan sekolah
- **So that** saya termotivasi untuk memenangkan lebih banyak battle
- **Priority:** Medium

### US-47 Battle Badge
- **ID:** US-47
- **FR Ref:** FR-47
- **As a** siswa
- **I want to** mendapatkan badge pencapaian battle
- **So that** saya memiliki penghargaan atas prestasi battle saya
- **Priority:** Medium

### US-48 Teacher Battle Statistics
- **ID:** US-48
- **FR Ref:** FR-48
- **As a** guru
- **I want to** melihat statistik battle quiz siswa
- **So that** saya dapat mengevaluasi engagement dan pemahaman siswa melalui battle
- **Priority:** Medium

### US-49 Question Bank Management
- **ID:** US-49
- **FR Ref:** FR-49
- **As a** guru
- **I want to** membuat dan mengelola bank soal battle quiz
- **So that** soal battle bervariasi dan sesuai kurikulum
- **Priority:** High

### US-50 Battle Timer & Anti-Cheat
- **ID:** US-50
- **FR Ref:** FR-50
- **As a** sistem
- **I want to** memvalidasi jawaban di server dengan timer
- **So that** battle adil dan tidak bisa dimanipulasi
- **Priority:** High

## Quick Quiz Liga (US-63 to US-66)

### US-63 Quick Quiz Session Management
- **ID:** US-63
- **FR Ref:** FR-63
- **As a** guru
- **I want to** membuat sesi quiz cepat untuk kelas atau guild
- **So that** siswa memiliki tantangan kompetitif yang terstruktur
- **Priority:** High

### US-64 Quick Quiz Participation & Timer
- **ID:** US-64
- **FR Ref:** FR-64
- **As a** siswa
- **I want to** bergabung ke sesi quiz dan menjawab soal dengan batas waktu
- **So that** saya dapat berkompetisi dengan siswa lain secara fair
- **Priority:** High

### US-65 Quick Quiz Scoring & Ranking
- **ID:** US-65
- **FR Ref:** FR-65
- **As a** siswa
- **I want to** melihat skor dan ranking saya setelah quiz selesai
- **So that** saya tahu posisi saya dibandingkan peserta lain
- **Priority:** High

### US-66 Quick Quiz Anti-Cheat
- **ID:** US-66
- **FR Ref:** FR-66
- **As a** sistem
- **I want to** mencegah kecurangan dalam quick quiz
- **So that** kompetisi berjalan fair untuk semua peserta
- **Priority:** High

## Pet System (US-54 to US-56)

### US-54 Pet Adoption & Evolution
- **ID:** US-54
- **FR Ref:** FR-54
- **As a** siswa
- **I want to** memiliki pet yang tumbuh seiring progres belajar saya
- **So that** saya punya motivasi tambahan dan teman belajar
- **Priority:** High

### US-55 Pet Interaction & Mood
- **ID:** US-55
- **FR Ref:** FR-55
- **As a** siswa
- **I want to** berinteraksi dengan pet saya (memberi makan, bermain)
- **So that** pet saya bahagia dan memberikan bonus
- **Priority:** Medium

### US-56 Pet Accessories & Skills
- **ID:** US-56
- **FR Ref:** FR-56
- **As a** siswa
- **I want to** memberikan aksesori dan skill ke pet saya
- **So that** pet saya lebih kuat dan berpenampilan menarik
- **Priority:** Medium

## Quest NPC (US-57 to US-58) ✅ Implemented

### US-57 Quest NPC Contextual ✅ Implemented
- **ID:** US-57
- **FR Ref:** FR-57
- **As a** siswa
- **I want to** menerima quest dari NPC yang sesuai dengan materi yang saya pelajari
- **So that** belajar lebih terarah dan menyenangkan
- **Priority:** High
- **Status:** ✅ Implemented
- **Implementation:** 3 NPCs seeded (Pak HTML, Bu Database, Profesor Algo), 30 quests, encounter rate 33% on materials page, NpcChatBubble component shows encounter + quest modal

### US-58 Quest NPC Dialogue & Reward ✅ Implemented
- **ID:** US-58
- **FR Ref:** FR-58
- **As a** siswa
- **I want to** berinteraksi dengan NPC dan mendapat reward eksklusif
- **So that** saya merasa dekat dengan NPC dan termotivasi menyelesaikan quest
- **Priority:** Medium
- **Status:** ✅ Implemented
- **Implementation:** 5-level affinity system (Mentor Affinity Score) (Stranger→Acquaintance→Friend→Trusted→Master), XP thresholds [5,15,30,50], NPC gallery page `/npcs`, dynamic dialog per level

## Material Reading (US-59 to US-62)

### US-59 Material Reading Points ✅ Implemented
- **ID:** US-59
- **FR Ref:** FR-59
- **As a** siswa
- **I want to** mendapat XP saat membaca materi pembelajaran
- **So that** saya termotivasi untuk benar-benar membaca materi
- **Priority:** High
- **Status:** ✅ Implemented
- **Implementation:** Frontend `ReadingTracker` component + backend `MaterialReadingService::completeReading()` — siswa klik "Baca Materi & Dapatkan XP", timer berjalan, XP dihitung saat selesai

### US-60 Reading Time Tracking ✅ Implemented
- **ID:** US-60
- **FR Ref:** FR-60
- **As a** sistem
- **I want to** melacak waktu baca siswa per materi
- **So that** data engagement siswa terukur dan akurat
- **Priority:** High
- **Status:** ✅ Implemented
- **Implementation:** `ReadingTracker` component mengirim heartbeat tiap 30 detik, data disimpan di `reading_logs` table, scroll depth tracked

### US-61 Material Reading Quiz ✅ Implemented
- **ID:** US-61
- **FR Ref:** FR-61
- **As a** siswa
- **I want to** mengerjakan quiz singkat setelah membaca materi
- **So that** saya dapat menguji pemahaman dan mendapat bonus XP
- **Priority:** Medium
- **Status:** ✅ Implemented
- **Implementation:** Frontend `ReadingQuiz` modal component — quiz muncul otomatis setelah reading complete, 3 soal acak, pass threshold 2/3, +15 XP jika lulus

### US-62 Reading Anti-Cheat ✅ Implemented
- **ID:** US-62
- **FR Ref:** FR-62
- **As a** sistem
- **I want to** memvalidasi bahwa siswa benar-benar membaca materi
- **So that** XP reading didapatkan secara adil
- **Priority:** High
- **Status:** ✅ Implemented
- **Implementation:** `MaterialReadingService::detectAnomalies()` — anomali jika scroll 80%+ < 10 detik atau > 10 materi/jam, XP bonus ditolak jika anomali
