<?php

namespace App\Http\Controllers\Techfix;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceCenterLandingController extends Controller
{
    /**
     * Tampilkan Halaman Utama Pusat Informasi & Layanan Service Center (Cabang Clean)
     */
    public function index(Request $request)
    {
        // 1. Data Profil Service Center
        $center = [
            'name'           => 'L-Coding Service Center',
            'branch'         => 'Cabang Cibubur',
            'tagline'        => 'SPESIALIS REPARASI HARDWARE & PCB TINGKAT KOMPONEN',
            'headline'       => 'Pusat Servis Laptop, PC & Hardware Terpercaya di Cabang Cibubur',
            'subheadline'    => 'Diagnosa mikroskopik di depan Anda (bisa pantau langsung), estimasi perbaikan transparan serta penggantian komponen bergaransi resmi. Pantau progres pengerjaan komputer dan laptop Anda dari jauh atau konsultasi langsung dengan tim teknisi kami.',
            'jam_buka'       => '08:00 - 21:00 WIB',
            'status'         => 'Terhubung Bengkel Cabang Cibubur',
            'rating'         => '4.9 / 5.0 (520+ Review)',
            'alamat'         => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'store_full'     => 'Azzahra Computer – ASUS Authorized Service Center (Cabang Cibubur)',
            'no_whatsapp'    => '6281192345555',
            'no_telepon'     => '021-5366-2244',
            'unit_aktif'     => 32,
        ];

        // 2. Kategori Layanan Hardware Unggulan
        $categories = [
            [
                'id'          => 'laptop',
                'title'       => 'Laptop & Ultrabook',
                'icon'        => 'fa-solid fa-laptop',
                'color'       => 'from-blue-500 to-indigo-600',
                'desc'        => 'Mati total/no power, short motherboard, penggantian LCD/OLED, keyboard macet, engsel casing pecah, baterai drop, dan perbaikan water damage.',
                'features'    => [
                    'Ganti LCD 120Hz / 144Hz / OLED',
                    'Engsel patah & rekonstruksi dudukan baut',
                    'Keyboard & Trackpad Original OEM',
                    'Reballing & Thermal Repaste Khusus',
                ],
                'action_text' => 'Rincian Layanan',
                'action_tag'  => 'Laptop & Notebook',
            ],
            [
                'id'          => 'pc-desktop',
                'title'       => 'PC Desktop & Workstation',
                'icon'        => 'fa-solid fa-desktop',
                'color'       => 'from-cyan-500 to-blue-600',
                'desc'        => 'Upgrade GPU, custom liquid cooling, perakitan PC gaming, PSU modular, cable management, error blue screen (BSOD), dan workstation render.',
                'features'    => [
                    'Upgrade GPU NVidia / AMD & Riser',
                    'Rakit PC Gaming Custom & Cable Mod',
                    'Workstation Rendering & POS Server',
                    'Penggantian Power Supply (PSU) Gold',
                ],
                'action_text' => 'Setup & Rakit PC',
                'action_tag'  => 'Gaming & Workstation',
            ],
            [
                'id'          => 'maintenance',
                'title'       => 'Pembersihan & Maintenance',
                'icon'        => 'fa-solid fa-fan',
                'color'       => 'from-emerald-500 to-teal-600',
                'desc'        => 'Perawatan komprehensif debu menumpuk & suhu panas agar laptop/PC Anda terhindar dari thermal throttling dan drop FPS saat digunakan.',
                'features'    => [
                    'Deep Cleaning Debu Fan & Heatsink',
                    'Repaste Thermal Grizzly / Arctic MX-4',
                    'Ganti Thermal Pad VRAM & Mosfet',
                    'Optimasi Windows & Kesehatan SSD',
                ],
                'action_text' => 'Booking Deep Clean',
                'action_tag'  => 'Thermal & Cleaning',
            ],
            [
                'id'          => 'motherboard',
                'title'       => 'Motherboard & Chipset',
                'icon'        => 'fa-solid fa-microchip',
                'color'       => 'from-indigo-600 to-purple-600',
                'desc'        => 'Spesialis perbaikan mikro-soldering BGA tingkat komponen, jalur PCB putus, IC power 3V/5V short, dan flash chip BIOS korup.',
                'features'    => [
                    'Mikro-soldering IC Power 3V / 5V',
                    'BGA Rework CPU/GPU Reballing',
                    'Flash BIOS chip programmer CH341A',
                    'Rekonstruksi Jalur Putus / Jamper',
                ],
                'action_text' => 'Analisa Motherboard',
                'action_tag'  => 'PCB & BGA Level',
            ],
        ];

        // 3. Estimasi Biaya Servis Terpopuler
        $priceList = [
            [
                'id'           => 'p1',
                'title'        => 'Upgrade NVMe 512GB + Kloning OS',
                'category'     => 'UPGRADE STORAGE',
                'price'        => 'Rp 650.000',
                'original'     => 'Rp 750.000',
                'desc'         => 'SSD NVMe PCIe Gen3/Gen4 kecepatan hingga 3500 MB/s + Jasa Kloning Windows OS & Driver lengkap tanpa install ulang data.',
                'warranty'     => 'Garansi 12 Bulan',
                'duration'     => 'Estimasi 30 - 45 Menit',
                'tag'          => 'PROMO POPULER',
                'tag_color'    => 'bg-blue-100 text-blue-700',
            ],
            [
                'id'           => 'p2',
                'title'        => 'Deep Clean + Arctic MX-4 Paste',
                'category'     => 'PERAWATAN THERMAL',
                'price'        => 'Rp 150.000',
                'original'     => 'Rp 200.000',
                'desc'         => 'Bongkar total motherboard, bersihkan fan & heatsink dari debu padat, serta penggantian pasta pendingin CPU & GPU kualitas premium.',
                'warranty'     => 'Garansi Dingin 30 Hari',
                'duration'     => 'Estimasi 30 Menit',
                'tag'          => 'TERLARIS',
                'tag_color'    => 'bg-emerald-100 text-emerald-700',
            ],
            [
                'id'           => 'p3',
                'title'        => 'Servis Rekonstruksi Engsel Patah',
                'category'     => 'REPARASI CASING',
                'price'        => 'Rp 200.000',
                'original'     => 'Rp 250.000',
                'desc'         => 'Pengecoran dan penguatan dudukan baut frame engsel presisi tinggi menggunakan resin khusus tanpa merusak casing luar unit.',
                'warranty'     => 'Garansi Kokoh 6 Bulan',
                'duration'     => 'Estimasi 2 - 3 Jam Selesai',
                'tag'          => 'HEMAT BIAYA',
                'tag_color'    => 'bg-amber-100 text-amber-800',
            ],
            [
                'id'           => 'p4',
                'title'        => 'Ganti Baterai Laptop Original',
                'category'     => 'GANTI SUKU CADANG',
                'price'        => 'Rp 450.000',
                'original'     => 'Rp 550.000',
                'desc'         => 'Baterai baru kualitas OEM original dengan sirkuit proteksi overcharge & temperatur aman, kapasitas daya 100% prima.',
                'warranty'     => 'Garansi Baterai 6 Bulan',
                'duration'     => 'Estimasi 20 Menit Pasang',
                'tag'          => 'ORIGINAL',
                'tag_color'    => 'bg-indigo-100 text-indigo-700',
            ],
        ];

        // 4. Alur Servis Terhubung ke Bengkel & Teknisi
        $workflow = [
            [
                'step'  => 1,
                'title' => 'Drop Unit / Online',
                'desc'  => 'Bawa unit Anda langsung ke Cabang Clean atau jadwalkan kurir penjemputan via form online/WhatsApp.',
            ],
            [
                'step'  => 2,
                'title' => 'Tiket Servis Terbit',
                'desc'  => 'Nomor resi & tiket digital resmi terbit otomatis. Anda langsung menerima link pemantauan live real-time.',
            ],
            [
                'step'  => 3,
                'title' => 'Diagnosa & Estimasi',
                'desc'  => 'Teknisi membongkar & memeriksa unit di bawah mikroskop, mencatat rincian kerusakan secara transparan.',
            ],
            [
                'step'  => 4,
                'title' => 'Approval via Web/WA',
                'desc'  => 'Pelanggan meninjau rincian biaya estimasi part & jasa. Pengerjaan baru dimulai setelah Anda menyetujui.',
            ],
            [
                'step'  => 5,
                'title' => 'Unit Siap di POS Kasir',
                'desc'  => 'Pengujian QC tuntas 100%, serah terima di kasir dengan faktur digital, segel garansi resmi, dan nota lunas.',
            ],
        ];

        // 5. Testimoni Kepuasan Pengguna
        $testimonials = [
            [
                'name'    => 'Rian Hidayat',
                'role'    => 'Mahasiswa UI Depok',
                'rating'  => 5,
                'avatar'  => 'RH',
                'color'   => 'bg-blue-600',
                'content' => 'Laptop ASUS ROG Strix mati total gara-gara kena tumpahan kopi. Dibawa ke service center resmi katanya harus ganti motherboard 12 juta. Di L-Coding Clean beres cuma 700 ribu karena cuma kapasitor short. Teknisi ramah & transparan banget!',
            ],
            [
                'name'    => 'Siti Wardani',
                'role'    => 'Freelance Graphic Designer',
                'rating'  => 5,
                'avatar'  => 'SW',
                'color'   => 'bg-indigo-600',
                'content' => 'Engsel Lenovo Ideapad patah parah sampai layarnya lepas. Mau beli casing baru mahal banget. Disini direkonstruksi dudukan bautnya kokoh kembali dan rapih seperti baru lagi. Sangat recommended buat yang butuh servis cepat!',
            ],
            [
                'name'    => 'Bramantyo R.',
                'role'    => 'Videographer & Animator',
                'rating'  => 5,
                'avatar'  => 'BR',
                'color'   => 'bg-emerald-600',
                'content' => 'Service rakit PC gaming & rendering workstation. Cable management rapih banget, pasta pakai Grizzly, airflow diatur maksimal. Suhu stabil pas render seharian. Recommended buat para editor dan kreator konten!',
            ],
        ];

        // 6. FAQ (Informasi Penting Sebelum Servis)
        $faqs = [
            [
                'q' => 'Bagaimana Garansi Servis Berlaku?',
                'a' => 'Garansi berlaku selama 30 hingga 360 hari (tergantung jenis pengerjaan & sparepart). Jika terjadi kendala berulang pada komponen yang sama, unit akan ditangani prioritas tanpa dipungut biaya tambahan.',
            ],
            [
                'q' => 'Apakah Data Pribadi di Laptop/PC Aman?',
                'a' => 'Sangat aman! Seluruh teknisi bekerja di bawah komitmen NDA integritas data. Anda juga diperbolehkan melepas SSD/HDD penyimpanan di depan teknisi sebelum unit ditinggal bila diperlukan.',
            ],
            [
                'q' => 'Bagaimana Jika Unit Batal Diperbaiki?',
                'a' => 'Jika setelah diagnosa Anda memutuskan untuk tidak melanjutkan perbaikan karena estimasi biaya di luar budget, biaya diagnosa adalah Rp 0 (Gratis) dan unit dikembalikan utuh seperti semula.',
            ],
        ];

        // 7. Sample Data Tiket Default untuk Live Tracker Demo
        $sampleTicket = [
            'kode'             => 'SRV-2026-0241',
            'unit'             => 'Laptop ASUS ROG Strix G15',
            'serial'           => 'SN: G513-QC8912',
            'keluhan'          => 'Mati total setelah korsleting adaptor, indikator charging padam',
            'tindakan'         => 'Pemasangan IC Power 3V & Reballing Chipset Daya',
            'status'           => 'Sedang Diuji (Tahap 3)',
            'status_sub'       => 'Uji Tegangan Pas 100% & Stress-Test 45 Menit',
            'progress'         => 75,
            'teknisi'          => 'Doni Pratama (Hardware Specialist)',
            'estimasi_selesai' => 'Hari ini, 17:00 WIB',
            'biaya_estimasi'   => 'Rp 650.000',
        ];

        return view('servicecenter.landing', compact(
            'center',
            'categories',
            'priceList',
            'workflow',
            'testimonials',
            'faqs',
            'sampleTicket'
        ));
    }

