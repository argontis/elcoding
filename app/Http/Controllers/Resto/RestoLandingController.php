<?php

namespace App\Http\Controllers\Resto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestoLandingController extends Controller
{
    /**
     * Halaman Utama Restaurant (Homepage)
     * URL: http://127.0.0.1:8000/restaurant
     */
    public function index(Request $request)
    {
        $restaurant = [
            'name'         => 'RestoHub Bistro',
            'tagline'      => 'Artisanal Cafe & Specialty Coffee',
            'branch'       => 'Cabang Clean Jakarta Selatan',
            'full_address' => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'phone'        => '+62 811-9233-889',
            'whatsapp'     => '628119233889',
            'wifi' => [
                'ssid'     => 'RestoHub_Guest',
                'password' => 'sedapnikmat2024',
            ],
            'hours' => [
                'weekday'    => 'Senin - Jumat: 09.00 - 22.30 WIB',
                'weekend'    => 'Sabtu - Minggu: 08.00 - 23.00 WIB',
                'last_order' => 'Dapur Terakhir (Last Order): 21.45 WIB',
            ],
            'status' => [
                'kitchen'  => 'Operasional Normal',
                'avg_time' => '14 Mnt',
                'queue'    => '8 Antrean #08',
                'node'     => 'v2.4 Clean POS',
            ],
            'active_table' => [
                'number' => '#04',
                'area'   => 'Semi-Outdoor',
                'status' => 'OPEN • 14 Meja / #04',
            ],
            'cart' => [
                'count' => 3,
                'total' => 'Rp 142.000',
            ],
        ];

        // 4 Menu Signature (Sesuai Foto Persis)
        $signatureMenus = [
            [
                'id' => 101,
                'category' => 'MAINS • WAGYU AUSTRALIA',
                'name' => 'Wagyu Truffle Rice Bowl with Onsen Egg',
                'desc' => 'Nasi butter pulen berbalut potongan wagyu MB5 panggang medium-well, saus truffle harum gurih, dan telur onsen lembut.',
                'price' => 'Rp 88.000',
                'badge' => 'Best Seller',
                'badge_color' => 'bg-amber-500 text-white',
                'tag' => 'Level 1 Mild',
                'image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 102,
                'category' => 'PASTA • ARTISANAL RECIPE',
                'name' => 'Smoked Beef Carbonara Fettuccine',
                'desc' => 'Fettuccine handmade dibuat harian, saus telur emulsion otentik Roma, smoked beef gurih renyah, dan taburan grana padano.',
                'price' => 'Rp 68.000',
                'badge' => "Chef's Pick",
                'badge_color' => 'bg-red-700 text-white',
                'tag' => 'Pasta Segar Buatan Rumah',
                'image' => 'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 103,
                'category' => 'BEVERAGE • BARISTA SPECIAL',
                'name' => 'Artisanal Dirty Aren Latte',
                'desc' => 'Susu dingin pasteurisasi kental dipadukan sirup gula aren organik, dan ekstraksi double ristretto biji kopi House Blend Aceh Gayo.',
                'price' => 'Rp 38.000',
                'badge' => 'Signature Brew',
                'badge_color' => 'bg-orange-800 text-white',
                'tag' => 'House Blend Aceh Gayo',
                'image' => 'https://images.unsplash.com/photo-1541167760496-1628856ab772?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'id' => 104,
                'category' => 'DESSERT • FRENCH PASTRY',
                'name' => 'Basque Burnt Cheesecake Berry',
                'desc' => 'Krim keju Spanyol dikaramelisasi bagian luar dengan tekstur tengah lumer lembut (molten), disajikan sirup compote buah berry segar.',
                'price' => 'Rp 45.000',
                'badge' => 'Freshly Baked',
                'badge_color' => 'bg-emerald-600 text-white',
                'tag' => 'Batch Terbatas',
                'image' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?w=600&auto=format&fit=crop&q=80',
            ],
        ];

        // 3 Langkah Santap Praktis
        $steps = [
            [
                'step' => '01',
                'title' => 'Scan QR Meja / Buka Web',
                'desc' => 'Arahkan kamera smartphone ke QR akrilik di meja Anda atau buka portal ini. Meja Anda langsung terverifikasi otomatis.',
                'check' => 'Tidak perlu instal aplikasi tambahan',
                'icon' => 'fa-solid fa-qrcode',
            ],
            [
                'step' => '02',
                'title' => 'Kustomisasi & Kirim Pesanan',
                'desc' => 'Atur tingkat kematangan daging, kadar gula kopi, catatan alergen, dan klik pesan. Tiket langsung cetak di dapur koki.',
                'check' => 'Real-time tracking estimasi menit saji',
                'icon' => 'fa-solid fa-sliders',
            ],
            [
                'step' => '03',
                'title' => 'Santap & Bayar Fleksibel',
                'desc' => 'Hidangan diantar hangat ke meja Anda. Bayar via QRIS instan di ponsel, kartu debit di meja, atau tunai di kasir selesai makan.',
                'check' => 'Otomatis kumpulkan poin reward loyalty',
                'icon' => 'fa-solid fa-money-bill-wave',
            ],
        ];

        // 3 Testimoni Pelanggan (Sesuai Foto Persis)
        $testimonials = [
            [
                'name' => 'Nadira Syahrani',
                'role' => 'Product Designer • Dine-in Meja #07',
                'comment' => '“Wagyu Truffle Rice Bowl-nya beneran luar biasa! Dagingnya melted banget dan onsen egg-nya sempurna. Fitur pesan di meja lewat web sangat responsif tanpa lag sama sekali.”',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=120&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Dimas Wicaksono',
                'role' => 'Founder Studio Kide • Reservasi VIP',
                'comment' => '“Sering bawa klien meeting makan siang di sini. Carbonara-nya otentik tanpa cream berlebih dan Dirty Aren Latte-nya nagih. Waktu saji beneran di bawah 15 menit!”',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=120&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Clarissa Putri',
                'role' => 'Content Creator • Regular Member Gold',
                'comment' => '“Tempatnya aesthetic dengan nuansa terracotta yang hangat. Cheesecake-nya juara buat nemenin ngobrol sore. Live KDS monitor bikin kita santai mantau pesanan.”',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=120&auto=format&fit=crop&q=80',
            ],
        ];

        return view('resto.landing', compact('restaurant', 'signatureMenus', 'steps', 'testimonials'));
    }

