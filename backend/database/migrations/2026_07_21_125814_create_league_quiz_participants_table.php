<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('league_quiz_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('league_quiz_sessions')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->json('answers')->nullable();
            $table->integer('correct_count')->default(0);
            $table->integer('total_questions')->default(0);
            $table->integer('xp_earned')->default(0);
            $table->timestamp('started_at');
            $table->timestamp('completed_at')->nullable();
            $table->enum('status', ['in_progress', 'completed', 'timeout'])->default('in_progress');
            $table->timestamps();

            $table->unique(['session_id', 'user_id']);
            $table->index(['session_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('league_quiz_participants');
    }
};
