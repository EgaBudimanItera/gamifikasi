'use client';

import { useEffect, useState } from 'react';
import { dashboardApi, subjectsApi } from '@/services/api';
import type { TeacherDashboard, Teaching } from '@/types';

export default function TeacherDashboard() {
  const [dashboard, setDashboard] = useState<TeacherDashboard | null>(null);
  const [teachings, setTeachings] = useState<Teaching[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    Promise.all([
      dashboardApi.teacher(),
      subjectsApi.mySubjects(),
    ])
      .then(([dashRes, subjRes]) => {
        setDashboard(dashRes.data.data);
        setTeachings(subjRes.data.data || []);
      })
      .catch(console.error)
      .finally(() => setLoading(false));
  }, []);

  if (loading) {
    return (
      <div className="flex items-center justify-center py-20">
        <div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600"></div>
      </div>
    );
  }

  return (
    <div>
      <h1 className="text-2xl font-bold text-gray-800 mb-6">Dashboard Guru</h1>

      <div className="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div className="bg-white rounded-xl shadow p-5">
          <div className="text-2xl font-bold text-primary-600">{dashboard?.total_students || 0}</div>
          <div className="text-sm text-gray-500 mt-1">Total Siswa</div>
        </div>
        <div className="bg-white rounded-xl shadow p-5">
          <div className="text-2xl font-bold text-green-600">{dashboard?.active_assignments || 0}</div>
          <div className="text-sm text-gray-500 mt-1">Tugas Aktif</div>
        </div>
        <div className="bg-white rounded-xl shadow p-5">
          <div className="text-2xl font-bold text-yellow-600">{dashboard?.total_materials || 0}</div>
          <div className="text-sm text-gray-500 mt-1">Total Materi</div>
        </div>
        <div className="bg-white rounded-xl shadow p-5">
          <div className="text-2xl font-bold text-purple-600">{teachings.length}</div>
          <div className="text-sm text-gray-500 mt-1">Kelas Diampu</div>
        </div>
      </div>

      <div className="mb-8">
        <h2 className="text-lg font-semibold text-gray-800 mb-4">Kelas yang Saya Ampu</h2>
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          {teachings.map((t) => (
            <div key={t.class_id} className="bg-white rounded-xl shadow p-5 border-l-4 border-primary-500">
              <div className="flex items-start justify-between mb-3">
                <div>
                  <h3 className="font-semibold text-gray-800">{t.class_name}</h3>
                  <p className="text-xs text-gray-400">{t.academic_year}</p>
                </div>
                <span className="text-xs bg-primary-50 text-primary-700 px-2 py-1 rounded-full font-medium">
                  {t.subjects.length} mapel
                </span>
              </div>
              <div className="flex flex-wrap gap-2">
                {t.subjects.map((s) => (
                  <span
                    key={s.subject_id}
                    className="text-xs bg-gray-100 text-gray-600 px-3 py-1 rounded-full"
                  >
                    {s.subject_name}
                    {s.semester && <span className="ml-1 text-[10px] opacity-60">({s.semester})</span>}
                  </span>
                ))}
              </div>
            </div>
          ))}
          {teachings.length === 0 && (
            <p className="text-gray-400 text-sm col-span-full">Belum ada kelas yang diampu.</p>
          )}
        </div>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div className="bg-white rounded-xl shadow p-6">
          <h2 className="text-sm font-semibold text-gray-600 mb-4">Aksi Cepat</h2>
          <div className="space-y-3">
            <a href="/assignments" className="block w-full p-3 bg-primary-50 hover:bg-primary-100 rounded-lg font-medium text-primary-700 transition text-sm">
              Kelola Tugas
            </a>
            <a href="/materials" className="block w-full p-3 bg-green-50 hover:bg-green-100 rounded-lg font-medium text-green-700 transition text-sm">
              Kelola Materi
            </a>
            <a href="/leaderboard" className="block w-full p-3 bg-purple-50 hover:bg-purple-100 rounded-lg font-medium text-purple-700 transition text-sm">
              Lihat Leaderboard
            </a>
          </div>
        </div>

        <div className="bg-white rounded-xl shadow p-6">
          <h2 className="text-sm font-semibold text-gray-600 mb-4">Ringkasan</h2>
          <div className="space-y-3">
            <div className="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
              <span className="text-sm text-gray-600">Total Siswa</span>
              <span className="font-semibold">{dashboard?.total_students || 0}</span>
            </div>
            <div className="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
              <span className="text-sm text-gray-600">Tugas Aktif</span>
              <span className="font-semibold">{dashboard?.active_assignments || 0}</span>
            </div>
            <div className="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
              <span className="text-sm text-gray-600">Total Materi</span>
              <span className="font-semibold">{dashboard?.total_materials || 0}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
