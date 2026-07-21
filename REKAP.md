# REKAP PERUBAHAN — 21 Juli 2026 (FINAL)

## Ringkasan Eksekutif

Hari ini mencakup **5 fases utama** perubahan dari implementasi fitur hingga hardening final proposal tesis:

1. **Quick Quiz Liga** — implementasi penuh backend + frontend + 11 unit tests
2. **Revisi Proposal Tesis** — rewrite total gamification.md untuk fokus SMP kelas VII
3. **Rename NPC "relationship" → "MAS"** — konsistensi terminologi di seluruh codebase
4. **Hardening Rounds 1–4** — penguatan proposal (nasional urgency, claim limitation, BDD executable spec, adaptivitas theory, XP vs MAS, ruang lingkup klaim, kontribusi direplikasi)
5. **Patch Final** — Kriteria Keberhasilan terukur, Pemetaan Kurikulum Merdeka, Arsitektur Data Penelitian, Gamified Retrieval Quiz, paragraf penutup BAB 3

**Total file diubah:** ~40+ file
**Total tests:** 11/11 passing (49 assertions)
**gamification.md:** ~1,100 baris (ACC kolokium level)

---

## FASE 1: Quick Quiz Liga (Awal Sesi)

### Backend (10 file)
| File | Perubahan |
|------|-----------|
| `migrations/..._create_league_quiz_sessions_table.php` | Tabel sesi quiz (class/guild mode) |
| `migrations/..._create_league_quiz_questions_table.php` | Tabel soal per sesi |
| `migrations/..._create_league_quiz_participants_table.php` | Tabel peserta + hasil |
| `app/Models/LeagueQuizSession.php` | Model sesi quiz |
| `app/Models/LeagueQuizQuestion.php` | Model soal quiz |
| `app/Models/LeagueQuizParticipant.php` | Model peserta quiz |
| `app/Services/Gamification/LeagueQuizService.php` | Service: CRUD, join, submit, results, ranking |
| `app/Http/Controllers/Api/LeagueQuizController.php` | 6 endpoints |
| `routes/api.php` | Route `/api/quick-quiz/` |
| `database/seeders/QuickQuizSeeder.php` | 2 sesi + 4 peserta |

### Frontend (7 file)
| File | Perubahan |
|------|-----------|
| `types/index.ts` | Type: QuickQuizSession, QuickQuizQuestion, QuickQuizParticipant |
| `services/api.ts` | API: `quickQuizApi` (6 methods) |
| `components/quick-quiz/QuickQuizCard.tsx` | Komponen kartu sesi quiz |
| `components/quick-quiz/QuickQuizSession.tsx` | Quiz aktif + timer countdown |
| `components/quick-quiz/QuickQuizResults.tsx` | Hasil + ranking |
| `components/quick-quiz/CreateQuizModal.tsx` | Modal buat quiz (class/guild toggle) |
| `app/quick-quiz/page.tsx` | Halaman utama quick quiz |

### Tests (4 file baru)
| File | Detail |
|------|--------|
| `tests/Unit/LeagueQuizServiceTest.php` | **11 test, 49 assertions, 6.81s — ALL PASSING** |
| `tests/TestCase.php` | Base test class |
| `tests/CreatesApplication.php` | Trait |
| `database/factories/UserFactory.php` | User factory |

---

## FASE 2: Revisi Proposal Tesis (Sesi Tengah)

### gamification.md — REWRITE TOTAL
| Bagian | Sebelum | Sesudah |
|--------|---------|---------|
| Judul | "BATTLE QUIZ PvP, GUILD, PET, DAN QUEST NPC" | "ADAPTIF UNTUK SISWA SMP KELAS VII" |
| Objek | SMA/SMK kelas XII | SMP kelas VII |
| Mata Pelajaran | Pemrograman Web, Basis Data | Informatika, Matematika, Bahasa Indonesia, IPA |
| Fokus | Semua fitur sebagai novelty | 3 novelty: MAS, Guild Reward, Traceability |
| Metodologi | Mixed methods | Quasi-experimental |
| NPC | "Intimacy" / "relationship" | "Mentor Affinity Score (MAS)" |

### BAB 1 — Pendahuluan (REWRITE)
- Latar belakang: fokus SMP kelas VII, fase transisi
- Rumusan masalah: 4 fokus
- 6 data urgensi nasional (PISA, AN, IPD, BPS, etc.)

### BAB 3 — Metodologi (REWRITE)
- Quasi-experimental one-group pretest-posttest
- Hypotheses: H0-1/H1-1, H0-2/H1-2, H0-3/H1-3 (α=0.05)
- Threats to validity: internal, eksternal, konstruk, reliabilitas

### SMA/SMK → SMP di 12+ file
- Frontend meta, dashboard, admin
- README, PRD, TODO
- Semua research docs
- Thesis bab-1, bab-3

---

## FASE 3: Rename "relationship" → "affinity" (Sesi Akhir)

- 12+ file, ~90 occurrences
- Database: `user_npc_affinity`, `affinity_level`, `affinity_xp`
- Model: `UserNpcAffinity.php`
- Service: `NpcService.php` rewrite
- Frontend: types, API, pages, components

