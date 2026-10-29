<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TravelLandingController extends Controller
{
    /**
     * Tampilkan landing page informasi publik L-Travel (SaaS Tour, Travel & Umroh).
     */
    public function index()
    {
        $stats = [
            ['label' => 'Total Wisatawan / Jamaah', 'value' => '2.450+ Orang', 'sub' => 'Diberangkatkan dengan aman'],
            ['label' => 'Paket Wisata & Umroh', 'value' => '52+ Rute', 'sub' => 'Domestik, Internasional & Religi'],
            ['label' => 'Ketepatan Jadwal', 'value' => '98.9%', 'sub' => 'On-time schedule & departure'],
            ['label' => 'Indeks Kepuasan Klien', 'value' => '4.9 / 5.0', 'sub' => 'Berdasarkan 800+ ulasan verified'],
        ];

        $fiturUtama = [
            [
                'icon' => 'fa-route',
                'title' => 'Manajemen Paket & Itinerary',
                'desc' => 'Susun rencana perjalanan, rute destinasi harian, alokasi hotel, maskapai penerbangan, dan kuota kursi secara terpusat.'
            ],
            [
                'icon' => 'fa-passport',
                'title' => 'Database Peserta & Paspor',
                'desc' => 'Pencatatan data manifest peserta, masa berlaku paspor, riwayat vaksin, rooming list hotel, dan kontak darurat.'
            ],
            [
                'icon' => 'fa-file-invoice-dollar',
                'title' => 'Invoice Otomatis & Skema DP',
                'desc' => 'Kelola pembayaran uang muka (DP), cicilan berkala, pelunasan sisa tagihan, serta terbitkan nota invoice digital otomatis.'
            ],
            [
                'icon' => 'fa-van-shuttle',
                'title' => 'Manajemen Armada & Tour Leader',
                'desc' => 'Penjadwalan bus pariwisata, kapal charter/phinisi, sewa mobil operasional, dan penugasan pemandu tour bersertifikat.'
            ],
            [
                'icon' => 'fa-comments',
                'title' => 'Broadcast Notifikasi WhatsApp',
                'desc' => 'Kirim panduan perlengkapan, briefing titik kumpul bandara, jadwal manasik, dan invoice sewa langsung ke WhatsApp peserta.'
            ],
            [
                'icon' => 'fa-shield-halved',
                'title' => 'Akses Ganda (Demo & Berlangganan)',
                'desc' => 'Mendukung mode pratinjau demo tanpa akun untuk eksplorasi publik, serta login akun resmi bagi agensi berlangganan aktif.'
            ],
        ];

        $katalogPaket = [
            [
                'nama' => 'Umroh Khazanah Barokah 9 Hari (Bintang 5)',
                'kategori' => 'Umroh & Religi',
                'durasi' => '9 Hari 8 Malam',
                'maskapai' => 'Saudia Airlines Direct',
                'hotel' => 'Pullman Zamzam Makkah & Dallah Taibah',
                'harga' => 'Rp 31.500.000 / pax',
                'status' => 'Tersedia',
                'status_class' => 'bg-emerald-100 text-emerald-800',
                'gambar' => 'https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'nama' => 'Exotic Labuan Bajo Phinisi Liveaboard 3D2N',
                'kategori' => 'Domestik Premium',
                'durasi' => '3 Hari 2 Malam',
                'maskapai' => 'Termasuk Phinisi Boat Superior',
                'hotel' => 'Kabin AC Private Ocean View',
                'harga' => 'Rp 5.850.000 / pax',
                'status' => 'Sisa 4 Seat',
                'status_class' => 'bg-amber-100 text-amber-800',
                'gambar' => 'https://images.unsplash.com/photo-1516690561799-46d8f74ff9ab?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'nama' => 'Japan Golden Route Sakura Autumn 7D6N',
                'kategori' => 'Internasional',
                'durasi' => '7 Hari 6 Malam',
                'maskapai' => 'All Nippon Airways (ANA)',
                'hotel' => 'Hotel Bintang 4 Tokyo - Kyoto - Osaka',
                'harga' => 'Rp 23.900.000 / pax',
                'status' => 'Tersedia',
                'status_class' => 'bg-emerald-100 text-emerald-800',
                'gambar' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'nama' => 'Open Trip Bromo Sunrise & Madakaripura 3D2N',
                'kategori' => 'Open Trip Adventure',
                'durasi' => '3 Hari 2 Malam',
                'maskapai' => 'Jeep 4x4 & HiAce Commuter',
                'hotel' => 'Lava View Lodge Bromo',
                'harga' => 'Rp 1.450.000 / pax',
                'status' => 'Tersedia',
                'status_class' => 'bg-emerald-100 text-emerald-800',
                'gambar' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=600&q=80',
            ],
        ];

        $paketLangganan = [
            [
                'nama' => 'Starter Tour Agency',
                'harga' => 'Rp 199.000',
                'periode' => '/bulan',
                'target' => 'Cocok untuk agensi travel perintis / open trip lokal',
                'fitur' => [
                    'Kelola hingga 5 paket trip aktif',
                    'Database peserta hingga 100 manifest',
                    'Pembuatan invoice DP & pelunasan',
                    'Pengingat WhatsApp manual ke peserta',
                    'Laporan pemesanan standar',
                ],
                'populer' => false,
            ],
            [
                'nama' => 'Pro Travel & Umroh Agency',
                'harga' => 'Rp 449.000',
                'periode' => '/bulan',
                'target' => 'Solusi ideal biro tour profesional & travel umroh berkembang',
                'fitur' => [
                    'Kelola paket trip tidak terbatas',
                    'Otomatisasi pengiriman invoice & reminder WA',
                    'Manajemen paspor, visa & rooming list',
                    'Penjadwalan armada transport & tour leader',
                    'Laporan arus kas laba-rugi per keberangkatan',
                    'Multi-user login (Owner, CS, Operasional)',
                ],
                'populer' => true,
            ],
            [
                'nama' => 'Enterprise Travel Group',
                'harga' => 'Rp 999.000',
                'periode' => '/bulan',
                'target' => 'Untuk biro perjalanan skala nasional dengan banyak cabang',
                'fitur' => [
                    'Multi-cabang & kemitraan agen sub-reseller',
                    'Portal pendaftaran online jamaah & tracking berkas',
                    'Integrasi payment gateway QRIS, VA & Kartu Kredit',
                    'Dedicated Account Manager & Training Tim',
                    'Custom branding & domain travel sendiri',
                ],
                'populer' => false,
            ],
        ];

        $whatsappUrl = 'https://wa.me/6281234567890?text=' . urlencode('Halo Admin L-Travel, saya tertarik untuk konsultasi dan berlangganan sistem manajemen SaaS Tour & Travel L-Travel.');

        return view('travel.landing', compact('stats', 'fiturUtama', 'katalogPaket', 'paketLangganan', 'whatsappUrl'));
    }
}

