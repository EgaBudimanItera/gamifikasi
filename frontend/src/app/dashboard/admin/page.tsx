'use client';

import { useEffect, useState } from 'react';
import Link from 'next/link';
import { dashboardApi } from '@/services/api';

interface AdminDashboard {
  total_students: number;
  total_teachers: number;
  total_classes: number;
  total_subjects: number;
  total_assignments: number;
  total_materials: number;
  total_submissions: number;
  total_xp_all_students: number;
  avg_level: number;
  avg_streak: number;
  top_students: { name: string; total_xp: number; level: number; streak: number }[];
  recent_submissions: { student: string; assignment: string; status: string; submitted_at: string }[];
}

export default function AdminDashboardPage() {
  const [dashboard, setDashboard] = useState<AdminDashboard | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => { loadDashboard(); }, []);

  const loadDashboard = async () => {
    try {
      const res = await dashboardApi.admin();
      setDashboard(res.data.data);
    } catch (error) {
      console.error('Error loading admin dashboard:', error);
    } finally {
      setLoading(false);
    }
  };

  if (loading) {
    return (
      <div className="flex items-center justify-center py-20">
        <div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600"></div>
      </div>
    );
  }

  if (!dashboard) return null;

  const stats = [
    { label: 'Total Siswa', value: dashboard.total_students, icon: '👤', color: 'bg-blue-50 text-blue-700 border-blue-200' },
    { label: 'Total Guru', value: dashboard.total_teachers, icon: '👩‍🏫', color: 'bg-green-50 text-green-700 border-green-200' },
    { label: 'Total Kelas', value: dashboard.total_classes, icon: '🏫', color: 'bg-purple-50 text-purple-700 border-purple-200' },
    { label: 'Total Mapel', value: dashboard.total_subjects, icon: '📚', color: 'bg-orange-50 text-orange-700 border-orange-200' },
    { label: 'Total Tugas', value: dashboard.total_assignments, icon: '📝', color: 'bg-cyan-50 text-cyan-700 border-cyan-200' },
    { label: 'Total Materi', value: dashboard.total_materials, icon: '📖', color: 'bg-pink-50 text-pink-700 border-pink-200' },
  ];

  const gamStats = [
    { label: 'Total XP (Semua Siswa)', value: dashboard.total_xp_all_students.toLocaleString(), icon: '⭐' },
    { label: 'Rata-rata Level', value: dashboard.avg_level, icon: '📊' },
    { label: 'Rata-rata Streak', value: `${dashboard.avg_streak} hari`, icon: '🔥' },
    { label: 'Total Submissions', value: dashboard.total_submissions, icon: '📤' },
  ];

  return (
    <div>
      <div className="flex items-center justify-between mb-8">
        <div>
          <h1 className="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
          <p className="text-sm text-gray-500 mt-1">Overview platform EduQuest</p>
        </div>
        <div className="text-right text-xs text-gray-400">
          SMP Nusantara
        </div>
      </div>

      {/* Platform Stats Grid */}
      <div className="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        {stats.map((stat) => (
          <div key={stat.label} className={`rounded-2xl border p-5 ${stat.color}`}>
            <div className="flex items-center gap-3">
              <span className="text-3xl">{stat.icon}</span>
              <div>
                <div className="text-3xl font-bold">{stat.value}</div>
                <div className="text-sm opacity-75">{stat.label}</div>
              </div>
            </div>
          </div>
        ))}
      </div>

      {/* Gamification Overview */}
      <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
        <h2 className="text-sm font-semibold text-gray-600 mb-4">Statistik Gamifikasi</h2>
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-4">
          {gamStats.map((stat) => (
            <div key={stat.label} className="bg-gray-50 rounded-xl p-4 text-center">
              <div className="text-2xl mb-1">{stat.icon}</div>
              <div className="text-xl font-bold text-gray-800">{stat.value}</div>
              <div className="text-xs text-gray-500 mt-1">{stat.label}</div>
            </div>
          ))}
        </div>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {/* Top Students */}
        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <h2 className="text-sm font-semibold text-gray-600 mb-4">Top 5 Siswa (XP)</h2>
          <div className="space-y-3">
            {dashboard.top_students.length === 0 ? (
              <p className="text-sm text-gray-400 text-center py-4">Belum ada data</p>
            ) : (
              dashboard.top_students.map((student, idx) => (
                <div key={idx} className="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                  <div className="w-8 text-center text-lg">
                    {idx === 0 ? '🥇' : idx === 1 ? '🥈' : idx === 2 ? '🥉' : `#${idx + 1}`}
                  </div>
                  <div className="flex-1">
                    <div className="font-medium text-sm text-gray-800">{student.name}</div>
                    <div className="text-xs text-gray-500">Level {student.level} · Streak {student.streak} hari</div>
                  </div>
                  <div className="font-bold text-sm text-yellow-600">{student.total_xp.toLocaleString()} XP</div>
                </div>
              ))
            )}
          </div>
        </div>

        {/* Recent Submissions */}
        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <h2 className="text-sm font-semibold text-gray-600 mb-4">Submission Terbaru</h2>
          <div className="space-y-3">
            {dashboard.recent_submissions.length === 0 ? (
              <p className="text-sm text-gray-400 text-center py-4">Belum ada submission</p>
            ) : (
              dashboard.recent_submissions.map((sub, idx) => (
                <div key={idx} className="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                  <div className="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold text-sm flex-shrink-0">
                    {sub.student.charAt(0)}
                  </div>
                  <div className="flex-1 min-w-0">
                    <div className="font-medium text-sm text-gray-800 truncate">{sub.student}</div>
                    <div className="text-xs text-gray-500 truncate">{sub.assignment}</div>
                  </div>
                  <span className={`text-xs px-2 py-1 rounded-full font-medium ${
                    sub.status === 'graded' ? 'bg-green-100 text-green-700' :
                    sub.status === 'pending' ? 'bg-yellow-100 text-yellow-700' :
                    'bg-gray-100 text-gray-600'
                  }`}>
                    {sub.status === 'graded' ? 'Dinilai' : sub.status === 'pending' ? 'Menunggu' : sub.status}
                  </span>
                </div>
              ))
            )}
          </div>
        </div>
      </div>

      {/* Quick Links */}
      <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h2 className="text-sm font-semibold text-gray-600 mb-4">Manajemen</h2>
        <div className="grid grid-cols-2 md:grid-cols-4 gap-3">
          <Link href="/admin/users" className="flex flex-col items-center gap-2 p-4 bg-blue-50 rounded-xl border border-blue-100 hover:bg-blue-100 transition">
            <span className="text-2xl">👥</span>
            <span className="text-xs font-medium text-blue-700">Kelola User</span>
          </Link>
          <Link href="/admin/schools" className="flex flex-col items-center gap-2 p-4 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition">
            <span className="text-2xl">🏫</span>
            <span className="text-xs font-medium text-green-700">Kelola Sekolah</span>
          </Link>
          <Link href="/materials" className="flex flex-col items-center gap-2 p-4 bg-purple-50 rounded-xl border border-purple-100 hover:bg-purple-100 transition">
            <span className="text-2xl">📚</span>
            <span className="text-xs font-medium text-purple-700">Materi</span>
          </Link>
          <Link href="/leaderboard" className="flex flex-col items-center gap-2 p-4 bg-yellow-50 rounded-xl border border-yellow-100 hover:bg-yellow-100 transition">
            <span className="text-2xl">🏅</span>
            <span className="text-xs font-medium text-yellow-700">Leaderboard</span>
          </Link>
        </div>
      </div>
    </div>
  );
}
