<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained('assignments');
            $table->foreignId('user_id')->constrained('users');
            $table->string('file_path')->nullable();
            $table->text('answer_text')->nullable();
            $table->timestamp('submitted_at');
            $table->enum('status', ['pending', 'graded', 'revised'])->default('pending');
            $table->timestamps();

            $table->index('assignment_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
