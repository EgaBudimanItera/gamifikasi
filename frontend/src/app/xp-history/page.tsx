'use client';

import { useEffect, useState, useMemo } from 'react';
import { gamificationApi } from '@/services/api';
import { XpLog, PaginatedResponse } from '@/types';

type XpType = XpLog['type'] | 'all';

const typeConfig: Record<XpLog['type'], { label: string; icon: string; color: string; bg: string; border: string }> = {
  assignment: { label: 'Tugas', icon: '📝', color: 'text-blue-700', bg: 'bg-blue-50', border: 'border-blue-200' },
  login:      { label: 'Login', icon: '🔑', color: 'text-green-700', bg: 'bg-green-50', border: 'border-green-200' },
  streak:     { label: 'Streak', icon: '🔥', color: 'text-orange-700', bg: 'bg-orange-50', border: 'border-orange-200' },
  quest:      { label: 'Quest', icon: '🎯', color: 'text-purple-700', bg: 'bg-purple-50', border: 'border-purple-200' },
  penalty:    { label: 'Penalti', icon: '⚠️', color: 'text-red-700', bg: 'bg-red-50', border: 'border-red-200' },
};

const filterTabs: { key: XpType; label: string; icon: string }[] = [
  { key: 'all', label: 'Semua', icon: '📊' },
  { key: 'login', label: 'Login', icon: '🔑' },
  { key: 'streak', label: 'Streak', icon: '🔥' },
  { key: 'assignment', label: 'Tugas', icon: '📝' },
  { key: 'quest', label: 'Quest', icon: '🎯' },
  { key: 'penalty', label: 'Penalti', icon: '⚠️' },
];

function formatDate(dateStr: string): string {
  const d = new Date(dateStr);
  const now = new Date();
  const diffMs = now.getTime() - d.getTime();
  const diffMin = Math.floor(diffMs / 60000);
  const diffHr = Math.floor(diffMin / 60);

  if (diffMin < 1) return 'Baru saja';
  if (diffMin < 60) return `${diffMin} menit lalu`;
  if (diffHr < 24) return `${diffHr} jam lalu`;

  const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
  const logDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
  const diffDays = Math.floor((today.getTime() - logDate.getTime()) / 86400000);

  if (diffDays === 0) return 'Hari ini';
  if (diffDays === 1) return 'Kemarin';
  if (diffDays < 7) return `${diffDays} hari lalu`;

  return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
}

function getDateGroup(dateStr: string): string {
  const d = new Date(dateStr);
  const now = new Date();
  const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
  const logDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
  const diffDays = Math.floor((today.getTime() - logDate.getTime()) / 86400000);

  if (diffDays === 0) return 'Hari Ini';
  if (diffDays === 1) return 'Kemarin';
  if (diffDays < 7) return `${diffDays} Hari Lalu`;
  return d.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
}

