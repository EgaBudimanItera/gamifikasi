'use client';

import { useEffect, useState } from 'react';
import { leaderboardApi } from '@/services/api';
import { LeaderboardEntry } from '@/types';

export default function LeaderboardPage() {
  const [leaderboard, setLeaderboard] = useState<LeaderboardEntry[]>([]);
  const [loading, setLoading] = useState(true);
  const [tab, setTab] = useState<'class' | 'school'>('class');

  useEffect(() => {
    loadLeaderboard();
  }, [tab]);

  const loadLeaderboard = async () => {
    setLoading(true);
    try {
      const res = tab === 'school'
        ? await leaderboardApi.schoolLeaderboard()
        : await leaderboardApi.classLeaderboard(1);
      setLeaderboard(res.data.data);
    } catch (error) {
      console.error('Error loading leaderboard:', error);
    } finally {
      setLoading(false);
    }
  };

  const getRankIcon = (rank: number) => {
    switch (rank) {
      case 1: return '🥇';
      case 2: return '🥈';
      case 3: return '🥉';
      default: return `#${rank}`;
    }
  };

  return (
    <div>
      <h1 className="text-2xl font-bold text-gray-800 mb-6">Leaderboard</h1>

        {/* Tabs */}
        <div className="flex gap-4 mb-6">
          <button
            onClick={() => setTab('class')}
            className={`px-6 py-2 rounded-lg font-semibold transition ${
              tab === 'class'
                ? 'bg-blue-600 text-white'
                : 'bg-white text-gray-600 hover:bg-gray-100'
            }`}
          >
            Kelas
          </button>
          <button
            onClick={() => setTab('school')}
            className={`px-6 py-2 rounded-lg font-semibold transition ${
              tab === 'school'
                ? 'bg-blue-600 text-white'
                : 'bg-white text-gray-600 hover:bg-gray-100'
            }`}
          >
            Sekolah
          </button>
        </div>

        {/* Leaderboard */}
        <div className="bg-white rounded-xl shadow overflow-hidden">
          {loading ? (
            <div className="p-8 text-center text-gray-500">Memuat leaderboard...</div>
          ) : leaderboard.length === 0 ? (
            <div className="p-8 text-center text-gray-500">Belum ada data leaderboard</div>
          ) : (
            <div className="divide-y">
              {leaderboard.map((entry) => (
                <div
                  key={entry.user_id}
                  className={`flex items-center gap-4 p-4 ${
                    entry.rank <= 3 ? 'bg-gradient-to-r from-yellow-50 to-white' : ''
                  }`}
                >
                  <div className="w-12 text-center text-2xl">{getRankIcon(entry.rank)}</div>
                  <div className="flex-1">
                    <div className="font-semibold">{entry.name}</div>
                    <div className="text-sm text-gray-500">Level {entry.level}</div>
                  </div>
                  <div className="text-right">
                    <div className="font-bold text-yellow-600">{entry.total_xp} XP</div>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>
    </div>
  );
}
