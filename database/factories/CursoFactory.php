<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\curso;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<curso>
 */
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'categoria_id'  => Categoria::factory(),
            'name'          => 'Curso de ' . $this->faker->randomElement(['Programacion 1',
            'Programcion 2', 'Sistemas Digitales','Sistemas Operativos']),
            'descripcion'   => $this->faker->paragraph(),
            'imagen'        =>'img/curso-default.png'
        ];
    }
}
