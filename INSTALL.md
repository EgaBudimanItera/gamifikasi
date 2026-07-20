# Installation Guide

## Prerequisites

### For Laragon/XAMPP
1. **PHP 8.1** - Pastikan PHP 8.1 terinstall di Laragon
2. **MySQL 8** - Jalankan MySQL dari Laragon
3. **Node.js 20** - Download dari https://nodejs.org
4. **Composer** - Download dari https://getcomposer.org

### For Docker
1. **Docker Desktop** - Download dari https://docker.com

## Setup Manual (Laragon/XAMPP)

### 1. Clone Repository

```bash
cd D:\laragon\www
git clone https://github.com/eduquest/gamifikasi.git
cd gamifikasi
```

### 2. Setup Backend

```bash
cd backend

# Install dependencies
composer install

# Copy environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 3. Setup Database

Buka phpMyAdmin atau MySQL CLI:

```sql
CREATE DATABASE eduquest CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Edit file `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eduquest
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations and seeder:
```bash
php artisan migrate --seed
```

### 4. Start Backend Server

```bash
php artisan serve --port=8000
```

Backend API tersedia di: http://localhost:8000/api

### 5. Setup Frontend

Buka terminal baru:

```bash
cd frontend

# Install dependencies
npm install

# Start development server
npm run dev
```

Frontend tersedia di: http://localhost:3000

## Setup dengan Docker

```bash
# Clone repository
git clone https://github.com/eduquest/gamifikasi.git
cd gamifikasi

# Build and start containers
docker-compose up -d

# Run migrations
docker-compose exec backend php artisan migrate --seed
```

## Verify Installation

1. Buka http://localhost:3000
2. Login dengan akun demo:
   - Email: siswa@eduquest.com
   - Password: password
3. Dashboard siswa harus muncul dengan data gamifikasi

## Troubleshooting

### PHP Extension Missing
Pastikan ekstensi berikut aktif di php.ini:
- openssl
- pdo_mysql
- mbstring
- xml
- curl
- zip

### Port Already in Use
```bash
# Check port usage
netstat -ano | findstr :8000

# Kill process
taskkill /PID <process_id> /F
```

### Database Connection Error
Pastikan MySQL berjalan dan kredensial di `.env` benar.
