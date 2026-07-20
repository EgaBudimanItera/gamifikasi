<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('class_subject', function (Blueprint $table) {
            $table->enum('semester', ['ganjil', 'genap'])->default('ganjil');
        });

        Schema::table('materials', function (Blueprint $table) {
            $table->enum('semester', ['ganjil', 'genap'])->default('ganjil');
        });

        Schema::table('assignments', function (Blueprint $table) {
            $table->enum('semester', ['ganjil', 'genap'])->default('ganjil');
        });
    }

    public function down(): void
    {
        Schema::table('class_subject', function (Blueprint $table) {
            $table->dropColumn('semester');
        });

        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn('semester');
        });

        Schema::table('assignments', function (Blueprint $table) {
            $table->dropColumn('semester');
        });
    }
};
