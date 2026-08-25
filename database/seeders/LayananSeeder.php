<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Pembuatan Website & Landing Page',
                'icon' => 'fas fa-laptop-code',
                'badge' => 'Populer',
                'short_description' => 'Tingkatkan presensi online bisnis Anda dengan website profesional, responsif, dan SEO-friendly.',
                'price_label' => 'Mulai dari',
                'price' => 'Rp 1.500.000',
                'price_amount' => 1500000,
                'price_period' => '/ projek',
                'image_path' => 'gambar/aset/hero-bg.jpg', // Placeholder
                'description' => '<p>Kami menawarkan layanan pembuatan website mulai dari company profile, e-commerce, hingga landing page untuk kebutuhan marketing. Website yang kami buat dioptimalkan untuk kecepatan dan konversi.</p>',
                'features_main' => ['Desain Responsif', 'SEO Basic', 'Domain & Hosting 1 Tahun', 'Revisi Minor'],
                'pricing_includes' => ['Gratis SSL', 'Support 1 Bulan', 'Akses Cpanel/Admin'],
                'features_full' => [
                    ['name' => 'Custom Design', 'included' => true],
                    ['name' => 'SEO Optimization', 'included' => true],
                    ['name' => 'Mobile Friendly', 'included' => true],
                    ['name' => 'Premium Plugins', 'included' => false]
                ],
                'whatsapp_message' => 'Halo Admin Elcoding, saya tertarik dengan Layanan Pembuatan Website.',
            ],
            [
                'title' => 'UI/UX Design App & Web',
                'icon' => 'fas fa-pen-nib',
                'badge' => 'Rekomendasi',
                'short_description' => 'Desain antarmuka pengguna yang estetis dan pengalaman pengguna yang intuitif untuk produk digital Anda.',
                'price_label' => 'Mulai dari',
                'price' => 'Rp 2.000.000',
                'price_amount' => 2000000,
                'price_period' => '/ projek',
                'image_path' => 'gambar/aset/hero-title-banner.png', // Placeholder
                'description' => '<p>Maksimalkan kepuasan pelanggan Anda dengan UI/UX design yang berpusat pada pengguna. Kami melakukan riset, wireframing, dan prototyping dengan Figma sebelum tahap development.</p>',
                'features_main' => ['User Research', 'Wireframing', 'Prototyping Figma', 'Design System'],
                'pricing_includes' => ['File Figma/Source', '2x Revisi Mayor', 'Asset Export'],
                'features_full' => [
                    ['name' => 'Interactive Prototype', 'included' => true],
                    ['name' => 'Design System', 'included' => true],
                    ['name' => 'Usability Testing', 'included' => false]
                ],
                'whatsapp_message' => 'Halo Admin Elcoding, saya butuh jasa UI/UX Design.',
            ],
            [
                'title' => 'Konsultasi IT & Sistem',
                'icon' => 'fas fa-server',
                'badge' => null,
                'short_description' => 'Solusi teknologi terbaik untuk mengoptimalkan operasional dan skalabilitas bisnis Anda.',
                'price_label' => 'Mulai dari',
                'price' => 'Rp 500.000',
                'price_amount' => 500000,
                'price_period' => '/ sesi',
                'image_path' => 'gambar/aset/logo-elcoding.png', // Placeholder
                'description' => '<p>Bingung memilih teknologi atau arsitektur sistem yang tepat? Tim ahli kami siap memberikan konsultasi teknis dari tahap perancangan arsitektur, pemilihan stack teknologi, hingga strategi deployment server.</p>',
                'features_main' => ['Analisa Sistem', 'Rekomendasi Tech Stack', 'Audit Keamanan', 'Optimasi Database'],
                'pricing_includes' => ['Laporan Audit', 'Sesi Konsultasi Online', 'Dokumentasi Teknis'],
                'features_full' => [
                    ['name' => 'System Audit', 'included' => true],
                    ['name' => 'Security Check', 'included' => true],
                    ['name' => 'Implementation', 'included' => false]
                ],
                'whatsapp_message' => 'Halo Admin Elcoding, saya ingin berkonsultasi mengenai IT & Sistem.',
            ]
        ];

        foreach ($services as $service) {
            $service['slug'] = Str::slug($service['title']);
            Layanan::create($service);
        }
    }
}