    /**
     * Halaman Menu Digital & Order (Pusat Informasi Menu & Pemesanan)
     * URL: http://127.0.0.1:8000/restaurant/menu
     */
    public function menuPage(Request $request)
    {
        $restaurant = [
            'name'         => 'RestoHub Bistro',
            'tagline'      => 'Artisanal Cafe & Specialty Coffee',
            'branch'       => 'Cabang Clean Jakarta Selatan',
            'full_address' => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'phone'        => '+62 811-9233-889',
            'whatsapp'     => '628119233889',
            'wifi' => [
                'ssid'     => 'RestoHub_Guest',
                'password' => 'sedapnikmat2024',
            ],
            'hours' => [
                'weekday'    => 'Senin - Jumat: 09.00 - 22.30 WIB',
                'weekend'    => 'Sabtu - Minggu: 08.00 - 23.00 WIB',
                'last_order' => 'Dapur Terakhir (Last Order): 21.45 WIB',
            ],
            'status' => [
                'kitchen'  => 'Operasional Normal',
                'avg_time' => '14 Mnt',
                'queue'    => '8 Antrean #08',
                'node'     => 'v2.4 Clean POS',
            ],
            'active_table' => [
                'number' => '#04',
                'area'   => 'Semi-Outdoor',
                'status' => 'OPEN • 14 Meja / #04',
            ],
            'cart' => [
                'count' => 3,
                'total' => 'Rp 142.000',
            ],
        ];

        // Featured Item Highlight
        $featuredItem = [
            'id' => 101,
            'name' => 'Wagyu Truffle Rice Bowl with Onsen Egg',
            'category' => 'Chef\'s Masterpiece • Signature Mains',
            'price' => 'Rp 88.000',
            'price_raw' => 88000,
            'desc' => 'Daging wagyu meltique harum aroma minyak truffle putih Alba asli, disajikan di atas nasi butter Jepang hangat, dilengkapi telur onsen setengah matang dan saus tare gurih manis.',
            'image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=600&auto=format&fit=crop&q=80',
            'badge' => 'Paling Banyak Dipesan',
            'time' => '12–15 Menit',
            'calories' => '540 kkal',
            'tags' => ['Daging Wagyu MB5 Halal', 'Truffle Oil Alba', 'Onsen Egg Pasteurisasi', 'Level Pedas 0-3'],
        ];

        // Makanan Utama & Pasta (Chef's Specialty)
        $makananUtama = [
            [
                'id' => 1,
                'name' => 'Wagyu Beef Striploin Meltique',
                'category' => 'makanan',
                'desc' => 'Daging striploin meltique lembut 200g dengan jus alami gurih pekat, disajikan dengan potato wedges krispi dan saus blackpepper madu.',
                'price' => 'Rp 125.000',
                'badge' => "Chef's Pick",
                'badge_color' => 'bg-amber-600 text-white',
                'image' => 'https://images.unsplash.com/photo-1558030006-450675393462?w=600&auto=format&fit=crop&q=80',
                'spec' => '200g Striploin',
                'time' => '15–20 mnt',
                'tags' => ['Blackpepper / Herb Butter', 'Tingkat Kematangan Pilihan'],
            ],
            [
                'id' => 2,
                'name' => 'Ayam Panggang Rosemary Madu',
                'category' => 'makanan',
                'desc' => 'Paha ayam marinasi 24 jam dengan madu hutan & rosemary segar, dipanggang oven hingga kecokelatan renyah dengan nasi mentega harum.',
                'price' => 'Rp 62.000',
                'badge' => 'Bestseller',
                'badge_color' => 'bg-emerald-600 text-white',
                'image' => 'https://images.unsplash.com/photo-1598103442097-8b74394b95c6?w=600&auto=format&fit=crop&q=80',
                'spec' => 'Quarter Herb Chicken',
                'time' => '12 mnt',
                'tags' => ['Honey Rosemary Jus', 'Ayam Organik Halal'],
            ],
            [
                'id' => 3,
                'name' => 'Smoked Beef Carbonara Fettuccine',
                'category' => 'makanan',
                'desc' => 'Fettuccine handmade segar dibuat setiap pagi, saus telur emulsion otentik Roma, potongan smoked beef renyah, dan taburan keju Grana Padano.',
                'price' => 'Rp 68.000',
                'badge' => 'Otentik Italia',
                'badge_color' => 'bg-red-700 text-white',
                'image' => 'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=600&auto=format&fit=crop&q=80',
                'spec' => 'Handmade Pasta 180g',
                'time' => '10 mnt',
                'tags' => ['Pasta Segar Tanpa Pengawet', 'Grana Padano Cheese'],
            ],
            [
                'id' => 4,
                'name' => 'Spaghetti Aglio Olio Salmon',
                'category' => 'makanan',
                'desc' => 'Al dente spaghetti ditumis minyak zaitun extra virgin, irisan bawang putih aromatik, potongan fillet salmon Norwegia panggang, dan chili flakes.',
                'price' => 'Rp 74.000',
                'badge' => 'Pilihan Sehat',
                'badge_color' => 'bg-cyan-700 text-white',
                'image' => 'https://images.unsplash.com/photo-1551183053-bf91a1d81141?w=600&auto=format&fit=crop&q=80',
                'spec' => 'Fillet Salmon Norwegia',
                'time' => '12 mnt',
                'tags' => ['Omega-3 Tinggi', 'Level Pedas 1-5'],
            ],
            [
                'id' => 5,
                'name' => 'Nasi Goreng Sei Sapi Sambal Matah',
                'category' => 'makanan',
                'desc' => 'Aroma asap kayu kosambi otentik pada sei sapi berpadu kesegaran sambal matah Bali, telur mata sapi renyah, dan emping melinjo gurih.',
                'price' => 'Rp 58.000',
                'badge' => 'Favorit Nusantara',
                'badge_color' => 'bg-orange-800 text-white',
                'image' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=600&auto=format&fit=crop&q=80',
                'spec' => 'Sei Sapi Asap Kosambi',
                'time' => '10 mnt',
                'tags' => ['Sambal Matah Segar', 'Telur Ceplok Crispy'],
            ],
            [
                'id' => 6,
                'name' => 'Crispy Truffle Fries with Herb Dip',
                'category' => 'makanan',
                'desc' => 'Kentang goreng impor potongan tebal berlapis minyak truffle Alba dan bubuk keju parmesan, disajikan bersama saus herb dip buatan rumah.',
                'price' => 'Rp 38.000',
                'badge' => 'Appetizer',
                'badge_color' => 'bg-stone-700 text-white',
                'image' => 'https://images.unsplash.com/photo-1576107232684-1279f3908594?w=600&auto=format&fit=crop&q=80',
                'spec' => 'Porsi Sharing 2-3 Orang',
                'time' => '8 mnt',
                'tags' => ['Camilan Favorit', 'Parmesan Crust'],
            ],
        ];

        // Minuman & Specialty Coffee (Barista Craft)
        $minumanKopi = [
            [
                'id' => 7,
                'name' => 'Artisanal Dirty Aren Latte',
                'category' => 'minuman',
                'desc' => 'Susu dingin pasteurisasi kental dipadukan sirup gula aren organik Garut, dituangkan double ristretto biji kopi House Blend Aceh Gayo & Bajawa.',
                'price' => 'Rp 38.000',
                'badge' => '#1 Best Coffee',
                'badge_color' => 'bg-amber-700 text-white',
                'image' => 'https://images.unsplash.com/photo-1541167760496-1628856ab772?w=600&auto=format&fit=crop&q=80',
                'spec' => 'Iced Only • Double Shot',
                'time' => '3 mnt',
                'tags' => ['Gula Aren Organik', 'House Blend Aceh Gayo'],
            ],
            [
                'id' => 8,
                'name' => 'Berry Hibiscus Cold Brew',
                'category' => 'minuman',
                'desc' => 'Seduhan dingin bunga rosella 14 jam dipadukan sari buah raspberry liar segar dan soda alami, menyegarkan tanpa kandungan kafein.',
                'price' => 'Rp 38.000',
                'badge' => 'Caffeine-Free',
                'badge_color' => 'bg-rose-700 text-white',
                'image' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=600&auto=format&fit=crop&q=80',
                'spec' => 'Pure Botanical Herbal Infusion',
                'time' => '3 mnt',
                'tags' => ['Cold Brew 14 Jam', '100% Herbal Alami'],
            ],
            [
                'id' => 9,
                'name' => 'Matcha Kyoto Cloud',
                'category' => 'minuman',
                'desc' => 'Matcha ceremonial grade asli Uji Kyoto berpadu krim mascarpone awan lembut gurih dan susu segar kental manis seimbang.',
                'price' => 'Rp 42.000',
                'badge' => 'Grade A Uji',
                'badge_color' => 'bg-emerald-700 text-white',
                'image' => 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?w=600&auto=format&fit=crop&q=80',
                'spec' => 'Rich Cream Mascarpone',
                'time' => '4 mnt',
                'tags' => ['Kyoto Uji Green Tea', 'Cream Cheese Cloud'],
            ],
            [
                'id' => 10,
                'name' => 'Basque Burnt Cheesecake Berry',
                'category' => 'minuman',
                'desc' => 'Krim keju Spanyol dikaramelisasi bagian luar dengan tekstur tengah lumer lembut (molten), disajikan sirup compote buah berry segar.',
                'price' => 'Rp 45.000',
                'badge' => 'Freshly Baked',
                'badge_color' => 'bg-emerald-600 text-white',
                'image' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?w=600&auto=format&fit=crop&q=80',
                'spec' => 'Slice 140g',
                'time' => 'Ready to Serve',
                'tags' => ['Batch Terbatas Harian', 'Imported Cream Cheese'],
            ],
        ];

        return view('resto.menu', compact('restaurant', 'featuredItem', 'makananUtama', 'minumanKopi'));
    }

