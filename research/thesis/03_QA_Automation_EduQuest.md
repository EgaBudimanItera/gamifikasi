# USULAN PENELITIAN TESIS

## FRAMEWORK EXECUTABLE REQUIREMENT TRACEABILITY DAN PENGUJIAN OTOMATIS PADA APLIKASI GAMIFIKASI PEMBELAJARAN BERBASIS WEB

---

Diajukan sebagai salah syarat untuk Kolokium
Magister Ilmu Komputer

**[NAMA PENELITI]**
[NPM]

Pembimbing:
Dr. [Nama Pembimbing], M.Kom.

PROGRAM STUDI MAGISTER ILMU KOMPUTER
FAKULTAS TEKNIK DAN ILMU KOMPUTER
UNIVERSITAS TEKNOKRAT INDONESIA
BANDAR LAMPUNG
2026

---

## A. JUDUL

**FRAMEWORK EXECUTABLE REQUIREMENT TRACEABILITY DAN PENGUJIAN OTOMATIS PADA APLIKASI GAMIFIKASI PEMBELAJARAN BERBASIS WEB**

---

## B. RINGKASAN

Pengujian perangkat lunak merupakan komponen kritis dalam memastikan kualitas sistem enterprise. Namun, banyak organisasi masih menghadapi tantangan dalam menjaga keterlacakan (traceability) antara requirement, test case, dan hasil pengujian. Kesenjangan ini menyebabkan regression testing yang tidak efektif, defek yang terlambat terdeteksi, dan biaya maintenance yang tinggi. Behavior-Driven Development (BDD) menawarkan pendekatan di mana requirement dinyatakan dalam skenario perilaku yang dapat dieksekusi secara otomatis, namun framework yang mengintegrasikan traceability requirement–BDD–automation dalam satu ekosistem masih belum banyak diusung dalam penelitian terapan.

Penelitian ini bertujuan mengembangkan **Executable Requirement Validation Framework (ERVF)** — framework yang mengintegrasikan requirement traceability, automated BDD testing menggunakan Playwright, CI/CD pipeline execution, dan test reporting pada aplikasi gamifikasi pembelajaran berbasis web (EduQuest). Framework ini dirancang untuk memastikan setiap functional requirement memiliki path traceable ke BDD scenario dan test case yang dapat dieksekusi secara otomatis.

Kontribusi utama penelitian ini adalah ERVF — framework yang membuktikan bahwa requirement traceability dapat dijalankan (executable), bukan hanya didokumentasikan. Framework ini diimplementasikan dan dievaluasi pada aplikasi gamifikasi pendidikan dengan 60+ functional requirements yang mencakup modul authentication, gamification engine, NPC mentor, guild, quiz, dan analytics. Evaluasi dilakukan melalui metrik coverage, pass rate, defect detection rate, dan efektivitas regression testing.

---

## C. PENDAHULUAN

### 1. Latar Belakang

Pengujian perangkat lunak modern menghadapi paradoks yang menarik: di satu sisi, organisasi semakin bergantung pada perangkat lunak untuk operasi bisnis; di sisi lain, kualitas pengujian sering kali tidak seimbang dengan kompleksitas sistem yang dikembangkan. Menurut Standish Group CHAOS Report, hanya 31% proyek perangkat lunak yang berhasil sesuai rencana, sementara 52% mengalami delay, cost overrun, atau delivery dengan fitur yang berkurang.

Permasalahan utama dalam pengujian perangkat lunak enterprise meliputi:

1. **Requirement Traceability Gap.** Banyak tim pengembang memiliki requirement documents dan test cases yang terpisah tanpa keterlacakan otomatis. Akibatnya, sulit memastikan apakah semua requirement telah diuji atau apakah test case yang ada masih relevan dengan requirement terkini.

2. **Regression Testing Burden.** Perubahan kode yang sering (continuous delivery) membutuhkan regression testing yang komprehensif. Tanpa otomatisasi yang terstruktur, regression testing menjadi bottleneck yang memperlambat siklus rilis.

3. **Manual Test Documentation.** Penulisan test case manual membutuhkan waktu besar dan sering kali tidak terkini. Perubahan requirement mengharuskan update test case secara manual, yang rentan terhadap human error.

4. **Defect–Requirement Mapping.** Saat ditemukan defek, sulit menelusuri kembali requirement mana yang terdampak dan test case mana yang seharusnya mendeteksi defek tersebut lebih awal.

Behavior-Driven Development (BDD) menggunakan format Gherkin (Given–When–Then) untuk menulis skenario perilaku dalam bahasa alami yang dapat dieksekusi secara otomatis. Pendekatan ini menjembatani kesenjangan antara stakeholder bisnis dan tim teknis. Namun, BDD dalam praktiknya masih banyak digunakan sebagai pendekatan pengujian semata, tanpa integrasi penuh ke dalam ekosistem requirement traceability.

Penelitian ini mengusulkan **Executable Requirement Validation Framework (ERVF)** yang mengintegrasikan:
- Requirement specification dengan traceability matrix.
- BDD scenario writing dalam format Gherkin.
- Automated test execution menggunakan Playwright.
- CI/CD pipeline integration untuk execution otomatis.
- Test reporting dan coverage dashboard.
- Failed requirement mapping untuk defect analysis.

### 2. Rumusan Masalah

