interface ProgressBarProps {
  current: number;
  max: number;
  label?: string;
  showValue?: boolean;
  color?: 'blue' | 'green' | 'yellow' | 'purple';
}

export default function ProgressBar({
  current,
  max,
  label,
  showValue = true,
  color = 'blue',
}: ProgressBarProps) {
  const percentage = max > 0 ? Math.min(100, (current / max) * 100) : 0;

  const colorClasses = {
    blue: 'bg-blue-500',
    green: 'bg-green-500',
    yellow: 'bg-yellow-500',
    purple: 'bg-purple-500',
  };

  return (
    <div className="w-full">
      {label && (
        <div className="flex justify-between mb-1">
          <span className="text-sm font-medium text-gray-700">{label}</span>
          {showValue && (
            <span className="text-sm text-gray-500">
              {current} / {max}
            </span>
          )}
        </div>
      )}
      <div className="w-full bg-gray-200 rounded-full h-3">
        <div
          className={`${colorClasses[color]} h-3 rounded-full transition-all duration-500`}
          style={{ width: `${percentage}%` }}
        ></div>
      </div>
    </div>
  );
}
