'use client';

import { useEffect, useState } from 'react';
import { badgeApi } from '@/services/api';
import { Badge } from '@/types';

export default function BadgesPage() {
  const [badges, setBadges] = useState<Badge[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    loadBadges();
  }, []);

  const loadBadges = async () => {
    try {
      const res = await badgeApi.list();
      setBadges(res.data.data);
    } catch (error) {
      console.error('Error loading badges:', error);
    } finally {
      setLoading(false);
    }
  };

  const getCategoryIcon = (category: string) => {
    switch (category) {
      case 'achievement': return '🏆';
      case 'streak': return '🔥';
      case 'rank': return '👑';
      case 'special': return '⭐';
      default: return '🎖️';
    }
  };

  return (
    <div>
      <h1 className="text-2xl font-bold text-gray-800 mb-6">Badge Gallery</h1>

        {loading ? (
          <div className="text-center py-8 text-gray-500">Memuat badge...</div>
        ) : (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            {badges.map((badge) => (
              <div key={badge.id} className="bg-white rounded-xl shadow p-6 text-center hover:shadow-lg transition">
                <div className="text-5xl mb-3">{getCategoryIcon(badge.category)}</div>
                <h3 className="text-lg font-semibold">{badge.name}</h3>
                <p className="text-gray-600 text-sm mt-2">{badge.description}</p>
                <div className="mt-3 inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                  +{badge.xp_reward} XP
                </div>
              </div>
            ))}
          </div>
        )}
    </div>
  );
}
