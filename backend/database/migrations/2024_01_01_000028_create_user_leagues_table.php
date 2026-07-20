<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_leagues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('league_id')->constrained('leagues');
            $table->date('week_start');         // monday of the week
            $table->date('week_end');           // sunday of the week
            $table->integer('weekly_xp')->default(0);
            $table->integer('rank')->nullable(); // rank within the league
            $table->string('status', 20)->default('active'); // active, promoted, demoted
            $table->timestamps();

            $table->unique(['user_id', 'week_start']);
            $table->index(['week_start', 'league_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_leagues');
    }
};
