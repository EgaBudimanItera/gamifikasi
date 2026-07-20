# API Overview — EduQuest REST API

## Base URL

```
Development: http://localhost:8000/api
Production:  https://api.eduquest.example.com/api
```

## Authentication

Semua endpoint memerlukan Sanctum token, kecuali:

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | /api/auth/login | Login |
| POST | /api/auth/register | Register (admin only) |
| POST | /api/auth/forgot-password | Request password reset |
| POST | /api/auth/reset-password | Reset password |

### Token Usage

```
Authorization: Bearer {token}
```

## Response Format

### Success

```json
{
  "success": true,
  "message": "Resource retrieved successfully",
  "data": { ... }
}
```

### Success (Paginated)

```json
{
  "success": true,
  "message": "Resources retrieved successfully",
  "data": [ ... ],
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 15,
    "total": 75
  }
}
```

### Error

```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "field": ["Error message"]
  }
}
```

## API Endpoints

### Authentication

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| POST | /api/auth/login | No | - | Login |
| POST | /api/auth/logout | Yes | * | Logout |
| POST | /api/auth/forgot-password | No | - | Request reset |
| POST | /api/auth/reset-password | No | - | Reset password |
| GET | /api/auth/user | Yes | * | Current user |

### Users Management (Admin)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/users | Yes | admin | List users |
| POST | /api/users | Yes | admin | Create user |
| GET | /api/users/{id} | Yes | admin | Show user |
| PUT | /api/users/{id} | Yes | admin | Update user |
| DELETE | /api/users/{id} | Yes | admin | Delete user |

### Schools (Admin)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/schools | Yes | admin | List schools |
| POST | /api/schools | Yes | admin | Create school |
| GET | /api/schools/{id} | Yes | admin | Show school |
| PUT | /api/schools/{id} | Yes | admin | Update school |
| DELETE | /api/schools/{id} | Yes | admin | Delete school |

### Academic Years (Admin)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/academic-years | Yes | admin | List years |
| POST | /api/academic-years | Yes | admin | Create year |
| PUT | /api/academic-years/{id} | Yes | admin | Update year |
| DELETE | /api/academic-years/{id} | Yes | admin | Delete year |

### Classes

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/classes | Yes | admin,guru | List classes |
| POST | /api/classes | Yes | admin | Create class |
| GET | /api/classes/{id} | Yes | admin,guru | Show class |
| PUT | /api/classes/{id} | Yes | admin | Update class |
| DELETE | /api/classes/{id} | Yes | admin | Delete class |
| GET | /api/classes/{id}/students | Yes | admin,guru | List students |

### Subjects

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/subjects | Yes | admin,guru | List subjects |
| POST | /api/subjects | Yes | admin | Create subject |
| GET | /api/subjects/{id} | Yes | admin,guru | Show subject |
| PUT | /api/subjects/{id} | Yes | admin | Update subject |
| DELETE | /api/subjects/{id} | Yes | admin | Delete subject |

### Class-Subject Assignments

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/class-subjects | Yes | admin | List assignments |
| POST | /api/class-subjects | Yes | admin | Assign teacher |
| DELETE | /api/class-subjects/{id} | Yes | admin | Remove assignment |

### Materials (FR-11 to FR-13)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/materials | Yes | admin,guru,siswa | List materials |
| POST | /api/materials | Yes | guru | Create material |
| GET | /api/materials/{id} | Yes | admin,guru,siswa | Show material |
| PUT | /api/materials/{id} | Yes | guru | Update material |
| DELETE | /api/materials/{id} | Yes | guru | Delete material |
| POST | /api/materials/{id}/publish | Yes | guru | Publish material |

### Assignments (FR-14 to FR-16)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/assignments | Yes | admin,guru,siswa | List assignments |
| POST | /api/assignments | Yes | guru | Create assignment |
| GET | /api/assignments/{id} | Yes | admin,guru,siswa | Show assignment |
| PUT | /api/assignments/{id} | Yes | guru | Update assignment |
| DELETE | /api/assignments/{id} | Yes | guru | Delete assignment |

### Submissions (FR-17, FR-20)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/assignments/{id}/submissions | Yes | guru | List submissions |
| POST | /api/assignments/{id}/submissions | Yes | siswa | Submit answer |
| GET | /api/submissions/{id} | Yes | guru,siswa | Show submission |
| POST | /api/submissions/{id}/revise | Yes | siswa | Revise submission |

### Grading (FR-18, FR-19)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| POST | /api/submissions/{id}/grade | Yes | guru | Grade submission |
| GET | /api/grades | Yes | guru | List grades |
| GET | /api/grades/{id} | Yes | guru,siswa | Show grade |

### Gamification — XP (FR-21 to FR-23)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/gamification/profile | Yes | siswa | My XP & level |
| GET | /api/gamification/xp-logs | Yes | siswa | XP history |
| POST | /api/gamification/xp/award | Yes | system | Award XP |

### Gamification — Badges (FR-24)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/badges | Yes | * | List all badges |
| GET | /api/gamification/my-badges | Yes | siswa | My badges |

### Gamification — Streak (FR-25, FR-26)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/gamification/streak | Yes | siswa | Current streak |
| POST | /api/gamification/streak/check-in | Yes | siswa | Daily check-in |

### Gamification — Quests (FR-27, FR-28)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/quests | Yes | * | List quests |
| POST | /api/quests | Yes | admin | Create quest |
| GET | /api/quests/{id} | Yes | * | Show quest |
| POST | /api/quests/{id}/accept | Yes | siswa | Accept quest |
| POST | /api/quests/{id}/complete | Yes | system | Complete quest |
| GET | /api/gamification/my-quests | Yes | siswa | My quest progress |

### Gamification — Leaderboard (FR-29, FR-30)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/leaderboard/class/{classId} | Yes | * | Class leaderboard |
| GET | /api/leaderboard/school | Yes | * | School leaderboard |

### Notifications (FR-31)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/notifications | Yes | * | List notifications |
| PUT | /api/notifications/{id}/read | Yes | * | Mark as read |
| PUT | /api/notifications/read-all | Yes | * | Mark all as read |

### Dashboard (FR-35, FR-36)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/dashboard/teacher | Yes | guru | Teacher dashboard |
| GET | /api/dashboard/student | Yes | siswa | Student dashboard |

### Analytics (FR-37, FR-38)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/analytics/completion | Yes | guru | Completion stats |
| GET | /api/analytics/engagement | Yes | guru | Engagement stats |
| GET | /api/analytics/activity | Yes | admin | Activity logs |

### Challenges (FR-33, FR-34)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/challenges/daily | Yes | siswa | Today's challenge |
| GET | /api/challenges/weekly | Yes | siswa | Weekly challenge |

### Reports (FR-40)

| Method | Endpoint | Auth | Role | Description |
|--------|----------|------|------|-------------|
| GET | /api/reports/export | Yes | admin,guru | Export report |
| GET | /api/reports/completion | Yes | admin,guru | Completion report |

## HTTP Status Codes

| Code | Description |
|------|-------------|
| 200 | Success |
| 201 | Created |
| 204 | No Content (Deleted) |
| 400 | Bad Request |
| 401 | Unauthorized |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Validation Error |
| 429 | Too Many Requests |
| 500 | Server Error |

## Rate Limits

| Endpoint | Limit |
|----------|-------|
| /api/auth/login | 5 requests/minute |
| /api/auth/register | 3 requests/minute |
| General API | 60 requests/minute |
