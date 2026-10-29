<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProsalUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'prosal'],
            [
                'name' => 'Administrator L-Prosal',
                'email' => 'prosal@elcoding.com',
                'password' => Hash::make('password123'),
                'role' => 'prosal',
            ]
        );
    }
}

