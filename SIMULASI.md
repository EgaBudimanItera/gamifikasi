# SIMULASI — EduQuest Prototype Full Walkthrough

**Tujuan:** Dokumen ini menjelaskan skenario simulasi lengkap untuk demo prototype EduQuest.
**Versi Prototype:** v0.4 (termasuk Material Reading, Quest NPC, Quick Quiz Liga)

---

## Akun Demo

| Role | Email | Password | Deskripsi |
|------|-------|----------|-----------|
| Admin | admin@eduquest.id | password | Full access |
| Guru | putri@eduquest.id | password | Guru kelas VII |
| Siswa | budi@eduquest.id | password | Siswa VII-A, rank 1 leaderboard |
| Siswa | adi@eduquest.id | password | Siswa VII-A, rank 3 leaderboard |

---

## SKENARIO 1: Login & Dashboard

### Siswa Login
1. Buka browser → `http://localhost:3000`
2. Klik "Masuk"
3. Email: `budi@eduquest.id`, Password: `password`
4. Klik "Masuk"
5. **Expect:** Redirect ke dashboard siswa
6. **Expect:** Ditampilkan:
   - Welcome message: "Halo, Budi!"
   - Level badge (Level 10+)
   - XP bar (progress ke level berikutnya)
   - Streak counter (10+ hari)
   - Quick stats: Total XP, Quests Completed, Badges
   - Leaderboard widget (rank 1)
   - Recent badges

### Guru Login
1. Login sebagai `putri@eduquest.id`
2. **Expect:** Redirect ke dashboard guru
3. **Expect:** Ditampilkan:
   - Class overview stats
   - Siswa terdaftar
   - Quest management
   - Quiz management

---

## SKENARIO 2: Material Reading (FR-59 to FR-62)

### Siswa Membaca Materi
1. Login sebagai `budi@eduquest.id`
2. Navigasi ke "Materi" atau "Reading"
3. Pilih kelas "VII-A"
4. Pilih subjek "Matematika"
5. **Expect:** Daftar materi terbuka (20+ materi)
6. Pilih materi "Pecahan Campuran"
7. Buka materi
8. **Expect:** Konten materi tampil dengan:
   - Judul materi
   - Konten lengkap (text + gambar)
   - Estimasi waktu baca
   - Progress tracker (belajar baca materi)
9. Baca materi sampai selesai
10. Klik "Selesai Baca"
11. **Expect:** Muncul popup "Materi Selesai!" dengan XP earned
12. **Expect:** Progress bar naik

### Siswa Mengerjakan Quiz Setelah Baca
1. Setelah selesai baca materi "Pecahan Campuran"
2. Klik "Mulai Quiz" atau automatic redirect ke quiz
3. **Expect:** 20 soal quiz tentang materi yang baru dibaca
4. **Expect:** Timer 30 detik per soal
5. Pilih jawaban yang benar
6. Submit quiz
7. **Expect:** Skor tampil (0-100%)
8. **Expect:** Jika >= 70%: badge "Reader Star" diberikan
9. **Expect:** XP ditambahkan

### Guru Melihat Progress Membaca
1. Login sebagai `putri@eduquest.id`
2. Navigasi ke "Reading Progress" atau "Laporan Bacaan"
3. **Expect:** Daftar siswa dengan stats:
   - Total materi dibaca
   - Rata-rata skor quiz
   - Total XP dari reading
   - Badge yang didapat

---

## SKENARIO 3: Quest NPC (FR-57 to FR-58)

### Siswa Bertemu NPC
1. Login sebagai `budi@eduquest.id`
2. Navigasi ke "NPC Quests" atau "NPC Gallery"
3. **Expect:** 3 NPC terlihat:
   - Guru Matematika (NPC untuk kelas VII)
   - Bahasa Indonesia (NPC untuk kelas VII)
   - IPA Expert (NPC untuk kelas VII)
4. Pilih NPC "Guru Matematika"
5. **Expect:** NPC chat bubble muncul:
   - Profil NPC
   - Misi yang tersedia
   - Affinity level (0-100)

### Siswa Menerima dan Menyelesaikan Quest
1. Pilih misi "Pecahan Campuran Level 1" dari NPC
2. Klik "Ambil Misi"
3. **Expect:** Quest masuk ke daftar active quests
4. Klik "Mulai Misi"
5. **Expect:** 5 soal quiz tentang pecahan campuran
6. Pilih jawaban
7. Submit quiz
8. **Expect:** Skor tampil
9. Jika >= 60%:
   - Quest status = "completed"
   - XP ditambahkan ke siswa
   - NPC affinity naik
   - NPC chat bubble: "Bagus! Kamu sudah menyelesaikan misiku!"
