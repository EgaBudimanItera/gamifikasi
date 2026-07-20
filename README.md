# EduQuest - Gamified Learning Platform

Platform pembelajaran berbasis web yang menerapkan gamifikasi untuk meningkatkan motivasi, keterlibatan, dan ketepatan penyelesaian tugas siswa SMA/SMK pada Kurikulum Merdeka.

## Tech Stack

- **Frontend:** Next.js 15, TypeScript, Tailwind CSS
- **Backend:** Laravel 10, PHP 8.1, Laravel Sanctum
- **Database:** MySQL 8
- **DevOps:** Docker Compose

## Fitur Utama

### Learning Management
- Kelola kelas, mata pelajaran, materi, dan tugas
- Upload jawaban dan penilaian online
- Feedback dari guru

### Gamification
- **XP System:** Dapatkan XP untuk setiap aktivitas
- **Level System:** Level = floor(sqrt(total_xp / 100)) + 1
- **Badge:** Kumpulkan badge pencapaian
- **Streak:** Jaga konsistensi login harian
- **Quest:** Selesaikan tantangan harian dan mingguan
- **Leaderboard:** Bersaing dengan siswa lain

### Analytics
- Dashboard guru dan siswa
- Statistik penyelesaian dan engagement
- Audit trail aktivitas

## Quick Start

### Prerequisites
- PHP 8.1
- Node.js 20
- MySQL 8
- Composer

### Installation

```bash
# Clone repository
git clone https://github.com/eduquest/gamifikasi.git
cd gamifikasi

# Setup Backend
cd backend
composer install
cp .env.example .env
php artisan key:generate

# Setup Database
mysql -u root -e "CREATE DATABASE eduquest"
php artisan migrate --seed

# Start Backend
php artisan serve --port=8000

# Setup Frontend (new terminal)
cd frontend
npm install
npm run dev
```

### Access
- Frontend: http://localhost:3000
- Backend API: http://localhost:8000/api

### Demo Accounts
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@eduquest.com | password |
| Guru | guru@eduquest.com | password |
| Siswa | siswa@eduquest.com | password |

## Project Structure

```
gamifikasi/
├── backend/          # Laravel 10 API
├── frontend/         # Next.js 15
├── docs/             # Documentation
├── research/         # Research Artifacts
├── tests/            # BDD & E2E Tests
└── docker-compose.yml
```

## Documentation

- [Architecture](docs/architecture.md)
- [API Overview](docs/api-overview.md)
- [ERD](docs/erd.md)
- [Installation Guide](INSTALL.md)
- [API Documentation](API.md)
- [Deployment Guide](DEPLOYMENT.md)
