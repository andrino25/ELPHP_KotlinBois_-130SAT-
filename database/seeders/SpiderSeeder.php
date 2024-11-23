<?php

namespace Database\Seeders;

use App\Models\Spider;
use App\Models\User;
use Illuminate\Database\Seeder;

class SpiderSeeder extends Seeder
{
    public function run(): void
    {
        // Sample spider data
        $spiders = [
            [
                'spiderName' => 'Mexican Red Knee',
                'spiderHealthStatus' => 'Healthy',
                'spiderSize' => 'Large',
                'spiderEstimatedMarketValue' => 150.00,
                'spiderDescription' => 'A beautiful specimen with distinctive red and orange coloring on its knees',
                'spiderImageRef' => 'https://i.ibb.co/sample/redknee.jpg',
            ],
            [
                'spiderName' => 'Chilean Rose Tarantula',
                'spiderHealthStatus' => 'Healthy',
                'spiderSize' => 'Medium',
                'spiderEstimatedMarketValue' => 75.00,
                'spiderDescription' => 'Docile species with beautiful pink-hued carapace',
                'spiderImageRef' => 'https://i.ibb.co/sample/chileanrose.jpg',
            ],
            [
                'spiderName' => 'Costa Rican Zebra',
                'spiderHealthStatus' => 'Excellent',
                'spiderSize' => 'Medium',
                'spiderEstimatedMarketValue' => 120.00,
                'spiderDescription' => 'Striking black and white striped pattern',
                'spiderImageRef' => 'https://i.ibb.co/sample/zebra.jpg',
            ],
            [
                'spiderName' => 'Brazilian Black',
                'spiderHealthStatus' => 'Good',
                'spiderSize' => 'Large',
                'spiderEstimatedMarketValue' => 200.00,
                'spiderDescription' => 'Velvet black coloration with gentle temperament',
                'spiderImageRef' => 'https://i.ibb.co/sample/black.jpg',
            ],
            [
                'spiderName' => 'Goliath Birdeater',
                'spiderHealthStatus' => 'Healthy',
                'spiderSize' => 'Extra Large',
                'spiderEstimatedMarketValue' => 300.00,
                'spiderDescription' => 'One of the largest spider species in the world',
                'spiderImageRef' => 'https://i.ibb.co/sample/goliath.jpg',
            ],
        ];

        $users = User::all();

        // Distribute spiders among users
        foreach ($spiders as $index => $spiderData) {
            $user = $users[$index % count($users)];
            
            Spider::create([
                'userId' => $user->id,
                'spiderName' => $spiderData['spiderName'],
                'spiderHealthStatus' => $spiderData['spiderHealthStatus'],
                'spiderSize' => $spiderData['spiderSize'],
                'spiderEstimatedMarketValue' => $spiderData['spiderEstimatedMarketValue'],
                'spiderDescription' => $spiderData['spiderDescription'],
                'spiderImageRef' => $spiderData['spiderImageRef'],
            ]);
        }
    }
}