<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isPremium = fake()->numberBetween(0, 1);
        $price = $isPremium === 1 ? fake()->randomFloat(2, 1, 5) : null;
        return [
            'title' => fake()->realText(20),
            'content'=> fake()->realText(),
            'premium' => $isPremium,
            'price' => $price
        ];
    }
}
