<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meme>
 */
class MemeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realText(50),
            'pics' => fake()->url(),
            'user_id' => rand(1,10),
            'likes' => rand(1,10000),
            'dislikes' => rand(1,10000),
        ];
    }
}
