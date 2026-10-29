<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TravelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'travel'],
            [
                'name' => 'Administrator L-Travel',
                'email' => 'travel@elcoding.com',
                'password' => Hash::make('password123'),
                'role' => 'travel',
            ]
        );
    }
}

