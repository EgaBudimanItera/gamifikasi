# USULAN PENELITIAN TESIS

## IMPLEMENTASI ARSITEKTUR APLIKASI GAMIFIKASI PEMBELAJARAN BERBASIS LARAVEL DAN NEXT.JS PADA LINGKUNGAN SMP

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

**IMPLEMENTASI ARSITEKTUR APLIKASI GAMIFIKASI PEMBELAJARAN BERBASIS LARAVEL DAN NEXT.JS PADA LINGKUNGAN SMP**

---

## B. RINGKASAN

Sistem pembelajaran konvensional di Indonesia masih menghadapi tantangan signifikan terkait rendahnya motivasi siswa, keterlambatan penyelesaian tugas, dan partisipasi aktif yang terbatas dalam kegiatan kelas. Gamifikasi telah terbukti efektif meningkatkan motivasi dan keterlibatan siswa melalui elemen seperti XP, level, badge, streak, dan leaderboard (Deterding et al., 2011). Namun, implementasi sistem gamifikasi pendidikan yang scalable, maintainable, dan performant masih menjadi tantangan teknis yang belum banyak diusung dalam penelitian terapan di Indonesia.

Penelitian ini bertujuan mengimplementasikan arsitektur aplikasi web gamifikasi pembelajaran (EduQuest) untuk siswa SMP kelas VII menggunakan stack teknologi Laravel 10 (backend) dan Next.js 15 (frontend) dengan arsitektur REST API. Sistem ini mengintegrasikan modul-modul: Authentication, Dashboard, Quest System, NPC Mentor Service, Guild Service, Gamified Retrieval Quiz, Material Reading, dan Analytics. Implementasi mencakup desain database relasional, autentikasi berbasis role (Admin, Guru, Siswa), optimasi performa, strategi deployment, dan keamanan dasar aplikasi web.

Kontribusi utama penelitian ini adalah **Scalable Gamified Learning Architecture** — arsitektur aplikasi gamifikasi pendidikan yang terintegrasi, scalable, dan siap produksi untuk lingkungan sekolah menengah pertama di Indonesia. Arsitektur ini dirancang dengan prinsip separation of concerns, API-first design, dan modular service layer sehingga mudah di-maintain dan di-extensi.

---

## C. PENDAHULUAN

### 1. Latar Belakang

Pendidikan di Indonesia menghadapi tantangan digitalisasi yang kompleks. Kurikulum Merdeka menekankan pendekatan pembelajaran berpusat pada siswa [1], namun infrastruktur teknologi pendidikan di banyak sekolah masih terbatas. Guru menggunakan platform seperti Google Classroom hanya untuk distribusi materi tanpa elemen engagement yang memadai.

Dari perspektif teknis, pengembangan sistem gamifikasi pendidikan memerlukan arsitektur yang mampu menangani: (1) kompleksitas bisnis rules gamifikasi (XP calculation, level progression, badge triggers, streak tracking); (2) mekanisme personalisasi NPC Mentor Affinity yang membutuhkan state management per siswa per mentor; (3) sistem guild kolaboratif yang memerlukan real-time aggregation; (4) analytics dashboard untuk guru yang membutuhkan query performa tinggi; dan (5) skalabilitas untuk ratusan hingga ribuan pengguna aktif simultan.

Laravel 10 dipilih sebagai backend framework karena ekosistem yang matang, built-in authentication (Sanctum), queue system, dan ORM (Eloquent) yang memudahkan pengelolaan database relasional. Next.js 15 dipilih sebagai frontend framework karena server-side rendering (SSR), API routes, optimalisasi performa bawaan, dan dukungan TypeScript yang kuat. Kombinasi keduanya menghasilkan arsitektur yang terpisah antara client dan server melalui REST API, memungkinkan fleksibilitas pengembangan dan deployment.

Penelitian ini berfokus pada aspek product engineering: arsitektur sistem, desain database, implementasi modul-modul backend dan frontend, optimasi performa, deployment, serta evaluasi teknis. Aspek requirement engineering, BDD, dan evaluasi pengguna dibahas secara terbatas sebagai konteks implementasi.

### 2. Rumusan Masalah

1. Bagaimana merancang arsitektur aplikasi gamifikasi pembelajaran berbasis web yang scalable dan maintainable untuk lingkungan SMP?
2. Bagaimana mengimplementasikan modul-modul gamifikasi (Quest, NPC, Guild, Quiz, Analytics) menggunakan Laravel 10 dan Next.js 15 dengan arsitektur REST API?
3. Bagaimana strategi deployment dan optimasi performa untuk memastikan aplikasi dapat berjalan stabil di lingkungan produksi?

### 3. Tujuan Penelitian

1. Merancang arsitektur aplikasi gamifikasi pembelajaran (EduQuest) yang scalable, modular, dan maintainable.
2. Mengimplementasikan modul-modul backend (Laravel 10) dan frontend (Next.js 15) dengan REST API.
3. Menerapkan strategi deployment dan optimasi performa untuk lingkungan produksi.
4. Mengevaluasi performa dan stabilitas sistem melalui metrik teknis.

### 4. Manfaat Penelitian

