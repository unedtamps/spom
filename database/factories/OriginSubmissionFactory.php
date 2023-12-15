<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OriginSubmision>
 */
class OriginSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->realText(10),
            'about' => fake()->realText(400),
            'origin_story' => fake()->realText(800),
            'spread' => fake()->realText(800),
            'user_id' => rand(1,10),
            'origin_id' => rand(1,10)
        ];
    }
}
