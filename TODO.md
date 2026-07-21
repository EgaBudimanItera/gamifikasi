# TODO — EduQuest Progress & Next Steps

## STATUS SAAT INI (21 Juli 2026) — FINAL (FITUR STOP)

---

## ✅ YANG SUDAH SELESAI

### Backend (Implemented & Tested)
- [x] Database migration & seed (24 users, ~60 FR worth of data)
- [x] Backend: Laravel 10 structure, models, controllers, services
- [x] Authentication, Master Data, Learning, Gamification, Engagement modules
- [x] NPC Mentor Affinity System (NpcService, NpcController, UserNpcAffinity)
- [x] Guild Collaborative Reward (backend logic)
- [x] Quest NPC (FR-57/FR-58) — Backend + Frontend ✅
- [x] Material Reading (FR-59/FR-62) — Backend + Frontend ✅
- [x] Quick Quiz Liga (FR-63/FR-66) — Backend + Frontend + 11 Unit Tests ✅

### Frontend (Implemented)
- [x] Frontend: Next.js 15 structure
- [x] Dashboard, NPC UI, guild UI, quiz UI, analytics
- [x] Quick Quiz components (4 components + page)

### Testing
- [x] PHPUnit infrastructure (phpunit.xml, TestCase, CreatesApplication, UserFactory)
- [x] LeagueQuizServiceTest: 11 tests, 49 assertions — ALL PASSING

### Research Artifacts (Complete)
- [x] Requirement Engineering: User Story, AC, BDD (63 FR/US/AC/BDD)
- [x] Traceability Matrix (63 rows)
- [x] Playwright E2E scenarios (17 scenarios)
- [x] SIMULASI.md (11 simulation scenarios)

### Thesis / Proposal (Hardened)
- [x] gamification.md — ACC kolokium level (22 sections, ~1,100 baris)
- [x] bab-1-pendahuluan.md — SMP kelas VII, 4 research questions, national urgency
- [x] bab-3-metodologi.md — quasi-experimental, hypotheses, threats to validity
- [x] Daftar Pustaka — 30 references
- [x] Engagement Questionnaire — 5 dimensions, 25 items

### Naming & Cleanup
- [x] NPC "relationship" → "MAS" (12+ files, ~90 occurrences)
- [x] `fragment_type` removed (crafting remnant)
- [x] SMA/SMK → SMP kelas VII (12+ files)
- [x] "Adaptive Challenge Quiz" → "Gamified Retrieval Quiz" (9 occurrences)
- [x] Crafting FRs removed, Quick Quiz Liga FRs added

### Documentation
- [x] REKAP.md — Full day recap (updated)
- [x] Architecture doc updated (NPC/Guild engines, table names)
- [x] SUS/UEQ/Engagement instruments — updated

---

## ❌ YANG BELUM (DEFERRED — Bukan Fokus Utama)

Feature berikut **sengaja ditunda** karena bukan novelty inti dan sudah dinyatakan dalam gamification.md sebagai supporting/future requirements:

| Feature | FR | Alasan Ditunda |
|---------|-----|----------------|
| **Battle Quiz PvP** | FR-41 s/d FR-50 | Supporting requirement, bukan novelty |
| **Pet System** | FR-54 s/d FR-56 | Supporting requirement, bukan novelty |
| **Crafting System** | — | Dihapus dari scope, diganti Quick Quiz Liga |
| **Guild benefits detail** | — | Guild chest, bonus XP, reward mingguan |
| **Analytics Dashboard guru** | FR-57–FR-59 | Future requirement |

---

## 🔄 YANG PERLU DILANJUTKAN (Non-Feature)

Item-item berikut bukan fitur baru, melainkan penyelesaian infrastruktur dan validasi yang sudah ada:

### Prioritas Tinggi (untuk kolokium/evaluasi)
- [ ] **Validasi instrumen SUS/UEQ/Engagement oleh ahli** — expert judgment 2–3 ahli
- [ ] **Pilot testing** — deploy ke server, akses dari browser siswa
- [ ] **Pre-test/post-test** — jalankan instrumen ke 30–40 siswa SMP

### Prioritas Menengah (kualitas kode)
- [ ] **Unit tests** untuk fitur lain (NPC, Guild, Reading, Quest) — current: hanya Quick Quiz
- [ ] **E2E tests** (Playwright) untuk happy path — scenarios sudah ditulis, perlu dieksekusi
- [ ] **API documentation** (Postman collection / OpenAPI spec)
- [ ] **Docker setup** (Dockerfile, docker-compose.yml) — untuk deployment di sekolah

### Prioritas Rendah (nice-to-have)
- [ ] **BDD Playwright execution** — scenarios sudah 17, perlu dijalankan di CI/CD
- [ ] **Regression testing pipeline** — GitHub Actions setup
- [ ] **BAB 2 Tinjauan Pustaka** — belum ditulis (jika diperlukan)

---

## Catatan Penting

1. **FITUR SUDAH STOP.** Tidak ada penambahan fitur baru.
2. **3 Novelty sudah solid:** NPC Mentor Affinity (MAS), Guild Collaborative Reward, Traceability RE–BDD.
3. **Backend works:** `php artisan migrate:fresh --seed` ✅
4. **Unit tests pass:** 11/11 (49 assertions, 6.81s) ✅
5. **thesis/gamification.md level:** ACC kolokium with minor revisions ✅
6. **Research docs complete:** FR/US/AC/BDD/traceability matrix 63 rows ✅

---

## Struktur File Research

```
research/
├── requirements/
│   ├── functional-requirements.md  (63 FR)
│   └── acceptance-criteria.md      (63 AC)
├── user-stories/
│   └── user-stories.md             (63 US)
├── bdd/
│   └── bdd-scenarios.md            (63 BDD)
├── traceability-matrix.csv         (63 rows)
├── instruments/
│   ├── sus-questionnaire.md
│   ├── ueq-questionnaire.md
│   └── engagement-questionnaire.md
├── analysis/
│   └── statistical-analysis.md
└── thesis/
    ├── bab-1-pendahuluan.md
    ├── bab-2-tinjauan-pustaka.md
    ├── bab-3-metodologi.md
    ├── daftar-pustaka.md
    └── gamification.md
```

---

## Ide Fitur (ARCHIVED — Tidak Dikerjakan)

<details>
<summary>Klik untuk expand ide fitur yang sudah diarsipkan</summary>

### Crafting System — DIHAPUS
Dihapus dari scope, diganti Quick Quiz Liga.

### Pet System — DITUNDA
Hewan peliharaan virtual yang tumbuh mengikuti progres belajar. FR-54/FR-56 sudah ditulis.

### Battle Quiz PvP — DITUNDA
Mode kompetisi real-time antar siswa. FR-41/FR-50 sudah ditulis.

</details>
