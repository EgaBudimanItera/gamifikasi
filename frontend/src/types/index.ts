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

export interface ReadingLog {
  id: number;
  user_id: number;
  material_id: number;
  started_at: string;
  duration_seconds: number;
  scroll_depth: number;
  is_completed: boolean;
  xp_earned: number;
  is_anomaly: boolean;
  anomaly_reason: string | null;
  material?: {
    id: number;
    title: string;
  };
}

export interface ReadingQuiz {
  id: number;
  question: string;
  options: string[];
  difficulty: 'easy' | 'medium' | 'hard';
}

export interface ReadingQuizAttempt {
  attempt_id: number;
  total_questions: number;
  correct_answers: number;
  passed: boolean;
  xp_earned: number;
}

export interface ReadingStats {
  total_materials_read: number;
  total_xp_earned: number;
  total_reading_time_seconds: number;
  total_quiz_attempts: number;
  passed_quizzes: number;
  recent_logs: ReadingLog[];
}

export interface Npc {
  id: number;
  subject_id: number;
  name: string;
  personality: string;
  avatar_url: string | null;
  dialogs: Record<string, string>;
  is_active: boolean;
  subject?: {
    id: number;
    name: string;
  };
}

export interface NpcQuest {
  id: number;
  question: string;
  options: string[];
  difficulty: 'easy' | 'medium' | 'hard' | 'legendary';
  xp_reward: number;
}

export interface NpcEncounter {
  npc: Npc;
  affinity: {
    id: number;
    affinity_level: number;
    affinity_xp: number;
  };
  dialog: string;
  has_quest: boolean;
}

export interface NpcAffinity {
  npc: Npc;
  affinity_level: number;
  affinity_xp: number;
  total_quests_completed: number;
  last_interaction_at: string | null;
  xp_to_next_level: number;
}

export interface QuickQuizSession {
  id: number;
  title: string;
  mode: 'class' | 'guild';
  difficulty: 'easy' | 'hard';
  duration_minutes: number;
  questions_count: number;
  xp_reward: number;
  pass_threshold: number;
  status: 'active' | 'completed' | 'cancelled';
  starts_at: string;
  ends_at: string;
  time_remaining?: number;
  creator_name?: string;
  class_name?: string | null;
  guild_name?: string | null;
  participant_count?: number;
}

export interface QuickQuizQuestion {
  id: number;
  npc_quest_id: number | null;
  question: string;
  options: string[];
  difficulty: 'easy' | 'medium' | 'hard' | 'legendary';
  order: number;
}

export interface QuickQuizParticipant {
  id: number;
  user_id: number;
  correct_count: number;
  total_questions: number;
  xp_earned: number;
  status: 'in_progress' | 'completed' | 'timeout';
  completed_at: string | null;
  rank?: number;
  user?: User;
}

export interface QuickQuizJoinResult {
  session: QuickQuizSession;
  questions: QuickQuizQuestion[];
}