export default function XpHistoryPage() {
  const [logs, setLogs] = useState<XpLog[]>([]);
  const [loading, setLoading] = useState(true);
  const [activeFilter, setActiveFilter] = useState<XpType>('all');
  const [currentPage, setCurrentPage] = useState(1);
  const [meta, setMeta] = useState({ current_page: 1, last_page: 1, per_page: 20, total: 0 });

  useEffect(() => { loadLogs(); }, [currentPage]);

  const loadLogs = async () => {
    setLoading(true);
    try {
      const res = await gamificationApi.xpLogs(currentPage);
      const paginated = res.data.data;
      setLogs(paginated.data);
      setMeta({
        current_page: paginated.current_page,
        last_page: paginated.last_page,
        per_page: paginated.per_page,
        total: paginated.total,
      });
    } catch (error) {
      console.error('Error loading XP logs:', error);
    } finally {
      setLoading(false);
    }
  };

  const filteredLogs = useMemo(() => {
    if (activeFilter === 'all') return logs;
    return logs.filter((l) => l.type === activeFilter);
  }, [logs, activeFilter]);

  const groupedLogs = useMemo(() => {
    const groups: Record<string, XpLog[]> = {};
    filteredLogs.forEach((log) => {
      const key = getDateGroup(log.created_at);
      if (!groups[key]) groups[key] = [];
      groups[key].push(log);
    });
    return groups;
  }, [filteredLogs]);

  const summary = useMemo(() => {
    const s = { total: 0, login: 0, streak: 0, assignment: 0, quest: 0, penalty: 0 };
    logs.forEach((l) => {
      s.total += l.amount;
      s[l.type] += l.amount;
    });
    return s;
  }, [logs]);

  return (
    <div>
      <div className="flex items-center justify-between mb-6">
        <div>
          <h1 className="text-2xl font-bold text-gray-800">Riwayat XP</h1>
          <p className="text-sm text-gray-500 mt-1">Lihat dari mana kamu mendapatkan XP</p>
        </div>
        <div className="flex items-center gap-2 bg-yellow-50 border border-yellow-200 rounded-xl px-4 py-2">
          <span className="text-2xl">⭐</span>
          <div>
            <div className="text-xs text-yellow-600">Total XP</div>
            <div className="text-xl font-bold text-yellow-700">{summary.total.toLocaleString()}</div>
          </div>
        </div>
      </div>

      {/* Summary Cards */}
      <div className="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
        {(['login', 'streak', 'assignment', 'quest'] as const).map((type) => (
          <div key={type} className={`${typeConfig[type].bg} border ${typeConfig[type].border} rounded-xl p-4 text-center`}>
            <div className="text-2xl mb-1">{typeConfig[type].icon}</div>
            <div className={`text-xl font-bold ${typeConfig[type].color}`}>
              {summary[type] >= 0 ? '+' : ''}{summary[type]}
            </div>
            <div className={`text-xs ${typeConfig[type].color} opacity-75`}>{typeConfig[type].label}</div>
          </div>
        ))}
      </div>

      {/* Penalty summary if exists */}
      {summary.penalty !== 0 && (
        <div className="bg-red-50 border border-red-200 rounded-xl p-4 mb-6 flex items-center gap-3">
          <span className="text-2xl">⚠️</span>
          <div>
            <div className="text-sm text-red-600">Total Penalti</div>
            <div className="text-lg font-bold text-red-700">{summary.penalty} XP</div>
          </div>
        </div>
      )}

      {/* Filter Tabs */}
      <div className="flex gap-2 mb-6 overflow-x-auto pb-2">
        {filterTabs.map((tab) => (
          <button
            key={tab.key}
            onClick={() => { setActiveFilter(tab.key); setCurrentPage(1); }}
            className={`flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition ${
              activeFilter === tab.key
                ? 'bg-primary-600 text-white shadow-md'
                : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50'
            }`}
          >
            <span>{tab.icon}</span>
            <span>{tab.label}</span>
          </button>
        ))}
      </div>

      {/* Timeline */}
      {loading ? (
        <div className="flex items-center justify-center py-20">
          <div className="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-600"></div>
        </div>
      ) : filteredLogs.length === 0 ? (
        <div className="bg-white rounded-xl shadow p-12 text-center">
          <div className="text-5xl mb-4">📭</div>
          <p className="text-gray-500 font-medium">Belum ada riwayat XP</p>
          <p className="text-sm text-gray-400 mt-1">XP akan muncul setelah kamu login, mengerjakan tugas, atau menyelesaikan quest</p>
        </div>
      ) : (
        <div className="space-y-6">
          {Object.entries(groupedLogs).map(([dateLabel, items]) => (
            <div key={dateLabel}>
              {/* Date Header */}
              <div className="flex items-center gap-3 mb-3">
                <div className="text-sm font-semibold text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                  {dateLabel}
                </div>
                <div className="flex-1 h-px bg-gray-200"></div>
                <div className="text-xs text-gray-400">
                  +{items.reduce((sum, l) => sum + l.amount, 0)} XP hari ini
                </div>
              </div>

              {/* Log Items */}
              <div className="space-y-2">
                {items.map((log) => {
                  const config = typeConfig[log.type];
                  const isNegative = log.amount < 0;
                  return (
                    <div
                      key={log.id}
                      className={`bg-white rounded-xl border ${isNegative ? 'border-red-200' : 'border-gray-100'} shadow-sm p-4 flex items-center gap-4 hover:shadow-md transition`}
                    >
                      {/* Icon */}
                      <div className={`w-10 h-10 rounded-full ${config.bg} flex items-center justify-center text-lg flex-shrink-0`}>
                        {config.icon}
                      </div>

                      {/* Description */}
                      <div className="flex-1 min-w-0">
                        <div className="font-medium text-gray-800 text-sm truncate">
                          {log.description}
                        </div>
                        <div className="flex items-center gap-2 mt-0.5">
                          <span className={`text-xs px-2 py-0.5 rounded-full ${config.bg} ${config.color} font-medium`}>
                            {config.label}
                          </span>
                          <span className="text-xs text-gray-400">
                            {formatDate(log.created_at)}
                          </span>
                        </div>
                      </div>

                      {/* XP Amount */}
                      <div className={`text-right flex-shrink-0`}>
                        <div className={`text-lg font-bold ${isNegative ? 'text-red-600' : 'text-yellow-600'}`}>
                          {isNegative ? '' : '+'}{log.amount}
                        </div>
                        <div className="text-xs text-gray-400">XP</div>
                      </div>
                    </div>
                  );
                })}
              </div>
            </div>
          ))}

          {/* Pagination */}
          {meta.last_page > 1 && (
            <div className="flex items-center justify-center gap-2 mt-8">
              <button
                onClick={() => setCurrentPage((p) => Math.max(1, p - 1))}
                disabled={currentPage === 1}
                className="px-4 py-2 rounded-lg bg-white border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 disabled:opacity-40 disabled:cursor-not-allowed transition"
              >
                ← Sebelumnya
              </button>
              <span className="text-sm text-gray-500 px-3">
                Halaman {meta.current_page} / {meta.last_page}
              </span>
              <button
                onClick={() => setCurrentPage((p) => Math.min(meta.last_page, p + 1))}
                disabled={currentPage === meta.last_page}
                className="px-4 py-2 rounded-lg bg-white border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 disabled:opacity-40 disabled:cursor-not-allowed transition"
              >
                Selanjutnya →
              </button>
            </div>
          )}
        </div>
      )}
    </div>
  );
}
