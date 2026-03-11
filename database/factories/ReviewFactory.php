<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'location' => fake()->country(),
            'rating' => fake()->numberBetween(3, 5), // generate positive reviews mostly
            'review' => fake()->realText(200),
            'is_active' => fake()->boolean(90), // 90% chance of being active to show on frontend
        ];
    }
}
