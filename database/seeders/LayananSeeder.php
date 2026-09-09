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
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Layanan::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $services = [
            [
                'title' => 'Jasa Pembuatan Website & Web Application',
                'slug' => 'pembuatan-website-aplikasi-web',
                'icon' => 'fas fa-globe',
                'badge' => 'RECOMMENDED',
                'short_description' => 'Pengembangan website responsif, company profile, toko online (e-commerce), dan sistem informasi bisnis berbasis Laravel & React.',
                'price_label' => 'Mulai Dari',
                'price' => 'Rp 2.500.000',
                'price_amount' => 2500000,
                'price_period' => '/ project',
                'image_path' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80',
                'description' => 'Kami menyediakan jasa pembuatan website profesional yang dirancang khusus untuk meningkatkan kredibilitas dan penjualan bisnis Anda. Menggunakan teknologi modern terkini dengan desain elegan, SEO-friendly, dan akses super cepat.',
                'features_main' => ['Desain Responsive & Modern', 'Optimasi SEO & Kecepatan Tinggi', 'Integrasi Payment Gateway', 'Gratis Domain & Hosting 1 Tahun'],
                'pricing_includes' => ['Free Source Code', 'Gratis Revisi Desain', 'Garansi & Support 6 Bulan', 'Panduan Penggunaan Admin Panel'],
                'features_full' => ['Desain Kustom Eksklusif (Non-Template)', 'Content Management System (CMS) Mudah Digunakan', 'Integrasi WhatsApp & Live Chat Widget', 'Keamanan SSL Certificate Terpasang', 'Analitik Pengunjung (Google Analytics)'],
                'whatsapp_message' => 'Halo Elcoding, saya ingin berkonsultasi mengenai Jasa Pembuatan Website & Web Application.',
            ],
            [
                'title' => 'Pengembangan Aplikasi Mobile (Android & iOS)',
                'slug' => 'pengembangan-aplikasi-mobile',
                'icon' => 'fas fa-mobile-alt',
                'badge' => 'TERLARIS',
                'short_description' => 'Aplikasi mobile cross-platform performa tinggi menggunakan Flutter & React Native dengan desain UI/UX interaktif.',
                'price_label' => 'Mulai Dari',
                'price' => 'Rp 4.500.000',
                'price_amount' => 4500000,
                'price_period' => '/ project',
                'image_path' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=800&q=80',
                'description' => 'Wujudkan ide aplikasi mobile impian Anda untuk Android dan iOS dalam satu codebase efisien. Dilengkapi backend API terstruktur, push notification, serta performa native yang mulus.',
                'features_main' => ['Support Android & iOS', 'UI/UX Interactive & Smooth', 'Push Notification Realtime', 'Integrasi API & Cloud DB'],
                'pricing_includes' => ['Bantuan Publish ke Google PlayStore & AppStore', 'Dokumentasi REST API Complete', 'Free Maintenance 3 Bulan'],
                'features_full' => ['Multi-language Support', 'Fitur Lokasi / GPS Mapping', 'Sistem Keamanan Auth JWT & Biometric Login', 'Optimasi Ukuran App & Baterai'],
                'whatsapp_message' => 'Halo Elcoding, saya berminat membuat Aplikasi Mobile untuk bisnis saya.',
            ],
            [
                'title' => 'Jasa UI/UX Design & Prototyping',
                'slug' => 'jasa-ui-ux-design-prototyping',
                'icon' => 'fas fa-paint-brush',
                'badge' => 'PROMO',
                'short_description' => 'Perancangan antarmuka pengguna (UI) dan pengalaman pengguna (UX) berbasis penelitian pengguna dan Design System scalable.',
                'price_label' => 'Mulai Dari',
                'price' => 'Rp 1.200.000',
                'price_amount' => 1200000,
                'price_period' => '/ project',
                'image_path' => 'https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?auto=format&fit=crop&w=800&q=80',
                'description' => 'Layanan pembuatan kraf wireframe, prototype interaktif Figma, serta Design System standar industri untuk mempermudah proses koding tim developer Anda.',
                'features_main' => ['Figma Source File (.fig)', 'Design System & Component Library', 'Clickable Interactive Prototype', 'User Research & Wireframing'],
                'pricing_includes' => ['Export Aset SVG/PNG/JPG', 'Design Handoff ke Developer', 'Revisi Sesuai Feedback'],
                'features_full' => ['UX Audit & Usability Testing', 'Responsive Layouts (Desktop & Mobile)', 'Iconography & Design Palette Custom'],
                'whatsapp_message' => 'Halo Elcoding, saya butuh layanan Jasa UI/UX Design untuk aplikasi saya.',
            ],
            [
                'title' => 'Private Corporate IT Training',
                'slug' => 'private-corporate-it-training',
                'icon' => 'fas fa-users-cog',
                'badge' => 'SPECIAL',
                'short_description' => 'Pelatihan teknologi dan pemrograman khusus perusahaan & instansi dengan kurikulum kustom disesuaikan kebutuhan industri Anda.',
                'price_label' => 'Mulai Dari',
                'price' => 'Rp 3.500.000',
                'price_amount' => 3500000,
                'price_period' => '/ batch',
                'image_path' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80',
                'description' => 'Tingkatkan kompetensi digital tim internal perusahaan Anda dalam topik Fullstack Web Development, DevOps, Cloud Infrastructure, atau AI/Data Science bersama instruktur praktisi berpengalaman.',
                'features_main' => ['Kurikulum Custom Sesuai Project Tim', 'Instruktur Expert Praktisi Industri', 'Modul & Sertifikat Pelatihan', 'Konsultasi Studi Kasus Real'],
                'pricing_includes' => ['Materi Presentasi & Source Code', 'Sertifikat Kelulusan Peserta', 'Evaluasi Hasil Pembelajaran'],
                'features_full' => ['Pilihan Metode Onsite atau Online Live Class', 'Recording Sesi Pelatihan Harian', 'Group Support Telegram / Slack Dedikasi'],
                'whatsapp_message' => 'Halo Elcoding, kami ingin mengadakan Corporate IT Training untuk perusahaan kami.',
            ],
            [
                'title' => 'Cloud Server, DevOps & Maintenance',
                'slug' => 'cloud-devops-maintenance-server',
                'icon' => 'fas fa-server',
                'badge' => 'POPULER',
                'short_description' => 'Konfigurasi cloud server (AWS, GCP, VPS), automasi CI/CD pipeline, monitoring keamanan, dan perawatan server berkala.',
                'price_label' => 'Mulai Dari',
                'price' => 'Rp 990.000',
                'price_amount' => 990000,
                'price_period' => '/ bulan',
                'image_path' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80',
                'description' => 'Jaga kestabilan dan keamanan aplikasi bisnis Anda tanpa perlu khawatir server down. Layanan DevOps dan managed server profesional untuk skalabilitas bisnis tinggi.',
                'features_main' => ['Setup Cloud VPS / Server AWS GCP', 'Automasi Deployment CI/CD', 'Backup Database Otomatis Harian', 'Monitoring Server 24/7 Uptime'],
                'pricing_includes' => ['Firewall & Hardening Security', 'SSL Certificate Management', 'Laporan Performa Bulanan'],
                'features_full' => ['Docker & Kubernetes Containerization', 'Load Balancer Configuration', 'Penanganan Insiden Darurat (SLA Fast Response)'],
                'whatsapp_message' => 'Halo Elcoding, saya butuh layanan Cloud Server & DevOps Maintenance.',
            ],
            [
                'title' => 'Audit Keamanan Website & PenTest',
                'slug' => 'audit-keamanan-website-penetration-testing',
                'icon' => 'fas fa-shield-alt',
                'badge' => 'BARU',
                'short_description' => 'Pengujian penetrasi (Penetration Testing) dan analisis celah keamanan website serta server aplikasi dari potensi peretasan.',
                'price_label' => 'Mulai Dari',
                'price' => 'Rp 1.950.000',
                'price_amount' => 1950000,
                'price_period' => '/ audit',
                'image_path' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=800&q=80',
                'description' => 'Lindungi data sensitif pelanggan dan reputasi bisnis Anda dari ancaman cyber crime, SQL injection, XSS, dan kebocoran data dengan pengujian keamanan standar OWASP.',
                'features_main' => ['Vulnerability Assessment OWASP Top 10', 'Penetration Testing Blackbox & Graybox', 'Laporan Rekomendasi Perbaikan', 'Re-Testing Setelah Fix Celah'],
                'pricing_includes' => ['Dokumen Executive Summary Audit', 'Panduan Remediasi Teknis', 'Sertifikat Audit Keamanan'],
                'features_full' => ['Pemeriksaan Security Header & Network Port', 'Analisis Kerentanan API Endpoint', 'Konsultasi Tim Security Specialist'],
                'whatsapp_message' => 'Halo Elcoding, saya ingin berkonsultasi untuk Audit Keamanan Website / PenTest.',
            ],
        ];

        foreach ($services as $service) {
            Layanan::create($service);
        }
    }
}
