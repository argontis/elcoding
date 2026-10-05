<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CleanUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'clean'],
            [
                'name' => 'Elena Rostova',
                'email' => 'clean@lclean.id',
                'password' => Hash::make('password123'),
                'role' => 'clean',
            ]
        );
    }
}
