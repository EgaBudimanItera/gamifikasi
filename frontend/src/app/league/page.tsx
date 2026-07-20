'use client';

import { useEffect, useState } from 'react';
import { leagueApi } from '@/services/api';
import { LeagueData, MyLeagueStanding } from '@/types';

const allTiers = [
  { tier: 'bronze',   name: 'Perunggu',  icon: '🥉', gradient: 'from-amber-600 to-amber-800' },
  { tier: 'silver',   name: 'Perak',     icon: '🥈', gradient: 'from-gray-400 to-gray-600' },
  { tier: 'gold',     name: 'Emas',      icon: '🥇', gradient: 'from-yellow-400 to-yellow-600' },
  { tier: 'sapphire', name: 'Safir',     icon: '💎', gradient: 'from-blue-400 to-blue-600' },
  { tier: 'ruby',     name: 'Ruby',      icon: '🔴', gradient: 'from-red-400 to-red-600' },
  { tier: 'emerald',  name: 'Zamrud',    icon: '🟢', gradient: 'from-emerald-400 to-emerald-600' },
  { tier: 'amethyst', name: 'Amethyst',  icon: '🟣', gradient: 'from-purple-400 to-purple-600' },
  { tier: 'diamond',  name: 'Diamant',   icon: '💠', gradient: 'from-cyan-300 to-cyan-500' },
];

