'use client';

import { useEffect, useState } from 'react';
import { assignmentApi, submissionApi } from '@/services/api';
import { useAuth } from '@/contexts/AuthContext';

export default function SubmissionsPage() {
  const { user } = useAuth();
  const [assignments, setAssignments] = useState<any[]>([]);
  const [selectedAsg, setSelectedAsg] = useState<any>(null);
  const [submissions, setSubmissions] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);
  const [loadingSubs, setLoadingSubs] = useState(false);
  const [tabClass, setTabClass] = useState<number | 'all'>('all');
  const [tabSemester, setTabSemester] = useState<'all' | 'ganjil' | 'genap'>('all');
  const [gradeModal, setGradeModal] = useState<any>(null);
  const [score, setScore] = useState('');
  const [feedback, setFeedback] = useState('');
  const [grading, setGrading] = useState(false);
  const [successMsg, setSuccessMsg] = useState('');

  useEffect(() => {
    if (user?.role !== 'guru') return;
    loadAssignments();
  }, [user]);

  const loadAssignments = async () => {
    try {
      const res = await assignmentApi.list();
      const data = res.data.data;
      setAssignments(data.data || data || []);
    } catch (e) {} finally { setLoading(false); }
  };

  const grouped = assignments.reduce<Record<string, any[]>>((acc, a) => {
    const key = a.class?.name || 'Umum';
    if (!acc[key]) acc[key] = [];
    acc[key].push(a);
    return acc;
  }, {});
  const classKeys = Object.keys(grouped);
  const filtered = assignments.filter((a) => {
    if (tabClass !== 'all' && a.class?.id !== tabClass) return false;
    if (tabSemester !== 'all' && a.semester !== tabSemester) return false;
    return true;
  });

  const loadSubmissions = async (asg: any) => {
    setSelectedAsg(asg);
    setLoadingSubs(true);
    setSubmissions([]);
    try {
      const res = await submissionApi.list(asg.id);
      const data = res.data.data;
      setSubmissions(data.data || data || []);
    } catch (e) { console.error(e); } finally { setLoadingSubs(false); }
  };

  const handleGrade = async () => {
    const numScore = parseFloat(score);
    if (isNaN(numScore) || numScore < 0) {
      alert('Skor harus angka positif');
      return;
    }
    setGrading(true);
    try {
      const res = await submissionApi.grade(gradeModal.id, {
        score: numScore,
        feedback: feedback || null,
      });
      setSuccessMsg(`Penilaian berhasil! Siswa mendapat +${selectedAsg.xp_reward} XP`);
      setGradeModal(null); setScore(''); setFeedback('');
      loadSubmissions(selectedAsg);
      setTimeout(() => setSuccessMsg(''), 4000);
    } catch (err: any) {
      alert(err.response?.data?.message || 'Gagal menilai');
    } finally { setGrading(false); }
  };

  if (user?.role !== 'guru') {
    return <div className="text-center py-20 text-gray-500">Halaman ini hanya untuk guru</div>;
  }

  if (loading) {
    return <div className="flex items-center justify-center py-20"><div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600"></div></div>;
  }

  return (
    <div>
      <h1 className="text-2xl font-bold text-gray-800 mb-1">Periksa Tugas Siswa</h1>
      <p className="text-sm text-gray-500 mb-6">Pilih tugas untuk melihat pengumpulan siswa dan memberikan penilaian</p>

      {successMsg && (
        <div className="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">✅ {successMsg}</div>
      )}

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* Assignment List */}
        <div className="lg:col-span-1">
          <h2 className="text-sm font-semibold text-gray-600 mb-3">Daftar Tugas</h2>

          {classKeys.length > 1 && (
            <div className="flex flex-wrap gap-1.5 mb-3">
              <button
                onClick={() => setTabClass('all')}
                className={`px-2.5 py-1 text-xs rounded-lg font-medium transition ${tabClass === 'all' ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'}`}
              >
                Semua
              </button>
              {classKeys.map((key) => (
                <button
                  key={key}
                  onClick={() => setTabClass(grouped[key][0].class?.id)}
                  className={`px-2.5 py-1 text-xs rounded-lg font-medium transition ${tabClass === grouped[key][0].class?.id ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'}`}
                >
                  {key}
                </button>
              ))}
            </div>
          )}

          {/* Tab Semester */}
          <div className="flex flex-wrap gap-1.5 mb-3">
            {(['all', 'ganjil', 'genap'] as const).map((s) => (
              <button
                key={s}
                onClick={() => setTabSemester(s)}
                className={`px-2.5 py-1 text-xs rounded-lg font-medium transition ${tabSemester === s ? 'bg-amber-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'}`}
              >
                {s === 'all' ? 'Semua Semester' : s === 'ganjil' ? 'Ganjil' : 'Genap'}
              </button>
            ))}
          </div>

          <div className="space-y-2">
            {filtered.map((a: any) => (
              <button
                key={a.id}
                onClick={() => loadSubmissions(a)}
                className={`w-full text-left p-4 rounded-xl border transition ${
                  selectedAsg?.id === a.id
                    ? 'bg-primary-50 border-primary-300 shadow-sm'
                    : 'bg-white border-gray-200 hover:border-primary-200 hover:shadow-sm'
                }`}
              >
                <div className="font-medium text-sm text-gray-800">{a.title}</div>
                <div className="text-xs text-gray-500 mt-1">
                  {a.subject?.name || 'Umum'} • +{a.xp_reward} XP
                  {a.class && <span className="ml-1.5 px-1.5 py-0.5 bg-blue-50 text-blue-700 rounded text-[10px]">{a.class.name}</span>}
                  <span className="ml-1.5 px-1.5 py-0.5 bg-amber-50 text-amber-700 rounded text-[10px]">{a.semester === 'ganjil' ? 'Ganjil' : 'Genap'}</span>
                </div>
              </button>
            ))}
          </div>
        </div>

        {/* Submissions */}
        <div className="lg:col-span-2">
          {!selectedAsg ? (
            <div className="bg-white rounded-xl shadow p-12 text-center text-gray-400">
              <div className="text-4xl mb-3">👈</div>
              <p>Pilih tugas di sebelah kiri</p>
            </div>
          ) : (
            <div>
              <div className="flex items-center justify-between mb-4">
                <div>
                  <h2 className="font-semibold text-gray-800">{selectedAsg.title}</h2>
                  <p className="text-xs text-gray-500">{selectedAsg.description?.slice(0, 80)}...</p>
                </div>
                <span className="text-xs text-gray-400">+{selectedAsg.xp_reward} XP per siswa</span>
              </div>

              {loadingSubs ? (
                <div className="bg-white rounded-xl shadow p-8 text-center"><div className="animate-spin rounded-full h-8 w-8 border-b-2 border-primary-600 mx-auto"></div></div>
              ) : submissions.length === 0 ? (
                <div className="bg-white rounded-xl shadow p-8 text-center text-gray-400">
                  <div className="text-3xl mb-2">📭</div>
                  <p>Belum ada pengumpulan</p>
                </div>
              ) : (
                <div className="space-y-3">
                  {submissions.map((sub: any) => (
                    <div key={sub.id} className={`bg-white rounded-xl shadow p-5 border-l-4 transition ${
                      sub.status === 'graded' ? 'border-l-green-400' : sub.status === 'revised' ? 'border-l-orange-400' : 'border-l-yellow-400'
                    }`}>
                      <div className="flex items-start justify-between">
                        <div className="flex-1">
                          <div className="flex items-center gap-2 mb-2">
                            <div className="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold text-xs">
                              {sub.student?.name?.charAt(0) || '?'}
                            </div>
                            <div>
                              <span className="font-medium text-sm">{sub.student?.name || 'Siswa'}</span>
                              <span className="text-xs text-gray-400 ml-2">
                                {sub.submitted_at ? new Date(sub.submitted_at).toLocaleString('id-ID') : ''}
                              </span>
                            </div>
                            <span className={`px-2 py-0.5 rounded text-xs font-medium ${
                              sub.status === 'graded' ? 'bg-green-50 text-green-700' :
                              sub.status === 'revised' ? 'bg-orange-50 text-orange-700' :
                              'bg-yellow-50 text-yellow-700'
                            }`}>
                              {sub.status === 'graded' ? '✓ Dinilai' : sub.status === 'revised' ? '📝 Revisi' : '⏳ Baru'}
                            </span>
                          </div>

                          <div className="p-3 bg-gray-50 rounded-lg text-sm text-gray-700 whitespace-pre-wrap">
                            {sub.answer_text || '(Tidak ada jawaban)'}
                          </div>

                          {sub.status === 'graded' && sub.grade && (
                            <div className="mt-2 p-3 bg-green-50 rounded-lg text-sm">
                              <span className="font-semibold text-green-700">Nilai: {sub.grade.score}</span>
                              {sub.grade.feedback && <span className="text-green-600 ml-2">— {sub.grade.feedback}</span>}
                            </div>
                          )}
                        </div>

                        <div className="ml-4">
                          {sub.status !== 'graded' ? (
                            <button
                              onClick={() => { setGradeModal(sub); setScore(''); setFeedback(''); }}
                              className="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition whitespace-nowrap"
                            >
                              Beri Nilai
                            </button>
                          ) : (
                            <button
                              onClick={() => { setGradeModal(sub); setScore(String(sub.grade?.score || '')); setFeedback(sub.grade?.feedback || ''); }}
                              className="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200 transition whitespace-nowrap"
                            >
                              Edit Nilai
                            </button>
                          )}
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              )}
            </div>
          )}
        </div>
      </div>

      {/* Grade Modal */}
      {gradeModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center">
          <div className="absolute inset-0 bg-black/40" onClick={() => setGradeModal(null)} />
          <div className="relative bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6">
            <h2 className="text-lg font-bold text-gray-800 mb-1">Beri Nilai</h2>
            <p className="text-sm text-gray-500 mb-4">{gradeModal.student?.name} — {selectedAsg.title}</p>

            <div className="mb-3 p-3 bg-gray-50 rounded-lg text-sm text-gray-600">
              <strong>Jawaban:</strong>
              <p className="mt-1 whitespace-pre-wrap">{gradeModal.answer_text || '(Kosong)'}</p>
            </div>

            <div className="space-y-3">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Nilai (0 - {selectedAsg.max_score})</label>
                <input
                  type="number"
                  min={0}
                  max={selectedAsg.max_score}
                  value={score}
                  onChange={(e) => setScore(e.target.value)}
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500"
                  placeholder="85"
                  autoFocus
                />
                <div className="text-xs text-gray-400 mt-1">Siswa akan mendapat +{selectedAsg.xp_reward} XP setelah dinilai</div>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Feedback (opsional)</label>
                <textarea
                  value={feedback}
                  onChange={(e) => setFeedback(e.target.value)}
                  rows={3}
                  className="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 resize-none"
                  placeholder="Bagus, ada sedikit revisi di bagian..."
                />
              </div>
            </div>

            <div className="flex justify-end gap-3 mt-4">
              <button onClick={() => setGradeModal(null)} className="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 transition">Batal</button>
              <button
                onClick={handleGrade}
                disabled={grading || !score}
                className="px-5 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition disabled:opacity-50"
              >
                {grading ? 'Menyimpan...' : 'Simpan Nilai'}
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
