<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberKartuSeeder extends Seeder
{
    /**
     * Seed test members that login via nomor kartu.
     */
    public function run(): void
    {
        $members = [
            [
                'nama' => 'Zanevi Nur Wulandari',
                'nomor_kartu' => '0002215562',
                'alamat' => 'Bekasi',
            ],
            [
                'nama' => 'Arief Rachman Hakim',
                'nomor_kartu' => '0002215563',
                'alamat' => 'Jakarta',
            ],
            [
                'nama' => 'Putri Maharani Sari',
                'nomor_kartu' => '0002215564',
                'alamat' => 'Bandung',
            ],
        ];

        foreach ($members as $member) {
            Member::updateOrCreate(
                ['nomor_kartu' => $member['nomor_kartu']],
                $member
            );
        }
    }
}
