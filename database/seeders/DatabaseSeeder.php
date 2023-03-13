<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use App\Models\Curso;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Agrego los modelos ya creados para generar Data Aleatoria

        // Crea 15 estudiantes
        Estudiante::factory()->times(15)->create();

        // Crea 8 cursos y se le asigan 3 cursos aleatoriamente a cada estudiante
        Curso::factory()->times(8)->create()->each(
            function($curso) {
                $curso->estudiantes()->sync(
                    Estudiante::all()->random(3)
                );
        });


        // This is a example
        // \App\Models\User::factory(10)->create();
    }
}
