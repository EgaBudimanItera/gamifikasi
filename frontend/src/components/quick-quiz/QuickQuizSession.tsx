'use client';

import { useState, useEffect, useCallback } from 'react';
import { quickQuizApi } from '@/services/api';
import { QuickQuizQuestion, QuickQuizSession } from '@/types';

interface QuickQuizSessionProps {
  sessionId: number;
  onComplete: (result: any) => void;
  onClose: () => void;
}

export default function QuickQuizSessionComponent({ sessionId, onComplete, onClose }: QuickQuizSessionProps) {
  const [session, setSession] = useState<QuickQuizSession | null>(null);
  const [questions, setQuestions] = useState<QuickQuizQuestion[]>([]);
  const [answers, setAnswers] = useState<Record<number, string>>({});
  const [loading, setLoading] = useState(true);
  const [joining, setJoining] = useState(false);
  const [submitting, setSubmitting] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [timeLeft, setTimeLeft] = useState(0);

  const fetchSession = useCallback(async () => {
    try {
      const res = await quickQuizApi.get(sessionId);
      setSession(res.data.data);
    } catch (err) {
      console.error('Failed to fetch session:', err);
    }
  }, [sessionId]);

  const joinSession = useCallback(async () => {
    setJoining(true);
    setError(null);
    try {
      const res = await quickQuizApi.join(sessionId);
      setSession(res.data.data.session);
      setQuestions(res.data.data.questions);
      setTimeLeft(res.data.data.session.time_remaining || 0);
    } catch (err: any) {
      setError(err.response?.data?.message || 'Gagal bergabung');
    } finally {
      setJoining(false);
      setLoading(false);
    }
  }, [sessionId]);

  useEffect(() => {
    joinSession();
  }, [joinSession]);

  useEffect(() => {
    if (timeLeft <= 0) return;
    const timer = setInterval(() => {
      setTimeLeft((prev) => {
        if (prev <= 1) {
          clearInterval(timer);
          handleSubmit();
          return 0;
        }
        return prev - 1;
      });
    }, 1000);
    return () => clearInterval(timer);
  }, [timeLeft > 0]);

  const handleAnswer = (questionId: number, answer: string) => {
    setAnswers((prev) => ({ ...prev, [questionId]: answer }));
  };

  const handleSubmit = async () => {
    if (submitting) return;
    setSubmitting(true);
    try {
      const res = await quickQuizApi.submit(sessionId, answers);
      onComplete(res.data.data);
    } catch (err: any) {
      setError(err.response?.data?.message || 'Gagal mengirim jawaban');
      setSubmitting(false);
    }
  };

  const allAnswered = questions.every((q) => answers[q.id]);

  const formatTime = (seconds: number) => {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins}:${secs.toString().padStart(2, '0')}`;
  };

  const getDifficultyColor = (diff: string) => {
    switch (diff) {
      case 'easy': return 'bg-green-100 text-green-800';
      case 'medium': return 'bg-yellow-100 text-yellow-800';
      case 'hard': return 'bg-orange-100 text-orange-800';
      case 'legendary': return 'bg-red-100 text-red-800';
      default: return 'bg-gray-100 text-gray-800';
    }
  };

  if (loading || joining) {
    return (
      <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div className="bg-white rounded-2xl p-8 max-w-md w-full mx-4 text-center">
          <div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600 mx-auto"></div>
          <p className="mt-4 text-gray-500">{joining ? 'Bergabung ke quiz...' : 'Memuat quiz...'}</p>
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div className="bg-white rounded-2xl p-8 max-w-md w-full mx-4 text-center">
          <div className="text-5xl mb-4">⚠️</div>
          <h3 className="text-xl font-bold text-gray-800 mb-2">Terjadi Kesalahan</h3>
          <p className="text-gray-600 mb-4">{error}</p>
          <button
            onClick={onClose}
            className="w-full px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition"
          >
            Tutup
          </button>
        </div>
      </div>
    );
  }

  return (
    <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
      <div className="bg-white rounded-2xl p-6 max-w-lg w-full mx-4 max-h-[85vh] overflow-y-auto">
        <div className="flex items-center justify-between mb-4">
          <div>
            <h3 className="text-lg font-bold text-gray-800">{session?.title}</h3>
            <p className="text-sm text-gray-500">{session?.mode === 'class' ? 'Quiz Kelas' : 'Quiz Guild'}</p>
          </div>
          <div className="text-right">
            <div className={`text-2xl font-bold ${timeLeft <= 30 ? 'text-red-500 animate-pulse' : 'text-gray-800'}`}>
              {formatTime(timeLeft)}
            </div>
            <p className="text-xs text-gray-400">Sisa waktu</p>
          </div>
        </div>

        <div className="flex items-center gap-2 mb-4">
          <span className="text-sm text-gray-500">
            {Object.keys(answers).length} dari {questions.length} soal dijawab
          </span>
          <div className="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
            <div
              className="h-full bg-primary-500 transition-all duration-300"
              style={{ width: `${(Object.keys(answers).length / questions.length) * 100}%` }}
            />
          </div>
        </div>

        <div className="space-y-4">
          {questions.map((q, idx) => (
            <div key={q.id} className="bg-gray-50 rounded-xl p-4">
              <div className="flex items-start gap-3 mb-3">
                <span className="flex-shrink-0 w-7 h-7 bg-primary-100 text-primary-700 rounded-full flex items-center justify-center text-sm font-bold">
                  {idx + 1}
                </span>
                <div className="flex-1">
                  <div className="flex items-center gap-2 mb-1">
                    <span className={`px-2 py-0.5 rounded-full text-xs font-medium ${getDifficultyColor(q.difficulty)}`}>
                      {q.difficulty}
                    </span>
                  </div>
                  <p className="text-gray-800 font-medium">{q.question}</p>
                </div>
              </div>
              <div className="space-y-2 ml-10">
                {q.options.map((option, optIdx) => (
                  <label
                    key={optIdx}
                    className={`flex items-center gap-3 p-3 rounded-lg border cursor-pointer transition ${
                      answers[q.id] === option
                        ? 'bg-primary-50 border-primary-300 text-primary-800'
                        : 'bg-white border-gray-200 hover:border-gray-300'
                    }`}
                  >
                    <input
                      type="radio"
                      name={`question-${q.id}`}
                      value={option}
                      checked={answers[q.id] === option}
                      onChange={() => handleAnswer(q.id, option)}
                      className="text-primary-600 focus:ring-primary-500"
                    />
                    <span className="text-sm">{option}</span>
                  </label>
                ))}
              </div>
            </div>
          ))}
        </div>

        <div className="mt-6 flex gap-3">
          <button
            onClick={onClose}
            className="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition"
          >
            Batal
          </button>
          <button
            onClick={handleSubmit}
            disabled={!allAnswered || submitting}
            className="flex-1 px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
          >
            {submitting ? 'Mengirim...' : 'Kirim Jawaban'}
          </button>
        </div>
      </div>
    </div>
  );
}
