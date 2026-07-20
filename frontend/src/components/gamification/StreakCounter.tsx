interface StreakCounterProps {
  current: number;
  longest: number;
}

export default function StreakCounter({ current, longest }: StreakCounterProps) {
  return (
    <div className="bg-gradient-to-r from-orange-400 to-red-500 rounded-xl p-4 text-white">
      <div className="flex items-center gap-3">
        <div className="text-4xl animate-streak-fire">🔥</div>
        <div>
          <div className="text-3xl font-bold">{current}</div>
          <div className="text-sm opacity-90">Streak Hari</div>
        </div>
      </div>
      <div className="mt-2 text-sm opacity-75">
        Rekor terbaik: {longest} hari
      </div>
    </div>
  );
}
