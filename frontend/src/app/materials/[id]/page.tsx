'use client';

import { useEffect, useState, useCallback } from 'react';
import { useParams, useRouter } from 'next/navigation';
import { materialApi } from '@/services/api';
import { useAuth } from '@/contexts/AuthContext';
import ReadingTracker from '@/components/reading/ReadingTracker';
import ReadingQuiz from '@/components/reading/ReadingQuiz';
import NpcChatBubble from '@/components/npc/NpcChatBubble';

export default function MaterialReadPage() {
  const params = useParams();
  const router = useRouter();
  const { user } = useAuth();
  const materialId = Number(params.id);

  const [material, setMaterial] = useState<any>(null);
  const [loading, setLoading] = useState(true);
  const [showQuiz, setShowQuiz] = useState(false);
  const [readingResult, setReadingResult] = useState<any>(null);

  useEffect(() => {
    materialApi.get(materialId)
      .then((res) => setMaterial(res.data.data))
      .catch(() => router.push('/materials'))
      .finally(() => setLoading(false));
  }, [materialId, router]);

  const handleReadingComplete = useCallback((result: any) => {
    setReadingResult(result);
    if (result && !result.is_anomaly) {
      setShowQuiz(true);
    }
  }, []);

  const handleQuizComplete = useCallback((result: any) => {
    setShowQuiz(false);
  }, []);

  if (loading) {
    return (
      <div className="flex items-center justify-center py-20">
        <div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600"></div>
      </div>
    );
  }

  if (!material) return null;

  return (
    <ReadingTracker materialId={materialId} onReadingComplete={handleReadingComplete}>
      <div className="max-w-3xl mx-auto">
        <button
          onClick={() => router.push('/materials')}
          className="flex items-center gap-2 text-gray-500 hover:text-gray-700 mb-6 transition"
        >
          <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
          </svg>
          Kembali ke Materi
        </button>

        <div className="bg-white rounded-xl shadow p-8">
          <div className="flex items-start justify-between mb-6">
            <div>
              <h1 className="text-2xl font-bold text-gray-800">{material.title}</h1>
              <div className="flex items-center gap-2 mt-2">
                <span className="px-2 py-0.5 bg-primary-50 text-primary-700 rounded text-xs font-medium">
                  {material.subject?.name || 'Umum'}
                </span>
                {material.class && (
                  <span className="px-2 py-0.5 bg-blue-50 text-blue-700 rounded text-xs">
                    {material.class.name}
                  </span>
                )}
                <span className="text-xs text-gray-400">oleh {material.creator?.name || 'Guru'}</span>
              </div>
            </div>
          </div>

          <div className="prose prose-gray max-w-none">
            <p className="text-gray-700 leading-relaxed whitespace-pre-wrap">{material.content}</p>
          </div>

          {readingResult && !readingResult.is_anomaly && (
            <div className="mt-8 p-4 bg-green-50 rounded-xl border border-green-200">
              <h3 className="text-sm font-semibold text-green-800 mb-2">Reading Progress Recorded</h3>
              <div className="flex flex-wrap gap-2">
                {Object.entries(readingResult.xp_breakdown || {}).map(([key, value]) => (
                  <span key={key} className="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-medium">
                    +{value as number} XP ({key.replace(/_/g, ' ')})
                  </span>
                ))}
              </div>
              {readingResult.total_xp > 0 && (
                <p className="text-sm text-green-700 mt-2 font-medium">
                  Total: +{readingResult.total_xp} XP
                </p>
              )}
            </div>
          )}

          {readingResult?.is_anomaly && (
            <div className="mt-8 p-4 bg-yellow-50 rounded-xl border border-yellow-200">
              <h3 className="text-sm font-semibold text-yellow-800 mb-1">Reading Anomaly Detected</h3>
              <p className="text-xs text-yellow-700">XP bonus tidak diberikan karena aktivitas mencurigakan terdeteksi.</p>
            </div>
          )}
        </div>
      </div>

      {user?.role === 'siswa' && material.subject_id && (
        <NpcChatBubble materialId={materialId} subjectId={material.subject_id} />
      )}

      {showQuiz && (
        <ReadingQuiz
          materialId={materialId}
          materialTitle={material.title}
          onComplete={handleQuizComplete}
          onClose={() => setShowQuiz(false)}
        />
      )}
    </ReadingTracker>
  );
}
