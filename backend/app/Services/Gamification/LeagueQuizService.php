<?php

namespace App\Services\Gamification;

use App\Models\GuildMember;
use App\Models\LeagueQuizSession;
use App\Models\LeagueQuizQuestion;
use App\Models\LeagueQuizParticipant;
use App\Models\NpcQuest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LeagueQuizService
{
    protected XpService $xpService;

    public function __construct(XpService $xpService)
    {
        $this->xpService = $xpService;
    }

    public function getAvailableSessions(User $user): array
    {
        $query = LeagueQuizSession::with(['creator', 'class', 'guild'])
            ->whereIn('status', ['active'])
            ->where('ends_at', '>', now())
            ->where('is_active', true);

        if ($user->role_id == 3) {
            $query->where(function ($q) use ($user) {
                $studentClassIds = $user->studentClasses()->pluck('class_id')->toArray();
                $guildId = GuildMember::where('user_id', $user->id)->value('guild_id');

                $q->where(function ($q2) use ($studentClassIds) {
                    $q2->where('mode', 'class')
                       ->whereIn('class_id', $studentClassIds);
                })->orWhere(function ($q2) use ($guildId) {
                    $q2->where('mode', 'guild')
                       ->where('guild_id', $guildId);
                });
            });
        }

        $sessions = $query->orderBy('starts_at', 'desc')->get();

        $result = [];
        foreach ($sessions as $session) {
            $participantCount = $session->participants()->count();
            $hasJoined = $session->participants()->where('user_id', $user->id)->exists();

            $sessionData = [
                'id' => $session->id,
                'title' => $session->title,
                'mode' => $session->mode,
                'difficulty' => $session->difficulty,
                'duration_minutes' => $session->duration_minutes,
                'questions_count' => $session->questions_count,
                'xp_reward' => $session->xp_reward,
                'pass_threshold' => $session->pass_threshold,
                'status' => $session->status,
                'starts_at' => $session->starts_at->toIso8601String(),
                'ends_at' => $session->ends_at->toIso8601String(),
                'time_remaining' => max(0, $session->ends_at->diffInSeconds(now())),
                'creator_name' => $session->creator->name ?? 'Unknown',
                'class_name' => $session->class->name ?? null,
                'guild_name' => $session->guild->name ?? null,
                'participant_count' => $participantCount,
                'has_joined' => $hasJoined,
            ];

            if ($hasJoined) {
                $myResult = $session->participants()->where('user_id', $user->id)->first();
                $sessionData['my_result'] = [
                    'correct_count' => $myResult->correct_count,
                    'total_questions' => $myResult->total_questions,
                    'xp_earned' => $myResult->xp_earned,
                    'status' => $myResult->status,
                ];
            }

            $result[] = $sessionData;
        }

        return $result;
    }

    public function createSession(User $creator, array $data): LeagueQuizSession
    {
        $mode = $data['mode'] ?? 'class';
        $duration = $data['duration_minutes'] ?? ($mode === 'guild' ? 15 : 5);
        $questionsCount = $data['questions_count'] ?? ($mode === 'guild' ? 10 : 5);
        $difficulty = $data['difficulty'] ?? ($mode === 'guild' ? 'hard' : 'easy');
        $xpReward = $data['xp_reward'] ?? ($mode === 'guild' ? 75 : 30);
        $passThreshold = $data['pass_threshold'] ?? 60;

        $now = now();
        $session = LeagueQuizSession::create([
            'created_by' => $creator->id,
            'title' => $data['title'],
            'mode' => $mode,
            'class_id' => $data['class_id'] ?? null,
            'guild_id' => $data['guild_id'] ?? null,
            'duration_minutes' => $duration,
            'questions_count' => $questionsCount,
            'difficulty' => $difficulty,
            'pass_threshold' => $passThreshold,
            'xp_reward' => $xpReward,
            'status' => 'active',
            'starts_at' => $data['starts_at'] ?? $now,
            'ends_at' => $data['ends_at'] ?? $now->copy()->addMinutes($duration),
            'is_active' => true,
        ]);

        $this->pickQuestions($session);

        return $session;
    }

    public function pickQuestions(LeagueQuizSession $session): void
    {
        $query = NpcQuest::where('is_active', true);

        if ($session->difficulty === 'easy') {
            $query->whereIn('difficulty', ['easy', 'medium']);
        } else {
            $query->whereIn('difficulty', ['hard', 'legendary']);
        }

        $questions = $query->inRandomOrder()
            ->limit($session->questions_count)
            ->get();

        $order = 1;
        foreach ($questions as $q) {
            $options = is_string($q->options) ? json_decode($q->options, true) : $q->options;
            LeagueQuizQuestion::create([
                'session_id' => $session->id,
                'npc_quest_id' => $q->id,
                'question' => $q->question,
                'options' => $options,
                'correct_answer' => $q->correct_answer,
                'difficulty' => $q->difficulty,
                'order' => $order++,
            ]);
        }
    }

    public function joinSession(User $user, LeagueQuizSession $session): array
    {
        if ($session->status !== 'active') {
            throw new \Exception('Sesi quiz tidak aktif');
        }

        if ($session->isExpired()) {
            throw new \Exception('Sesi quiz sudah berakhir');
        }

        $existing = LeagueQuizParticipant::where('session_id', $session->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existing) {
            throw new \Exception('Kamu sudah bergabung di sesi ini');
        }

        $participant = LeagueQuizParticipant::create([
            'session_id' => $session->id,
            'user_id' => $user->id,
            'total_questions' => $session->questions->count(),
            'started_at' => now(),
            'status' => 'in_progress',
        ]);

        $questions = $session->questions()
            ->orderBy('order')
            ->get()
            ->map(fn($q) => [
                'id' => $q->id,
                'question' => $q->question,
                'options' => $q->options,
                'difficulty' => $q->difficulty,
                'order' => $q->order,
            ])
            ->toArray();

        return [
            'participant_id' => $participant->id,
            'session' => [
                'id' => $session->id,
                'title' => $session->title,
                'mode' => $session->mode,
                'duration_minutes' => $session->duration_minutes,
                'ends_at' => $session->ends_at->toIso8601String(),
                'time_remaining' => max(0, $session->ends_at->diffInSeconds(now())),
            ],
            'questions' => $questions,
        ];
    }

    public function submitAnswer(User $user, LeagueQuizSession $session, array $answers): array
    {
        $participant = LeagueQuizParticipant::where('session_id', $session->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$participant) {
            throw new \Exception('Kamu belum bergabung di sesi ini');
        }

        if ($participant->status === 'completed') {
            throw new \Exception('Kamu sudah submit jawaban');
        }

        if ($session->isExpired() && $participant->status !== 'completed') {
            $participant->update(['status' => 'timeout']);
        }

        $questions = $session->questions()->get();
        $correctCount = 0;

        foreach ($answers as $questionId => $answer) {
            $question = $questions->firstWhere('id', $questionId);
            if ($question && $question->correct_answer === $answer) {
                $correctCount++;
            }
        }

        $totalQuestions = $questions->count();
        $passPercentage = $totalQuestions > 0 ? ($correctCount / $totalQuestions) * 100 : 0;
        $passed = $passPercentage >= $session->pass_threshold;
        $xpEarned = $passed ? $session->xp_reward : 0;

        $participant->update([
            'answers' => $answers,
            'correct_count' => $correctCount,
            'xp_earned' => $xpEarned,
            'completed_at' => now(),
            'status' => 'completed',
        ]);

        if ($xpEarned > 0) {
            $this->xpService->award(
                $user,
                $xpEarned,
                'quick_quiz',
                "Quick Quiz: {$session->title} ({$correctCount}/{$totalQuestions})",
                $session->id,
                LeagueQuizSession::class
            );
        }

        $ranking = $this->getSessionRanking($session);

        return [
            'correct_count' => $correctCount,
            'total_questions' => $totalQuestions,
            'pass_percentage' => round($passPercentage, 1),
            'passed' => $passed,
            'xp_earned' => $xpEarned,
            'status' => $participant->status,
            'ranking' => $ranking,
        ];
    }

    public function getSessionResults(LeagueQuizSession $session): array
    {
        $participants = $session->participants()
            ->with('user:id,name')
            ->where('status', 'completed')
            ->orderByDesc('correct_count')
            ->get();

        return [
            'session' => [
                'id' => $session->id,
                'title' => $session->title,
                'mode' => $session->mode,
                'status' => $session->status,
            ],
            'ranking' => $participants->map(fn($p, $i) => [
                'rank' => $i + 1,
                'user_id' => $p->user_id,
                'user_name' => $p->user->name ?? 'Unknown',
                'correct_count' => $p->correct_count,
                'total_questions' => $p->total_questions,
                'score_percentage' => $p->total_questions > 0
                    ? round(($p->correct_count / $p->total_questions) * 100, 1)
                    : 0,
                'xp_earned' => $p->xp_earned,
            ])->toArray(),
            'total_participants' => $participants->count(),
        ];
    }

    protected function getSessionRanking(LeagueQuizSession $session): array
    {
        return $session->participants()
            ->with('user:id,name')
            ->where('status', 'completed')
            ->orderByDesc('correct_count')
            ->get()
            ->map(fn($p, $i) => [
                'rank' => $i + 1,
                'user_id' => $p->user_id,
                'user_name' => $p->user->name ?? 'Unknown',
                'correct_count' => $p->correct_count,
                'xp_earned' => $p->xp_earned,
            ])
            ->toArray();
    }
}
