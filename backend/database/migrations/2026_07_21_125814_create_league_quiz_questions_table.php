<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('league_quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('league_quiz_sessions')->onDelete('cascade');
            $table->foreignId('npc_quest_id')->nullable()->constrained('npc_quests');
            $table->text('question');
            $table->json('options');
            $table->string('correct_answer', 255);
            $table->enum('difficulty', ['easy', 'medium', 'hard', 'legendary'])->default('easy');
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->index('session_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('league_quiz_questions');
    }
};
