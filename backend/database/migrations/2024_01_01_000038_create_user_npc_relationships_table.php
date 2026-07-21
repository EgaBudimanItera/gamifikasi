<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_npc_affinity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('npc_id')->constrained('npcs');
            $table->unsignedTinyInteger('affinity_level')->default(1);
            $table->unsignedInteger('affinity_xp')->default(0);
            $table->unsignedInteger('total_quests_completed')->default(0);
            $table->timestamp('last_interaction_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'npc_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_npc_affinity');
    }
};
