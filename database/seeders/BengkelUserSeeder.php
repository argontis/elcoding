<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BengkelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['username' => 'bengkel'],
            [
                'name' => 'L-Garage Workshop',
                'email' => 'bengkel@lgarage.id',
                'password' => Hash::make('bengkel123'),
                'role' => 'bengkel',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info("User Bengkel created/updated successfully with ID: {$user->id}, Role: {$user->role}");
    }
}
