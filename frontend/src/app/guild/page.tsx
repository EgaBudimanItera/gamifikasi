'use client';

import { useEffect, useState } from 'react';
import { guildApi } from '@/services/api';
import { Guild, GuildMember } from '@/types';

const guildIcons = ['🛡️', '⚔️', '🏰', '🐉', '🦅', '🐺', '🔥', '⚡', '🌟', '💎'];

export default function GuildPage() {
  const [myGuild, setMyGuild] = useState<Guild | null>(null);
  const [availableGuilds, setAvailableGuilds] = useState<Guild[]>([]);
  const [leaderboard, setLeaderboard] = useState<Guild[]>([]);
  const [loading, setLoading] = useState(true);
  const [activeTab, setActiveTab] = useState<'my-guild' | 'browse' | 'leaderboard'>('my-guild');
  const [showCreateModal, setShowCreateModal] = useState(false);
  const [newGuild, setNewGuild] = useState({ name: '', description: '', icon: '🛡️' });
  const [createLoading, setCreateLoading] = useState(false);

  useEffect(() => { loadData(); }, []);

  const loadData = async () => {
    setLoading(true);
    try {
      const [myGuildRes, availableRes, leaderboardRes] = await Promise.all([
        guildApi.myGuild().catch(() => ({ data: { data: null } })),
        guildApi.available().catch(() => ({ data: { data: [] } })),
        guildApi.leaderboard().catch(() => ({ data: { data: [] } })),
      ]);
      setMyGuild(myGuildRes.data.data);
      setAvailableGuilds(availableRes.data.data);
      setLeaderboard(leaderboardRes.data.data);
    } catch (error) {
      console.error('Error loading guild data:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleCreateGuild = async () => {
    if (!newGuild.name.trim()) return;
    setCreateLoading(true);
    try {
      await guildApi.create(newGuild);
      setShowCreateModal(false);
      setNewGuild({ name: '', description: '', icon: '🛡️' });
      loadData();
    } catch (error) {
      console.error('Error creating guild');
    } finally {
      setCreateLoading(false);
    }
  };

  const handleJoinGuild = async (guildId: number) => {
    try {
      await guildApi.join(guildId);
      loadData();
    } catch (error) {
      console.error('Error joining guild');
    }
  };

  const handleLeaveGuild = async () => {
    if (!confirm('Yakin ingin keluar dari guild?')) return;
    try {
      await guildApi.leave();
      setMyGuild(null);
      loadData();
    } catch (error) {
      console.error('Error leaving guild');
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
      <h1 className="text-2xl font-bold text-gray-800 mb-2">Guild</h1>
      <p className="text-sm text-gray-500 mb-6">Bergabung dengan tim untuk menyelesaikan quest bersama!</p>

      {/* Tabs */}
      <div className="flex gap-2 mb-6">
        {([
          { key: 'my-guild' as const, label: 'Guild Saya', icon: '🛡️' },
          { key: 'browse' as const, label: 'Jelajahi', icon: '🔍' },
          { key: 'leaderboard' as const, label: 'Peringkat Guild', icon: '🏆' },
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

      {/* My Guild Tab */}
      {activeTab === 'my-guild' && (
        <div>
          {myGuild ? (
            <div className="space-y-6">
              {/* Guild Card */}
              <div className="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl">
                <div className="flex items-center justify-between">
                  <div className="flex items-center gap-4">
                    <div className="text-6xl">{myGuild.icon}</div>
                    <div>
                      <div className="text-sm opacity-80">Guild Anda</div>
                      <div className="text-3xl font-bold">{myGuild.name}</div>
                      {myGuild.description && (
                        <div className="text-sm opacity-75 mt-1">{myGuild.description}</div>
                      )}
                    </div>
                  </div>
                  <div className="text-right">
                    <div className="text-4xl font-bold">{myGuild.total_guild_xp.toLocaleString()}</div>
                    <div className="text-sm opacity-80">Total Guild XP</div>
                  </div>
                </div>

                {/* Guild Stats */}
                <div className="mt-6 grid grid-cols-3 gap-3">
                  <div className="bg-white/20 rounded-xl p-3 text-center">
                    <div className="text-2xl font-bold">{myGuild.members?.length || 0}</div>
                    <div className="text-xs opacity-75">Anggota</div>
                  </div>
                  <div className="bg-white/20 rounded-xl p-3 text-center">
                    <div className="text-2xl font-bold">{myGuild.max_members}</div>
                    <div className="text-xs opacity-75">Kapasitas</div>
                  </div>
                  <div className="bg-white/20 rounded-xl p-3 text-center">
                    <div className="text-2xl font-bold">#{leaderboard.findIndex(g => g.id === myGuild.id) + 1 || '-'}</div>
                    <div className="text-xs opacity-75">Peringkat</div>
                  </div>
                </div>
              </div>

              {/* Members */}
              <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div className="flex items-center justify-between mb-4">
                  <h3 className="text-sm font-semibold text-gray-600">Anggota Guild</h3>
                  <button
                    onClick={handleLeaveGuild}
                    className="text-xs text-red-500 hover:text-red-700 font-medium"
                  >
                    Keluar Guild
                  </button>
                </div>
                <div className="space-y-2">
                  {myGuild.members?.map((member) => (
                    <div key={member.id} className="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                      <div className="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold text-sm">
                        {member.user?.name?.charAt(0) || '?'}
                      </div>
                      <div className="flex-1">
                        <div className="font-medium text-sm text-gray-800">{member.user?.name || 'Unknown'}</div>
                        <div className="text-xs text-gray-500">
                          {member.role === 'leader' ? '👑 Leader' : 'Anggota'}
                        </div>
                      </div>
                      <div className="text-right">
                        <div className="font-bold text-sm text-yellow-600">{member.contributed_xp} XP</div>
                        <div className="text-xs text-gray-400">dikontribusi</div>
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          ) : (
            <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
              <div className="text-5xl mb-4">🛡️</div>
              <p className="text-gray-500 font-medium mb-2">Belum ada guild</p>
              <p className="text-sm text-gray-400 mb-4">Buat guild baru atau bergabung dengan guild yang ada</p>
              <button
                onClick={() => setShowCreateModal(true)}
                className="bg-primary-600 text-white px-6 py-2.5 rounded-xl font-medium text-sm hover:bg-primary-700 transition"
              >
                + Buat Guild
              </button>
            </div>
          )}
        </div>
      )}

      {/* Browse Tab */}
      {activeTab === 'browse' && (
        <div className="space-y-4">
          <div className="flex justify-end">
            <button
              onClick={() => setShowCreateModal(true)}
              className="bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700 transition"
            >
              + Buat Guild
            </button>
          </div>

          {availableGuilds.length === 0 ? (
            <div className="bg-white rounded-xl shadow p-12 text-center">
              <div className="text-5xl mb-4">🔍</div>
              <p className="text-gray-500 font-medium">Tidak ada guild tersedia</p>
              <p className="text-sm text-gray-400 mt-1">Semua guild sudah penuh atau belum ada guild</p>
            </div>
          ) : (
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              {availableGuilds.map((guild) => (
                <div key={guild.id} className="bg-white rounded-xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition">
                  <div className="flex items-center gap-3 mb-3">
                    <span className="text-3xl">{guild.icon}</span>
                    <div>
                      <div className="font-bold text-gray-800">{guild.name}</div>
                      <div className="text-xs text-gray-500">
                        {guild.members_count || 0}/{guild.max_members} anggota
                      </div>
                    </div>
                  </div>
                  {guild.description && (
                    <p className="text-sm text-gray-600 mb-3 line-clamp-2">{guild.description}</p>
                  )}
                  <div className="flex items-center justify-between">
                    <span className="text-sm font-bold text-yellow-600">{guild.total_guild_xp} XP</span>
                    <button
                      onClick={() => handleJoinGuild(guild.id)}
                      className="bg-primary-500 text-white px-4 py-1.5 rounded-lg text-sm font-medium hover:bg-primary-600 transition"
                    >
                      Gabung
                    </button>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>
      )}

      {/* Leaderboard Tab */}
      {activeTab === 'leaderboard' && (
        <div className="bg-white rounded-xl shadow overflow-hidden">
          {leaderboard.length === 0 ? (
            <div className="p-12 text-center">
              <div className="text-5xl mb-4">🏆</div>
              <p className="text-gray-500 font-medium">Belum ada data guild</p>
            </div>
          ) : (
            <div className="divide-y">
              {leaderboard.map((guild, idx) => (
                <div key={guild.id} className={`flex items-center gap-4 p-4 ${idx < 3 ? 'bg-gradient-to-r from-yellow-50 to-white' : ''}`}>
                  <div className="w-12 text-center text-2xl">
                    {idx === 0 ? '🥇' : idx === 1 ? '🥈' : idx === 2 ? '🥉' : `#${idx + 1}`}
                  </div>
                  <span className="text-2xl">{guild.icon}</span>
                  <div className="flex-1">
                    <div className="font-semibold">{guild.name}</div>
                    <div className="text-sm text-gray-500">{guild.members_count || 0} anggota</div>
                  </div>
                  <div className="text-right">
                    <div className="font-bold text-yellow-600">{guild.total_guild_xp.toLocaleString()} XP</div>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>
      )}

      {/* Create Guild Modal */}
      {showCreateModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center">
          <div className="absolute inset-0 bg-black/40" onClick={() => setShowCreateModal(false)} />
          <div className="relative bg-white rounded-2xl shadow-xl p-6 w-full max-w-md mx-4">
            <h3 className="text-lg font-bold text-gray-800 mb-4">Buat Guild Baru</h3>

            {/* Icon Selection */}
            <div className="mb-4">
              <label className="text-sm font-medium text-gray-600 mb-2 block">Ikon Guild</label>
              <div className="flex gap-2 flex-wrap">
                {guildIcons.map((icon) => (
                  <button
                    key={icon}
                    onClick={() => setNewGuild({ ...newGuild, icon })}
                    className={`w-10 h-10 rounded-lg text-xl flex items-center justify-center transition ${
                      newGuild.icon === icon
                        ? 'bg-primary-100 ring-2 ring-primary-500'
                        : 'bg-gray-100 hover:bg-gray-200'
                    }`}
                  >
                    {icon}
                  </button>
                ))}
              </div>
            </div>

            {/* Name */}
            <div className="mb-4">
              <label className="text-sm font-medium text-gray-600 mb-1 block">Nama Guild</label>
              <input
                type="text"
                value={newGuild.name}
                onChange={(e) => setNewGuild({ ...newGuild, name: e.target.value })}
                className="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none"
                placeholder="Masukkan nama guild..."
                maxLength={100}
              />
            </div>

            {/* Description */}
            <div className="mb-6">
              <label className="text-sm font-medium text-gray-600 mb-1 block">Deskripsi (Opsional)</label>
              <textarea
                value={newGuild.description}
                onChange={(e) => setNewGuild({ ...newGuild, description: e.target.value })}
                className="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none resize-none"
                placeholder="Tentang guild ini..."
                rows={3}
              />
            </div>

            {/* Actions */}
            <div className="flex gap-3">
              <button
                onClick={() => setShowCreateModal(false)}
                className="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition"
              >
                Batal
              </button>
              <button
                onClick={handleCreateGuild}
                disabled={!newGuild.name.trim() || createLoading}
                className="flex-1 px-4 py-2.5 bg-primary-600 text-white rounded-xl text-sm font-medium hover:bg-primary-700 transition disabled:opacity-50"
              >
                {createLoading ? 'Membuat...' : 'Buat Guild'}
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
