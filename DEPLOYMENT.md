# Deployment Guide

## Option 1: Docker Deployment

### Prerequisites
- Docker Desktop installed
- Docker Compose available

### Steps

```bash
# Clone repository
git clone https://github.com/eduquest/gamifikasi.git
cd gamifikasi

# Build and start all services
docker-compose up -d --build

# Run database migrations
docker-compose exec backend php artisan migrate --seed

# Generate API keys
docker-compose exec backend php artisan key:generate
docker-compose exec backend php artisan config:cache
```

### Services

| Service | Port | Description |
|---------|------|-------------|
| frontend | 3000 | Next.js App |
| backend | 8000 | Laravel API |
| mysql | 3306 | Database |

### Verify

```bash
# Check running containers
docker-compose ps

# Check logs
docker-compose logs -f backend
```

## Option 2: Manual Deployment (Laragon/XAMPP)

### Backend Setup

1. Copy `backend/` folder to `D:\laragon\www\eduquest-backend\`
2. Configure Apache vhost in Laragon:
```apache
<VirtualHost *:80>
    ServerName eduquest-api.test
    DocumentRoot "D:/laragon/www/eduquest-backend/public"
    <Directory "D:/laragon/www/eduquest-backend/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

3. Run commands:
```bash
cd D:\laragon\www\eduquest-backend
composer install --optimize-autoloader --no-dev
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan config:cache
php artisan route:cache
```

### Frontend Setup

1. Copy `frontend/` folder to `D:\laragon\www\eduquest-frontend\`
2. Build for production:
```bash
cd D:\laragon\www\eduquest-frontend
npm install
npm run build
```

3. Configure Nginx/Apache to serve `.next` output or use `npm start`.

## Option 3: Cloud Deployment (VPS)

### Server Requirements
- Ubuntu 22.04 LTS
- PHP 8.1 + extensions
- MySQL 8
- Node.js 20
- Nginx
- Composer
- PM2 (process manager)

### Setup Script

```bash
#!/bin/bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP
sudo apt install -y php8.1 php8.1-fpm php8.1-mysql php8.1-mbstring php8.1-xml php8.1-curl php8.1-zip

# Install MySQL
sudo apt install -y mysql-server

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs

# Install Composer
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

# Clone and setup project
cd /var/www
git clone https://github.com/eduquest/gamifikasi.git
cd gamifikasi/backend
composer install --optimize-autoloader --no-dev
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan config:cache

# Setup Nginx
sudo tee /etc/nginx/sites-available/eduquest <<EOF
server {
    listen 80;
    server_name api.eduquest.example.com;
    root /var/www/gamifikasi/backend/public;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        include fastcgi_params;
    }
}
EOF

sudo ln -s /etc/nginx/sites-available/eduquest /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx

# Setup PM2
pm2 start "php artisan serve --host=0.0.0.0 --port=8000" --name eduquest-api
pm2 save
```

## Environment Variables

### Backend (.env)
```env
APP_NAME=EduQuest
APP_ENV=production
APP_KEY=base64:...
APP_DEBUG=false
APP_URL=https://api.eduquest.example.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eduquest
DB_USERNAME=eduquest
DB_PASSWORD=secure_password

SANCTUM_STATEFUL_DOMAINS=eduquest.example.com
```

### Frontend (.env.local)
```env
NEXT_PUBLIC_API_URL=https://api.eduquest.example.com/api
NEXT_PUBLIC_APP_NAME=EduQuest
```

## SSL Setup (Let's Encrypt)

```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d api.eduquest.example.com
sudo certbot --nginx -d eduquest.example.com
```

## Backup Strategy

### Database Backup
```bash
# Daily backup
mysqldump -u root eduquest | gzip > /backup/eduquest_$(date +%Y%m%d).sql.gz

# Add to crontab
0 2 * * * /usr/local/bin/backup-eduquest.sh
```

### Application Backup
```bash
tar -czf /backup/eduquest-app_$(date +%Y%m%d).tar.gz /var/www/gamifikasi
```