1. Bagaimana merancang framework requirement traceability yang menghubungkan functional requirement, user story, acceptance criteria, BDD scenarios, dan automated test cases dalam satu ekosistem yang terintegrasi?
2. Bagaimana mengimplementasikan automated BDD testing menggunakan Playwright yang efektif untuk aplikasi web gamifikasi dengan kompleksitas bisnis rules tinggi?
3. Bagaimana mengukur efektivitas framework terhadap kualitas pengujian melalui metrik coverage, pass rate, defect detection, dan regression testing effectiveness?

### 3. Tujuan Penelitian

1. Merancang ERVF — framework executable requirement traceability yang terintegrasi.
2. Mengimplementasikan automated BDD testing menggunakan Playwright untuk aplikasi web gamifikasi.
3. Membangun CI/CD testing pipeline yang menjalankan BDD scenarios secara otomatis.
4. Mengembangkan test reporting dashboard dengan requirement coverage visualization.
5. Mengevaluasi efektivitas framework melalui metrik otomatisasi dan kualitas pengujian.

### 4. Manfaat Penelitian

#### 4.1 Manfaat Akademik
- Memberikan kontribusi dalam bidang automated testing dan requirement traceability.
- Menghasilkan framework yang dapat direplikasi pada proyek perangkat lunak lain.
- Menjadi referensi bagi peneliti yang mengkaji integrasi BDD dengan requirement engineering.

#### 4.2 Manfaat Praktis
- Menyediakan framework yang mengurangi biaya regression testing.
- Membantu tim pengembang dalam menjaga kualitas perangkat lunak secara berkelanjutan.
- Memberikan dashboard coverage yang memudahkan manajemen kualitas.

---

## D. TINJAUAN PUSTAKA

### 1. Behavior-Driven Development (BDD)

BDD adalah pendekatan pengembangan perangkat lunak yang menggabungkan praktik TDD (Test-Driven Development) dengan desain berbasis domain. BDD menggunakan skenario dalam bahasa alami yang mengikuti format **Given–When–Then**:

```gherkin
Feature: NPC Affinity Progression
  Scenario: Affinity meningkat setelah quest selesai
    Given siswa memiliki MAS 10
    When siswa menyelesaikan quest Informatika
    Then MAS bertambah 5 poin
    And level affinity diperbarui
```

Nascimento et al. (2020) menunjukkan bahwa BDD meningkatkan kolaborasi tim dan kualitas requirement [1]. García et al. (2023) melalui systematic mapping study memvalidasi efektivitas BDD dari 166 papers [2]. Sommerville (2016) menjelaskan bahwa requirement engineering membutuhkan mekanisme validasi yang kuat untuk memastikan kebutuhan terpenuhi [3].

### 2. Executable Specification

Executable Specification adalah konsep di mana spesifikasi perilaku sistem tidak hanya didokumentasikan, tetapi juga dapat dieksekusi secara otomatis. Dalam konteks BDD, setiap skenario Gherkin berfungsi sebagai:
1. **Dokumentasi** — semua pemangku kepentingan dapat membaca.
2. **Spesifikasi** — acuan formal perilaku sistem.
3. **Test case** — dapat dieksekusi oleh automation framework.

Konsep ini memungkinkan keterlacakan (traceability) dari requirement ke executable test case, yang merupakan fondasi ERVF.

### 3. Playwright

Playwright adalah browser automation framework yang dikembangkan oleh Microsoft. Fitur utama:
- **Cross-browser testing** — Chromium, Firefox, WebKit.
- **Auto-waiting** — otomatis menunggu elemen sebelum interaksi.
- **Network interception** — mock dan intercept API requests.
- **Codegen** — automatic test code generation dari rekaman interaksi.
- **Trace Viewer** — visual debugging untuk test failures.
- **API testing** — built-in support untuk REST API testing.
- **Visual comparison** — screenshot comparison untuk UI regression.

Playwright dipilih dalam penelitian ini karena kemampuannya menguji aplikasi fullstack (frontend + API) dalam satu test run, yang sesuai dengan arsitektur EduQuest (Laravel backend + Next.js frontend).

### 4. Regression Testing

Regression testing adalah proses pengujian ulang untuk memastikan perubahan kode (bug fix, fitur baru) tidak mengganggu fungsi yang sudah ada. Tantangan regression testing:
- **Test suite growth** — semakin banyak fitur, semakin banyak test case.
- **Execution time** — regression test suite yang besar membutuhkan waktu lama.
- **Flaky tests** — test yang kadang pass kadang fail tanpa perubahan kode.
- **Maintenance cost** — update test suite saat requirement berubah.

### 5. Requirement Traceability

Requirement traceability adalah kemampuan untuk menelusuri requirement dari asal hingga implementasi dan pengujian. Menurut IEEE 830, traceability mencakup:
- **Forward traceability** — requirement → design → code → test.
- **Backward traceability** — test → code → design → requirement.
- **Bidirectional traceability** — kombinasi forward dan backward.

ERVF mengimplementasikan bidirectional traceability melalui traceability matrix yang terintegrasi dengan executable BDD scenarios.

### 6. CI/CD Testing Pipeline

Continuous Integration/Continuous Deployment (CI/CD) pipeline mengotomasikan siklus build, test, dan deploy. Dalam konteks pengujian:
- **Continuous Testing** — test dijalankan setiap commit/PR.
- **Parallel Execution** — test dijalankan paralel untuk mempercepat.
- **Test Reporting** — hasil test dilaporkan secara otomatis.
- **Quality Gate** — rilis hanya dilakukan jika semua test pass.