#### 4.1 Manfaat Akademik
- Memberikan referensi arsitektur aplikasi gamifikasi pendidikan berbasis Laravel dan Next.js.
- Mendokumentasikan pola desain dan best practices untuk sistem gamifikasi web.
- Menjadi acuan bagi peneliti lain yang mengembangkan sistem serupa.

#### 4.2 Manfaat Praktis
- Menyediakan prototipe sistem yang siap diterapkan di sekolah menengah pertama.
- Memberikan panduan implementasi gamifikasi bagi pengembang aplikasi pendidikan.
- Dokumentasi teknis yang memudahkan maintenance dan pengembangan lebih lanjut.

---

## D. TINJAUAN PUSTAKA

### 1. Arsitektur Web Modern

Arsitektur web modern mengadopsi pola **separation of concerns** di mana frontend dan backend dikembangkan secara terpisah dan berkomunikasi melalui API (Fielding, 2000). Pola ini memungkinkan skala pengembangan tim yang terpisah, teknologi yang berbeda untuk client dan server, serta deployment yang fleksibel.

**REST (Representational State Transfer)** adalah gaya arsitektur untuk sistem hipermedia terdistribusi yang menggunakan HTTP sebagai protokol komunikasi. Prinsip REST meliputi: stateless communication, uniform interface, layered system, dan cacheability.

**Monolith Architecture** dipilih untuk penelitian ini karena kompleksitas proyek yang masih manageable dalam satu codebase. Laravel 10 mendukung monolith yang rapi melalui service layer, repository pattern, dan modular directory structure.

### 2. Laravel 10

Laravel 10 adalah PHP framework yang menyediakan:
- **Eloquent ORM** — ActiveRecord implementation untuk database relasional.
- **Laravel Sanctum** — autentikasi token-based untuk SPA dan mobile.
- **Queue System** — background job processing menggunakan Redis/Database.
- **Task Scheduling** — cron job management untuk streak calculation, daily challenge, reward distribution.
- **Form Request Validation** — validasi terpusat untuk input sanitization.
- **API Resources** — transformasi data model ke JSON response.
- **Testing** — PHPUnit dan feature testing bawaan.

### 3. Next.js 15

Next.js 15 adalah React framework yang menyediakan:
- **App Router** — file-based routing dengan layout nesting.
- **Server-Side Rendering (SSR)** — rendering di server untuk performa awal yang lebih baik.
- **Static Site Generation (SSG)** — generate halaman statis saat build time.
- **API Routes** — backend API dalam aplikasi yang sama.
- **Server Components** — komponen React yang berjalan di server.
- **Image Optimization** — optimasi gambar otomatis.
- **Middleware** — request/response middleware.

### 4. Database Relasional

MySQL dipunakan sebagai database utama karena:
- ACID compliance untuk transaksi gamifikasi (XP deduction, guild reward distribution).
- Full-text search untuk pencarian materi dan quest.
- JSON column type untuk menyimpan metadata fleksibel (quiz questions, NPC dialogue).
- Replication support untuk skalabilitas baca.

### 5. Gamifikasi dalam Pendidikan

Deterding et al. (2011) mendefinisikan gamifikasi sebagai penerapan elemen desain permainan dalam konteks non-permainan [2]. Elemen gamifikasi inti yang diimplementasikan dalam EduQuest:
- **XP & Level** — progres kumulatif berdasarkan aktivitas belajar.
- **Badge** — pencapaian spesifik yang diberikan saat kondisi terpenuhi.
- **Streak** — konsistensi harian penggunaan sistem.
- **Leaderboard** — peringkat kompetitif berdasarkan XP.
- **Quest** — tugas pembelajaran yang dikemas dalam format petualangan.
- **NPC Mentor** — mentor virtual yang memberikan quest dan feedback adaptif.
- **Guild** — kelompok belajar kolaboratif dengan reward kolektif.

---

## E. ARSITEKTUR SISTEM

### 1. High-Level Architecture

```
┌─────────────────────────────────────────────────────┐
│                    CLIENT LAYER                       │
│  Next.js 15 (React SSR/CSR)                         │
│  - Student Dashboard                                 │
│  - Teacher Dashboard                                 │
│  - Admin Panel                                       │
│  - NPC Interaction UI                                │
│  - Guild Dashboard                                   │
│  - Quest Tracker                                     │
│  - Quiz Interface                                    │
│  - Analytics Charts                                  │
└──────────────────────┬──────────────────────────────┘
                       │ HTTPS (REST API)
                       ↓
┌─────────────────────────────────────────────────────┐
│                  API LAYER (Laravel 10)               │
│  - Authentication (Sanctum)                          │
│  - Route Controllers                                 │
│  - Form Request Validation                           │
│  - API Resources (JSON Transformer)                  │
│  - Middleware (Role, CORS, Rate Limiting)             │
└──────────────────────┬──────────────────────────────┘
                       │
┌──────────────────────┼──────────────────────────────┐
│              SERVICE LAYER                            │
│  - AuthService          - QuestService               │
│  - NpcService           - GuildService               │
│  - GamificationService  - AnalyticsService           │
│  - QuizService          - MaterialReadingService     │
│  - BadgeService         - StreakService              │
│  - LeaderboardService   - RewardService              │
└──────────────────────┬──────────────────────────────┘
                       │
┌──────────────────────┼──────────────────────────────┐
│              DATA LAYER                               │
│  - Eloquent ORM (MySQL)                              │
│  - Cache Layer (Redis)                               │
│  - Queue Worker (Redis/Database)                     │
│  - Storage (Local/S3)                                │
└─────────────────────────────────────────────────────┘
```

