<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guild_quests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guild_id')->constrained('guilds')->onDelete('cascade');
            $table->foreignId('quest_id')->constrained('quests');
            $table->integer('current_progress')->default(0);
            $table->integer('target_progress')->default(100);
            $table->enum('status', ['active', 'completed', 'failed'])->default('active');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index(['guild_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guild_quests');
    }
};
