<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reading_quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained('materials');
            $table->text('question');
            $table->json('options');
            $table->string('correct_answer');
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('easy');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('material_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reading_quizzes');
    }
};