    /**
     * Halaman Reservasi Meja & Tata Letak (Pusat Informasi Reservasi)
     * URL: http://127.0.0.1:8000/restaurant/reservasi
     */
    public function reservasiPage(Request $request)
    {
        $restaurant = [
            'name'         => 'RestoHub Bistro',
            'tagline'      => 'Artisanal Cafe & Specialty Coffee',
            'branch'       => 'Cabang Clean Jakarta Selatan',
            'full_address' => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'phone'        => '+62 811-9233-889',
            'whatsapp'     => '628119233889',
            'wifi' => [
                'ssid'     => 'RestoHub_Guest',
                'password' => 'sedapnikmat2024',
            ],
            'hours' => [
                'weekday'    => 'Senin - Jumat: 09.00 - 22.30 WIB',
                'weekend'    => 'Sabtu - Minggu: 08.00 - 23.00 WIB',
                'last_order' => 'Dapur Terakhir (Last Order): 21.45 WIB',
            ],
            'status' => [
                'kitchen'  => 'Operasional Normal',
                'avg_time' => '14 Mnt',
                'queue'    => '8 Antrean #08',
                'node'     => 'v2.4 Clean POS',
            ],
            'active_table' => [
                'number' => '#04',
                'area'   => 'Semi-Outdoor',
                'status' => 'OPEN • 14 Meja / #04',
            ],
            'cart' => [
                'count' => 3,
                'total' => 'Rp 142.000',
            ],
        ];

        // Statistik Kapasitas Meja
        $tableStats = [
            'total_meja'     => 24,
            'total_kursi'    => 120,
            'meja_terisi'    => 14,
            'meja_siap'      => 6,
            'meja_reserved'  => 4,
            'booking_sla'    => 'Konfirmasi Instan ±5 Menit',
        ];

        // 3 Area Tempat Duduk & Fasilitas
        $areas = [
            [
                'id' => 'indoor',
                'name' => 'Indoor Dining Room (AC & No Smoking)',
                'badge' => 'Paling Favorit Keluarga',
                'badge_color' => 'bg-emerald-600 text-white',
                'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&auto=format&fit=crop&q=80',
                'desc' => 'Ruang santap ber-AC sejuk dengan tata cahaya hangat, kursi sofa empuk, bebas asap rokok, dan stopkontak di setiap sudut meja. Sangat nyaman untuk santap keluarga & makan siang kantor.',
                'features' => [
                    'Kapasitas: 12 Meja (2, 4, 6 Pax)',
                    'Full AC & Air Purifier Higienis',
                    'Stopkontak Colokan di Setiap Meja',
                    'Tersedia Kursi Khusus Balita (Baby Chair)',
                ],
            ],
            [
                'id' => 'outdoor',
                'name' => 'Semi-Outdoor Greenery (Smoking Area)',
                'badge' => 'Nuansa Taman Asri',
                'badge_color' => 'bg-amber-600 text-white',
                'image' => 'https://images.unsplash.com/photo-1543007630-9710e4a00a20?w=800&auto=format&fit=crop&q=80',
                'desc' => 'Area semi-terbuka dengan sirkulasi udara alami dikelilingi tanaman hias hijau tropis dan nuansa dinding bata terracotta. Area yang diperbolehkan untuk merokok sambil menikmati specialty coffee sore hari.',
                'features' => [
                    'Kapasitas: 8 Meja (2, 4, 8 Pax)',
                    'Smoking Friendly & Sirkulasi Alami',
                    'Aesthetic Terracotta & Lampu Gantung Hangat',
                    'Meja Bar Pinggir Taman Santai',
                ],
            ],
            [
                'id' => 'vip',
                'name' => 'Private VIP Room (Meeting & Event)',
                'badge' => 'Kolektif 10–30 Orang',
                'badge_color' => 'bg-purple-700 text-white',
                'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&auto=format&fit=crop&q=80',
                'desc' => 'Ruangan khusus privat tertutup dengan kaca akustik kedap suara, dilengkapi fasilitas Smart TV/Proyektor HDMI nirkabel, whiteboard, audio mandiri, dan layanan waiter eksklusif.',
                'features' => [
                    'Kapasitas: 10–30 Pax (Meja Konferensi/Perjamuan)',
                    'Smart TV 65 Inch & Kabel Presentasi Nirkabel',
                    'Koneksi Wi-Fi Dedikasi 100 Mbps',
                    'Pilihan Paket Menu Prasmanan / Set Course',
                ],
            ],
        ];

        // Pilihan Sesi Kunjungan
        $timeSlots = [
            '11.30 WIB - 13.00 WIB (Sesi Lunch 1)',
            '13.00 WIB - 14.30 WIB (Sesi Lunch 2)',
            '16.00 WIB - 17.30 WIB (Sesi Afternoon Coffee & Sunset)',
            '18.30 WIB - 20.00 WIB (Sesi Dinner Utama Peak Hour)',
            '20.00 WIB - 21.30 WIB (Sesi Late Dinner & Chill)',
        ];

        return view('resto.reservasi', compact('restaurant', 'tableStats', 'areas', 'timeSlots'));
    }

