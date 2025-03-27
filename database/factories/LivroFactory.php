<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LivroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "titulo" => fake()->word(),
            "descricao" => fake()->sentences(1, true),
            "descricaoLonga" => fake()->paragraphs(3, true),
            "genero" => fake()->word(),
        ];
    }
}
