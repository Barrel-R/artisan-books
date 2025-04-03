<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->text(100),
            'long_description' => fake()->paragraphs(3, true),
            'gender' => fake()->text(50),
            'price' => fake()->numerify("##.##"),
            'age_range' => fake()->text(),
            'page_count' => fake()->randomNumber(2),
            'materials' => fake()->text(),
            'dimensions' => fake()->text(),
            'manufacturing_time' => fake()->text(),
        ];
    }
}
