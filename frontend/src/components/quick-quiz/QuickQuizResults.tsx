'use client';

import { QuickQuizParticipant } from '@/types';

interface QuickQuizResultsProps {
  result: any;
  participants?: QuickQuizParticipant[];
  onClose: () => void;
}

export default function QuickQuizResults({ result, participants, onClose }: QuickQuizResultsProps) {
  const isPassed = result.passed;
  const passPct = result.pass_percentage;

  return (
    <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
      <div className="bg-white rounded-2xl p-8 max-w-md w-full mx-4 text-center">
        <div className="text-6xl mb-4">{isPassed ? '🏆' : '📝'}</div>
        <h3 className="text-xl font-bold text-gray-800 mb-2">
          {isPassed ? 'Quiz Selesai!' : 'Coba Lagi Nanti'}
        </h3>

        <div className="flex items-center justify-center gap-4 my-4">
          <div className="text-center">
            <div className={`text-3xl font-bold ${isPassed ? 'text-green-600' : 'text-red-500'}`}>
              {result.correct_count}/{result.total_questions}
            </div>
            <div className="text-xs text-gray-500 mt-1">Benar</div>
          </div>
          <div className="w-px h-10 bg-gray-200" />
          <div className="text-center">
            <div className="text-3xl font-bold text-gray-800">{passPct}%</div>
            <div className="text-xs text-gray-500 mt-1">Nilai</div>
          </div>
        </div>

        {result.xp_earned > 0 && (
          <div className="inline-flex items-center gap-1 px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-lg font-bold mb-4">
            +{result.xp_earned} XP
          </div>
        )}

        {result.status === 'timeout' && (
          <p className="text-sm text-orange-600 mb-4">Waktu habis! Jawabanmu telah dikirim otomatis.</p>
        )}

        <p className="text-sm text-gray-500 mb-4">
          {isPassed
            ? 'Kamu berhasil lulus! XP sudah ditambahkan ke akunmu.'
            : `Kamu perlu minimal ${result.pass_threshold || 60}% untuk lulus. Semangat!`
          }
        </p>

        {participants && participants.length > 0 && (
          <div className="mt-6 text-left">
            <h4 className="text-sm font-medium text-gray-700 mb-2">Peringkat</h4>
            <div className="space-y-2">
              {participants.slice(0, 5).map((p, idx) => (
                <div key={p.id} className="flex items-center gap-3 p-2 bg-gray-50 rounded-lg">
                  <span className={`w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold ${
                    idx === 0 ? 'bg-yellow-100 text-yellow-800' :
                    idx === 1 ? 'bg-gray-200 text-gray-700' :
                    idx === 2 ? 'bg-orange-100 text-orange-800' :
                    'bg-gray-100 text-gray-600'
                  }`}>
                    {p.rank || idx + 1}
                  </span>
                  <span className="flex-1 text-sm font-medium text-gray-700">{p.user?.name || `Siswa #${p.user_id}`}</span>
                  <span className="text-sm text-gray-500">{p.correct_count}/{p.total_questions}</span>
                  <span className="text-sm font-medium text-yellow-600">+{p.xp_earned} XP</span>
                </div>
              ))}
            </div>
          </div>
        )}

        <button
          onClick={onClose}
          className="w-full px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition mt-6"
        >
          Tutup
        </button>
      </div>
    </div>
  );
}