### 2. Database Design

#### 2.1 Entity Relationship Diagram (Logical)

**Core Tables:**

| Table | Deskripsi | Key Relationships |
|-------|-----------|-------------------|
| `users` | Data pengguna (admin, guru, siswa) | 1:N user_activity_logs, user_badges |
| `schools` | Data sekolah | 1:N classes |
| `classes` | Data kelas | 1:N class_subjects, N:1 users (teacher) |
| `subjects` | Mata pelajaran | 1:N materials, quests |
| `academic_years` | Tahun akademik | 1:N classes |

**Gamification Tables:**

| Table | Deskripsi | Key Relationships |
|-------|-----------|-------------------|
| `user_xp` | XP total per siswa | 1:1 users |
| `user_levels` | Level siswa | 1:1 users |
| `user_streaks` | Streak harian | 1:N users |
| `user_badges` | Badge yang diperoleh | N:1 users, N:1 badges |
| `badges` | Master data badge | 1:N user_badges |
| `leaderboards` | Peringkat XP | Virtual/materialized |

**NPC Tables:**

| Table | Deskripsi | Key Relationships |
|-------|-----------|-------------------|
| `npcs` | Data NPC mentor | 1:N npc_quests, npc_dialogues |
| `npc_affinity` | MAS per siswa per NPC | N:1 users, N:1 npcs |
| `npc_quests` | Quest yang ditawarkan NPC | N:1 npcs, N:1 quests |
| `npc_dialogues` | Dialog NPC | N:1 npcs, context-dependent |
| `npc_interaction_logs` | Log interaksi | N:1 users, N:1 npcs |

**Guild Tables:**

| Table | Deskripsi | Key Relationships |
|-------|-----------|-------------------|
| `guilds` | Data guild | 1:N guild_members, guild_quests |
| `guild_members` | Anggota guild | N:1 guilds, N:1 users |
| `guild_xp` | XP guild | 1:1 guilds |
| `guild_quests` | Quest guild | N:1 guilds |
| `guild_rewards` | Reward guild | N:1 guilds |
| `guild_logs` | Log aktivitas guild | N:1 guilds |

**Learning Tables:**

| Table | Deskripsi | Key Relationships |
|-------|-----------|-------------------|
| `materials` | Materi pembelajaran | N:1 subjects |
| `material_readings` | Log bacaan siswa | N:1 users, N:1 materials |
| `quests` | Data quest | N:1 subjects, npcs |
| `quest_attempts` | Percobaan quest | N:1 users, N:1 quests |
| `quizzes` | Data kuis | N:1 subjects |
| `quiz_attempts` | Percobaan kuis | N:1 users, N:1 quizzes |

**Analytics Tables:**

| Table | Deskripsi | Key Relationships |
|-------|-----------|-------------------|
| `user_activity_logs` | Semua aktivitas user | N:1 users |
| `daily_summaries` | Ringkasan harian | 1:1 users per date |
| `engagement_metrics` | Metrik engagement | Agregated from logs |

#### 2.2 Database Schema Highlights

```sql
-- NPC Affinity (MAS tracking)
CREATE TABLE npc_affinity (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    npc_id BIGINT NOT NULL,
    affinity_xp DECIMAL(10,2) DEFAULT 0,
    affinity_level TINYINT DEFAULT 1,
    quest_completed INT DEFAULT 0,
    last_interaction_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_npc (user_id, npc_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (npc_id) REFERENCES npcs(id) ON DELETE CASCADE
);

-- Guild XP and Rewards
CREATE TABLE guild_xp (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    guild_id BIGINT NOT NULL,
    total_xp DECIMAL(12,2) DEFAULT 0,
    current_level TINYINT DEFAULT 1,
    weekly_target INT DEFAULT 50,
    weekly_progress INT DEFAULT 0,
    week_start DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (guild_id) REFERENCES guilds(id) ON DELETE CASCADE
);

-- Quest Attempts with scoring
CREATE TABLE quest_attempts (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    quest_id BIGINT NOT NULL,
    npc_id BIGINT NULL,
    score DECIMAL(5,2) DEFAULT 0,
    xp_earned DECIMAL(8,2) DEFAULT 0,
    mas_change DECIMAL(8,2) DEFAULT 0,
    duration_seconds INT DEFAULT 0,
    status ENUM('in_progress','completed','failed') DEFAULT 'in_progress',
    completed_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (quest_id) REFERENCES quests(id),
    FOREIGN KEY (npc_id) REFERENCES npcs(id) ON DELETE SET NULL
);

-- User Activity Logs (event-based analytics)
CREATE TABLE user_activity_logs (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    event_type ENUM('login','checkin','quest_completion','reading',
                    'quiz_participation','guild_contribution','mas_change') NOT NULL,
    event_data JSON,
    device_type VARCHAR(50),
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_event (user_id, event_type),
    INDEX idx_created (created_at)
);
```

### 3. REST API Design

#### 3.1 API Endpoint Structure

