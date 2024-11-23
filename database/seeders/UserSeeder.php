<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'userFirstName' => 'John',
                'userMiddleName' => 'Michael',
                'userLastName' => 'Doe',
                'userAddress' => '123 Main St, City',
                'userProfilePicRef' => 'https://i.pravatar.cc/150?img=1',
            ],
            [
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'userFirstName' => 'Jane',
                'userMiddleName' => 'Marie',
                'userLastName' => 'Smith',
                'userAddress' => '456 Oak Ave, Town',
                'userProfilePicRef' => 'https://i.pravatar.cc/150?img=2',
            ],
            [
                'email' => 'bob@example.com',
                'password' => Hash::make('password123'),
                'userFirstName' => 'Bob',
                'userMiddleName' => 'James',
                'userLastName' => 'Wilson',
                'userAddress' => '789 Pine Rd, Village',
                'userProfilePicRef' => 'https://i.pravatar.cc/150?img=3',
            ],
            [
                'email' => 'alice@example.com',
                'password' => Hash::make('password123'),
                'userFirstName' => 'Alice',
                'userMiddleName' => 'Grace',
                'userLastName' => 'Brown',
                'userAddress' => '321 Elm St, County',
                'userProfilePicRef' => 'https://i.pravatar.cc/150?img=4',
            ],
            [
                'email' => 'charlie@example.com',
                'password' => Hash::make('password123'),
                'userFirstName' => 'Charlie',
                'userMiddleName' => 'Thomas',
                'userLastName' => 'Davis',
                'userAddress' => '654 Maple Dr, State',
                'userProfilePicRef' => 'https://i.pravatar.cc/150?img=5',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}