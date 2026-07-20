'use client';

import { useEffect, useState } from 'react';
import { questApi } from '@/services/api';
import { Quest } from '@/types';

export default function QuestsPage() {
  const [quests, setQuests] = useState<Quest[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    loadQuests();
  }, []);

  const loadQuests = async () => {
    try {
      const res = await questApi.list();
      const data = res.data.data;
      setQuests(data.data || data || []);
    } catch (error) {
      console.error('Error loading quests:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleAccept = async (questId: number) => {
    try {
      await questApi.accept(questId);
      loadQuests();
    } catch (error) {
      console.error('Error accepting quest:', error);
    }
  };

  const getTypeColor = (type: string) => {
    switch (type) {
      case 'daily': return 'bg-blue-100 text-blue-800';
      case 'weekly': return 'bg-purple-100 text-purple-800';
      case 'special': return 'bg-yellow-100 text-yellow-800';
      default: return 'bg-gray-100 text-gray-800';
    }
  };

  const getTypeLabel = (type: string) => {
    switch (type) {
      case 'daily': return 'Harian';
      case 'weekly': return 'Mingguan';
      case 'special': return 'Spesial';
      default: return type;
    }
  };

  if (loading) {
    return <div className="flex items-center justify-center py-20"><div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600"></div></div>;
  }

  return (
    <div>
      <h1 className="text-2xl font-bold text-gray-800 mb-6">Quest</h1>

      {quests.length === 0 ? (
        <div className="bg-white rounded-xl shadow p-12 text-center">
          <div className="text-4xl mb-3">🎯</div>
          <p className="text-gray-400">Belum ada quest tersedia</p>
        </div>
      ) : (
        <div className="space-y-3">
          {quests.map((quest) => (
            <div key={quest.id} className="bg-white rounded-xl shadow p-5 hover:shadow-md transition">
              <div className="flex items-start justify-between">
                <div className="flex-1">
                  <div className="flex items-center gap-2 mb-2">
                    <span className={`px-3 py-1 rounded-full text-xs font-semibold ${getTypeColor(quest.type)}`}>
                      {getTypeLabel(quest.type)}
                    </span>
                  </div>
                  <h3 className="font-semibold text-gray-800">{quest.title}</h3>
                  <p className="text-sm text-gray-500 mt-1">{quest.description}</p>
                </div>
                <div className="text-right ml-4">
                  <div className="text-lg font-bold text-yellow-500">+{quest.xp_reward} XP</div>
                  <button
                    onClick={() => handleAccept(quest.id)}
                    className="mt-2 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition text-sm font-medium"
                  >
                    Terima
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}
