<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(HighScoreSeeder::class);
        $this->call(DegreeSeeder::class);

        // Crear un usuario administrador por defecto
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'administrador',
                'degree_id' => 33, // Soberano Gran Inspector General
            ]
        );
    }
}