---

## E. EXECUTABLE REQUIREMENT VALIDATION FRAMEWORK (ERVF)

### 1. Arsitektur Framework

```
┌─────────────────────────────────────────────────────────────────┐
│                    REQUIREMENT LAYER                             │
│  Functional Requirements (FR)                                   │
│    ├── User Story (US)                                          │
│    └── Acceptance Criteria (AC)                                 │
└──────────────────────┬──────────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────────┐
│                   SPECIFICATION LAYER                            │
│  Gherkin Feature Files (.feature)                               │
│    ├── Scenario Definitions                                     │
│    ├── Step Definitions (Given/When/Then)                       │
│    └── Data Tables & Scenario Outlines                          │
└──────────────────────┬──────────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────────┐
│                   AUTOMATION LAYER                               │
│  Playwright Test Scripts (.spec.ts)                             │
│    ├── Page Object Models                                      │
│    ├── Step Implementations                                     │
│    ├── API Helpers                                              │
│    └── Test Data Management                                     │
└──────────────────────┬──────────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────────┐
│                   EXECUTION LAYER                                │
│  CI/CD Pipeline (GitHub Actions)                                │
│    ├── Build Stage                                              │
│    ├── Test Stage (parallel)                                    │
│    │   ├── Unit Tests (PHPUnit)                                 │
│    │   ├── BDD Tests (Playwright)                               │
│    │   └── API Tests (Playwright)                               │
│    ├── Report Stage                                             │
│    └── Deploy Stage (conditional on pass)                       │
└──────────────────────┬──────────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────────┐
│                   REPORTING LAYER                                │
│  Test Report Dashboard                                          │
│    ├── Requirement Coverage Map                                 │
│    ├── Pass/Fail Statistics                                     │
│    ├── Defect–Requirement Mapping                               │
│    ├── Flaky Test Detection                                     │
│    └── Historical Trend Analysis                                │
└─────────────────────────────────────────────────────────────────┘
```

### 2. Traceability Matrix

ERVF menggunakan traceability matrix yang menghubungkan lima level keterlacakan:

| Level | Deskripsi | Artefak |
|-------|-----------|---------|
| L1 | Functional Requirement | FR-XX (dokumen requirements) |
| L2 | User Story | US-XX (format: "Sebagai [role], saya ingin [action] sehingga [benefit]") |
| L3 | Acceptance Criteria | AC-XX (kondisi terukur yang harus terpenuhi) |
| L4 | BDD Scenario |.feature file (Gherkin syntax) |
| L5 | Automated Test | .spec.ts file (Playwright implementation) |

#### 2.1 Contoh Traceability

| FR | User Story | AC | BDD Feature | Test File | Status |
|----|-----------|-----|-------------|-----------|--------|
| FR-21 (XP calculation) | US-15: Siswa mendapat XP setelah quest | AC-15: XP bertambah sesuai difficulty | xp_calculation.feature | xp.spec.ts | Automated |
| FR-35 (NPC encounter) | US-21: Siswa berinteraksi dengan NPC | AC-21: NPC dialogue ditampilkan | npc_interaction.feature | npc.spec.ts | Automated |
| FR-41 (Guild creation) | US-30: Siswa membuat guild | AC-30: Guild terdaftar di sistem | guild_management.feature | guild.spec.ts | Automated |
| FR-47 (Quiz attempt) | US-35: Siswa mengerjakan quiz | AC-35: Skor quiz tercatat | quiz_attempt.feature | quiz.spec.ts | Automated |
| FR-11 (Material reading) | US-10: Siswa membaca materi | AC-10: Durasi baca tercatat | material_reading.feature | material.spec.ts | Automated |

#### 2.2 Traceability Completeness Metric

```
Traceability Completeness = (FR with complete trace path) / (Total FR) × 100%

Target: 100% — semua FR memiliki path ke automated test case.
```

### 3. BDD Scenario Structure

#### 3.1 Feature File Organization

```
tests/bdd/features/
├── authentication/
│   ├── login.feature
│   ├── register.feature
│   └── password_reset.feature
├── gamification/
│   ├── xp_calculation.feature
│   ├── level_progression.feature
│   ├── badge_earned.feature
│   └── streak_tracking.feature
├── npc/
│   ├── npc_interaction.feature
│   ├── affinity_progression.feature
│   └── adaptive_quest.feature
├── guild/
│   ├── guild_management.feature
│   ├── guild_xp_contribution.feature
│   └── guild_reward_distribution.feature
├── quest/
│   ├── quest_available.feature
│   ├── quest_completion.feature
│   └── quest_difficulty.feature
├── quiz/
│   ├── quiz_attempt.feature
│   ├── quiz_leaderboard.feature
│   └── retrieval_quiz.feature
├── material/
│   ├── material_reading.feature
│   └── reading_quiz_trigger.feature
└── analytics/
    ├── activity_logging.feature
    └── dashboard_metrics.feature
```

#### 3.2 Contoh Gherkin Scenarios

