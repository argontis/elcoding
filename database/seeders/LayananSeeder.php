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
            // --- SET 1: LAYANAN WEBSITE & APLIKASI SEKOLAH ---
            [
                'title' => 'Website Sekolah',
                'slug' => 'website-sekolah',
                'icon' => 'fas fa-globe',
                'badge' => 'Website',
                'short_description' => 'Pembuatan website sekolah instan untuk TK, SD, SMP, SMA, SMK, SLB, Madrasah, Ponpes, Yayasan dan Lembaga Pendidikan lainnya. Website modern, responsif, dan mudah dikelola.',
                'price_label' => 'Mulai dari',
                'price' => 'Rp 375.000',
                'price_amount' => 375000,
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
            ],
            [
                'title' => 'Hosting eRapor SMK',
                'slug' => 'hosting-erapor-smk',
                'icon' => 'fas fa-server',
                'badge' => 'Hosting',
                'short_description' => 'Hosting khusus untuk eRapor SMK yang aplikasinya disediakan oleh Direktorat SMK melalui situs erapor-smk.net. Dukungan penuh dari tim kami.',
                'price_label' => 'Harga',
                'price' => 'Rp 210.000',
                'price_amount' => 210000,
                'price_period' => '/ tahun',
                'image_path' => '',
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
                'price_amount' => 150000,
                'price_period' => '/ tahun',
                'image_path' => '',
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
                'price_amount' => 375000,
                'price_period' => '/ 3 bulan',
                'image_path' => '',
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
            [
                'title' => 'Sitesch.id',
                'slug' => 'sitesch-id',
                'icon' => 'fab fa-wordpress',
                'badge' => 'Template',
                'short_description' => 'Template WordPress Sitesch.ID siap pakai untuk website sekolah modern, responsif, dan berfitur lengkap. Beli sekali, aktif selamanya tanpa biaya berulang.',
                'price_label' => 'Harga',
                'price' => 'Rp 395.000',
                'price_amount' => 395000,
                'price_period' => '/ sekali beli',
                'image_path' => '',
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
            [
                'title' => 'E-Library Sekolah',
                'slug' => 'e-library-sekolah',
                'icon' => 'fas fa-book',
                'badge' => 'Perpustakaan Digital',
                'short_description' => 'Perpustakaan digital untuk sekolah — katalog buku online, peminjaman mandiri, dan baca e-book langsung dari browser tanpa perlu instalasi.',
                'price_label' => 'Harga',
                'price' => 'Rp 425.000',
                'price_amount' => 425000,
                'price_period' => '/ tahun',
                'image_path' => '',
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
            ],

            // --- SET 2: LAYANAN JASA IT AGENCY & DEVELOPMENT ---
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
                'features_full' => [
                    'Desain Kustom Eksklusif (Non-Template)',
                    'Content Management System (CMS) Mudah Digunakan',
                    'Integrasi WhatsApp & Live Chat Widget',
                    'Keamanan SSL Certificate Terpasang',
                    'Analitik Pengunjung (Google Analytics)'
                ],
                'whatsapp_message' => 'Halo Elcoding, saya ingin berkonsultasi mengenai Jasa Pembuatan Website & Web Application.'
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
                'features_full' => [
                    'Multi-language Support',
                    'Fitur Lokasi / GPS Mapping',
                    'Sistem Keamanan Auth JWT & Biometric Login',
                    'Optimasi Ukuran App & Baterai'
                ],
                'whatsapp_message' => 'Halo Elcoding, saya berminat membuat Aplikasi Mobile untuk bisnis saya.'
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
                'features_full' => [
                    'UX Audit & Usability Testing',
                    'Responsive Layouts (Desktop & Mobile)',
                    'Iconography & Design Palette Custom'
                ],
                'whatsapp_message' => 'Halo Elcoding, saya butuh layanan Jasa UI/UX Design untuk aplikasi saya.'
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
                'features_full' => [
                    'Pilihan Metode Onsite atau Online Live Class',
                    'Recording Sesi Pelatihan Harian',
                    'Group Support Telegram / Slack Dedikasi'
                ],
                'whatsapp_message' => 'Halo Elcoding, kami ingin mengadakan Corporate IT Training untuk perusahaan kami.'
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
                'features_full' => [
                    'Docker & Kubernetes Containerization',
                    'Load Balancer Configuration',
                    'Penanganan Insiden Darurat (SLA Fast Response)'
                ],
                'whatsapp_message' => 'Halo Elcoding, saya butuh layanan Cloud Server & DevOps Maintenance.'
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
                'features_full' => [
                    'Pemeriksaan Security Header & Network Port',
                    'Analisis Kerentanan API Endpoint',
                    'Konsultasi Tim Security Specialist'
                ],
                'whatsapp_message' => 'Halo Elcoding, saya ingin berkonsultasi untuk Audit Keamanan Website / PenTest.'
            ],
        ];

        foreach ($services as $service) {
            Layanan::updateOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
