<?php

namespace App\Http\Controllers\Bimbel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BimbelLandingController extends Controller
{
    /**
     * Tampilkan Landing Page Utama Bimbel (EduPulse Academy Bimbel).
     * Sesuai request user: Secara default disajikan dengan DATA KOSONG (clean state),
     * serta dilengkapi tombol switch "Pratinjau Data Demo" (?demo=1) untuk melihat visual penuh.
     */
    public function index(Request $request)
    {
        if ($request->query('tab') === 'program' || $request->query('view') === 'program') {
            return $this->programPage($request);
        }
        if ($request->query('tab') === 'pendaftaran' || $request->query('view') === 'pendaftaran' || $request->query('tab') === 'daftar') {
            return $this->pendaftaranPage($request);
        }
        if ($request->query('tab') === 'tryout' || $request->query('view') === 'tryout' || $request->query('tab') === 'cek-nilai' || $request->query('tab') === 'nilai') {
            return $this->tryoutPage($request);
        }
        if ($request->query('tab') === 'portal' || $request->query('view') === 'portal' || $request->query('tab') === 'portal-siswa' || $request->query('tab') === 'portal-ortu') {
            return $this->portalPage($request);
        }
        if ($request->query('tab') === 'kontak' || $request->query('view') === 'kontak' || $request->query('tab') === 'cabang' || $request->query('tab') === 'kontak-cabang') {
            return $this->kontakPage($request);
        }
        return $this->berandaPage($request);
    }

