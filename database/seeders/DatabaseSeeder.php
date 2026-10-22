<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Curso;
use App\Models\Instructor;
use App\Models\Turnos;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Usuarios
        User::updateOrCreate(
            ['email' => 'admin@academia.test'],
            ['name' => 'Administrador', 'password' => 'password', 'rol' => User::ROL_ADMIN]
        );
        User::updateOrCreate(
            ['email' => 'usuario@academia.test'],
            ['name' => 'Usuario de prueba', 'password' => 'password', 'rol' => User::ROL_USUARIO]
        );
        User::factory(3)->admin()->create();
        User::factory(30)->create();

        // 2. 10 Categorías con 4 cursos cada una (40 cursos en total)
        Categoria::factory(10)
            ->sequence(
                ['name' => 'Tecnología'],
                ['name' => 'Sistemas'],
                ['name' => 'Desarrollo Web'],
                ['name' => 'Bases de Datos'],
                ['name' => 'Redes y Conectividad'],
                ['name' => 'Ciberseguridad'],
                ['name' => 'Inteligencia Artificial'],
                ['name' => 'Soporte Técnico'],
                ['name' => 'Arquitectura de Software'],
                ['name' => 'Computación en la Nube'],
            )
            ->has(Curso::factory()->count(4))
            ->create();

        // 3. Obtenemos los IDs de los 40 cursos que ya existen
        $cursosIds = Curso::pluck('id');

        // 4. Creamos los 10 instructores asignándoles cursos ya existentes
        Instructor::factory(10)
            ->state(function () use ($cursosIds) {
                return [
                    'curso_id' => $cursosIds->random(),
                ];
            })
            ->create();

        // 5. Creamos los 5 turnos asignándoles cursos ya existentes
        Turnos::factory(5)
            ->state(function () use ($cursosIds) {
                return [
                    'curso_id' => $cursosIds->random(),
                ];
            })
            ->create();
    }
}