10. Jika < 60%:
    - Quest status = "failed"
    - Bisa retry sekali

### Sistem Random Encounter
1. Login sebagai `adi@eduquest.id`
2. Klik "Explore" atau aksi apapun
3. **Expect:** 33% kemungkinan bertemu NPC (random encounter)
4. Jika encounter:
   - NPC chat bubble muncul
   - Misi baru tersedia
   - Affinity level naik 5 poin

---

## SKENARIO 4: Quick Quiz Liga (FR-63 to FR-66)

### Guru Membuat Quiz Liga
1. Login sebagai `putri@eduquest.id`
2. Navigasi ke "Quick Quiz" atau "Liga Quiz"
3. Klik "Buat Quiz"
4. Isi form:
   - Judul: "Kuis Matematika VII-A"
   - Mode: "Kelas"
   - Kelas: "VII-A"
   - Durasi: 5 menit
5. Klik "Buat Quiz"
6. **Expect:** Sesi quiz terbuat
7. **Expect:** Soal diambil otomatis dari bank soal NPC (5 soal easy/medium)
8. **Expect:** Status = "active"

### Siswa Bergabung ke Quiz Liga
1. Login sebagai `budi@eduquest.id`
2. Navigasi ke "Quick Quiz"
3. **Expect:** Terlihat sesi quiz aktif "Kuis Matematika VII-A"
4. Klik "Ikut Quiz"
5. **Expect:** Soal quiz tampil
6. **Expect:** Timer countdown 5:00 dimulai
7. Jawab soal 1-5
8. Klik "Submit"
9. **Expect:** Skor tampil (4/5 = 80%)
10. **Expect:** Status "passed" (>= 60%)
11. **Expect:** 30 XP ditambahkan
12. **Expect:** Ranking tampil di atas

### Siswa Lain Bergabung
1. Login sebagai `adi@eduquest.id`
2. Navigasi ke "Quick Quiz"
3. Klik "Ikut Quiz" yang sama
4. Jawab soal 1-5
5. Submit
6. **Expect:** Skor tampil (3/5 = 60%)
7. **Expect:** Status "passed"
8. **Expect:** Ranking: Budi (4/5) > Adi (3/5)

### Anti-Cheat Verification
1. Login sebagai `budi@eduquest.id`
2. Coba join quiz yang sama lagi
3. **Expect:** Error "Kamu sudah bergabung di sesi ini"
4. Coba submit jawaban lagi
5. **Expect:** Error "Kamu sudah submit jawaban"

### Timer Habis
1. Login sebagai siswa lain
2. Join quiz yang sedang berjalan
3. Tunggu timer habis (atau skip 5 menit)
4. **Expect:** Jawaban otomatis dikirim
5. **Expect:** Skor tampil (0/5 jika tidak ada jawaban)

---

## SKENARIO 5: Leaderboard & XP

### Siswa Melihat Leaderboard
1. Login sebagai `budi@eduquest.id`
2. Navigasi ke "Leaderboard"
3. **Expect:** Leaderboard menampilkan:
   - Rank 1: Budi (1,500 XP)
   - Rank 2: Siswa lain (1,200 XP)
   - Rank 3: Adi (1,000 XP)
4. **Expect:** Total 15 siswa di leaderboard
5. **Expect:** Ranking update real-time

### XP Logging
1. Login sebagai `budi@eduquest.id`
2. Cek XP logs (via API atau debug)
3. **Expect:** XP logs tercatat untuk:
   - Material reading
   - Reading quiz
   - NPC quest
   - Quick quiz
4. **Expect:** Tipe XP berbeda-beda

---

## SKENARIO 6: Badge & Achievement

### Siswa Mendapatkan Badge
1. Login sebagai `budi@eduquest.id`
2. Selesaikan 10 quest NPC
3. **Expect:** Badge "Quest Master" diberikan
4. Baca 5 materi
5. **Expect:** Badge "Reader Star" diberikan
6. Menang 5 quick quiz
7. **Expect:** Badge "Quiz Champion" diberikan
8. Streak 10 hari
9. **Expect:** Badge "Streak Master" diberikan

### Guru Melihat Badge Siswa
1. Login sebagai `putri@eduquest.id`
2. Navigasi ke "Student Profiles" atau "Badge Gallery"
3. Pilih siswa "Budi"
4. **Expect:** Semua badge siswa terlihat

---

## SKENARIO 7: Guild System

### Siswa Melihat Guild
1. Login sebagai `budi@eduquest.id`
2. Navigasi ke "Guilds"
3. **Expect:** 3 guild terdaftar:
   - Penjelajah Ilmu (15 anggota)
   - Knight Code (5 anggota)
   - Tekno Warriors (3 anggota)
