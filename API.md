# API Documentation

## Base URL
```
http://localhost:8000/api
```

## Authentication

### Login
```
POST /api/auth/login
Content-Type: application/json

{
  "email": "siswa@eduquest.com",
  "password": "password"
}

Response 200:
{
  "success": true,
  "data": {
    "user": { "id": 1, "name": "Budi", "role": "siswa" },
    "token": "1|abc123..."
  }
}
```

### Logout
```
POST /api/auth/logout
Authorization: Bearer {token}

Response 200:
{
  "success": true,
  "message": "Logout berhasil"
}
```

## Class-Subject Assignment (Admin)

### List All Assignments
```
GET /api/class-subject-assignments?class_id=1&teacher_id=2
Authorization: Bearer {token}
```

### Create Assignment (Assign Teacher to Class + Subject)
```
POST /api/class-subject-assignments
Authorization: Bearer {token}

{
  "class_id": 1,
  "subject_id": 1,
  "user_id": 2
}

Response 201:
{
  "success": true,
  "message": "Guru berhasil ditugaskan ke kelas dan mata pelajaran",
  "data": {
    "class_id": 1,
    "subject_id": 1,
    "user_id": 2,
    "class": { "id": 1, "name": "XII RPL 1" },
    "subject": { "id": 1, "name": "Pemrograman Web" },
    "teacher": { "id": 2, "name": "Pak Ahmad" }
  }
}
```

### Get Subjects in a Class
```
GET /api/classes/{class}/subjects
Authorization: Bearer {token}

Response 200:
{
  "success": true,
  "data": [
    {
      "subject": { "id": 1, "name": "Pemrograman Web" },
      "teacher": { "id": 2, "name": "Pak Ahmad" }
    }
  ]
}
```

### My Subjects (Guru)
```
GET /api/my-subjects
Authorization: Bearer {token}

Response 200:
{
  "success": true,
  "data": [
    {
      "class_name": "XII RPL 1",
      "class_id": 1,
      "subjects": [
        { "id": 1, "name": "Pemrograman Web", "code": "PW-12" }
      ]
    }
  ]
}
```

## Dashboard

### Student Dashboard
```
GET /api/dashboard/student
Authorization: Bearer {token}

Response 200:
{
  "data": {
    "profile": {
      "total_xp": 250,
      "current_level": 2,
      "current_streak": 5,
      "xp_for_next_level": 400,
      "xp_progress": 62
    },
    "xp_breakdown": {
      "assignment": 150,
      "login": 40,
      "streak": 100,
      "quest": 60,
      "penalty": 0
    },
    "my_classes": ["XII RPL 1"],
    "completed_assignments": 8,
    "pending_submissions": 2,
    "score_average": 82.5,
    "total_badges": 3,
    "active_quests": 2
  }
}
```

### Teacher Dashboard
```
GET /api/dashboard/teacher
Authorization: Bearer {token}

Response 200:
{
  "data": {
    "total_students": 35,
    "active_assignments": 5,
    "total_materials": 6,
    "teachings": [
      {
        "class_name": "XII RPL 1",
        "subjects": ["Pemrograman Web", "Basis Data"]
      }
    ]
  }
}
```

## Gamification

### Profile
```
GET /api/gamification/profile
Authorization: Bearer {token}

Response 200:
{
  "data": {
    "total_xp": 250,
    "current_level": 2,
    "current_streak": 5,
    "longest_streak": 12,
    "xp_for_next_level": 400,
    "xp_progress": 62
  }
}
```

### Check-in (Streak)
```
POST /api/gamification/streak/check-in
Authorization: Bearer {token}

Response 200:
{
  "message": "Check-in berhasil! Streak: 6 hari",
  "data": {
    "current_streak": 6,
    "xp_earned": 10
  }
}
```

### XP Logs
```
GET /api/gamification/xp-logs?page=1
Authorization: Bearer {token}
```

### My Badges
```
GET /api/gamification/my-badges
Authorization: Bearer {token}
```

### My Quests
```
GET /api/gamification/my-quests?page=1
Authorization: Bearer {token}
```

## Assignments

### List Assignments
```
GET /api/assignments?subject_id=1
Authorization: Bearer {token}
```

### Create Assignment (Guru)
```
POST /api/assignments
Authorization: Bearer {token}

{
  "subject_id": 1,
  "title": "Latihan CSS",
  "description": "Buatlah layout menggunakan CSS Grid",
  "xp_reward": 50,
  "deadline": "2025-01-20T23:59:00"
}
```

### Submit Answer (Siswa)
```
POST /api/assignments/{id}/submissions
Authorization: Bearer {token}

{
  "answer_text": "Ini jawaban saya..."
}
```

### Grade Submission (Guru)
```
POST /api/submissions/{id}/grade
Authorization: Bearer {token}

{
  "score": 85,
  "feedback": "Bagus, pertahankan!"
}
```

## Leaderboard

### Class Leaderboard
```
GET /api/leaderboard/class/{classId}
Authorization: Bearer {token}

Response 200:
{
  "data": [
    { "rank": 1, "name": "Ahmad", "total_xp": 1250, "level": 4 },
    { "rank": 2, "name": "Siti", "total_xp": 980, "level": 3 }
  ]
}
```

### School Leaderboard
```
GET /api/leaderboard/school
Authorization: Bearer {token}
```

## Notifications

```
GET /api/notifications
PUT /api/notifications/{id}/read
PUT /api/notifications/read-all
```

## HTTP Status Codes

| Code | Description |
|------|-------------|
| 200 | Success |
| 201 | Created |
| 400 | Bad Request |
| 401 | Unauthorized |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Validation Error |
| 500 | Server Error |