```
/api/v1/
├── auth/
│   ├── POST /login
│   ├── POST /register
│   ├── POST /logout
│   └── POST /password/reset
├── users/
│   ├── GET /profile
│   ├── PUT /profile
│   └── GET /dashboard-stats
├── quest/
│   ├── GET /available
│   ├── GET /{id}
│   ├── POST /{id}/start
│   ├── POST /{id}/complete
│   └── GET /history
├── npc/
│   ├── GET /mentors
│   ├── GET /mentors/{id}
│   ├── GET /mentors/{id}/affinity
│   ├── POST /mentors/{id}/interact
│   └── GET /mentors/{id}/quests
├── guild/
│   ├── GET /list
│   ├── POST /create
│   ├── POST /join/{id}
│   ├── GET /my-guild
│   ├── GET /my-guild/members
│   ├── GET /my-guild/quests
│   ├── POST /my-guild/contribute
│   └── GET /my-guild/rewards
├── quiz/
│   ├── GET /available
│   ├── POST /{id}/start
│   ├── POST /{id}/submit
│   └── GET /leaderboard
├── material/
│   ├── GET /list
│   ├── GET /{id}
│   ├── POST /{id}/start-reading
│   ├── POST /{id}/finish-reading
│   └── GET /{id}/quiz
├── gamification/
│   ├── GET /xp
│   ├── GET /level
│   ├── GET /badges
│   ├── GET /streak
│   └── GET /leaderboard
├── analytics/ (teacher only)
│   ├── GET /overview
│   ├── GET /students/{id}/detail
│   ├── GET /npc-stats
│   ├── GET /guild-stats
│   ├── GET /quest-stats
│   └── GET /material-stats
└── admin/
    ├── CRUD /schools
    ├── CRUD /classes
    ├── CRUD /subjects
    ├── CRUD /users
    └── GET /system-logs
```

#### 3.2 API Response Format

```json
{
    "success": true,
    "message": "Quest completed successfully",
    "data": {
        "quest_id": 15,
        "score": 85.5,
        "xp_earned": 150,
        "mas_change": 7.725,
        "new_level": 3,
        "badges_earned": ["first_quest_week"]
    },
    "meta": {
        "timestamp": "2026-07-21T10:30:00Z",
        "request_id": "req_abc123"
    }
}
```

#### 3.3 Authentication Flow

```
Client → POST /api/v1/auth/login {email, password}
Server → Validate credentials
Server → Generate Sanctum token
Server → Return {token, user, roles}
Client → Authorization: Bearer {token} (header setiap request)
Server → Middleware: auth:sanctum → role:siswa → proceed
```

### 4. Service Layer Architecture

#### 4.1 Quest Service

```php
// QuestService.php
class QuestService
{
    public function getAvailableQuests(User $user): Collection
    public function startQuest(User $user, Quest $quest): QuestAttempt
    public function completeQuest(QuestAttempt $attempt, array $answers): QuestResult
    private function calculateXP(QuestAttempt $attempt): float
    private function calculateMAS(User $user, Npc $npc, float $score): float
    private function checkBadgeTriggers(User $user): array
    private function updateLeaderboard(User $user): void
}
```

#### 4.2 NPC Service

```php
// NpcService.php
class NpcService
{
    public function getAffinityLevel(User $user, Npc $npc): int
    public function calculateAffinity(User $user, Npc $npc): AffinityResult
    public function getAdaptiveQuests(User $user, Npc $npc): Collection
    public function getDialogue(User $user, Npc $npc, string $context): string
    private function getAffinityThresholds(): array
    // Threshold: [0, 5, 15, 30, 50] → level 1-5
}
```

#### 4.3 Guild Service

```php
// GuildService.php
class GuildService
{
    public function createGuild(string $name, User $leader): Guild
    public function joinGuild(User $user, Guild $guild): GuildMember
    public function contributeXP(User $user, Guild $guild, float $xp): void
    public function checkWeeklyTarget(Guild $guild): bool
    public function distributeReward(Guild $guild): GuildReward
    public function getGuildStats(Guild $guild): GuildStats
}
```

#### 4.4 Gamification Engine

```php
// GamificationService.php
class GamificationService
{
    public function addXP(User $user, float $xp, string $source): XpResult
    public function checkLevelUp(User $user): ?LevelUpResult
    public function checkBadges(User $user): array
    public function updateStreak(User $user): StreakResult
    public function updateLeaderboard(User $user): void
    private function getLevelThresholds(): array
    private function getBadgeRules(): array
}
```

### 5. Gamification Rules Engine

#### 5.1 XP Calculation

| Activity | Base XP | Multiplier | Max XP |
|----------|---------|------------|--------|
| Quest completion | 50–200 | Based on difficulty | 500 |
| Quiz correct answer | 10 | × combo bonus | 100 |
| Daily check-in | 10 | × streak multiplier | 50 |
| Material reading (>3 min) | 20 | × depth bonus | 100 |
| Guild quest participation | 30 | × guild level | 150 |
| NPC interaction | 5 | × affinity bonus | 25 |

#### 5.2 Level Progression

| Level | XP Required | Title |
|-------|-------------|-------|
| 1 | 0 | Pemula |
| 2 | 100 | Petualang |
| 3 | 300 | Penjelajah |
| 4 | 600 | Penakluk |
| 5 | 1000 | Legenda |

