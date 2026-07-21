'use client';

import { useState, useEffect } from 'react';
import { quickQuizApi, classApi, guildApi } from '@/services/api';
import { Class, Guild } from '@/types';

interface CreateQuizModalProps {
  onClose: () => void;
  onCreated: () => void;
}

export default function CreateQuizModal({ onClose, onCreated }: CreateQuizModalProps) {
  const [title, setTitle] = useState('');
  const [mode, setMode] = useState<'class' | 'guild'>('class');
  const [classId, setClassId] = useState<number | ''>('');
  const [guildId, setGuildId] = useState<number | ''>('');
  const [duration, setDuration] = useState(5);
  const [questionsCount, setQuestionsCount] = useState(5);
  const [difficulty, setDifficulty] = useState('easy');
  const [classes, setClasses] = useState<Class[]>([]);
  const [guilds, setGuilds] = useState<Guild[]>([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const [classesRes, guildsRes] = await Promise.all([
          classApi.list(),
          guildApi.available(),
        ]);
        setClasses(classesRes.data.data || classesRes.data || []);
        setGuilds(guildsRes.data.data || guildsRes.data || []);
      } catch (err) {
        console.error('Failed to fetch data:', err);
      }
    };
    fetchData();
  }, []);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!title) return;

    setLoading(true);
    setError(null);

    try {
      const data: any = {
        title,
        mode,
        duration_minutes: duration,
        questions_count: questionsCount,
        difficulty,
        xp_reward: mode === 'class' ? 30 : 75,
      };

      if (mode === 'class' && classId) data.class_id = classId;
      if (mode === 'guild' && guildId) data.guild_id = guildId;

      await quickQuizApi.create(data);
      onCreated();
    } catch (err: any) {
      setError(err.response?.data?.message || 'Gagal membuat quiz');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
      <div className="bg-white rounded-2xl p-6 max-w-md w-full mx-4 max-h-[80vh] overflow-y-auto">
        <div className="flex items-center justify-between mb-6">
          <h3 className="text-lg font-bold text-gray-800">Buat Quiz Cepat</h3>
          <button onClick={onClose} className="text-gray-400 hover:text-gray-600">
            <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <form onSubmit={handleSubmit} className="space-y-4">
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">Judul Quiz</label>
            <input
              type="text"
              value={title}
              onChange={(e) => setTitle(e.target.value)}
              className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
              placeholder="Contoh: Kuis Cepat Matematika"
              required
            />
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">Mode</label>
            <div className="grid grid-cols-2 gap-2">
              <button
                type="button"
                onClick={() => { setMode('class'); setGuildId(''); }}
                className={`p-3 rounded-lg border-2 text-center transition ${
                  mode === 'class'
                    ? 'border-blue-500 bg-blue-50 text-blue-800'
                    : 'border-gray-200 hover:border-gray-300'
                }`}
              >
                <div className="text-2xl mb-1">🏫</div>
                <div className="text-sm font-medium">Kelas</div>
                <div className="text-xs text-gray-500">5 menit, 5 soal, +30 XP</div>
              </button>
              <button
                type="button"
                onClick={() => { setMode('guild'); setClassId(''); }}
                className={`p-3 rounded-lg border-2 text-center transition ${
                  mode === 'guild'
                    ? 'border-purple-500 bg-purple-50 text-purple-800'
                    : 'border-gray-200 hover:border-gray-300'
                }`}
              >
                <div className="text-2xl mb-1">⚔️</div>
                <div className="text-sm font-medium">Guild</div>
                <div className="text-xs text-gray-500">15 menit, 10 soal, +75 XP</div>
              </button>
            </div>
          </div>

          {mode === 'class' && (
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
              <select
                value={classId}
                onChange={(e) => setClassId(Number(e.target.value))}
                className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                required
              >
                <option value="">Pilih kelas</option>
                {classes.map((c) => (
                  <option key={c.id} value={c.id}>{c.name}</option>
                ))}
              </select>
            </div>
          )}

          {mode === 'guild' && (
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">Guild</label>
              <select
                value={guildId}
                onChange={(e) => setGuildId(Number(e.target.value))}
                className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                required
              >
                <option value="">Pilih guild</option>
                {guilds.map((g) => (
                  <option key={g.id} value={g.id}>{g.name}</option>
                ))}
              </select>
            </div>
          )}

          <div className="grid grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">Durasi (menit)</label>
              <input
                type="number"
                value={duration}
                onChange={(e) => setDuration(Number(e.target.value))}
                min={1}
                max={60}
                className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">Jumlah Soal</label>
              <input
                type="number"
                value={questionsCount}
                onChange={(e) => setQuestionsCount(Number(e.target.value))}
                min={3}
                max={20}
                className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
              />
            </div>
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">Tingkat Kesulitan</label>
            <select
              value={difficulty}
              onChange={(e) => setDifficulty(e.target.value)}
              className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
            >
              <option value="easy">Mudah (Soal mudah & sedang)</option>
              <option value="hard">Sulit (Soal sulit & legendaris)</option>
            </select>
          </div>

          {error && (
            <p className="text-sm text-red-600">{error}</p>
          )}

          <div className="flex gap-3 pt-2">
            <button
              type="button"
              onClick={onClose}
              className="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition"
            >
              Batal
            </button>
            <button
              type="submit"
              disabled={!title || loading}
              className="flex-1 px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
            >
              {loading ? 'Membuat...' : 'Buat Quiz'}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}
