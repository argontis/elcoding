<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class MemberKartuSeeder extends Seeder
{
    /**
     * Seed test users that login via nomor kartu (no email/password).
     */
    public function run(): void
    {
        $members = [
            [
                'name' => 'Zanevi Nur Wulandari',
                'nomor_kartu' => '0002215562',
                'kota' => 'Bekasi',
            ],
            [
                'name' => 'Arief Rachman Hakim',
                'nomor_kartu' => '0002215563',
                'kota' => 'Jakarta',
            ],
            [
                'name' => 'Putri Maharani Sari',
                'nomor_kartu' => '0002215564',
                'kota' => 'Bandung',
            ],
        ];

        foreach ($members as $member) {
            User::updateOrCreate(
                ['nomor_kartu' => $member['nomor_kartu']],
                $member
            );
        }
    }
}
