<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RestoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun Tunggal RestoHub OS (Store Manager)
        User::updateOrCreate(
            ['username' => 'resto'],
            [
                'name' => 'Budi Pratama',
                'email' => 'resto@restohub.id',
                'password' => Hash::make('resto123'),
                'role' => 'resto',
                'email_verified_at' => now(),
            ]
        );

        if (isset($this->command)) {
            $this->command->info("RestoHub User created: resto / resto123 (Role: resto)");
        }
    }
}
