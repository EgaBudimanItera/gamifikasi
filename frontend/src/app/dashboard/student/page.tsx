'use client';

import { useEffect, useState } from 'react';
import { dashboardApi, gamificationApi } from '@/services/api';
import { UserProfile } from '@/types';

export default function StudentDashboard() {
  const [profile, setProfile] = useState<UserProfile | null>(null);
  const [dashboard, setDashboard] = useState<any>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    loadData();
  }, []);

  const loadData = async () => {
    try {
      const [profileRes, dashRes] = await Promise.all([
        gamificationApi.profile(),
        dashboardApi.student(),
      ]);
      setProfile(profileRes.data.data);
      setDashboard(dashRes.data.data);
    } catch (error) {
      console.error('Error loading dashboard:', error);
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

  return (
    <div>
      <h1 className="text-2xl font-bold text-gray-800 mb-6">Dashboard Siswa</h1>

      {/* Stats Cards */}
      <div className="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div className="bg-white rounded-xl shadow p-5 text-center">
          <div className="text-3xl font-bold text-yellow-500">{profile?.total_xp || 0}</div>
          <div className="text-sm text-gray-500 mt-1">Total XP</div>
        </div>
        <div className="bg-white rounded-xl shadow p-5 text-center">
          <div className="text-3xl font-bold text-primary-600">Lv. {profile?.current_level || 1}</div>
          <div className="text-sm text-gray-500 mt-1">Level</div>
        </div>
        <div className="bg-white rounded-xl shadow p-5 text-center">
          <div className="text-3xl font-bold text-orange-500">{profile?.current_streak || 0}</div>
          <div className="text-sm text-gray-500 mt-1">Streak Hari</div>
        </div>
        <div className="bg-white rounded-xl shadow p-5 text-center">
          <div className="text-3xl font-bold text-purple-600">{dashboard?.total_badges || 0}</div>
          <div className="text-sm text-gray-500 mt-1">Badge</div>
        </div>
      </div>

      {/* Progress Bar */}
      <div className="bg-white rounded-xl shadow p-6 mb-6">
        <h2 className="text-sm font-semibold text-gray-600 mb-3">Progress Level</h2>
        <div className="w-full bg-gray-200 rounded-full h-5">
          <div
            className="bg-gradient-to-r from-primary-500 to-purple-500 h-5 rounded-full transition-all duration-500"
            style={{ width: `${profile?.xp_progress || 0}%` }}
          ></div>
        </div>
        <div className="flex justify-between mt-2 text-xs text-gray-500">
          <span>{profile?.total_xp || 0} XP</span>
          <span>{profile?.xp_for_next_level || 100} XP untuk Lv. {(profile?.current_level || 1) + 1}</span>
        </div>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        {/* Stats */}
        <div className="bg-white rounded-xl shadow p-6">
          <h2 className="text-sm font-semibold text-gray-600 mb-4">Ringkasan</h2>
          <div className="space-y-3">
            <div className="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
              <span className="text-sm text-gray-600">Tugas Selesai</span>
              <span className="font-semibold">{dashboard?.completed_assignments || 0}</span>
            </div>
            <div className="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
              <span className="text-sm text-gray-600">Badge Dikoleksi</span>
              <span className="font-semibold">{dashboard?.total_badges || 0}</span>
            </div>
            <div className="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
              <span className="text-sm text-gray-600">Quest Aktif</span>
              <span className="font-semibold">{dashboard?.active_quests || 0}</span>
            </div>
          </div>
        </div>

        {/* Active Quests */}
        <div className="bg-white rounded-xl shadow p-6">
          <h2 className="text-sm font-semibold text-gray-600 mb-4">Quest Aktif</h2>
          {dashboard?.active_quests > 0 ? (
            <div className="space-y-3">
              <div className="p-3 bg-blue-50 rounded-lg border border-blue-200">
                <div className="font-medium text-blue-800 text-sm">Selesaikan 2 tugas hari ini</div>
                <div className="text-xs text-blue-600">Reward: +30 XP</div>
                <div className="w-full bg-blue-200 rounded-full h-2 mt-2">
                  <div className="bg-blue-600 h-2 rounded-full" style={{ width: '50%' }}></div>
                </div>
              </div>
            </div>
          ) : (
            <p className="text-sm text-gray-400 text-center py-4">Belum ada quest aktif</p>
          )}
        </div>
      </div>
    </div>
  );
}
