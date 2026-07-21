<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('npc_quests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('npc_id')->constrained('npcs');
            $table->text('question');
            $table->json('options');
            $table->string('correct_answer');
            $table->enum('difficulty', ['easy', 'medium', 'hard', 'legendary'])->default('easy');
            $table->unsignedInteger('xp_reward');
            $table->unsignedTinyInteger('required_affinity_level')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('npc_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('npc_quests');
    }
};
