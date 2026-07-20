# ERD — EduQuest Database Schema

## Entity Relationship Diagram

```mermaid
erDiagram
    users ||--o{ user_profiles : has
    users ||--o{ xp_logs : earns
    users ||--o{ user_badges : owns
    users ||--o{ streaks : tracks
    users ||--o{ user_quests : participates
    users ||--o{ submissions : submits
    users ||--o{ activity_logs : performs
    users ||--o{ notifications : receives
    users }o--|| roles : has
    users }o--o| schools : belongs_to

    schools ||--o{ classes : has
    schools ||--o{ academic_years : has
    schools ||--o{ users : contains

    classes ||--o{ student_classes : enrolls
    classes ||--o{ class_subject : assigned
    classes }o--|| academic_years : belongs_to

    subjects ||--o{ class_subject : assigned
    subjects ||--o{ materials : has
    subjects ||--o{ assignments : has

    class_subject }o--|| classes : references
    class_subject }o--|| subjects : references
    class_subject }o--|| users : teacher

    student_classes }o--|| users : references
    student_classes }o--|| classes : references

    materials }o--|| subjects : belongs_to
    materials }o--|| users : created_by
    materials }o--o| classes : scoped_to

    assignments }o--|| subjects : belongs_to
    assignments }o--|| users : created_by
    assignments }o--o| classes : scoped_to
    assignments ||--o{ submissions : receives
    assignments ||--o{ user_quests : linked

    submissions }o--|| users : by_student
    submissions }o--|| assignments : for_assignment
    submissions ||--o| grades : has

    grades }o--|| submissions : scores
    grades }o--|| users : graded_by

    user_profiles }o--|| users : belongs_to
    user_profiles ||--o{ xp_logs : tracked_by

    xp_logs }o--|| users : for_user
    xp_logs }o--| user_profiles : updates

    badges ||--o{ user_badges : awarded
    user_badges }o--|| users : belongs_to
    user_badges }o--|| badges : references

    streaks }o--|| users : belongs_to

    quests ||--o{ user_quests : assigned
    user_quests }o--|| users : belongs_to
    user_quests }o--|| quests : references
    user_quests }o--| assignments : optional_link

    notifications }o--|| users : for_user

    activity_logs }o--|| users : by_user

    daily_challenges ||--o{ user_quests : generates
    weekly_challenges ||--o{ user_quests : generates
```

## Table Definitions

### users
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| name | VARCHAR(255) | Full name |
| email | VARCHAR(255) UNIQUE | Email address |
| password | VARCHAR(255) | Hashed password |
| role_id | BIGINT FK | References roles.id |
| school_id | BIGINT FK Nullable | References schools.id |
| avatar | VARCHAR(255) Nullable | Profile photo path |
| email_verified_at | TIMESTAMP Nullable | Email verification |
| remember_token | VARCHAR(100) Nullable | Remember me token |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### roles
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| name | VARCHAR(50) | admin, guru, siswa |
| description | VARCHAR(255) | Role description |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### schools
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| name | VARCHAR(255) | School name |
| address | TEXT Nullable | School address |
| phone | VARCHAR(20) Nullable | Phone number |
| email | VARCHAR(255) Nullable | School email |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### academic_years
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| school_id | BIGINT FK | References schools.id |
| name | VARCHAR(50) | e.g. "2024/2025" |
| start_date | DATE | Year start |
| end_date | DATE | Year end |
| is_active | BOOLEAN | Active year flag |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### classes
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| school_id | BIGINT FK | References schools.id |
| academic_year_id | BIGINT FK | References academic_years.id |
| name | VARCHAR(50) | e.g. "XII RPL 1" |
| grade_level | SMALLINT | Grade 7-12 |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### subjects
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| school_id | BIGINT FK | References schools.id |
| name | VARCHAR(100) | Subject name |
| code | VARCHAR(20) UNIQUE | Subject code |
| description | TEXT Nullable | Description |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### class_subject
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| class_id | BIGINT FK | References classes.id |
| subject_id | BIGINT FK | References subjects.id |
| user_id | BIGINT FK | Teacher user_id (guru role) |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### student_classes
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| user_id | BIGINT FK | Student user_id |
| class_id | BIGINT FK | References classes.id |
| created_at | TIMESTAMP | Created timestamp |