    /**
     * Halaman Pusat Informasi Booking Servis — panduan antrean, alur, shift teknisi, dan SOP penyerahan unit
     */
    public function bookingServis(Request $request)
    {
        $center = [
            'name'            => 'L-Coding Service Center',
            'branch'          => 'Cabang Cibubur',
            'alamat'          => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'store_full'      => 'Azzahra Computer – ASUS Authorized Service Center (Cabang Cibubur)',
            'jam_buka'        => '08:00 – 21:00 WIB',
            'status'          => 'Buka & Menerima Antrean',
            'no_whatsapp'     => '6281192345555',
            'no_telepon'      => '021-5366-2244',
            'email'           => 'booking@lcodingclean.id',
            'antrian'         => 7,
            'estimasi_tunggu' => '15 Menit Pertama',
            'rating'          => '4.9 / 5.0',
            'total_review'    => 1240,
            'garansi'         => '30 s/d 360 Hari',
        ];

        $alur_booking = [
            [
                'step'  => '01',
                'title' => 'Konsultasi Awal & Reservasi Jadwal',
                'icon'  => 'fa-solid fa-comments',
                'color' => 'bg-blue-50 text-blue-600 border-blue-200',
                'desc'  => 'Sampaikan keluhan atau gejala kerusakan via WhatsApp CS atau formulir pesan kami. Tim teknisi akan memberikan gambaran kemungkinan kerusakan awal serta menjadwalkan slot kunjungan agar Anda tidak perlu mengantre lama.',
            ],
            [
                'step'  => '02',
                'title' => 'Penyerahan Unit di Lab Clean',
                'icon'  => 'fa-solid fa-boxes-packing',
                'color' => 'bg-indigo-50 text-indigo-600 border-indigo-200',
                'desc'  => 'Bawa unit langsung ke Rukan Clean Center No. 14 atau gunakan layanan pick-up kurir kami. Unit akan diperiksa kelengkapan fisiknya, difoto sebelum tindakan, dan Anda menerima Tiket Servis Fisik & Digital.',
            ],
            [
                'step'  => '03',
                'title' => 'Diagnosa Komponen & Persetujuan Biaya',
                'icon'  => 'fa-solid fa-microscope',
                'color' => 'bg-amber-50 text-amber-600 border-amber-200',
                'desc'  => 'Teknisi melakukan pengetesan mendalam di ruang lab berstandar ESD. Kami menginformasikan rincian kerusakan dan penawaran biaya resmi. Pengerjaan HANYA dimulai setelah Anda menyetujuinya secara tertulis.',
            ],
            [
                'step'  => '04',
                'title' => 'Pengerjaan, QC & Pengambilan Bergaransi',
                'icon'  => 'fa-solid fa-circle-check',
                'color' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                'desc'  => 'Setelah diservis, unit melewati 12 checklist Quality Control ketat (stress-test suhu, performa daya, kestabilan OS). Anda menerima nota rincian, segel garansi, dan backup log perbaikan.',
            ],
        ];

        $tipe_layanan = [
            [
                'id'       => 'express',
                'name'     => 'Fast-Track Express',
                'badge'    => 'Prioritas 1-3 Jam',
                'badge_bg' => 'bg-amber-500 text-white',
                'icon'     => 'fa-solid fa-bolt',
                'color'    => 'from-amber-500 to-orange-600',
                'estimasi' => '1 – 3 Jam Jadi',
                'cocok'    => 'Penggantian baterai kembung, upgrade NVMe SSD / RAM, repasting thermal paste grizzly, pembersihan kipas fan debu, re-install OS Windows bersih.',
                'benefit'  => ['Teknisi prioritas langsung tangani', 'Bisa ditunggu di customer lounge', 'Uji fungsi langsung di depan pelanggan'],
            ],
            [
                'id'       => 'reguler',
                'name'     => 'Standard Lab Repair',
                'badge'    => 'Paling Populer',
                'badge_bg' => 'bg-brand-600 text-white',
                'icon'     => 'fa-solid fa-microchip',
                'color'    => 'from-brand-600 to-indigo-600',
                'estimasi' => '1 – 3 Hari Kerja',
                'cocok'    => 'Reparasi motherboard mati total (short VCORE / 3V/5V), reballing chipset BGA GPU / CPU, ganti LCD panel pecah, keyboard laptop tanam, pemulihan korosi air.',
                'benefit'  => ['Diagnosa level mikroskop BGA', 'Jalur skema boardview original', 'Garansi pengerjaan hingga 90 hari'],
            ],
            [
                'id'       => 'pickup',
                'name'     => 'Pick-Up & Delivery',
                'badge'    => 'Antar-Jemput',
                'badge_bg' => 'bg-emerald-600 text-white',
                'icon'     => 'fa-solid fa-truck-ramp-box',
                'color'    => 'from-emerald-600 to-teal-600',
                'estimasi' => 'Sesuai Kesepakatan',
                'cocok'    => 'Khusus kantor perusahaan, instansi, atau pelanggan rumahan di wilayah Cibubur, Bekasi, dan sekitarnya yang memiliki mobilitas tinggi dan tidak sempat mengantar unit langsung.',
                'benefit'  => ['Kurir bersertifikasi packaging anti-shock', 'Tanda terima digital langsung dikirim', 'Asuransi proteksi penjemputan unit'],
            ],
        ];

        $jadwal_shift = [
            [
                'waktu'      => '08:00 – 12:00 WIB',
                'label'      => 'Shift Pagi (Fresh Start)',
                'kondisi'    => 'Trafik Lenggang',
                'kondisi_badge' => 'bg-emerald-100 text-emerald-800',
                'rekomendasi'=> 'Waktu terbaik untuk unit yang butuh pengetesan express atau konsultasi tatap muka santai dengan kepala teknisi.',
            ],
            [
                'waktu'      => '12:00 – 16:00 WIB',
                'label'      => 'Shift Siang (Prime Hours)',
                'kondisi'    => 'Trafik Sedang – Padat',
                'kondisi_badge' => 'bg-amber-100 text-amber-800',
                'rekomendasi'=> 'Paling ramai untuk drop-off istirahat kantor. Disarankan booking jadwal via WA minimal 1 jam sebelumnya.',
            ],
            [
                'waktu'      => '16:00 – 21:00 WIB',
                'label'      => 'Shift Sore & Malam (After Hours)',
                'kondisi'    => 'Trafik Pengambilan Unit',
                'kondisi_badge' => 'bg-blue-100 text-blue-800',
                'rekomendasi'=> 'Cocok bagi yang pulang kerja. Penerimaan unit baru tetap dilayani untuk dimasukkan dalam antrean lab pagi esok.',
            ],
        ];

        $checklist_syarat = [
            [
                'icon'  => 'fa-solid fa-plug',
                'title' => 'Charger / Adaptor Original',
                'desc'  => 'Wajib dibawa untuk pengetesan kestabilan daya voltase dan amper charging motherboard.',
            ],
            [
                'icon'  => 'fa-solid fa-key',
                'title' => 'PIN / Password Perangkat',
                'desc'  => 'Dibutuhkan teknisi untuk pengujian fungsi keyboard, audio, Wi-Fi, dan benchmark grafis.',
            ],
            [
                'icon'  => 'fa-solid fa-database',
                'title' => 'Backup Data Penting (Disarankan)',
                'desc'  => 'Meskipun kami menjamin privasi, backup file penting Anda selalu menjadi praktik terbaik sebelum reparasi besar.',
            ],
            [
                'icon'  => 'fa-brands fa-whatsapp',
                'title' => 'Nomor WhatsApp Aktif',
                'desc'  => 'Sistem otomasi kami mengirimkan foto progres dan laporan teknisi langsung ke nomor WhatsApp Anda.',
            ],
        ];

        $faqs_booking = [
            [
                'q' => 'Apakah reservasi atau booking jadwal servis dikenakan biaya pendaftaran?',
                'a' => 'Sama sekali tidak ada biaya pendaftaran. Booking jadwal di L-Coding Service Center 100% GRATIS. Biaya hanya dikenakan apabila Anda menyetujui penawaran jasa dan sparepart setelah diagnosa selesai dilakukan.',
            ],
            [
                'q' => 'Bisakah saya langsung datang tanpa reservasi (Walk-In)?',
                'a' => 'Tentu saja bisa! Kami tetap melayani pelanggan walk-in. Namun, pelanggan yang telah melakukan reservasi terlebih dahulu akan mendapatkan prioritas antrean pengerjaan oleh teknisi siaga kami.',
            ],
            [
                'q' => 'Bagaimana jika setelah diagnosa saya memutuskan untuk tidak melanjutkan servis?',
                'a' => 'Tidak masalah. Diagnosa awal di L-Coding Service Center bersifat transparan dan tidak mengikat. Jika Anda memutuskan membatalkan perbaikan, unit akan dirakit kembali rapi seperti semula tanpa ada paksaan servis.',
            ],
            [
                'q' => 'Berapa lama garansi yang diberikan untuk perbaikan?',
                'a' => 'Kami memberikan garansi resmi pengerjaan mulai dari 30 hari hingga 360 hari (tergantung jenis suku cadang yang diganti). Garansi mencakup kendala berulang pada komponen yang telah diganti/diservis.',
            ],
            [
                'q' => 'Bagaimana cara booking jadwal melalui WhatsApp?',
                'a' => 'Cukup klik tombol "Reservasi via WhatsApp" di halaman ini atau hubungi +62 811-9234-5555. Format pesan akan otomatis terisi sehingga Anda cukup mengisi merk laptop dan keluhannya saja.',
            ],
        ];

        return view('servicecenter.booking-servis', compact(
            'center', 'alur_booking', 'tipe_layanan',
            'jadwal_shift', 'checklist_syarat', 'faqs_booking'
        ));
    }