#### 5.3 Badge Rules

| Badge | Condition | Category |
|-------|-----------|----------|
| First Steps | Login pertama kali | Engagement |
| Streak Master | 7 hari berturut login | Consistency |
| Quest Hunter | Menyelesaikan 10 quest | Achievement |
| Bookworm | Membaca 5 materi >3 menit | Learning |
| Team Player | Berkontribusi 500 XP ke guild | Collaboration |
| Mentor's Friend | MAS level 3 dengan 1 NPC | Relationship |

#### 5.4 NPC Mentor Affinity Thresholds

| Level | MAS Required | Quest Difficulty | Reward Multiplier |
|-------|-------------|------------------|-------------------|
| 1 | 0 | Easy | 1.0× |
| 2 | 5 | Easy–Medium | 1.2× |
| 3 | 15 | Medium | 1.5× |
| 4 | 30 | Medium–Hard | 1.8× |
| 5 | 50 | Hard–Legendary | 2.0× |

#### 5.5 Guild Weekly Reward Distribution

```
IF guild_weekly_progress >= guild_weekly_target:
    FOR EACH member IN guild:
        member.xp += 150 (base reward)
        member.xp += guild_bonus_xp (based on guild level)
        GRANT guild_chest (random badge/item)
        GRANT 10% XP bonus for 24 hours
```

### 6. Frontend Architecture (Next.js 15)

#### 6.1 Directory Structure

```
frontend/
├── app/
│   ├── (auth)/
│   │   ├── login/page.tsx
│   │   └── register/page.tsx
│   ├── (dashboard)/
│   │   ├── layout.tsx (sidebar + navbar)
│   │   ├── page.tsx (student dashboard)
│   │   ├── teacher/page.tsx
│   │   ├── quest/page.tsx
│   │   ├── npc/[id]/page.tsx
│   │   ├── guild/page.tsx
│   │   ├── quiz/page.tsx
│   │   ├── material/page.tsx
│   │   ├── leaderboard/page.tsx
│   │   └── analytics/page.tsx (teacher)
│   └── layout.tsx (root layout)
├── components/
│   ├── ui/ (reusable UI components)
│   ├── dashboard/ (dashboard-specific components)
│   ├── quest/ (quest-related components)
│   ├── npc/ (NPC interaction components)
│   ├── guild/ (guild-related components)
│   └── charts/ (analytics chart components)
├── lib/
│   ├── api.ts (API client)
│   ├── auth.ts (authentication helpers)
│   └── utils.ts (utility functions)
├── hooks/
│   ├── useAuth.ts
│   ├── useQuest.ts
│   ├── useNpcAffinity.ts
│   └── useGuild.ts
└── types/
    └── index.ts (TypeScript interfaces)
```

#### 6.2 Key Pages

| Page | Komponen Utama | Data |
|------|---------------|------|
| Student Dashboard | XP bar, level badge, streak counter, recent quests, NPC greeting | /users/dashboard-stats |
| Quest Page | Quest cards, difficulty badge, reward info, NPC avatar | /quest/available |
| NPC Page | NPC dialogue box, affinity meter, quest list, interaction history | /npc/mentors/{id} |
| Guild Page | Member list, guild XP bar, weekly progress, reward chest | /guild/my-guild |
| Quiz Page | Timer, question display, leaderboard sidebar, score result | /quiz/available |
| Material Page | Reading content, progress bar, quiz trigger | /material/{id} |
| Leaderboard | Ranking table, XP comparison, level badges | /gamification/leaderboard |
| Analytics (Teacher) | Charts (Engagement, NPC stats, Guild stats, Material stats) | /analytics/overview |

### 7. Authentication & Authorization

#### 7.1 Role-Based Access Control

| Role | Permissions |
|------|-------------|
| Admin | Full CRUD: schools, classes, subjects, users, system logs |
| Guru | View analytics, manage materials, manage quests, view guild stats |
| Siswa | Quest, NPC interaction, guild, quiz, material reading, gamification |

#### 7.2 Authentication Flow

1. Login → POST /api/v1/auth/login → Sanctum token issued.
2. Every request → `Authorization: Bearer {token}` header.
3. Middleware `auth:sanctum` → verify token → attach user to request.
4. Middleware `role:siswa` → verify user role → allow/deny.
5. Logout → POST /api/v1/auth/logout → revoke token.

---

## F. IMPLEMENTASI MODUL

### 1. Dashboard Module

**Student Dashboard:**
- XP progress bar dengan animasi.
- Level badge dan title.
- Streak counter dengan visual fire icon.
- Quest yang tersedia (top 5 berdasarkan NPC affinity).
- Guild status (guild name, XP, weekly progress).
- NPC greeting berdasarkan affinity level.

**Teacher Dashboard:**
- Total siswa aktif hari ini.
- Quest completion rate (grafik 7 hari terakhir).
- Guild ranking berdasarkan guild XP.
- Material reading statistics.
- Top 5 siswa berdasarkan XP.

### 2. Quest Module