### materials
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| class_id | BIGINT FK Nullable | References classes.id (scope) |
| subject_id | BIGINT FK | References subjects.id |
| user_id | BIGINT FK | Teacher who created |
| title | VARCHAR(255) | Material title |
| content | TEXT | Material content (HTML) |
| file_path | VARCHAR(255) Nullable | Attached file |
| is_published | BOOLEAN | Publication status |
| published_at | TIMESTAMP Nullable | Publish timestamp |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### assignments
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| class_id | BIGINT FK Nullable | References classes.id (scope) |
| subject_id | BIGINT FK | References subjects.id |
| user_id | BIGINT FK | Teacher who created |
| title | VARCHAR(255) | Assignment title |
| description | TEXT | Assignment description |
| max_score | DECIMAL(5,2) | Maximum score |
| xp_reward | INT | XP for completion |
| deadline | TIMESTAMP | Submission deadline |
| is_published | BOOLEAN | Publication status |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### submissions
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| assignment_id | BIGINT FK | References assignments.id |
| user_id | BIGINT FK | Student user_id |
| file_path | VARCHAR(255) Nullable | Submitted file |
| answer_text | TEXT Nullable | Text answer |
| submitted_at | TIMESTAMP | Submission timestamp |
| status | ENUM | pending, graded, revised |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### grades
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| submission_id | BIGINT FK | References submissions.id |
| user_id | BIGINT FK | Teacher who graded |
| score | DECIMAL(5,2) | Given score |
| feedback | TEXT Nullable | Teacher feedback |
| graded_at | TIMESTAMP | Grading timestamp |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### user_profiles
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| user_id | BIGINT FK UNIQUE | References users.id |
| total_xp | INT DEFAULT 0 | Accumulated XP |
| current_level | INT DEFAULT 1 | Current level |
| current_streak | INT DEFAULT 0 | Consecutive days |
| longest_streak | INT DEFAULT 0 | Best streak record |
| last_login_at | TIMESTAMP Nullable | Last login |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### xp_logs
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| user_id | BIGINT FK | References users.id |
| user_profile_id | BIGINT FK | References user_profiles.id |
| amount | INT | XP amount (+/-) |
| type | ENUM | assignment, login, streak, quest, penalty |
| description | VARCHAR(255) | Description |
| reference_id | BIGINT Nullable | Related entity ID |
| reference_type | VARCHAR(100) Nullable | Related entity type |
| created_at | TIMESTAMP | Created timestamp |

### badges
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| name | VARCHAR(100) | Badge name |
| description | TEXT | Badge description |
| icon | VARCHAR(255) | Badge icon path |
| category | ENUM | achievement, streak, rank, special |
| criteria | JSON | Achievement criteria |
| xp_reward | INT | XP for earning badge |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### user_badges
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| user_id | BIGINT FK | References users.id |
| badge_id | BIGINT FK | References badges.id |
| earned_at | TIMESTAMP | When earned |
| created_at | TIMESTAMP | Created timestamp |

### streaks
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| user_id | BIGINT FK | References users.id |
| date | DATE | Streak date |
| login_count | INT | Logins that day |
| activities | JSON | Activity summary |
| created_at | TIMESTAMP | Created timestamp |