**Feature: XP Calculation**
```gherkin
Feature: XP Calculation System
  As a student
  I want to earn XP for completing learning activities
  So that I can progress through levels

  Background:
    Given siswa "Budi" terdaftar dengan role "siswa"
    And siswa memiliki XP 0 dan level 1

  Scenario: XP ditambahkan saat quest selesai
    Given quest "Konversi Bilangan" tersedia dengan difficulty "medium"
    When siswa menyelesaikan quest dengan skor 85
    Then XP siswa bertambah 100
    And total XP siswa menjadi 100

  Scenario: XP bonus untuk streak harian
    Given siswa memiliki streak 5 hari
    When siswa menyelesaikan quest dengan skor 80
    Then XP siswa bertambah 100
    And streak bonus ditambahkan 50
    And total XP siswa menjadi 150

  Scenario Outline: XP bervariasi berdasarkan difficulty
    Given quest dengan difficulty "<difficulty>"
    When siswa menyelesaikan quest dengan skor 80
    Then XP siswa bertambah <xp_amount>

    Examples:
      | difficulty | xp_amount |
      | easy       | 50        |
      | medium     | 100       |
      | hard       | 200       |
      | legendary  | 500       |
```

**Feature: NPC Affinity Progression**
```gherkin
Feature: NPC Affinity Progression
  As a student
  I want my relationship with NPC mentors to grow
  So that I receive more challenging and rewarding quests

  Background:
    Given siswa "Budi" terdaftar
    And NPC "Bu Rina" adalah mentor Informatika
    And affinity siswa dengan Bu Rina adalah 10

  Scenario: Affinity meningkat setelah quest selesai
    When siswa menyelesaikan quest dari Bu Rina
    Then affinity siswa dengan Bu Rina bertambah
    And affinity level diperbarui

  Scenario: Quest harder muncul di affinity tinggi
    Given affinity siswa dengan Bu Rina adalah 20
    When siswa melihat quest dari Bu Rina
    Then quest difficulty maksimal adalah "hard"
    And reward multiplier adalah 1.5

  Scenario: Quest easy di affinity rendah
    Given affinity siswa dengan Bu Rina adalah 3
    When siswa melihat quest dari Bu Rina
    Then quest difficulty maksimal adalah "easy"
    And reward multiplier adalah 1.0
```

**Feature: Guild Collaborative Reward**
```gherkin
Feature: Guild Collaborative Reward
  As a guild member
  I want my contributions to count toward guild progress
  So that the whole guild benefits

  Background:
    Given guild "Tim Coding" terdaftar dengan 4 anggota
    And guild memiliki weekly target 50 quest
    Dan guild weekly progress adalah 45

  Scenario: Guild reward saat target tercapai
    Given anggota guild menyelesaikan 5 quest lagi
    When weekly progress mencapai 50
    Then seluruh anggota menerima +150 XP
    And guild chest dibuka
    And 10% XP bonus diberikan selama 24 jam

  Scenario: Guild reward tidak diberikan jika target belum tercapai
    Given anggota guild menyelesaikan 3 quest lagi
    When weekly progress adalah 48
    Then guild reward belum diberikan
    And progress ditampilkan ke semua anggota
```

### 4. Playwright Test Implementation

#### 4.1 Test Architecture

```
tests/e2e/
├── fixtures/
│   ├── auth.fixture.ts        # Authentication helpers
│   ├── db.fixture.ts          # Database seed/reset
│   └── api.fixture.ts         # API request helpers
├── pages/
│   ├── LoginPage.ts
│   ├── DashboardPage.ts
│   ├── QuestPage.ts
│   ├── NpcPage.ts
│   ├── GuildPage.ts
│   ├── QuizPage.ts
│   └── MaterialPage.ts
├── step-definitions/
│   ├── auth.steps.ts
│   ├── gamification.steps.ts
│   ├── npc.steps.ts
│   ├── guild.steps.ts
│   ├── quest.steps.ts
│   ├── quiz.steps.ts
│   └── material.steps.ts
├── utils/
│   ├── test-data.ts
│   ├── api-helpers.ts
│   └── assertions.ts
└── specs/
    ├── bdd/
    │   ├── xp_calculation.spec.ts
    │   ├── npc_affinity.spec.ts
    │   ├── guild_reward.spec.ts
    │   ├── quest_management.spec.ts
    │   ├── quiz_attempt.spec.ts
    │   └── material_reading.spec.ts
    └── api/
        ├── auth.api.spec.ts
        ├── quest.api.spec.ts
        ├── npc.api.spec.ts
        └── guild.api.spec.ts
```

#### 4.2 Page Object Model

```typescript
// pages/NpcPage.ts
export class NpcPage {
  constructor(private page: Page) {}

  async navigateToMentor(mentorId: number) {
    await this.page.goto(`/npc/${mentorId}`);
    await this.page.waitForSelector('[data-testid="npc-profile"]');
  }

  async getAffinityLevel(): Promise<number> {
    const levelText = await this.page.textContent('[data-testid="affinity-level"]');
    return parseInt(levelText?.replace('Level ', '') || '1');
  }

  async getAffinityXp(): Promise<number> {
    const xpText = await this.page.textContent('[data-testid="affinity-xp"]');
    return parseFloat(xpText?.replace(' XP', '') || '0');
  }

  async startQuest(questId: number) {
    await this.page.click(`[data-testid="quest-${questId}"]`);
    await this.page.click('[data-testid="start-quest-btn"]');
  }

  async completeQuest(score: number) {
    await this.page.fill('[data-testid="quiz-answer"]', String(score));
    await this.page.click('[data-testid="submit-quest-btn"]');
    await this.page.waitForSelector('[data-testid="quest-result"]');
  }

  async getDialogue(): Promise<string> {
    return await this.page.textContent('[data-testid="npc-dialogue"]') || '';
  }
}
```

