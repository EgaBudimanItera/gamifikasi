'use client';

import { useEffect, useState } from 'react';
import { useRouter } from 'next/navigation';
import { materialApi } from '@/services/api';
import { useAuth } from '@/contexts/AuthContext';

export default function MaterialsPage() {
  const { user } = useAuth();
  const router = useRouter();
  const [materials, setMaterials] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);
  const [expanded, setExpanded] = useState<number | null>(null);
  const [tabClass, setTabClass] = useState<number | 'all'>('all');
  const [tabSemester, setTabSemester] = useState<'all' | 'ganjil' | 'genap'>('all');

  useEffect(() => {
    materialApi.list()
      .then((res) => {
        const data = res.data.data;
        setMaterials(data.data || data || []);
      })
      .catch(() => {})
      .finally(() => setLoading(false));
  }, []);

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

      {/* Tab Kelas */}
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

      {/* Tab Semester */}
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
                      onClick={() => router.push(`/materials/${m.id}`)}
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