### quests
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| title | VARCHAR(255) | Quest title |
| description | TEXT | Quest description |
| type | ENUM | daily, weekly, special |
| xp_reward | INT | XP reward |
| badge_id | BIGINT FK Nullable | Bonus badge |
| criteria | JSON | Completion criteria |
| start_date | TIMESTAMP Nullable | Quest start |
| end_date | TIMESTAMP Nullable | Quest end |
| is_active | BOOLEAN | Active status |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### user_quests
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| user_id | BIGINT FK | References users.id |
| quest_id | BIGINT FK | References quests.id |
| assignment_id | BIGINT FK Nullable | Optional link |
| status | ENUM | active, completed, failed |
| progress | INT DEFAULT 0 | Progress percentage |
| completed_at | TIMESTAMP Nullable | Completion time |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### leaderboard_cache
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| user_id | BIGINT FK | References users.id |
| class_id | BIGINT FK Nullable | Class scope |
| scope | ENUM | class, school |
| period | ENUM | weekly, monthly, all_time |
| total_xp | INT | XP in period |
| rank | INT | Ranking position |
| cached_at | TIMESTAMP | Cache timestamp |

### notifications
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| user_id | BIGINT FK | References users.id |
| title | VARCHAR(255) | Notification title |
| message | TEXT | Notification content |
| type | ENUM | reward, achievement, system |
| data | JSON Nullable | Extra data |
| read_at | TIMESTAMP Nullable | Read timestamp |
| created_at | TIMESTAMP | Created timestamp |

### activity_logs
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| user_id | BIGINT FK | References users.id |
| action | VARCHAR(100) | Action performed |
| entity_type | VARCHAR(100) Nullable | Entity type |
| entity_id | BIGINT Nullable | Entity ID |
| description | TEXT | Description |
| ip_address | VARCHAR(45) Nullable | Client IP |
| user_agent | TEXT Nullable | Browser info |
| created_at | TIMESTAMP | Created timestamp |

### daily_challenges
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| title | VARCHAR(255) | Challenge title |
| description | TEXT | Description |
| criteria | JSON | Completion criteria |
| xp_reward | INT | XP reward |
| date | DATE | Challenge date |
| is_active | BOOLEAN | Active status |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

### weekly_challenges
| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT PK | Auto-increment |
| title | VARCHAR(255) | Challenge title |
| description | TEXT | Description |
| criteria | JSON | Completion criteria |
| xp_reward | INT | XP reward |
| week_start | DATE | Week start |
| week_end | DATE | Week end |
| is_active | BOOLEAN | Active status |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |

## Indexes

```sql
-- Performance indexes
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_role_id ON users(role_id);
CREATE INDEX idx_users_school_id ON users(school_id);
CREATE INDEX idx_classes_school_id ON classes(school_id);
CREATE INDEX idx_classes_academic_year_id ON classes(academic_year_id);
CREATE INDEX idx_class_subject_class_id ON class_subject(class_id);
CREATE INDEX idx_class_subject_subject_id ON class_subject(subject_id);
CREATE INDEX idx_materials_subject_id ON materials(subject_id);
CREATE INDEX idx_assignments_subject_id ON assignments(subject_id);
CREATE INDEX idx_assignments_deadline ON assignments(deadline);
CREATE INDEX idx_submissions_assignment_id ON submissions(assignment_id);
CREATE INDEX idx_submissions_user_id ON submissions(user_id);
CREATE INDEX idx_xp_logs_user_id ON xp_logs(user_id);
CREATE INDEX idx_xp_logs_created_at ON xp_logs(created_at);
CREATE INDEX idx_user_badges_user_id ON user_badges(user_id);
CREATE INDEX idx_streaks_user_id ON streaks(user_id);
CREATE INDEX idx_streaks_date ON streaks(date);
CREATE INDEX idx_user_quests_user_id ON user_quests(user_id);
CREATE INDEX idx_leaderboard_cache_class_id ON leaderboard_cache(class_id);
CREATE INDEX idx_leaderboard_cache_scope ON leaderboard_cache(scope, period);
CREATE INDEX idx_notifications_user_id ON notifications(user_id);
CREATE INDEX idx_notifications_read_at ON notifications(read_at);
CREATE INDEX idx_activity_logs_user_id ON activity_logs(user_id);
CREATE INDEX idx_activity_logs_created_at ON activity_logs(created_at);
```