#### 4.3 Step Definitions

```typescript
// step-definitions/npc.steps.ts
import { Given, When, Then } from '@cucumber/cucumber';
import { expect } from '@playwright/test';

Given('affinity siswa dengan Bu Rina adalah {int}', async function(xp: number) {
  await this.apiHelpers.setAffinity(this.studentId, 'Bu Rina', xp);
});

When('siswa menyelesaikan quest dari Bu Rina', async function() {
  await this.npcPage.startQuest(this.questId);
  await this.npcPage.completeQuest(85);
});

Then('affinity siswa dengan Bu Rina bertambah', async function() {
  const newXp = await this.npcPage.getAffinityXp();
  expect(newXp).toBeGreaterThan(this.initialXp);
});

Then('affinity level diperbarui', async function() {
  const newLevel = await this.npcPage.getAffinityLevel();
  expect(newLevel).toBeGreaterThanOrEqual(this.initialLevel);
});
```

#### 4.4 API Test Helper

```typescript
// utils/api-helpers.ts
export class ApiHelpers {
  constructor(private request: APIRequestContext) {}

  async login(email: string, password: string): Promise<string> {
    const response = await this.request.post('/api/v1/auth/login', {
      data: { email, password }
    });
    const body = await response.json();
    return body.data.token;
  }

  async setAffinity(userId: number, npcName: string, xp: number) {
    await this.request.post('/api/v1/admin/affinity/set', {
      headers: { Authorization: `Bearer ${this.adminToken}` },
      data: { user_id: userId, npc_name: npcName, affinity_xp: xp }
    });
  }

  async completeQuest(userId: number, questId: number, score: number) {
    return await this.request.post(`/api/v1/quest/${questId}/complete`, {
      headers: { Authorization: `Bearer ${this.userToken}` },
      data: { score, duration_seconds: 120 }
    });
  }
}
```

### 5. CI/CD Testing Pipeline

#### 5.1 GitHub Actions Workflow

```yaml
# .github/workflows/test.yml
name: Test Pipeline

on:
  push:
    branches: [main, develop]
  pull_request:
    branches: [main]

jobs:
  unit-tests:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.3'
      - name: Install Dependencies
        run: composer install
      - name: Run PHPUnit Tests
        run: php artisan test --coverage --min=80
      - name: Upload Coverage
        uses: codecov/codecov-action@v3

  bdd-tests:
    runs-on: ubuntu-latest
    needs: unit-tests
    strategy:
      matrix:
        browser: [chromium, firefox, webkit]
    steps:
      - uses: actions/checkout@v4
      - name: Setup Node.js
        uses: actions/setup-node@v4
        with:
          node-version: '20'
      - name: Install Playwright
        run: npx playwright install --with-deps ${{ matrix.browser }}
      - name: Setup Database
        run: |
          php artisan migrate:fresh --seed
      - name: Run BDD Tests
        run: npx playwright test --project=${{ matrix.browser }}
      - name: Upload Test Report
        if: always()
        uses: actions/upload-artifact@v3
        with:
          name: playwright-report-${{ matrix.browser }}
          path: playwright-report/

  api-tests:
    runs-on: ubuntu-latest
    needs: unit-tests
    steps:
      - uses: actions/checkout@v4
      - name: Setup Node.js
        uses: actions/setup-node@v4
      - name: Run API Tests
        run: npx playwright test --project=api

  report:
    runs-on: ubuntu-latest
    needs: [bdd-tests, api-tests]
    if: always()
    steps:
      - name: Generate Coverage Report
        run: node scripts/generate-coverage.js
      - name: Upload to Dashboard
        run: node scripts/upload-report.js
```

#### 5.2 Pipeline Flow

```
Code Commit / Pull Request
    ↓
┌───────────────────────┐
│  Unit Tests (PHPUnit) │  ← Backend logic testing
│  Target: ≥ 80%        │
└───────────┬───────────┘
            ↓ (pass)
┌───────────────────────┐
│  BDD Tests (Playwright)│  ← Behavior testing (3 browsers)
│  Chromium / FF / WK   │
└───────────┬───────────┘
            ↓ (pass)
┌───────────────────────┐
│  API Tests             │  ← REST API endpoint testing
│  (Playwright)          │
└───────────┬───────────┘
            ↓ (pass)
┌───────────────────────┐
│  Report Generation     │  ← Coverage, traceability, trends
│  + Quality Gate        │
└───────────┬───────────┘
            ↓ (pass)
┌───────────────────────┐
│  Deploy to Staging     │
│  (conditional)         │
└───────────────────────┘
```

### 6. Test Reporting Dashboard

#### 6.1 Metrik yang Dilaporkan

| Metrik | Deskripsi | Target |
|--------|-----------|--------|
| **BDD Pass Rate** | Persentase skenario BDD yang pass | ≥ 90% |
| **Requirement Coverage** | FR yang memiliki automated test / Total FR | 100% |
| **Test Execution Time** | Total waktu eksekusi seluruh test suite | < 10 menit |
| **Defect Detection Rate** | Defek yang terdeteksi oleh automated test / Total defek | ≥ 80% |
| **Flaky Test Rate** | Test yang flaky / Total test | < 5% |
| **Code Coverage** | Baris kode yang di-cover oleh test | ≥ 80% |
| **Regression Detection** | Bug yang terdeteksi sebelum production | 100% |

#### 6.2 Coverage Dashboard Structure

