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
        User::create([
            'name' => 'Administrator',
            'username' => 'adminelcoding',
            'email' => 'admin@elcoding.id',
            'password' => bcrypt('elcoding_#2026'),
        ]);

        $this->call([
            AdminSeeder::class,
        ]);
    }
}
