<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guilds', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('icon', 10)->default('🛡️');
            $table->foreignId('leader_id')->constrained('users');
            $table->foreignId('class_id')->nullable()->constrained('classes');
            $table->integer('total_guild_xp')->default(0);
            $table->integer('max_members')->default(5);
            $table->timestamps();

            $table->index('class_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guilds');
    }
};
