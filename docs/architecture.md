# Architecture Document — EduQuest Gamified Learning Platform

## 1. Executive Summary

EduQuest dirancang sebagai monorepo dengan frontend Next.js 15 dan backend Laravel 10 REST API. Arsitektur mengadopsi pendekatan **separated deployment** untuk kompatibilitas dengan Lingkungan Laragon/XAMPP.

## 2. High-Level Architecture

```
┌─────────────────────────────────────────────────┐
│                   CLIENT                         │
│  ┌───────────────────────────────────────────┐   │
│  │         Next.js 15 Frontend               │   │
│  │  (TypeScript + Tailwind + shadcn/ui)      │   │
│  └──────────────────┬────────────────────────┘   │
│                     │ HTTP/HTTPS                  │
├─────────────────────┼───────────────────────────┤
│                   API Layer                      │
│  ┌──────────────────┴────────────────────────┐   │
│  │        Laravel 10 REST API                 │   │
│  │  (Sanctum Auth + Repository Pattern)       │   │
│  └──────────────────┬────────────────────────┘   │
│                     │                             │
├─────────────────────┼───────────────────────────┤
│                Data Layer                        │
│  ┌──────────────────┴────────────────────────┐   │
│  │              MySQL 8                       │   │
│  └───────────────────────────────────────────┘   │
└─────────────────────────────────────────────────┘
```

## 3. Monorepo Structure

```
gamifikasi/
├── backend/                  # Laravel 10 API
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/  # API Controllers
│   │   │   ├── Middleware/    # Auth, Role, Audit
│   │   │   ├── Requests/     # Form Request Validation
│   │   │   └── Resources/    # API Resources
│   │   ├── Models/           # Eloquent Models
│   │   ├── Services/
│   │   │   ├── Gamification/ # XP, Level, Badge, Streak, Quest, Leaderboard
│   │   │   └── Analytics/    # Dashboard, Statistics
│   │   └── Repositories/     # Repository Pattern
│   ├── config/
│   ├── database/
│   │   ├── migrations/       # Database Schema
│   │   └── seeders/          # Data Seeder
│   ├── routes/
│   │   └── api.php           # API Routes
│   ├── tests/
│   │   └── Unit/             # PHPUnit Tests
│   └── composer.json
├── frontend/                 # Next.js 15
│   ├── src/
│   │   ├── app/              # App Router
│   │   ├── components/       # Reusable Components
│   │   ├── lib/              # Utilities
│   │   ├── services/         # API Client
│   │   └── types/            # TypeScript Types
│   ├── public/
│   └── package.json
├── docs/                     # Documentation
│   ├── architecture.md
│   ├── api-overview.md
│   └── erd.md
├── research/                 # Research Artifacts
│   ├── requirements/
│   ├── user-stories/
│   ├── bdd/
│   ├── instruments/
│   ├── analysis/
│   └── thesis/
├── tests/
│   ├── bdd/                  # Gherkin Features
│   └── e2e/                  # Playwright Tests
├── docker-compose.yml
├── PRD.md
├── AGENTS.md
└── README.md
```

## 4. Backend Architecture (Laravel 10)

### 4.1 Layered Architecture

```
┌──────────────────────────────────────┐
│           Routes (api.php)           │
├──────────────────────────────────────┤
│       Middleware (Auth, Role)         │
├──────────────────────────────────────┤
│     Controllers (HTTP Layer)         │
├──────────────────────────────────────┤
│  Form Requests (Validation Layer)    │
├──────────────────────────────────────┤
│    Services (Business Logic)         │
├──────────────────────────────────────┤
│  Repositories (Data Access Layer)    │
├──────────────────────────────────────┤
│    Eloquent Models (ORM Layer)       │
├──────────────────────────────────────┤
│         MySQL Database               │
└──────────────────────────────────────┘
```

### 4.2 Authentication Flow

```
Client ──POST /api/auth/login──► Laravel Sanctum
                                      │
                              ┌───────┴───────┐
                              │  Validate     │
                              │  Credentials  │
                              └───────┬───────┘
                                      │
                              ┌───────┴───────┐
                              │  Create Token │
                              │  (Sanctum)    │
                              └───────┬───────┘
                                      │
                              ┌───────┴───────┐
                              │  Return Token │
                              │  + User Data  │
                              └───────────────┘
```

