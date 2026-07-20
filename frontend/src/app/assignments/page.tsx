'use client';

import { useEffect, useState } from 'react';
import { assignmentApi, submissionApi } from '@/services/api';
import { useAuth } from '@/contexts/AuthContext';

export default function AssignmentsPage() {
  const { user } = useAuth();
  const [assignments, setAssignments] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);
  const [modal, setModal] = useState<{ type: 'submit' | 'revise'; assignment: any } | null>(null);
  const [answerText, setAnswerText] = useState('');
  const [submitting, setSubmitting] = useState(false);
  const [successMsg, setSuccessMsg] = useState('');
  const [errorMsg, setErrorMsg] = useState('');
  const [tabClass, setTabClass] = useState<number | 'all'>('all');
  const [tabSemester, setTabSemester] = useState<'all' | 'ganjil' | 'genap'>('all');

  useEffect(() => { loadAssignments(); }, []);

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

  const handleSubmit = async () => {
    if (!answerText.trim()) { setErrorMsg('Jawaban tidak boleh kosong'); return; }
    setSubmitting(true); setErrorMsg('');
    try {
      await submissionApi.submit(modal!.assignment.id, { answer_text: answerText });
      setSuccessMsg(`Tugas "${modal!.assignment.title}" berhasil dikumpulkan!`);
      setModal(null); setAnswerText('');
      loadAssignments();
      setTimeout(() => setSuccessMsg(''), 4000);
    } catch (err: any) {
      setErrorMsg(err.response?.data?.message || 'Gagal mengumpulkan tugas');
    } finally { setSubmitting(false); }
  };

  const handleRevise = async () => {
    if (!answerText.trim()) { setErrorMsg('Jawaban tidak boleh kosong'); return; }
    setSubmitting(true); setErrorMsg('');
    try {
      const subId = modal!.assignment.my_submission?.id;
      await submissionApi.revise(subId, { answer_text: answerText });
      setSuccessMsg(`Revisi tugas "${modal!.assignment.title}" berhasil dikumpulkan!`);
      setModal(null); setAnswerText('');
      loadAssignments();
      setTimeout(() => setSuccessMsg(''), 4000);
    } catch (err: any) {
      setErrorMsg(err.response?.data?.message || 'Gagal merevisi tugas');
    } finally { setSubmitting(false); }
  };

  const getDaysLeft = (deadline: string) => {
    const diff = Math.ceil((new Date(deadline).getTime() - Date.now()) / (1000 * 60 * 60 * 24));
    if (diff < 0) return { text: 'Terlambat', color: 'text-red-500' };
    if (diff === 0) return { text: 'Hari ini!', color: 'text-red-500 font-bold' };
    return { text: `${diff} hari lagi`, color: 'text-orange-500' };
  };

  const getStatusBadge = (sub: any) => {
    if (!sub) return null;
    switch (sub.status) {
      case 'pending': return <span className="px-2 py-0.5 bg-yellow-50 text-yellow-700 rounded text-xs font-medium border border-yellow-200">⏳ Menunggu Diperiksa</span>;
      case 'graded': return <span className="px-2 py-0.5 bg-green-50 text-green-700 rounded text-xs font-medium border border-green-200">✅ Dinilai: {sub.grade?.score ?? '-'}</span>;
      case 'revised': return <span className="px-2 py-0.5 bg-orange-50 text-orange-700 rounded text-xs font-medium border border-orange-200">📝 Revisi</span>;
      default: return null;
    }
  };

  if (loading) {
    return <div className="flex items-center justify-center py-20"><div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600"></div></div>;
  }

  return (
    <div>
      <div className="flex items-center justify-between mb-6">
        <h1 className="text-2xl font-bold text-gray-800">Tugas</h1>
        {user?.role === 'guru' && (
          <a href="/submissions" className="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition">
            Periksa Tugas Siswa
          </a>
        )}
      </div>

      {successMsg && (
        <div className="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm flex items-center gap-2">
          ✅ {successMsg}
        </div>
      )}

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
          <div className="text-4xl mb-3">📝</div>
          <p className="text-gray-400">Belum ada tugas</p>
        </div>
      ) : (
        <div className="space-y-3">
          {filtered.map((a: any) => {
            const deadline = a.deadline ? getDaysLeft(a.deadline) : null;
            const sub = a.my_submission;
            const isGraded = sub?.status === 'graded';
            const isRevisable = sub?.status === 'revised' || isGraded;

            return (
              <div key={a.id} className={`bg-white rounded-xl shadow p-5 hover:shadow-md transition ${sub ? 'border-l-4 border-l-green-400' : ''}`}>
                <div className="flex items-start justify-between">
                  <div className="flex-1">
                    <div className="flex items-center gap-2 mb-1 flex-wrap">
                      <span className="px-2 py-0.5 bg-primary-50 text-primary-700 rounded text-xs font-medium">{a.subject?.name || 'Umum'}</span>
                      {a.class && <span className="px-2 py-0.5 bg-blue-50 text-blue-700 rounded text-xs">{a.class.name}</span>}
                      <span className="px-2 py-0.5 bg-amber-50 text-amber-700 rounded text-xs">{a.semester === 'ganjil' ? 'Ganjil' : 'Genap'}</span>
                      {a.is_published && <span className="px-2 py-0.5 bg-green-50 text-green-700 rounded text-xs">Aktif</span>}
                      {getStatusBadge(sub)}
                    </div>
                    <h3 className="font-semibold text-gray-800">{a.title}</h3>
                    <p className="text-sm text-gray-500 mt-1">{a.description}</p>
                    <div className="flex items-center gap-4 mt-2 text-xs">
                      <span className="text-gray-400">Skor Maks: {a.max_score}</span>
                      <span className="text-yellow-600 font-semibold">+{a.xp_reward} XP</span>
                      {deadline && <span className={`font-medium ${deadline.color}`}>{deadline.text}</span>}
                    </div>
                    {sub && sub.status === 'graded' && sub.grade?.feedback && (
                      <div className="mt-2 p-2 bg-blue-50 rounded text-xs text-blue-700">
                        💬 Feedback guru: {sub.grade.feedback}
                      </div>
                    )}
                  </div>

                  {user?.role === 'siswa' && (
                    <div className="ml-4 text-right space-y-1">
                      {!sub && (
                        <button
                          onClick={() => { setModal({ type: 'submit', assignment: a }); setErrorMsg(''); setAnswerText(''); }}
                          className="block px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition whitespace-nowrap"
                        >
                          Kumpulkan
                        </button>
                      )}
                      {sub && (sub.status === 'graded' || sub.status === 'revised') && (
                        <button
                          onClick={() => { setModal({ type: 'revise', assignment: a }); setErrorMsg(''); setAnswerText(sub.answer_text || ''); }}
                          className="block px-4 py-2 bg-orange-500 text-white rounded-lg text-sm font-medium hover:bg-orange-600 transition whitespace-nowrap"
                        >
                          {sub.status === 'graded' ? 'Lihat & Revisi' : 'Edit Revisi'}
                        </button>
                      )}
                      {sub && sub.status === 'pending' && (
                        <span className="block text-xs text-yellow-600 font-medium py-2">Menunggu penilaian guru...</span>
                      )}
                    </div>
                  )}
                </div>
              </div>
            );
          })}
        </div>
      )}

      {/* Submit / Revise Modal */}
      {modal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center">
          <div className="absolute inset-0 bg-black/40" onClick={() => setModal(null)} />
          <div className="relative bg-white rounded-xl shadow-xl w-full max-w-lg mx-4">
            <div className="p-6">
              <div className="flex items-center justify-between mb-4">
                <div>
                  <h2 className="text-lg font-bold text-gray-800">
                    {modal.type === 'submit' ? 'Kumpulkan Tugas' : 'Revisi Tugas'}
                  </h2>
                  <p className="text-sm text-gray-500">{modal.assignment.title}</p>
                </div>
                <span className="text-yellow-500 font-bold text-sm">+{modal.assignment.xp_reward} XP</span>
              </div>

              {errorMsg && (
                <div className="mb-3 p-2 bg-red-50 border border-red-200 text-red-600 rounded text-sm">{errorMsg}</div>
              )}

              {modal.type === 'revise' && modal.assignment.my_submission?.grade?.score != null && (
                <div className="mb-3 p-3 bg-green-50 rounded-lg text-sm">
                  <div className="font-medium text-green-700">Nilai sebelumnya: {modal.assignment.my_submission.grade.score}</div>
                  {modal.assignment.my_submission.grade.feedback && (
                    <div className="text-green-600 mt-1">Feedback: {modal.assignment.my_submission.grade.feedback}</div>
                  )}
                </div>
              )}

              <label className="block text-sm font-medium text-gray-700 mb-1">Jawaban</label>
              <textarea
                value={answerText}
                onChange={(e) => setAnswerText(e.target.value)}
                rows={6}
                placeholder="Tuliskan jawaban atau link GitHub Anda..."
                className="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 resize-none"
                autoFocus
              />
            </div>
            <div className="flex justify-end gap-3 px-6 py-4 border-t bg-gray-50 rounded-b-xl">
              <button onClick={() => setModal(null)} className="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 transition">Batal</button>
              <button
                onClick={modal.type === 'submit' ? handleSubmit : handleRevise}
                disabled={submitting || !answerText.trim()}
                className="px-5 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition disabled:opacity-50"
              >
                {submitting ? 'Mengirim...' : modal.type === 'submit' ? 'Kumpulkan Sekarang' : 'Kirim Revisi'}
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
