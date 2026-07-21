<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE xp_logs MODIFY COLUMN type ENUM('assignment','login','streak','quest','penalty','reading','reading_quiz','npc_quest','quick_quiz') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE xp_logs MODIFY COLUMN type ENUM('assignment','login','streak','quest','penalty') NOT NULL");
    }
};
