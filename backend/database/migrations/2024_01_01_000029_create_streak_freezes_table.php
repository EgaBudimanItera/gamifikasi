<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('streak_freezes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->date('freeze_date');         // the date being protected
            $table->date('used_at_date');        // when the freeze was used
            $table->timestamps();

            $table->unique(['user_id', 'freeze_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('streak_freezes');
    }
};
