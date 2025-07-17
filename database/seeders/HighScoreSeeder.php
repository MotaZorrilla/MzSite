<?php

namespace Database\Seeders;

use App\Models\HighScore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HighScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HighScore::create(['name' => 'Mota Zorrilla', 'score' => 5000, 'type' => 'top']);
        HighScore::create(['name' => 'Mota Zorrilla', 'score' => 500, 'type' => 'top']);
        HighScore::create(['name' => 'Mota Zorrilla', 'score' => 50, 'type' => 'top']);
        HighScore::create(['name' => 'Mz', 'score' => 40, 'type' => 'recent']);
        HighScore::create(['name' => 'MZ', 'score' => 20, 'type' => 'recent']);
    }
}
