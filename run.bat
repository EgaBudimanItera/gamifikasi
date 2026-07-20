@echo off
echo ============================================
echo   EduQuest - Starting All Services
echo ============================================
echo.

:: Start Backend
echo [1/2] Starting Backend (Laravel)...
start "EduQuest Backend" cmd /k "cd /d %~dp0backend && php artisan serve --port=8000"

:: Start Frontend
echo [2/2] Starting Frontend (Next.js)...
start "EduQuest Frontend" cmd /k "cd /d %~dp0frontend && npx next dev -p 3000 -H 0.0.0.0"

echo.
echo ============================================
echo   Services Started!
echo   Backend:  http://localhost:8000
echo   Frontend: http://localhost:3000
echo ============================================
echo.
pause
