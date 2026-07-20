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

export interface XpLog {
  id: number;
  user_id: number;
  user_profile_id: number;
  amount: number;
  type: 'assignment' | 'login' | 'streak' | 'quest' | 'penalty';
  description: string;
  reference_id: number | null;
  reference_type: string | null;
  created_at: string;
}

export interface League {
  id: number;
  name: string;
  tier: string;
  order: number;
  icon: string;
  color: string;
  min_xp: number;
  max_xp: number;
  promote_count: number;
  demote_count: number;
}

export interface UserLeague {
  id: number;
  user_id: number;
  league_id: number;
  week_start: string;
  week_end: string;
  weekly_xp: number;
  rank: number | null;
  status: 'active' | 'promoted' | 'demoted';
  league?: League;
  user?: User;
}

export interface LeagueStanding {
  league: League;
  players: {
    user_id: number;
    name: string;
    weekly_xp: number;
    rank: number | null;
    status: string;
  }[];
}

export interface LeagueData {
  week_start: string;
  week_end: string;
  leagues: LeagueStanding[];
}

export interface MyLeagueStanding {
  league: League;
  rank: number;
  total_players: number;
  weekly_xp: number;
  status: string;
  week_start: string;
  week_end: string;
}

export interface GuildMember {
  id: number;
  guild_id: number;
  user_id: number;
  role: 'leader' | 'member';
  contributed_xp: number;
  user?: User;
}

export interface Guild {
  id: number;
  name: string;
  description: string | null;
  icon: string;
  leader_id: number;
  class_id: number | null;
  total_guild_xp: number;
  max_members: number;
  members?: GuildMember[];
  leader?: User;
  members_count?: number;
}

export interface School {
  id: number;
  name: string;
  address: string | null;
  phone: string | null;
  email: string | null;
}

export interface AcademicYear {
  id: number;
  school_id: number;
  name: string;
  start_date: string;
  end_date: string;
  is_active: boolean;
}

export interface Class {
  id: number;
  school_id: number;
  academic_year_id: number;
  name: string;
  grade_level: number;
  academic_year?: AcademicYear;
  students_count?: number;
  class_subjects?: ClassSubject[];
}

export interface Subject {
  id: number;
  school_id: number;
  name: string;
  code: string;
  description: string | null;
}

export interface ClassSubject {
  id: number;
  class_id: number;
  subject_id: number;
  user_id: number;
  semester: 'ganjil' | 'genap' | null;
  class?: Class;
  subject?: Subject;
  teacher?: User;
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
