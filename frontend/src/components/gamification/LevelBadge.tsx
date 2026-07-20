interface LevelBadgeProps {
  level: number;
  size?: 'sm' | 'md' | 'lg';
}

export default function LevelBadge({ level, size = 'md' }: LevelBadgeProps) {
  const sizeClasses = {
    sm: 'w-8 h-8 text-sm',
    md: 'w-12 h-12 text-lg',
    lg: 'w-16 h-16 text-2xl',
  };

  const getLevelColor = (level: number) => {
    if (level >= 10) return 'bg-gradient-to-br from-purple-500 to-pink-500';
    if (level >= 5) return 'bg-gradient-to-br from-blue-500 to-cyan-500';
    return 'bg-gradient-to-br from-green-500 to-teal-500';
  };

  return (
    <div
      className={`${sizeClasses[size]} ${getLevelColor(level)} rounded-full flex items-center justify-center text-white font-bold shadow-lg`}
    >
      {level}
    </div>
  );
}
