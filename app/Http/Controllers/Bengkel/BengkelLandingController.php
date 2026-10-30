<?php

namespace App\Http\Controllers\Bengkel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BengkelLandingController extends Controller
{
    /**
     * Tampilkan Landing Page Utama Bengkel (Customer Portal & Booking).
     * Disiapkan dengan struktur data yang bersih/kosong agar dapat diisi sendiri oleh pemilik.
     */
    public function index(Request $request)
    {
        // 1. Profil & Pengaturan Bengkel (Dapat diubah atau dihubungkan ke tabel settings/database)
        $workshop = [
            'name'           => 'L-GARAGE Workshop',
            'tagline'        => 'BENGKEL PRESISI MODERN BERSTANDAR OBD-II',
            'headline'       => 'Servis Mobil Cepat, Transparan, & Terpercaya',
            'headline_accent'=> 'Tanpa Antre Lama',
            'subheadline'    => 'Pantau pengerjaan unit Anda secara real-time. Bisa booking dan lacak langsung tanpa perlu login, atau masuk akun langganan untuk riwayat servis lengkap.',
            'jam_buka'       => '08:00 - 17:00 WIB',
            'status_bengkel' => 'BENGKEL BUKA • 1 STALL SIAP',
            'stall_terisi'   => 3,
            'stall_kapasitas'=> 4,
            'rata_durasi'    => '45 Menit',
            'no_darurat'     => '0800-1-LGARAGE',
            'no_whatsapp'    => '6281234567890',
            'alamat'         => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'maps_url'       => 'https://maps.google.com',
        ];

        // 2. Telemetry Live Feed Banner (Status Stall Real-time)
        $telemetry = [
            'title'       => 'Telemetry Diagnostic Live Feed',
            'detail'      => '4 Liter Oli Aktif • Sensor Kalibrasi Siap',
            'stall_ready' => 'STALL #4 READY',
        ];

        // 3. Ringkasan Angka / Key Metrics (Bisa diisi angka real bengkel Anda)
        $metrics = [
            'unit_terlayani'    => '12.400+',
            'kepuasan_pemilik'  => '99.4%',
            'garansi_servis'    => '30 Hari',
        ];

        // 4. Value Propositions (3 Pilar Kepercayaan)
        $values = [
            [
                'icon'  => 'fa-solid fa-oil-can',
                'title' => 'Oli Asli 100% Segel',
                'desc'  => 'Distribusi Resmi Shell, Motul, Mobil & Castrol',
            ],
            [
                'icon'  => 'fa-solid fa-microchip',
                'title' => 'Alat Scanner OBD-II',
                'desc'  => 'Deteksi error ECU presisi tanpa tebak-tebak',
            ],
            [
                'icon'  => 'fa-solid fa-file-invoice-dollar',
                'title' => 'Estimasi Biaya Di Muka',
                'desc'  => 'Persetujuan sebelum pengerjaan tambahan',
            ],
        ];

        // 5. Paket Servis Standar Presisi (Katalog yang siap diisi/disesuaikan)
        $packages = [
            [
                'id'          => 'express-pit',
                'badge'       => 'EXPRESS PIT',
                'badge_color' => 'blue',
                'durasi'      => '30 Mnt',
                'image'       => 'https://images.unsplash.com/photo-1486006920555-c77dce18193b?auto=format&fit=crop&w=800&q=80',
                'title'       => 'Paket Ganti Oli Express',
                'desc'        => 'Penggantian oli presisi dan pengecekan cepat 20 titik indikator keamanan kendaraan.',
                'cakupan'     => [
                    '4L Oli Full Sintetis 5W30/0W20',
                    'Penggantian Filter Oli OEM',
                    'Cek Komponen Vital 20 Titik',
                    'Top Up Air Wiper & Radiator',
                ],
                'harga'       => 'Rp 380.000',
                'harga_raw'   => 380000,
            ],
            [
                'id'          => 'servis-berkala',
                'badge'       => 'PALING DIREKOMENDASIKAN',
                'badge_color' => 'primary',
                'durasi'      => '75 Mnt',
                'image'       => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&w=800&q=80',
                'title'       => 'Servis Berkala 10K - 40K KM',
                'desc'        => 'Restorasi performa mesin, efisiensi bahan bakar, dan kalibrasi sensor berkala.',
                'cakupan'     => [
                    'Gurah Mesin (Carbon Cleaner)',
                    'Tune Up & Throttle Body Clean',
                    'Cek & Pembersihan Rem 4 Roda',
                    'Diagnostik Komputer OBD Telemetri',
                ],
                'harga'       => 'Rp 650.000',
                'harga_raw'   => 650000,
            ],
            [
                'id'          => 'spooring-3d',
                'badge'       => 'PRESISI GEOMETRI',
                'badge_color' => 'cyan',
                'durasi'      => '45 Mnt',
                'image'       => 'https://images.unsplash.com/photo-1578844251758-2f71da64c96f?auto=format&fit=crop&w=800&q=80',
                'title'       => 'Kaki-kaki & Spooring 3D',
                'desc'        => 'Menghilangkan stir getar, ban aus tidak rata, dan meningkatkan kestabilan laju.',
                'cakupan'     => [
                    'Spooring Komputer 3 Dimensi',
                    'Dynamic Wheel Balancing 4 Roda',
                    'Inspeksi Tie Rod, Bushing & Shock',
                    'Uji Jalan & Kalibrasi Stir',
                ],
                'harga'       => 'Rp 250.000',
                'harga_raw'   => 250000,
            ],
            [
                'id'          => 'ac-fogging',
                'badge'       => 'CABIN CLIMATE',
                'badge_color' => 'teal',
                'durasi'      => '40 Mnt',
                'image'       => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=800&q=80',
                'title'       => 'Perawatan AC & Fogging',
                'desc'        => 'Mengembalikan sirkulasi dingin optimal, bebas bakteri, bau apek, dan debu PM2.5.',
                'cakupan'     => [
                    'Cleaning Blower & Evaporator Tanpa Bongkar',
                    'Cek Tekanan Freon R134a/R1234yf',
                    'Fogging Antibakterial Herbal',
                    'Penggantian Filter Kabin Karbon',
                ],
                'harga'       => 'Rp 280.000',
                'harga_raw'   => 280000,
            ],
        ];

        // 6. Garansi & Fasilitas Kenyamanan
        $guarantees = [
            [
                'icon'  => 'fa-solid fa-shield-halved',
                'title' => 'Garansi 1.000 KM / 30 Hari',
                'desc'  => 'Jika timbul kendala pasca masa servis, unit dicek dan diperbaiki ulang tanpa biaya jasa tambahan.',
            ],
            [
                'icon'  => 'fa-solid fa-certificate',
                'title' => 'Suku Cadang OEM Terverifikasi',
                'desc'  => 'Jaminan 100% suku cadang asli pabrikan dengan barcode keaslian distributor resmi. Tidak ada part rekondisi.',
            ],
            [
                'icon'  => 'fa-solid fa-mug-saucer',
                'title' => 'Lounge Premium & Free WiFi',
                'desc'  => 'Tunggu mobil Anda dengan nyaman: ruang ber-AC bersih, kopi espresso gratis, stopkontak laptop, dan musholla.',
            ],
            [
                'icon'  => 'fa-solid fa-video',
                'title' => 'Live CCTV & Telemetri Pit Bay',
                'desc'  => 'Transparansi total. Anda bisa melihat mekanik bekerja lewat layar monitor lounge atau langsung via HP.',
            ],
        ];

        // 7. Testimonial Pelanggan
        $testimonials = [
            [
                'initial'   => 'AH',
                'name'      => 'Aditya Hendrawan',
                'vehicle'   => 'Honda CR-V Turbo',
                'badge'     => 'Member Garasi',
                'comment'   => 'Paling suka fitur live tracking tanpa login-nya. Waktu lagi ada meeting di kantor, tinggal buka HP dan ketik plat mobil, langsung tahu kalau kampas rem dan oli sudah selesai dikerjakan.',
            ],
            [
                'initial'   => 'RN',
                'name'      => 'Ratna Kusuma Dewi',
                'vehicle'   => 'Toyota Yaris Cross',
                'badge'     => 'Booking Tamu',
                'comment'   => 'Transparansi harganya juara. Tidak ada spare part siluman yang tiba-tiba ditagihkan di kasir. Mekanik minta konfirmasi foto dan estimasi harga dulu via WhatsApp sebelum ganti baut.',
            ],
            [
                'initial'   => 'BP',
                'name'      => 'Bambang Prasetyo',
                'vehicle'   => 'Mitsubishi Pajero Sport',
                'badge'     => 'Member Garasi',
                'comment'   => 'Spooring 3D dan balancing-nya sangat akurat. Stir yang tadinya narik ke kiri langsung lurus lempeng. Ruang tunggunya bersih, kopinya enak, mekanik komunikatif dan berwawasan luas.',
            ],
        ];

        // Status form awal (KOSONG sesuai request user, siap diisi)
        $searchPlate = trim($request->query('plat', ''));
        $trackResult = null;

        if ($searchPlate !== '') {
            $trackResult = $this->lookupPlateData($searchPlate);
        }

        return view('bengkel.landing', compact(
            'workshop',
            'telemetry',
            'metrics',
            'values',
            'packages',
            'guarantees',
            'testimonials',
            'searchPlate',
            'trackResult'
        ));
    }

