<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TechfixUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User Utama TechFix Pro
        User::updateOrCreate(
            ['username' => 'techfix'],
            [
                'name' => 'TechFix Service Center',
                'email' => 'admin@techfixpro.id',
                'password' => Hash::make('techfix123'),
                'role' => 'techfix',
                'email_verified_at' => now(),
            ]
        );

        // Alias user 'techfixpro'
        User::updateOrCreate(
            ['username' => 'techfixpro'],
            [
                'name' => 'TechFix Pro Administrator',
                'email' => 'techfix@techfixpro.id',
                'password' => Hash::make('techfix123'),
                'role' => 'techfix',
                'email_verified_at' => now(),
            ]
        );

        if (isset($this->command)) {
            $this->command->info("TechFix Pro Users created: techfix / techfix123 & techfixpro / techfix123");
        }
    }
}
