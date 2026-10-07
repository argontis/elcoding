<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BimbelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User Utama EduPulse Bimbel
        $user1 = User::updateOrCreate(
            ['username' => 'edupulse'],
            [
                'name' => 'Sarah Maharani, M.Pd',
                'email' => 'sarah@edupulse.id',
                'password' => Hash::make('edupulse123'),
                'role' => 'bimbel',
                'email_verified_at' => now(),
            ]
        );

        // Alias user 'bimbel' agar fleksibel
        $user2 = User::updateOrCreate(
            ['username' => 'bimbel'],
            [
                'name' => 'Sarah Maharani, M.Pd',
                'email' => 'bimbel@edupulse.id',
                'password' => Hash::make('bimbel123'),
                'role' => 'bimbel',
                'email_verified_at' => now(),
            ]
        );

        if (isset($this->command)) {
            $this->command->info("EduPulse Bimbel Users created: edupulse / edupulse123 dan bimbel / bimbel123");
        }
    }
}