```
Test Coverage Dashboard
├── Overall Summary
│   ├── Total FR: 63
│   ├── FR Automated: 58 (92%)
│   ├── FR Pending: 5 (8%)
│   └── BDD Pass Rate: 94%
├── Per-Module Coverage
│   ├── Authentication: 5/5 (100%) ✓
│   ├── Master Data: 5/5 (100%) ✓
│   ├── Learning: 10/10 (100%) ✓
│   ├── Gamification: 10/10 (100%) ✓
│   ├── Engagement: 4/4 (100%) ✓
│   ├── NPC Mentor: 6/6 (100%) ✓
│   ├── Guild: 6/6 (100%) ✓
│   ├── Quiz: 6/6 (100%) ✓
│   ├── Material: 4/4 (100%) ✓
│   └── Analytics: 2/7 (29%) — partially implemented
├── Failed Requirements
│   ├── FR-57: Analytics export — API timeout
│   └── FR-59: Real-time monitoring — WebSocket issue
├── Historical Trend
│   ├── Week 1: 45% coverage, 78% pass rate
│   ├── Week 2: 68% coverage, 85% pass rate
│   ├── Week 3: 85% coverage, 91% pass rate
│   └── Week 4: 92% coverage, 94% pass rate
└── Flaky Tests
    └── quiz_timer.spec.ts (3 failures in 20 runs)
```

### 7. Failed Requirement Mapping

Ketika test case gagal, ERVF otomatis memetakan kebutuhan mana yang terdampak:

```
Test Failure → BDD Scenario → Acceptance Criteria → User Story → FR

Contoh:
FAILED: npc_affinity.spec.ts > "Affinity meningkat setelah quest"
  → BDD: affinity_progression.feature > Scenario 1
    → AC-21: "Affinity level diperbarui setelah quest completion"
      → US-21: "Siswa melihat affinity level meningkat"
        → FR-35: "NPC affinity calculation"
          → MODULE: NPC Mentor (FR-35 s/d FR-40)
            → IMPACT: Semua fitur quest adaptif terdampak
```

### 8. Defect Analysis Framework

#### 8.1 Defect Classification

| Kategori | Deskripsi | Contoh |
|----------|-----------|--------|
| **Requirement Defect** | Requirement yang ambigu atau tidak lengkap | FR tidak mencakup edge case |
| **Design Defect** | Desain yang tidak memenuhi requirement | API response format salah |
| **Implementation Defect** | Bug dalam kode | XP calculation off-by-one |
| **Environment Defect** | Masalah lingkungan | Database connection timeout |
| **Test Defect** | Test script yang salah | Step definition tidak sesuai Gherkin |

#### 8.2 Defect Traceability

```
Defect ID: DEF-001
├── Detected by: BDD test (npc_affinity.spec.ts)
├── Failed scenario: "Affinity level diperbarui"
├── Related FR: FR-35 (NPC affinity calculation)
├── Related US: US-21
├── Root cause: MAS calculation tidak memperhitungkan streak bonus
├── Fix: Update NpcService::calculateAffinity() method
├── Regression test: Added scenario "Affinity calculation with streak"
└── Status: Fixed, verified by re-run
```

---

## F. IMPLEMENTASI FRAMEWORK

### 1. Setup & Configuration

#### 1.1 Playwright Configuration

```typescript
// playwright.config.ts
import { defineConfig } from '@playwright/test';

export default defineConfig({
  testDir: './tests/e2e/specs',
  timeout: 30000,
  retries: 2,
  workers: process.env.CI ? 4 : 2,
  reporter: [
    ['html', { outputFolder: 'playwright-report' }],
    ['json', { outputFile: 'test-results/results.json' }],
    ['junit', { outputFile: 'test-results/junit.xml' }]
  ],
  use: {
    baseURL: process.env.BASE_URL || 'http://localhost:3000',
    screenshot: 'only-on-failure',
    video: 'retain-on-failure',
    trace: 'on-first-retry',
  },
  projects: [
    { name: 'chromium', use: { browserName: 'chromium' } },
    { name: 'firefox', use: { browserName: 'firefox' } },
    { name: 'webkit', use: { browserName: 'webkit' } },
    { name: 'api', testDir: './tests/e2e/specs/api' },
  ],
});
```

#### 1.2 Test Database Setup

```bash
# scripts/test-setup.sh
#!/bin/bash
php artisan migrate:fresh --seed --env=testing
php artisan db:seed --class=GamificationTestSeeder
php artisan cache:clear
echo "Test database ready."
```

### 2. Test Data Management

#### 2.1 Seed Data Structure

```typescript
// fixtures/test-data.ts
export const testData = {
  students: [
    { name: 'Budi', email: 'budi@test.com', xp: 0, level: 1 },
    { name: 'Sari', email: 'sari@test.com', xp: 150, level: 2 },
    { name: 'Andi', email: 'andi@test.com', xp: 500, level: 4 },
  ],
  npcs: [
    { name: 'Bu Rina', subject: 'Informatika', difficulty: 'medium' },
    { name: 'Pak Ahmad', subject: 'Matematika', difficulty: 'hard' },
  ],
  guilds: [
    { name: 'Tim Coding', members: 4, weeklyTarget: 50, progress: 45 },
    { name: 'Squad Science', members: 3, weeklyTarget: 50, progress: 30 },
  ],
  quests: [
    { title: 'Konversi Bilangan', subject: 'Informatika', difficulty: 'medium', xp: 100 },
    { title: 'Bangun Datar', subject: 'Matematika', difficulty: 'hard', xp: 200 },
  ],
};
```

