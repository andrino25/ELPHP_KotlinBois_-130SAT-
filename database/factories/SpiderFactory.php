<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spider>
 */
class SpiderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'userID' => \App\Models\User::factory(),
            'spiderName' => $this->faker->unique()->name,
            'spiderSize' => $this->faker->randomElement(['Small', 'Medium', 'Large']),
            'spiderHealthStatus' => $this->faker->randomElement(['Healthy', 'Sick', 'Critical']),
            'spiderCostPrice' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
