<?php

namespace Database\Seeders;

use App\Models\SeminarCategory;
use App\Models\SeminarPromo;
use Illuminate\Database\Seeder;

class SeminarSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Seminar Karir IT & AI',
                'slug' => 'seminar-karir-it-ai',
                'description' => 'Seminar pengenalan karir teknologi, AI tools, dan peluang industri digital.',
                'location' => 'Online / Zoom',
                'badge_color' => 'blue',
                'is_active' => true,
            ],
            [
                'name' => 'Workshop Web & Aplikasi UMKM',
                'slug' => 'workshop-web-aplikasi-umkm',
                'description' => 'Pelatihan digitalisasi bisnis dan pembuatan website untuk pelaku UMKM.',
                'location' => 'Elcoding Center / Hybrid',
                'badge_color' => 'emerald',
                'is_active' => true,
            ],
            [
                'name' => 'Tech Talk Cybersecurity & Cloud',
                'slug' => 'tech-talk-cybersecurity-cloud',
                'description' => 'Seminar keamanan siber dan infrastruktur cloud modern untuk mahasiswa dan profesional.',
                'location' => 'Auditorium / Live',
                'badge_color' => 'purple',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $cat) {
            SeminarCategory::firstOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }

        $firstCategory = SeminarCategory::where('slug', 'seminar-karir-it-ai')->first();

        SeminarPromo::firstOrCreate(
            ['title' => 'Diskon 50% Program Bootcamp & Kursus Elcoding'],
            [
                'type' => 'discount',
                'badge_text' => 'DISKON 50%',
                'promo_code' => 'SEMINAR50',
                'description' => 'Benefit khusus peserta seminar untuk mengikuti kelas bootcamp coding, web development, atau data dengan potongan biaya hingga 50%.',
                'benefits' => [
                    'Potongan biaya pendaftaran hingga 50%',
                    'Gratis konsultasi kurikulum 1-on-1 dengan mentor',
                    'Akses materi rekaman & komunitas alumni',
                ],
                'seminar_category_id' => null,
                'is_global' => true,
                'cta_label' => 'Saya Tertarik Promo Ini',
                'is_active' => true,
            ]
        );

        SeminarPromo::firstOrCreate(
            ['title' => 'Free Konsultasi Pembuatan Website & Sistem Bisnis'],
            [
                'type' => 'benefit',
                'badge_text' => 'FREE BENEFIT',
                'promo_code' => 'FREEKONSUL',
                'description' => 'Dapatkan sesi konsultasi gratis bersama tim engineer Elcoding plus voucher pembuatan website / aplikasi bisnis.',
                'benefits' => [
                    'Sesi konsultasi arsitektur & kebutuhan gratis 45 menit',
                    'Voucher potongan jasa pembuatan website/sistem Rp 500.000',
                    'Prioritas dukungan teknis tim Elcoding',
                ],
                'seminar_category_id' => $firstCategory?->id,
                'is_global' => false,
                'cta_label' => 'Klaim Benefit Gratis',
                'is_active' => true,
            ]
        );
    }
}