    /**
     * Halaman Beranda Alternatif (jika diakses via ?view=beranda)
     */
    public function berandaPage(Request $request)
    {
        $isDemo = true;

        // 1. Profil & Konfigurasi Lembaga Bimbel
        $institution = [
            'name'           => 'EduPulse Academy',
            'subname'        => 'WORKSHOP & BIMBEL PRESTASI',
            'tagline'        => 'BIMBINGAN BELAJAR TERAKREDITASI A',
            'headline'       => 'Raih Kampus & Sekolah Impian Bersama',
            'headline_accent'=> 'EduPulse Academy',
            'subheadline'    => 'Pendampingan belajar privat & semi-privat terpadu dengan kurikulum personal, bank latihan UTBK-SNBT/Kedinasan, dan jaminan bimbingan sampai lolos ujian secara maksimal.',
            'announcement'   => 'PENGUMUMAN SNBT 2026: Pendaftaran Program Intensif Gelombang 2 Telah Dibuka • Kuota Terbatas!',
            'hotline'        => '0812-9988-7711',
            'whatsapp'       => '6281299887711',
            'jam_layanan'    => 'Senin - Sabtu: 08:00 - 20:00 WIB',
            'alamat'         => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'branch'         => 'Cabang Jakarta Selatan (Pusat)',
        ];

        // 2. Metrik & Statistik (Default Kosong: 0 / -)
        $metrics = $isDemo ? [
            'lolos_ptn'       => '94.2%',
            'lolos_label'     => 'Tingkat Kelulusan SNBT',
            'siswa_aktif'     => '1.200+',
            'siswa_label'     => 'Alumni Masuk PTN Fav',
            'kepuasan'        => '100%',
            'kepuasan_label'  => 'Modul Resmi BSNP',
        ] : [
            'lolos_ptn'       => '0%',
            'lolos_label'     => 'Tingkat Kelulusan (Belum Ada Ujian)',
            'siswa_aktif'     => '0',
            'siswa_label'     => 'Siswa Terdaftar (Data Kosong)',
            'kepuasan'        => '0%',
            'kepuasan_label'  => 'Modul Aktif Terbit',
        ];

        // 3. Paket & Program Bimbingan Belajar
        $programs = $isDemo ? [
            [
                'id'          => 'sd-juara',
                'badge'       => 'KELAS 4 - 6 SD',
                'badge_color' => 'bg-blue-50 text-blue-700 border-blue-200',
                'icon'        => 'fa-solid fa-graduation-cap',
                'title'       => 'SD Juara',
                'desc'        => 'Pendampingan dasar calistung, sains & logika, persiapan masuk SMP favorit berstandar.',
                'price'       => '750.000',
                'period'      => '/ bln',
                'features'    => [
                    '3x Pertemuan Tatap Muka / Pekan',
                    'Maksimal 10 Siswa per Kelas',
                    'Modul & Bank Soal Tematik Lengkap',
                    'Laporan Nilai Bulanan ke Orang Tua',
                ],
                'is_popular'  => false,
            ],
            [
                'id'          => 'smp-prestasi',
                'badge'       => 'KELAS 7 - 9 SMP',
                'badge_color' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                'icon'        => 'fa-solid fa-book-open-reader',
                'title'       => 'SMP Prestasi',
                'desc'        => 'Fokus materi esensial MTK, IPA, & Bahasa Inggris, pemantapan nilai rapor serta asesmen kelulusan.',
                'price'       => '950.000',
                'period'      => '/ bln',
                'features'    => [
                    '4x Pertemuan Tatap Muka / Pekan',
                    'Simulasi Tryout CBT Komputer Berkala',
                    'Drill Soal Olimpiade & Soal HOTS',
                    'Free Konsultasi PR & Tugas Sekolah',
                ],
                'is_popular'  => false,
            ],
            [
                'id'          => 'utbk-mandiri',
                'badge'       => 'PALING DIMINATI',
                'badge_color' => 'bg-blue-600 text-white border-blue-600 shadow-sm',
                'icon'        => 'fa-solid fa-fire-flame-curved',
                'title'       => 'UTBK Mandiri Lolos',
                'desc'        => 'Drill super intensif TPS, Penalaran Umum, Literasi B. Indo & B. Inggris serta Tes Skolastik.',
                'price'       => '1.450.000',
                'period'      => '/ bln',
                'features'    => [
                    '5x Pertemuan Tambahan Latihan / Pekan',
                    '15x Tryout Resmi CBT IRT (Item Response)',
                    'Prediksi Rasionalisasi Peluang Jurusan',
                    'Masterclass Bedah Soal HOTS & Trik Kilat',
                ],
                'is_popular'  => true,
            ],
            [
                'id'          => 'garansi-ptn',
                'badge'       => 'GARANSI LOLOS 100%',
                'badge_color' => 'bg-amber-50 text-amber-700 border-amber-300',
                'icon'        => 'fa-solid fa-crown',
                'title'       => 'Garansi PTN Privat',
                'desc'        => 'Bimbingan 1 on 1 eksklusif modul khusus target UI, ITB, UGM, Kedokteran & Sekolah Kedinasan.',
                'price'       => '2.800.000',
                'period'      => '/ bln',
                'features'    => [
                    'Jadwal Fleksibel (Bisa di Rumah / Online)',
                    'Tutor Lulusan PTN Top & Berpengalaman',
                    'Konsultasi Jurusan Bersama Psikolog',
                    'Jaminan Garansi Belajar Ulang Gratis',
                ],
                'is_popular'  => false,
            ],
        ] : [];

        // 4. Fitur & Keunggulan
        $facilities = [
            [
                'icon'  => 'fa-solid fa-laptop-code',
                'title' => 'Modul & Video 24/7',
                'desc'  => 'Rangkuman materi digital & video pembahasan soal yang dapat diakses kapan pun melalui portal siswa.',
            ],
            [
                'icon'  => 'fa-solid fa-desktop',
                'title' => 'CBT Latihan Mirip Asli',
                'desc'  => 'Sistem simulasi ujian dengan penilaian pembobotan IRT persis dengan standar BPPP SNBT resmi.',
            ],
            [
                'icon'  => 'fa-solid fa-user-group',
                'title' => 'Konsultasi PR Privat 1 on 1',
                'desc'  => 'Bebas tanya PR dan tugas sekolah setiap hari di luar jam kelas bimbingan tanpa biaya tambahan.',
            ],
            [
                'icon'  => 'fa-solid fa-building-columns',
                'title' => 'Study Lounge & Full AC',
                'desc'  => 'Ruang belajar nyaman ber-AC, dispenser higienis, koneksi WiFi berkecepatan tinggi, dan area diskusi.',
            ],
        ];

        // 5. Data Tutor Master (Default Kosong: [])
        $tutors = $isDemo ? [
            [
                'name'        => 'Kak Farhan, M.Si',
                'role'        => 'Tutor Master Matematika',
                'campus'      => 'Institut Teknologi Bandung (ITB)',
                'experience'  => '8 Tahun Mengajar',
                'tag'         => 'TOP RATED TUTOR',
                'desc'        => 'Spesialis metode cepat Penalaran Matematika & TPS kuantitatif tanpa rumus rumit.',
                'rating'      => '4.98/5.00',
                'image'       => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'name'        => 'Kak Nadia, S.Pd',
                'role'        => 'Tutor Master Bahasa Inggris',
                'campus'      => 'Universitas Indonesia (UI)',
                'experience'  => '6 Tahun Mengajar',
                'tag'         => 'MASTER LITERASI',
                'desc'        => 'Ahli pembedah teks panjang Literasi Bahasa Inggris & Indonesia untuk persiapan UTBK SNBT.',
                'rating'      => '4.95/5.00',
                'image'       => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'name'        => 'Kak Rizky, S.Si',
                'role'        => 'Tutor Master Kimia & Fisika',
                'campus'      => 'Universitas Gadjah Mada (UGM)',
                'experience'  => '7 Tahun Mengajar',
                'tag'         => 'SAINTEK EXPERT',
                'desc'        => 'Membongkar konsep abstrak sains menjadi analogi visual yang mudah diingat selamanya.',
                'rating'      => '4.99/5.00',
                'image'       => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
            ],
        ] : [];

        // 6. Testimoni Siswa & Orang Tua (Default Kosong: [])
        $testimonials = $isDemo ? [
            [
                'name'        => 'Aditya Pratama',
                'school'      => 'Siswa SMA 8 Jakarta → Lolos Kedokteran UI',
                'quote'       => 'Metode drill soal CBT di EduPulse Academy benar-benar mirip dengan UTBK asli. Tutornya ramah dan selalu siap jawab pertanyaan PR sampai tuntas jam berapa pun.',
                'rating'      => 5,
            ],
            [
                'name'        => 'Siti Rahma',
                'school'      => 'Siswa SMAN 1 Bogor → Lolos Teknik Industri ITB',
                'quote'       => 'Dulu nilai TPS Penalaran Matematika saya selalu di bawah 500. Setelah ikut program intensif garansi, skor saya tembus 740 dan berhasil lolos pilihan pertama!',
                'rating'      => 5,
            ],
            [
                'name'        => 'Ibu Hendrawan',
                'school'      => 'Orang Tua Siswa SMP Taruna Bakti',
                'quote'       => 'Laporan perkembangan anak saya dikirimkan rutin setiap bulan melalui WhatsApp. Nilai rapor meningkat drastis dan anak jadi jauh lebih percaya diri belajar.',
                'rating'      => 5,
            ],
        ] : [];

        // 7. Alur Bimbingan Belajar
        $steps = [
            [
                'step'  => '1',
                'title' => 'Asesmen & Pemetaan Minat',
                'desc'  => 'Calon siswa mengikuti konsultasi awal untuk memetakan jurusan target, gaya belajar, dan target skor.',
            ],
            [
                'step'  => '2',
                'title' => 'Tes Diagnostik & Kelas',
                'desc'  => 'Ujian diagnostik singkat untuk menentukan penempatan kelas yang homogen sesuai level kemampuan.',
            ],
            [
                'step'  => '3',
                'title' => 'Tryout CBT & Drill Soal',
                'desc'  => 'Pelatihan rutin ribuan soal dengan sistem CBT modern dan analisis statistik titik lemah berkala.',
            ],
            [
                'step'  => '4',
                'title' => 'Pendampingan Kelulusan',
                'desc'  => 'Rekomendasi pemilihan prodi kampus serta pendampingan mental menjelang hari ujian sesungguhnya.',
            ],
        ];

        return view('bimbel.landing', compact(
            'institution',
            'isDemo',
            'metrics',
            'programs',
            'facilities',
            'tutors',
            'testimonials',
            'steps'
        ));
    }

