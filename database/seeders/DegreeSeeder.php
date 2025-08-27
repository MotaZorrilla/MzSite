<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Degree;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Degree::create(['name' => 'Aprendiz']);
        Degree::create(['name' => 'Compañero']);
        Degree::create(['name' => 'Maestro']);
    }
}