    /**
     * Halaman Pusat Informasi Katalog Produk & Sparepart OEM Terverifikasi
     */
    public function katalog(Request $request)
    {
        $center = [
            'name'            => 'L-Coding Service Center',
            'branch'          => 'Cabang Cibubur',
            'alamat'          => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'store_full'      => 'Azzahra Computer – ASUS Authorized Service Center (Cabang Cibubur)',
            'jam_buka'        => '08:00 – 21:00 WIB',
            'status'          => 'Buka & Melayani',
            'no_whatsapp'     => '6281255445566',
            'no_telepon'      => '021-5366-2244',
            'email'           => 'spareparts@lcodingclean.id',
            'rating'          => '4.9 / 5.0',
            'total_review'    => '520+',
            'unit_aktif'      => 14,
            'garansi'         => '90 s/d 360 Hari',
            'depot_nama'      => 'Depot Cabang Cibubur',
            'depot_persen'    => '94.2% Unit Siap Pasang Hari Ini',
            'sku_aktif'       => 142,
        ];

        $categories = [
            ['id' => 'all',     'name' => 'Semua',                  'count' => 142],
            ['id' => 'storage', 'name' => 'Storage & NVMe',         'count' => 38],
            ['id' => 'ram',     'name' => 'RAM Memory',             'count' => 24],
            ['id' => 'battery', 'name' => 'Baterai Laptop OEM',     'count' => 19],
            ['id' => 'lcd',     'name' => 'Layar LCD & Flexible',   'count' => 15],
            ['id' => 'cooling', 'name' => 'Cooling & Thermal Paste','count' => 18],
            ['id' => 'power',   'name' => 'Power & Adaptor GaN',    'count' => 28],
        ];

        $brands = [
            'Lenovo Legion/ThinkPad',
            'ASUS ROG/TUF',
            'Apple MacBook',
            'Acer Nitro/Predator',
            'Custom Desktop PC',
        ];

        $products = [
            [
                'id'          => 1,
                'name'        => 'Samsung 990 PRO NVMe PCIe 4.0 1TB',
                'sku'         => 'SKU: MZ-V9P1T0BW',
                'category'    => 'storage',
                'category_label' => 'Storage & NVMe',
                'brand'       => 'Lenovo Legion/ThinkPad, ASUS ROG/TUF, Custom Desktop PC',
                'stock'       => '8 Unit di Cabang',
                'warranty'    => 'GARANSI 5 TAHUN',
                'warranty_bg' => 'bg-blue-600 text-white',
                'tag'         => 'Tebet Ready',
                'desc'        => 'Kecepatan baca 7.450 MB/s, tulis 6.900 MB/s. V-NAND 3-ch MLC controller Pascal.',
                'specs'       => [
                    'Form Factor'    => 'M.2 2280 NVMe',
                    'TBW Durability' => '600 TBW Resmi',
                ],
                'addon_label' => '+ Jasa Pasang & Kloning OS',
                'addon_price' => '+Rp 100.000 (Selesai 30 Menit)',
                'price'       => 'Rp 1.850.000',
                'img'         => 'https://images.unsplash.com/photo-1597872200969-2b65d56bd16b?w=500&auto=format&fit=crop&q=80',
            ],
            [
                'id'          => 2,
                'name'        => 'Baterai Lenovo Legion 5 / 5 Pro 80Wh OEM',
                'sku'         => 'SKU: BAT-LBN-L20M4PC1',
                'category'    => 'battery',
                'category_label' => 'Baterai Laptop OEM',
                'brand'       => 'Lenovo Legion/ThinkPad',
                'stock'       => '4 Unit di Cabang',
                'warranty'    => 'ORIGINAL CELL',
                'warranty_bg' => 'bg-slate-700 text-white',
                'tag'         => 'Tebet Ready',
                'desc'        => 'Grade A+ Original Cell 15.36V 5210mAh. Proteksi IC overcharge dan thermal sensor.',
                'specs'       => [
                    'Kapasitas Sel' => '80Wh 4-Cell',
                    'Model Support' => 'Legion 5 (2021-2023)',
                ],
                'addon_label' => '+ Pasang & Kalibrasi Battery Health',
                'addon_price' => '+Rp 50.000 (Selesai 20 Menit)',
                'price'       => 'Rp 680.000',
                'img'         => 'https://images.unsplash.com/photo-1609592807906-8809a475e7a9?w=500&auto=format&fit=crop&q=80',
            ],
            [
                'id'          => 3,
                'name'        => 'Corsair Vengeance SODIMM DDR5 16GB 4800MHz',
                'sku'         => 'SKU: CMSX16GX5M1A4800C40',
                'category'    => 'ram',
                'category_label' => 'RAM Memory',
                'brand'       => 'Lenovo Legion/ThinkPad, ASUS ROG/TUF, Acer Nitro/Predator',
                'stock'       => '12 Unit di Cabang',
                'warranty'    => 'GARANSI LIFETIME',
                'warranty_bg' => 'bg-indigo-600 text-white',
                'tag'         => 'Ready Stock',
                'desc'        => 'Laptop RAM high-frequency CL40 1.1V. Plug-and-play auto-overclocking tanpa konfigurasi BIOS.',
                'specs'       => [
                    'Timing'          => '40-40-40-77',
                    'Kompatibilitas' => 'Intel 12-14th / AMD 6000-8000',
                ],
                'addon_label' => '+ Pemasangan & Dual-Bench Memory',
                'addon_price' => '+Rp 50.000 (15 Menit)',
                'price'       => 'Rp 750.000',
                'img'         => 'https://images.unsplash.com/photo-1562976540-1502c2145186?w=500&auto=format&fit=crop&q=80',
            ],
            [
                'id'          => 4,
                'name'        => 'Honeywell PTM7950 Phase Change Pad (40×80mm)',
                'sku'         => 'SKU: THM-HW-PTM7950-4080',
                'category'    => 'cooling',
                'category_label' => 'Cooling & Thermal Paste',
                'brand'       => 'Lenovo Legion/ThinkPad, ASUS ROG/TUF, Apple MacBook, Acer Nitro/Predator',
                'stock'       => '25 Pcs di Cabang',
                'warranty'    => '100% ORIGINAL HONEYWELL',
                'warranty_bg' => 'bg-emerald-600 text-white',
                'tag'         => 'Favorit Bengkel',
                'desc'        => 'Ketebalan 0.2mm. Material phase change pad solid pada <45°C. Menghilangkan resiko pump-out.',
                'specs'       => [
                    'Thermal Conduct' => '8.5 W/mK Real',
                    'Ketahanan'       => '2+ Tahun Tanpa Kering',
                ],
                'addon_label' => '+ Jasa Potong Presisi & Repaste Heatsink',
                'addon_price' => '+Rp 75.000 (Pembersihan Fan Ekstra)',
                'price'       => 'Rp 120.000',
                'img'         => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=500&auto=format&fit=crop&q=80',
            ],
            [
                'id'          => 5,
                'name'        => 'Thermal Grizzly Kryonaut Extreme 2g Paste',
                'sku'         => 'SKU: TG-KE-002-R',
                'category'    => 'cooling',
                'category_label' => 'Cooling & Thermal Paste',
                'brand'       => 'Custom Desktop PC, ASUS ROG/TUF, Lenovo Legion/ThinkPad',
                'stock'       => '15 Pcs di Cabang',
                'warranty'    => 'VERIFIED AUTH CODE',
                'warranty_bg' => 'bg-slate-800 text-white',
                'tag'         => 'Overclocking Grade',
                'desc'        => 'Konduktivitas termal puncak 14.2 W/mK dengan partikel nano-aluminium oksida murni.',
                'specs'       => [
                    'Thermal Conduct'    => '14.2 W/mK',
                    'Electrical Conduct' => '0 pS/m (Aman Non-Konduktif)',
                ],
                'addon_label' => '+ Jasa Bongkar & Aplikasi Thermal Paste',
                'addon_price' => '+Rp 80.000 (Free Diagnostic Suhu)',
                'price'       => 'Rp 195.000',
                'img'         => 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?w=500&auto=format&fit=crop&q=80',
            ],
            [
                'id'          => 6,
                'name'        => 'Layar LCD IPS 15.6" 144Hz FHD 40-Pin Slim',
                'sku'         => 'SKU: LCD-IPS-156-144-40P',
                'category'    => 'lcd',
                'category_label' => 'Layar LCD & Flexible',
                'brand'       => 'ASUS ROG/TUF, Acer Nitro/Predator, Lenovo Legion/ThinkPad',
                'stock'       => 'Sisa 3 Panel',
                'warranty'    => 'ZERO DEAD-PIXEL',
                'warranty_bg' => 'bg-cyan-600 text-white',
                'tag'         => 'Garansi 90 Hari',
                'desc'        => 'Resolusi 1920x1080 144Hz refresh rate, 100% sRGB color gamut, konektor 40-pin eDP.',
                'specs'       => [
                    'Konektor'   => '40-Pin eDP (Right-Bottom)',
                    'Panel Type' => 'Anti-Glare Matte IPS',
                ],
                'addon_label' => '+ Pemasangan Rapi & Penggantian Seal Bezel',
                'addon_price' => '+Rp 120.000 (Free QC Display)',
                'price'       => 'Rp 950.000',
                'img'         => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=500&auto=format&fit=crop&q=80',
            ],
            [
                'id'          => 7,
                'name'        => 'Charger Adaptor Laptop Type-C 100W GaN',
                'sku'         => 'SKU: PWR-GAN-100W-PRO',
                'category'    => 'power',
                'category_label' => 'Power & Adaptor GaN',
                'brand'       => 'Apple MacBook, Lenovo Legion/ThinkPad, ASUS ROG/TUF',
                'stock'       => '9 Unit di Cabang',
                'warranty'    => 'MULTI-PROTOCOL PD 3.0',
                'warranty_bg' => 'bg-amber-600 text-white',
                'tag'         => 'Ready Stock',
                'desc'        => 'Teknologi Gallium Nitride dingin berukuran ringkas. Kompatibel ThinkPad, ROG, MacBook, Dell.',
                'specs'       => [
                    'Output Maks' => '100W PD / 65W+35W Split',
                    'Proteksi'    => 'OCP / OVP / OTP Smart Cutoff',
                ],
                'addon_label' => 'Plug-and-play langsung tanpa biaya pasang',
                'addon_price' => '(Siap Pakai)',
                'price'       => 'Rp 420.000',
                'img'         => 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=500&auto=format&fit=crop&q=80',
            ],
            [
                'id'          => 8,
                'name'        => 'Fan CPU & GPU Blower Double Cooling ASUS G14',
                'sku'         => 'SKU: FAN-ASUS-G14-PAIR',
                'category'    => 'cooling',
                'category_label' => 'Cooling & Thermal Paste',
                'brand'       => 'ASUS ROG/TUF',
                'stock'       => '6 Pasang di Cabang',
                'warranty'    => 'OEM HYDRAULIC',
                'warranty_bg' => 'bg-teal-600 text-white',
                'tag'         => 'Original Bearing',
                'desc'        => 'Sepasang fan pendingin replacement original CPU + GPU. Mengatasi bunyi decit & throttling.',
                'specs'       => [
                    'Tegangan' => 'DC 12V 1.0A (4-Pin PWM)',
                    'Bearing'  => 'Fluid Dynamic Silencer',
                ],
                'addon_label' => '+ Jasa Ganti Fan & Pembersihan Kisi Heatsink',
                'addon_price' => '+Rp 60.000 (20 Menit)',
                'price'       => 'Rp 275.000',
                'img'         => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500&auto=format&fit=crop&q=80',
            ],
        ];

        $workshop_steps = [
            [
                'step'   => '01',
                'title'  => 'Pilih Suku Cadang & Verifikasi',
                'desc'   => 'Gunakan katalog untuk mengecek ketersediaan unit di Cabang Clean Tebet. Dapatkan kepastian harga tanpa biaya tersembunyi.',
                'badge'  => 'Scan barcode IMEI/Serial sebelum unboxing',
                'icon'   => 'fa-solid fa-barcode',
            ],
            [
                'step'   => '02',
                'title'  => 'Pemasangan Ekspres 15–30 Menit',
                'desc'   => 'Bawa perangkat ke meja Front Office. Teknisi bersertifikasi melakukan disassembly aman ESD, pemasangan modul, dan thermal repasting.',
                'badge'  => 'Rata-rata durasi: 18.4 menit pemasangan',
                'icon'   => 'fa-solid fa-stopwatch-20',
            ],
            [
                'step'   => '03',
                'title'  => 'Uji Diagnostik & Tiket Garansi',
                'desc'   => 'Pengujian benchmark suhu, memory bus, dan kalibrasi baterai secara menyeluruh sebelum serah terima. Segel dan kode garansi otomatis tersinkron ke profil.',
                'badge'  => 'Digital QR Receipt & e-Garansi',
                'icon'   => 'fa-solid fa-qrcode',
            ],
        ];

        return view('servicecenter.katalog', compact(
            'center', 'categories', 'brands', 'products', 'workshop_steps'
        ));
    }