    /**
     * Handle Form Pendaftaran / Konsultasi Siswa Baru
     */
    public function daftar(Request $request)
    {
        $request->validate([
            'nama_siswa'    => 'required|string|max:150',
            'no_whatsapp'   => 'required|string|max:20',
            'jenjang'       => 'nullable|string',
            'sekolah_asal'  => 'nullable|string',
        ]);

        // Simpan pendaftaran ke session (Clean storage)
        $pendaftarList = session('bimbel_pendaftar', []);
        $newPendaftar = [
            'id'           => 'REG-' . strtoupper(uniqid()),
            'nama'         => $request->input('nama_siswa'),
            'wa'           => $request->input('no_whatsapp'),
            'jenjang'      => $request->input('jenjang', 'SMA/UTBK'),
            'sekolah'      => $request->input('sekolah_asal', '-'),
            'status'       => 'Menunggu Konfirmasi CS',
            'waktu_daftar' => now()->format('d M Y H:i'),
        ];
        $pendaftarList[] = $newPendaftar;
        session(['bimbel_pendaftar' => $pendaftarList]);

        $waText = "Halo Admin Bimbel EduPulse Academy, saya ingin konsultasi pendaftaran atas nama *{$newPendaftar['nama']}* (Jenjang: {$newPendaftar['jenjang']}). Mohon info jadwal asesmen gratis.";
        $waUrl  = "https://wa.me/6281299887711?text=" . urlencode($waText);

        return redirect()->route('bimbel.landing')
            ->with('success_daftar', "Pendaftaran konsultasi atas nama {$newPendaftar['nama']} berhasil diterima! ID Registrasi: {$newPendaftar['id']}")
            ->with('wa_redirect', $waUrl);
    }