```
Quest Flow:
1. Siswa melihat daftar quest tersedia (filtered by NPC affinity level)
2. Siswa memilih quest → POST /quest/{id}/start
3. Backend: create quest_attempt, update NPC interaction log
4. Siswa mengerjakan quest (reading, quiz, atau assignment)
5. Siswa menyelesaikan → POST /quest/{id}/complete
6. Backend: calculate score, XP, MAS change, check badge triggers
7. Response: xp_earned, new_level, badges_earned
```

### 3. NPC Service Module

```
NPC Interaction Flow:
1. Siswa membuka halaman NPC → GET /npc/mentors/{id}
2. Backend: return NPC profile + affinity level + available quests
3. Affinity determination:
   - Load npc_affinity(user_id, npc_id)
   - Calculate level: threshold MAS [0, 5, 15, 30, 50] → level 1-5
   - Filter quests by difficulty (based on affinity level)
4. Siswa berinteraksi → POST /npc/mentors/{id}/interact
5. Backend: update affinity_xp, check level up, select contextual dialogue
6. Quest generation: adaptive based on:
   - Affinity level → difficulty range
   - Past quest history → avoid repetition
   - Subject progression → curriculum-aligned
```

### 4. Guild Module

```
Guild Flow:
1. Siswa membuat guild → POST /guild/create {name}
2. Backend: create guild, guild_xp, guild_member (leader)
3. Siswa lain join → POST /guild/join/{id}
4. Setiap XP yang diperoleh anggota → contributeXP() dipanggil
5. Backend: guild_xp.weekly_progress += member_xp
6. Mingguan check → checkWeeklyTarget()
7. Jika target tercapai → distributeReward():
   - +150 XP untuk semua anggota
   - Guild chest (random badge)
   - 10% XP bonus 24 jam
8. Reset weekly_progress untuk minggu baru
```

### 5. Gamified Retrieval Quiz Module

```
Quiz Flow:
1. Setelah reading materi → quiz automatically available
2. Quiz berisi 5-10 soal (pilihan ganda, uraian singkat)
3. Timer: 30 detik per soal (pilihan ganda), 2 menit (uraian)
4. Siswa submit → backend: calculate score, XP earned
5. Ranking: quiz score → leaderboard posisi
6. Guild quiz: anggota guild berkompetisi → guild gets bonus
```

### 6. Material Reading Module

```
Reading Flow:
1. Siswa memilih materi → GET /material/{id}
2. Backend: return content + reading progress
3. Siswa mulai baca → POST /material/{id}/start-reading
4. Frontend: track scroll depth + time spent
5. Siswa selesai → POST /material/{id}/finish-reading
6. Backend: log duration, calculate reading XP
7. Jika duration > 3 menit → quiz available (retrieval practice trigger)
8. Quiz score → affects quest difficulty recommendation
```

### 7. Analytics Module

```
Analytics Data Pipeline:
1. Event Logger: setiap aksi user → user_activity_logs (event_type, event_data JSON)
2. Daily Aggregation (scheduled job): 
   - login count, quest completion, reading duration, quiz score
   - → daily_summaries table
3. Engagement Metrics Engine (weekly job):
   - Quest completion rate per siswa
   - Streak retention rate
   - Guild contribution score
   - → engagement_metrics table
4. Teacher Dashboard Query:
   - GET /analytics/overview → aggregate from daily_summaries + engagement_metrics
   - GET /analytics/students/{id}/detail → per-student metrics
   - GET /analytics/npc-stats → NPC affinity distribution
   - GET /analytics/guild-stats → guild performance
   - GET /analytics/quest-stats → quest difficulty vs completion rate
   - GET /analytics/material-stats → reading depth vs quiz score
```

---

## G. DEPLOYMENT & INFRASTRUKTUR

### 1. Deployment Strategy

```
┌─────────────────────────────────────────────┐
│              Production Server               │
│                                              │
│  Nginx (Reverse Proxy + Static Files)        │
│    ├── /api/* → PHP-FPM (Laravel 10)        │
│    └── /* → Next.js (Node.js + PM2)         │
│                                              │
│  MySQL 8.0 (Database)                        │
│  Redis 7.x (Cache + Queue + Session)         │
│                                              │
│  Supervisor (Queue Worker + Scheduler)       │
└─────────────────────────────────────────────┘
```

### 2. Server Requirements

| Component | Minimum Spec | Recommended Spec |
|-----------|-------------|-----------------|
| CPU | 2 cores | 4 cores |
| RAM | 4 GB | 8 GB |
| Storage | 40 GB SSD | 80 GB SSD |
| OS | Ubuntu 22.04 LTS | Ubuntu 22.04 LTS |
| PHP | 8.2+ | 8.3 |
| Node.js | 18 LTS | 20 LTS |
| MySQL | 8.0 | 8.0 |
| Redis | 7.x | 7.x |

### 3. Nginx Configuration

```nginx
server {
    listen 80;
    server_name eduquest.example.com;

    # Laravel API
    location /api/ {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Next.js SSR
    location / {
        proxy_pass http://127.0.0.1:3000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }

    # Static assets cache
    location /_next/static/ {
        proxy_pass http://127.0.0.1:3000;
        expires 365d;
        add_header Cache-Control "public, immutable";
    }
}
```

### 4. Queue & Scheduler Setup

