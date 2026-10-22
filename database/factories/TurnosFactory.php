<?php

namespace Database\Factories;

use App\Models\Curso;
use App\Models\Turnos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Turnos>
 */
class TurnosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Toma un curso existente al azar; si no hay ninguno en la BD, recién crea uno con el factory
            'curso_id' => Curso::inRandomOrder()->first()?->id ?? Curso::factory(),
            'turno'    => $this->faker->randomElement(['Mañana', 'Tarde', 'Noche']),
            'hora'     => $this->faker->time('H:i'),
            'fecha'    => $this->faker->date(),
        ];
    }
}