    /**
     * Tampilkan Halaman Program Bimbingan & Rincian Biaya (elc.my.id/bimbel/program).
     * Sesuai request user: Secara default disajikan dengan DATA KOSONG (clean state),
     * serta dilengkapi tombol switch "Pratinjau Data Demo" (?demo=1) untuk melihat visual penuh sesuai screenshot.
     */
    public function programPage(Request $request)
    {
        $isDemo = $request->has('demo') && in_array(strtolower($request->query('demo')), ['1', 'true', 'yes', 'demo']);

        $institution = [
            'name'           => 'EduPulse Academy',
            'subname'        => 'WORKSHOP & BIMBEL PRESTASI',
            'tagline'        => 'BIMBINGAN BELAJAR TERAKREDITASI A',
            'headline'       => 'Pilihan Program Belajar & Estimasi Investasi Pendidikan 2025/2026',
            'subheadline'    => 'Kurikulum adaptif, bimbingan personal mentor, serta simulasi tryout berstandar komputer untuk memperbesar peluang lolos PTN negeri dan sekolah favorit impian.',
            'announcement'   => 'INFO GELOMBANG PENDAFTARAN BARU: Dapatkan diskon early bird s.d 20% + Free 2x Diagnostic Test untuk pendaftaran sebelum 30 Juni 2025. Kuota Terbatas!',
            'hotline'        => '0812-9988-7711',
            'whatsapp'       => '6281299887711',
            'jam_layanan'    => 'Senin - Sabtu: 08:00 - 20:00 WIB',
            'alamat'         => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'branch'         => 'Cabang Jakarta Selatan (Pusat)',
        ];

        // Stats Header (Sesuai Foto)
        $stats = [
            'kelulusan'      => '91.4%',
            'kelulusan_label'=> 'Tingkat Kelulusan',
            'rasio'          => '1:10',
            'rasio_label'    => 'Rasio Maksimal Guru & Siswa',
        ];

        // Filter Categories
        $categories = [
            ['id' => 'all', 'label' => 'Semua Program', 'active' => true],
            ['id' => 'sd', 'label' => 'SD Juara (4-6)', 'active' => false],
            ['id' => 'smp', 'label' => 'SMP Prestasi (7-9)', 'active' => false],
            ['id' => 'sma', 'label' => 'SMA Reguler (10-12)', 'active' => false],
            ['id' => 'utbk', 'label' => 'Intensif UTBK SNBT', 'active' => false],
            ['id' => 'kedinasan', 'label' => 'Kedinasan / Akmil / Akpol', 'active' => false],
            ['id' => 'privat', 'label' => 'Privat Garansi 1-on-1', 'active' => false],
        ];

        // 4 Pricing Packages (Sesuai Foto)
        $packages = [
            [
                'id'          => 'sd-olimpiade',
                'category'    => 'sd',
                'badge'       => 'KELAS 4 - 6 SD',
                'badge_color' => 'bg-blue-50 text-blue-700 border-blue-200',
                'title'       => 'SD Juara & Olimpiade',
                'desc'        => 'Pembinaan dasar calistung, sains & logika, persiapan masuk SMP favorit berstandar.',
                'price_label' => 'Biaya Investasi Mulai',
                'price'       => '750.000',
                'period'      => '/ bln',
                'features'    => [
                    '3x Pertemuan Tatap Muka / Pekan',
                    'Maksimal 10 Siswa per Kelas',
                    'Modul & Bank Soal Tematik Lengkap',
                    'Laporan Nilai Bulanan ke Orang Tua',
                ],
                'is_popular'  => false,
            ],
            [
                'id'          => 'smp-unggulan',
                'category'    => 'smp',
                'badge'       => 'KELAS 7 - 9 SMP',
                'badge_color' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                'title'       => 'SMP Prestasi & SMA Unggulan',
                'desc'        => 'Fokus materi esensial MTK, IPA, & Bahasa Inggris, pemantapan nilai rapor serta asesmen kelulusan.',
                'price_label' => 'Biaya Investasi Mulai',
                'price'       => '950.000',
                'period'      => '/ bln',
                'features'    => [
                    '4x Pertemuan Tatap Muka / Pekan',
                    'Simulasi Tryout CBT Komputer Berkala',
                    'Drill Soal Olimpiade & Soal HOTS',
                    'Free Konsultasi PR & Tugas Sekolah',
                ],
                'is_popular'  => false,
            ],
            [
                'id'          => 'utbk-kilat',
                'category'    => 'utbk',
                'badge'       => 'PALING DIMINATI',
                'badge_color' => 'bg-blue-600 text-white border-blue-600 shadow-sm',
                'top_pill'    => 'Program Unggulan Rekomendasi Mentor',
                'title'       => 'UTBK Mandiri & SNBT Kilat',
                'desc'        => 'Drill super intensif TPS, Penalaran Umum, Literasi B. Indo & B. Inggris serta Tes Skolastik.',
                'price_label' => 'Biaya Investasi Mulai',
                'price'       => '1.450.000',
                'period'      => '/ bln',
                'features'    => [
                    '5x Pertemuan Tambahan Latihan / Pekan',
                    '15x Tryout Resmi CBT IRT (Item Response)',
                    'Prediksi Rasionalisasi Peluang Jurusan',
                    'Masterclass Bedah Soal HOTS & Trik Kilat',
                ],
                'is_popular'  => true,
            ],
            [
                'id'          => 'garansi-maksimal',
                'category'    => 'privat',
                'badge'       => 'GARANSI LOLOS 100%',
                'badge_color' => 'bg-amber-50 text-amber-700 border-amber-300',
                'title'       => 'Garansi PTN Privat Maksimal',
                'desc'        => 'Bimbingan 1 on 1 eksklusif modul khusus target UI, ITB, UGM, Kedokteran & Sekolah Kedinasan.',
                'price_label' => 'Biaya Investasi Mulai',
                'price'       => '2.800.000',
                'period'      => '/ bln',
                'features'    => [
                    'Jadwal Fleksibel (Bisa di Rumah / Online)',
                    'Tutor Lulusan PTN Top & Berpengalaman',
                    'Konsultasi Jurusan Bersama Psikolog',
                    'Jaminan Garansi Belajar Ulang Gratis',
                ],
                'is_popular'  => false,
            ],
        ];

        // Simulator Defaults (Sesuai Foto: Rp 13.550.000)
        $simulator = [
            'base_price'      => 1450000,
            'duration_months' => 10,
            'discount'        => 1450000,
            'addon_price'     => 500000,
            'total_price'     => '13.550.000',
        ];

        // Comparison Matrix (Sesuai Foto)
        $matrix = [
            [
                'feature' => 'Kapasitas per Kelas',
                'sd'      => 'Maks 10 Siswa',
                'smp'     => 'Maks 10 Siswa',
                'utbk'    => 'Maks 10 Siswa',
                'privat'  => '1-on-1 Eksklusif',
            ],
            [
                'feature' => 'Pertemuan Tatap Muka',
                'sd'      => '3x / Pekan',
                'smp'     => '4x / Pekan',
                'utbk'    => '5x / Pekan',
                'privat'  => '6x / Pekan Fleksibel',
            ],
            [
                'feature' => 'Latihan CBT Komputer',
                'sd'      => '-',
                'smp'     => '4x / Semester',
                'utbk'    => '15x Tryout IRT',
                'privat'  => 'Unlimited Tryout Pribadi',
            ],
            [
                'feature' => 'Tanya PR & Konsultasi 1-on-1',
                'sd'      => 'Terbatas Jam Tertentu',
                'smp'     => '1x / Pekan Gratis',
                'utbk'    => '3x / Pekan Gratis',
                'privat'  => 'Bebas Setiap Hari',
            ],
            [
                'feature' => 'Pemetaan Minat & Psikotes',
                'sd'      => '-',
                'smp'     => '-',
                'utbk'    => 'Ada (Tes Minat Bakat)',
                'privat'  => 'Full Profiling Psikolog Khusus',
            ],
            [
                'feature' => 'Garansi Belajar Ulang / Cashback',
                'sd'      => '-',
                'smp'     => '-',
                'utbk'    => 'Diskon Re-enrollment 50%',
                'privat'  => 'Garansi 100% Uang Kembali*',
            ],
            [
                'feature' => 'Akses Modul & Portal Siswa',
                'sd'      => 'Akses Selama Aktif',
                'smp'     => 'Akses Selama Aktif',
                'utbk'    => 'Full Akses 1 Tahun Penuh',
                'privat'  => 'Akses Seumur Hidup (Lifetime)',
            ],
        ];

        // Modern Facilities (Included in all packages)
        $modernFacilities = [
            [
                'icon'  => 'fa-solid fa-snowflake',
                'title' => 'Kelas Nyaman & Full AC',
                'desc'  => 'Suasana belajar dingin & tenang dengan kapasitas maksimal 10 siswa per kelas.',
            ],
            [
                'icon'  => 'fa-solid fa-desktop',
                'title' => 'Laboratorium CBT Modern',
                'desc'  => 'PC spesifikasi tinggi dengan simulasi interface UTBK SNBT sesungguhnya.',
            ],
            [
                'icon'  => 'fa-solid fa-mug-saucer',
                'title' => 'Study Lounge & Cafe',
                'desc'  => 'Area santai dengan free WiFi berkecepatan tinggi & minuman hangat gratis.',
            ],
            [
                'icon'  => 'fa-solid fa-comments',
                'title' => 'Tanya PR Kapan Saja',
                'desc'  => 'Bebas konsultasi tugas sekolah di luar jam bimbingan tanpa dipungut biaya.',
            ],
            [
                'icon'  => 'fa-solid fa-mobile-screen-button',
                'title' => 'Aplikasi Portal Siswa',
                'desc'  => 'Akses modul materi, rekaman zoom, jadwal kelas, dan rapor berkala real-time.',
            ],
        ];

        // Testimonials (Sesuai Foto)
        $testimonials = [
            [
                'name'   => 'Farel Ramadhan',
                'school' => 'Lolos STEI ITB 2024 (Alumni SMAN 28)',
                'quote'  => 'Investasi di kelas UTBK Kilat EduPulse Academy adalah keputusan terbaik saya. Soal-soal tryoutnya persis polanya dan bimbingan mentornya sangat terstruktur.',
                'rating' => 5,
            ],
            [
                'name'   => 'Ibu Dini Anggraeni',
                'school' => 'Orang Tua Siswa SD Juara',
                'quote'  => 'Biaya bimbingan sangat sebanding dengan kemajuan anak saya. Dulunya matematika nilai 60, sekarang langganan juara kelas dan lolos SMPN 1.',
                'rating' => 5,
            ],
            [
                'name'   => 'Nabila Putri, S.Ked',
                'school' => 'Lolos FK UI 2024 (Alumni Program Garansi)',
                'quote'  => 'Program privat garansi beneran mendampingi dari nol sampai hari H pengumuman SNBT. Profiling jurusan dari psikolognya sangat akurat.',
                'rating' => 5,
            ],
        ];

        return view('bimbel.program', compact(
            'institution',
            'isDemo',
            'stats',
            'categories',
            'packages',
            'simulator',
            'matrix',
            'modernFacilities',
            'testimonials'
        ));
    }