### 4.3 Role-Based Access Control

| Role    | Access Level                                    |
|---------|------------------------------------------------|
| admin   | Full access: manage users, school data, reports, class-subject assignments |
| guru    | Manage materials, assignments, grades for assigned subjects/classes |
| siswa   | View materials, submit assignments, view XP, view classes enrolled |

### 4.4 Gamification Engine

```
┌─────────────────────────────────────────────────────────────────────┐
│                        GamificationEngine                           │
├─────────────────────────────────────────────────────────────────────┤
│  ┌──────────┐ ┌──────────┐ ┌───────────┐ ┌──────────┐ ┌────────┐  │
│  │XP Engine │ │Level     │ │Badge      │ │Streak    │ │Quest   │  │
│  │          │ │Engine    │ │Engine     │ │Engine    │ │Engine  │  │
│  └────┬─────┘ └────┬─────┘ └─────┬─────┘ └────┬─────┘ └───┬────┘  │
│       │            │             │             │           │        │
│  ┌────┴─────┐ ┌────┴─────┐ ┌────┴──────┐ ┌───┴──────┐ ┌──┴────┐  │
│  │Leaderboard│ │NPC Mentor│ │Guild      │ │Adaptive  │ │Reading│  │
│  │Engine    │ │Affinity  │ │Collab     │ │Challenge │ │Engine │  │
│  │          │ │Engine    │ │Reward     │ │Quiz      │ │       │  │
│  └──────────┘ └──────────┘ └───────────┘ └──────────┘ └───────┘  │
│                                                                     │
│  ┌─────────────────────────────────────────────────────────────┐   │
│  │              Analytics & Logs Engine                        │   │
│  │  (Activity Logs, Daily/Weekly Challenges, Export Reports)   │   │
│  └─────────────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────────────┘
```

### 4.5 NPC Mentor Affinity Engine

```
┌─────────────────────────────────────────────────────────────────┐
│                        NpcService                               │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│  1. Random Encounter (33% chance per material read)             │
│  2. Create UserNpcAffinity (level=1, xp=0)                     │
│  3. Quest Gating: required_affinity_level <= affinity_level     │
│  4. Quest Completion:                                           │
│     - Award XP via XpService                                    │
│     - Calculate MAS:                                            │
│       MAS_baru = MAS_lama                                       │
│         + (Quest × 0.50)          // penyelesaian quest         │
│         + (Konsistensi × 0.20)    // login harian               │
│         + (Ketepatan × 0.15)      // sebelum deadline           │
│         + (Performa × 0.15)       // skor quiz                  │
│     - Recalculate affinity_level                                │
│  5. Level Thresholds: [0, 5, 15, 30, 50] → Level 1-5          │
│                                                                 │
│  Adaptivity: Higher MAS → harder quests → more XP               │
└─────────────────────────────────────────────────────────────────┘
```

### 4.6 Guild Collaborative Reward Engine

```
┌─────────────────────────────────────────────────────────────────┐
│                        GuildService                              │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│  1. Create/Join Guild (max 5 members, class-scoped)             │
│  2. XP Contribution (dual-write):                               │
│     - guild.total_guild_xp += amount                            │
│     - member.contributed_xp += amount                           │
│  3. Guild Target:                                               │
│     - Target mingguan: 50 quest selesai                         │
│     - Jika tercapai:                                            │
│       • +150 XP untuk seluruh anggota                           │
│       • Guild Chest (randomized reward)                         │
│       • Bonus 10% XP selama 24 jam                              │
│  4. Guild Leaderboard: sort by total_guild_xp DESC              │
│  5. Leader Transfer: oldest member when leader leaves            │
│  6. Guild Quest: collaborative progress tracking                 │
│  7. Adaptive Challenge Quiz Guild Mode:                          │
│     15min, 10 hard questions, 75 XP                              │
│                                                                 │
│  Manfaat: Kolaborasi, gotong royong, kompetisi sehat inter-guild│
└─────────────────────────────────────────────────────────────────┘
```

