<?php

namespace Database\Factories;

use App\Models\BookImage;
use App\Models\BookVideo;
use App\Models\Category;
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
            'description' => fake()->paragraph(),
            'long_description' => fake()->paragraphs(5),
            'price' => fake()->numerify("##.##"),
            'age_range' => fake()->text(),
            'page_count' => fake()->randomNumber(100),
            'materials' => fake()->text(),
            'dimensions' => fake()->text(),
            'manufacturing_time' => fake()->text(),
            'categories' => Category::factory(),
            'images' => BookImage::factory(),
            'videos' => BookVideo::factory(),
        ];
    }
}
