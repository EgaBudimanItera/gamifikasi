'use client';

import { useState, useEffect } from 'react';
import { npcApi } from '@/services/api';
import { NpcEncounter as NpcEncounterType, NpcQuest } from '@/types';

interface NpcChatBubbleProps {
  materialId: number;
  subjectId: number;
}

export default function NpcChatBubble({ materialId, subjectId }: NpcChatBubbleProps) {
  const [encounter, setEncounter] = useState<NpcEncounterType | null>(null);
  const [showEncounter, setShowEncounter] = useState(false);
  const [quest, setQuest] = useState<NpcQuest | null>(null);
  const [showQuest, setShowQuest] = useState(false);
  const [selectedAnswer, setSelectedAnswer] = useState<string>('');
  const [result, setResult] = useState<any>(null);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    const checkEncounter = async () => {
      try {
        const res = await npcApi.encounter(materialId);
        if (res.data.data) {
          setEncounter(res.data.data);
          setTimeout(() => setShowEncounter(true), 1000);
        }
      } catch (err) {
        // Silent fail — NPC not appearing is normal
      }
    };

    const timer = setTimeout(checkEncounter, 2000);
    return () => clearTimeout(timer);
  }, [materialId]);

  const handleAcceptQuest = async () => {
    if (!encounter) return;
    setLoading(true);
    try {
      const res = await npcApi.quest(encounter.npc.id);
      setQuest(res.data.data);
      setShowEncounter(false);
      setShowQuest(true);
    } catch (err) {
      console.error('Failed to fetch quest:', err);
    } finally {
      setLoading(false);
    }
  };

  const handleSubmitAnswer = async () => {
    if (!encounter || !quest || !selectedAnswer) return;
    setLoading(true);
    try {
      const res = await npcApi.completeQuest(encounter.npc.id, {
        quest_id: quest.id,
        answer: selectedAnswer,
      });
      setResult(res.data.data);
    } catch (err) {
      console.error('Failed to submit answer:', err);
    } finally {
      setLoading(false);
    }
  };

  const getDifficultyColor = (difficulty: string) => {
    switch (difficulty) {
      case 'easy': return 'text-green-600 bg-green-50';
      case 'medium': return 'text-yellow-600 bg-yellow-50';
      case 'hard': return 'text-orange-600 bg-orange-50';
      case 'legendary': return 'text-purple-600 bg-purple-50';
      default: return 'text-gray-600 bg-gray-50';
    }
  };

  if (!encounter && !showEncounter) return null;

  return (
    <>
      {/* Chat Bubble */}
      {encounter && showEncounter && !showQuest && !result && (
        <div className="fixed bottom-20 right-4 z-40 animate-bounce">
          <button
            onClick={handleAcceptQuest}
            className="flex items-center gap-3 bg-white rounded-2xl shadow-lg border p-4 max-w-xs hover:shadow-xl transition group"
          >
            <div className="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center text-2xl flex-shrink-0">
              🧙
            </div>
            <div className="text-left">
              <div className="font-semibold text-sm text-gray-800">{encounter.npc.name}</div>
              <div className="text-xs text-gray-500 line-clamp-2">{encounter.dialog}</div>
            </div>
            <div className="text-primary-500 group-hover:translate-x-1 transition">
              →
            </div>
          </button>
        </div>
      )}

      {/* Encounter Modal */}
      {encounter && showEncounter && !showQuest && !result && (
        <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
          <div className="bg-white rounded-2xl p-6 max-w-md w-full mx-4">
            <div className="flex items-center gap-4 mb-6">
              <div className="w-16 h-16 rounded-full bg-primary-100 flex items-center justify-center text-3xl">
                🧙
              </div>
              <div>
                <h3 className="text-lg font-bold text-gray-800">{encounter.npc.name}</h3>
                <p className="text-sm text-gray-500">{encounter.npc.personality}</p>
              </div>
            </div>

            <div className="bg-gray-50 rounded-xl p-4 mb-6">
              <p className="text-gray-700">{encounter.dialog}</p>
            </div>

            <div className="flex gap-3">
              <button
                onClick={() => setShowEncounter(false)}
                className="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition"
              >
                Nanti Saja
              </button>
              <button
                onClick={handleAcceptQuest}
                disabled={loading || !encounter.has_quest}
                className="flex-1 px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition disabled:opacity-50"
              >
                {loading ? 'Memuat...' : 'Terima Quest'}
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Quest Modal */}
      {showQuest && quest && !result && (
        <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
          <div className="bg-white rounded-2xl p-6 max-w-lg w-full mx-4">
            <div className="flex items-center justify-between mb-4">
              <div className="flex items-center gap-3">
                <div className="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-xl">
                  🧙
                </div>
                <div>
                  <h3 className="font-bold text-gray-800">{encounter?.npc.name}</h3>
                  <span className={`text-xs px-2 py-0.5 rounded-full font-medium ${getDifficultyColor(quest.difficulty)}`}>
                    {quest.difficulty}
                  </span>
                </div>
              </div>
              <div className="text-right">
                <div className="text-sm font-semibold text-yellow-600">+{quest.xp_reward} XP</div>
              </div>
            </div>

            <div className="bg-gray-50 rounded-xl p-4 mb-6">
              <p className="text-gray-800 font-medium">{quest.question}</p>
            </div>

            <div className="space-y-2 mb-6">
              {quest.options.map((option, idx) => (
                <label
                  key={idx}
                  className={`flex items-center gap-3 p-3 rounded-lg border cursor-pointer transition ${
                    selectedAnswer === option
                      ? 'bg-primary-50 border-primary-300 text-primary-800'
                      : 'bg-white border-gray-200 hover:border-gray-300'
                  }`}
                >
                  <input
                    type="radio"
                    name="npc-quest-answer"
                    value={option}
                    checked={selectedAnswer === option}
                    onChange={() => setSelectedAnswer(option)}
                    className="text-primary-600 focus:ring-primary-500"
                  />
                  <span className="text-sm">{option}</span>
                </label>
              ))}
            </div>

            <div className="flex gap-3">
              <button
                onClick={() => { setShowQuest(false); setEncounter(null); }}
                className="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition"
              >
                Batal
              </button>
              <button
                onClick={handleSubmitAnswer}
                disabled={!selectedAnswer || loading}
                className="flex-1 px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition disabled:opacity-50"
              >
                {loading ? 'Mengirim...' : 'Jawab'}
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Result Modal */}
      {result && (
        <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
          <div className="bg-white rounded-2xl p-6 max-w-md w-full mx-4 text-center">
            <div className="text-5xl mb-4">{result.correct ? '🎉' : '😔'}</div>
            <h3 className="text-xl font-bold text-gray-800 mb-2">
              {result.correct ? 'Jawaban Benar!' : 'Jawaban Kurang Tepat'}
            </h3>

            {result.correct && (
              <div className="space-y-2 mb-4">
                <div className="inline-flex items-center gap-1 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                  +{result.xp_earned} XP
                </div>
                {result.affinity_level_up && (
                  <div className="inline-flex items-center gap-1 px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                    ❤️ Mentor Affinity Level {result.affinity_level}!
                  </div>
                )}
              </div>
            )}

            {result.correct && result.next_dialog && (
              <div className="bg-gray-50 rounded-xl p-4 mb-4 text-left">
                <p className="text-sm text-gray-600 italic">"{result.next_dialog}"</p>
                <p className="text-xs text-gray-400 mt-2">— {encounter?.npc.name}</p>
              </div>
            )}

            {!result.correct && result.correct_answer && (
              <p className="text-sm text-gray-500 mb-4">Jawaban yang benar: {result.correct_answer}</p>
            )}

            <button
              onClick={() => {
                setResult(null);
                setEncounter(null);
                setShowQuest(false);
                setSelectedAnswer('');
              }}
              className="w-full px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition"
            >
              Tutup
            </button>
          </div>
        </div>
      )}
    </>
  );
}
