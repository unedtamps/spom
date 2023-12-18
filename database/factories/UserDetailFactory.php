<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->unique()->numberBetween(1,2),
            'meme_posted' => rand(1,100),
            'origin_created' => rand(1,100),
            'origin_accepted' =>rand(1,10),
            'origin_denied' => rand(1,100),
            'meme_likes' => rand(1,1000),
        ];
    }
}