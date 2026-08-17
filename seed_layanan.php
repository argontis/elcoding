<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Layanan;

$layanan = Layanan::create([
    'title' => 'Website Sekolah',
    'slug' => 'website-sekolah',
    'icon' => 'fas fa-globe',
    'badge' => 'Website',
    'short_description' => 'Pembuatan website sekolah instan untuk TK, SD, SMP, SMA, SMK, SLB, Madrasah, Ponpes, Yayasan dan Lembaga Pendidikan lainnya. Website modern, responsif, dan mudah dikelola.',
    'price_label' => 'Mulai dari',
    'price' => 'Rp 375.000',
    'price_period' => '/ tahun',
    'image_path' => '',
    'description' => '<p>Di era digital saat ini, memiliki website resmi sekolah sangatlah penting untuk menunjang akreditasi, transparansi informasi, dan media komunikasi yang efektif antara pihak sekolah, siswa, dan masyarakat.</p><p>Elcoding hadir memberikan solusi pembuatan website sekolah instan yang siap pakai, sudah termasuk gratis pendaftaran domain resmi <strong>.sch.id</strong>, hosting yang cepat dan stabil, serta kontrol panel yang mudah digunakan oleh tenaga pendidik atau tata usaha sekolah tanpa perlu keahlian pemrograman (coding) sama sekali.</p>',
    'features_main' => [
        ['icon' => 'fas fa-check-circle', 'title' => 'Desain Modern & Responsif', 'desc' => 'Tampilan elegan, profesional, dan menyesuaikan otomatis dengan layar perangkat pengunjung (HP, Tablet, maupun PC).'],
        ['icon' => 'fas fa-check-circle', 'title' => 'Terintegrasi Fitur Akademik', 'desc' => 'Dilengkapi dengan fitur standar sekolah seperti Berita, Pengumuman, Agenda, Galeri Kegiatan, dan Profil Sekolah.'],
        ['icon' => 'fas fa-check-circle', 'title' => 'Panel Admin Mudah Digunakan', 'desc' => 'Dashboard berbahasa Indonesia yang intuitif, dirancang agar mudah digunakan untuk menambah atau mengedit artikel secara mandiri.'],
        ['icon' => 'fas fa-check-circle', 'title' => 'Gratis Domain .sch.id & Hosting', 'desc' => 'Terima beres! Paket sudah mencakup biaya pendaftaran nama domain .sch.id dan sewa hosting untuk 1 tahun pertama.']
    ],
    'pricing_includes' => [
        'Website Instan Siap Pakai',
        'Gratis Domain .sch.id (1 thn)',
        'Gratis Hosting & SSL (1 thn)',
        'Fitur Lengkap Informasi Sekolah',
        'Video Panduan & Support Teknis'
    ],
    'features_full' => [
        ['icon' => 'fas fa-bolt', 'color_class' => 'icon-blue', 'title' => 'Proses Instan 60 Menit', 'desc' => 'Website sekolah aktif dan online hanya dalam 60 menit setelah pembayaran dikonfirmasi.'],
        ['icon' => 'fas fa-globe', 'color_class' => 'icon-cyan', 'title' => 'Domain .sch.id', 'desc' => 'Dapatkan domain resmi .sch.id yang menunjukkan identitas profesional sekolah Anda.'],
        ['icon' => 'fas fa-columns', 'color_class' => 'icon-purple', 'title' => 'Kontrol Panel Website', 'desc' => 'Kelola konten, halaman, dan menu website secara mandiri tanpa keahlian coding.'],
        ['icon' => 'fas fa-database', 'color_class' => 'icon-blue', 'title' => 'Kontrol Panel Hosting', 'desc' => 'Akses penuh ke cPanel untuk mengelola file, database, dan email sekolah.'],
        ['icon' => 'fas fa-shield-alt', 'color_class' => 'icon-green', 'title' => 'Gratis HTTPS / SSL', 'desc' => 'Sertifikat SSL otomatis aktif untuk keamanan data dan kepercayaan pengunjung.'],
        ['icon' => 'fas fa-cloud-upload-alt', 'color_class' => 'icon-cyan', 'title' => 'Backup Harian', 'desc' => 'Data website di-backup setiap hari sehingga aman dari kehilangan atau kerusakan.'],
        ['icon' => 'far fa-building', 'color_class' => 'icon-blue', 'title' => 'Dikelola Sekolah Sendiri', 'desc' => 'Admin sekolah bisa memperbarui berita, agenda, dan konten tanpa bantuan pihak lain.'],
        ['icon' => 'fas fa-user-shield', 'color_class' => 'icon-green', 'title' => 'Garansi Keamanan Website', 'desc' => 'Kami menjamin keamanan website dari serangan malware dan uptime server yang stabil.'],
        ['icon' => 'fas fa-play', 'color_class' => 'icon-purple', 'title' => 'Video Tutorial Pengelolaan', 'desc' => 'Tersedia video panduan lengkap di channel YouTube websekolah.official untuk membantu Anda.'],
        ['icon' => 'fas fa-video', 'color_class' => 'icon-blue', 'title' => 'Konsultasi Google Meet', 'desc' => 'Tim kami siap mendampingi via Google Meet untuk pelatihan dan konsultasi.'],
        ['icon' => 'fab fa-whatsapp', 'color_class' => 'icon-green', 'title' => 'Support WhatsApp & Group', 'desc' => 'Chat langsung dengan tim teknis kami melalui WhatsApp kapanpun dibutuhkan.'],
        ['icon' => 'fas fa-sync-alt', 'color_class' => 'icon-purple', 'title' => 'Update Fitur Berkala', 'desc' => 'Website sekolah Anda akan selalu mendapatkan fitur-fitur terbaru secara otomatis.']
    ],
    'whatsapp_message' => 'Halo Admin Elcoding, saya ingin pesan layanan Website Sekolah.'
]);

echo "Layanan seeded successfully!\n";
