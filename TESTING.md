# Testing Guide - EduQuest

## Quick Start Testing

### 1. Start Backend & Frontend

```bash
# Terminal 1 - Backend
cd backend
php artisan serve
# Runs on http://localhost:8000

# Terminal 2 - Frontend
cd frontend
npm run dev
# Runs on http://localhost:3000
```

### 2. Test Accounts

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@eduquest.com | password |
| Guru | guru@eduquest.com | password |
| Siswa | siswa@eduquest.com | password |

---

## Manual Testing (Browser)

### Skenario Siswa

1. **Login** → Buka `http://localhost:3000/auth/login` → Masuk sebagai siswa
2. **Dashboard** → Cek XP, Level, Streak, Badge count
3. **Materi** → Klik sidebar "Materi" → Klik materi untuk expand detail
4. **Tugas** → Klik sidebar "Tugas" → Klik "Kumpulkan" → Isi jawaban → Submit
5. **Setelah Submit** → Tombol berubah jadi ✓ "Dikumpulkan"
6. **Quest** → Klik sidebar "Quest" → Klik "Terima" untuk ambil quest
7. **Badge** → Klik sidebar "Badge" → Lihat badge collection
8. **Leaderboard** → Klik sidebar "Leaderboard" → Tab Kelas/Sekolah

### Skenario Guru

1. **Login** → Masuk sebagai guru
2. **Dashboard** → Lihat total siswa, tugas aktif, rata-rata nilai
3. **Materi** → Lihat daftar materi (bisa buat baru)
4. **Tugas** → Lihat daftar tugas (bisa buat baru)
5. **Submissions** → Lihat pengumpulan siswa dari API

### Skenario Admin

1. **Login** → Masuk sebagai admin
2. **User Management** → Lihat daftar user
3. **School Management** → Lihat daftar sekolah

---

## API Testing (PowerShell / Postman)

### Login

```powershell
$body = '{"email":"siswa@eduquest.com","password":"password"}'
$login = Invoke-RestMethod -Uri "http://localhost:8000/api/auth/login" -Method POST -ContentType "application/json" -Body $body
$h = @{ Authorization = "Bearer $($login.data.token)" }
```

### Test Endpoints

```powershell
# Gamification Profile
Invoke-RestMethod -Uri "http://localhost:8000/api/gamification/profile" -Headers $h

# Student Dashboard
Invoke-RestMethod -Uri "http://localhost:8000/api/dashboard/student" -Headers $h

# List Materials (paginated)
Invoke-RestMethod -Uri "http://localhost:8000/api/materials" -Headers $h

# List Assignments (includes my_submission status)
Invoke-RestMethod -Uri "http://localhost:8000/api/assignments" -Headers $h

# Submit Assignment
$sub = '{"answer_text":"Jawaban saya..."}'
Invoke-RestMethod -Uri "http://localhost:8000/api/assignments/1/submissions" -Method POST -Headers $h -Body $sub -ContentType "application/json"

# List Quests
Invoke-RestMethod -Uri "http://localhost:8000/api/quests" -Headers $h

# Accept Quest
Invoke-RestMethod -Uri "http://localhost:8000/api/quests/1/accept" -Method POST -Headers $h -ContentType "application/json"

# List Badges
Invoke-RestMethod -Uri "http://localhost:8000/api/badges" -Headers $h

# Leaderboard
Invoke-RestMethod -Uri "http://localhost:8000/api/leaderboard/class/1" -Headers $h

# Daily Check-In (streak)
Invoke-RestMethod -Uri "http://localhost:8000/api/gamification/streak/check-in" -Method POST -Headers $h -ContentType "application/json"
```

### Guru-Specific

```powershell
# Login as Guru
$gb = '{"email":"guru@eduquest.com","password":"password"}'
$gl = Invoke-RestMethod -Uri "http://localhost:8000/api/auth/login" -Method POST -ContentType "application/json" -Body $gb
$gh = @{ Authorization = "Bearer $($gl.data.token)" }

# Teacher Dashboard
Invoke-RestMethod -Uri "http://localhost:8000/api/dashboard/teacher" -Headers $gh

# View Submissions for Assignment
Invoke-RestMethod -Uri "http://localhost:8000/api/assignments/1/submissions" -Headers $gh

# Grade a Submission
$grade = '{"score":85,"feedback":"Bagus, ada sedikit revisi di flexbox"}'
Invoke-RestMethod -Uri "http://localhost:8000/api/submissions/1/grade" -Method POST -Headers $gh -Body $grade -ContentType "application/json"
```

### Revisi (Siswa)

```powershell
# After grading, student can revise
$revisi = '{"answer_text":"Revisi: Sudah diperbaiki sesuai feedback!"}'
Invoke-RestMethod -Uri "http://localhost:8000/api/submissions/1/revise" -Method POST -Headers $sh -Body $revisi -ContentType "application/json"
# Returns: status=revised, old grade deleted
```

---

## Test Result Checklist

| # | Test | Expected | Status |
|---|------|----------|--------|
| 1 | Login siswa | Token + user data returned | [x] PASS |
| 2 | Gamification profile | XP, level, streak data | [x] PASS |
| 3 | Student dashboard | Stats + completion data | [x] PASS |
| 4 | List materials | 6 materials returned | [x] PASS |
| 5 | List assignments | 4 assignments + my_submission field | [x] PASS |
| 6 | Submit assignment | 201 + XP bonus awarded | [x] PASS |
| 7 | Duplicate submit | 422 error | [ ] |
| 8 | Re-check after submit | my_submission.status=pending | [x] PASS |
| 9 | List quests | 6 quests (daily/weekly/special) | [x] PASS |
| 10 | List badges | 3 badges | [x] PASS |
| 11 | Leaderboard | Ranked list by XP | [x] PASS |
| 12 | Daily check-in | Streak incremented | [x] PASS |
| 13 | Login guru | Token + user data | [x] PASS |
| 14 | Guru view submissions | Submissions list | [x] PASS |
| 15 | Guru grade submission | Score + feedback saved, XP awarded | [x] PASS |
| 16 | Siswa blocked from admin routes | 403 Forbidden | [x] PASS |
| 17 | Siswa blocked from teacher write routes | 403 Forbidden | [x] PASS |
| 18 | Siswa revisi tugas | Status→revised, old grade deleted | [x] PASS |
| 19 | Assignment shows grade after grading | my_submission.grade.score + feedback | [x] PASS |
| 20 | XP: early submission bonus | +20 XP | [x] PASS |
| 21 | XP: assignment completion | +50 XP (total 70 after grade) | [x] PASS |

### E2E Flow (Verified 2026-07-19)
```
1. Siswa login → XP=0
2. Submit tugas ID=1 → status=pending, XP=20 (early bonus)
3. Guru login → grades submission: score=88, feedback="Bagus!"
4. Siswa check → status=graded, score=88, XP=70 (+50 assignment XP)
5. Siswa revisi → status=revised, old grade deleted, XP=70 unchanged
6. Guru re-grades → status=graded again
```

---

## Reset Database

Jika ingin reset semua data ke awal:

```bash
cd backend
php artisan migrate:fresh --seed
```

Ini akan:
- Drop semua tabel
- Migrate ulang 27 tabel
- Seed: 3 users, 6 materials, 4 assignments, 6 quests, 3 badges
