<?php

namespace Database\Seeders;

use App\Models\Spider;
use App\Models\User;
use Illuminate\Database\Seeder;

class SpiderSeeder extends Seeder
{
    public function run(): void
    {
        // Create some test users first if needed
        $users = User::factory()->count(3)->create();

        // Common spider species names
        $spiderNames = [
            'Mexican Red Knee',
            'Chilean Rose',
            'Costa Rican Zebra',
            'Pink Toe',
            'Goliath Birdeater',
            'Brazilian Black',
            'Cobalt Blue',
            'Indian Ornamental',
            'Green Bottle Blue',
            'Curly Hair',
            'Blue Baboon',
            'Venezuelan Suntiger',
            'Antilles Pinktoe',
            'Brazilian Salmon',
            'Thailand Black'
        ];

        foreach ($spiderNames as $name) {
            Spider::create([
                'userID' => $users->random()->id,
                'spiderName' => $name,
                'spiderSize' => fake()->randomElement(['Small', 'Medium', 'Large']),
                'spiderHealthStatus' => fake()->randomElement(['Healthy', 'Sick', 'Critical']),
                'spiderCostPrice' => fake()->randomFloat(2, 50, 500),
            ]);
        }

        // Add some additional random spiders
        Spider::factory()->count(5)->create([
            'userID' => $users->random()->id,
        ]);
    }
}
