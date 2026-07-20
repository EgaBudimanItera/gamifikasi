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
┌─────────────────────────────────────────────┐
│          GamificationService                 │
├─────────────────────────────────────────────┤
│  ┌─────────┐ ┌─────────┐ ┌─────────────┐   │
│  │XP Engine│ │Level    │ │Badge Engine │   │
│  │         │ │Engine   │ │             │   │
│  └────┬────┘ └────┬────┘ └──────┬──────┘   │
│       │           │             │           │
│  ┌────┴────┐ ┌────┴────┐ ┌─────┴──────┐   │
│  │Streak   │ │Quest    │ │Leaderboard │   │
│  │Engine   │ │Engine   │ │Engine      │   │
│  └─────────┘ └─────────┘ └────────────┘   │
└─────────────────────────────────────────────┘
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

### 5.4 Analytics Tables

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
