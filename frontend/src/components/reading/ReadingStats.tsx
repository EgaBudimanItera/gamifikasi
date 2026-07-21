'use client';

import { useEffect, useState } from 'react';
import { readingApi } from '@/services/api';
import { ReadingStats as ReadingStatsType } from '@/types';

interface ReadingStatsProps {
  className?: string;
}

export default function ReadingStats({ className = '' }: ReadingStatsProps) {
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
      <div className={`bg-white rounded-xl shadow p-6 ${className}`}>
        <div className="animate-pulse space-y-3">
          <div className="h-4 bg-gray-200 rounded w-1/3"></div>
          <div className="h-8 bg-gray-200 rounded w-1/2"></div>
        </div>
      </div>
    );
  }

  if (!stats) return null;

  const formatTime = (seconds: number) => {
    const hours = Math.floor(seconds / 3600);
    const mins = Math.floor((seconds % 3600) / 60);
    if (hours > 0) return `${hours}j ${mins}m`;
    return `${mins}m`;
  };

  return (
    <div className={`bg-white rounded-xl shadow p-6 ${className}`}>
      <h3 className="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Statistik Baca</h3>
      <div className="grid grid-cols-2 gap-4">
        <div className="text-center p-3 bg-blue-50 rounded-lg">
          <div className="text-2xl font-bold text-blue-600">{stats.total_materials_read}</div>
          <div className="text-xs text-blue-600 mt-1">Materi Dibaca</div>
        </div>
        <div className="text-center p-3 bg-yellow-50 rounded-lg">
          <div className="text-2xl font-bold text-yellow-600">+{stats.total_xp_earned}</div>
          <div className="text-xs text-yellow-600 mt-1">XP dari Membaca</div>
        </div>
        <div className="text-center p-3 bg-green-50 rounded-lg">
          <div className="text-2xl font-bold text-green-600">{formatTime(stats.total_reading_time_seconds)}</div>
          <div className="text-xs text-green-600 mt-1">Waktu Membaca</div>
        </div>
        <div className="text-center p-3 bg-purple-50 rounded-lg">
          <div className="text-2xl font-bold text-purple-600">{stats.passed_quizzes}/{stats.total_quiz_attempts}</div>
          <div className="text-xs text-purple-600 mt-1">Quiz Lulus</div>
        </div>
      </div>
    </div>
  );
}
