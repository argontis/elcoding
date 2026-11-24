<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SaasProduct;
use App\Models\ProsalUnit;
use App\Models\ProsalTenant;
use App\Models\ProsalMaintenance;
use App\Models\ProsalFinance;
use App\Models\TravelPackage;
use App\Models\TravelParticipant;
use App\Models\TravelFleet;
use App\Models\BengkelWorkOrder;
use App\Models\BengkelService;
use App\Models\BengkelCustomer;
use App\Models\BimbelStudent;
use App\Models\BimbelSchedule;
use App\Models\BimbelInvoice;
use App\Models\BimbelMaterial;
use App\Models\RestoMenu;
use App\Models\RestoTable;
use App\Models\RestoOrder;
use App\Models\RestoIngredient;
use App\Models\TechfixTicket;
use App\Models\TechfixPart;
use App\Models\TechfixTransaction;
use App\Models\KlinikPatient;
use App\Models\KlinikDoctor;
use App\Models\KlinikQueue;
use App\Models\KlinikMedicine;
use App\Models\CrmLead;
use App\Models\CrmDeal;
use App\Models\CrmTask;

class SaasDemoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. KATALOG SAAS PRODUCTS
        $products = [
            [
                'name' => 'L-Clean Laundry',
                'slug' => 'clean',
                'category' => 'Laundry & Fasilitas',
                'tagline' => 'Sistem Operasional Laundry Kiloan & Satuan Modern',
                'description' => 'Monitoring antrean cuci, kontrol mesin cuci, pencatatan deposit saldo member, dan nota digital via WhatsApp terintegrasi.',
                'thumbnail' => '/gambar/aset/clean-saas.png',
                'target_url' => '/clean/dashboard',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'L-Garage Workshop',
                'slug' => 'bengkel',
                'category' => 'Otomotif & Bengkel',
                'tagline' => 'Manajemen Antrean Pit Bay & Work Order Servis Kendaraan',
                'description' => 'Pelacakan status pengerjaan servis mobil/motor di 4 stall PIT bay, estimasi biaya suku cadang, dan riwayat perbaikan pelanggan.',
                'thumbnail' => '/gambar/aset/bengkel-saas.png',
                'target_url' => '/bengkel/dashboard',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Atelier Gilt Barbershop',
                'slug' => 'barbershop',
                'category' => 'Lifestyle & Grooming',
                'tagline' => 'Executive Grooming Concierge & Salon Privé Platform',
                'description' => 'Sistem reservasi kursi VIP private room, e-Pass antrean digital, komisi stylist, dan manajemen loyalty membership pelanggan.',
                'thumbnail' => '/gambar/aset/barber-saas.png',
                'target_url' => '/barbershop/dashboard',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'RestoHub OS',
                'slug' => 'resto',
                'category' => 'F&B & Restoran',
                'tagline' => 'Kitchen Display System & Smart Point of Sale Restoran',
                'description' => 'Pesanan meja instan, integrasi layar dapur KDS secara live, manajemen stok resep bahan baku, serta laporan kasir harian.',
                'thumbnail' => '/gambar/aset/resto-saas.png',
                'target_url' => '/resto/dashboard',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'EduPulse Academy',
                'slug' => 'bimbel',
                'category' => 'Pendidikan & Bimbel',
                'tagline' => 'Sistem Informasi Akademik Bimbel & Monitoring Siswa',
                'description' => 'Jadwal sesi belajar, absensi presensi kelas, broadcast tagihan SPP berkala, distribusi materi e-book, serta pendampingan AI Tutor.',
                'thumbnail' => '/gambar/aset/bimbel-saas.png',
                'target_url' => '/bimbel/dashboard',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'L-Prosal Property',
                'slug' => 'prosal',
                'category' => 'Properti & Real Estate',
                'tagline' => 'Sistem Manajemen Unit Sewa, Ruko, & Apartemen',
                'description' => 'Pencatatan okupansi kamar sewa, data kontrak penyewa, monitoring tiket perbaikan unit, dan pembukuan arus kas properti.',
                'thumbnail' => '/gambar/aset/prosal-saas.png',
                'target_url' => '/prosal/dashboard',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'L-Travel Tour & Umroh',
                'slug' => 'travel',
                'category' => 'Tour & Travel',
                'tagline' => 'Operasional Paket Wisata, Jamaah Umroh, & Armada',
                'description' => 'Manajemen kuota keberangkatan tour, kelengkapan paspor & visa jamaah, kesiapan armada bus/kapal, serta laporan keuangan travel.',
                'thumbnail' => '/gambar/aset/travel-saas.png',
                'target_url' => '/travel/dashboard',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'TechFix Pro Service',
                'slug' => 'techfix',
                'category' => 'Hardware & Service Center',
                'tagline' => 'Tiket Reparasi Gadget, Suku Cadang, & Kasir Servis',
                'description' => 'Pencatatan tiket servis masuk, tracking status perbaikan via nomor tiket, manajemen inventaris spare part, dan cetak struk garansi.',
                'thumbnail' => '/gambar/aset/techfix-saas.png',
                'target_url' => '/techfix/dashboard',
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'name' => 'Klinik Nusantara Medika',
                'slug' => 'klinik',
                'category' => 'Kesehatan & Klinik',
                'tagline' => 'Antrean Poliklinik, Rekam Medis Pasien, & Stok Obat',
                'description' => 'Pendaftaran pasien berobat, monitoring antrean poli live, jadwal dokter jaga harian, serta pengawasan stok obat farmasi.',
                'thumbnail' => '/gambar/aset/klinik-saas.png',
                'target_url' => '/klinik/dashboard',
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'name' => 'Enterprise CRM Suite',
                'slug' => 'crm',
                'category' => 'Sales & CRM',
                'tagline' => 'Pipeline Penjualan, Manajemen Prospek, & Otomasi Deals',
                'description' => 'Pencatatan database leads masuk, visualisasi funnel deal di setiap tahapan closing, penugasan sales team, serta analisis konversi.',
                'thumbnail' => '/gambar/aset/crm-saas.png',
                'target_url' => '/crm/dashboard',
                'is_active' => true,
                'sort_order' => 10,
            ],
        ];

        foreach ($products as $p) {
            SaasProduct::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // 2. PROSAL DATA
        $units = [
            ['unit_code' => 'UNT-01', 'nama' => 'Apartemen Grand Sudirman Lt. 14 B', 'kategori' => 'Apartemen', 'lokasi' => 'Tower B, Jakarta Selatan', 'tipe' => '2 BR • 54 m²', 'harga' => 8500000, 'status' => 'Tersewa', 'penyewa' => 'Bpk. Hendra Gunawan', 'jatuh_tempo' => '2026-11-15'],
            ['unit_code' => 'UNT-02', 'nama' => 'Apartemen Grand Sudirman Lt. 08 A', 'kategori' => 'Apartemen', 'lokasi' => 'Tower A, Jakarta Selatan', 'tipe' => '1 BR • 38 m²', 'harga' => 6000000, 'status' => 'Tersedia', 'penyewa' => null, 'jatuh_tempo' => null],
            ['unit_code' => 'UNT-03', 'nama' => 'Ruko Sentra Niaga Boulevard No. 08', 'kategori' => 'Ruko', 'lokasi' => 'Gading Serpong, Tangerang', 'tipe' => '3 Lantai • 180 m²', 'harga' => 14200000, 'status' => 'Tersewa', 'penyewa' => 'PT Sumber Cahaya Makmur', 'jatuh_tempo' => '2026-12-01'],
            ['unit_code' => 'UNT-04', 'nama' => 'Kost Dago Pine Room 204', 'kategori' => 'Kost Eksklusif', 'lokasi' => 'Coblong, Dago Bandung', 'tipe' => 'Deluxe Single • AC & WiFi', 'harga' => 2100000, 'status' => 'Tersewa', 'penyewa' => 'Rizky Pratama', 'jatuh_tempo' => '2026-11-10'],
        ];
        foreach ($units as $u) {
            ProsalUnit::updateOrCreate(['unit_code' => $u['unit_code']], $u);
        }

        $unit1 = ProsalUnit::where('unit_code', 'UNT-01')->first();
        $unit3 = ProsalUnit::where('unit_code', 'UNT-03')->first();
        $unit4 = ProsalUnit::where('unit_code', 'UNT-04')->first();

        $tenants = [
            ['nama' => 'Hendra Gunawan', 'unit_id' => $unit1?->id, 'no_wa' => '081234567890', 'email' => 'hendra.g@gmail.com', 'ktp_nik' => '3273012908850001', 'tgl_masuk' => '2025-11-15', 'tgl_habis' => '2026-11-15', 'sewa_bulanan' => 8500000, 'deposit' => 8500000, 'status_pembayaran' => 'Lunas'],
            ['nama' => 'PT Sumber Cahaya Makmur', 'unit_id' => $unit3?->id, 'no_wa' => '081198765432', 'email' => 'finance@sumbercahaya.co.id', 'ktp_nik' => '010029384819000', 'tgl_masuk' => '2025-12-01', 'tgl_habis' => '2026-12-01', 'sewa_bulanan' => 14200000, 'deposit' => 20000000, 'status_pembayaran' => 'Lunas'],
            ['nama' => 'Rizky Pratama', 'unit_id' => $unit4?->id, 'no_wa' => '085712348899', 'email' => 'rizky.pratama@mhs.itb.ac.id', 'ktp_nik' => '3204123490910003', 'tgl_masuk' => '2026-05-10', 'tgl_habis' => '2026-11-10', 'sewa_bulanan' => 2100000, 'deposit' => 1000000, 'status_pembayaran' => 'Lunas'],
        ];
        foreach ($tenants as $t) {
            ProsalTenant::updateOrCreate(['nama' => $t['nama']], $t);
        }

        $maintenances = [
            ['tiket_code' => 'MNT-01', 'unit_id' => $unit1?->id, 'pelapor' => 'Hendra Gunawan', 'deskripsi_kendala' => 'Kebocoran AC ruang utama & cuci filter berkala', 'prioritas' => 'Sedang', 'biaya' => 350000, 'status' => 'Selesai', 'tgl_lapor' => '2026-10-25'],
            ['tiket_code' => 'MNT-02', 'unit_id' => $unit4?->id, 'pelapor' => 'Rizky Pratama', 'deskripsi_kendala' => 'Water heater kamar mandi tidak menghasilkan air hangat', 'prioritas' => 'Tinggi', 'biaya' => 250000, 'status' => 'Dalam Proses', 'tgl_lapor' => '2026-11-02'],
        ];
        foreach ($maintenances as $m) {
            ProsalMaintenance::updateOrCreate(['tiket_code' => $m['tiket_code']], $m);
        }

        $finances = [
            ['kode_transaksi' => 'FIN-01', 'tipe' => 'Pemasukan', 'kategori' => 'Sewa Unit', 'keterangan' => 'Pembayaran sewa bulanan Hendra Gunawan (UNT-01)', 'nominal' => 8500000, 'tanggal' => '2026-11-01'],
            ['kode_transaksi' => 'FIN-02', 'tipe' => 'Pemasukan', 'kategori' => 'Sewa Unit', 'keterangan' => 'Pembayaran sewa bulanan PT Sumber Cahaya (UNT-03)', 'nominal' => 14200000, 'tanggal' => '2026-11-01'],
            ['kode_transaksi' => 'FIN-03', 'tipe' => 'Pengeluaran', 'kategori' => 'Maintenance', 'keterangan' => 'Service AC dan perbaikan pipa air Grand Sudirman', 'nominal' => 600000, 'tanggal' => '2026-11-03'],
        ];
        foreach ($finances as $f) {
            ProsalFinance::updateOrCreate(['kode_transaksi' => $f['kode_transaksi']], $f);
        }

        // 3. TRAVEL DATA
        $packages = [
            ['kode_paket' => 'PKT-01', 'nama' => 'Umroh Khazanah Barokah 9 Hari (Bintang 5)', 'kategori' => 'Umroh & Religi', 'durasi' => '9H 8M', 'tanggal_berangkat' => '2026-11-18', 'kuota_total' => 45, 'kuota_terisi' => 42, 'harga' => 31500000, 'status' => 'Tersedia', 'tour_leader' => 'Ust. H. Ahmad Fauzi, Lc.'],
            ['kode_paket' => 'PKT-02', 'nama' => 'Exotic Labuan Bajo Phinisi Liveaboard 3D2N', 'kategori' => 'Domestik', 'durasi' => '3H 2M', 'tanggal_berangkat' => '2026-12-04', 'kuota_total' => 16, 'kuota_terisi' => 16, 'harga' => 5850000, 'status' => 'Penuh', 'tour_leader' => 'Rian Prawira'],
            ['kode_paket' => 'PKT-03', 'nama' => 'Japan Golden Route Sakura Autumn 7D6N', 'kategori' => 'Internasional', 'durasi' => '7H 6M', 'tanggal_berangkat' => '2026-12-12', 'kuota_total' => 25, 'kuota_terisi' => 19, 'harga' => 23900000, 'status' => 'Tersedia', 'tour_leader' => 'Sarah Tanaka'],
            ['kode_paket' => 'PKT-04', 'nama' => 'Open Trip Bromo Sunrise & Rafting 3D2N', 'kategori' => 'Open Trip', 'durasi' => '3H 2M', 'tanggal_berangkat' => '2026-11-20', 'kuota_total' => 30, 'kuota_terisi' => 28, 'harga' => 1450000, 'status' => 'Tersedia', 'tour_leader' => 'Bagus Ramadhan'],
        ];
        foreach ($packages as $pkg) {
            TravelPackage::updateOrCreate(['kode_paket' => $pkg['kode_paket']], $pkg);
        }

        $pkg1 = TravelPackage::where('kode_paket', 'PKT-01')->first();
        $pkg2 = TravelPackage::where('kode_paket', 'PKT-02')->first();
        $pkg3 = TravelPackage::where('kode_paket', 'PKT-03')->first();

        $participants = [
            ['kode_jamaah' => 'JMH-001', 'package_id' => $pkg1?->id, 'nama' => 'H. Syamsudin & Hj. Mariam', 'no_wa' => '081299881122', 'paspor' => 'B8912344 (Exp 2029)', 'status_dokumen' => 'Visa Issued & Tiket Siap', 'status_pembayaran' => 'Lunas', 'total_tagihan' => 63000000, 'tanggal_daftar' => '2026-10-10'],
            ['kode_jamaah' => 'JMH-002', 'package_id' => $pkg2?->id, 'nama' => 'Denny Wicaksono & Partner', 'no_wa' => '085712349988', 'paspor' => 'KTP Verified', 'status_dokumen' => 'Manifest Phinisi Terdaftar', 'status_pembayaran' => 'Lunas', 'total_tagihan' => 11700000, 'tanggal_daftar' => '2026-10-15'],
            ['kode_jamaah' => 'JMH-003', 'package_id' => $pkg3?->id, 'nama' => 'Dr. Amelia Putri', 'no_wa' => '081377884455', 'paspor' => 'C1290881 (Exp 2028)', 'status_dokumen' => 'E-Visa Jepang Approved', 'status_pembayaran' => 'DP', 'total_tagihan' => 23900000, 'tanggal_daftar' => '2026-10-22'],
        ];
        foreach ($participants as $part) {
            TravelParticipant::updateOrCreate(['kode_jamaah' => $part['kode_jamaah']], $part);
        }

        $fleets = [
            ['kode_armada' => 'ARM-01', 'nama_kendaraan' => 'Bus Pariwisata Executive Jetbus 5', 'kapasitas' => '45 Seat (2-2)', 'plat_nomor' => 'B 7890 TGA', 'vendor' => 'PO Nusantara Trans Luxury', 'status' => 'Siap Jalan', 'driver' => 'Pak Joko Triyono', 'rute_tujuan' => 'Bandara Soetta - Cengkareng'],
            ['kode_armada' => 'ARM-02', 'nama_kendaraan' => 'Kapal Phinisi Deluxe Ocean Cruiser', 'kapasitas' => '16 Guest Cabin', 'plat_nomor' => 'KM Phinisi Bajo 01', 'vendor' => 'Labuan Marine Charters', 'status' => 'Siap Jalan', 'driver' => 'Capt. Markus', 'rute_tujuan' => 'Komodo Island - Padar - Pink Beach'],
            ['kode_armada' => 'ARM-03', 'nama_kendaraan' => 'Toyota HiAce Commuter Executive', 'kapasitas' => '14 Seat', 'plat_nomor' => 'N 1422 WZ', 'vendor' => 'Bromo Adventure Fleet', 'status' => 'Siap Jalan', 'driver' => 'Mas Dimas', 'rute_tujuan' => 'Malang - Sukapura Bromo'],
        ];
        foreach ($fleets as $flt) {
            TravelFleet::updateOrCreate(['kode_armada' => $flt['kode_armada']], $flt);
        }

        // 4. BENGKEL DATA
        $workOrders = [
            ['nomor_wo' => 'WO-261101-001', 'customer_name' => 'Bambang Pamungkas', 'customer_phone' => '081288776655', 'vehicle_plate' => 'B 1928 KLA', 'vehicle_model' => 'Honda CR-V 2.0 Prestige (2021)', 'service_package' => 'Tune Up + Ganti Oli Shell Helix 5W-30', 'estimasi_biaya' => 850000, 'pit_bay' => 'PIT 2', 'mekanik' => 'Budi Santoso', 'status' => 'Pengerjaan', 'keluhan' => 'Tarikan agak berat saat tanjakan'],
            ['nomor_wo' => 'WO-261101-002', 'customer_name' => 'Iwan Fals', 'customer_phone' => '081399001122', 'vehicle_plate' => 'D 1029 AZ', 'vehicle_model' => 'Toyota Kijang Innova Reborn Diesel', 'service_package' => 'Servis Rem & Kaki-kaki 4 Roda', 'estimasi_biaya' => 1250000, 'pit_bay' => 'PIT 1', 'mekanik' => 'Agus Widodo', 'status' => 'Pemeriksaan', 'keluhan' => 'Bunyi berdecit saat pengereman mendadak'],
            ['nomor_wo' => 'WO-261101-003', 'customer_name' => 'Dewi Persik', 'customer_phone' => '085711223344', 'vehicle_plate' => 'B 2200 DP', 'vehicle_model' => 'Mazda CX-5 GT Soul Red', 'service_package' => 'Spooring & 3D Wheel Balancing', 'estimasi_biaya' => 450000, 'pit_bay' => 'PIT 3', 'mekanik' => 'Candra Putra', 'status' => 'Menunggu', 'keluhan' => 'Setir condong ke kiri pada kecepatan 80 km/jam'],
            ['nomor_wo' => 'WO-261101-004', 'customer_name' => 'Raffi Ahmad', 'customer_phone' => '081122334455', 'vehicle_plate' => 'B 17 RFI', 'vehicle_model' => 'Mercedes-Benz G63 AMG', 'service_package' => 'Scanner ECU Komprehensif & Reset Sensor', 'estimasi_biaya' => 1800000, 'pit_bay' => 'PIT 4', 'mekanik' => 'Deni Firmansyah', 'status' => 'Siap Diambil', 'keluhan' => 'Indikator check engine menyala sesaat'],
        ];
        foreach ($workOrders as $wo) {
            BengkelWorkOrder::updateOrCreate(['nomor_wo' => $wo['nomor_wo']], $wo);
        }

        $bengkelServices = [
            ['kode_servis' => 'SRV-01', 'nama_servis' => 'Tune Up Berkala + Carbon Cleaner', 'kategori' => 'Rutin', 'harga' => 450000, 'durasi_menit' => 60, 'deskripsi' => 'Pembersihan ruang bakar, busi, dan injektor'],
            ['kode_servis' => 'SRV-02', 'nama_servis' => 'Ganti Oli Mesin Sintetik + Filter', 'kategori' => 'Rutin', 'harga' => 550000, 'durasi_menit' => 30, 'deskripsi' => 'Penggantian oli mesin grade SN 5W-30 dan filter ori'],
            ['kode_servis' => 'SRV-03', 'nama_servis' => 'Overhaul Sistem Rem 4 Roda', 'kategori' => 'Berat', 'harga' => 850000, 'durasi_menit' => 120, 'deskripsi' => 'Bongkar kuras minyak rem, amplas rotor & kampas rem'],
        ];
        foreach ($bengkelServices as $srv) {
            BengkelService::updateOrCreate(['kode_servis' => $srv['kode_servis']], $srv);
        }

        // 5. BIMBEL DATA
        $students = [
            ['nis' => 'EDP-2026-001', 'nama' => 'Aditya Pratama', 'kelas' => '12 UTBK', 'program' => 'Intensif SNBT Kedokteran', 'no_wa' => '081234567001', 'nama_ortu' => 'Bpk. Irwan Pratama', 'status' => 'Aktif', 'tanggal_daftar' => '2026-07-15'],
            ['nis' => 'EDP-2026-002', 'nama' => 'Nabila Salsabila', 'kelas' => '12 UTBK', 'program' => 'Super Intensif ITB & UI', 'no_wa' => '081234567002', 'nama_ortu' => 'Ibu Rina Marlina', 'status' => 'Aktif', 'tanggal_daftar' => '2026-07-20'],
            ['nis' => 'EDP-2026-003', 'nama' => 'Kevin Sanjaya', 'kelas' => '11 SMA', 'program' => 'Reguler Sains & Matematika', 'no_wa' => '081234567003', 'nama_ortu' => 'Bpk. Gunawan Sanjaya', 'status' => 'Aktif', 'tanggal_daftar' => '2026-08-01'],
        ];
        foreach ($students as $stu) {
            BimbelStudent::updateOrCreate(['nis' => $stu['nis']], $stu);
        }

        $schedules = [
            ['hari' => 'Senin', 'jam_mulai' => '16:00', 'jam_selesai' => '17:30', 'mata_pelajaran' => 'Penalaran Matematika & TPS', 'tutor' => 'Kak Dimas, M.Si.', 'ruangan' => 'Ruang Newton 01', 'kapasitas' => 20],
            ['hari' => 'Rabu', 'jam_mulai' => '16:00', 'jam_selesai' => '17:30', 'mata_pelajaran' => 'Literasi Bhs Inggris & Skolastik', 'tutor' => 'Miss Jessica, M.Ed.', 'ruangan' => 'Ruang Galileo 02', 'kapasitas' => 20],
            ['hari' => 'Jumat', 'jam_mulai' => '14:30', 'jam_selesai' => '16:00', 'mata_pelajaran' => 'Fisika & Kimia Penalaran Klinis', 'tutor' => 'Kak Rizky, Ph.D.', 'ruangan' => 'Lab Sains Einstein', 'kapasitas' => 15],
        ];
        foreach ($schedules as $sch) {
            BimbelSchedule::updateOrCreate(['hari' => $sch['hari'], 'mata_pelajaran' => $sch['mata_pelajaran']], $sch);
        }

        // 6. RESTO DATA
        $menus = [
            ['kode_menu' => 'MNU-01', 'nama' => 'Wagyu Ribeye Meltique Steak 200g', 'kategori' => 'Makanan Utama', 'harga' => 175000, 'status' => 'Tersedia'],
            ['kode_menu' => 'MNU-02', 'nama' => 'Salmon Mentai Rice Bowl Truffle', 'kategori' => 'Makanan Utama', 'harga' => 85000, 'status' => 'Tersedia'],
            ['kode_menu' => 'MNU-03', 'nama' => 'Signature Artisan Espresso Tonic', 'kategori' => 'Minuman', 'harga' => 38000, 'status' => 'Tersedia'],
            ['kode_menu' => 'MNU-04', 'nama' => 'Matcha Basque Burnt Cheesecake', 'kategori' => 'Dessert', 'harga' => 45000, 'status' => 'Tersedia'],
        ];
        foreach ($menus as $m) {
            RestoMenu::updateOrCreate(['kode_menu' => $m['kode_menu']], $m);
        }

        $tables = [
            ['nomor_meja' => 'Meja 01', 'kapasitas' => 2, 'status' => 'Terisi', 'lokasi' => 'Indoor Main Hall'],
            ['nomor_meja' => 'Meja 02', 'kapasitas' => 4, 'status' => 'Kosong', 'lokasi' => 'Indoor Window Side'],
            ['nomor_meja' => 'Meja 03', 'kapasitas' => 6, 'status' => 'Reservasi', 'lokasi' => 'VIP Private Room'],
            ['nomor_meja' => 'Meja 04', 'kapasitas' => 4, 'status' => 'Kosong', 'lokasi' => 'Outdoor Terrace Garden'],
        ];
        foreach ($tables as $tbl) {
            RestoTable::updateOrCreate(['nomor_meja' => $tbl['nomor_meja']], $tbl);
        }

        // 7. TECHFIX DATA
        $tickets = [
            ['nomor_tiket' => 'TCK-202611-001', 'customer_name' => 'Dimas Anggara', 'customer_phone' => '081299887766', 'device_type' => 'Laptop', 'device_brand' => 'Apple', 'device_model' => 'MacBook Pro M1 13 Inch (2020)', 'serial_number' => 'C02DF012Q05D', 'keluhan' => 'Layar bergaris horizontal dan mati setelah benturan', 'status' => 'Dikerjakan', 'estimasi_biaya' => 2450000, 'teknisi' => 'Rendy Kurniawan', 'garansi_hari' => 90],
            ['nomor_tiket' => 'TCK-202611-002', 'customer_name' => 'Sarah Sechan', 'customer_phone' => '081344556677', 'device_type' => 'Smartphone', 'device_brand' => 'Samsung', 'device_model' => 'Galaxy S23 Ultra', 'serial_number' => 'RF8N10298AA', 'keluhan' => 'Ganti baterai drop cepat panas dan backdoor renggang', 'status' => 'Menunggu Part', 'estimasi_biaya' => 750000, 'teknisi' => 'Bayu Wicaksono', 'garansi_hari' => 60],
            ['nomor_tiket' => 'TCK-202611-003', 'customer_name' => 'Reza Rahadian', 'customer_phone' => '081700998811', 'device_type' => 'PC Desktop', 'device_brand' => 'Custom Rig', 'device_model' => 'RTX 4070 Super + Ryzen 7', 'serial_number' => 'CR-2024-9981', 'keluhan' => 'Sering bluescreen WHEA_UNCORRECTABLE_ERROR saat rendering', 'status' => 'Menunggu Diagnosa', 'estimasi_biaya' => 500000, 'teknisi' => 'Rendy Kurniawan', 'garansi_hari' => 30],
        ];
        foreach ($tickets as $tck) {
            TechfixTicket::updateOrCreate(['nomor_tiket' => $tck['nomor_tiket']], $tck);
        }

        // 8. KLINIK DATA
        $patients = [
            ['nomor_rm' => 'RM-2026-001', 'nik' => '3273010101900001', 'nama' => 'Ahmad Dahlan', 'tanggal_lahir' => '1990-01-01', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Senopati No. 45, Jakarta Selatan', 'no_hp' => '081299112233', 'golongan_darah' => 'O'],
            ['nomor_rm' => 'RM-2026-002', 'nik' => '3273010202950002', 'nama' => 'Siti Nurhaliza', 'tanggal_lahir' => '1995-02-02', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Suryo No. 12, Jakarta Selatan', 'no_hp' => '081388223344', 'golongan_darah' => 'A'],
            ['nomor_rm' => 'RM-2026-003', 'nik' => '3273010303880003', 'nama' => 'Budi Sudarsono', 'tanggal_lahir' => '1988-03-03', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Wolter Monginsidi No. 8', 'no_hp' => '085711334455', 'golongan_darah' => 'B'],
        ];
        foreach ($patients as $pat) {
            KlinikPatient::updateOrCreate(['nomor_rm' => $pat['nomor_rm']], $pat);
        }

        $doctors = [
            ['nama' => 'dr. H. Hendra Wicaksono, Sp.PD', 'spesialisasi' => 'Poli Penyakit Dalam', 'jadwal_praktek' => 'Senin - Kamis, 09:00 - 14:00', 'ruangan' => 'Poli 1', 'status_aktif' => true],
            ['nama' => 'drg. Maya Anggraini', 'spesialisasi' => 'Poli Gigi & Mulut', 'jadwal_praktek' => 'Senin - Jumat, 10:00 - 16:00', 'ruangan' => 'Poli 2', 'status_aktif' => true],
            ['nama' => 'dr. Farhan Alatas, Sp.A', 'spesialisasi' => 'Poli Anak & Imunisasi', 'jadwal_praktek' => 'Selasa - Sabtu, 08:30 - 13:00', 'ruangan' => 'Poli 3', 'status_aktif' => true],
        ];
        foreach ($doctors as $doc) {
            KlinikDoctor::updateOrCreate(['nama' => $doc['nama']], $doc);
        }

        $pat1 = KlinikPatient::where('nomor_rm', 'RM-2026-001')->first();
        $pat2 = KlinikPatient::where('nomor_rm', 'RM-2026-002')->first();
        $queues = [
            ['patient_id' => $pat1?->id, 'nomor_antrean' => 'A-001', 'poli' => 'Poli Penyakit Dalam', 'dokter' => 'dr. H. Hendra Wicaksono, Sp.PD', 'status' => 'Diperiksa'],
            ['patient_id' => $pat2?->id, 'nomor_antrean' => 'B-002', 'poli' => 'Poli Gigi & Mulut', 'dokter' => 'drg. Maya Anggraini', 'status' => 'Menunggu'],
        ];
        foreach ($queues as $q) {
            KlinikQueue::updateOrCreate(['nomor_antrean' => $q['nomor_antrean']], $q);
        }

        $medicines = [
            ['kode_obat' => 'OBT-01', 'nama_obat' => 'Amoxicillin Trihydrate 500mg', 'kategori' => 'Antibiotik', 'stok' => 450, 'satuan' => 'Kaplet', 'harga' => 12500, 'expired_date' => '2027-08-01'],
            ['kode_obat' => 'OBT-02', 'nama_obat' => 'Paracetamol 500mg Forte', 'kategori' => 'Analgesik', 'stok' => 820, 'satuan' => 'Tablet', 'harga' => 8500, 'expired_date' => '2028-01-15'],
            ['kode_obat' => 'OBT-03', 'nama_obat' => 'Vitamin C 500mg Zinc Buffered', 'kategori' => 'Suplemen', 'stok' => 300, 'satuan' => 'Botol 30', 'harga' => 48000, 'expired_date' => '2027-11-20'],
        ];
        foreach ($medicines as $med) {
            KlinikMedicine::updateOrCreate(['kode_obat' => $med['kode_obat']], $med);
        }

        // 9. CRM DATA
        $leads = [
            ['nama' => 'Bpk. Irfan Hakim', 'perusahaan' => 'PT Mega Solusi Logistik', 'email' => 'irfan.hakim@megasolusi.co.id', 'no_wa' => '081199887766', 'status' => 'Negosiasi', 'nilai_potensial' => 85000000, 'sumber' => 'Website', 'sales_owner' => 'Bayu Ramadhan'],
            ['nama' => 'Ibu Ratna Sarumpaet', 'perusahaan' => 'CV Karya Indah Furnitur', 'email' => 'purchasing@karyaindah.com', 'no_wa' => '081233445566', 'status' => 'Kualifikasi', 'nilai_potensial' => 35000000, 'sumber' => 'WhatsApp', 'sales_owner' => 'Citra Kirana'],
            ['nama' => 'Bpk. Denny Cagur', 'perusahaan' => 'PT Digital Kreasi Mandiri', 'email' => 'denny@dkreasi.id', 'no_wa' => '085711229988', 'status' => 'Baru', 'nilai_potensial' => 120000000, 'sumber' => 'Referral', 'sales_owner' => 'Bayu Ramadhan'],
        ];
        foreach ($leads as $ld) {
            CrmLead::updateOrCreate(['email' => $ld['email']], $ld);
        }

        $lead1 = CrmLead::where('email', 'irfan.hakim@megasolusi.co.id')->first();
        $lead2 = CrmLead::where('email', 'purchasing@karyaindah.com')->first();
        $deals = [
            ['lead_id' => $lead1?->id, 'judul_deal' => 'Pengadaan SaaS ERP Enterprise 50 License', 'tahap_pipeline' => 'Negotiation', 'nominal' => 85000000, 'probabilitas' => 75, 'estimasi_closing' => '2026-11-30'],
            ['lead_id' => $lead2?->id, 'judul_deal' => 'Modul Inventory & POS Multi-Cabang', 'tahap_pipeline' => 'Proposal Sent', 'nominal' => 35000000, 'probabilitas' => 50, 'estimasi_closing' => '2026-12-15'],
        ];
        foreach ($deals as $dl) {
            CrmDeal::updateOrCreate(['judul_deal' => $dl['judul_deal']], $dl);
        }

        $tasks = [
            ['judul' => 'Follow up presentasi proposal harga PT Mega Solusi', 'tipe' => 'Call', 'prioritas' => 'Tinggi', 'due_date' => '2026-11-26', 'status' => 'Pending', 'assigned_to' => 'Bayu Ramadhan'],
            ['judul' => 'Kirim draf kontrak kerja sama CV Karya Indah', 'tipe' => 'Proposal', 'prioritas' => 'Sedang', 'due_date' => '2026-11-28', 'status' => 'Pending', 'assigned_to' => 'Citra Kirana'],
        ];
        foreach ($tasks as $tsk) {
            CrmTask::updateOrCreate(['judul' => $tsk['judul']], $tsk);
        }
    }
}

