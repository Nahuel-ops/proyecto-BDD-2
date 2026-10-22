<?php

namespace Database\Factories;

use App\Models\Instructor;
use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Instructor>
 */
class InstructorFactory extends Factory
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
            'curso_id'     => Curso::inRandomOrder()->first()?->id ?? Curso::factory(),
            'nombre'       => $this->faker->firstName(),
            'apellido'     => $this->faker->lastName(),
            'email'        => $this->faker->unique()->safeEmail(),
            'especialidad' => ucfirst($this->faker->words(2, true)),
            'activo'       => $this->faker->boolean(),
        ];
    }
}
