interface XpBadgeProps {
  amount: number;
  size?: 'sm' | 'md' | 'lg';
  animated?: boolean;
}

export default function XpBadge({ amount, size = 'md', animated = false }: XpBadgeProps) {
  const sizeClasses = {
    sm: 'text-sm px-2 py-1',
    md: 'text-base px-3 py-1',
    lg: 'text-lg px-4 py-2',
  };

  return (
    <span
      className={`inline-flex items-center gap-1 bg-yellow-100 text-yellow-800 rounded-full font-bold ${sizeClasses[size]} ${
        animated ? 'animate-xp-gain' : ''
      }`}
    >
      <span>⭐</span>
      <span>+{amount} XP</span>
    </span>
  );
}