### 3. Execution Metrics Collection

#### 3.1 Test Result JSON Structure

```json
{
  "timestamp": "2026-07-21T10:30:00Z",
  "totalScenarios": 85,
  "passed": 80,
  "failed": 3,
  "skipped": 2,
  "passRate": "94.1%",
  "executionTime": "8m 32s",
  "requirementCoverage": "92%",
  "modules": [
    {
      "name": "Authentication",
      "totalFR": 5,
      "automatedFR": 5,
      "coverage": "100%",
      "passRate": "100%"
    },
    {
      "name": "NPC Mentor",
      "totalFR": 6,
      "automatedFR": 6,
      "coverage": "100%",
      "passRate": "83%",
      "failedScenarios": ["affinity_level_update"]
    }
  ],
  "flakyTests": [
    {
      "test": "quiz_timer.spec.ts > Quiz timer countdown",
      "flakinessRate": "15%",
      "lastFailure": "2026-07-20",
      "rootCause": "Race condition in timer sync"
    }
  ]
}
```

### 4. Coverage Report Generator

```javascript
// scripts/generate-coverage.js
const results = require('../test-results/results.json');
const traceability = require('../traceability-matrix.json');

function generateCoverageReport() {
  const frCoverage = traceability.map(fr => ({
    frId: fr.id,
    moduleName: fr.module,
    hasUserStory: !!fr.userStory,
    hasAcceptanceCriteria: !!fr.acceptanceCriteria,
    hasBddScenario: !!fr.bddScenario,
    hasAutomatedTest: !!fr.testFile,
    testStatus: fr.testStatus || 'not_run',
    complete: fr.hasUserStory && fr.hasAcceptanceCriteria && fr.hasBddScenario && fr.hasAutomatedTest
  }));

  const totalFR = frCoverage.length;
  const fullyCovered = frCoverage.filter(fr => fr.complete).length;
  const passRate = results.passed / results.totalScenarios * 100;

  return {
    timestamp: new Date().toISOString(),
    totalFR,
    fullyCovered,
    coveragePercentage: (fullyCovered / totalFR * 100).toFixed(1),
    passRate: passRate.toFixed(1),
    modules: aggregateByModule(frCoverage),
    failedRequirements: frCoverage.filter(fr => fr.testStatus === 'failed'),
    pendingRequirements: frCoverage.filter(fr => !fr.hasAutomatedTest)
  };
}
```

---

## G. EVALUASI FRAMEWORK

### 1. Evaluasi Design

Penelitian ini menggunakan **quasi-experimental design** dengan pengukuran pre-post terhadap kualitas pengujian:

#### 1.1 Variabel Penelitian

| Variabel | Deskripsi | Instrumen |
|----------|-----------|-----------|
| **Requirement Coverage** | Persentase FR yang memiliki automated test | Coverage dashboard |
| **BDD Pass Rate** | Persentase skenario BDD yang lulus | Playwright report |
| **Defect Detection Rate** | Persentase defek yang terdeteksi otomatis | Defect log |
| **Regression Effectiveness** | Kemampuan mendeteksi regression | Historical test results |
| **Test Maintenance Cost** | Waktu yang dibutuhkan untuk update test suite | Time tracking |
| **Execution Time** | Total waktu eksekusi test suite | CI/CD pipeline logs |

#### 1.2 Metrik Efektivitas

| Metrik | Formula | Target |
|--------|---------|--------|
| Requirement Traceability Completeness | FR dengan path lengkap / Total FR × 100% | ≥ 95% |
| Automated Test Coverage | Automated test / Total test case × 100% | ≥ 90% |
| BDD Pass Rate | Passed scenarios / Total scenarios × 100% | ≥ 90% |
| Defect Escape Rate | Defect ditemukan di production / Total defect × 100% | < 10% |
| Mean Time to Detection (MTTD) | Rata-rata waktu dari commit ke defect detection | < 5 menit |
| Test Suite Stability | 1 - (flaky tests / total tests) | ≥ 95% |

### 2. Hasil yang Diharapkan

#### 2.1 Coverage Metrics

| Modul | FR Count | Automated | Coverage | Pass Rate |
|-------|----------|-----------|----------|-----------|
| Authentication | 5 | 5 | 100% | 100% |
| Master Data | 5 | 5 | 100% | 100% |
| Learning | 10 | 10 | 100% | 95% |
| Gamification | 10 | 10 | 100% | 92% |
| Engagement | 4 | 4 | 100% | 100% |
| NPC Mentor | 6 | 6 | 100% | 88% |
| Guild | 6 | 6 | 100% | 90% |
| Quiz | 6 | 6 | 100% | 95% |
| Material | 4 | 4 | 100% | 100% |
| Analytics | 7 | 5 | 71% | 80% |
| **Total** | **63** | **61** | **97%** | **94%** |

#### 2.2 Quality Improvements

| Aspek | Sebelum ERVF | Sesudah ERVF | Improvement |
|-------|-------------|--------------|-------------|
| Requirement coverage | 40% (manual) | 97% (automated) | +142% |
| Regression test time | 2 hari (manual) | 8 menit (automated) | -99.4% |
| Defect detection | 60% (manual) | 94% (automated) | +57% |
| Test documentation | Terpisah, tidak terkini | Terintegrasi, otomatis | Qualitative |
| Traceability | Tidak ada | Bidirectional, lengkap | Qualitative |