4. Lihat guild "Penjelajah Ilmu"
5. **Expect:** Anggota, level guild, XP guild

### Guild Quiz Liga
1. Guru membuat quiz mode "Guild"
2. Login sebagai anggota guild
3. Join guild quiz
4. **Expect:** 10 soal (hard/legendary)
5. **Expect:** Durasi 15 menit
6. Submit jawaban
7. **Expect:** 75 XP (jika passed)
8. **Expect:** Ranking antar anggota guild

---

## SKENARIO 8: Profil & Settings

### Siswa Melihat Profil
1. Login sebagai `budi@eduquest.id`
2. Klik profil (avatar)
3. **Expect:** Profil lengkap:
   - Nama: Budi Santoso
   - Kelas: VII-A
   - Level: 10
   - Total XP: 1,500
   - Badges: 10
   - Rank: 1/15

### Siswa Update Profil
1. Klik "Edit Profil"
2. Ganti avatar
3. Simpan
4. **Expect:** Avatar berubah

---

## SKENARIO 9: API Endpoints Testing

### Auth
```
POST /api/auth/login
Body: { "email": "budi@eduquest.id", "password": "password" }
Response: { "token": "...", "user": {...} }
```

### Material Reading
```
GET /api/reading/materials?class_id=1
GET /api/reading/materials/1
POST /api/reading/materials/1/complete
GET /api/reading/stats
GET /api/reading/quiz?material_id=1
POST /api/reading/quiz/submit
```

### Quest NPC
```
GET /api/npc/
GET /api/npc/1
POST /api/npc/1/interact
GET /api/npc/1/quests
POST /api/npc/quests/1/accept
POST /api/npc/quests/1/submit
GET /api/npc/chat
```

### Quick Quiz Liga
```
GET /api/quick-quiz/
POST /api/quick-quiz/
GET /api/quick-quiz/1
POST /api/quick-quiz/1/join
POST /api/quick-quiz/1/submit
GET /api/quick-quiz/1/results
```

### Leaderboard
```
GET /api/leaderboard/
GET /api/leaderboard/class/{classId}
GET /api/leaderboard/guild/{guildId}
```

### Badge
```
GET /api/badges/
GET /api/badges/user/{userId}
```

---

## SCENARIO 10: Error Handling & Edge Cases

### Unauthenticated Access
1. Akses `/api/reading/materials` tanpa token
2. **Expect:** 401 Unauthorized

### Unauthorized Role
1. Login sebagai `budi@eduquest.id`
2. Coba akses `POST /api/quick-quiz/` (guru only)
3. **Expect:** 403 Forbidden

### Invalid Submission
1. Submit jawaban quiz dengan format salah
2. **Expect:** 422 Validation Error

### Not Found
1. Akses `/api/reading/materials/999`
2. **Expect:** 404 Not Found

---

## SKENARIO 11: Database State Verification

### Seed Data
Setelah `php artisan migrate:fresh --seed`, database berisi:

| Table | Count | Detail |
|-------|-------|--------|
| users | 24 | 2 guru + 20 siswa + 2 admin |
| schools | 2 | SMPN 1 Nusantara, SMPN 2 Pelita |
| subjects | 6 | Kelas VII (Mat, Bin, Bing, IPA, IPS, TIK) |
| materials | 21 | 3-5 per kelas |
| assignments | 17 | Tugas dari guru |
| submissions | 31 | Jawaban siswa |
| reading_quizzes | 63 | Soal quiz materi |
| npc_quests | 30 | Quest NPC |
| user_profiles | 20 | Profil siswa |
| guilds | 3 | 3 guild |
| guild_members | 9 | Anggota guild |
| quick_quiz_sessions | 2 | 1 kelas, 1 guild |
| quick_quiz_questions | 9 | Soal quiz |
| quick_quiz_participants | 4 | Peserta quiz |
| xp_logs | 0 | Belum ada XP (fresh seed) |
| badges | 0 | Belum ada badge |
| streaks | 0 | Belum ada streak |

---

## Tips Demo

1. **Mulai dari dashboard:** Tunjukkan UI yang menarik dengan stats
2. **Alur terstruktur:** Ikuti urutan SKENARIO 1 → 2 → 3 → 4 → 5
3. **Tunjukkan integrasi:** XP dari semua sumber masuk ke leaderboard
4. **Anti-cheat:** Tunjukkan error handling saat coba curang
5. **Performance:** Quiz liga tampil cepat meskipun banyak soal
6. **Mobile responsive:** Buka di mobile untuk tunjukkan responsive design

---

## Backend API Base URL
- Local: `http://localhost:8000/api`
- Production: (belum deployed)

## Frontend Base URL
- Local: `http://localhost:3000`
- Production: (belum deployed)
