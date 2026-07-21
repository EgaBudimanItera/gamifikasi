'use client';

import { useEffect, useRef, useCallback, useState } from 'react';
import { readingApi } from '@/services/api';

interface ReadingTrackerProps {
  materialId: number;
  onReadingComplete?: (result: any) => void;
  children: React.ReactNode;
}

export default function ReadingTracker({ materialId, onReadingComplete, children }: ReadingTrackerProps) {
  const [startTime] = useState(() => Date.now());
  const [elapsedTime, setElapsedTime] = useState(0);
  const [scrollDepth, setScrollDepth] = useState(0);
  const [isActive, setIsActive] = useState(true);
  const lastHeartbeatRef = useRef<number>(0);
  const maxScrollRef = useRef(0);

  const calculateScrollDepth = useCallback(() => {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    if (scrollHeight <= 0) return 0;
    return Math.min(100, Math.round((scrollTop / scrollHeight) * 100));
  }, []);

  const handleScroll = useCallback(() => {
    const depth = calculateScrollDepth();
    if (depth > maxScrollRef.current) {
      maxScrollRef.current = depth;
      setScrollDepth(depth);
    }
  }, [calculateScrollDepth]);

  const sendHeartbeat = useCallback(async () => {
    const now = Date.now();
    const timeSpent = Math.floor((now - startTime) / 1000);
    const currentScrollDepth = calculateScrollDepth();

    try {
      await readingApi.heartbeat(materialId, {
        scroll_depth: currentScrollDepth,
        time_spent: timeSpent,
      });
      lastHeartbeatRef.current = now;
    } catch (err) {
      console.error('Heartbeat failed:', err);
    }
  }, [materialId, startTime, calculateScrollDepth]);

  useEffect(() => {
    window.addEventListener('scroll', handleScroll, { passive: true });

    const heartbeatInterval = setInterval(() => {
      if (isActive) {
        sendHeartbeat();
      }
    }, 30000);

    const timerInterval = setInterval(() => {
      if (isActive) {
        setElapsedTime(Math.floor((Date.now() - startTime) / 1000));
      }
    }, 1000);

    return () => {
      window.removeEventListener('scroll', handleScroll);
      clearInterval(heartbeatInterval);
      clearInterval(timerInterval);
    };
  }, [handleScroll, sendHeartbeat, isActive, startTime]);

  const completeReading = useCallback(async () => {
    const durationSeconds = Math.floor((Date.now() - startTime) / 1000);
    const finalScrollDepth = Math.max(maxScrollRef.current, calculateScrollDepth());

    try {
      const result = await readingApi.complete(materialId, {
        scroll_depth: finalScrollDepth,
        duration_seconds: durationSeconds,
      });

      setIsActive(false);

      if (onReadingComplete) {
        onReadingComplete(result.data.data);
      }

      return result.data.data;
    } catch (err) {
      console.error('Complete reading failed:', err);
      throw err;
    }
  }, [materialId, startTime, calculateScrollDepth, onReadingComplete]);

  const formatTime = (seconds: number) => {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins}:${secs.toString().padStart(2, '0')}`;
  };

  return (
    <div>
      <div className="fixed bottom-4 right-4 bg-white rounded-xl shadow-lg border p-3 z-50">
        <div className="flex items-center gap-3 text-sm">
          <div className="flex items-center gap-1.5">
            <div className="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <span className="text-gray-600">Reading</span>
          </div>
          <div className="text-gray-400">|</div>
          <div className="font-mono text-gray-800">{formatTime(elapsedTime)}</div>
          <div className="text-gray-400">|</div>
          <div className="flex items-center gap-1">
            <div className="w-16 h-1.5 bg-gray-200 rounded-full overflow-hidden">
              <div
                className="h-full bg-primary-500 rounded-full transition-all duration-300"
                style={{ width: `${scrollDepth}%` }}
              />
            </div>
            <span className="text-xs text-gray-500">{scrollDepth}%</span>
          </div>
        </div>
      </div>
      {children}
    </div>
  );
}
