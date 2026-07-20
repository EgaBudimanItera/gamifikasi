'use client';

import { useEffect, useState } from 'react';
import api from '@/services/api';

export default function AdminSchoolsPage() {
  const [schools, setSchools] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api.get('/schools')
      .then((res) => setSchools(res.data.data || []))
      .catch(() => {})
      .finally(() => setLoading(false));
  }, []);

  if (loading) {
    return <div className="flex items-center justify-center py-20"><div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600"></div></div>;
  }

  return (
    <div>
      <div className="flex items-center justify-between mb-6">
        <h1 className="text-2xl font-bold text-gray-800">Manajemen Sekolah</h1>
        <button className="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition">
          + Tambah Sekolah
        </button>
      </div>

      {schools.length === 0 ? (
        <div className="bg-white rounded-xl shadow p-12 text-center">
          <div className="text-4xl mb-3">🏫</div>
          <p className="text-gray-400">Belum ada data sekolah</p>
        </div>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          {schools.map((s: any) => (
            <div key={s.id} className="bg-white rounded-xl shadow p-5 hover:shadow-md transition">
              <h3 className="font-semibold text-gray-800">{s.name}</h3>
              <p className="text-sm text-gray-500 mt-1">{s.address}</p>
              <div className="flex items-center gap-3 mt-2 text-xs text-gray-400">
                {s.phone && <span>📞 {s.phone}</span>}
                {s.email && <span>✉️ {s.email}</span>}
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}
