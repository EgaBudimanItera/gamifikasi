<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);        // e.g. 'Bronze', 'Silver', 'Gold'
            $table->string('tier', 20);         // e.g. 'bronze', 'silver', 'gold'
            $table->integer('order');            // 1=lowest, 10=highest
            $table->string('icon', 10);         // emoji
            $table->string('color', 50);        // tailwind gradient class
            $table->integer('min_xp')->default(0);
            $table->integer('max_xp')->default(0);
            $table->integer('promote_count')->default(5);  // top N promote
            $table->integer('demote_count')->default(3);   // bottom N demote
            $table->timestamps();

            $table->unique('tier');
            $table->unique('order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leagues');
    }
};
