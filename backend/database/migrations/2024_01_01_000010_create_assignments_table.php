<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects');
            $table->foreignId('user_id')->constrained('users');
            $table->string('title');
            $table->text('description');
            $table->decimal('max_score', 5, 2)->default(100);
            $table->integer('xp_reward')->default(50);
            $table->timestamp('deadline');
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->index('subject_id');
            $table->index('user_id');
            $table->index('deadline');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