## 5. Database Design Summary

### 5.1 Core Tables

| Table              | Purpose                                    |
|--------------------|--------------------------------------------|
| users              | All users (admin, guru, siswa)             |
| roles              | Role definitions                           |
| schools            | School data                                |
| academic_years     | Tahun ajaran                               |
| classes            | Kelas                                      |
| subjects           | Mata pelajaran                             |
| class_subject      | Pivot: teacher-class-subject assignment    |
| student_classes    | Pivot: student-class enrollment            |

### 5.2 Learning Tables

| Table              | Purpose                                    |
|--------------------|--------------------------------------------|
| materials          | Materi pembelajaran                        |
| assignments        | Tugas                                      |
| submissions        | Jawaban siswa                              |
| grades             | Penilaian                                  |

### 5.3 Gamification Tables

| Table              | Purpose                                    |
|--------------------|--------------------------------------------|
| user_profiles      | XP, level, streak data                     |
| xp_logs            | History pemberian/pengurangan XP            |
| badges             | Definisi badge                             |
| user_badges        | Badge yang dimiliki user                   |
| streaks            | Data streak harian                         |
| quests             | Quest definitions                          |
| user_quests        | Quest progress per user                    |
| leaderboard_cache  | Cache leaderboard                          |
| notifications      | Reward notifications                       |

### 5.4 NPC Mentor Tables

| Table                 | Purpose                                    |
|-----------------------|--------------------------------------------|
| npcs                  | NPC mentor definitions                     |
| npc_quests            | Quest definitions per NPC (with required_affinity_level) |
| user_npc_affinity     | Mentor Affinity Score (MAS) per user-NPC pair |
| reading_materials     | Materi bacaan dengan tracking              |
| reading_progress      | Progress baca siswa per materi             |
| reading_quizzes       | Quiz singkat setelah baca materi           |

### 5.5 Guild Tables

| Table              | Purpose                                    |
|--------------------|--------------------------------------------|
| guilds             | Guild definitions (name, leader, XP)       |
| guild_members      | Keanggotaan guild (role, contributed_xp)   |
| guild_quests       | Quest bersama guild                        |

### 5.6 Quick Quiz Liga Tables

| Table                    | Purpose                                    |
|--------------------------|--------------------------------------------|
| league_quiz_sessions     | Sesi quiz (class/guild mode)               |
| league_quiz_questions    | Soal per sesi                              |
| league_quiz_participants | Peserta dan hasil quiz                     |

### 5.7 Analytics Tables

| Table              | Purpose                                    |
|--------------------|--------------------------------------------|
| activity_logs      | Audit trail aktivitas                      |
| daily_challenges   | Challenge harian                           |
| weekly_challenges  | Challenge mingguan                         |

## 6. API Design Principles

- RESTful conventions
- JSON:API response format
- Consistent error responses
- Pagination on list endpoints
- Sanctum token-based authentication
- Rate limiting on public endpoints

## 7. Security Measures

- CSRF protection via Sanctum
- SQL injection prevention via Eloquent
- XSS prevention via output encoding
- Rate limiting on auth endpoints
- Audit logging on sensitive operations
- Password hashing via bcrypt

## 8. Deployment Strategy

### Laragon/XAMPP (Development)

```
Laragon/
├── www/
│   └── gamifikasi/
│       ├── backend/    ← PHP 8.1 built-in or Apache vhost
│       └── frontend/   ← Node.js dev server (port 3000)
└── mysql/              ← MySQL 8
```

### Docker (Production/Staging)

```yaml
services:
  backend:   PHP 8.1 + Apache
  frontend:  Node.js 20 + Next.js
  mysql:     MySQL 8.0
```

## 9. Performance Considerations

- Database indexing on frequently queried columns
- Eager loading to prevent N+1 queries
- Leaderboard caching with Redis/file cache
- API response compression
- Frontend image optimization
- Lazy loading on dashboard components

## 10. Scalability Notes

- Repository pattern allows easy data source swapping
- Service layer enables horizontal scaling
- Stateless API allows multiple backend instances
- Cache layer can be upgraded to Redis in production
- Queue system ready for background jobs