    /**
     * Halaman Status Pesanan & Live Kitchen Display System (KDS)
     * URL: http://127.0.0.1:8000/restaurant/status-pesanan
     */
    public function statusPage(Request $request)
    {
        $restaurant = [
            'name'         => 'RestoHub Bistro',
            'tagline'      => 'Artisanal Cafe & Specialty Coffee',
            'branch'       => 'Cabang Clean Jakarta Selatan',
            'branch_full'  => 'Cabang Clean (Jakarta Selatan)',
            'full_address' => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'phone'        => '+62 811-9233-889',
            'whatsapp'     => '628119233889',
            'wifi' => [
                'ssid'     => 'RestoHub_Guest',
                'password' => 'sedapnikmat2024',
            ],
            'hours' => [
                'weekday'    => 'Senin - Jumat: 09.00 - 22.30 WIB',
                'weekend'    => 'Sabtu - Minggu: 08.00 - 23.00 WIB',
                'last_order' => 'Dapur Terakhir (Last Order): 21.45 WIB',
            ],
            'active_table' => [
                'number' => '#04',
                'area'   => 'Semi-Outdoor',
                'status' => 'OPEN • Meja #04',
                'url'    => 'localhost:8000/clean',
            ],
            'cart' => [
                'count' => 3,
                'total' => 'Rp 142.000',
            ],
        ];

        // Data Pesanan Aktif (Order #ORD-8821 Sesuai Screenshot)
        $order = [
            'code'           => '#ORD-8821',
            'table_number'   => 'Meja #04',
            'table_type'     => 'Dine-In Tebet Clean',
            'customer_name'  => 'Rian Pratama (0812-9988-xxxx)',
            'order_time'     => '12:40 WIB (Waktu Pemesanan)',
            'server_status'  => 'Terhubung Live POS Server 02',
            'payment_status' => 'LUNAS QRIS BCA (Ref: QR-992104)',
            'auth_code'      => 'AUTH-0988472-X',
            'tax_note'       => 'PB1 10% Included',
            'payment_method' => 'QRIS BCA Interaktif',
            'total_amount'   => 'Rp 142.000',
        ];

        // 5 Langkah Progres Dapur & Bar
        $timelineSteps = [
            [
                'step'        => 1,
                'title'       => '1. Pesanan Diterima di Sistem',
                'time_badge'  => '12:40 WIB',
                'desc'        => 'Struk order tercetak otomatis pada terminal POS & Kitchen Routing.',
                'status'      => 'done', // done, active, pending
            ],
            [
                'step'        => 2,
                'title'       => '2. Dikonfirmasi Kasir & Masuk Antrean KDS',
                'time_badge'  => '12:41 WIB',
                'desc'        => 'Pembayaran QRIS BCA terverifikasi otomatis. Slot wajan & barista dialokasikan.',
                'status'      => 'done',
            ],
            [
                'step'        => 3,
                'title'       => '3. Sedang Dimasak di Dapur Utama',
                'time_badge'  => 'BERJALAN 75%',
                'target_time' => 'Target: 12:55 WIB',
                'desc'        => 'Chef Budi sedang memanggang Wagyu Meltique di Griddle & Chef Anita sedang menumis Salmon Aglio Olio.',
                'status'      => 'active',
                'progress'    => 75,
            ],
            [
                'step'        => 4,
                'title'       => '4. Quality Check & Sentuhan Plating',
                'time_badge'  => 'Menunggu antrean',
                'desc'        => 'Pemeriksaan suhu sajian, ketepatan alergen, dan sentuhan microgreens.',
                'status'      => 'pending',
            ],
            [
                'step'        => 5,
                'title'       => '5. Disajikan Hangat di Meja #04',
                'time_badge'  => 'Tahap akhir',
                'desc'        => 'Runner mengantar nampan pesanan langsung ke meja pemesan.',
                'status'      => 'pending',
            ],
        ];

        // Kesiapan Tiap Item Hidangan (Total 3 Menu / 4 Porsi)
        $orderItems = [
            [
                'qty_name'    => '2x Signature Aren Latte',
                'variants'    => 'Less Sweet • Oatmilk',
                'status_text' => 'Sudah Diantar ke Meja',
                'status_type' => 'served', // served, cooking, plating
                'station'     => 'Barista Station #01 (Espresso Bar)',
                'icon'        => 'fa-mug-hot',
            ],
            [
                'qty_name'    => '1x Wagyu Truffle Rice Bowl',
                'variants'    => 'Tingkat Medium • Telur Onsen',
                'status_text' => 'Griddle Cooking (75%)',
                'eta'         => 'Est. Siap: 3 Menit lagi',
                'status_type' => 'cooking',
                'station'     => 'Hot Kitchen Station #02 • Chef Budi',
                'icon'        => 'fa-bowl-rice',
            ],
            [
                'qty_name'    => '1x Spaghetti Aglio Olio Salmon',
                'variants'    => 'Level Pedas 2 • Crispy Garlic',
                'status_text' => 'Plating & Garnish (90%)',
                'eta'         => 'Est. Siap: 1 Menit lagi',
                'status_type' => 'plating',
                'station'     => 'Pasta & Saute Station • Chef Anita',
                'icon'        => 'fa-utensils',
            ],
        ];

        // Kitchen Telemetry Data
        $telemetry = [
            'percent'       => 75,
            'eta_clock'     => '12:55 WIB',
            'remaining_min' => '~4 Menit',
            'note'          => 'Dihitung berdasarkan kapasitas 6 wajan aktif dan urutan antrean tiket ke-3.',
            'sla_status'    => 'SLA Hijau (On-Track)',
            'cam_tag'       => 'CAM 02',
            'cam_title'     => 'Open Kitchen Clean Branch',
            'cam_desc'      => 'Kamera Dapur Utama • Higienitas 100%',
            'cam_status'    => 'Terpantau KDS Monitor',
            'cam_image'     => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&auto=format&fit=crop&q=80',
        ];

        return view('resto.status', compact('restaurant', 'order', 'timelineSteps', 'orderItems', 'telemetry'));
    }