export default function LeaguePage() {
  const [standings, setStandings] = useState<LeagueData | null>(null);
  const [myStanding, setMyStanding] = useState<MyLeagueStanding | null>(null);
  const [loading, setLoading] = useState(true);
  const [activeTab, setActiveTab] = useState<'my-league' | 'all-leagues' | 'history'>('my-league');

  useEffect(() => { loadData(); }, []);

  const loadData = async () => {
    setLoading(true);
    try {
      const [standingsRes, myStandingRes] = await Promise.all([
        leagueApi.standings(),
        leagueApi.myStanding(),
      ]);
      setStandings(standingsRes.data.data);
      setMyStanding(myStandingRes.data.data);
    } catch (error) {
      console.error('Error loading league data:', error);
    } finally {
      setLoading(false);
    }
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
      <h1 className="text-2xl font-bold text-gray-800 mb-2">Liga Mingguan</h1>
      <p className="text-sm text-gray-500 mb-6">Bersaing di liga mingguan! Top 5 naik, bottom 3 turun.</p>

      {/* Tabs */}
      <div className="flex gap-2 mb-6">
        {([
          { key: 'my-league' as const, label: 'Liga Saya', icon: '🏅' },
          { key: 'all-leagues' as const, label: 'Semua Liga', icon: '📊' },
          { key: 'history' as const, label: 'Riwayat', icon: '📜' },
        ]).map((tab) => (
          <button
            key={tab.key}
            onClick={() => setActiveTab(tab.key)}
            className={`flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium transition ${
              activeTab === tab.key
                ? 'bg-primary-600 text-white shadow-md'
                : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50'
            }`}
          >
            <span>{tab.icon}</span>
            <span>{tab.label}</span>
          </button>
        ))}
      </div>

      {/* My League Tab */}
      {activeTab === 'my-league' && (
        <div>
          {myStanding ? (
            <div className="space-y-6">
              {/* Current League Card */}
              <div className={`bg-gradient-to-r ${myStanding.league?.color || 'from-gray-400 to-gray-600'} rounded-2xl p-6 text-white shadow-xl`}>
                <div className="flex items-center justify-between">
                  <div className="flex items-center gap-4">
                    <div className="text-6xl animate-level-up">{myStanding.league?.icon || '🏅'}</div>
                    <div>
                      <div className="text-sm opacity-80">Liga Anda</div>
                      <div className="text-3xl font-bold">{myStanding.league?.name || 'Unknown'}</div>
                      <div className="text-sm opacity-75 mt-1">
                        {new Date(myStanding.week_start).toLocaleDateString('id-ID', { day: 'numeric', month: 'short' })} - {new Date(myStanding.week_end).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })}
                      </div>
                    </div>
                  </div>
                  <div className="text-right">
                    <div className="text-5xl font-bold">{myStanding.rank}</div>
                    <div className="text-sm opacity-80">/ {myStanding.total_players} pemain</div>
                  </div>
                </div>

                {/* Weekly XP */}
                <div className="mt-6 bg-white/20 rounded-xl p-4">
                  <div className="flex justify-between items-center mb-2">
                    <span className="text-sm opacity-90">XP Minggu Ini</span>
                    <span className="text-2xl font-bold">{myStanding.weekly_xp} XP</span>
                  </div>
                  <div className="w-full bg-white/20 rounded-full h-3">
                    <div
                      className="bg-white h-3 rounded-full transition-all duration-500"
                      style={{ width: `${Math.min(100, (myStanding.weekly_xp / 500) * 100)}%` }}
                    ></div>
                  </div>
                  <div className="flex justify-between mt-1 text-xs opacity-70">
                    <span>0 XP</span>
                    <span>500 XP ke liga berikutnya</span>
                  </div>
                </div>

                {/* Status Badge */}
                <div className="mt-4 flex items-center gap-3">
                  {myStanding.status === 'promoted' && (
                    <span className="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                      ⬆️ Naik Liga
                    </span>
                  )}
                  {myStanding.status === 'demoted' && (
                    <span className="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                      ⬇️ Turun Liga
                    </span>
                  )}
                  {myStanding.status === 'active' && (
                    <span className="bg-white/30 text-white text-xs font-bold px-3 py-1 rounded-full">
                      ➡️ Bertahan
                    </span>
                  )}
                </div>
              </div>

              {/* Promotion/Demotion Rules */}
              <div className="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <h3 className="text-sm font-semibold text-gray-600 mb-3">Aturan Liga</h3>
                <div className="grid grid-cols-1 sm:grid-cols-3 gap-3">
                  <div className="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
                    <div className="text-2xl mb-1">⬆️</div>
                    <div className="text-sm font-bold text-green-700">Top 5 Naik</div>
                    <div className="text-xs text-green-600">5 pemain teratas naik liga</div>
                  </div>
                  <div className="bg-yellow-50 border border-yellow-200 rounded-lg p-3 text-center">
                    <div className="text-2xl mb-1">➡️</div>
                    <div className="text-sm font-bold text-yellow-700">Bertahan</div>
                    <div className="text-xs text-yellow-600">Tetap di liga yang sama</div>
                  </div>
                  <div className="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
                    <div className="text-2xl mb-1">⬇️</div>
                    <div className="text-sm font-bold text-red-700">Bottom 3 Turun</div>
                    <div className="text-xs text-red-600">3 pemain terbawah turun liga</div>
                  </div>
                </div>
              </div>
            </div>
          ) : (
            <div className="bg-white rounded-xl shadow p-12 text-center">
              <div className="text-5xl mb-4">🏅</div>
              <p className="text-gray-500 font-medium">Belum ada liga minggu ini</p>
              <p className="text-sm text-gray-400 mt-1">Liga akan terbentuk setelah kamu mengumpulkan XP</p>
            </div>
          )}
        </div>
      )}

      {/* All Leagues Tab */}
      {activeTab === 'all-leagues' && standings && (
        <div className="space-y-4">
          {standings.leagues.length === 0 ? (
            <div className="bg-white rounded-xl shadow p-12 text-center">
              <div className="text-5xl mb-4">📊</div>
              <p className="text-gray-500 font-medium">Belum ada data liga</p>
            </div>
          ) : (
            standings.leagues.map((leagueStanding) => {
              const tierInfo = allTiers.find(t => t.tier === leagueStanding.league.tier) || allTiers[0];
              return (
                <div key={leagueStanding.league.id} className="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                  {/* League Header */}
                  <div className={`bg-gradient-to-r ${tierInfo.gradient} p-4 text-white`}>
                    <div className="flex items-center justify-between">
                      <div className="flex items-center gap-3">
                        <span className="text-3xl">{tierInfo.icon}</span>
                        <div>
                          <div className="font-bold text-lg">{leagueStanding.league.name}</div>
                          <div className="text-xs opacity-80">
                            {leagueStanding.league.min_xp} - {leagueStanding.league.max_xp} XP
                          </div>
                        </div>
                      </div>
                      <div className="text-sm opacity-80">
                        {leagueStanding.players.length} pemain
                      </div>
                    </div>
                  </div>

                  {/* Players */}
                  <div className="divide-y">
                    {leagueStanding.players.length === 0 ? (
                      <div className="p-4 text-center text-gray-400 text-sm">Belum ada pemain</div>
                    ) : (
                      leagueStanding.players.map((player, idx) => (
                        <div key={player.user_id} className={`flex items-center gap-3 px-4 py-3 ${player.user_id === myStanding?.league?.id ? 'bg-primary-50' : ''}`}>
                          <div className="w-8 text-center">
                            {idx < leagueStanding.league.promote_count ? (
                              <span className="text-green-500 font-bold text-sm">↑</span>
                            ) : idx >= leagueStanding.players.length - leagueStanding.league.demote_count ? (
                              <span className="text-red-500 font-bold text-sm">↓</span>
                            ) : (
                              <span className="text-gray-400 text-sm">-</span>
                            )}
                          </div>
                          <div className="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-sm font-bold text-gray-600">
                            {idx + 1}
                          </div>
                          <div className="flex-1">
                            <div className="font-medium text-sm text-gray-800">{player.name}</div>
                          </div>
                          <div className="text-right">
                            <div className="font-bold text-sm text-yellow-600">{player.weekly_xp} XP</div>
                            {player.status === 'promoted' && (
                              <span className="text-xs text-green-600">Naik ↑</span>
                            )}
                            {player.status === 'demoted' && (
                              <span className="text-xs text-red-600">Turun ↓</span>
                            )}
                          </div>
                        </div>
                      ))
                    )}
                  </div>
                </div>
              );
            })
          )}
        </div>
      )}

      {/* History Tab */}
      {activeTab === 'history' && (
        <div className="bg-white rounded-xl shadow p-6">
          <h3 className="text-sm font-semibold text-gray-600 mb-4">Riwayat Liga (5 minggu terakhir)</h3>
          <div className="text-center text-gray-400 py-8">
            <div className="text-4xl mb-2">📜</div>
            <p className="text-sm">Riwayat liga akan muncul setelah beberapa minggu bermain</p>
          </div>
        </div>
      )}
    </div>
  );
}
