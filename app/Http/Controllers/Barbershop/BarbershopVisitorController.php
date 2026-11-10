<?php

namespace App\Http\Controllers\Barbershop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BarbershopVisitorController extends Controller
{
    /**
     * Tampilkan Portal Pengunjung / Website Barbershop Atelier Gilt.
     * Mendukung pengunjung tanpa login (guest) maupun pelanggan langganan (VIP Member).
     */
    public function index(Request $request)
    {
        $authUser = Auth::user();
        
        // Mode simulation override: ?mode=guest atau ?mode=vip (sangat membantu demonstrasi)
        $simulatedMode = $request->query('mode');
        $tab = $request->query('tab', 'beranda'); // 'beranda' | 'reservasi'
        
        // Cek apakah user dianggap sebagai Member VIP
        $isMember = false;
        $memberData = null;

        if ($simulatedMode === 'guest') {
            $isMember = false;
        } elseif ($simulatedMode === 'vip' || ($authUser && ($authUser->email === 'raditya@lstyle.id' || $authUser->role === 'barbershop_member' || session('is_barber_vip')))) {
            $isMember = true;
            $memberData = [
                'id' => $authUser ? $authUser->id : 16,
                'name' => $authUser ? $authUser->name : 'Raditya Pratama',
                'email' => $authUser ? $authUser->email : 'raditya.pratama@noiratelier.id',
                'tier' => 'Platinum VIP',
                'tier_badge' => 'PLATINUM VIP',
                'tier_code' => 'TIER 01',
                'points' => '4.850 PTS',
                'raw_points' => 4850,
                'card_number' => 'GILT-8839-0021',
                'valid_thru' => '12 / 2028',
                'phone' => '+62 811-9874-2091',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&auto=format&fit=crop&q=80',
                'join_date' => 'Maret 2024',
                'preferred_barber' => 'Yudha P.',
                'status_reservasi' => 'Ready',
                'completed_cuts' => 24,
            ];
        } elseif ($authUser) {
            // User login umum
            $isMember = true;
            $memberData = [
                'id' => $authUser->id,
                'name' => $authUser->name,
                'email' => $authUser->email,
                'tier' => 'Gold Member',
                'tier_badge' => 'GOLD MEMBER',
                'points' => '1.200 PTS',
                'raw_points' => 1200,
                'phone' => $authUser->phone ?? '+62 812-3344-5566',
                'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=200&auto=format&fit=crop&q=80',
                'join_date' => 'Agustus 2024',
                'favorite_barber' => 'Master Barber Yudha Pratama',
                'completed_cuts' => 6,
            ];
        }

        // 1. DATA RESERVASI AKTIF HARI INI
        // Jika member VIP, reservasi aktif persis seperti di gambar: A-016
        $activeReservation = null;
        if ($isMember) {
            $activeReservation = [
                'id' => 'RES-ATELIER-016',
                'nomor_antrean' => 'A-016',
                'status' => 'Dikonfirmasi • Menunggu Giliran',
                'est_pelayanan' => 'Est. Pelayanan 16:30 WIB',
                'jam_pelayanan' => '16:30 WIB',
                'barber' => [
                    'name' => 'Master Barber Yudha Pratama',
                    'kursi' => 'Kursi VIP 02 • The Atelier Main Floor',
                    'experience' => '11 Th Pengalaman',
                ],
                'paket' => [
                    'name' => 'The Executive Royal Cut & Hot Towel Finish',
                    'kategori' => 'Signature Hair Architecture',
                    'durasi' => '60 Menit',
                    'harga' => 250000,
                    'harga_formatted' => 'Rp 250.000',
                ],
                'lokasi' => 'Senopati Suites No. 18, Kebayoran Baru',
                'kota' => 'Jakarta Selatan',
                'qr_code' => 'ATELIER-VIP-A016-RADITYA',
                'tanggal' => 'Hari ini, ' . now()->isoFormat('D MMMM Y'),
                'catatan' => 'Scent aromaterapi sandalwood & hot towel wrap ganda.',
            ];
        } elseif (session()->has('guest_reservation')) {
            $activeReservation = session('guest_reservation');
        }

        // 2. LAYANAN TERPOPULER (MENU PERAWATAN SIGNATURE) - PERSIS GAMBAR
        $services = [
            [
                'id' => 'gentleman-royal-cut',
                'category' => 'HAIR ARCHITECTURE',
                'title' => 'Gentleman Royal Cut',
                'badge' => 'FAVORIT TAMU VIP',
                'badge_style' => 'gold',
                'duration' => '60 Menit',
                'description' => 'Konsultasi kontur wajah, precision scissor & clipper cut, double wash aromaterapi, hot towel face wrap, dan styling pomade signature.',
                'price' => 250000,
                'price_formatted' => 'Rp 250.000',
                'image' => '/images/atelier/barbershop_haircut_sovereign_1791385322314.jpg',
                'fallback_image' => 'https://images.unsplash.com/photo-1599351431202-1e0f0137899a?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 'signature-beard-sculpt',
                'category' => 'FACIAL GROOMING',
                'title' => 'Signature Beard Sculpt',
                'badge' => 'ARTISAN SHAVE',
                'badge_style' => 'dark',
                'duration' => '30 Menit',
                'description' => 'Pembentukan kontur jenggot dengan pisau cukur lurus tradisional, minyak botanical hangat, dan cold towel finish untuk pori-pori segar.',
                'price' => 120000,
                'price_formatted' => 'Rp 120.000',
                'image' => 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=800&auto=format&fit=crop&q=80',
                'fallback_image' => '/images/atelier/barbershop_hair_coloring_1791385558445.jpg',
            ],
            [
                'id' => 'scalp-detox-treatment',
                'category' => 'HAIR & SCALP HEALTH',
                'title' => 'Scalp Detox Treatment',
                'badge' => 'HOLISTIC SPA',
                'badge_style' => 'dark',
                'duration' => '40 Menit',
                'description' => 'Eksfoliasi kulit kepala mendalam, masker clay detoksifikasi, pijat leher relaksasi, dan tonic stimulasi akar rambut.',
                'price' => 150000,
                'price_formatted' => 'Rp 150.000',
                'image' => '/images/atelier/barbershop_scalp_spa_1791385356193.jpg',
                'fallback_image' => 'https://images.unsplash.com/photo-1519699047748-de8e457a634e?w=800&auto=format&fit=crop&q=80',
            ],
        ];

        // Katalog Layanan Lengkap (untuk Modal "Lihat Seluruh Katalog Perawatan")
        $allServices = array_merge($services, [
            [
                'id' => 'royal-shave-ritual',
                'category' => 'FACIAL GROOMING',
                'title' => 'The Sovereign Hot Shave Ritual',
                'badge' => 'EXCLUSIVE',
                'badge_style' => 'gold',
                'duration' => '45 Menit',
                'description' => '3x ritual hot towel herbal infusion, pre-shave cream artisan, straight razor precision, dan aftershave balm sandalwood.',
                'price' => 180000,
                'price_formatted' => 'Rp 180.000',
                'image' => 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=800&auto=format&fit=crop&q=80',
                'fallback_image' => '',
            ],
            [
                'id' => 'hair-coloring-grey-blend',
                'category' => 'HAIR ARCHITECTURE',
                'title' => 'Natural Grey Blending & Beard Tint',
                'badge' => 'COLOR ATELIER',
                'badge_style' => 'dark',
                'duration' => '50 Menit',
                'description' => 'Pewarnaan natural menyamarkan uban rambut & jenggot secara elegan tanpa meninggalkan kesan kaku buatan.',
                'price' => 320000,
                'price_formatted' => 'Rp 320.000',
                'image' => '/images/atelier/barbershop_hair_coloring_1791385558445.jpg',
                'fallback_image' => '',
            ],
            [
                'id' => 'father-son-package',
                'category' => 'FAMILY CONCIERGE',
                'title' => 'Father & Son Atelier Bonding Cut',
                'badge' => 'SPECIAL DUO',
                'badge_style' => 'gold',
                'duration' => '75 Menit',
                'description' => 'Sesi potong rambut bersebelahan di kursi VIP untuk ayah & putra, termasuk styling, hot chocolate & espresso concierge.',
                'price' => 380000,
                'price_formatted' => 'Rp 380.000',
                'image' => 'https://images.unsplash.com/photo-1599351431202-1e0f0137899a?w=800&auto=format&fit=crop&q=80',
                'fallback_image' => '',
            ],
        ]);

        // 3. PARA MAESTRO PENATA RAMBUT (MASTER BARBER BERTUGAS HARI INI) - PERSIS GAMBAR
        $barbers = [
            [
                'id' => 'yudha',
                'name' => 'Yudha Pratama',
                'title' => 'SENIOR MASTER BARBER',
                'experience' => '11 Th Pengalaman',
                'rating' => '4.9',
                'reviews' => '184 Ulasan',
                'specialty' => 'Classic Fade & Taper Precision',
                'availability' => 'Sibuk (Sesi 16:30 Anda)',
                'is_current_for_user' => $isMember ? true : false,
                'available_status' => 'busy_current',
                'avatar' => 'https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 'arya',
                'name' => 'Arya Daniswara',
                'title' => 'CREATIVE DIRECTOR',
                'experience' => '14 Th Pengalaman',
                'rating' => '4.9',
                'reviews' => '230 Ulasan',
                'specialty' => 'Textured Crop & Scissor Flow',
                'availability' => 'Tersedia pk. 17:15 WIB',
                'is_current_for_user' => false,
                'available_status' => 'available',
                'avatar' => 'https://images.unsplash.com/photo-1622286342621-4bd786c2447c?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 'kenzo',
                'name' => 'Kenzo Haryadi',
                'title' => 'BEARD & SCULPT SPECIALIST',
                'experience' => '9 Th Pengalaman',
                'rating' => '4.9',
                'reviews' => '156 Ulasan',
                'specialty' => 'Hot Towel Shave & Sculpting',
                'availability' => 'Tersedia pk. 18:00 WIB',
                'is_current_for_user' => false,
                'available_status' => 'available',
                'avatar' => 'https://images.unsplash.com/photo-1517832606589-7629c3395907?w=600&auto=format&fit=crop&q=80',
            ],
        ];

        // 4. STATISTIK SUITE & LOUNGE
        $suiteInfo = [
            'branch_name' => 'Senopati Suite, Jakarta Selatan',
            'full_address' => 'Senopati Suites No. 18, Kebayoran Baru',
            'shift' => 'Atelier Senopati Suite • Shift Siang/Malam',
            'empty_chairs' => 4,
            'total_chairs' => 8,
            'chair_status_text' => '4 KURSI KOSONG DARI 8',
        ];

        // 5. PRODUK GROOMING UNTUK MODAL
        $groomingProducts = [
            [
                'id' => 'pomade-matte',
                'name' => 'Atelier Gilt Matte Clay Pomade',
                'category' => 'Styling Hair Clay',
                'size' => '100 ml',
                'price' => 'Rp 185.000',
                'desc' => 'High hold dengan natural matte finish aromaterapi cedarwood & bergamot.',
                'image' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=500&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 'beard-oil-sandalwood',
                'name' => 'Botanical Beard & Stache Elixir',
                'category' => 'Beard Care & Nutrition',
                'size' => '50 ml',
                'price' => 'Rp 145.000',
                'desc' => 'Minyak argan & jojoba murni melembutkan kumis serta jenggot tanpa rasa lengket.',
                'image' => 'https://images.unsplash.com/photo-1608248597359-598d1a129d20?w=500&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 'cologne-sartorial',
                'name' => 'Sartorial Privé Eau De Parfum',
                'category' => 'Signature Fragrance',
                'size' => '75 ml',
                'price' => 'Rp 390.000',
                'desc' => 'Aroma mewah perpaduan dark amber, leather, dan bourbon vanilla khas Atelier lounge.',
                'image' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?w=500&auto=format&fit=crop&q=80',
            ],
        ];

        return Inertia::render('Barbershop/Visitor', [
            'initialTab' => $tab,
            'auth' => [
                'user' => $authUser,
                'isAdmin' => $authUser ? ($authUser->isAdmin() || $authUser->isBarbershop()) : false,
            ],
            'isMember' => $isMember,
            'memberData' => $memberData,
            'activeReservation' => $activeReservation,
            'services' => $services,
            'allServices' => $allServices,
            'barbers' => $barbers,
            'suiteInfo' => $suiteInfo,
            'groomingProducts' => $groomingProducts,
            'flash' => [
                'message' => session('success'),
                'newTicket' => session('new_ticket'),
            ],
        ]);
    }

