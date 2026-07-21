<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reading_quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('material_id')->constrained('materials');
            $table->unsignedTinyInteger('total_questions');
            $table->unsignedTinyInteger('correct_answers');
            $table->boolean('passed');
            $table->unsignedInteger('xp_earned')->default(0);
            $table->timestamps();

            $table->index(['user_id', 'material_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reading_quiz_attempts');
    }
};
