'use client';

import { useEffect, useState } from 'react';
import { npcApi } from '@/services/api';
import { Npc, NpcAffinity } from '@/types';

export default function NpcsPage() {
  const [npcs, setNpcs] = useState<Npc[]>([]);
  const [affinities, setAffinities] = useState<NpcAffinity[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    Promise.all([npcApi.list(), npcApi.myAffinities()])
      .then(([npcsRes, affRes]) => {
        setNpcs(npcsRes.data.data);
        setAffinities(affRes.data.data);
      })
      .catch(() => {})
      .finally(() => setLoading(false));
  }, []);

  const getAffinity = (npcId: number) => {
    return affinities.find((a) => a.npc?.id === npcId);
  };

  const getLevelColor = (level: number) => {
    if (level >= 5) return 'from-purple-500 to-pink-500';
    if (level >= 4) return 'from-yellow-500 to-orange-500';
    if (level >= 3) return 'from-blue-500 to-cyan-500';
    if (level >= 2) return 'from-green-500 to-emerald-500';
    return 'from-gray-400 to-gray-500';
  };

  if (loading) {
    return (
      <div className="flex items-center justify-center py-20">
        <div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600"></div>
      </div>
    );
  }

  return (
    <div>
      <h1 className="text-2xl font-bold text-gray-800 mb-2">NPC Mentors</h1>
      <p className="text-gray-500 mb-6">Kenali mentormu dan selesaikan quest untuk meningkatkan affinity</p>

      <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        {npcs.map((npc) => {
          const aff = getAffinity(npc.id);
          const level = aff?.affinity_level || 1;
          const xp = aff?.affinity_xp || 0;
          const quests = aff?.total_quests_completed || 0;

          return (
            <div key={npc.id} className="bg-white rounded-xl shadow hover:shadow-md transition overflow-hidden">
              <div className={`h-2 bg-gradient-to-r ${getLevelColor(level)}`} />
              <div className="p-6">
                <div className="flex items-center gap-4 mb-4">
                  <div className="w-16 h-16 rounded-full bg-primary-100 flex items-center justify-center text-3xl">
                    🧙
                  </div>
                  <div>
                    <h3 className="font-bold text-lg text-gray-800">{npc.name}</h3>
                    <p className="text-sm text-gray-500">{npc.subject?.name}</p>
                  </div>
                </div>

                <p className="text-sm text-gray-600 mb-4">{npc.personality}</p>

                <div className="bg-gray-50 rounded-lg p-4">
                  <div className="flex items-center justify-between mb-2">
                    <span className="text-sm font-medium text-gray-600">Mentor Affinity</span>
                    <span className="text-sm font-bold text-primary-600">{level}/5</span>
                  </div>
                  <div className="w-full h-2 bg-gray-200 rounded-full overflow-hidden mb-3">
                    <div
                      className={`h-full bg-gradient-to-r ${getLevelColor(level)} rounded-full transition-all`}
                      style={{ width: `${Math.min(100, (xp / 50) * 100)}%` }}
                    />
                  </div>
                  <div className="flex justify-between text-xs text-gray-500">
                    <span>{xp} XP</span>
                    <span>{quests} quest selesai</span>
                  </div>
                </div>

                <div className="mt-4 text-xs text-gray-400 text-center">
                  {level >= 4 && '🏆 Quest LEGENDARY terbuka!'}
                  {level >= 3 && level < 4 && '⚔️ Quest HARD tersedia'}
                  {level >= 2 && level < 3 && '🎯 Quest MEDIUM terbuka'}
                  {level < 2 && '🌱 Selesaikan quest untuk naik level'}
                </div>
              </div>
            </div>
          );
        })}
      </div>

      {npcs.length === 0 && (
        <div className="bg-white rounded-xl shadow p-12 text-center">
          <div className="text-4xl mb-3">🧙</div>
          <p className="text-gray-400">Belum ada NPC yang tersedia</p>
        </div>
      )}
    </div>
  );
}
