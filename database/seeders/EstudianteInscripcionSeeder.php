<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use App\Models\Turnos;

class EstudianteInscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Obtener el primer turno disponible de tu tabla para poder asociarlo
        $turno = Turnos::first();

        if (!$turno) {
            $this->command->warn("Por favor, asegúrate de tener al menos un Turno sembrado antes de correr este seeder.");
            return;
        }

        // Crear estudiante de prueba 1
        $e1 = Estudiante::create([
            'nombre' => 'Carlos Mendoza',
            'email'  => 'carlos@academia.test',
            'ci'     => '1234567',
            'telef'  => '71234567'
        ]);

        // Crear estudiante de prueba 2
        $e2 = Estudiante::create([
            'nombre' => 'Ana Maria Gutierrez',
            'email'  => 'ana@academia.test',
            'ci'     => '7654321',
            'telef'  => '60712345'
        ]);

        // Inscribir a los estudiantes en el turno obtenido con notas iniciales
        Inscripcion::create([
            'estudiante_id' => $e1->id,
            'id_horario'    => $turno->id,
            'fecha'         => now()->toDateString(),
            'estado'        => 'Activo',
            'nota'          => 75.50 // Aprobado
        ]);

        Inscripcion::create([
            'estudiante_id' => $e2->id,
            'id_horario'    => $turno->id,
            'fecha'         => now()->toDateString(),
            'estado'        => 'Activo',
            'nota'          => null // Por calificar
        ]);

        $this->command->info("Estudiantes e Inscripciones de prueba sembrados con éxito.");
    }
}
