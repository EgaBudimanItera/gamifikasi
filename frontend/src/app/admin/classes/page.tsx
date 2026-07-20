'use client';

import { useEffect, useState, useCallback } from 'react';
import api, { classApi, subjectApi, classSubjectApi, userApi } from '@/services/api';
import type { Class, Subject, ClassSubject, User } from '@/types';

type Tab = 'classes' | 'subjects' | 'assignments';

export default function AdminClassesPage() {
  const [tab, setTab] = useState<Tab>('classes');
  const [loading, setLoading] = useState(true);

  const [classes, setClasses] = useState<Class[]>([]);
  const [subjects, setSubjects] = useState<Subject[]>([]);
  const [assignments, setAssignments] = useState<ClassSubject[]>([]);
  const [teachers, setTeachers] = useState<User[]>([]);
  const [academicYears, setAcademicYears] = useState<any[]>([]);
  const [schools, setSchools] = useState<any[]>([]);

  const [showClassModal, setShowClassModal] = useState(false);
  const [showSubjectModal, setShowSubjectModal] = useState(false);
  const [showAssignModal, setShowAssignModal] = useState(false);
  const [editingClass, setEditingClass] = useState<Class | null>(null);
  const [editingSubject, setEditingSubject] = useState<Subject | null>(null);

  const [classForm, setClassForm] = useState({ school_id: 1, academic_year_id: 2, name: '', grade_level: 12 });
  const [subjectForm, setSubjectForm] = useState({ school_id: 1, name: '', code: '', description: '' });
  const [assignForm, setAssignForm] = useState({ class_id: 0, subject_id: 0, user_id: 0, semester: 'ganjil' });

  const [error, setError] = useState('');
  const [detailClass, setDetailClass] = useState<Class | null>(null);
  const [classSubjects, setClassSubjects] = useState<ClassSubject[]>([]);

  const loadData = useCallback(async () => {
    setLoading(true);
    try {
      const [clsRes, subRes, assignRes, teacherRes, ayRes, schRes] = await Promise.all([
        classApi.list({ per_page: 50 }),
        subjectApi.list({ per_page: 50 }),
        classSubjectApi.list({ per_page: 100 }),
        userApi.list({ role_id: 2, per_page: 50 }),
        api.get('/academic-years'),
        api.get('/schools'),
      ]);
      setClasses(clsRes.data.data || []);
      setSubjects(subRes.data.data || []);
      setAssignments(assignRes.data.data || []);
      setTeachers((teacherRes.data.data || []).filter((u: User) => u.role === 'guru'));
      setAcademicYears(ayRes.data.data || []);
      setSchools(schRes.data.data || []);
    } catch {
      setError('Gagal memuat data');
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => { loadData(); }, [loadData]);

  const loadClassDetail = async (cls: Class) => {
    setDetailClass(cls);
    try {
      const res = await classApi.subjects(cls.id);
      setClassSubjects(res.data.data || []);
    } catch {
      setClassSubjects([]);
    }
  };

  const handleClassSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setError('');
    try {
      if (editingClass) {
        await classApi.update(editingClass.id, { name: classForm.name, grade_level: classForm.grade_level });
      } else {
        await classApi.create(classForm);
      }
      setShowClassModal(false);
      setEditingClass(null);
      setClassForm({ school_id: 1, academic_year_id: 2, name: '', grade_level: 12 });
      loadData();
    } catch (err: any) {
      setError(err.response?.data?.message || 'Gagal menyimpan kelas');
    }
  };

  const handleSubjectSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setError('');
    try {
      if (editingSubject) {
        await subjectApi.update(editingSubject.id, { name: subjectForm.name, description: subjectForm.description });
      } else {
        await subjectApi.create(subjectForm);
      }
      setShowSubjectModal(false);
      setEditingSubject(null);
      setSubjectForm({ school_id: 1, name: '', code: '', description: '' });
      loadData();
    } catch (err: any) {
      setError(err.response?.data?.message || 'Gagal menyimpan mata pelajaran');
    }
  };

  const handleAssignSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setError('');
    try {
      await classSubjectApi.create(assignForm);
      setShowAssignModal(false);
      setAssignForm({ class_id: 0, subject_id: 0, user_id: 0, semester: 'ganjil' });
      loadData();
      if (detailClass) {
        const res = await classApi.subjects(detailClass.id);
        setClassSubjects(res.data.data || []);
      }
    } catch (err: any) {
      setError(err.response?.data?.message || 'Gagal menugaskan guru');
    }
  };

  const handleDeleteClass = async (id: number) => {
    if (!confirm('Hapus kelas ini?')) return;
    try {
      await classApi.delete(id);
      setDetailClass(null);
      loadData();
    } catch {
      setError('Gagal menghapus kelas');
    }
  };

  const handleDeleteSubject = async (id: number) => {
    if (!confirm('Hapus mata pelajaran ini?')) return;
    try {
      await subjectApi.delete(id);
      loadData();
    } catch {
      setError('Gagal menghapus mata pelajaran');
    }
  };

  const handleDeleteAssignment = async (id: number) => {
    if (!confirm('Hapus penugasan ini?')) return;
    try {
      await classSubjectApi.delete(id);
      loadData();
      if (detailClass) {
        const res = await classApi.subjects(detailClass.id);
        setClassSubjects(res.data.data || []);
      }
    } catch {
      setError('Gagal menghapus penugasan');
    }
  };

  const tabs: { key: Tab; label: string; icon: string }[] = [
    { key: 'classes', label: 'Kelas', icon: '🏫' },
    { key: 'subjects', label: 'Mata Pelajaran', icon: '📚' },
    { key: 'assignments', label: 'Penugasan Guru', icon: '👩‍🏫' },
  ];

  if (loading) {
    return <div className="flex items-center justify-center py-20"><div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600" /></div>;
  }

  return (
    <div>
      <h1 className="text-2xl font-bold text-gray-800 mb-6">Manajemen Kelas & Penugasan</h1>

      {error && (
        <div className="mb-4 px-4 py-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
          {error}
          <button onClick={() => setError('')} className="ml-2 underline">tutup</button>
        </div>
      )}

      {/* Tabs */}
      <div className="flex gap-2 mb-6">
        {tabs.map((t) => (
          <button
            key={t.key}
            onClick={() => { setTab(t.key); setDetailClass(null); }}
            className={`px-4 py-2 rounded-lg text-sm font-medium transition ${
              tab === t.key ? 'bg-primary-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-100 border'
            }`}
          >
            {t.icon} {t.label}
          </button>
        ))}
      </div>

      {/* ===================== KELAS TAB ===================== */}
      {tab === 'classes' && (
        <div>
          <div className="flex items-center justify-between mb-4">
            <p className="text-sm text-gray-500">{classes.length} kelas terdaftar</p>
            <button
              onClick={() => { setEditingClass(null); setClassForm({ school_id: 1, academic_year_id: 2, name: '', grade_level: 12 }); setShowClassModal(true); }}
              className="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition"
            >
              + Tambah Kelas
            </button>
          </div>

          {detailClass && (
            <div className="mb-6 bg-white rounded-xl border-2 border-primary-200 p-5">
              <div className="flex items-center justify-between mb-3">
                <div>
                  <h3 className="text-lg font-bold text-gray-800">{detailClass.name}</h3>
                  <p className="text-sm text-gray-500">Kelas {detailClass.grade_level} • Tahun Ajaran {detailClass.academic_year?.name || '-'}</p>
                </div>
                <div className="flex gap-2">
                  <button
                    onClick={() => {
                      setEditingClass(detailClass);
                      setClassForm({ school_id: detailClass.school_id, academic_year_id: detailClass.academic_year_id, name: detailClass.name, grade_level: detailClass.grade_level });
                      setShowClassModal(true);
                    }}
                    className="px-3 py-1.5 bg-yellow-50 text-yellow-700 rounded text-sm hover:bg-yellow-100 transition"
                  >
                    Edit
                  </button>
                  <button onClick={() => handleDeleteClass(detailClass.id)} className="px-3 py-1.5 bg-red-50 text-red-700 rounded text-sm hover:bg-red-100 transition">
                    Hapus
                  </button>
                  <button onClick={() => setDetailClass(null)} className="px-3 py-1.5 bg-gray-100 text-gray-600 rounded text-sm hover:bg-gray-200 transition">
                    ✕ Tutup
                  </button>
                </div>
              </div>

              <div className="mt-3">
                <div className="flex items-center justify-between mb-2">
                  <h4 className="text-sm font-semibold text-gray-700">Mata Pelajaran & Guru</h4>
                  <button
                    onClick={() => { setAssignForm({ class_id: detailClass.id, subject_id: 0, user_id: 0, semester: 'ganjil' }); setShowAssignModal(true); }}
                    className="px-3 py-1 bg-primary-50 text-primary-700 rounded text-xs font-medium hover:bg-primary-100 transition"
                  >
                    + Tambah Penugasan
                  </button>
                </div>
                {classSubjects.length === 0 ? (
                  <p className="text-sm text-gray-400 py-3">Belum ada mata pelajaran</p>
                ) : (
                  <div className="space-y-2">
                    {classSubjects.map((cs) => (
                      <div key={cs.id} className="flex items-center justify-between bg-gray-50 rounded-lg px-4 py-2.5">
                        <div className="flex items-center gap-4">
                          <span className="text-sm font-semibold text-primary-700">{cs.subject?.code || '-'}</span>
                          <span className="text-sm text-gray-800">{cs.subject?.name || '-'}</span>
                          <span className="text-xs text-gray-400">|</span>
                          <span className="text-sm text-gray-600">👤 {cs.teacher?.name || '-'}</span>
                          <span className="text-xs px-2 py-0.5 rounded bg-gray-200 text-gray-600">{cs.semester || '-'}</span>
                        </div>
                        <button onClick={() => handleDeleteAssignment(cs.id)} className="text-red-500 hover:text-red-700 text-xs">Hapus</button>
                      </div>
                    ))}
                  </div>
                )}
              </div>
            </div>
          )}

          <div className="bg-white rounded-xl shadow overflow-hidden">
            <table className="w-full text-sm">
              <thead className="bg-gray-50 border-b">
                <tr>
                  <th className="text-left px-5 py-3 font-semibold text-gray-600">Nama Kelas</th>
                  <th className="text-left px-5 py-3 font-semibold text-gray-600">Tingkat</th>
                  <th className="text-left px-5 py-3 font-semibold text-gray-600">Tahun Ajaran</th>
                  <th className="text-left px-5 py-3 font-semibold text-gray-600">Siswa</th>
                  <th className="text-left px-5 py-3 font-semibold text-gray-600">Aksi</th>
                </tr>
              </thead>
              <tbody className="divide-y">
                {classes.map((cls) => (
                  <tr
                    key={cls.id}
                    onClick={() => loadClassDetail(cls)}
                    className={`cursor-pointer transition ${detailClass?.id === cls.id ? 'bg-primary-50' : 'hover:bg-gray-50'}`}
                  >
                    <td className="px-5 py-3 font-medium text-gray-800">{cls.name}</td>
                    <td className="px-5 py-3 text-gray-600">{cls.grade_level}</td>
                    <td className="px-5 py-3 text-gray-500">{cls.academic_year?.name || '-'}</td>
                    <td className="px-5 py-3 text-gray-500">{cls.students_count ?? '-'}</td>
                    <td className="px-5 py-3">
                      <span className="text-primary-600 text-xs font-medium">Lihat Detail →</span>
                    </td>
                  </tr>
                ))}
                {classes.length === 0 && (
                  <tr><td colSpan={5} className="px-5 py-10 text-center text-gray-400">Belum ada kelas</td></tr>
                )}
              </tbody>
            </table>
          </div>
        </div>
      )}

      {/* ===================== MATA PELAJARAN TAB ===================== */}
      {tab === 'subjects' && (
        <div>
          <div className="flex items-center justify-between mb-4">
            <p className="text-sm text-gray-500">{subjects.length} mata pelajaran</p>
            <button
              onClick={() => { setEditingSubject(null); setSubjectForm({ school_id: 1, name: '', code: '', description: '' }); setShowSubjectModal(true); }}
              className="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition"
            >
              + Tambah Mata Pelajaran
            </button>
          </div>

          <div className="bg-white rounded-xl shadow overflow-hidden">
            <table className="w-full text-sm">
              <thead className="bg-gray-50 border-b">
                <tr>
                  <th className="text-left px-5 py-3 font-semibold text-gray-600">Kode</th>
                  <th className="text-left px-5 py-3 font-semibold text-gray-600">Nama</th>
                  <th className="text-left px-5 py-3 font-semibold text-gray-600">Deskripsi</th>
                  <th className="text-left px-5 py-3 font-semibold text-gray-600">Aksi</th>
                </tr>
              </thead>
              <tbody className="divide-y">
                {subjects.map((sub) => (
                  <tr key={sub.id} className="hover:bg-gray-50">
                    <td className="px-5 py-3">
                      <span className="px-2 py-0.5 rounded bg-primary-50 text-primary-700 text-xs font-bold">{sub.code}</span>
                    </td>
                    <td className="px-5 py-3 font-medium text-gray-800">{sub.name}</td>
                    <td className="px-5 py-3 text-gray-500 text-xs max-w-xs truncate">{sub.description || '-'}</td>
                    <td className="px-5 py-3 space-x-2">
                      <button
                        onClick={() => {
                          setEditingSubject(sub);
                          setSubjectForm({ school_id: sub.school_id, name: sub.name, code: sub.code, description: sub.description || '' });
                          setShowSubjectModal(true);
                        }}
                        className="text-yellow-600 hover:underline text-xs"
                      >
                        Edit
                      </button>
                      <button onClick={() => handleDeleteSubject(sub.id)} className="text-red-600 hover:underline text-xs">
                        Hapus
                      </button>
                    </td>
                  </tr>
                ))}
                {subjects.length === 0 && (
                  <tr><td colSpan={4} className="px-5 py-10 text-center text-gray-400">Belum ada mata pelajaran</td></tr>
                )}
              </tbody>
            </table>
          </div>
        </div>
      )}

      {/* ===================== PENUGASAN GURU TAB ===================== */}
      {tab === 'assignments' && (
        <div>
          <div className="flex items-center justify-between mb-4">
            <p className="text-sm text-gray-500">{assignments.length} penugasan</p>
            <button
              onClick={() => { setAssignForm({ class_id: classes[0]?.id || 0, subject_id: subjects[0]?.id || 0, user_id: teachers[0]?.id || 0, semester: 'ganjil' }); setShowAssignModal(true); }}
              className="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition"
            >
              + Tambah Penugasan
            </button>
          </div>

          <div className="bg-white rounded-xl shadow overflow-hidden">
            <table className="w-full text-sm">
              <thead className="bg-gray-50 border-b">
                <tr>
                  <th className="text-left px-5 py-3 font-semibold text-gray-600">Kelas</th>
                  <th className="text-left px-5 py-3 font-semibold text-gray-600">Mata Pelajaran</th>
                  <th className="text-left px-5 py-3 font-semibold text-gray-600">Guru</th>
                  <th className="text-left px-5 py-3 font-semibold text-gray-600">Semester</th>
                  <th className="text-left px-5 py-3 font-semibold text-gray-600">Aksi</th>
                </tr>
              </thead>
              <tbody className="divide-y">
                {assignments.map((a) => (
                  <tr key={a.id} className="hover:bg-gray-50">
                    <td className="px-5 py-3 font-medium text-gray-800">{a.class?.name || `Kelas #${a.class_id}`}</td>
                    <td className="px-5 py-3">
                      <span className="text-primary-700 font-medium">{a.subject?.name || `Mapel #${a.subject_id}`}</span>
                    </td>
                    <td className="px-5 py-3 text-gray-600">{a.teacher?.name || `User #${a.user_id}`}</td>
                    <td className="px-5 py-3">
                      <span className={`text-xs px-2 py-0.5 rounded ${a.semester === 'ganjil' ? 'bg-blue-50 text-blue-700' : 'bg-orange-50 text-orange-700'}`}>
                        {a.semester || '-'}
                      </span>
                    </td>
                    <td className="px-5 py-3">
                      <button onClick={() => handleDeleteAssignment(a.id)} className="text-red-600 hover:underline text-xs">Hapus</button>
                    </td>
                  </tr>
                ))}
                {assignments.length === 0 && (
                  <tr><td colSpan={5} className="px-5 py-10 text-center text-gray-400">Belum ada penugasan</td></tr>
                )}
              </tbody>
            </table>
          </div>
        </div>
      )}

      {/* ===================== MODALS ===================== */}

      {/* Class Modal */}
      {showClassModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
          <div className="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
            <h2 className="text-lg font-bold text-gray-800 mb-4">{editingClass ? 'Edit Kelas' : 'Tambah Kelas'}</h2>
            <form onSubmit={handleClassSubmit} className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Nama Kelas</label>
                <input
                  value={classForm.name}
                  onChange={(e) => setClassForm({ ...classForm, name: e.target.value })}
                  className="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                  placeholder="contoh: XII RPL 3"
                  required
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Grade Level</label>
                <select
                  value={classForm.grade_level}
                  onChange={(e) => setClassForm({ ...classForm, grade_level: parseInt(e.target.value) })}
                  className="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                >
                  {[7, 8, 9, 10, 11, 12].map((g) => (
                    <option key={g} value={g}>Kelas {g}</option>
                  ))}
                </select>
              </div>
              {!editingClass && (
                <>
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">Tahun Ajaran</label>
                    <select
                      value={classForm.academic_year_id}
                      onChange={(e) => setClassForm({ ...classForm, academic_year_id: parseInt(e.target.value) })}
                      className="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    >
                      {academicYears.map((ay: any) => (
                        <option key={ay.id} value={ay.id}>{ay.name} {ay.is_active ? '(Aktif)' : ''}</option>
                      ))}
                    </select>
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">Sekolah</label>
                    <select
                      value={classForm.school_id}
                      onChange={(e) => setClassForm({ ...classForm, school_id: parseInt(e.target.value) })}
                      className="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    >
                      {schools.map((s: any) => (
                        <option key={s.id} value={s.id}>{s.name}</option>
                      ))}
                    </select>
                  </div>
                </>
              )}
              <div className="flex justify-end gap-2 pt-2">
                <button type="button" onClick={() => { setShowClassModal(false); setEditingClass(null); }} className="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg text-sm transition">Batal</button>
                <button type="submit" className="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      )}

      {/* Subject Modal */}
      {showSubjectModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
          <div className="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
            <h2 className="text-lg font-bold text-gray-800 mb-4">{editingSubject ? 'Edit Mata Pelajaran' : 'Tambah Mata Pelajaran'}</h2>
            <form onSubmit={handleSubjectSubmit} className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input
                  value={subjectForm.name}
                  onChange={(e) => setSubjectForm({ ...subjectForm, name: e.target.value })}
                  className="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                  placeholder="contoh: Pemrograman Web"
                  required
                />
              </div>
              {!editingSubject && (
                <div>
                  <label className="block text-sm font-medium text-gray-700 mb-1">Kode</label>
                  <input
                    value={subjectForm.code}
                    onChange={(e) => setSubjectForm({ ...subjectForm, code: e.target.value })}
                    className="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    placeholder="contoh: PW-12"
                    required
                  />
                </div>
              )}
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea
                  value={subjectForm.description}
                  onChange={(e) => setSubjectForm({ ...subjectForm, description: e.target.value })}
                  className="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                  rows={3}
                />
              </div>
              <div className="flex justify-end gap-2 pt-2">
                <button type="button" onClick={() => { setShowSubjectModal(false); setEditingSubject(null); }} className="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg text-sm transition">Batal</button>
                <button type="submit" className="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      )}

      {/* Assignment Modal */}
      {showAssignModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
          <div className="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
            <h2 className="text-lg font-bold text-gray-800 mb-4">Tambah Penugasan Guru</h2>
            <form onSubmit={handleAssignSubmit} className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <select
                  value={assignForm.class_id}
                  onChange={(e) => setAssignForm({ ...assignForm, class_id: parseInt(e.target.value) })}
                  className="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                  required
                >
                  <option value={0}>Pilih kelas</option>
                  {classes.map((c) => (
                    <option key={c.id} value={c.id}>{c.name}</option>
                  ))}
                </select>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran</label>
                <select
                  value={assignForm.subject_id}
                  onChange={(e) => setAssignForm({ ...assignForm, subject_id: parseInt(e.target.value) })}
                  className="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                  required
                >
                  <option value={0}>Pilih mata pelajaran</option>
                  {subjects.map((s) => (
                    <option key={s.id} value={s.id}>{s.code} - {s.name}</option>
                  ))}
                </select>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Guru</label>
                <select
                  value={assignForm.user_id}
                  onChange={(e) => setAssignForm({ ...assignForm, user_id: parseInt(e.target.value) })}
                  className="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                  required
                >
                  <option value={0}>Pilih guru</option>
                  {teachers.map((t) => (
                    <option key={t.id} value={t.id}>{t.name}</option>
                  ))}
                </select>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1">Semester</label>
                <select
                  value={assignForm.semester}
                  onChange={(e) => setAssignForm({ ...assignForm, semester: e.target.value })}
                  className="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                >
                  <option value="ganjil">Ganjil</option>
                  <option value="genap">Genap</option>
                </select>
              </div>
              <div className="flex justify-end gap-2 pt-2">
                <button type="button" onClick={() => setShowAssignModal(false)} className="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg text-sm transition">Batal</button>
                <button type="submit" className="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
}
