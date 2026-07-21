<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reading_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('material_id')->constrained('materials');
            $table->timestamp('started_at');
            $table->unsignedInteger('duration_seconds')->default(0);
            $table->unsignedTinyInteger('scroll_depth')->default(0);
            $table->boolean('is_completed')->default(false);
            $table->unsignedInteger('xp_earned')->default(0);
            $table->boolean('is_anomaly')->default(false);
            $table->text('anomaly_reason')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'material_id']);
            $table->index('started_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reading_logs');
    }
};