    /**
     * Halaman Pendaftaran Siswa Baru Online (EduPulse Academy Cabang Tebet Clean)
     * Sesuai request: data default KOSONG, dengan form lengkap sesuai screenshot
     * serta fitur interaktif realtime kalkulasi dan toggle demo jika diinginkan.
     */
    public function pendaftaranPage(Request $request)
    {
        // Toggle contoh data demo via query parameter ?demo=1
        $isDemo = $request->query('demo') == '1';

        $institution = [
            'name'               => 'EduPulse Academy',
            'subname'            => 'WORKSHOP & BIMBEL PRESTASI',
            'branch'             => 'Azzahra Computer – ASUS Authorized Service Center (Cabang Cibubur)',
            'branch_name'        => 'Azzahra Computer Cabang Cibubur',
            'branch_short'       => 'Cabang Cibubur',
            'branch_address'     => 'Ruko Kranggan Permai Blok RT 16 No. 27',
            'branch_full_address'=> 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'front_office_phone' => '+62 812-9900-3420',
            'hotline'            => '(021) 8370-1920',
            'sisa_kuota'         => 18,
            'tahun_ajaran'       => '2025/2026',
            'gelombang'          => 'Gelombang 2 Dibuka',
            'jam_buka'           => 'Senin - Sabtu: 08.00 - 20.30 WIB',
        ];

        // Sesuai permintaan user: "tetapi menggunakan data nya kosong"
        $formData = [
            'jenjang'          => $isDemo ? 'SMA 12 / UTBK' : '',
            'nama_siswa'       => $isDemo ? 'Aisyah Putri Rahmadani' : '',
            'nisn'             => $isDemo ? '0062839102' : '',
            'asal_sekolah'     => $isDemo ? 'SMA Negeri 28 Jakarta' : '',
            'jurusan'          => $isDemo ? 'MIPA / IPA (Kurikulum Merdeka / 2013)' : '',
            'wa_siswa'         => $isDemo ? '081299881234' : '',
            'email_siswa'      => $isDemo ? 'aisyah.putri@gmail.com' : '',
            'nama_ortu'        => $isDemo ? 'Dr. Hendra Rahmadani' : '',
            'hubungan_ortu'    => $isDemo ? 'Ayah Kandung' : '',
            'wa_ortu'          => $isDemo ? '081198765432' : '',
            'selected_program' => 'utbk-garansi',
            'selected_session' => 'siang',
            'metode_bayar'     => 'qris',
        ];

        // Pilihan jenjang pendidikan target
        $jenjangList = [
            'SD (4-6)',
            'SMP (7-9)',
            'SMA Kelas 10-11',
            'SMA 12 / UTBK',
            'Kedinasan/CPNS',
        ];

        // 3 Paket Pilihan Bimbingan (Sesuai Foto Persis)
        $programOptions = [
            [
                'id'          => 'reguler-3x',
                'badge'       => 'Kategori Standar',
                'title'       => 'Paket Reguler 3x',
                'subtitle'    => 'Target paralel & UTBK standar',
                'price'       => 1450000,
                'price_label' => 'Rp 1.450.000',
                'period'      => '/bulan',
                'features'    => [
                    'Maksimal 10 Siswa/Kelas',
                    'Modul Cetak Lengkap 2 Semester',
                    '6x Tryout CBT IRT Nasional',
                    'Konsultasi Jurusan SNBP/SNBT',
                ],
                'is_popular'  => false,
            ],
            [
                'id'          => 'utbk-garansi',
                'top_pill'    => '★ TERPOPULER',
                'badge'       => 'Target UI/ITB/UGM',
                'title'       => 'Intensive Garansi UTBK',
                'subtitle'    => '5x Seminggu + Drilling Harian',
                'price'       => 2250000,
                'price_label' => 'Rp 2.250.000',
                'period'      => '/bulan',
                'features'    => [
                    '5x Pertemuan/Minggu Intensif',
                    'Bedah Soal HOTS & TPS Kilat',
                    '16x Tryout IRT + Analisis Peluang',
                    'Rasionalisasi Personal 1-on-1',
                ],
                'is_popular'  => true,
            ],
            [
                'id'          => 'privat-1on1',
                'badge'       => 'Eksklusif Personal',
                'title'       => 'Privat 1–on–1 Fleksibel',
                'subtitle'    => 'Jadwal bebas & tutor ke rumah',
                'price'       => 3500000,
                'price_label' => 'Rp 3.500.000',
                'period'      => '/bulan',
                'features'    => [
                    'Tutor Master Khusus 1 Siswa',
                    'Penyesuaian Jadwal Bebas',
                    'Tatap Muka di Cabang / Home',
                    'Kurikulum Disesuaikan Kelemahan',
                ],
                'is_popular'  => false,
            ],
        ];

        // Sesi Kelas Tatap Muka
        $sessionOptions = [
            [
                'id'          => 'siang',
                'title'       => 'Sesi Siang (14.00 - 16.00 WIB)',
                'desc'        => 'Cocok untuk siswa pulang sekolah awal / Gap Year',
                'label_short' => '14.00 - 16.00 WIB',
            ],
            [
                'id'          => 'sore',
                'title'       => 'Sesi Sore (16.30 - 18.30 WIB)',
                'desc'        => 'Paling diminati siswa SMA Full-Day School Tebet',
                'label_short' => '16.30 - 18.30 WIB',
            ],
        ];

        // Ringkasan Biaya Awal
        $pricingSummary = [
            'biaya_registrasi_asli' => 250000,
            'is_registrasi_gratis'  => true,
            'diskon_early_bird'     => 200000,
        ];

        return view('bimbel.pendaftaran', compact(
            'institution',
            'isDemo',
            'formData',
            'jenjangList',
            'programOptions',
            'sessionOptions',
            'pricingSummary'
        ));
    }

