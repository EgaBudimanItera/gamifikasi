<?php

namespace App\Services\Gamification;

use App\Models\Material;
use App\Models\User;
use App\Models\ReadingLog;
use App\Models\ReadingQuiz;
use App\Models\ReadingQuizAttempt;

class MaterialReadingService
{
    private XpService $xpService;

    public function __construct(XpService $xpService)
    {
        $this->xpService = $xpService;
    }

    public function startReading(User $user, Material $material): ReadingLog
    {
        $existing = ReadingLog::where('user_id', $user->id)
            ->where('material_id', $material->id)
            ->whereNull('duration_seconds')
            ->latest()
            ->first();

        if ($existing) {
            return $existing;
        }

        return ReadingLog::create([
            'user_id' => $user->id,
            'material_id' => $material->id,
            'started_at' => now(),
        ]);
    }

    public function updateProgress(User $user, Material $material, int $scrollDepth, int $timeSpent): ReadingLog
    {
        $log = ReadingLog::where('user_id', $user->id)
            ->where('material_id', $material->id)
            ->whereNull('duration_seconds')
            ->latest()
            ->first();

        if (!$log) {
            return $this->startReading($user, $material);
        }

        $log->update([
            'scroll_depth' => max($log->scroll_depth, $scrollDepth),
            'duration_seconds' => $timeSpent,
        ]);

        return $log->fresh();
    }

    public function completeReading(User $user, Material $material, int $scrollDepth, int $durationSeconds): array
    {
        $log = ReadingLog::where('user_id', $user->id)
            ->where('material_id', $material->id)
            ->whereNull('duration_seconds')
            ->latest()
            ->first();

        if (!$log) {
            $log = $this->startReading($user, $material);
        }

        $anomalyReasons = $this->detectAnomalies($scrollDepth, $durationSeconds);
        $isAnomaly = count($anomalyReasons) > 0;

        $log->update([
            'scroll_depth' => max($log->scroll_depth, $scrollDepth),
            'duration_seconds' => $durationSeconds,
            'is_completed' => true,
            'is_anomaly' => $isAnomaly,
            'anomaly_reason' => $isAnomaly ? implode('; ', $anomalyReasons) : null,
        ]);

        $xpBreakdown = $this->calculateXp($user, $material, $scrollDepth, $durationSeconds, $isAnomaly);
        $totalXp = array_sum($xpBreakdown);

        if ($totalXp > 0) {
            $result = $this->xpService->award(
                $user,
                $totalXp,
                'reading',
                "Membaca materi: {$material->title}",
                $material->id,
                Material::class
            );

            $log->update(['xp_earned' => $totalXp]);
        }

        return [
            'xp_breakdown' => $xpBreakdown,
            'total_xp' => $totalXp,
            'is_anomaly' => $isAnomaly,
            'anomaly_reasons' => $anomalyReasons,
        ];
    }

    public function getQuiz(Material $material): array
    {
        return ReadingQuiz::where('material_id', $material->id)
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit(3)
            ->get()
            ->map(fn($q) => [
                'id' => $q->id,
                'question' => $q->question,
                'options' => $q->options,
                'difficulty' => $q->difficulty,
            ])
            ->toArray();
    }

    public function submitQuiz(User $user, Material $material, array $answers): array
    {
        $quizzes = ReadingQuiz::where('material_id', $material->id)
            ->where('is_active', true)
            ->get();

        $totalQuestions = $quizzes->count();
        if ($totalQuestions === 0) {
            return ['error' => 'Tidak ada soal tersedia'];
        }

        $correctAnswers = 0;
        foreach ($answers as $quizId => $answer) {
            $quiz = $quizzes->firstWhere('id', $quizId);
            if ($quiz && $quiz->correct_answer === $answer) {
                $correctAnswers++;
            }
        }

        $passed = $correctAnswers >= 2;
        $xpEarned = $passed ? 15 : 0;

        $attempt = ReadingQuizAttempt::create([
            'user_id' => $user->id,
            'material_id' => $material->id,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'passed' => $passed,
            'xp_earned' => $xpEarned,
        ]);

        if ($passed) {
            $this->xpService->award(
                $user,
                $xpEarned,
                'reading_quiz',
                "Quiz materi: {$material->title} ({$correctAnswers}/{$totalQuestions})",
                $material->id,
                Material::class
            );
        }

        return [
            'attempt_id' => $attempt->id,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'passed' => $passed,
            'xp_earned' => $xpEarned,
        ];
    }

    public function getReadingStats(User $user): array
    {
        $totalRead = ReadingLog::where('user_id', $user->id)
            ->where('is_completed', true)
            ->count();

        $totalXp = ReadingLog::where('user_id', $user->id)
            ->sum('xp_earned');

        $totalTime = ReadingLog::where('user_id', $user->id)
            ->sum('duration_seconds');

        $totalQuizAttempts = ReadingQuizAttempt::where('user_id', $user->id)->count();
        $passedQuizzes = ReadingQuizAttempt::where('user_id', $user->id)->where('passed', true)->count();

        $recentLogs = ReadingLog::where('user_id', $user->id)
            ->with('material:id,title')
            ->latest()
            ->limit(10)
            ->get();

        return [
            'total_materials_read' => $totalRead,
            'total_xp_earned' => $totalXp,
            'total_reading_time_seconds' => $totalTime,
            'total_quiz_attempts' => $totalQuizAttempts,
            'passed_quizzes' => $passedQuizzes,
            'recent_logs' => $recentLogs,
        ];
    }

    private function calculateXp(User $user, Material $material, int $scrollDepth, int $durationSeconds, bool $isAnomaly): array
    {
        $breakdown = [];

        $hasOpenedBefore = ReadingLog::where('user_id', $user->id)
            ->where('material_id', $material->id)
            ->where('id', '!=', null)
            ->where('is_completed', true)
            ->exists();

        $breakdown['open_bonus'] = 5;

        if (!$hasOpenedBefore) {
            $breakdown['first_read_bonus'] = 20;
        }

        if (!$isAnomaly && $durationSeconds >= 180) {
            $breakdown['time_bonus'] = 10;
        }

        if (!$isAnomaly && $scrollDepth >= 80) {
            $breakdown['scroll_completion_bonus'] = 5;
        }

        return $breakdown;
    }

    private function detectAnomalies(int $scrollDepth, int $durationSeconds): array
    {
        $reasons = [];

        if ($scrollDepth >= 80 && $durationSeconds < 10) {
            $reasons[] = 'Scroll 80%+ dalam waktu kurang dari 10 detik';
        }

        $hourlyLimit = ReadingLog::where('started_at', '>=', now()->subHour())
            ->where('is_completed', true)
            ->count();

        if ($hourlyLimit >= 10) {
            $reasons[] = 'Batas 10 materi per jam tercapai';
        }

        return $reasons;
    }
}
