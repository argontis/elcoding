<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BarbershopUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun Utama Barbershop / L-Style Atelier Suite
        User::updateOrCreate(
            ['email' => 'admin@lstyle.id'],
            [
                'username' => 'barbershop',
                'name' => 'Mario Rossi (Atelier Barber)',
                'password' => Hash::make('barbershop123'),
                'role' => 'barbershop',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'mario@lstyle.id'],
            [
                'username' => 'atelier',
                'name' => 'L-Style Atelier Suite',
                'password' => Hash::make('barbershop123'),
                'role' => 'barbershop',
                'email_verified_at' => now(),
            ]
        );

        // Akun Langganan / Member VIP Atelier Gilt
        User::updateOrCreate(
            ['email' => 'raditya@lstyle.id'],
            [
                'username' => 'raditya',
                'name' => 'Raditya Pratama',
                'password' => Hash::make('raditya123'),
                'role' => 'barbershop_member',
                'nomor_kartu' => 'VIP-016',
                'kota' => 'Jakarta Selatan',
                'email_verified_at' => now(),
            ]
        );
    }
}
