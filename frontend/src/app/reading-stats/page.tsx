'use client';

import { useEffect, useState } from 'react';
import { readingApi } from '@/services/api';
import { ReadingStats as ReadingStatsType } from '@/types';

export default function ReadingStatsPage() {
  const [stats, setStats] = useState<ReadingStatsType | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    readingApi.stats()
      .then((res) => setStats(res.data.data))
      .catch(() => {})
      .finally(() => setLoading(false));
  }, []);

  if (loading) {
    return (
      <div className="flex items-center justify-center py-20">
        <div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600"></div>
      </div>
    );
  }

  if (!stats) return null;

  const formatTime = (seconds: number) => {
    const hours = Math.floor(seconds / 3600);
    const mins = Math.floor((seconds % 3600) / 60);
    if (hours > 0) return `${hours} jam ${mins} menit`;
    return `${mins} menit`;
  };

  return (
    <div>
      <h1 className="text-2xl font-bold text-gray-800 mb-6">Statistik Membaca</h1>

      <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div className="bg-white rounded-xl shadow p-6 text-center">
          <div className="text-3xl font-bold text-blue-600">{stats.total_materials_read}</div>
          <div className="text-sm text-gray-500 mt-1">Materi Dibaca</div>
        </div>
        <div className="bg-white rounded-xl shadow p-6 text-center">
          <div className="text-3xl font-bold text-yellow-500">+{stats.total_xp_earned}</div>
          <div className="text-sm text-gray-500 mt-1">XP dari Membaca</div>
        </div>
        <div className="bg-white rounded-xl shadow p-6 text-center">
          <div className="text-3xl font-bold text-green-600">{formatTime(stats.total_reading_time_seconds)}</div>
          <div className="text-sm text-gray-500 mt-1">Total Waktu Membaca</div>
        </div>
        <div className="bg-white rounded-xl shadow p-6 text-center">
          <div className="text-3xl font-bold text-purple-600">{stats.passed_quizzes}/{stats.total_quiz_attempts}</div>
          <div className="text-sm text-gray-500 mt-1">Quiz Lulus</div>
        </div>
      </div>

      <div className="bg-white rounded-xl shadow p-6">
        <h2 className="text-lg font-semibold text-gray-800 mb-4">Riwayat Membaca Terakhir</h2>
        {stats.recent_logs.length === 0 ? (
          <div className="text-center py-8">
            <div className="text-4xl mb-3">📚</div>
            <p className="text-gray-400">Belum ada riwayat membaca</p>
          </div>
        ) : (
          <div className="space-y-3">
            {stats.recent_logs.map((log) => (
              <div key={log.id} className="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div className="flex items-center gap-3">
                  <div className={`w-2 h-2 rounded-full ${log.is_completed ? 'bg-green-500' : 'bg-yellow-500'}`}></div>
                  <div>
                    <p className="text-sm font-medium text-gray-800">{log.material?.title || 'Materi'}</p>
                    <p className="text-xs text-gray-500">
                      {log.duration_seconds} detik | Scroll: {log.scroll_depth}%
                    </p>
                  </div>
                </div>
                <div className="text-right">
                  {log.xp_earned > 0 && (
                    <span className="text-sm font-medium text-yellow-600">+{log.xp_earned} XP</span>
                  )}
                  {log.is_anomaly && (
                    <span className="text-xs text-red-500 block">Anomaly</span>
                  )}
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
    </div>
  );
}
