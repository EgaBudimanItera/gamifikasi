'use client';

import { useEffect, useState } from 'react';
import Link from 'next/link';
import { dashboardApi, gamificationApi } from '@/services/api';
import { UserProfile } from '@/types';

const streakMilestones = [
  { days: 7,   xp: 100,  icon: '🔥', label: '7 Hari' },
  { days: 14,  xp: 150,  icon: '🔥', label: '14 Hari' },
  { days: 30,  xp: 500,  icon: '⭐', label: '30 Hari' },
  { days: 60,  xp: 750,  icon: '💎', label: '60 Hari' },
  { days: 100, xp: 1500, icon: '👑', label: '100 Hari' },
  { days: 365, xp: 5000, icon: '🏆', label: '365 Hari' },
];

export default function StudentDashboard() {
  const [profile, setProfile] = useState<UserProfile | null>(null);
  const [dashboard, setDashboard] = useState<any>(null);
  const [freezeStatus, setFreezeStatus] = useState<any>(null);
  const [loading, setLoading] = useState(true);
  const [checkInLoading, setCheckInLoading] = useState(false);
  const [checkInResult, setCheckInResult] = useState<string | null>(null);
  const [freezeLoading, setFreezeLoading] = useState(false);
  const [freezeResult, setFreezeResult] = useState<string | null>(null);
  const [milestoneResult, setMilestoneResult] = useState<string | null>(null);

  useEffect(() => { loadData(); }, []);

  const loadData = async () => {
    try {
      const [profileRes, dashRes, freezeRes] = await Promise.all([
        gamificationApi.profile(),
        dashboardApi.student(),
        gamificationApi.freezeStatus().catch(() => ({ data: { data: null } })),
      ]);
      setProfile(profileRes.data.data);
      setDashboard(dashRes.data.data);
      setFreezeStatus(freezeRes.data.data);
    } catch (error) {
      console.error('Error loading dashboard:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleCheckIn = async () => {
    setCheckInLoading(true);
    try {
      const res = await gamificationApi.checkIn();
      const data = res.data.data;
      setCheckInResult(res.data.message || `Check-in berhasil! +${data.xp_earned} XP`);
      if (data.milestone) {
        setMilestoneResult(`🎉 ${data.milestone.message} (+${data.milestone.xp} XP)`);
        setTimeout(() => setMilestoneResult(null), 5000);
      }
      loadData();
    } catch (error) {
      setCheckInResult('Sudah check-in hari ini');
    } finally {
      setCheckInLoading(false);
      setTimeout(() => setCheckInResult(null), 3000);
    }
  };

  const handleFreeze = async () => {
    setFreezeLoading(true);
    try {
      const res = await gamificationApi.useFreeze();
      setFreezeResult(res.data.message);
      loadData();
    } catch (error) {
      setFreezeResult('Gagal menggunakan freeze');
    } finally {
      setFreezeLoading(false);
      setTimeout(() => setFreezeResult(null), 3000);
    }
  };

  if (loading) {
    return (
      <div className="flex items-center justify-center py-20">
        <div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600"></div>
      </div>
    );
  }

  const level = profile?.current_level || 1;
  const xp = profile?.total_xp || 0;
  const progress = profile?.xp_progress || 0;
  const nextLevelXp = profile?.xp_for_next_level || 100;
  const currentStreak = profile?.current_streak || 0;

  // Find next milestone
  const nextMilestone = streakMilestones.find(m => m.days > currentStreak) || streakMilestones[streakMilestones.length - 1];
  const prevMilestoneDays = streakMilestones.filter(m => m.days <= currentStreak).pop()?.days || 0;
  const milestoneProgress = nextMilestone.days > prevMilestoneDays
    ? ((currentStreak - prevMilestoneDays) / (nextMilestone.days - prevMilestoneDays)) * 100
    : 100;

  return (
    <div>
      {/* Header */}
      <div className="flex items-center justify-between mb-8">
        <div>
          <h1 className="text-2xl font-bold text-gray-800">Dashboard Siswa</h1>
          <p className="text-sm text-gray-500 mt-1">Terus belajar dan kumpulkan XP!</p>
        </div>
        <button
          onClick={handleCheckIn}
          disabled={checkInLoading}
          className="flex items-center gap-2 bg-gradient-to-r from-orange-500 to-red-500 text-white px-5 py-2.5 rounded-xl font-medium text-sm hover:shadow-lg hover:shadow-orange-200 transition disabled:opacity-60"
        >
          <span className="text-lg">🔥</span>
          {checkInLoading ? 'Check-in...' : 'Check-in Hari Ini'}
        </button>
      </div>

      {/* Feedback messages */}
      {checkInResult && (
        <div className="mb-4 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm font-medium animate-xp-gain">
          {checkInResult}
        </div>
      )}
      {milestoneResult && (
        <div className="mb-4 bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-300 text-yellow-800 rounded-xl px-4 py-3 text-sm font-bold animate-level-up">
          {milestoneResult}
        </div>
      )}
      {freezeResult && (
        <div className="mb-4 bg-cyan-50 border border-cyan-200 text-cyan-700 rounded-xl px-4 py-3 text-sm font-medium">
          {freezeResult}
        </div>
      )}

      {/* Hero Stats */}
      <div className="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        {/* Total XP */}
        <div className="bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl p-5 text-white shadow-lg shadow-yellow-200 col-span-2 lg:col-span-1">
          <div className="flex items-center gap-3">
            <div className="text-4xl animate-xp-gain">⭐</div>
            <div>
              <div className="text-3xl font-bold">{xp.toLocaleString()}</div>
              <div className="text-sm opacity-90">Total XP</div>
            </div>
          </div>
          <Link href="/xp-history" className="mt-3 inline-flex items-center gap-1 text-xs text-white/80 hover:text-white transition">
            Lihat Riwayat →
          </Link>
        </div>

        {/* Level */}
        <div className="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
          <div className="flex items-center gap-3">
            <div className="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white font-bold text-lg shadow-md">
              {level}
            </div>
            <div>
              <div className="text-2xl font-bold text-gray-800">Level {level}</div>
              <div className="text-xs text-gray-500">
                {level < 5 ? 'Pemula' : level < 10 ? 'Pelajar' : level < 20 ? 'Ahli' : 'Master'}
              </div>
            </div>
          </div>
        </div>

        {/* Streak with Freeze */}
        <div className="bg-gradient-to-br from-orange-400 to-red-500 rounded-2xl p-5 text-white shadow-lg shadow-orange-200 relative">
          <div className="flex items-center gap-3">
            <div className="text-4xl animate-streak-fire">🔥</div>
            <div>
              <div className="text-3xl font-bold">{currentStreak}</div>
              <div className="text-sm opacity-90">Streak Hari</div>
            </div>
          </div>
          <div className="mt-2 flex items-center justify-between">
            <span className="text-xs opacity-75">Rekor: {profile?.longest_streak || 0} hari</span>
            {freezeStatus?.available && (
              <button
                onClick={(e) => { e.stopPropagation(); handleFreeze(); }}
                disabled={freezeLoading}
                className="text-xs bg-white/20 hover:bg-white/30 px-2 py-0.5 rounded-full transition"
                title="Gunakan Freeze untuk melindungi streak"
              >
                ❄️ Freeze
              </button>
            )}
          </div>
        </div>

        {/* Badges */}
        <div className="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
          <div className="flex items-center gap-3">
            <div className="text-4xl">🏆</div>
            <div>
              <div className="text-3xl font-bold text-purple-600">{dashboard?.total_badges || 0}</div>
              <div className="text-sm text-gray-500">Badge</div>
            </div>
          </div>
        </div>
      </div>

      {/* Level Progress */}
      <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
        <div className="flex items-center justify-between mb-3">
          <h2 className="text-sm font-semibold text-gray-600">Progress Level</h2>
          <span className="text-xs text-gray-400">{Math.round(progress)}%</span>
        </div>
        <div className="w-full bg-gray-100 rounded-full h-4 overflow-hidden">
          <div
            className="bg-gradient-to-r from-primary-500 via-blue-500 to-purple-500 h-4 rounded-full transition-all duration-700 ease-out"
            style={{ width: `${progress}%` }}
          ></div>
        </div>
        <div className="flex justify-between mt-2">
          <span className="text-xs text-gray-500">Lv. {level} — {xp} XP</span>
          <span className="text-xs text-gray-500">Lv. {level + 1} — {nextLevelXp} XP</span>
        </div>
      </div>

      {/* Streak Milestone Progress */}
      <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
        <div className="flex items-center justify-between mb-4">
          <h2 className="text-sm font-semibold text-gray-600">Streak Milestone</h2>
          <span className="text-xs text-gray-400">{currentStreak} hari</span>
        </div>

        {/* Milestone progress bar */}
        <div className="mb-4">
          <div className="flex justify-between text-xs text-gray-400 mb-1">
            <span>{prevMilestoneDays} hari</span>
            <span>{nextMilestone.days} hari</span>
          </div>
          <div className="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
            <div
              className="bg-gradient-to-r from-orange-400 to-red-500 h-3 rounded-full transition-all duration-700"
              style={{ width: `${Math.min(100, milestoneProgress)}%` }}
            ></div>
          </div>
          <div className="text-center mt-1 text-xs text-gray-500">
            {nextMilestone.days - currentStreak > 0
              ? `${nextMilestone.days - currentStreak} hari lagi ke ${nextMilestone.label} (+${nextMilestone.xp} XP)`
              : `Milestone tercapai! 🎉`}
          </div>
        </div>

        {/* Milestone markers */}
        <div className="flex justify-between">
          {streakMilestones.map((m) => {
            const achieved = currentStreak >= m.days;
            const isNext = m.days === nextMilestone.days;
            return (
              <div key={m.days} className="flex flex-col items-center">
                <div className={`w-8 h-8 rounded-full flex items-center justify-center text-sm ${
                  achieved
                    ? 'bg-gradient-to-br from-orange-400 to-red-500 text-white shadow-md'
                    : isNext
                    ? 'bg-orange-100 text-orange-500 ring-2 ring-orange-300'
                    : 'bg-gray-100 text-gray-400'
                }`}>
                  {achieved ? '✓' : m.icon}
                </div>
                <span className={`text-xs mt-1 ${achieved ? 'text-orange-600 font-medium' : 'text-gray-400'}`}>
                  {m.label}
                </span>
              </div>
            );
          })}
        </div>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        {/* Quick Summary */}
        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <h2 className="text-sm font-semibold text-gray-600 mb-4">Ringkasan Cepat</h2>
          <div className="space-y-3">
            <div className="flex items-center justify-between p-3 bg-blue-50 rounded-xl border border-blue-100">
              <div className="flex items-center gap-2">
                <span>📝</span>
                <span className="text-sm text-blue-700 font-medium">Tugas Selesai</span>
              </div>
              <span className="font-bold text-blue-700">{dashboard?.completed_assignments || 0}</span>
            </div>
            <div className="flex items-center justify-between p-3 bg-purple-50 rounded-xl border border-purple-100">
              <div className="flex items-center gap-2">
                <span>🏆</span>
                <span className="text-sm text-purple-700 font-medium">Badge Dikoleksi</span>
              </div>
              <span className="font-bold text-purple-700">{dashboard?.total_badges || 0}</span>
            </div>
            <div className="flex items-center justify-between p-3 bg-green-50 rounded-xl border border-green-100">
              <div className="flex items-center gap-2">
                <span>🎯</span>
                <span className="text-sm text-green-700 font-medium">Quest Aktif</span>
              </div>
              <span className="font-bold text-green-700">{dashboard?.active_quests || 0}</span>
            </div>
          </div>
        </div>

        {/* Quick Links */}
        <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <h2 className="text-sm font-semibold text-gray-600 mb-4">Akses Cepat</h2>
          <div className="grid grid-cols-2 gap-3">
            <Link href="/quests" className="flex flex-col items-center gap-2 p-4 bg-blue-50 rounded-xl border border-blue-100 hover:bg-blue-100 transition">
              <span className="text-2xl">🎯</span>
              <span className="text-xs font-medium text-blue-700">Quest</span>
            </Link>
            <Link href="/badges" className="flex flex-col items-center gap-2 p-4 bg-purple-50 rounded-xl border border-purple-100 hover:bg-purple-100 transition">
              <span className="text-2xl">🏆</span>
              <span className="text-xs font-medium text-purple-700">Badge</span>
            </Link>
            <Link href="/leaderboard" className="flex flex-col items-center gap-2 p-4 bg-yellow-50 rounded-xl border border-yellow-100 hover:bg-yellow-100 transition">
              <span className="text-2xl">🏅</span>
              <span className="text-xs font-medium text-yellow-700">Leaderboard</span>
            </Link>
            <Link href="/xp-history" className="flex flex-col items-center gap-2 p-4 bg-orange-50 rounded-xl border border-orange-100 hover:bg-orange-100 transition">
              <span className="text-2xl">⭐</span>
              <span className="text-xs font-medium text-orange-700">Riwayat XP</span>
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
}