```ini
# /etc/supervisor/conf.d/eduquest.ini

[program:eduquest-worker]
command=php /var/www/eduquest/artisan queue:work redis --sleep=3 --tries=3
autostart=true
autorestart=true

[program:eduquest-scheduler]
command=/bin/bash -c "while true; do php /var/www/eduquest/artisan schedule:run --verbose --no-interaction & sleep 60; done"
autostart=true
autorestart=true
```

**Scheduled Jobs:**

| Job | Frequency | Deskripsi |
|-----|-----------|-----------|
| CalculateStreak | Daily 00:00 | Hitung dan update streak semua user |
| UpdateLeaderboard | Every 6 hours | Recalculate leaderboard ranking |
| CheckGuildTargets | Weekly Sunday 23:59 | Cek dan distribusikan guild reward |
| GenerateDailySummaries | Daily 01:00 | Agregasi aktivitas harian |
| UpdateEngagementMetrics | Weekly Monday 02:00 | Hitung metrik engagement mingguan |

### 5. Docker Deployment (Optional)

```yaml
version: '3.8'
services:
  nginx:
    image: nginx:alpine
    ports:
      - "80:80"
    volumes:
      - ./nginx.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - backend
      - frontend

  backend:
    build: ./backend
    environment:
      - DB_HOST=mysql
      - REDIS_HOST=redis
    depends_on:
      - mysql
      - redis

  frontend:
    build: ./frontend
    ports:
      - "3000:3000"

  mysql:
    image: mysql:8.0
    environment:
      MYSQL_DATABASE: eduquest
      MYSQL_ROOT_PASSWORD: ${DB_PASSWORD}
    volumes:
      - mysql_data:/var/lib/mysql

  redis:
    image: redis:7-alpine
    volumes:
      - redis_data:/data

volumes:
  mysql_data:
  redis_data:
```

---

## H. OPTIMASI PERFORMA

### 1. Database Optimization

- **Indexing:** Index pada foreign keys, frequently queried columns (user_id, quest_id, event_type, created_at).
- **Eager Loading:** Gunakan `with()` untuk menghindari N+1 query (e.g., `Quest::with('npc', 'subject')`).
- **Query Scope:** Scope untuk filtering common queries (e.g., `scopeActive()`, `scopeRecent()`).
- **Pagination:** Cursor-based pagination untuk leaderboard dan activity logs.

### 2. Caching Strategy

| Data | Cache Driver | TTL | Invalidated By |
|------|-------------|-----|----------------|
| User XP & Level | Redis | 5 min | After XP change |
| Leaderboard | Redis | 15 min | Scheduled recalculation |
| Guild Stats | Redis | 10 min | After guild activity |
| NPC Affinity | Redis | 5 min | After NPC interaction |
| Quiz Questions | Redis | 1 hour | Quiz update |
| Material Content | Redis | 24 hour | Material update |

### 3. Frontend Performance

- **Server-Side Rendering (SSR):** Dashboard pages rendered on server for fast initial load.
- **Static Generation (SSG):** Static pages (login, register) pre-built at build time.
- **Image Optimization:** Next.js Image component with lazy loading and WebP conversion.
- **Code Splitting:** Dynamic imports untuk heavy components (charts, quiz engine).
- **Font Optimization:** next/font for automatic font optimization.
- **API Prefetching:** useSWR or React Query for data caching on client side.

### 4. Performance Targets

| Metric | Target | Measurement |
|--------|--------|-------------|
| API Response Time (avg) | < 200ms | Laravel Telescope + New Relic |
| Page Load Time (FCP) | < 2s | Lighthouse |
| Time to Interactive (TTI) | < 3s | Lighthouse |
| Lighthouse Score | ≥ 90 | Lighthouse audit |
| Database Query Time (avg) | < 50ms | Slow query log |
| Concurrent Users | ≥ 500 | Load testing (k6) |
| Uptime | ≥ 99.5% | Server monitoring |

---

## I. KEAMANAN DASAR

### 1. Authentication Security

- **Sanctum Token:** Token-based authentication dengan expiry.
- **Rate Limiting:** Max 5 attempts per minute untuk login.
- **Password Hashing:** bcrypt dengan cost factor 12.
- **CSRF Protection:** Laravel CSRF token untuk web routes.

### 2. Input Validation

- **Form Request Validation:** Validasi terpusat untuk semua endpoint.
- **SQL Injection Prevention:** Eloquent ORM parameterized queries.
- **XSS Prevention:** Blade template auto-escaping + React DOM escaping.
- **Content Security Policy:** CSP headers untuk mencegah inline scripts.

### 3. API Security

- **CORS Configuration:** Hanya domain frontend yang diizinkan.
- **Rate Limiting:** Per-user rate limiting via middleware.
- **Input Sanitization:** Strip HTML tags, validate data types.
- **Response Filtering:** API Resources memastikan hanya data yang diizinkan yang dikirim.

### 4. Data Protection

- **Encryption at Rest:** MySQL transparent data encryption (TDE).
- **HTTPS:** TLS 1.3 untuk semua komunikasi.
- **Backup:** Automated daily backup ke cloud storage.
- **Audit Trail:** Semua perubahan data tercatat di activity logs.

---

## J. EVALUASI TEKNIS

### 1. Metrik Evaluasi