    /**
     * Halaman Pusat Informasi Cek Biaya & Estimasi Transparan (No Fix, No Fee)
     */
    public function cekBiaya(Request $request)
    {
        $center = [
            'name'            => 'L-Coding Service Center',
            'branch'          => 'Cabang Cibubur',
            'alamat'          => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'store_full'      => 'Azzahra Computer – ASUS Authorized Service Center (Cabang Cibubur)',
            'jam_buka'        => '08:00 – 21:00 WIB',
            'status'          => 'Buka & Melayani',
            'no_whatsapp'     => '6281255445566',
            'no_telepon'      => '021-5366-2244',
            'email'           => 'billing@lcodingclean.id',
            'rating'          => '4.9 / 5.0',
            'total_review'    => '520+',
            'unit_aktif'      => 14,
            'garansi'         => '90 s/d 360 Hari',
            'transparency'    => '98.4%',
        ];

        $calc_devices = [
            ['id' => 'laptop',    'name' => 'Laptop / Notebook',       'icon' => 'fa-solid fa-laptop'],
            ['id' => 'desktop',   'name' => 'PC Desktop',              'icon' => 'fa-solid fa-desktop'],
            ['id' => 'allinone',  'name' => 'All-in-One PC',           'icon' => 'fa-solid fa-computer'],
            ['id' => 'macbook',   'name' => 'MacBook / Apple Mac',     'icon' => 'fa-brands fa-apple'],
            ['id' => 'gaming',    'name' => 'Gaming Laptop High-End',  'icon' => 'fa-solid fa-gamepad'],
            ['id' => 'server',    'name' => 'iMac & Mini Server',      'icon' => 'fa-solid fa-server'],
        ];

        $calc_damages = [
            [
                'id'       => 'thermal',
                'name'     => 'Thermal Cleanup, Repaste, Cleaning Fans',
                'desc'     => 'Pembersihan heatsink, repasting Kryonaut/PTM7950, penurunan suhu s/d 18°C.',
                'price'    => 150000,
                'price_str'=> 'Rp 150.000',
                'badge'    => 'Favorit',
            ],
            [
                'id'       => 'mati_total',
                'name'     => 'Mati Total / Short Circuit Motherboard',
                'desc'     => 'Perbaikan jalur power VCORE/3V/5V, penggantian kapasitor tantalum & MOSFET bocor.',
                'price'    => 450000,
                'price_str'=> 'Rp 350.000 – Rp 650.000',
                'badge'    => 'Diagnosa Lab',
            ],
            [
                'id'       => 'reballing',
                'name'     => 'Reballing BGA GPU / Chipset Processor',
                'desc'     => 'Pemasangan ulang solder ball chipset timah unleaded, perbaikan artifact / no display.',
                'price'    => 650000,
                'price_str'=> 'Rp 450.000 – Rp 850.000',
                'badge'    => 'Presisi BGA',
            ],
            [
                'id'       => 'lcd',
                'name'     => 'Ganti Layar LCD Display (Panel 144Hz FHD)',
                'desc'     => 'Layar pecah, bergaris, blank putih/hitam. Termasuk pemasangan rapi dan segel bezel.',
                'price'    => 950000,
                'price_str'=> 'Rp 850.000 – Rp 1.450.000',
                'badge'    => 'Zero Dead-Pixel',
            ],
            [
                'id'       => 'keyboard',
                'name'     => 'Keyboard Macet / Baterai Drop / Touchpad',
                'desc'     => 'Penggantian modul keyboard tanam keling plastik, baterai original, kalibrasi daya.',
                'price'    => 350000,
                'price_str'=> 'Rp 250.000 – Rp 550.000',
                'badge'    => 'OEM Part',
            ],
        ];

        $price_categories = [
            [
                'title' => 'Perawatan & Thermal',
                'icon'  => 'fa-solid fa-snowflake',
                'color' => 'bg-blue-50 text-blue-600',
                'items' => [
                    ['name' => 'Pembersihan Fan & Heatsink',           'price' => 'Rp 100.000', 'sub' => 'Disassembly standar, sikat debu kisi'],
                    ['name' => 'Repasting Thermal Grizzly / PTM7950',  'price' => 'Rp 150.000', 'sub' => 'Penurunan suhu maksimal 15–20°C'],
                    ['name' => 'Deep Cleaning Full Disassembly',       'price' => 'Rp 200.000', 'sub' => 'Ultrasonic bath PCB & case sanitasi'],
                ],
                'garansi' => 'Garansi Thermal: 6 Bulan',
            ],
            [
                'title' => 'Motherboard & IC Mikro',
                'icon'  => 'fa-solid fa-microchip',
                'color' => 'bg-indigo-50 text-indigo-600',
                'items' => [
                    ['name' => 'Short VCORE / 3V/5V Power Rail',       'price' => 'Rp 350.000 – Rp 550.000', 'sub' => 'Penggantian MOSFET & PWM controller'],
                    ['name' => 'Reballing Chipset GPU/CPU',            'price' => 'Rp 650.000 – Rp 950.000', 'sub' => 'Mesin BGA rework station industri'],
                    ['name' => 'Flash BIOS & EC Chip Firmware',        'price' => 'Rp 250.000',              'sub' => 'Programmer RT809H clean ME region'],
                ],
                'garansi' => 'Garansi Motherboard: 90 Hari',
            ],
            [
                'title' => 'Pergantian Komponen',
                'icon'  => 'fa-solid fa-toolbox',
                'color' => 'bg-emerald-50 text-emerald-600',
                'items' => [
                    ['name' => 'Pasang LCD Screen Panel',              'price' => 'Rp 150.000', 'sub' => '(+ Harga panel display dipilih)'],
                    ['name' => 'Pasang Baterai Laptop OEM',            'price' => 'Rp 50.000',  'sub' => '(+ Harga baterai, free kalibrasi)'],
                    ['name' => 'Pasang Keyboard Internal / Tanam',     'price' => 'Rp 150.000', 'sub' => '(Penyolderan bracket keling rapi)'],
                ],
                'garansi' => 'Garansi Komponen: Mengikuti Part',
            ],
            [
                'title' => 'Software & Optimasi',
                'icon'  => 'fa-solid fa-code',
                'color' => 'bg-amber-50 text-amber-600',
                'items' => [
                    ['name' => 'Reinstall OS Clean + Driver Resmi',    'price' => 'Rp 100.000', 'sub' => 'Windows 11 / macOS tanpa bloatware'],
                    ['name' => 'Backup & Restore Data SSD',           'price' => 'Rp 150.000', 'sub' => 'Migrasi OS ke NVMe SSD 1:1'],
                    ['name' => 'Tuning & Undervolting Suhu',           'price' => 'Rp 120.000', 'sub' => 'Kurva ThrottleStop / Ryzen Controller'],
                ],
                'garansi' => 'Garansi Software: 30 Hari',
            ],
        ];

        $trust_pillars = [
            [
                'step'  => '01',
                'title' => 'Diagnosa Gratis di Meja Depan',
                'icon'  => 'fa-solid fa-magnifying-glass-chart',
                'desc'  => 'Pemeriksaan fisik awal, cek tegangan adaptor, dan analisa gejala kerusakan dilakukan tanpa dipungut biaya sepeserpun sebelum tindakan.',
                'badge' => '100% Free Initial Check',
            ],
            [
                'title' => 'Konfirmasi Sebelum Tindakan',
                'step'  => '02',
                'icon'  => 'fa-solid fa-signature',
                'desc'  => 'Tidak ada pergantian komponen yang dilakukan sebelum Anda menyetujui rincian biaya resmi via WhatsApp atau formulir persetujuan.',
                'badge' => 'No Hidden Charges',
            ],
            [
                'title' => 'Part Rusak Selalu Dikembalikan',
                'step'  => '03',
                'icon'  => 'fa-solid fa-box-open',
                'desc'  => 'Komponen lama (IC, kapasitor, baterai, LCD) wajib diserahkan kembali kepada Anda sebagai bukti fisik integritas kerja teknisi kami.',
                'badge' => 'Transparan & Otentik',
            ],
            [
                'title' => 'No Fix, No Fee (Gagal = Gratis)',
                'step'  => '04',
                'icon'  => 'fa-solid fa-shield-halved',
                'desc'  => 'Jika kerusakan motherboard tidak berhasil kami perbaiki sesuai standar kelayakan fungsi, Anda tidak dikenakan biaya jasa sama sekali.',
                'badge' => 'Garansi Kepuasan',
            ],
        ];

        $faqs_biaya = [
            [
                'q' => 'Bagaimana jika setelah dicek saya merasa biaya servis terlalu mahal?',
                'a' => 'Anda berhak membatalkan perbaikan tanpa biaya apapun (Rp 0,-). Unit akan dirakit kembali secara rapi dan diserahkan dalam kondisi semula tanpa ada paksaan pengerjaan.',
            ],
            [
                'q' => 'Apakah ada biaya tersembunyi selain jasa dan harga sparepart?',
                'a' => 'Tidak ada sama sekali. Seluruh biaya yang tertera pada nota dan pesan konfirmasi WhatsApp adalah angka final mencakup jasa instalasi, bahan pembersih/thermal paste, dan Quality Control.',
            ],
            [
                'q' => 'Kenapa beberapa kerusakan motherboard hanya bisa diestimasi kisarannya?',
                'a' => 'Kerusakan jalur motherboard seringkali memiliki efek berantai (misalnya short pada jalur 19V bisa merusak MOSFET sekaligus PWM controller). Setelah pengetesan komponen mikro di lab, teknisi akan memberikan angka pasti sebelum tindakan dimulai.',
            ],
            [
                'q' => 'Apakah biaya perbaikan bisa dinegosiasikan untuk instansi atau kantor?',
                'a' => 'Tentu bisa. Kami menyediakan skema korporat (B2B Maintenance Agreement) dengan diskon kuantiti unit, penerbitan invoice resmi perusahaan, dan termin pembayaran berkala.',
            ],
        ];

        return view('servicecenter.cek-biaya', compact(
            'center', 'calc_devices', 'calc_damages',
            'price_categories', 'trust_pillars', 'faqs_biaya'
        ));
    }

