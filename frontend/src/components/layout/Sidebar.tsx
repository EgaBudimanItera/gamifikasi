'use client';

import Link from 'next/link';
import { usePathname } from 'next/navigation';
import { useState } from 'react';
import { useAuth } from '@/contexts/AuthContext';

interface NavItem {
  label: string;
  href: string;
  icon: string;
  roles?: string[];
}

const navItems: NavItem[] = [
  { label: 'Dashboard', href: '/dashboard/admin', icon: '📊', roles: ['admin'] },
  { label: 'Dashboard', href: '/dashboard/teacher', icon: '📊', roles: ['guru'] },
  { label: 'Dashboard', href: '/dashboard/student', icon: '📊', roles: ['siswa'] },
  { label: 'Materi', href: '/materials', icon: '📚', roles: ['siswa', 'guru', 'admin'] },
  { label: 'Tugas', href: '/assignments', icon: '📝', roles: ['siswa', 'guru', 'admin'] },
  { label: 'Periksa Tugas', href: '/submissions', icon: '✅', roles: ['guru'] },
  { label: 'Quest', href: '/quests', icon: '🎯', roles: ['siswa', 'admin'] },
  { label: 'Badge', href: '/badges', icon: '🏆', roles: ['siswa', 'admin'] },
  { label: 'Leaderboard', href: '/leaderboard', icon: '🏅', roles: ['siswa', 'guru', 'admin'] },
  { label: 'Riwayat XP', href: '/xp-history', icon: '⭐', roles: ['siswa'] },
  { label: 'Liga', href: '/league', icon: '🏆', roles: ['siswa'] },
  { label: 'Guild', href: '/guild', icon: '🛡️', roles: ['siswa'] },
  { label: 'Manajemen User', href: '/admin/users', icon: '👥', roles: ['admin'] },
  { label: 'Manajemen Sekolah', href: '/admin/schools', icon: '🏫', roles: ['admin'] },
  { label: 'Kelas & Penugasan', href: '/admin/classes', icon: '📋', roles: ['admin'] },
];

export default function Sidebar() {
  const { user, logout } = useAuth();
  const pathname = usePathname();
  const [collapsed, setCollapsed] = useState(false);
  const [mobileOpen, setMobileOpen] = useState(false);

  const filtered = navItems.filter((item) => {
    if (!item.roles || !user) return true;
    return item.roles.includes(user.role);
  });

  const isActive = (href: string) => pathname === href || pathname.startsWith(href + '/');

  const navContent = (
    <div className="flex flex-col h-full">
      {/* Logo */}
      <div className="p-4 border-b border-gray-200">
        <Link href="/" className="flex items-center gap-2">
          <span className="text-2xl">🎮</span>
          {!collapsed && <span className="text-lg font-bold text-primary-700">EduQuest</span>}
        </Link>
      </div>

      {/* User Info */}
      {user && (
        <div className="p-4 border-b border-gray-200">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 font-bold text-sm">
              {user.name.charAt(0)}
            </div>
            {!collapsed && (
              <div className="min-w-0">
                <div className="font-semibold text-sm truncate">{user.name}</div>
                <div className="text-xs text-gray-500 capitalize">{user.role}</div>
              </div>
            )}
          </div>
        </div>
      )}

      {/* Navigation */}
      <nav className="flex-1 p-3 space-y-1 overflow-y-auto">
        {filtered.map((item) => (
          <Link
            key={item.href}
            href={item.href}
            onClick={() => setMobileOpen(false)}
            className={`flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition ${
              isActive(item.href)
                ? 'bg-primary-50 text-primary-700'
                : 'text-gray-600 hover:bg-gray-100'
            }`}
          >
            <span className="text-lg flex-shrink-0">{item.icon}</span>
            {!collapsed && <span>{item.label}</span>}
          </Link>
        ))}
      </nav>

      {/* Logout */}
      <div className="p-3 border-t border-gray-200">
        <button
          onClick={logout}
          className="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition"
        >
          <span className="text-lg flex-shrink-0">🚪</span>
          {!collapsed && <span>Keluar</span>}
        </button>
      </div>
    </div>
  );

  return (
    <>
      {/* Mobile hamburger */}
      <button
        onClick={() => setMobileOpen(true)}
        className="lg:hidden fixed top-4 left-4 z-50 p-2 bg-white rounded-lg shadow"
      >
        <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      {/* Mobile overlay */}
      {mobileOpen && (
        <div className="lg:hidden fixed inset-0 z-40">
          <div className="absolute inset-0 bg-black/30" onClick={() => setMobileOpen(false)} />
          <div className="absolute left-0 top-0 h-full w-64 bg-white shadow-xl">
            {navContent}
          </div>
        </div>
      )}

      {/* Desktop sidebar */}
      <div className={`hidden lg:block ${collapsed ? 'w-16' : 'w-64'} flex-shrink-0 transition-all`}>
        <div className="fixed top-0 left-0 h-full bg-white border-r border-gray-200 shadow-sm" style={{ width: collapsed ? '4rem' : '16rem' }}>
          {/* Collapse toggle */}
          <button
            onClick={() => setCollapsed(!collapsed)}
            className="absolute -right-3 top-8 z-10 w-6 h-6 bg-white border border-gray-300 rounded-full flex items-center justify-center text-gray-500 hover:bg-gray-50 text-xs"
          >
            {collapsed ? '→' : '←'}
          </button>
          {navContent}
        </div>
      </div>
    </>
  );
}
