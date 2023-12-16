<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contributor>
 */
class ContributorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = rand(1,10);
        $orign_id = rand(1,10);
        return [
            'user_id' => $user_id,
            'origin_id' => $orign_id,
        ];
    }
}
