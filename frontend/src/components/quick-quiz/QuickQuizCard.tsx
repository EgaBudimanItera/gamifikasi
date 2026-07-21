'use client';

import { QuickQuizSession } from '@/types';

interface QuickQuizCardProps {
  session: QuickQuizSession;
  onJoin: (sessionId: number) => void;
  onViewResults: (sessionId: number) => void;
}

export default function QuickQuizCard({ session, onJoin, onViewResults }: QuickQuizCardProps) {
  const isActive = session.status === 'active';
  const isCompleted = session.status === 'completed';

  const getModeBadge = () => {
    if (session.mode === 'class') {
      return (
        <span className="px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
          Kelas
        </span>
      );
    }
    return (
      <span className="px-2 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
        Guild
      </span>
    );
  };

  const getStatusBadge = () => {
    if (isActive) {
      return (
        <span className="px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 animate-pulse">
          Berlangsung
        </span>
      );
    }
    if (isCompleted) {
      return (
        <span className="px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
          Selesai
        </span>
      );
    }
    return (
      <span className="px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
        Akan Datang
      </span>
    );
  };

  const getDifficultyLabel = () => {
    switch (session.difficulty) {
      case 'easy': return 'Mudah';
      case 'hard': return 'Sulit';
      default: return session.difficulty;
    }
  };

  const formatTime = (seconds: number) => {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins}:${secs.toString().padStart(2, '0')}`;
  };

  return (
    <div className={`bg-white rounded-xl shadow p-5 hover:shadow-md transition ${isActive ? 'ring-2 ring-green-400' : ''}`}>
      <div className="flex items-start justify-between mb-3">
        <div className="flex items-center gap-2">
          {getModeBadge()}
          {getStatusBadge()}
        </div>
        <div className="text-right">
          <div className="text-lg font-bold text-yellow-500">+{session.xp_reward} XP</div>
        </div>
      </div>

      <h3 className="font-semibold text-gray-800 mb-1">{session.title}</h3>

      <div className="flex flex-wrap gap-3 text-sm text-gray-500 mb-3">
        <span className="flex items-center gap-1">
          <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          {session.duration_minutes} menit
        </span>
        <span className="flex items-center gap-1">
          <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          {session.questions_count} soal
        </span>
        <span className="flex items-center gap-1">
          <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
          </svg>
          {getDifficultyLabel()}
        </span>
      </div>

      <div className="text-sm text-gray-500 mb-4">
        <span>oleh {session.creator_name}</span>
        {session.class_name && <span> — {session.class_name}</span>}
        {session.guild_name && <span> — {session.guild_name}</span>}
        {session.participant_count !== undefined && (
          <span> — {session.participant_count} peserta</span>
        )}
      </div>

      <div className="flex gap-2">
        {isActive && (
          <button
            onClick={() => onJoin(session.id)}
            className="flex-1 px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition"
          >
            Ikut Quiz
          </button>
        )}
        {isCompleted && (
          <button
            onClick={() => onViewResults(session.id)}
            className="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition"
          >
            Lihat Hasil
          </button>
        )}
        {!isActive && !isCompleted && (
          <button
            disabled
            className="flex-1 px-4 py-2 bg-gray-200 text-gray-400 rounded-lg font-medium cursor-not-allowed"
          >
            Belum Dimulai
          </button>
        )}
      </div>
    </div>
  );
}
