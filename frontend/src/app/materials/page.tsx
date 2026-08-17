'use client';

import { useEffect, useState, useCallback } from 'react';
import { useRouter, useSearchParams } from 'next/navigation';
import { materialApi } from '@/services/api';
import { useAuth } from '@/contexts/AuthContext';
import ReadingTracker from '@/components/reading/ReadingTracker';
import ReadingQuiz from '@/components/reading/ReadingQuiz';
import NpcChatBubble from '@/components/npc/NpcChatBubble';

function MaterialDetail({ materialId, onBack }: { materialId: number; onBack: () => void }) {
  const { user } = useAuth();
  const [material, setMaterial] = useState<any>(null);
  const [loading, setLoading] = useState(true);
  const [showQuiz, setShowQuiz] = useState(false);
  const [readingResult, setReadingResult] = useState<any>(null);

  useEffect(() => {
    materialApi.get(materialId)
      .then((res) => setMaterial(res.data.data))
      .catch(() => onBack())
      .finally(() => setLoading(false));
  }, [materialId, onBack]);

  const handleReadingComplete = useCallback((result: any) => {
    setReadingResult(result);
    if (result && !result.is_anomaly) {
      setShowQuiz(true);
    }
  }, []);

  const handleQuizComplete = useCallback(() => {
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
          onClick={onBack}
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

export default function MaterialsPage() {
  const { user } = useAuth();
  const router = useRouter();
  const searchParams = useSearchParams();
  const materialId = searchParams.get('id');

  const [materials, setMaterials] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);
  const [expanded, setExpanded] = useState<number | null>(null);
  const [tabClass, setTabClass] = useState<number | 'all'>('all');
  const [tabSemester, setTabSemester] = useState<'all' | 'ganjil' | 'genap'>('all');

  useEffect(() => {
    if (!materialId) {
      materialApi.list()
        .then((res) => {
          const data = res.data.data;
          setMaterials(data.data || data || []);
        })
        .catch(() => {})
        .finally(() => setLoading(false));
    }
  }, [materialId]);

  if (materialId) {
    return (
      <MaterialDetail
        materialId={Number(materialId)}
        onBack={() => router.push('/materials')}
      />
    );
  }

  const grouped = materials.reduce<Record<string, any[]>>((acc, m) => {
    const key = m.class?.name || 'Umum';
    if (!acc[key]) acc[key] = [];
    acc[key].push(m);
    return acc;
  }, {});
  const classKeys = Object.keys(grouped);
  const filtered = materials.filter((m) => {
    if (tabClass !== 'all' && m.class?.id !== tabClass) return false;
    if (tabSemester !== 'all' && m.semester !== tabSemester) return false;
    return true;
  });

  if (loading) {
    return <div className="flex items-center justify-center py-20"><div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600"></div></div>;
  }

  return (
    <div>
      <div className="flex items-center justify-between mb-6">
        <h1 className="text-2xl font-bold text-gray-800">Materi</h1>
        {user?.role === 'guru' && (
          <button className="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition">
            + Tambah Materi
          </button>
        )}
      </div>

      {classKeys.length > 1 && (
        <div className="flex flex-wrap gap-2 mb-4">
          <button
            onClick={() => setTabClass('all')}
            className={`px-3 py-1.5 text-sm rounded-lg font-medium transition ${tabClass === 'all' ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'}`}
          >
            Semua Kelas
          </button>
          {classKeys.map((key) => (
            <button
              key={key}
              onClick={() => setTabClass(grouped[key][0].class?.id)}
              className={`px-3 py-1.5 text-sm rounded-lg font-medium transition ${tabClass === grouped[key][0].class?.id ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'}`}
            >
              {key}
            </button>
          ))}
        </div>
      )}

      <div className="flex flex-wrap gap-1.5 mb-4">
        {(['all', 'ganjil', 'genap'] as const).map((s) => (
          <button
            key={s}
            onClick={() => setTabSemester(s)}
            className={`px-2.5 py-1 text-xs rounded-lg font-medium transition ${tabSemester === s ? 'bg-amber-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'}`}
          >
            {s === 'all' ? 'Semua Semester' : s === 'ganjil' ? 'Semester Ganjil' : 'Semester Genap'}
          </button>
        ))}
      </div>

      {filtered.length === 0 ? (
        <div className="bg-white rounded-xl shadow p-12 text-center">
          <div className="text-4xl mb-3">📚</div>
          <p className="text-gray-400">Belum ada materi</p>
        </div>
      ) : (
        <div className="space-y-3">
          {filtered.map((m: any) => (
            <div key={m.id} className="bg-white rounded-xl shadow hover:shadow-md transition">
              <div
                className="p-5 cursor-pointer"
                onClick={() => setExpanded(expanded === m.id ? null : m.id)}
              >
                <div className="flex items-start justify-between">
                  <div className="flex-1">
                    <h3 className="font-semibold text-gray-800">{m.title}</h3>
                    <p className="text-sm text-gray-500 mt-1">{m.content?.slice(0, 120)}...</p>
                    <div className="flex items-center gap-2 mt-2">
                      <span className="px-2 py-0.5 bg-primary-50 text-primary-700 rounded text-xs font-medium">{m.subject?.name || 'Umum'}</span>
                      {m.class && <span className="px-2 py-0.5 bg-blue-50 text-blue-700 rounded text-xs">{m.class.name}</span>}
                      <span className="px-2 py-0.5 bg-amber-50 text-amber-700 rounded text-xs">{m.semester === 'ganjil' ? 'Ganjil' : 'Genap'}</span>
                      <span className="text-xs text-gray-400">oleh {m.creator?.name || 'Guru'}</span>
                      {m.is_published && <span className="px-2 py-0.5 bg-green-50 text-green-700 rounded text-xs">Published</span>}
                    </div>
                  </div>
                  <span className="text-gray-400 ml-2">{expanded === m.id ? '▲' : '▼'}</span>
                </div>
              </div>
              {expanded === m.id && (
                <div className="px-5 pb-5 border-t pt-4">
                  <p className="text-gray-700 leading-relaxed whitespace-pre-wrap">{m.content}</p>
                  {user?.role === 'siswa' && (
                    <button
                      onClick={() => router.push(`/materials?id=${m.id}`)}
                      className="mt-4 px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition"
                    >
                      Baca Materi & Dapatkan XP
                    </button>
                  )}
                </div>
              )}
            </div>
          ))}
        </div>
      )}
    </div>
  );
}
