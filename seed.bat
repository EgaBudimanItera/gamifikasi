@echo off
echo ============================================
echo   EduQuest - Reset & Seed Database
echo ============================================
echo.

cd /d D:\laragon\www\gamifikasi\backend

echo Running migration:fresh --seed ...
php artisan migrate:fresh --seed --force

echo.
echo ============================================
echo   Database seeded successfully!
echo ============================================
echo.
pause
