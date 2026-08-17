<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Layanan;

$data = [
    [
        'title' => 'Hosting eRapor SMK',
        'slug' => 'hosting-erapor-smk',
        'icon' => 'fas fa-server',
        'badge' => 'Hosting',
        'short_description' => 'Hosting khusus untuk eRapor SMK yang aplikasinya disediakan oleh Direktorat SMK melalui situs erapor-smk.net. Dukungan penuh dari tim kami.',
        'price_label' => 'Harga',
        'price' => 'Rp 210.000',
        'price_period' => '/ tahun',
        'description' => '<p>Kini Anda tidak perlu lagi repot mengatur server lokal di sekolah yang harus selalu menyala 24 jam. Elcoding menyediakan layanan hosting khusus yang dirancang optimal untuk aplikasi <strong>eRapor SMK</strong>.</p><p>Aplikasi eRapor SMK Anda dapat diakses dari mana saja dan kapan saja secara online oleh para guru dan wali kelas tanpa terkendala infrastruktur jaringan lokal.</p>',
        'features_main' => [
            ['icon' => 'fas fa-rocket', 'title' => 'Performa Tinggi', 'desc' => 'Server dioptimalkan secara khusus untuk menjalankan aplikasi eRapor SMK dengan cepat tanpa lag.'],
            ['icon' => 'fas fa-shield-alt', 'title' => 'Aman & Backup Terjadwal', 'desc' => 'Data eRapor aman dengan sistem keamanan ketat dan backup otomatis berkala.'],
            ['icon' => 'fas fa-headset', 'title' => 'Bantuan Setup Awal', 'desc' => 'Tim kami akan membantu proses instalasi dan pemindahan database eRapor dari lokal ke server.'],
            ['icon' => 'fas fa-globe', 'title' => 'Akses Darimana Saja', 'desc' => 'Guru dapat mengisi nilai rapor dari rumah atau dimanapun menggunakan koneksi internet biasa.']
        ],
        'pricing_includes' => [
            'Spesifikasi Server Optimal eRapor',
            'Gratis Instalasi / Migrasi Database',
            'Subdomain (contoh: erapor.namasekolah.sch.id)',
            'SSL Certificate (HTTPS)',
            'Bantuan Teknis Prioritas'
        ],
        'features_full' => [],
        'whatsapp_message' => 'Halo Admin Elcoding, saya ingin pesan layanan Hosting eRapor SMK.'
    ],
    [
        'title' => 'Hosting RDM',
        'slug' => 'hosting-rdm',
        'icon' => 'fas fa-server',
        'badge' => 'Hosting',
        'short_description' => 'Hosting khusus untuk Rapor Digital Madrasah (RDM) yang aplikasinya disediakan oleh Kementerian Agama melalui rdm.kemenag.go.id. Cepat, stabil, dan terpercaya.',
        'price_label' => 'Harga',
        'price' => 'Rp 150.000',
        'price_period' => '/ tahun',
        'description' => '<p>Rapor Digital Madrasah (RDM) merupakan aplikasi wajib dari Kemenag. Namun instalasi di server lokal sekolah seringkali merepotkan karena keterbatasan spesifikasi PC dan keharusan IP Public.</p><p>Kami menawarkan solusi <strong>Hosting Khusus RDM</strong> yang siap pakai, aman, dan sangat ringan, sehingga guru-guru di Madrasah Anda dapat mengerjakan RDM darimana saja.</p>',
        'features_main' => [
            ['icon' => 'fas fa-tachometer-alt', 'title' => 'Lancar & Ringan', 'desc' => 'Disesuaikan dengan spesifikasi yang dibutuhkan RDM agar dapat diakses banyak guru secara bersamaan.'],
            ['icon' => 'fas fa-tools', 'title' => 'Bebas Ribet Instalasi', 'desc' => 'Anda terima beres, tidak perlu memikirkan XAMPP, VDI, atau konfigurasi jaringan.'],
            ['icon' => 'fas fa-cloud-download-alt', 'title' => 'Backup Rutin', 'desc' => 'Nilai siswa sangat berharga, karenanya kami rutin membackup database RDM sekolah Anda.'],
            ['icon' => 'fas fa-check', 'title' => 'Selalu Update', 'desc' => 'Jika ada pembaruan versi dari pusat, tim kami siap membantu melakukan update versi RDM.']
        ],
        'pricing_includes' => [
            'Server Khusus RDM',
            'Gratis Instalasi RDM',
            'Subdomain (contoh: rdm.namamadrasah.sch.id)',
            'Gratis SSL (HTTPS)',
            'Support Bantuan Kendala'
        ],
        'features_full' => [],
        'whatsapp_message' => 'Halo Admin Elcoding, saya ingin pesan layanan Hosting RDM.'
    ],
    [
        'title' => 'Cloud Server',
        'slug' => 'cloud-server',
        'icon' => 'fas fa-database',
        'badge' => 'Cloud',
        'short_description' => 'Cloud server untuk aplikasi eRapor & Dapodik baik untuk SD/SMP/SMA/SMK dengan sistem operasi Windows Server dan akses dengan domain sendiri.',
        'price_label' => 'Mulai dari',
        'price' => 'Rp 375.000',
        'price_period' => '/ 3 bulan',
        'description' => '<p>Bagi sekolah yang memiliki aplikasi berat atau spesifik yang mengharuskan penggunaan sistem operasi Windows Server, layanan Cloud Server (VPS Windows) kami adalah jawabannya.</p><p>Biasa digunakan untuk menghosting Dapodik, eRapor versi khusus, aplikasi CBT, hingga sistem informasi manajemen mandiri milik sekolah dengan kebebasan penuh akses Administrator (RDP).</p>',
        'features_main' => [
            ['icon' => 'fab fa-windows', 'title' => 'Windows Server', 'desc' => 'Sudah dilengkapi dengan sistem operasi Windows Server siap pakai.'],
            ['icon' => 'fas fa-desktop', 'title' => 'Akses Remote Desktop (RDP)', 'desc' => 'Anda bisa meremote server sama seperti menjalankan PC biasa di sekolah Anda.'],
            ['icon' => 'fas fa-network-wired', 'title' => 'Dedicated IP', 'desc' => 'Mendapatkan IP Public Dedicated untuk kestabilan akses dari luar jaringan.'],
            ['icon' => 'fas fa-bolt', 'title' => 'Penyimpanan SSD NVMe', 'desc' => 'Kecepatan read/write data sangat tinggi untuk menangani database besar.']
        ],
        'pricing_includes' => [
            'RAM 4GB & 2 vCPU',
            'SSD NVMe 50GB',
            'Windows Server 2012/2016/2019',
            '1 Dedicated IP Public',
            'Full Akses Administrator'
        ],
        'features_full' => [],
        'whatsapp_message' => 'Halo Admin Elcoding, saya butuh layanan Cloud Server untuk sekolah saya.'
    ],
    // Card 5 Sitesch.id
    [
        'title' => 'Sitesch.id',
        'slug' => 'sitesch-id',
        'icon' => 'fab fa-wordpress',
        'badge' => 'Template',
        'short_description' => 'Template WordPress Sitesch.ID siap pakai untuk website sekolah modern, responsif, dan berfitur lengkap. Beli sekali, aktif selamanya tanpa biaya berulang.',
        'price_label' => 'Harga',
        'price' => 'Rp 395.000',
        'price_period' => '/ sekali beli',
        'description' => '<p>Sitesch.ID merupakan template WordPress eksklusif yang dirancang khusus untuk kebutuhan Website Sekolah di Indonesia.</p><p>Hanya dengan sekali bayar, Anda mendapatkan lisensi penggunaan selamanya, lengkap dengan fitur PSB (Penerimaan Siswa Baru), Galeri, Berita, Pengumuman Kelulusan, dan berbagai fitur akademik lainnya.</p>',
        'features_main' => [
            ['icon' => 'fas fa-money-bill-wave', 'title' => 'Beli Sekali, Pakai Selamanya', 'desc' => 'Tidak ada biaya langganan bulanan atau tahunan untuk template ini.'],
            ['icon' => 'fas fa-puzzle-piece', 'title' => 'Fitur Khusus Sekolah', 'desc' => 'Sudah terpasang modul Guru, Siswa, Fasilitas, hingga formulir pendaftaran murid baru.'],
            ['icon' => 'fas fa-mobile-alt', 'title' => 'Sangat Responsif', 'desc' => 'Desain akan selalu terlihat sempurna meski diakses melalui layar smartphone terkecil sekalipun.'],
            ['icon' => 'fas fa-cogs', 'title' => 'Mudah Dikustomisasi', 'desc' => 'Anda dapat mengubah warna, logo, dan tata letak dengan mudah melalui panel opsi tema.']
        ],
        'pricing_includes' => [
            '1 Lisensi Domain',
            'File Template Asli (Bersih dari Malware)',
            'Dokumentasi & Video Panduan',
            'Gratis Update Minor',
            'Support Bantuan Instalasi'
        ],
        'features_full' => [],
        'whatsapp_message' => 'Halo Admin Elcoding, saya tertarik membeli template Sitesch.id.'
    ],
    // Card 6 E-Library
    [
        'title' => 'E-Library Sekolah',
        'slug' => 'e-library-sekolah',
        'icon' => 'fas fa-book',
        'badge' => 'Perpustakaan Digital',
        'short_description' => 'Perpustakaan digital untuk sekolah — katalog buku online, peminjaman mandiri, dan baca e-book langsung dari browser tanpa perlu instalasi.',
        'price_label' => 'Harga',
        'price' => 'Rp 425.000',
        'price_period' => '/ tahun',
        'description' => '<p>Ubah perpustakaan fisik sekolah Anda menjadi perpustakaan digital modern dengan E-Library Sekolah.</p><p>Aplikasi ini memungkinkan siswa untuk mencari katalog buku, melakukan peminjaman secara digital, atau bahkan membaca E-Book PDF langsung dari perangkat mereka, sehingga menumbuhkan minat baca siswa di era digital.</p>',
        'features_main' => [
            ['icon' => 'fas fa-search', 'title' => 'Katalog Buku Online', 'desc' => 'Siswa dapat mencari buku berdasarkan judul, pengarang, atau kategori dengan sangat mudah.'],
            ['icon' => 'fas fa-barcode', 'title' => 'Manajemen Peminjaman', 'desc' => 'Dilengkapi fitur peminjaman, pengembalian, dan denda keterlambatan.'],
            ['icon' => 'fas fa-file-pdf', 'title' => 'Baca E-Book Langsung', 'desc' => 'Siswa bisa membaca materi berformat PDF/E-Book langsung di dalam aplikasi tanpa mendownloadnya.'],
            ['icon' => 'fas fa-chart-pie', 'title' => 'Laporan Statistik', 'desc' => 'Pustakawan bisa mencetak laporan jumlah peminjam, buku paling populer, dan laporan stok buku.']
        ],
        'pricing_includes' => [
            'Aplikasi E-Library Lengkap',
            'Gratis Hosting Aplikasi 1 Tahun',
            'Subdomain Perpustakaan',
            'Panduan Penggunaan',
            'Bantuan Teknis'
        ],
        'features_full' => [],
        'whatsapp_message' => 'Halo Admin Elcoding, saya ingin bertanya tentang layanan E-Library Sekolah.'
    ]
];

foreach ($data as $item) {
    Layanan::updateOrCreate(['slug' => $item['slug']], $item);
}

echo "5 Layanan tambahan seeded successfully!\n";
