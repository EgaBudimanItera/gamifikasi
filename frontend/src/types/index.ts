export interface User {
  id: number;
  name: string;
  email: string;
  role: string;
  school: string | null;
  avatar: string | null;
}

export interface UserProfile {
  id: number;
  user_id: number;
  total_xp: number;
  current_level: number;
  current_streak: number;
  longest_streak: number;
  xp_for_next_level: number;
  xp_progress: number;
  last_login_at: string | null;
}

export interface Assignment {
  id: number;
  title: string;
  description: string;
  subject: string;
  max_score: number;
  xp_reward: number;
  deadline: string;
  is_published: boolean;
  submissions_count: number;
}

export interface Submission {
  id: number;
  assignment_id: number;
  student: string;
  file_path: string | null;
  answer_text: string | null;
  submitted_at: string;
  status: 'pending' | 'graded' | 'revised';
  grade: {
    score: number | null;
    feedback: string | null;
    graded_at: string | null;
  };
}

export interface Badge {
  id: number;
  name: string;
  description: string;
  icon: string;
  category: 'achievement' | 'streak' | 'rank' | 'special';
  xp_reward: number;
}

export interface Quest {
  id: number;
  title: string;
  description: string;
  type: 'daily' | 'weekly' | 'special';
  xp_reward: number;
  is_active: boolean;
}

export interface LeaderboardEntry {
  rank: number;
  user_id: number;
  name: string;
  total_xp: number;
  level: number;
}

export interface Notification {
  id: number;
  title: string;
  message: string;
  type: 'reward' | 'achievement' | 'system';
  read_at: string | null;
  created_at: string;
}

export interface TeachingSubject {
  id?: number;
  name?: string;
  subject_id: number;
  subject_name: string;
  subject_code: string;
  semester?: 'ganjil' | 'genap';
}

export interface Teaching {
  class_id: number;
  class_name: string;
  academic_year: string | null;
  subjects: TeachingSubject[];
}

export interface TeacherDashboard {
  total_students: number;
  active_assignments: number;
  total_materials: number;
  teachings: Teaching[];
}

export interface PaginatedResponse<T> {
  data: T[];
  meta: {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
  };
}