    /**
     * Halaman Pusat Informasi Cek Tiket Servis — informasi statis tentang service center
     */
    public function cekTiket(Request $request)
    {
        $center = [
            'name'        => 'L-Coding Service Center',
            'branch'      => 'Cabang Cibubur',
            'jam_buka'    => '08:00 – 21:00 WIB',
            'status'      => 'Buka & Melayani',
            'no_whatsapp' => '6281192345555',
            'no_telepon'  => '021-5366-2244',
            'email'       => 'service@lcodingclean.id',
            'alamat'      => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'store_full'  => 'Azzahra Computer – ASUS Authorized Service Center (Cabang Cibubur)',
            'rating'      => '4.9 / 5.0',
            'total_review'=> '520+',
            'unit_aktif'  => 32,
            'garansi'     => 'Hingga 360 Hari',
        ];

        // Format tiket & cara cek
        $cara_cek = [
            [
                'step'  => 1,
                'icon'  => 'fa-solid fa-receipt',
                'title' => 'Dapatkan Nomor Tiket',
                'desc'  => 'Nomor tiket (format: SRV-YYYY-XXXX) dikirim otomatis via WhatsApp & email saat unit Anda didaftarkan oleh kasir Cabang Clean.',
                'color' => 'bg-blue-50 text-blue-600 border-blue-200',
            ],
            [
                'step'  => 2,
                'icon'  => 'fa-solid fa-magnifying-glass',
                'title' => 'Masukkan Kode Tiket',
                'desc'  => 'Kunjungi halaman Lacak Tiket Servis, masukkan nomor tiket Anda (contoh: SRV-2026-0241) lalu klik tombol "Lacak Tiket".',
                'color' => 'bg-indigo-50 text-indigo-600 border-indigo-200',
            ],
            [
                'step'  => 3,
                'icon'  => 'fa-solid fa-chart-line',
                'title' => 'Pantau Progres Real-Time',
                'desc'  => 'Status pengerjaan, nama teknisi, estimasi selesai, dan rincian biaya sementara tersedia langsung tanpa perlu menelepon ke toko.',
                'color' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
            ],
            [
                'step'  => 4,
                'icon'  => 'fa-solid fa-bell',
                'title' => 'Notifikasi Otomatis',
                'desc'  => 'Anda akan menerima notifikasi WhatsApp otomatis setiap kali status pengerjaan berubah — tanpa perlu terus memantau secara manual.',
                'color' => 'bg-amber-50 text-amber-600 border-amber-200',
            ],
        ];

        // Status tiket yang tersedia
        $status_list = [
            ['label' => 'Antrian Diagnosa',         'icon' => 'fa-solid fa-hourglass-start',   'color' => 'text-slate-600 bg-slate-100',   'desc' => 'Unit diterima, menunggu giliran pemeriksaan oleh teknisi.'],
            ['label' => 'Proses Diagnosa',           'icon' => 'fa-solid fa-microscope',        'color' => 'text-blue-700 bg-blue-100',     'desc' => 'Teknisi sedang memeriksa kerusakan secara mendetail.'],
            ['label' => 'Menunggu Persetujuan',      'icon' => 'fa-solid fa-file-signature',    'color' => 'text-amber-700 bg-amber-100',   'desc' => 'Estimasi biaya sudah dikirim, menunggu konfirmasi dari pelanggan.'],
            ['label' => 'Sedang Dikerjakan',         'icon' => 'fa-solid fa-screwdriver-wrench','color' => 'text-indigo-700 bg-indigo-100', 'desc' => 'Perbaikan sedang berjalan oleh teknisi yang ditugaskan.'],
            ['label' => 'QC & Pengujian Akhir',     'icon' => 'fa-solid fa-shield-check',      'color' => 'text-teal-700 bg-teal-100',     'desc' => 'Unit telah selesai diperbaiki dan sedang melewati quality control.'],
            ['label' => 'Siap Diambil di Kasir',    'icon' => 'fa-solid fa-check-circle',      'color' => 'text-emerald-700 bg-emerald-100','desc' => 'Unit sudah selesai QC dan siap diserahterimakan di kasir toko.'],
        ];

        // Produk & layanan unggulan toko
        $produk_toko = [
            [
                'kategori' => 'Suku Cadang Laptop',
                'icon'     => 'fa-solid fa-laptop',
                'color'    => 'from-blue-500 to-indigo-600',
                'items'    => ['LCD / Panel OLED 120Hz–144Hz', 'Keyboard OEM & Topcase Casing', 'Baterai Original Semua Merk', 'Engsel Laptop & Dudukan Baut', 'DC Jack & Konektor Charger'],
            ],
            [
                'kategori' => 'Komponen PC & Upgrade',
                'icon'     => 'fa-solid fa-desktop',
                'color'    => 'from-cyan-500 to-blue-500',
                'items'    => ['SSD NVMe PCIe Gen3 & Gen4', 'RAM DDR4/DDR5 Semua Kapasitas', 'GPU Nvidia RTX & AMD Radeon', 'PSU Modular 80+ Gold & Platinum', 'Liquid Cooler AIO 240/360mm'],
            ],
            [
                'kategori' => 'Thermal & Aksesori',
                'icon'     => 'fa-solid fa-temperature-three-quarters',
                'color'    => 'from-orange-500 to-red-500',
                'items'    => ['Thermal Grizzly Kryonaut & Conductonaut', 'Thermal Pad 0.5mm s/d 3mm', 'Arctic MX-4 & MX-6 Paste', 'Alkohol IPA 99% & Flux Pasta Timah', 'Solder Timah Premium 60/40 & LeadFree'],
            ],
            [
                'kategori' => 'Periferal & Aksesori',
                'icon'     => 'fa-solid fa-keyboard',
                'color'    => 'from-violet-500 to-purple-600',
                'items'    => ['Mouse Wireless & Gaming Mechanical', 'Hub USB-C Multiport 7-in-1', 'Webcam Full HD 1080p', 'Stand Laptop Aluminium Adjustable', 'Kabel HDMI 2.1 & DisplayPort'],
            ],
        ];

        // FAQ cek tiket
        $faqs = [
            ['q' => 'Apakah bisa cek tiket tanpa login akun?',         'a' => 'Ya, cukup masukkan nomor tiket yang diterima via WhatsApp/email. Tidak diperlukan akun atau password apapun untuk melihat status servis Anda.'],
            ['q' => 'Berapa lama data tiket tersimpan di sistem?',      'a' => 'Data tiket servis tersimpan selama 2 tahun sejak unit selesai diambil, sehingga Anda bisa mengakses riwayat servis kapan saja untuk keperluan klaim garansi.'],
            ['q' => 'Bagaimana jika nomor tiket saya tidak ditemukan?', 'a' => 'Pastikan format penulisan benar (contoh: SRV-2026-0241). Jika masih tidak ditemukan, hubungi kasir via WhatsApp dengan menyebut nama & jenis unit Anda.'],
            ['q' => 'Kapan saya menerima notifikasi status berubah?',   'a' => 'Notifikasi WhatsApp dikirim otomatis saat status tiket berubah — mulai dari konfirmasi masuk unit, approval estimasi, selesai pengerjaan, hingga siap diambil.'],
            ['q' => 'Bisakah saya lihat foto pengerjaan unit saya?',    'a' => 'Ya! Teknisi mendokumentasikan kondisi sebelum & sesudah pengerjaan. Foto tersedia di detail tiket dan dikirimkan via WhatsApp saat unit selesai dikerjakan.'],
        ];

        return view('servicecenter.cek-tiket', compact(
            'center', 'cara_cek', 'status_list', 'produk_toko', 'faqs'
        ));
    }

