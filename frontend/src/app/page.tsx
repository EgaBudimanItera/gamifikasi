import Link from 'next/link';

export default function HomePage() {
  return (
    <main className="min-h-screen flex flex-col items-center justify-center p-8">
      <div className="max-w-2xl text-center">
        <h1 className="text-6xl font-bold mb-6 bg-gradient-to-r from-blue-600 to-purple-600 text-transparent bg-clip-text">
          EduQuest
        </h1>
        <p className="text-xl text-gray-600 mb-8">
          Platform Pembelajaran Berbasis Gamifikasi untuk Kurikulum Merdeka
        </p>
        <div className="flex gap-4 justify-center">
          <Link
            href="/auth/login"
            className="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold"
          >
            Masuk
          </Link>
          <Link
            href="/dashboard/student"
            className="px-8 py-3 border-2 border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition font-semibold"
          >
            Demo Dashboard
          </Link>
        </div>
        <div className="mt-16 grid grid-cols-3 gap-8 text-center">
          <div className="p-4">
            <div className="text-3xl mb-2">🎮</div>
            <h3 className="font-semibold">Gamifikasi</h3>
            <p className="text-sm text-gray-500">XP, Level, Badge, Streak</p>
          </div>
          <div className="p-4">
            <div className="text-3xl mb-2">📚</div>
            <h3 className="font-semibold">Pembelajaran</h3>
            <p className="text-sm text-gray-500">Materi, Tugas, Penilaian</p>
          </div>
          <div className="p-4">
            <div className="text-3xl mb-2">📊</div>
            <h3 className="font-semibold">Analytics</h3>
            <p className="text-sm text-gray-500">Dashboard, Statistik</p>
          </div>
        </div>
      </div>
    </main>
  );
}