| Kategori | Metrik | Target | Tools |
|----------|--------|--------|-------|
| **Performance** | API response time (avg) | < 200ms | Laravel Telescope |
| | FCP | < 2s | Lighthouse |
| | TTI | < 3s | Lighthouse |
| **Reliability** | Uptime | ≥ 99.5% | UptimeRobot |
| | Error rate | < 1% | Sentry |
| **Scalability** | Concurrent users | ≥ 500 | k6 load test |
| | DB query time (avg) | < 50ms | MySQL slow query log |
| **Code Quality** | Test coverage | ≥ 80% | PHPUnit + coverage |
| | Code review | 100% PR reviewed | GitHub |

### 2. Load Testing

Menggunakan k6 untuk simulasi beban:
```
Scenario: Normal load (100 concurrent users)
- Login: 100 users dalam 30 detik
- Quest operations: 50% completed, 50% in progress
- NPC interaction: 30% users berinteraksi dengan NPC
- Guild activity: 20% users berkontribusi

Scenario: Peak load (500 concurrent users)
- Semua operasi di atas dengan 5× traffic
- Monitoring: response time, error rate, DB connection pool
```

### 3. Usability Evaluation (Brief)

Sistem dievaluasi menggunakan System Usability Scale (SUS) dengan target skor ≥ 70 (above average). Evaluasi dilakukan pada 30–40 siswa SMP kelas VII selama 4–6 minggu penggunaan.

---

## K. HASIL YANG DIHARAPKAN

### 1. Artefak Utama

1. **Prototipe EduQuest** — aplikasi web gamifikasi pembelajaran yang fully functional.
2. **REST API Documentation** — dokumentasi lengkap seluruh endpoint.
3. **Database Schema** — desain database relasional yang terdokumentasi.
4. **Deployment Guide** — panduan deployment lengkap.

### 2. Kontribusi Utama

**Scalable Gamified Learning Architecture** — arsitektur aplikasi gamifikasi pendidikan yang:
- **Modular** — setiap gamification element terisolasi dalam service layer.
- **API-First** — komunikasi client-server melalui REST API yang terstandarisasi.
- **Scalable** — queue system, caching, dan horizontal scaling strategy.
- **Maintainable** — clean code, service layer, dan testable architecture.
- **Secure** — authentication, authorization, input validation, data protection.

---

## L. JADWAL PENELITIAN

| Bulan | Kegiatan |
|-------|----------|
| **Bulan 1** | Studi literatur, requirement gathering, high-level architecture design |
| **Bulan 2** | Database design, API specification, UI/UX prototyping |
| **Bulan 3** | Implementasi backend: authentication, master data, learning modules |
| **Bulan 4** | Implementasi backend: gamification engine, NPC, guild, quest, quiz |
| **Bulan 5** | Implementasi frontend: dashboard, NPC UI, guild UI, quiz UI, analytics |
| **Bulan 6** | Unit testing, API testing, integration testing, performance testing |
| **Bulan 7** | Deployment, pilot testing di SMP mitra, bug fixing |
| **Bulan 8** | Evaluasi teknis, dokumentasi, penulisan laporan tesis, revisi |

---

## M. DAFTAR PUSTAKA

### Arsitektur & Engineering
[1] Kementerian Pendidikan Indonesia, "Kurikulum Merdeka," 2022.
[2] S. Deterding et al., "From Game Design Elements to Gamefulness," Proc. MindTrek, 2011.
[3] R. Fielding, "Architectural Styles and the Design of Network-based Software Architectures," PhD Dissertation, UC Irvine, 2000.
[4] Laravel Documentation, "Laravel 10 — The PHP Framework for Web Artisans," https://laravel.com/docs/10.x
[5] Next.js Documentation, "Next.js by Vercel — The React Framework," https://nextjs.org/docs

### Database & Backend
[6] E. F. Codd, "A Relational Model of Data for Large Shared Data Banks," Communications of the ACM, vol. 13, no. 6, 1970.
[7] MySQL 8.0 Reference Manual, Oracle Corporation, 2023.
[8] Redis Documentation, "Redis — The In-Memory Data Store," https://redis.io/docs

### Gamifikasi & Implementasi
[9] J. Hamari et al., "Does Gamification Work?," Proc. HICSS, 2014.
[10] A. N. Saleem et al., "Gamification Applications in E-Learning," Technology, Knowledge and Learning, 2022.
[11] D. Dicheva et al., "Gamification in Education: A Systematic Mapping Study," JETS, 2015.
[12] G. Lampropoulos & A. Sidiropoulos, "Impact of Gamification on Students' Learning Outcomes," Education Sciences, 2024.
[13] M. Sailer et al., "How Gamification Motivates," Computers in Human Behavior, 2017.

### Keamanan & Performa
[14] OWASP Foundation, "OWASP Top Ten Web Application Security Risks," 2021.
[15] Google, "Lighthouse — Web Performance Testing Tool," https://developers.google.com/web/tools/lighthouse
[16] Grafana Labs, "k6 — Open-source Load Testing Tool," https://k6.io

### Design Patterns
[17] E. Gamma et al., "Design Patterns: Elements of Reusable Object-Oriented Software," Addison-Wesley, 1994.
[18] M. Fowler, "Patterns of Enterprise Application Architecture," Addison-Wesley, 2002.
[19] S. Bloch, "Effective Java," 3rd ed., Addison-Wesley, 2018.