    /**
     * Halaman Pusat Informasi Member & Poin Loyalty (Public Info Page)
     * URL: http://127.0.0.1:8000/restaurant/member-poin
     */
    public function memberInfoPage(Request $request)
    {
        $restaurant = [
            'name'         => 'RestoHub Bistro',
            'tagline'      => 'Artisanal Cafe & Specialty Coffee',
            'branch'       => 'Cabang Clean Jakarta Selatan',
            'branch_full'  => 'Cabang Clean (Jakarta Selatan)',
            'full_address' => 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.',
            'phone'        => '+62 811-9233-889',
            'whatsapp'     => '628119233889',
            'wifi' => [
                'ssid'     => 'RestoHub_Guest',
                'password' => 'sedapnikmat2024',
            ],
            'hours' => [
                'weekday'    => 'Senin - Jumat: 09.00 - 22.30 WIB',
                'weekend'    => 'Sabtu - Minggu: 08.00 - 23.00 WIB',
                'last_order' => 'Dapur Terakhir (Last Order): 21.45 WIB',
            ],
            'active_table' => [
                'number' => '#04',
                'area'   => 'Semi-Outdoor',
                'status' => 'OPEN • 14 Meja / #04',
            ],
            'cart' => [
                'count' => 0,
                'total' => 'Rp 0',
            ],
        ];

        // Tingkatan Keanggotaan
        $memberTiers = [
            [
                'id'          => 'silver',
                'name'        => 'Silver Member',
                'subtitle'    => 'Mulai dari Rp 0',
                'icon'        => 'fa-medal',
                'color_from'  => '#94a3b8',
                'color_to'    => '#64748b',
                'badge_bg'    => 'bg-slate-100',
                'badge_text'  => 'text-slate-600',
                'border'      => 'border-slate-200',
                'benefits'    => [
                    '1 Poin per transaksi Rp 10.000',
                    'Welcome drink artisan tea',
                    'Akses Wi-Fi High-Speed bistro',
                ],
                'status'      => 'Terlevel ✓',
                'is_current'  => false,
            ],
            [
                'id'          => 'gold',
                'name'        => 'Gold Gourmet',
                'subtitle'    => 'Total Belanja > Rp 1.500.000',
                'icon'        => 'fa-crown',
                'color_from'  => '#d97706',
                'color_to'    => '#b45309',
                'badge_bg'    => 'bg-amber-100',
                'badge_text'  => 'text-amber-800',
                'border'      => 'border-amber-300',
                'benefits'    => [
                    'Bonus Poin 1.5x Lipat',
                    'Free Birthday Basque Cheesecake',
                    'Prioritas Reservasi Meja VIP',
                    'Diskon 10% Merchandise Biji Kopi',
                ],
                'status'      => 'Level Menengah',
                'is_current'  => true,
                'level_badge' => 'LEVEL ANDA',
            ],
            [
                'id'          => 'platinum',
                'name'        => 'Platinum Epicurean',
                'subtitle'    => 'Total Belanja > Rp 3.000.000',
                'icon'        => 'fa-gem',
                'color_from'  => '#7c3aed',
                'color_to'    => '#4f46e5',
                'badge_bg'    => 'bg-purple-100',
                'badge_text'  => 'text-purple-800',
                'border'      => 'border-purple-200',
                'benefits'    => [
                    'Bonus Poin 2.0x Lipat Tiap Pesanan',
                    'Undangan Eksklusif Chef Tasting Table',
                    'Bebas Biaya Reservasi Private Room',
                    'Personal Barista Cupping Session',
                ],
                'status'      => 'Kurang Rp 550.000 Lagi',
                'is_current'  => false,
                'locked'      => true,
            ],
        ];

        // Reward Penukaran Poin (Contoh Kosong)
        $rewardItems = [
            [
                'id'          => 1,
                'title'       => 'Diskon Rp 50.000 All Menu',
                'desc'        => 'Potongan langsung tanpa syarat minimal pembelian. Dapat digabung dengan promo harian.',
                'poin'        => 500,
                'badge'       => 'Voucher Potongan',
                'badge_color' => 'bg-amber-100 text-amber-800',
                'note'        => 'Masa simpan 30 hari pasca tukar',
                'icon'        => '🎟️',
                'category'    => 'diskon',
            ],
            [
                'id'          => 2,
                'title'       => 'Gratis 1x Artisanal Aren Latte',
                'desc'        => 'Single-origin espresso Aceh Gayo dipadu sirup aren organik cair dan susu/orim lembut.',
                'poin'        => 350,
                'badge'       => 'Best Seller Kopi',
                'badge_color' => 'bg-orange-100 text-orange-800',
                'note'        => 'Bisa Ice atau Hot (Dine-In/Takeaway)',
                'icon'        => '☕',
                'category'    => 'minuman',
            ],
            [
                'id'          => 3,
                'title'       => 'Gratis Basque Burnt Cheesecake',
                'desc'        => 'Karamelisasi burnt crusted autentik dengan keju mascarpone meleleh di bagian tengah.',
                'poin'        => 450,
                'badge'       => 'Chef Recommendation',
                'badge_color' => 'bg-rose-100 text-rose-800',
                'note'        => 'Fresh daily baked setiap pagi pukul 10.00',
                'icon'        => '🍰',
                'category'    => 'dessert',
            ],
            [
                'id'          => 4,
                'title'       => 'Upgrade Ukuran Minuman ke Large',
                'desc'        => 'Upgrade minuman pilihan dari Regular ke Large size secara gratis untuk 1 transaksi.',
                'poin'        => 150,
                'badge'       => 'Upgrade Spesial',
                'badge_color' => 'bg-cyan-100 text-cyan-800',
                'note'        => 'Berlaku untuk semua minuman panas/dingin',
                'icon'        => '🥤',
                'category'    => 'minuman',
            ],
            [
                'id'          => 5,
                'title'       => 'Diskon 10% Merchandise Kopi',
                'desc'        => 'Potongan harga 10% untuk pembelian biji kopi, tumbler, atau merchandise RestoHub.',
                'poin'        => 200,
                'badge'       => 'Merchandise',
                'badge_color' => 'bg-emerald-100 text-emerald-800',
                'note'        => 'Tidak berlaku untuk item diskon',
                'icon'        => '🛍️',
                'category'    => 'merchandise',
            ],
            [
                'id'          => 6,
                'title'       => 'Free Dessert Pilihan Chef',
                'desc'        => 'Dessert pilihan harian dari chef — bisa berupa macaron, cookies artisanal, atau mini cake.',
                'poin'        => 300,
                'badge'       => 'Daily Special',
                'badge_color' => 'bg-pink-100 text-pink-800',
                'note'        => 'Stok terbatas per hari, subject to availability',
                'icon'        => '🍩',
                'category'    => 'dessert',
            ],
        ];

        // FAQ Membership
        $faqs = [
            [
                'q' => 'Bagaimana cara bergabung menjadi Member RestoHub Gourmet Club?',
                'a' => 'Pendaftaran gratis cukup dengan meminta barista atau kasir untuk mendaftarkan nomor telepon Anda saat transaksi pertama. Kartu member digital langsung aktif dan poin mulai dikumpulkan sejak transaksi hari itu.',
            ],
            [
                'q' => 'Bagaimana cara mendapatkan dan mengumpulkan Poin Loyalty?',
                'a' => 'Setiap transaksi senilai Rp 10.000 menghasilkan 1 Poin Loyalty. Poin dihitung otomatis oleh sistem POS saat pembayaran dikonfirmasi, baik dine-in maupun takeaway. Member Gold mendapat bonus 1.5x, Platinum 2x lipat.',
            ],
            [
                'q' => 'Berapa lama masa berlaku Poin Loyalty saya?',
                'a' => 'Poin aktif berlaku selama 12 bulan sejak tanggal perolehan. Poin hasil penukaran reward memiliki masa aktif 30 hari. Poin tidak hangus selama ada transaksi minimal 1x dalam 6 bulan terakhir.',
            ],
            [
                'q' => 'Apakah poin bisa ditransfer ke akun lain atau digabungkan?',
                'a' => 'Poin bersifat personal dan terikat pada nomor telepon terdaftar. Tidak dapat dipindahkan, digabungkan, atau diuangkan. Penukaran harus dilakukan langsung oleh pemilik akun di lokasi cabang.',
            ],
            [
                'q' => 'Bagaimana cara naik ke level Gold atau Platinum?',
                'a' => 'Level naik otomatis saat akumulasi belanja mencapai batas tier. Gold: total belanja kumulatif ≥ Rp 1.500.000. Platinum: ≥ Rp 3.000.000. Perhitungan belanja dimulai dari tanggal pendaftaran member.',
            ],
        ];

        return view('resto.member-poin', compact('restaurant', 'memberTiers', 'rewardItems', 'faqs'));
    }
}