---

## FASE 4: Hardening Rounds 1–4 (Sesi Malam)

### Round 1: Landasan Teori Adaptivitas
- Section 7.1: Rule-based adaptive mechanism (bukan ML)
- Tabel karakteristik: input condition, rule definition, output action, deterministic, interpretable
- 4 keunggulan: transparansi, kontrol, replikasi, skalabilitas
- 4 referensi teori: [27] Brusilovsky, [28] Sampson, [29] Peter & Kinshuk, [30] Hamari

### Round 2: XP vs MAS + Claim Limitation
- Section 1.5: Tabel perbandingan XP vs MAS (5 aspek)
- Narasi: MAS = profil personalisasi, bukan sekadar poin
- Pernyataan keterbatasan klaim: evaluasi sistem keseluruhan, bukan isolasi komponen

### Round 3: BDD Executable Specification + National Urgency
- Section 3.4: BDD sebagai Executable Specification (dokumentasi + spesifikasi + test case)
- Section 1.1: 6 data urgensi nasional (PISA 2022, AN 2023, IPD 2024, BPS 2023)

### Round 4: Ruang Lingkup Klaim + Kontribusi Direplikasi
- Section 15: 3 tier klaim (dites langsung, konseptual, penelitian lanjutan)
- Section 5: Diagram kontribusi yang dapat direplikasi (RE → US → AC → BDD → Rule-based engine → MAS & Guild → Reusable model)
- Daftar Pustaka: 4 referensi tambahan [27]–[30]

---

## FASE 5: Patch Final (Penutup Celah Tingkat Akhir)

### Patch 1: Kriteria Keberhasilan Sistem (### 12)
Tabel 5 indikator terukur:

| Aspek | Indikator | Target |
|-------|-----------|--------|
| Usability | SUS | ≥ 70 |
| User Experience | UEQ Attractiveness | ≥ 0.8 |
| Engagement | Quest Completion Rate | ≥ 70% |
| Retensi | 14-day Streak Retention | ≥ 50% siswa |
| Kualitas RPL | BDD Pass Rate | ≥ 90% |

### Patch 2: Pemetaan Quest terhadap Kurikulum Merdeka (### 13)
Tabel 4 mata pelajaran:

| Mata Pelajaran | CP | TP | Quest | Bukti |
|---------------|-----|-----|-------|-------|
| Informatika | Sistem bilangan | Konversi biner/hex | Quest "Konversi Bilangan" | Skor quiz, attempts |
| Matematika | Bangun datar | Hitung luas/keliling | Quest "Bangun Datar" | Quiz adaptif 3 level |
| Bahasa Indonesia | Teks deskriptif | Identifikasi struktur | Quest "Analisis Teks" | Reading duration, comprehension |
| IPA | Siklus air | Jelaskan proses | Quest "Siklus Air" | Quiz post-sim, guild discussion |

Catatan penting: Quest ≠ Game, NPC ≠ Cheat, keterkaitan langsung ke CP/TP, asesmen autentik.

### Patch 3: Arsitektur Pengumpulan Data Penelitian (### 14)
Diagram flow:
```
User Action → Event Logger → Analytics DB → Engagement Metrics Engine → Research Dataset Export
```
7 event types: login, daily_checkin, quest_completion, reading_duration, quiz_participation, guild_contribution, mas_change

### Patch 4: Gamified Retrieval Quiz (global rename)
- 9 occurrences: "Adaptive Challenge Quiz" → "Gamified Retrieval Quiz"
- Landasan teori: Retrieval Practice (Roediger & Butler 2011)
- Prinsip: testing effect — retrieval practice > re-reading

### Patch 5: Paragraf Penutup BAB 3 (### 22)
Closing paragraph: RE + US + AC + BDD + event analytics + usability/engagement evaluation = model RPL yang direplikasi.

---

## Verifikasi Akhir

| Item | Status |
|------|--------|
| `migrate:fresh --seed` | ✅ Semua seeder jalan |
| Unit tests | ✅ 11/11 passing (49 assertions, 6.81s) |
| Zero `UserNpcRelationship` references | ✅ |
| Zero `relationship_level`/`relationship_xp` in code | ✅ |
| Zero `fragment_type` in code | ✅ |
| Zero `SMA/SMK` in frontend | ✅ |
| Zero `Adaptive Challenge Quiz` in codebase | ✅ |
| Gamification.md konsisten SMP kelas VII | ✅ |
| Section numbering sequential (### 1–22) | ✅ |
| 4 novel contributions documented | ✅ |
| 3 tier claim scoping | ✅ |
| 5 Kriteria Keberhasilan terukur | ✅ |

---

## Statistik

| Metrik | Jumlah |
|--------|--------|
| File backend diubah | ~25 |
| File frontend diubah | ~15 |
| File research diubah | ~15 |
| Unit tests | 11 (49 assertions) |
| BDD scenarios | 63 |
| Functional requirements | 63 |
| User stories | 63 |
| Acceptance criteria | 63 |
| Traceability matrix rows | 63 |
| Playwright E2E scenarios | 17 |
| References (Daftar Pustaka) | 30 |
| gamification.md sections | 22 (### 1–22) |