    /**
     * Endpoint API / Form untuk Lacak Servis Berdasarkan Plat Nomor
     */
    public function lacak(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|string|max:15',
        ]);

        $plat = strtoupper(trim(str_replace([' ', '-', '.'], '', $request->input('plat_nomor'))));
        $data = $this->lookupPlateData($plat);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => $data['found'],
                'data'    => $data,
            ]);
        }

        return redirect()->route('bengkel.landing', ['plat' => $plat . '#lacak-section']);
    }

    /**
     * Endpoint Form Booking Servis Cepat / Mode Tamu
     */
    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'nama'         => 'required|string|max:100',
            'whatsapp'     => 'required|string|max:20',
            'plat_nomor'   => 'required|string|max:15',
            'merk_model'   => 'required|string|max:100',
            'paket_servis' => 'required|string|max:100',
            'tanggal'      => 'required|date',
            'jam'          => 'required|string',
            'catatan'      => 'nullable|string|max:500',
        ]);

        $bookingCode = 'BK-' . date('ymd') . '-' . rand(1000, 9999);

        // Format pesan WhatsApp ke admin bengkel
        $waAdmin = '6281234567890';
        $pesanWa = "Halo Tim L-Garage Workshop,%0A"
            . "Saya ingin mengonfirmasi booking servis berikut:%0A%0A"
            . "Kode Booking: " . $bookingCode . "%0A"
            . "Nama: " . urlencode($validated['nama']) . "%0A"
            . "No WA: " . urlencode($validated['whatsapp']) . "%0A"
            . "Plat Nomor: " . urlencode($validated['plat_nomor']) . "%0A"
            . "Kendaraan: " . urlencode($validated['merk_model']) . "%0A"
            . "Paket Servis: " . urlencode($validated['paket_servis']) . "%0A"
            . "Rencana Kunjungan: " . $validated['tanggal'] . " Pukul " . $validated['jam'] . "%0A"
            . "Catatan Keluhan: " . urlencode($validated['catatan'] ?? 'Tidak ada') . "%0A%0A"
            . "Mohon dikonfirmasi ketersediaan stall. Terima kasih.";

        $waUrl = "https://api.whatsapp.com/send?phone=" . $waAdmin . "&text=" . $pesanWa;

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'      => true,
                'message'      => 'Booking servis Anda berhasil didaftarkan!',
                'booking_code' => $bookingCode,
                'wa_url'       => $waUrl,
                'detail'       => $validated,
            ]);
        }

        return redirect()->route('bengkel.landing')
            ->with('success_booking', 'Booking berhasil! Kode Booking Anda: ' . $bookingCode)
            ->with('wa_redirect', $waUrl);
    }

    /**
     * Tampilkan Halaman Penuh "Booking Servis Cepat" (Sesuai Desain L-Garage Fast Lane)
     * Semua input dan form dibiarkan KOSONG agar dapat diisi sendiri oleh pengguna.
     */
    public function bookingPage(Request $request)
    {
        $workshop = [
            'name'           => 'L-GARAGE Workshop',
            'tagline'        => 'BENGKEL PRESISI MODERN BERSTANDAR OBD-II',
            'jam_buka'       => '08:00 - 17:00 WIB',
            'status_bengkel' => 'BENGKEL BUKA • 1 STALL SIAP',
            'stall_terisi'   => 3,
            'stall_kapasitas'=> 5,
            'rata_durasi'    => '45 Menit',
            'no_darurat'     => '0800-1-LGARAGE',
            'no_whatsapp'    => '6281234567890',
            'alamat'         => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'maps_url'       => 'https://maps.google.com',
        ];

        // 4 Kategori Servis & Keluhan yang dapat dipilih (Checkbox)
        $serviceOptions = [
            [
                'id'       => 'jasa_oli',
                'title'    => 'Ganti Oli Mesin & Filter OEM',
                'duration' => '45 Menit',
                'minutes'  => 45,
                'desc'     => 'Termasuk 4L Synthetic Oil, Washer Drain Plug baru, & 15-Point Safety Inspection.',
                'price'    => 485000,
                'price_fmt'=> 'Rp 485.000',
            ],
            [
                'id'       => 'jasa_berkala',
                'title'    => 'Servis Berkala Kelipatan 10K / 20K',
                'duration' => '90 Menit',
                'minutes'  => 90,
                'desc'     => 'Tune-up pembakaran, throttle body cleaner, pembersihan filter udara, reset ECU OBD-II.',
                'price'    => 375000,
                'price_fmt'=> 'Rp 375.000',
            ],
            [
                'id'       => 'jasa_kaki',
                'title'    => 'Pemeriksaan Kaki-Kaki & Rem',
                'duration' => '60 Menit',
                'minutes'  => 60,
                'desc'     => 'Brake pad cleaning, pengecekan ball joint, tie rod, bushing arm, rotasi roda.',
                'price'    => 190000,
                'price_fmt'=> 'Rp 190.000',
            ],
            [
                'id'       => 'jasa_ac',
                'title'    => 'Sistem AC & Kelistrikan / Aki',
                'duration' => '40 Menit',
                'minutes'  => 40,
                'desc'     => 'Cek tekanan freon R134a/1234yf, tes beban alternator, battery CCA conductance.',
                'price'    => 150000,
                'price_fmt'=> 'Rp 150.000',
            ],
        ];

        // 7 Hari Kedatangan Dinamis (Hari ini, Besok, Favorit, dll)
        $days = [];
        $now = \Carbon\Carbon::now();
        $hariIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        for ($i = 0; $i < 7; $i++) {
            $dt = $now->copy()->addDays($i);
            $dayOfWeek = $hariIndo[$dt->dayOfWeek];
            $badge = $i === 0 ? 'Hari ini' : ($i === 1 ? 'Besok' : ($i === 2 ? 'Favorit' : ($dt->dayOfWeek === 0 ? 'Buka' : 'Leluasa')));

            $days[] = [
                'val'       => $dt->format('Y-m-d'),
                'day_name'  => strtoupper($dayOfWeek),
                'day_num'   => $dt->format('d'),
                'badge'     => $badge,
                'is_active' => $i === 0,
            ];
        }

        // Pilihan Jam Kedatangan (Live Bay Dispatch)
        $timeSlots = [
            ['time' => '08:30 WIB', 'badge' => 'STALL 2 SIAP', 'ready' => true, 'disabled' => false],
            ['time' => '09:30 WIB', 'badge' => 'TERSEDIA', 'ready' => false, 'disabled' => false],
            ['time' => '11:00 WIB', 'badge' => 'SISA 1 SLOT', 'ready' => false, 'disabled' => false],
            ['time' => '13:30 WIB', 'badge' => 'PENUH', 'ready' => false, 'disabled' => true],
        ];

        // Daftar Merek Mobil Populer
        $carBrands = [
            'Toyota', 'Honda', 'Daihatsu', 'Mitsubishi', 'Suzuki',
            'Hyundai', 'Nissan', 'Wuling', 'Mazda', 'BMW', 'Mercedes-Benz', 'Kia', 'Lainnya'
        ];

        return view('bengkel.booking_cepat', compact(
            'workshop',
            'serviceOptions',
            'days',
            'timeSlots',
            'carBrands'
        ));
    }

    /**
     * Tampilkan Halaman Penuh "Live Tracking Servis" (Sesuai Desain L-Garage Workshop Telemetri)
     * Form pencarian dan status awal dibiarkan KOSONG agar pengguna dapat mengisi sendiri plat nomornya.
     */
    public function trackingPage(Request $request)
    {
        $workshop = [
            'name'           => 'L-GARAGE Workshop',
            'tagline'        => 'BENGKEL PRESISI MODERN BERSTANDAR OBD-II',
            'jam_buka'       => '08:00 - 17:00 WIB',
            'status_bengkel' => 'BENGKEL BUKA • 1 STALL SIAP',
            'stall_terisi'   => 3,
            'stall_kapasitas'=> 5,
            'rata_durasi'    => '45 Menit',
            'no_darurat'     => '0800-1-LGARAGE',
            'no_whatsapp'    => '6281234567890',
            'alamat'         => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'maps_url'       => 'https://maps.google.com',
        ];

        // Query Plat atau No SPK (Default KOSONG sesuai request user)
        $query = trim($request->query('plat', $request->query('spk', '')));
        $tracking = null;

        if ($query !== '') {
            $tracking = $this->getDetailedTracking($query);
        }

        return view('bengkel.tracking', compact('workshop', 'query', 'tracking'));
    }

    /**
     * Data Detail Lengkap Telemetri & SPK Digital Live Tracking
     */
    public function getDetailedTracking(string $rawQuery): array
    {
        $clean = strtoupper(trim(str_replace([' ', '-', '.'], '', $rawQuery)));

        // Demo sample yang persis dengan screenshot (B 1982 SYZ / WO-2024-10-8839)
        if ($clean === 'B1982SYZ' || $clean === 'WO2024108839' || str_contains($clean, '1982') || str_contains($clean, 'FORTUNER') || $clean === 'DEMO') {
            return [
                'found'            => true,
                'plat'             => 'B 1982 SYZ',
                'wo_number'        => 'WO-2024-10-8839',
                'vehicle_title'    => 'Toyota Fortuner 2.8 VRZ AT (2022)',
                'owner_name'       => 'Bambang Sutedjo',
                'access_status'    => 'Tamu Terverifikasi (OTP WhatsApp)',
                'service_category' => 'Periodik 40.000 KM',
                'service_advisor'  => [
                    'name'     => 'Dimas Prasetyo',
                    'initial'  => 'DP',
                    'wa_link'  => 'https://api.whatsapp.com/send?phone=6281234567890&text=Halo%20Mas%20Dimas,%20saya%20pemilik%20Fortuner%20B%201982%20SYZ',
                ],
                'lead_mechanic'    => [
                    'name'  => 'Joko Pratama',
                    'stall' => 'Stall 03 (Two-Post Lift)',
                ],
                'odometer'         => [
                    'km'      => '42.150 KM',
                    'checkin' => 'Hari ini 09.15 WIB',
                ],
                'telemetry'        => [
                    'stall_name'      => 'PIT Bay 03 Live Progress',
                    'percentage'      => 50,
                    'elapsed_minutes' => '45 Menit',
                    'estimated_target'=> '1 Jam 30 Menit (10:45 WIB)',
                ],
                'workflow_stages'  => [
                    [
                        'step_num' => 1,
                        'time'     => '09:30 WIB',
                        'title'    => 'Unit Diterima',
                        'desc'     => 'Check-in, serah kunci, dan inspeksi fisik 24 titik.',
                        'status'   => 'selesai',
                        'badge'    => 'TAHAP 1 • SELESAI',
                    ],
                    [
                        'step_num' => 2,
                        'time'     => '09:45 WIB',
                        'title'    => 'Diagnosa & SA SPK',
                        'desc'     => 'Scan OBD Industrial & penetapan paket servis berkala.',
                        'status'   => 'selesai',
                        'badge'    => 'TAHAP 2 • SELESAI',
                    ],
                    [
                        'step_num' => 3,
                        'time'     => 'PIT Bay 03',
                        'title'    => 'Pengerjaan Stall',
                        'desc'     => 'Ganti oli mesin synthetic, filter solar, tune-up injector.',
                        'status'   => 'aktif',
                        'badge'    => 'TAHAP 3 • BERLANGSUNG',
                    ],
                    [
                        'step_num' => 4,
                        'time'     => 'AKSI ANDA',
                        'title'    => 'Persetujuan Tambahan',
                        'desc'     => 'Mekanik menemukan keausan kampas rem depan kritis.',
                        'status'   => 'warning',
                        'badge'    => 'TAHAP 4 • BUTUH RESPON',
                    ],
                    [
                        'step_num' => 5,
                        'time'     => 'Menunggu',
                        'title'    => 'Final QC & Ambil',
                        'desc'     => 'Pencucian unit, checklist QC oleh SA, dan billing kasir.',
                        'status'   => 'menunggu',
                        'badge'    => 'TAHAP 5 • TERAKHIR',
                    ],
                ],
                'inspection_alert' => [
                    'title'          => 'Temuan Inspeksi Membutuhkan Persetujuan Anda',
                    'subtitle'       => 'Mekanik Joko Pratama menemukan keausan komponen di luar estimasi awal paket servis berkala.',
                    'status_badge'   => 'PENDING RESPON PELANGGAN',
                    'image'          => 'https://images.unsplash.com/photo-1578844251758-2f71da64c96f?auto=format&fit=crop&w=800&q=80',
                    'measure_badge'  => 'Hasil Ukur: 1.8 mm (Kritis)',
                    'tolerance_badge'=> 'Toleransi Minimum: 2.5 mm',
                    'timestamp'      => '10:14:22 WIB',
                    'mechanic_quote' => 'Ketebalan kampas rem depan kiri & kanan tersisa 1.8mm. Berisiko menggores piringan disc brake dan mengurangi jarak pengereman darurat.',
                    'actions'        => [
                        [
                            'type'     => 'PART',
                            'name'     => 'Kampas Rem Depan Bendix Heavy Duty (1 Set)',
                            'spec'     => 'Genuine Ceramic Compound • Part No: DB1774-HD',
                            'price'    => 'Rp 850.000',
                            'price_raw'=> 850000,
                            'subtext'  => 'Garansi 6 Bulan',
                        ],
                        [
                            'type'     => 'JASA',
                            'name'     => 'Jasa Pasang & Bleeding Minyak Rem Caliper',
                            'spec'     => 'Termasuk pembersihan kaliper rem & pelumasan slide pin',
                            'price'    => 'Rp 150.000',
                            'price_raw'=> 150000,
                            'subtext'  => 'Estimasi +20 Menit',
                        ],
                    ],
                    'total_penambahan' => 'Rp 1.000.000',
                ],
                'invoice_items'    => [
                    [
                        'desc'     => 'Paket Servis Berkala 40.000 KM',
                        'subdesc'  => 'General inspection 24 titik, pembersihan busi & throttle body',
                        'qty'      => '1 Paket',
                        'price'    => 'Rp 450.000',
                        'subtotal' => 'Rp 450.000',
                        'is_extra' => false,
                    ],
                    [
                        'desc'     => 'Motul Fully Synthetic CRDi 5W-40',
                        'subdesc'  => 'Oli mesin diesel modern Euro 4/5 (Original drum)',
                        'qty'      => '7 Liter',
                        'price'    => 'Rp 175.000',
                        'subtotal' => 'Rp 1.225.000',
                        'is_extra' => false,
                    ],
                    [
                        'desc'     => 'Filter Oli Toyota Genuine Parts (23390-YZZA1)',
                        'subdesc'  => 'OEM Toyota Motor Corporation',
                        'qty'      => '1 Pcs',
                        'price'    => 'Rp 95.000',
                        'subtotal' => 'Rp 95.000',
                        'is_extra' => false,
                    ],
                    [
                        'desc'     => 'Cairan Pembersih Brake & Parts Cleaner 500ml',
                        'subdesc'  => 'Wurth Industrial Grade',
                        'qty'      => '1 Can',
                        'price'    => 'Rp 60.000',
                        'subtotal' => 'Rp 60.000',
                        'is_extra' => false,
                    ],
                    [
                        'desc'     => '(+) Tambahan: Kampas Rem Depan Bendix HD + Jasa Pasang',
                        'subdesc'  => 'Menunggu persetujuan pemilik kendaraan',
                        'qty'      => '1 Paket',
                        'price'    => 'Rp 1.000.000',
                        'subtotal' => 'Rp 1.000.000',
                        'is_extra' => true,
                    ],
                ],
                'billing_summary'  => [
                    'subtotal_jasa'   => 'Rp 600.000',
                    'subtotal_part'   => 'Rp 2.170.000',
                    'diskon_promo'    => '- Rp 140.000',
                    'ppn_nominal'     => 'Rp 289.300',
                    'total_estimasi'  => 'Rp 2.919.300',
                ],
            ];
        }

        // Jika plat tidak ditemukan (Clean / Empty state)
        return [
            'found'   => false,
            'query'   => $rawQuery,
            'message' => 'Tidak ditemukan riwayat pengerjaan aktif dengan plat nomor atau nomor SPK "' . $rawQuery . '". Pastikan nomor yang dimasukkan sudah terdaftar di sistem bengkel hari ini.',
        ];
    }

    /**
     * Helper Simulasi / Query Data Plat Nomor (Siap dihubungkan ke Database Servis)
     */
    private function lookupPlateData(string $rawPlate): array
    {
        $clean = strtoupper(trim(str_replace([' ', '-', '.'], '', $rawPlate)));

        // Demo sample yang cocok dengan screenshot (B 1982 SYZ)
        if ($clean === 'B1982SYZ') {
            return [
                'found'          => true,
                'plat_formatted' => 'B 1982 SYZ',
                'model'          => 'Toyota Innova Zenix 2.0 V CVT',
                'pemilik'        => 'Mode Tamu / Hendra P.',
                'stall'          => 'Stall #2 (Pit Express & Telemetri)',
                'mekanik'        => 'Reza Kurniawan (ASE Certified)',
                'paket'          => 'Servis Berkala 20.000 KM + Tune Up',
                'status'         => 'Sedang Dikerjakan',
                'status_code'    => 'in_progress',
                'progress'       => 68,
                'waktu_masuk'    => '14:15 WIB',
                'estimasi_selesai'=>'15:30 WIB (Sisa ±35 menit)',
                'obd_telemetry'  => [
                    'ecm_status'    => 'Healthy / DTC Clear (0 Codes)',
                    'battery_health'=> '12.6V (100% OK)',
                    'brake_pad'     => 'Depan: 8mm, Belakang: 7mm (Aman)',
                    'oil_condition' => 'Fresh 0W-20 Full Synthetic (Level 100%)',
                ],
                'tahapan'        => [
                    ['label' => 'Check-in & Inspeksi 20 Titik', 'status' => 'selesai'],
                    ['label' => 'Kuras Oli Mesin & Ganti Filter OEM', 'status' => 'selesai'],
                    ['label' => 'Gurah Mesin & Tune Up Throttle', 'status' => 'aktif'],
                    ['label' => 'Spooring 3D & Uji Jalan Akhir', 'status' => 'menunggu'],
                    ['label' => 'Pembersihan Kabin & Serah Terima Unit', 'status' => 'menunggu'],
                ],
                'estimasi_biaya' => 'Rp 650.000',
            ];
        }

        // Jika plat tidak ditemukan (Clean / Empty State)
        return [
            'found'          => false,
            'plat_formatted' => $rawPlate,
            'message'        => 'Tidak ditemukan unit dengan plat nomor "' . $rawPlate . '" dalam antrean pengerjaan hari ini. Silakan periksa kembali nomor plat atau jadwalkan booking baru.',
        ];
    }

    /**
     * Tampilkan Halaman Garasi Saya (Member) — Dashboard Telemetri & Rekam Medis Kendaraan.
     * Secara default disajikan dengan DATA KOSONG sesuai request user,
     * serta dilengkapi opsi pratinjau data demo (Agus Setiawan - Innova Zenix & HR-V) sesuai screenshot desain.
     */
    public function garasiPage(Request $request)
    {
        $workshop = [
            'name'           => 'L-GARAGE Workshop',
            'tagline'        => 'BENGKEL PRESISI MODERN BERSTANDAR OBD-II',
            'jam_buka'       => '08:00 - 17:00 WIB',
            'status_bengkel' => 'BENGKEL BUKA • 1 STALL SIAP',
            'stall_terisi'   => 3,
            'stall_kapasitas'=> 5,
            'rata_durasi'    => '45 Menit',
            'no_darurat'     => '0800-1-LGARAGE',
            'no_whatsapp'    => '6281234567890',
            'alamat'         => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'maps_url'       => 'https://maps.google.com',
        ];

        // Status demo: Default FALSE (Data Kosong sesuai instruksi)
        $isDemo = $request->has('demo') && in_array(strtolower($request->query('demo')), ['1', 'true', 'yes', 'demo']);

        // 1. Data Profil Member
        $member = $isDemo ? [
            'name'        => 'Agus Setiawan',
            'initial'     => 'AS',
            'tier'        => 'MEMBER GOLD L-GARAGE',
            'since'       => 'Februari 2023',
            'member_id'   => 'LG-JKT-88902',
            'points'      => 1250,
            'points_fmt'  => '1.250 Pts',
            'discount_eq' => 'Rp 125.000 Diskon',
            'phone'       => '0812-****-4491',
        ] : null;

        // 2. Voucher & Benefit Member
        $vouchers = $isDemo ? [
            [
                'id'       => 'v-10',
                'type'     => 'kupon',
                'badge'    => 'VOUCHER KUPON',
                'title'    => 'Diskon Servis 10%',
                'desc'     => 'Berlaku untuk Jasa Servis & Tune Up • Exp: 30 Des 2025',
                'button'   => 'Gunakan',
                'btn_bg'   => 'bg-slate-900 hover:bg-slate-800 text-white',
                'icon'     => 'fa-solid fa-percent',
                'icon_bg'  => 'bg-slate-900 text-white',
            ],
            [
                'id'       => 'v-spoor',
                'type'     => 'benefit',
                'badge'    => 'BENEFIT MEMBER',
                'title'    => 'Gratis Spooring Roda 3D',
                'desc'     => '1x penukaran garansi kalibrasi sudut suspensi',
                'button'   => 'Klaim',
                'btn_bg'   => 'bg-blue-600 hover:bg-blue-700 text-white',
                'icon'     => 'fa-solid fa-gift',
                'icon_bg'  => 'bg-blue-600 text-white',
            ],
        ] : [];

        // 3. Armada Terdaftar (Garasi Unit Aktif)
        $vehicles = $isDemo ? [
            [
                'id'            => 'zenix',
                'is_selected'   => true,
                'category'      => 'MPV PREMIUM • TRANSMISI CVT',
                'brand'         => 'Toyota',
                'name'          => 'Toyota Innova Zenix 2.0 V',
                'chassis'       => 'Nomor Rangka: MHFA40G29P0021948',
                'plate'         => 'B 1408 WKR',
                'odometer'      => '39.850 KM',
                'odometer_raw'  => 39850,
                'year'          => '2023',
                'last_service'  => '15 Jan 2025',
                'status_action' => 'Dipantau Aktif →',
                'obd_connected' => true,
                'image'         => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'id'            => 'hrv',
                'is_selected'   => false,
                'category'      => 'COMPACT SUV',
                'brand'         => 'Honda',
                'name'          => 'Honda HR-V 1.5 SE CVT',
                'chassis'       => 'Nomor Rangka: MHRRU1870NP102941',
                'plate'         => 'B 2099 JKP',
                'odometer'      => '24.120 KM',
                'odometer_raw'  => 24120,
                'year'          => '2022',
                'status_sensor' => 'Semua Sensor Normal (Siap Pakai)',
                'image'         => 'https://images.unsplash.com/photo-1590362891988-f778047831d6?auto=format&fit=crop&w=800&q=80',
            ],
        ] : [];

        $activeVehicle = $isDemo && !empty($vehicles) ? $vehicles[0] : null;

        // 4. Telemetri Wear & Tear (Rekam Medis Komponen)
        $telemetry = $isDemo ? [
            'vehicle_summary' => 'Data kalkulasi berdasarkan kilometer berjalan aktual Innova Zenix (B 1408 WKR) • 39.850 KM',
            'wa_reminder'     => [
                'active'    => true,
                'target_km' => '40.000 KM',
                'est_time'  => 'Est. 3 Hari ke depan',
                'phone'     => '0812-****-4491',
                'trigger'   => 'Trigger: ODO >= 40.000 KM',
            ],
            'components'      => [
                [
                    'id'          => 'oli',
                    'title'       => 'Oli Mesin (TMO Full Syn)',
                    'spec'        => 'Viskositas SAE 0W-20 SN GF-5',
                    'badge'       => 'PERLU GANTI SEGERA',
                    'badge_color' => 'red',
                    'progress_km' => '4.850 / 5.000 KM',
                    'percentage'  => 97,
                    'bar_color'   => 'bg-rose-500',
                    'alert_text'  => 'Sisa 150 KM / Waktunya Ganti Oli!',
                    'footer_info' => 'Stall Rekomendasi: PIT Bay Express 01',
                    'icon'        => 'fa-solid fa-oil-can',
                ],
                [
                    'id'          => 'filter',
                    'title'       => 'Filter Udara & Kabin',
                    'spec'        => 'Denso Air Clean Technology',
                    'badge'       => 'CEK BERKALA',
                    'badge_color' => 'blue',
                    'progress_km' => '9.850 / 10.000 KM',
                    'percentage'  => 98.5,
                    'bar_color'   => 'bg-blue-600',
                    'alert_text'  => 'Rekomendasi ganti pada servis berikutnya (Est. 40.000 KM)',
                    'footer_info' => 'Kesiapan Part: Tersedia di Gudang (28 pcs)',
                    'icon'        => 'fa-solid fa-wind',
                ],
                [
                    'id'          => 'rem',
                    'title'       => 'Kampas Rem Depan & Belakang',
                    'spec'        => 'OEM Akebono High-Heat Friction',
                    'badge'       => 'KONDISI PRIMA',
                    'badge_color' => 'blue',
                    'gauge_val'   => '7.2 mm',
                    'gauge_text'  => 'Ketebalan: 7.2 mm (Batas minimum pabrikan: 2.0 mm)',
                    'alert_text'  => 'Kondisi Baik • Aman hingga interval 60.000 KM',
                    'footer_info' => 'Inspeksi Fisik: 15 Jan 2025',
                    'icon'        => 'fa-solid fa-circle-dot',
                ],
                [
                    'id'          => 'aki',
                    'title'       => 'Aki Kering (MF Battery)',
                    'spec'        => 'GS Astra MF 55D23L (12V 60Ah)',
                    'badge'       => 'OPTIMAL',
                    'badge_color' => 'blue',
                    'gauge_val'   => '12.6 Volt',
                    'age_text'    => 'Usia: 14 Bulan',
                    'alert_text'  => 'Output alternator & CCA (Cold Cranking) stabil',
                    'footer_info' => 'Garansi Aki: Aktif s/d Nov 2025',
                    'icon'        => 'fa-solid fa-car-battery',
                ],
            ],
        ] : null;

        // 5. Riwayat Servis Lengkap (Audit Log • Cloud Verified)
        $serviceHistory = $isDemo ? [
            [
                'id'          => 'SRV-20250115',
                'date_day'    => '15',
                'date_month'  => 'JAN',
                'date_year'   => '2025',
                'odometer'    => '35.000 KM',
                'title'       => 'Servis Berkala 35.000 KM (Paket Gold)',
                'stall'       => 'PIT Bay 02',
                'job_details' => 'Ganti Oli Mesin TMO 0W-20 (4 Liter), Gasket Plug Karter, Filter Oli Denso OEM, Pembersihan Rem 4 Roda & OBD Scanning.',
                'mechanic'    => 'Aris Subagjo',
                'duration'    => '48 Menit',
                'total_cost'  => 'Rp 890.000',
                'payment'     => 'Lunas • Transfer QRIS',
                'category'    => 'berkala',
            ],
            [
                'id'          => 'SRV-20240812',
                'date_day'    => '12',
                'date_month'  => 'AGU',
                'date_year'   => '2024',
                'odometer'    => '29.400 KM',
                'title'       => 'Tune Up & Penggantian Busi Iridium',
                'stall'       => 'PIT Bay 04',
                'job_details' => 'Tune Up Combustion Chamber Cleaner, Penggantian 4 pcs Busi Denso Iridium Tough, Pembersihan Throttle Body & Kalibrasi Idle ECU.',
                'mechanic'    => 'Doni Kurniawan',
                'duration'    => '1 Jam 15 Menit',
                'total_cost'  => 'Rp 1.150.000',
                'payment'     => 'Lunas • Debit BCA',
                'category'    => 'berat',
            ],
            [
                'id'          => 'SRV-20240204',
                'date_day'    => '04',
                'date_month'  => 'FEB',
                'date_year'   => '2024',
                'odometer'    => '20.150 KM',
                'title'       => 'Servis Berkala 20.000 KM & Spooring 3D Hunter',
                'stall'       => 'Bay Alignment 01',
                'job_details' => 'Ganti Oli Mesin TMO, Filter AC Kabin, Kalibrasi Camber Caster Toe 3D Hunter Alignment, Rotasi 4 Roda & Balancing Dinamis.',
                'mechanic'    => 'Bambang Tri',
                'duration'    => '1 Jam 05 Menit',
                'total_cost'  => 'Rp 980.000',
                'payment'     => 'Lunas • Virtual Account',
                'category'    => 'spooring',
            ],
        ] : [];

        return view('bengkel.garasi', compact(
            'workshop',
            'isDemo',
            'member',
            'vouchers',
            'vehicles',
            'activeVehicle',
            'telemetry',
            'serviceHistory'
        ));
    }

    /**
     * Tampilkan Halaman Status Ketersediaan Stall & Antrean PIT Bay Hari Ini
     * Route: /bengkel/stall
     * Default: DATA KOSONG (clean state) sesuai request user,
     * serta dilengkapi opsi pratinjau data demo (3 Stall Terisi, 1 Standby Fast-Lane, CCTV & Analitik).
     */
    public function stallPage(Request $request)
    {
        $isDemo = $request->has('demo') && in_array(strtolower($request->query('demo')), ['1', 'true', 'yes', 'demo']);

        $workshop = [
            'name'           => 'L-GARAGE Workshop',
            'tagline'        => 'BENGKEL PRESISI MODERN BERSTANDAR OBD-II',
            'jam_buka'       => '08:00 - 17:00 WIB',
            'status_bengkel' => $isDemo ? 'BENGKEL BUKA • 1 STALL SIAP' : 'BENGKEL BUKA • 4 STALL TERSEDIA',
            'stall_terisi'   => $isDemo ? 3 : 0,
            'stall_kapasitas'=> 4,
            'rata_durasi'    => '45 Menit',
            'no_darurat'     => '0800-1-LGARAGE',
            'no_whatsapp'    => '6281234567890',
            'alamat'         => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'maps_url'       => 'https://maps.google.com',
        ];

        // 1. Top 4 Metric Cards
        $metrics = $isDemo ? [
            'stall_val'       => '1 / 4',
            'stall_badge'     => 'SIAP PAKAI',
            'stall_sub'       => '3 Lift aktif berjalan, 1 Lift siap masuk',
            'wait_val'        => '0',
            'wait_unit'       => 'Menit',
            'wait_sub'        => 'Langsung masuk ke PIT 04 saat tiba',
            'wait_badge'      => 'ZERO QUEUE GATE OPEN',
            'tech_val'        => '2',
            'tech_unit'       => 'Teknisi',
            'tech_sub'        => 'Lead Fast-Track & Diagnostic Tech',
            'tech_note'       => 'Siap inspeksi pra-servis',
            'avg_val'         => '35–45',
            'avg_unit'        => 'Menit',
            'avg_sub'         => 'Standar servis berkala express',
            'avg_note'        => 'Target SLA Turnaround 98.4%',
        ] : [
            'stall_val'       => '4 / 4',
            'stall_badge'     => 'SEMUA TERSEDIA',
            'stall_sub'       => '0 Lift berjalan, 4 Lift siap melayani',
            'wait_val'        => '0',
            'wait_unit'       => 'Menit',
            'wait_sub'        => 'Seluruh stall siap menerima kendaraan',
            'wait_badge'      => 'ZERO QUEUE • JALUR BEBAS',
            'tech_val'        => '4',
            'tech_unit'       => 'Teknisi',
            'tech_sub'        => 'Seluruh tim teknisi siap bertugas',
            'tech_note'       => 'Siap inspeksi pra-servis kilat',
            'avg_val'         => '0',
            'avg_unit'        => 'Menit',
            'avg_sub'         => 'Belum ada antrean pengerjaan',
            'avg_note'        => 'Target SLA Turnaround 100%',
        ];

        // 2. Data Live Floor Bay Monitor (Stall 01 - 04)
        $stalls = $isDemo ? [
            [
                'id'              => 'pit-01',
                'name'            => 'PIT 01',
                'type'            => 'Two-Post Lift',
                'status'          => 'TERISI',
                'status_type'     => 'busy',
                'plate'           => 'B 1982 SYZ',
                'progress'        => 75,
                'vehicle'         => 'Toyota Fortuner 2.8 VRZ',
                'service'         => 'Servis Berkala & Ganti Kampas Rem Depan-Belakang',
                'mechanic'        => 'Joko Pratama',
                'est_remaining'   => '~18 Menit',
                'stage'           => 'Bleeding Minyak Rem',
                'duration'        => '38/50 Mnt',
                'footer_sensor'   => 'Telemetry Lift Sensor',
                'footer_status'   => 'LIFTED 1.85m',
                'footer_badge'    => 'text-blue-600',
            ],
            [
                'id'              => 'pit-02',
                'name'            => 'PIT 02',
                'type'            => 'Scissor Lift 3D',
                'status'          => 'TERISI',
                'status_type'     => 'busy',
                'plate'           => 'B 9912 WQ',
                'progress'        => 40,
                'vehicle'         => 'Honda HR-V 1.5 RS Turbo',
                'service'         => 'Spooring Computerized 3D & Balancing 4 Roda',
                'mechanic'        => 'Rian Wahyudi',
                'est_remaining'   => '~32 Menit',
                'stage'           => 'Kalibrasi Sudut Camber',
                'duration'        => '15/45 Mnt',
                'footer_sensor'   => 'Laser Alignment',
                'footer_status'   => 'CALIBRATING',
                'footer_badge'    => 'text-blue-600',
            ],
            [
                'id'              => 'pit-03',
                'name'            => 'PIT 03',
                'type'            => 'Four-Post Lift',
                'status'          => 'SEGERA KOSONG',
                'status_type'     => 'soon',
                'plate'           => 'B 1408 WKR',
                'progress'        => 85,
                'vehicle'         => 'Innova Zenix 2.0 V',
                'service'         => 'Tune Up Mesin & Penggantian Filter Udara/Kabin',
                'mechanic'        => 'Budi Santoso',
                'est_remaining'   => '~10 Menit',
                'stage'           => 'Final Diagnostic Scan',
                'duration'        => '42/50 Mnt',
                'footer_sensor'   => 'Alur Lanjutan',
                'footer_status'   => 'QC & CUCI MOBIL',
                'footer_badge'    => 'text-slate-800 font-bold',
            ],
            [
                'id'              => 'pit-04',
                'name'            => 'PIT 04',
                'type'            => 'Express Service Bay',
                'status'          => 'STANDBY',
                'status_type'     => 'standby',
                'is_standby'      => true,
                'badge_top'       => 'SIAP CHECK-IN SEKARANG',
                'banner_title'    => 'FAST-LANE READY',
                'banner_desc'     => 'Stall Kosong & Alat Dikalibrasi. Lift hidrolik turun level 0, OBD-II telemetry scanner terhubung, toolset lengkap.',
                'mechanic'        => 'Dimas Prasetyo (Lead Fast-Track)',
                'entry_time'      => 'Langsung (0 Menit)',
                'hold_duration'   => '14:58 (Tahan Slot)',
            ],
        ] : [
            [
                'id'              => 'pit-01',
                'name'            => 'PIT 01',
                'type'            => 'Two-Post Lift',
                'status'          => 'KOSONG',
                'status_type'     => 'empty',
                'is_empty'        => true,
                'desc'            => 'Two-post hydraulic lift siap digunakan. Sensor posisi turun ke level 0. Belum ada antrean kendaraan.',
                'sensor_status'   => 'LEVEL 0.00m • READY',
            ],
            [
                'id'              => 'pit-02',
                'name'            => 'PIT 02',
                'type'            => 'Scissor Lift 3D',
                'status'          => 'KOSONG',
                'status_type'     => 'empty',
                'is_empty'        => true,
                'desc'            => 'Scissor lift & sensor Hunter 3D kamera siap kalibrasi geometri suspensi dan balancing roda.',
                'sensor_status'   => 'OPTICAL CAM STANDBY',
            ],
            [
                'id'              => 'pit-03',
                'name'            => 'PIT 03',
                'type'            => 'Four-Post Lift',
                'status'          => 'KOSONG',
                'status_type'     => 'empty',
                'is_empty'        => true,
                'desc'            => 'Four-post lift heavy-duty siap melayani inspeksi kaki-kaki, tune up, atau servis transmisi.',
                'sensor_status'   => 'RUNWAYS LEVEL • READY',
            ],
            [
                'id'              => 'pit-04',
                'name'            => 'PIT 04',
                'type'            => 'Express Service Bay',
                'status'          => 'KOSONG',
                'status_type'     => 'empty',
                'is_empty'        => true,
                'desc'            => 'Fast-lane pit bay siap menerima servis kilat tanpa antre: ganti oli, filter, atau scan OBD telemetri.',
                'sensor_status'   => 'FAST-LANE OPEN',
            ],
        ];

        // 3. Analisis Waktu Tunggu Real-Time (Grafik Kepadatan Jam Operasional)
        $hourlyLoad = $isDemo ? [
            [
                'time'       => '08:00 – 10:00',
                'badge'      => 'SEKARANG',
                'status'     => 'SENGGANG (OPTIMAL)',
                'desc'       => '1 Stall langsung siap tanpa antrean walk-in.',
                'percent'    => 35,
                'bar_color'  => 'bg-blue-600',
                'status_col' => 'text-blue-700',
            ],
            [
                'time'       => '10:00 – 12:00',
                'badge'      => null,
                'status'     => 'MULAI PADAT',
                'desc'       => 'Unit booking pagi mulai masuk area lift inspeksi.',
                'percent'    => 75,
                'bar_color'  => 'bg-slate-700',
                'status_col' => 'text-slate-800',
            ],
            [
                'time'       => '12:00 – 13:00',
                'badge'      => null,
                'status'     => 'ISTIRAHAT BERGILIR',
                'desc'       => '2 Stall fast-track tetap beroperasi secara rotasi.',
                'percent'    => 50,
                'bar_color'  => 'bg-blue-400',
                'status_col' => 'text-slate-800',
            ],
            [
                'time'       => '13:00 – 15:00',
                'badge'      => null,
                'status'     => 'KEPADATAN TINGGI',
                'desc'       => 'Slot bay penuh, estimasi waktu tunggu walk-in 30–45 mnt.',
                'percent'    => 95,
                'bar_color'  => 'bg-rose-600',
                'status_col' => 'text-rose-600',
            ],
            [
                'time'       => '15:00 – 17:00',
                'badge'      => null,
                'status'     => 'MODERAT & DELIVERY',
                'desc'       => 'Fase finishing, quality-check, cuci, & serah terima.',
                'percent'    => 60,
                'bar_color'  => 'bg-slate-700',
                'status_col' => 'text-slate-800',
            ],
        ] : [
            [
                'time'       => '08:00 – 10:00',
                'badge'      => 'SEKARANG',
                'status'     => 'SENGGANG (OPTIMAL)',
                'desc'       => 'Semua 4 stall kosong, pengerjaan dapat langsung dimulai.',
                'percent'    => 0,
                'bar_color'  => 'bg-blue-600',
                'status_col' => 'text-blue-700',
            ],
            [
                'time'       => '10:00 – 12:00',
                'badge'      => null,
                'status'     => 'TERSEDIA LEGA',
                'desc'       => 'Jalur booking dan walk-in terbuka lebar.',
                'percent'    => 0,
                'bar_color'  => 'bg-slate-300',
                'status_col' => 'text-slate-500',
            ],
            [
                'time'       => '12:00 – 13:00',
                'badge'      => null,
                'status'     => 'OPERASIONAL AKTIF',
                'desc'       => 'Teknisi standby melayani pergantian oli & servis kilat.',
                'percent'    => 0,
                'bar_color'  => 'bg-slate-300',
                'status_col' => 'text-slate-500',
            ],
            [
                'time'       => '13:00 – 15:00',
                'badge'      => null,
                'status'     => 'TERSEDIA LEGA',
                'desc'       => 'Waktu tunggu nol menit untuk kedatangan saat ini.',
                'percent'    => 0,
                'bar_color'  => 'bg-slate-300',
                'status_col' => 'text-slate-500',
            ],
            [
                'time'       => '15:00 – 17:00',
                'badge'      => null,
                'status'     => 'TERSEDIA LEGA',
                'desc'       => 'Slot bebas antrean untuk perawatan berkala sore.',
                'percent'    => 0,
                'bar_color'  => 'bg-slate-300',
                'status_col' => 'text-slate-500',
            ],
        ];

        // 4. Rekomendasi Paket Servis Langsung Jalan
        $packages = [
            [
                'id'          => 'express-oil',
                'badge'       => '30 MENIT KILAT',
                'icon'        => 'fa-solid fa-oil-can',
                'title'       => 'Ganti Oli Express & Filter',
                'desc'        => 'Penggantian oli mesin full sintetis, filter oli baru OEM, ring baut carter, serta pembersihan filter udara.',
                'features'    => [
                    'Oli Fully Synthetic 4L (SN/SP)',
                    'Pembersihan Filter Udara/Kompresor',
                    'Cek Level Minyak Rem & Radiator Coolant',
                ],
                'price_label' => 'Estimasi Mulai',
                'price'       => 'Rp 380.000',
                'btn_text'    => 'Pilih & Masuk PIT 04 →',
                'btn_style'   => 'bg-white hover:bg-slate-50 text-slate-800 border border-slate-200',
            ],
            [
                'id'          => 'obd-check',
                'badge'       => '20 MENIT SCAN',
                'member_badge'=> 'GRATIS UTK MEMBER',
                'icon'        => 'fa-solid fa-magnifying-glass',
                'title'       => 'General Checkup 24 Titik OBD-II',
                'desc'        => 'Pemeriksaan sensor komputer ECU mobil, kondisi baterai aki tester digital, ketebalan kampas rem, dan fluida.',
                'features'    => [
                    'Full OBD-II ECU Error Diagnostic',
                    'Digital Battery State of Health (SOH)',
                    'Inspeksi Kebocoran Kolong & Suspensi',
                ],
                'price_label' => 'Non-Member: Rp 150.000',
                'price'       => 'FREE (Member)',
                'is_free'     => true,
                'btn_text'    => 'Klaim Servis Ini di PIT 04 →',
                'btn_style'   => 'bg-blue-600 hover:bg-blue-700 text-white shadow-xs',
            ],
            [
                'id'          => 'emisi-tuneup',
                'badge'       => '40 MENIT PERFORMA',
                'icon'        => 'fa-solid fa-sliders',
                'title'       => 'Uji Emisi & Fast Tune-Up',
                'desc'        => 'Pembersihan throttle body, ruang bakar injector foam cleaner, kalibrasi busi, dan sertifikat resmi uji emisi.',
                'features'    => [
                    'Pembersihan Throttle Body Cairan Khusus',
                    'Pembersihan Busi & Ignition Coil',
                    'Sertifikasi Lulus Uji Emisi DKI Terdaftar',
                ],
                'price_label' => 'Estimasi Mulai',
                'price'       => 'Rp 350.000',
                'btn_text'    => 'Pilih & Masuk PIT 04 →',
                'btn_style'   => 'bg-white hover:bg-slate-50 text-slate-800 border border-slate-200',
            ],
        ];

        return view('bengkel.stall', compact(
            'workshop',
            'isDemo',
            'metrics',
            'stalls',
            'hourlyLoad',
            'packages'
        ));
    }
}