    /**
     * Endpoint API JSON untuk cek tiket real-time
     */
    public function trackTicket(Request $request)
    {
        $code = strtoupper(trim($request->query('code', 'SRV-2026-0241')));

        // Mock response data realistis berdasarkan input tiket
        $tickets = [
            'SRV-2026-0241' => [
                'found'            => true,
                'kode'             => 'SRV-2026-0241',
                'customer'         => 'Bapak Hendra Wijaya',
                'unit'             => 'Laptop ASUS ROG Strix G15',
                'serial'           => 'SN: G513-QC8912',
                'keluhan'          => 'Mati total korsleting adaptor, indikator charging padam',
                'tindakan'         => 'Penggantian IC Power 3V & Reballing Jalur VCORE',
                'status'           => 'Sedang Diuji (Tahap 3)',
                'status_sub'       => 'Uji Tegangan Pas 100% & Stress-Test GPU/CPU',
                'progress'         => 75,
                'teknisi'          => 'Doni Pratama (Hardware Specialist)',
                'estimasi_selesai' => 'Hari ini, 17:00 WIB',
                'biaya_estimasi'   => 'Rp 650.000',
                'garansi'          => '90 Hari Resmi',
            ],
            'SRV-2026-0188' => [
                'found'            => true,
                'kode'             => 'SRV-2026-0188',
                'customer'         => 'Ibu Maya Lestari',
                'unit'             => 'MacBook Air M1 2020 Space Grey',
                'serial'           => 'SN: C02F876Q0',
                'keluhan'          => 'Keyboard tombol spasi & enter macet, baterai service recommended',
                'tindakan'         => 'Ganti Keyboard Original OEM & Baterai 4379mAh Baru',
                'status'           => 'Selesai QC & Siap Diambil di Kasir',
                'status_sub'       => 'Pemeriksaan tuntas 100%, nota & kartu garansi dicetak',
                'progress'         => 100,
                'teknisi'          => 'Budi Santoso (Apple Tech Specialist)',
                'estimasi_selesai' => 'Sudah Siap Diambil',
                'biaya_estimasi'   => 'Rp 1.250.000',
                'garansi'          => '180 Hari Resmi',
            ],
            'SRV-2026-0099' => [
                'found'            => true,
                'kode'             => 'SRV-2026-0099',
                'customer'         => 'Sdr. Kevin Anggara',
                'unit'             => 'PC Gaming Custom RTX 4070 Ti',
                'serial'           => 'SN: RIG-CUSTOM-99',
                'keluhan'          => 'Suhu CPU melonjak 98°C dan sering restart sendiri',
                'tindakan'         => 'Deep Cleaning, Repaste Thermal Grizzly & Ganti Liquid Cooler 240mm',
                'status'           => 'Menunggu Konfirmasi Approval Pelanggan',
                'status_sub'       => 'Estimasi biaya telah dikirimkan ke WhatsApp pelanggan',
                'progress'         => 40,
                'teknisi'          => 'Rian Firmansyah (Rig Builder)',
                'estimasi_selesai' => 'Besok, 14:00 WIB',
                'biaya_estimasi'   => 'Rp 850.000',
                'garansi'          => '360 Hari Resmi',
            ],
        ];

        if (isset($tickets[$code])) {
            return response()->json($tickets[$code]);
        }

        // Tiket umum sintetis jika nomor lain diinput
        return response()->json([
            'found'            => true,
            'kode'             => $code,
            'customer'         => 'Pelanggan Terdaftar',
            'unit'             => 'Laptop / Komputer Unit Terdaftar',
            'serial'           => 'SN: VERIFIED-DEVICE',
            'keluhan'          => 'Pemeriksaan berkala & perbaikan komponen hardware',
            'tindakan'         => 'Dalam penanganan teknisi lab Cabang Clean',
            'status'           => 'Sedang Dikerjakan oleh Teknisi',
            'status_sub'       => 'Pemeriksaan mikroskopik & kalibrasi tegangan listrik',
            'progress'         => 60,
            'teknisi'          => 'Tim Hardware Lab Cabang Clean',
            'estimasi_selesai' => 'Sesuai antrean teknisi',
            'biaya_estimasi'   => 'Dalam kalkulasi',
            'garansi'          => 'Garansi Servis Resmi',
        ]);
    }

    /**
     * Simpan booking servis cepat dari landing page
     */
    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:100',
            'telepon' => 'required|string|max:30',
            'unit'    => 'required|string|max:100',
            'keluhan' => 'required|string|max:500',
        ]);

        $randomTicket = 'SRV-' . date('Y') . '-' . str_pad(mt_rand(100, 999), 4, '0', STR_PAD_LEFT);

        return response()->json([
            'success' => true,
            'ticket'  => $randomTicket,
            'message' => 'Booking servis berhasil terdaftar! Nomor tiket sementara Anda: ' . $randomTicket,
        ]);
    }
}
