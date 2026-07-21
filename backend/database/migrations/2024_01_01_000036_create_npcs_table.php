<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('npcs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects');
            $table->string('name');
            $table->string('personality');
            $table->string('avatar_url')->nullable();
            $table->json('dialogs');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('subject_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('npcs');
    }
};