    /**
     * Halaman Cek Hasil Tryout & Analisis Nilai — Berupa Halaman Pemberitahuan Website
     */
    public function tryoutPage(Request $request)
    {
        $institution = [
            'name'                => 'EduPulse Academy',
            'subname'             => 'WORKSHOP & BIMBEL PRESTASI',
            'branch'              => 'Azzahra Computer – ASUS Authorized Service Center (Cabang Cibubur)',
            'branch_name'         => 'Azzahra Computer Cabang Cibubur',
            'branch_short'        => 'Cabang Cibubur',
            'branch_address'      => 'Ruko Kranggan Permai Blok RT 16 No. 27',
            'branch_full_address' => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'front_office_phone'  => '+62 814-7665-2656',
            'hotline'             => '(021) 8430-8910',
            'tahun_ajaran'        => '2025/2026',
            'jam_buka'            => 'Senin - Sabtu: 08.00 - 17.00 WIB',
            'whatsapp'            => '6281476652656',
            'sisa_kuota'          => 18,
        ];

        return view('bimbel.tryout', compact('institution'));
    }

    /**
     * Halaman Portal Siswa & Orang Tua — Berupa Halaman Pemberitahuan & Pratinjau Layanan
     */
    public function portalPage(Request $request)
    {
        $institution = [
            'name'                => 'EduPulse Academy',
            'subname'             => 'WORKSHOP & BIMBEL PRESTASI',
            'branch'              => 'Azzahra Computer – ASUS Authorized Service Center (Cabang Cibubur)',
            'branch_name'         => 'Azzahra Computer Cabang Cibubur',
            'branch_short'        => 'Cabang Cibubur',
            'branch_address'      => 'Ruko Kranggan Permai Blok RT 16 No. 27',
            'branch_full_address' => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'front_office_phone'  => '+62 814-7665-2656',
            'hotline'             => '(021) 8430-8910',
            'tahun_ajaran'        => '2025/2026',
            'jam_buka'            => 'Senin - Sabtu: 08.00 - 17.00 WIB',
            'whatsapp'            => '6281476652656',
            'sisa_kuota'          => 18,
        ];

        return view('bimbel.portal', compact('institution'));
    }

    /**
     * Halaman Informasi & Kontak Cabang Bimbel — Berupa Halaman Pemberitahuan & Pusat Layanan
     */
    public function kontakPage(Request $request)
    {
        $institution = [
            'name'                => 'EduPulse Academy',
            'subname'             => 'WORKSHOP & BIMBEL PRESTASI',
            'branch'              => 'Azzahra Computer – ASUS Authorized Service Center (Cabang Cibubur)',
            'branch_name'         => 'Azzahra Computer Cabang Cibubur',
            'branch_short'        => 'Cabang Cibubur',
            'branch_address'      => 'Ruko Kranggan Permai Blok RT 16 No. 27',
            'branch_full_address' => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'front_office_phone'  => '+62 814-7665-2656',
            'hotline'             => '(021) 8430-8910',
            'tahun_ajaran'        => '2025/2026',
            'jam_buka'            => 'Senin - Sabtu: 08.00 - 17.00 WIB',
            'whatsapp'            => '6281476652656',
            'sisa_kuota'          => 18,
            'email'               => 'cibubur@azzahracomputer.com',
        ];

        return view('bimbel.kontak', compact('institution'));
    }
}

