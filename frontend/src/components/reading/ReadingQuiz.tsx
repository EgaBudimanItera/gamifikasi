'use client';

import { useState } from 'react';
import { readingApi } from '@/services/api';
import { ReadingQuiz as ReadingQuizType } from '@/types';

interface ReadingQuizProps {
  materialId: number;
  materialTitle: string;
  onComplete: (result: any) => void;
  onClose: () => void;
}

export default function ReadingQuiz({ materialId, materialTitle, onComplete, onClose }: ReadingQuizProps) {
  const [questions, setQuestions] = useState<ReadingQuizType[]>([]);
  const [answers, setAnswers] = useState<Record<number, string>>({});
  const [loading, setLoading] = useState(true);
  const [submitting, setSubmitting] = useState(false);
  const [result, setResult] = useState<any>(null);

  const fetchQuiz = async () => {
    try {
      const res = await readingApi.quiz(materialId);
      setQuestions(res.data.data);
    } catch (err) {
      console.error('Failed to fetch quiz:', err);
    } finally {
      setLoading(false);
    }
  };

  useState(() => {
    fetchQuiz();
  });

  const handleAnswer = (questionId: number, answer: string) => {
    setAnswers((prev) => ({ ...prev, [questionId]: answer }));
  };

  const handleSubmit = async () => {
    setSubmitting(true);
    try {
      const res = await readingApi.submitQuiz(materialId, answers);
      setResult(res.data.data);
      onComplete(res.data.data);
    } catch (err) {
      console.error('Failed to submit quiz:', err);
    } finally {
      setSubmitting(false);
    }
  };

  const allAnswered = questions.every((q) => answers[q.id]);

  if (loading) {
    return (
      <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div className="bg-white rounded-2xl p-8 max-w-md w-full mx-4 text-center">
          <div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600 mx-auto"></div>
          <p className="mt-4 text-gray-500">Memuat quiz...</p>
        </div>
      </div>
    );
  }

  if (result) {
    return (
      <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div className="bg-white rounded-2xl p-8 max-w-md w-full mx-4 text-center">
          <div className="text-5xl mb-4">{result.passed ? '🎉' : '📝'}</div>
          <h3 className="text-xl font-bold text-gray-800 mb-2">
            {result.passed ? 'Quiz Berhasil!' : 'Coba Lagi Nanti'}
          </h3>
          <p className="text-gray-600 mb-4">
            {result.correct_answers} dari {result.total_questions} soal benar
          </p>
          {result.xp_earned > 0 && (
            <div className="inline-flex items-center gap-1 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium mb-4">
              +{result.xp_earned} XP
            </div>
          )}
          {!result.passed && (
            <p className="text-sm text-gray-500 mb-4">Anda dapat mengulang quiz setelah 10 menit</p>
          )}
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
      <div className="bg-white rounded-2xl p-6 max-w-lg w-full mx-4 max-h-[80vh] overflow-y-auto">
        <div className="flex items-center justify-between mb-6">
          <div>
            <h3 className="text-lg font-bold text-gray-800">Quiz Materi</h3>
            <p className="text-sm text-gray-500">{materialTitle}</p>
          </div>
          <button onClick={onClose} className="text-gray-400 hover:text-gray-600">
            <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <div className="space-y-6">
          {questions.map((q, idx) => (
            <div key={q.id} className="bg-gray-50 rounded-xl p-4">
              <div className="flex items-start gap-3 mb-3">
                <span className="flex-shrink-0 w-7 h-7 bg-primary-100 text-primary-700 rounded-full flex items-center justify-center text-sm font-bold">
                  {idx + 1}
                </span>
                <p className="text-gray-800 font-medium">{q.question}</p>
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
            className="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition"
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
