<?php

namespace App\Http\Controllers\Prosal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProsalLandingController extends Controller
{
    /**
     * Tampilkan landing page informasi publik L-Prosal (SaaS Properti).
     */
    public function index()
    {
        $stats = [
            ['label' => 'Total Unit Terkelola', 'value' => '185+ Unit', 'sub' => 'Apartemen, Ruko & Kost'],
            ['label' => 'Tingkat Okupansi', 'value' => '94.8%', 'sub' => 'Rata-rata hunian aktif'],
            ['label' => 'Total Nilai Aset', 'value' => 'Rp 62.4 Miliar', 'sub' => 'Portofolio mitra aktif'],
            ['label' => 'Kepuasan Penyewa', 'value' => '4.9 / 5.0', 'sub' => 'Berdasarkan 500+ ulasan'],
        ];

        $fiturUtama = [
            [
                'icon' => 'fa-building',
                'title' => 'Manajemen Multi-Properti',
                'desc' => 'Kelola apartemen, ruko komersial, perumahan sewa, hingga kost eksklusif dalam satu dashboard terintegrasi.'
            ],
            [
                'icon' => 'fa-users',
                'title' => 'Database & Verifikasi Tenant',
                'desc' => 'Pencatatan data penyewa, dokumen identitas, kontak darurat, serta riwayat sewa yang aman dan rapi.'
            ],
            [
                'icon' => 'fa-file-invoice-dollar',
                'title' => 'Tagihan Otomatis & Reminder WA',
                'desc' => 'Kirim tagihan sewa bulanan, iuran IPL/listrik/air, serta pengingat jatuh tempo otomatis via WhatsApp.'
            ],
            [
                'icon' => 'fa-tools',
                'title' => 'Pelaporan Keluhan & Maintenance',
                'desc' => 'Pantau status tiket perbaikan unit, disposisi teknisi, serta riwayat biaya pemeliharaan properti.'
            ],
            [
                'icon' => 'fa-chart-pie',
                'title' => 'Laporan Arus Kas Real-Time',
                'desc' => 'Pantau pendapatan sewa, pengeluaran operasional, tunggakan tenant, serta estimasi return on investment (ROI).'
            ],
            [
                'icon' => 'fa-shield-halved',
                'title' => 'Akses Berlangganan & Demo',
                'desc' => 'Dapat digunakan dengan akun khusus langganan (fitur penuh tersimpan) maupun mode demo tanpa login untuk eksplorasi.'
            ],
        ];

        $katalogProperti = [
            [
                'nama' => 'Apartemen Grand Sudirman - Tower B Lt. 14',
                'kategori' => 'Apartemen Hunian',
                'lokasi' => 'Kebayoran Baru, Jakarta Selatan',
                'tipe' => '2 BR • Full Furnished • 54 m²',
                'harga' => 'Rp 8.500.000 / bulan',
                'status' => 'Tersedia',
                'status_class' => 'bg-emerald-100 text-emerald-800',
                'gambar' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'nama' => 'Ruko Sentra Niaga Boulevard Blok A-08',
                'kategori' => 'Ruko Komersial',
                'lokasi' => 'Gading Serpong, Tangerang',
                'tipe' => '3 Lantai • Listrik 5500W • 180 m²',
                'harga' => 'Rp 14.200.000 / bulan',
                'status' => 'Tersewa',
                'status_class' => 'bg-amber-100 text-amber-800',
                'gambar' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'nama' => 'Kost Eksklusif Dago Pine - Kamar Deluxe 204',
                'kategori' => 'Kost Mahasiswa & Pekerja',
                'lokasi' => 'Coblong, Dago Bandung',
                'tipe' => 'Single Bed • AC & WiFi • Water Heater',
                'harga' => 'Rp 2.100.000 / bulan',
                'status' => 'Tersedia',
                'status_class' => 'bg-emerald-100 text-emerald-800',
                'gambar' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'nama' => 'Office Space Wisma Kencana - Suite 501',
                'kategori' => 'Kantor & Workspace',
                'lokasi' => 'Kuningan, Jakarta Selatan',
                'tipe' => 'Kapasitas 15 Orang • Meeting Room • 95 m²',
                'harga' => 'Rp 22.000.000 / bulan',
                'status' => 'Tersedia',
                'status_class' => 'bg-emerald-100 text-emerald-800',
                'gambar' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=600&q=80',
            ],
        ];

        $paketLangganan = [
            [
                'nama' => 'Starter Owner',
                'harga' => 'Rp 149.000',
                'periode' => '/bulan',
                'target' => 'Cocok untuk pemilik 1 - 10 unit sewa/kost pribadi',
                'fitur' => [
                    'Kelola hingga 10 unit properti',
                    'Database tenant & kontak darurat',
                    'Pencatatan invoice pembayaran',
                    'Pengingat sewa manual via WhatsApp',
                    'Laporan keuangan bulanan standar',
                ],
                'populer' => false,
            ],
            [
                'nama' => 'Pro Property Manager',
                'harga' => 'Rp 349.000',
                'periode' => '/bulan',
                'target' => 'Solusi ideal pengelola apartemen, ruko, & kost komersial',
                'fitur' => [
                    'Kelola hingga 50 unit properti',
                    'Otomatisasi pengiriman invoice & reminder WA',
                    'Modul tiket maintenance & tracking teknisi',
                    'Laporan okupansi & analitik keuangan real-time',
                    'Multi-user pengelola (Owner + Admin/Staff)',
                    'Export laporan format Excel & PDF',
                ],
                'populer' => true,
            ],
            [
                'nama' => 'Enterprise Facility',
                'harga' => 'Rp 899.000',
                'periode' => '/bulan',
                'target' => 'Untuk developer gedung, komplek pergudangan & kawasan properti',
                'fitur' => [
                    'Unit properti tidak terbatas (Unlimited)',
                    'Integrasi smart lock & sistem presensi RFID',
                    'Portal mandiri untuk tenant (cek billing & lapor)',
                    'Dedicated Account Manager & Training Tim',
                    'Kustomisasi workflow & template invoice perusahaan',
                ],
                'populer' => false,
            ],
        ];

        $whatsappUrl = 'https://wa.me/6281234567890?text=' . urlencode('Halo Admin L-Prosal, saya tertarik untuk konsultasi dan berlangganan sistem manajemen properti SaaS L-Prosal.');

        return view('prosal.landing', compact('stats', 'fiturUtama', 'katalogProperti', 'paketLangganan', 'whatsappUrl'));
    }
}

