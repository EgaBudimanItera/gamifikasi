<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('league_quiz_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users');
            $table->string('title', 200);
            $table->enum('mode', ['class', 'guild']);
            $table->foreignId('class_id')->nullable()->constrained('classes');
            $table->foreignId('guild_id')->nullable()->constrained('guilds');
            $table->integer('duration_minutes')->default(5);
            $table->integer('questions_count')->default(5);
            $table->enum('difficulty', ['easy', 'hard'])->default('easy');
            $table->integer('pass_threshold')->default(60);
            $table->integer('xp_reward')->default(30);
            $table->boolean('is_active')->default(true);
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');
            $table->timestamps();

            $table->index(['status', 'mode']);
            $table->index(['class_id', 'status']);
            $table->index(['guild_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('league_quiz_sessions');
    }
};
