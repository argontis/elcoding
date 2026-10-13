<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CrmLeadUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User Utama AI CRM & Lead Management (Nusantara Enterprise CRM)
        User::updateOrCreate(
            ['username' => 'crmlead'],
            [
                'name' => 'Dimas Pratama',
                'email' => 'crmlead@elcoding.id',
                'password' => Hash::make('password123'),
                'role' => 'crmlead',
                'email_verified_at' => now(),
            ]
        );

        if (isset($this->command)) {
            $this->command->info("CRM & Lead User created: crmlead / password123 (Role: crmlead)");
        }
    }
}
