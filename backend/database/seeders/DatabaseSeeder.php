<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MasterDataSeeder::class,
            UserSeeder::class,
            ClassSeeder::class,
            LearningSeeder::class,
            GamificationSeeder::class,
            ReadingQuizSeeder::class,
            NpcSeeder::class,
            NpcQuestSeeder::class,
            QuickQuizSeeder::class,
        ]);
    }
}
