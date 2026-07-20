import axios from 'axios';

const API_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api';

const api = axios.create({
  baseURL: API_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
});

api.interceptors.request.use((config) => {
  if (typeof window !== 'undefined') {
    const token = localStorage.getItem('token');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
  }
  return config;
});

api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      if (typeof window !== 'undefined') {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        window.location.href = '/auth/login';
      }
    }
    return Promise.reject(error);
  }
);

export const authApi = {
  login: (email: string, password: string) =>
    api.post('/auth/login', { email, password }),
  logout: () => api.post('/auth/logout'),
  user: () => api.get('/auth/user'),
};

export const dashboardApi = {
  teacher: () => api.get('/dashboard/teacher'),
  student: () => api.get('/dashboard/student'),
  admin: () => api.get('/dashboard/admin'),
};

export const gamificationApi = {
  profile: () => api.get('/gamification/profile'),
  xpLogs: (page = 1) => api.get(`/gamification/xp-logs?page=${page}`),
  myBadges: () => api.get('/gamification/my-badges'),
  streak: () => api.get('/gamification/streak'),
  streakCalendar: () => api.get('/gamification/streak/calendar'),
  freezeStatus: () => api.get('/gamification/streak/freeze-status'),
  useFreeze: () => api.post('/gamification/streak/freeze'),
  checkIn: () => api.post('/gamification/streak/check-in'),
  myQuests: (page = 1) => api.get(`/gamification/my-quests?page=${page}`),
  notifications: (page = 1) => api.get(`/notifications?page=${page}`),
  markRead: (id: number) => api.put(`/notifications/${id}/read`),
  markAllRead: () => api.put('/notifications/read-all'),
};

export const leaderboardApi = {
  classLeaderboard: (classId: number) => api.get(`/leaderboard/class/${classId}`),
  schoolLeaderboard: () => api.get('/leaderboard/school'),
};

export const subjectsApi = {
  mySubjects: () => api.get('/my-subjects'),
};

export const assignmentApi = {
  list: (params?: Record<string, any>) => api.get('/assignments', { params }),
  get: (id: number) => api.get(`/assignments/${id}`),
  create: (data: any) => api.post('/assignments', data),
  update: (id: number, data: any) => api.put(`/assignments/${id}`, data),
  delete: (id: number) => api.delete(`/assignments/${id}`),
};

export const submissionApi = {
  list: (assignmentId: number) => api.get(`/assignments/${assignmentId}/submissions`),
  submit: (assignmentId: number, data: any) =>
    api.post(`/assignments/${assignmentId}/submissions`, data),
  grade: (submissionId: number, data: any) =>
    api.post(`/submissions/${submissionId}/grade`, data),
  revise: (submissionId: number, data: any) =>
    api.post(`/submissions/${submissionId}/revise`, data),
};

export const materialApi = {
  list: (params?: Record<string, any>) => api.get('/materials', { params }),
  get: (id: number) => api.get(`/materials/${id}`),
  create: (data: any) => api.post('/materials', data),
  update: (id: number, data: any) => api.put(`/materials/${id}`, data),
  publish: (id: number) => api.post(`/materials/${id}/publish`),
};

export const badgeApi = {
  list: () => api.get('/badges'),
  get: (id: number) => api.get(`/badges/${id}`),
};

export const questApi = {
  list: (page = 1) => api.get(`/quests?page=${page}`),
  accept: (id: number) => api.post(`/quests/${id}/accept`),
};

export const leagueApi = {
  myLeague: () => api.get('/league/my'),
  standings: () => api.get('/league/standings'),
  history: () => api.get('/league/history'),
  myStanding: () => api.get('/league/my-standing'),
};

export const classApi = {
  list: (params?: Record<string, any>) => api.get('/classes', { params }),
  get: (id: number) => api.get(`/classes/${id}`),
  create: (data: any) => api.post('/classes', data),
  update: (id: number, data: any) => api.put(`/classes/${id}`, data),
  delete: (id: number) => api.delete(`/classes/${id}`),
  students: (id: number) => api.get(`/classes/${id}/students`),
  subjects: (id: number) => api.get(`/classes/${id}/subjects`),
};

export const subjectApi = {
  list: (params?: Record<string, any>) => api.get('/subjects', { params }),
  get: (id: number) => api.get(`/subjects/${id}`),
  create: (data: any) => api.post('/subjects', data),
  update: (id: number, data: any) => api.put(`/subjects/${id}`, data),
  delete: (id: number) => api.delete(`/subjects/${id}`),
};

export const classSubjectApi = {
  list: (params?: Record<string, any>) => api.get('/class-subject-assignments', { params }),
  get: (id: number) => api.get(`/class-subject-assignments/${id}`),
  create: (data: any) => api.post('/class-subject-assignments', data),
  update: (id: number, data: any) => api.put(`/class-subject-assignments/${id}`, data),
  delete: (id: number) => api.delete(`/class-subject-assignments/${id}`),
};

export const userApi = {
  list: (params?: Record<string, any>) => api.get('/users', { params }),
};

export const guildApi = {
  myGuild: () => api.get('/guild/my'),
  create: (data: { name: string; description?: string; icon?: string; class_id?: number }) =>
    api.post('/guild', data),
  join: (guildId: number) => api.post(`/guild/${guildId}/join`),
  leave: () => api.post('/guild/leave'),
  available: () => api.get('/guild/available'),
  leaderboard: () => api.get('/guild/leaderboard'),
  members: (guildId: number) => api.get(`/guild/${guildId}/members`),
};

export default api;