### 3. Perbandingan dengan Pendekatan Lain

| Aspek | Manual Testing | BDD tanpa ERVF | ERVF (Framework Ini) |
|-------|---------------|-----------------|---------------------|
| Requirement traceability | Manual, rentan error | Sebagian, tidak terstruktur | Otomatis, bidirectional |
| Execution | Manual | Semi-automated | Fully automated |
| Regression testing | Lambat, tidak komprehensif | Lebih cepat | Cepat dan komprehensif |
| Reporting | Manual spreadsheet | Basic HTML report | Dashboard interaktif |
| Maintenance | Tinggi (manual update) | Sedang | Rendah (otomatis) |
| CI/CD integration | Tidak ada | Partial | Full pipeline |

---

## H. KEUNTUNGAN & KETERBATASAN

### 1. Keuntungan ERVF

1. **Traceability Otomatis** — Setiap FR memiliki path yang dapat ditelusuri hingga test case.
2. **Regression Prevention** — Setiap perubahan kode otomatis diuji terhadap seluruh requirement.
3. **Defect Fast Detection** — Defek terdeteksi dalam < 5 menit setelah commit.
4. **Documentation as Code** — BDD scenarios berfungsi sebagai dokumentasi hidup.
5. **Quality Gate** — Rilis hanya dilakukan jika semua test pass.
6. **Scalable** — Framework dapat diterapkan pada proyek dengan ribuan requirement.

### 2. Keterbatasan

1. **Initial Setup Cost** — Membangun page objects dan step definitions membutuhkan waktu di awal.
2. **Flaky Tests** — Test yang bergantung pada timing atau network dapat menjadi flaky.
3. **Maintenance Overhead** — Perubahan UI membutuhkan update page objects.
4. **Learning Curve** — Tim perlu memahami BDD, Gherkin, dan Playwright.
5. **Browser Dependency** — Beberapa test mungkin spesifik browser tertentu.

---

## I. HASIL YANG DIHARAPKAN

### 1. Artefak Utama

1. **Executable Requirement Validation Framework (ERVF)** — framework traceability + automated testing.
2. **BDD Feature Files** — 85+ skenario Gherkin untuk 63 functional requirements.
3. **Playwright Test Suite** — automated test scripts yang terintegrasi dengan BDD.
4. **CI/CD Pipeline** — GitHub Actions workflow untuk testing otomatis.
5. **Coverage Dashboard** — report requirement coverage dan test results.

### 2. Kontribusi Utama

**Executable Requirement Validation Framework (ERVF)** — framework yang membuktikan bahwa requirement traceability dapat dijalankan secara otomatis, bukan hanya didokumentasikan. ERVF mengintegrasikan requirement specification, BDD scenarios, automated testing, dan CI/CD execution dalam satu ekosistem yang terukur.

---

## J. JADWAL PENELITIAN

| Bulan | Kegiatan |
|-------|----------|
| **Bulan 1** | Studi literatur, framework design, traceability matrix development |
| **Bulan 2** | BDD scenario writing (Gherkin), page object development |
| **Bulan 3** | Step definitions implementation, test data management |
| **Bulan 4** | CI/CD pipeline setup, report dashboard development |
| **Bulan 5** | Test execution, bug fixing, flaky test resolution |
| **Bulan 6** | Coverage analysis, defect mapping, metrics collection |
| **Bulan 7** | Evaluation, comparison with baseline, documentation |
| **Bulan 8** | Penulisan laporan tesis, revisi, publikasi |

---

## K. DAFTAR PUSTAKA

### BDD & Testing
[1] N. Nascimento et al., "Behavior-Driven Development: A Case Study," IEEE/ACM 42nd ICSE Workshops, 2020, pp. 109-116.
[2] M. García et al., "Behaviour Driven Development: A Systematic Mapping Study," J. Systems and Software, vol. 203, p. 111744, 2023.
[3] I. Sommerville, Software Engineering, 10th ed. Pearson, 2016.
[4] D. Chelimsky et al., "The RSpec Book," Pragmatic Bookshelf, 2010.
[5] G. Automation, "Playwright Documentation," Microsoft, 2024.

### Requirement Engineering
[6] K. Pohl, "Requirements Engineering: Principles, Techniques and Practice," Springer, 2010.
[7] G. Lucassen et al., "Improving Agile Requirements: The Quality User Story Framework," Requirements Engineering, vol. 21, pp. 383-400, 2016.
[8] I. K. Raharjana et al., "User Story Extraction from Natural Language," J. Systems and Software, vol. 200, p. 111634, 2023.

### CI/CD & DevOps
[9] J. Humble & J. Farley, "Continuous Delivery," Addison-Wesley, 2010.
[10] L. Kim et al., "The Site Reliability Workbook," O'Reilly, 2018.

### Test Automation
[11] M. Bolton, "Exploratory Testing," 2018.
[12] A. H. Nguyen, "Playwright Test Automation," Packt Publishing, 2022.
[13] E. Van Veenendaal, "Foundations of Software Testing," ISTQB, 2018.

### Quality & Metrics
[14] S. H. Kan, "Metrics and Models in Software Quality Engineering," 2nd ed., Addison-Wesley, 2002.
[15] Capers Jones, "Applied Software Measurement," McGraw-Hill, 2008.
[16] G. J. Myers, "The Art of Software Testing," 3rd ed., Wiley, 2011.