    /**
     * Simpan Reservasi Baru (Mendukung Guest / Tanpa Akun & Member Langganan).
     */
    public function storeReservasi(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'phone' => 'required|string|max:30',
            'barber_id' => 'required|string',
            'service_id' => 'required|string',
            'tanggal' => 'required|string',
            'jam' => 'required|string',
            'catatan' => 'nullable|string|max:300',
        ]);

        // Mapping Data Barber
        $barberMap = [
            'yudha' => [
                'name' => 'Master Barber Yudha Pratama',
                'kursi' => 'Kursi VIP 02 • The Atelier Main Floor',
            ],
            'arya' => [
                'name' => 'Creative Director Arya Daniswara',
                'kursi' => 'Kursi VIP 01 • Master Suite',
            ],
            'kenzo' => [
                'name' => 'Specialist Kenzo Haryadi',
                'kursi' => 'Kursi VIP 03 • Shave Lounge',
            ],
        ];

        // Mapping Data Layanan
        $serviceMap = [
            'gentleman-royal-cut' => [
                'name' => 'Gentleman Royal Cut',
                'harga' => 250000,
                'harga_formatted' => 'Rp 250.000',
                'durasi' => '60 Menit',
            ],
            'signature-beard-sculpt' => [
                'name' => 'Signature Beard Sculpt',
                'harga' => 120000,
                'harga_formatted' => 'Rp 120.000',
                'durasi' => '30 Menit',
            ],
            'scalp-detox-treatment' => [
                'name' => 'Scalp Detox Treatment',
                'harga' => 150000,
                'harga_formatted' => 'Rp 150.000',
                'durasi' => '40 Menit',
            ],
            'royal-shave-ritual' => [
                'name' => 'The Sovereign Hot Shave Ritual',
                'harga' => 180000,
                'harga_formatted' => 'Rp 180.000',
                'durasi' => '45 Menit',
            ],
            'hair-coloring-grey-blend' => [
                'name' => 'Natural Grey Blending & Beard Tint',
                'harga' => 320000,
                'harga_formatted' => 'Rp 320.000',
                'durasi' => '50 Menit',
            ],
            'father-son-package' => [
                'name' => 'Father & Son Atelier Bonding Cut',
                'harga' => 380000,
                'harga_formatted' => 'Rp 380.000',
                'durasi' => '75 Menit',
            ],
        ];

        $selectedBarber = $barberMap[$validated['barber_id']] ?? [
            'name' => 'Master Barber On Duty',
            'kursi' => 'Kursi VIP 04 • The Atelier Suite',
        ];

        $selectedService = $serviceMap[$validated['service_id']] ?? [
            'name' => 'Gentleman Royal Cut',
            'harga' => 250000,
            'harga_formatted' => 'Rp 250.000',
            'durasi' => '60 Menit',
        ];

        // Generate Nomor Antrean Baru
        $queueNumber = 'A-' . str_pad(rand(17, 45), 3, '0', STR_PAD_LEFT);
        $ticketId = 'EPASS-' . strtoupper(substr(md5(uniqid()), 0, 8));

        $newReservation = [
            'id' => $ticketId,
            'nomor_antrean' => $queueNumber,
            'status' => 'Dikonfirmasi • Menunggu Giliran',
            'est_pelayanan' => 'Est. Pelayanan ' . $validated['jam'],
            'jam_pelayanan' => $validated['jam'],
            'client_name' => $validated['nama'],
            'client_phone' => $validated['phone'],
            'is_guest' => !Auth::check(),
            'barber' => [
                'name' => $selectedBarber['name'],
                'kursi' => $selectedBarber['kursi'],
                'experience' => 'Master Stylist',
            ],
            'paket' => [
                'name' => $selectedService['name'],
                'kategori' => 'Atelier Grooming Service',
                'durasi' => $selectedService['durasi'],
                'harga' => $selectedService['harga'],
                'harga_formatted' => $selectedService['harga_formatted'],
            ],
            'lokasi' => 'Senopati Suites No. 18, Kebayoran Baru',
            'kota' => 'Jakarta Selatan',
            'qr_code' => $ticketId,
            'tanggal' => $validated['tanggal'],
            'catatan' => $validated['catatan'] ?? 'Reservasi tamu via website pengunjung Atelier Gilt',
            'created_at' => now()->format('H:i') . ' WIB',
        ];

        // Simpan ke sesi agar pengunjung (guest / member) langsung dapat mengakses e-Pass
        session(['guest_reservation' => $newReservation]);
        session(['new_ticket' => $newReservation]);

        return redirect()->route('barbershop.landing')->with('success', "Reservasi Berhasil Dikonfirmasi! Nomor Antrean Anda: {$queueNumber}");
    }

    /**
     * 1-Klik Cepat Beralih ke Akun Langganan / Member VIP Raditya Pratama.
     */
    public function quickLogin(Request $request)
    {
        // Cari atau buat user Raditya Pratama
        $user = User::firstOrCreate(
            ['email' => 'raditya@lstyle.id'],
            [
                'username' => 'raditya',
                'name' => 'Raditya Pratama',
                'password' => bcrypt('raditya123'),
                'role' => 'barbershop_member',
                'nomor_kartu' => 'VIP-016',
                'kota' => 'Jakarta Selatan',
                'email_verified_at' => now(),
            ]
        );

        Auth::login($user);
        session(['is_barber_vip' => true]);

        return redirect()->route('barbershop.landing')->with('success', 'Selamat datang kembali, Raditya Pratama! Akun Platinum VIP aktif.');
    }

    /**
     * 1-Klik Keluar / Beralih ke Mode Tamu (Tanpa Akun).
     */
    public function quickLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('barbershop.landing', ['mode' => 'guest'])->with('success', 'Anda sekarang berada dalam mode Pengunjung Tamu (Tanpa Akun).');
    }

    /**
     * Cek status tiket antrean via kode antrean.
     */
    public function getTiket($code = null)
    {
        $code = strtoupper($code ?? request('kode', 'A-016'));
        
        $ticket = [
            'nomor_antrean' => $code,
            'status' => 'Dikonfirmasi • Menunggu Giliran',
            'nama' => 'Raditya Pratama',
            'barber' => 'Master Barber Yudha Pratama',
            'kursi' => 'Kursi VIP 02 • The Atelier Main Floor',
            'layanan' => 'The Executive Royal Cut & Hot Towel Finish',
            'est_pelayanan' => '16:30 WIB',
            'lokasi' => 'Senopati Suites No. 18, Kebayoran Baru, Jakarta Selatan',
            'qr' => "EPASS-{$code}-VERIFIED",
        ];

        return response()->json([
            'success' => true,
            'ticket' => $ticket,
        ]);
    }
}

