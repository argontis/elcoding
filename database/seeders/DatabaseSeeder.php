<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['username' => 'adminelcoding'],
            [
                'name' => 'Administrator',
                'email' => 'elcoding.id@gmail.com',
                'password' => bcrypt('2026Sukses*'),
                'role' => 'admin',
            ]
        );


        $this->call([
            AdminSeeder::class,
            SettingsSeeder::class,
            LayananSeeder::class,
            PklSeeder::class,
            CleanUserSeeder::class,
            BimbelUserSeeder::class,
        ]);
    }
}
