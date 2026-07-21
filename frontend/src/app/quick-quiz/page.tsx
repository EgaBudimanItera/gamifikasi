'use client';

import { useEffect, useState, useCallback } from 'react';
import { quickQuizApi } from '@/services/api';
import { useAuth } from '@/contexts/AuthContext';
import { QuickQuizSession as QuickQuizSessionType } from '@/types';
import QuickQuizCard from '@/components/quick-quiz/QuickQuizCard';
import QuickQuizSessionComponent from '@/components/quick-quiz/QuickQuizSession';
import QuickQuizResults from '@/components/quick-quiz/QuickQuizResults';
import CreateQuizModal from '@/components/quick-quiz/CreateQuizModal';

export default function QuickQuizPage() {
  const { user } = useAuth();
  const [sessions, setSessions] = useState<QuickQuizSessionType[]>([]);
  const [loading, setLoading] = useState(true);
  const [activeSessionId, setActiveSessionId] = useState<number | null>(null);
  const [resultSessionId, setResultSessionId] = useState<number | null>(null);
  const [lastResult, setLastResult] = useState<any>(null);
  const [showCreate, setShowCreate] = useState(false);
  const [filter, setFilter] = useState<'all' | 'active' | 'completed'>('all');

  const isGuru = user?.role === 'guru' || user?.role === 'admin';

  const loadSessions = useCallback(async () => {
    try {
      const res = await quickQuizApi.sessions();
      setSessions(res.data.data || []);
    } catch (error) {
      console.error('Error loading sessions:', error);
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    loadSessions();
  }, [loadSessions]);

  const handleJoin = (sessionId: number) => {
    setActiveSessionId(sessionId);
  };

  const handleComplete = (result: any) => {
    setActiveSessionId(null);
    setLastResult(result);
    setResultSessionId(activeSessionId);
    loadSessions();
  };

  const handleViewResults = (sessionId: number) => {
    setResultSessionId(sessionId);
  };

  const handleCreated = () => {
    setShowCreate(false);
    loadSessions();
  };

  const filteredSessions = sessions.filter((s) => {
    if (filter === 'all') return true;
    if (filter === 'active') return s.status === 'active';
    if (filter === 'completed') return s.status === 'completed';
    return true;
  });

  const activeCount = sessions.filter((s) => s.status === 'active').length;
  const completedCount = sessions.filter((s) => s.status === 'completed').length;

  if (loading) {
    return (
      <div className="flex items-center justify-center py-20">
        <div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600"></div>
      </div>
    );
  }

  return (
    <div>
      <div className="flex items-center justify-between mb-6">
        <div>
          <h1 className="text-2xl font-bold text-gray-800">Quick Quiz Liga</h1>
          <p className="text-sm text-gray-500 mt-1">Quiz kompetitif per kelas atau per guild</p>
        </div>
        {isGuru && (
          <button
            onClick={() => setShowCreate(true)}
            className="px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition flex items-center gap-2"
          >
            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 4v16m8-8H4" />
            </svg>
            Buat Quiz
          </button>
        )}
      </div>

      <div className="flex gap-2 mb-6">
        <button
          onClick={() => setFilter('all')}
          className={`px-4 py-2 rounded-lg text-sm font-medium transition ${
            filter === 'all' ? 'bg-primary-100 text-primary-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
          }`}
        >
          Semua ({sessions.length})
        </button>
        <button
          onClick={() => setFilter('active')}
          className={`px-4 py-2 rounded-lg text-sm font-medium transition ${
            filter === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
          }`}
        >
          Berlangsung ({activeCount})
        </button>
        <button
          onClick={() => setFilter('completed')}
          className={`px-4 py-2 rounded-lg text-sm font-medium transition ${
            filter === 'completed' ? 'bg-gray-200 text-gray-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
          }`}
        >
          Selesai ({completedCount})
        </button>
      </div>

      {filteredSessions.length === 0 ? (
        <div className="bg-white rounded-xl shadow p-12 text-center">
          <div className="text-4xl mb-3">⚡</div>
          <p className="text-gray-400">Belum ada quiz tersedia</p>
          {isGuru && (
            <button
              onClick={() => setShowCreate(true)}
              className="mt-4 px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition"
            >
              Buat Quiz Pertama
            </button>
          )}
        </div>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          {filteredSessions.map((session) => (
            <QuickQuizCard
              key={session.id}
              session={session}
              onJoin={handleJoin}
              onViewResults={handleViewResults}
            />
          ))}
        </div>
      )}

      {activeSessionId && (
        <QuickQuizSessionComponent
          sessionId={activeSessionId}
          onComplete={handleComplete}
          onClose={() => setActiveSessionId(null)}
        />
      )}

      {lastResult && resultSessionId && (
        <QuickQuizResults
          result={lastResult}
          onClose={() => { setLastResult(null); setResultSessionId(null); }}
        />
      )}

      {showCreate && (
        <CreateQuizModal
          onClose={() => setShowCreate(false)}
          onCreated={handleCreated}
        />
      )}
    </div>
  );
}
