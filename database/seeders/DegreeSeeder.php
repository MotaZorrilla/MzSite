<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('degrees')->truncate();

        $degrees = [
            ['id' => 1, 'name' => 'Aprendiz Masón'],
            ['id' => 2, 'name' => 'Compañero Masón'],
            ['id' => 3, 'name' => 'Maestro Masón'],
            ['id' => 4, 'name' => 'Maestro Secreto'],
            ['id' => 5, 'name' => 'Maestro Perfecto'],
            ['id' => 6, 'name' => 'Secretario Íntimo'],
            ['id' => 7, 'name' => 'Preboste y Juez'],
            ['id' => 8, 'name' => 'Intendente de los Edificios'],
            ['id' => 9, 'name' => 'Maestro Elegido de los Nueve'],
            ['id' => 10, 'name' => 'Maestro Elegido de los Quince'],
            ['id' => 11, 'name' => 'Sublime Caballero Elegido'],
            ['id' => 12, 'name' => 'Gran Maestro Arquitecto'],
            ['id' => 13, 'name' => 'Caballero del Real Arco'],
            ['id' => 14, 'name' => 'Gran Elegido, Perfecto y Sublime Masón'],
            ['id' => 15, 'name' => 'Caballero de Oriente o de la Espada'],
            ['id' => 16, 'name' => 'Príncipe de Jerusalén'],
            ['id' => 17, 'name' => 'Caballero de Oriente y Occidente'],
            ['id' => 18, 'name' => 'Soberano Príncipe Rosacruz'],
            ['id' => 19, 'name' => 'Gran Pontífice'],
            ['id' => 20, 'name' => 'Gran Maestro de todas las Logias Simbólicas'],
            ['id' => 21, 'name' => 'Patriarca Noaquita'],
            ['id' => 22, 'name' => 'Caballero del Real Hacha'],
            ['id' => 23, 'name' => 'Jefe del Tabernáculo'],
            ['id' => 24, 'name' => 'Príncipe del Tabernáculo'],
            ['id' => 25, 'name' => 'Caballero de la Serpiente de Bronce'],
            ['id' => 26, 'name' => 'Príncipe de Merced'],
            ['id' => 27, 'name' => 'Gran Comendador del Templo'],
            ['id' => 28, 'name' => 'Caballero del Sol'],
            ['id' => 29, 'name' => 'Gran Escocés de San Andrés'],
            ['id' => 30, 'name' => 'Caballero Kadosh'],
            ['id' => 31, 'name' => 'Gran Inspector Inquisidor Comendador'],
            ['id' => 32, 'name' => 'Sublime y Valiente Príncipe del Real Secreto'],
            ['id' => 33, 'name' => 'Soberano Gran Inspector General'],
        ];

        DB::table('degrees')->insert($degrees);
    }
}
