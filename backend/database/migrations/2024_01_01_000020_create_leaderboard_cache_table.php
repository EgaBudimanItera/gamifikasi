<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaderboard_cache', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('class_id')->nullable()->constrained('classes');
            $table->enum('scope', ['class', 'school']);
            $table->enum('period', ['weekly', 'monthly', 'all_time']);
            $table->integer('total_xp');
            $table->integer('rank');
            $table->timestamp('cached_at');
            $table->timestamps();

            $table->index(['scope', 'period']);
            $table->index('class_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaderboard_cache');
    }
};
