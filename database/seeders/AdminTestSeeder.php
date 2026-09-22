<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admintest'],
            [
                'name' => 'Admin Tester',
                'email' => 'admintest@elcoding.id',
                'role' => 'admin',
                'password' => Hash::make('password123'),
            ]
        );
    }
}
