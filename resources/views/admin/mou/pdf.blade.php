<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>{{ $mou->nama_file }}</title>
<style>
@page { margin: 80px 50px 80px 50px; }
body { font-family: Arial, sans-serif; margin: 0; padding: 0; font-size: 10pt; line-height: 1.5; color: #333; }
.page-break { page-break-after: always; }

header {
    position: fixed; 
    top: -80px; 
    left: 0; 
    right: 0; 
    height: 60px; 
    text-align: center; 
    font-size: 11pt; 
    color: #111; 
    padding-top: 30px;
}
.header-logo { 
    position: absolute; 
    top: 0px; 
    right: -50px; 
    width: 130px; 
    height: auto; 
    z-index: -1;
}

footer { 
    position: fixed; 
    bottom: -60px; 
    left: 0; 
    right: 0; 
    height: 40px; 
    font-size: 9pt; 
    color: #777; 
}
.pagenum:before { content: counter(page); }

.letterhead { width: 100%; border-bottom: 2px solid #1f497d; padding-bottom: 15px; margin-bottom: 15px; }
.letterhead .title { font-size: 13pt; font-weight: bold; color: #000; margin: 0 0 2px 0; }
.letterhead .subtitle { font-size: 10pt; color: #555; margin: 0; }

table.meta { width: 100%; border-collapse: collapse; font-size: 9pt; margin-bottom: 0; }
table.meta td { padding: 2px 0; vertical-align: top; line-height: 1.3; }
table.meta .label { font-weight: bold; width: 1%; white-space: nowrap; padding-right: 5px; }
table.meta .value { width: 50%; }
hr.meta-divider { border: 0; border-top: 1px solid #cbd5e1; margin-top: 10px; margin-bottom: 20px; }

.section-title { font-size: 10pt; font-weight: bold; color: #1f497d; text-transform: uppercase; border-left: 3px solid #1f497d; padding-left: 6px; margin: 15px 0 10px 0; line-height: 1.2; }
.content-text { text-align: justify; margin-bottom: 15px; }
.package-list { margin-bottom: 20px; }
.package-list li { margin-bottom: 5px; }
.img-placeholder { text-align: center; margin: 15px 0; background: #f9f9f9; border: 1px dashed #ccc; padding: 20px; color: #999; }
.img-placeholder img { max-width: 100%; height: auto; }
.feature-box { border: 1px solid #cce5ff; border-radius: 5px; margin-bottom: 10px; }
.feature-box .box-title { background-color: #f0f7ff; color: #004085; font-weight: bold; padding: 8px 10px; border-bottom: 1px solid #cce5ff; font-size: 9pt; }
.feature-box .box-content { padding: 8px 10px; font-size: 9pt; }
table.comparison { width: 100%; border-collapse: collapse; font-size: 9pt; margin-bottom: 15px; }
table.comparison th { background-color: #1f497d; color: white; border: 1px solid #fff; padding: 8px; text-align: left; }
table.comparison td { border-bottom: 1px solid #ddd; padding: 6px 8px; }
table.comparison th.center, table.comparison td.center { text-align: center; }
.termin-box { border: 1px solid #1f497d; border-radius: 4px; margin-bottom: 10px; }
.termin-box .t-title { background: #f0f4f8; font-weight: bold; color: #1f497d; padding: 5px 10px; border-bottom: 1px solid #1f497d; font-size: 9pt; }
.termin-box .t-desc { padding: 5px 10px; font-size: 9pt; }
.ttd-table { width: 100%; margin-top: 30px; }
.ttd-table td { width: 50%; padding-top: 20px; }
.ttd-box { border-bottom: 1px solid #000; width: 200px; display: inline-block; margin-top: 60px; }
</style>
</head>
<body>

<header>
    ELCoding.id &ndash; Software Development | Service Center | Sale
</header>

<footer>
    <table style="width: 100%; border: none; padding: 0; margin: 0; font-size: 9pt; color: #777;">
        <tr>
            <td style="text-align: left; padding: 0; border: none;">ELCoding | Proposal SIMAQ ERP - {{ $mou->nama_customer }}</td>
            <td style="text-align: right; padding: 0; border: none;">Halaman <span class="pagenum"></span> dari 5</td>
        </tr>
    </table>
</footer>

<main>
    <!-- PAGE 1 -->
    <div class="letterhead">
        <div class="title">ELCODING.ID</div>
        <div class="subtitle">Solusi Pengembangan Perangkat Lunak & Sistem Informasi Profesional</div>
    </div>

    <table class="meta">
        <tr>
            <td class="label">Nomor:</td>
            <td class="value">{{ $mou->nomor_surat ?? '088/SP-ELC/ERP-AQ/VII/2026' }}</td>
            <td style="text-align: right; width: 50%;"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($mou->tanggal)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Perihal:</td>
            <td class="value">{{ $mou->perihal ?? 'Penawaran SIMAQ ERP Berbasis IoT' }}</td>
            <td style="text-align: right;"><strong>Kepada:</strong> Yth. {{ $mou->nama_customer }}</td>
        </tr>
        <tr>
            <td class="label">Lampiran:</td>
            <td class="value">{{ $mou->lampiran ?? '1 Berkas Proposal Terpadu' }}</td>
            <td style="text-align: right;"><strong>Lokasi:</strong> {{ $mou->lokasi }}</td>
        </tr>
    </table>
    
    <hr class="meta-divider">

    <div class="section-title">BAGIAN 1: SURAT PENAWARAN RESMI</div>
    <div class="content-text">
        <strong>Dengan hormat,</strong><br><br>
        Seiring dengan pesatnya pertumbuhan industri peternakan, pemotongan hewan, serta penyediaan jasa aqiqah dan qurban modern di Indonesia, efisiensi operasional dan keterjaminan kualitas mutu produk telah menjadi pilar utama pembeda bisnis. <strong>{{ $mou->nama_customer }}</strong> sebagai salah satu pemain kunci di {{ explode(',', $mou->lokasi)[0] ?? 'wilayah ini' }} menghadapi tantangan kompleksitas tata kelola: mulai dari pemantauan kesehatan ternak di kandang (<em>upstream</em>), proses pemotongan hewan yang halal dan terstandar (<em>midstream</em>), hingga alur dapur kuliner dan pengiriman logistik tepat waktu ke tangan konsumen (<em>downstream</em>).
        <br><br>
        Menjawab tantangan tersebut, <strong>ELCoding</strong> dengan bangga mengajukan penawaran kerja sama strategis berupa pengembangan <strong>SIMAQ ERP (Sistem Informasi Manajemen Aqiqah & Qurban)</strong>. Sistem ini dirancang kustom (<em>custom-built</em>) dengan mengintegrasikan arsitektur Web ERP Enterprise berbasis Framework Laravel dan infrastruktur sensor <em>Internet of Things</em> (IoT) berbasis mikrokontroler ESP32. SIMAQ ERP menghadirkan fondasi bisnis tunggal (<em>Single Source of Truth</em>) yang mampu mengeliminasi potensi kebebanan biaya (<em>cost leakage</em>), menekan angka daging terbuang (<em>waste ratio</em>), serta menjamin keterlacakan penuh (<em>total traceability</em>).
        <br><br>
        Sebagai bentuk komitmen kami dalam memberikan fleksibilitas anggaran dan manajemen risiko investasi {{ $mou->nama_customer }}, ELCoding merancang 3 (tiga) pilihan skema investasi nilai terpadu:
    </div>

    <ul class="package-list">
        <li><strong>Paket Lite (Rp 590.000):</strong> Solusi digitalisasi inti operasional bisnis & manajemen internal (<em>Core ERP Web</em>).</li>
        <li><strong>Paket Core (Rp 690.000):</strong> Solusi terintegrasi tingkat lanjut (<em>Full ERP Web</em>) dilengkapi 1 Unit Sistem Sensor IoT Utama.</li>
        <li><strong>Paket Full Bundling (Rp 740.000):</strong> Solusi <em>Enterprise Ecosystem</em> terlengkap (<em>Full ERP Web</em>) beserta 6 Unit Lengkap Sistem Sensor IoT.</li>
    </ul>

    <div class="img-placeholder">
        @php
            $img_arsitektur = public_path('assets/image/mou/arsitektur.png');
        @endphp
        @if(file_exists($img_arsitektur))
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents($img_arsitektur)) }}" alt="Arsitektur SIMAQ ERP">
        @else
            [GAMBAR ARSITEKTUR TERPADU SIMAQ ERP & IoT]
            <br><small>Letakkan gambar di public/assets/image/mou/arsitektur.png</small>
        @endif
    </div>

    <div class="page-break"></div>

    <!-- PAGE 2 -->
    <div class="section-title" style="margin-top: 0;">BAGIAN (MOCK UP): SISTEM WEBSITE ERP</div>

    <div class="img-placeholder" style="margin-bottom: 30px;">
        @php
            $img_mockup1 = public_path('assets/image/mou/mockup1.png');
        @endphp
        @if(file_exists($img_mockup1))
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents($img_mockup1)) }}" alt="Mockup Login ERP">
        @else
            [GAMBAR MOCKUP LOGIN SIMAQ ERP]
            <br><small>Letakkan gambar di public/assets/image/mou/mockup1.png</small>
        @endif
    </div>

    <div class="img-placeholder">
        @php
            $img_mockup2 = public_path('assets/image/mou/mockup2.png');
        @endphp
        @if(file_exists($img_mockup2))
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents($img_mockup2)) }}" alt="Mockup Dashboard ERP">
        @else
            [GAMBAR MOCKUP DASHBOARD SIMAQ ERP]
            <br><small>Letakkan gambar di public/assets/image/mou/mockup2.png</small>
        @endif
    </div>

    <div class="page-break"></div>

    <!-- PAGE 3 -->
    <div class="section-title" style="margin-top: 0;">BAGIAN 2: DETAIL OPSI INVESTASI & 5 FITUR UNGGULAN</div>
    <div class="content-text" style="margin-bottom: 15px;">
        Sistem SIMAQ ERP tidak hanya berfungsi sebagai pencatat administratif biasa, melainkan sebagai mesin otomatisasi operasional yang menghubungkan setiap titik proses bisnis {{ $mou->nama_customer }}. Perbedaan mendasar dari ketiga paket terletak pada kedalaman modul analitis/kontrol serta kelengkapan perangkat keras IoT yang didapatkan.
    </div>

    <div class="img-placeholder" style="margin-bottom: 20px;">
        @php
            $img_iot1 = public_path('assets/image/mou/iot_hardware.png');
        @endphp
        @if(file_exists($img_iot1))
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents($img_iot1)) }}" alt="Sistem Hardware IoT">
        @else
            [GAMBAR SISTEM HARDWARE IOT]
            <br><small>Letakkan gambar di public/assets/image/mou/iot_hardware.png</small>
        @endif
    </div>

    <div style="font-weight: bold; margin-bottom: 10px; color: #1f497d;">5 Fitur Unggulan Utama (Eksklusif Paket Core & Full Bundling)</div>

    <div class="feature-box">
        <div class="box-title">1. Otomatisasi Validasi Mutu Pangan (Modul HACCP untuk ISO 22000)</div>
        <div class="box-content">Digitalisasi Hazard Analysis and Critical Control Points (HACCP) untuk mengunci standar keamanan pangan secara otomatis di titik kritis (penerimaan ternak, RPH, dapur kuliner). Memastikan produk memenuhi standar higienitas ISO 22000 & Sertifikasi Halal.</div>
    </div>
    <div class="feature-box">
        <div class="box-title">2. Keterlacakan Total IoT (Traceability System dari Hulu ke Hilir)</div>
        <div class="box-content">Inovasi pelacakan rantai pasok berbasis Unique Batch QR Code. Konsumen dapat memindai paket untuk melihat riwayat asal ternak, tanggal potong RPH, nama jagal, sertifikat halal, hingga timestamp dapur.</div>
    </div>
    <div class="feature-box">
        <div class="box-title">3. Logistik Canggih & Live Tracking (GIS Mapping & Tanda Tangan Digital)</div>
        <div class="box-content">Pemantauan pergerakan kurir real-time via GIS Map, kalkulasi jarak, estimasi ETA, serta bukti serah terima sah.</div>
    </div>
    <div class="feature-box">
        <div class="box-title">4. Proteksi & Otomasi Kandang (Hardware IoT ESP32 untuk Animal Welfare)</div>
        <div class="box-content">Penempatan mikrokontroler ESP32 dengan sensor suhu DHT22, amonia MQ-135, dan volume air/pakan otomatis untuk menjaga prinsip Animal Welfare dan menekan tingkat penyusutan bobot ternak (shrinkage rate).</div>
    </div>
    <div class="feature-box">
        <div class="box-title">5. Business Intelligence (BI) & Analitik (Yield vs Waste & Heatmap)</div>
        <div class="box-content">Dasbor analitis tingkat eksekutif menyajikan analisis persentase karkas (Yield vs Waste Ratio) dan Geographic Heatmap pemesanan aqiqah di wilayah Jabodetabek untuk keputusan berbasis data.</div>
    </div>

    <div class="page-break"></div>

    <!-- PAGE 4 -->
    <div class="section-title" style="margin-top: 0;">BAGIAN 3: TABEL CEKLIS PERBANDINGAN FITUR ERP</div>

    <table class="comparison">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 50%;">Spesifikasi & Fitur Modul SIMAQ ERP</th>
                <th class="center" style="width: 15%;">Paket Lite<br><small>(Rp 590rb)</small></th>
                <th class="center" style="width: 15%;">Paket Core<br><small>(Rp 690rb)</small></th>
                <th class="center" style="width: 15%;">Full Bundling<br><small>(Rp 740rb)</small></th>
            </tr>
        </thead>
        <tbody>
            <tr><td class="center">1</td><td>Sistem Terintegrasi Hulu ke Hilir (Core Web ERP)</td><td class="center">✔</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr><td class="center">2</td><td>Manajemen Ternak & Kurban (+ Cetak Sertifikat)</td><td class="center">✔</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr><td class="center">3</td><td>Otomasi Dapur Produksi Kuliner (Batch & Resep)</td><td class="center">✔</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr><td class="center">4</td><td>Manajemen Finansial Dashboard Eksekutif (COGS)</td><td class="center">✔</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr><td class="center">5</td><td>Pengelolaan SDM (Database Karyawan)</td><td class="center">✔</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr><td class="center">6</td><td>Manajemen Absensi & Monitoring Kehadiran Staf Real-Time</td><td class="center">✔</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr><td class="center">7</td><td>Pusat Kendali Referral & Komisi Kemitraan</td><td class="center">✔</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr><td class="center">8</td><td>Jadwal Komunikasi Otomatis CRM (WA Gateway)</td><td class="center">✔</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr><td class="center">9</td><td>Alur Digital Kanban Board RPH (+ Akses CCTV)</td><td class="center" style="color: red; font-weight: bold;">X</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr><td class="center">10</td><td>Keterlacakan Digital (Traceability System via QR)</td><td class="center" style="color: red; font-weight: bold;">X</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr><td class="center">11</td><td>Pos Kendali Kritis Mutu Pangan (Modul HACCP)</td><td class="center" style="color: red; font-weight: bold;">X</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr><td class="center">12</td><td>Peta Distribusi Armada Logistik (GIS Map & ETA)</td><td class="center" style="color: red; font-weight: bold;">X</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr><td class="center">13</td><td>Modul Manajemen Aset Berharga Perusahaan</td><td class="center" style="color: red; font-weight: bold;">X</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr><td class="center">14</td><td>Inteligensia Bisnis Modern (Business Intelligence)</td><td class="center" style="color: red; font-weight: bold;">X</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr><td class="center">15</td><td>Integrasi & Infrastruktur API Sensor IoT</td><td class="center" style="color: red; font-weight: bold;">X</td><td class="center">✔</td><td class="center">✔</td></tr>
            <tr style="background-color: #f9f9f9; font-weight: bold;">
                <td class="center">16</td>
                <td>Alokasi Unit Hardware Sensor IoT (ESP32)</td>
                <td class="center" style="color: red;">X</td>
                <td class="center">1 Unit Sensor</td>
                <td class="center">6 Unit Lengkap</td>
            </tr>
        </tbody>
    </table>

    <div style="background-color: #fff3cd; border: 1px solid #ffeeba; padding: 10px; font-size: 9pt; border-radius: 4px; margin-bottom: 20px;">
        <strong>Catatan Penambahan Hardware IoT di Masa Depan:</strong><br>
        Penambahan alat sensor IoT di masa depan akibat ekspansi cabang/farm baru dikenakan biaya <strong>Rp 40.000 per unit</strong> (mencakup hardware, firmware ESP32, kalibrasi, pengujian, instalasi on-site, dan integrasi API Endpoint).
    </div>

    <div class="img-placeholder">
        @php
            $img_iot2 = public_path('assets/image/mou/iot_mikrokontroler.png');
        @endphp
        @if(file_exists($img_iot2))
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents($img_iot2)) }}" alt="Arsitektur Mikrokontroler IoT">
        @else
            [GAMBAR ARSITEKTUR MIKROKONTROLER IOT SIMAQ ERP]
            <br><small>Letakkan gambar di public/assets/image/mou/iot_mikrokontroler.png</small>
        @endif
    </div>

    <div class="page-break"></div>

    <!-- PAGE 5 -->
    <div class="section-title" style="margin-top: 0;">BAGIAN 4: PETA JALAN PENGERJAAN & TERMIN PEMBAYARAN (3-4 BULAN)</div>

    <div class="termin-box">
        <div class="t-title">Termin 1: DP Awal 30% &mdash; Bulan ke-1 (Fondasi Sistem, HRD, & CRM)</div>
        <div class="t-desc">Target: Architecture DB, UI/UX, RBAC, Dashboard, HRD, Absensi, Referral Kemitraan, & Otomatisasi WA CRM.</div>
    </div>
    <div class="termin-box">
        <div class="t-title">Termin 2: Core Supply Chain & Pembelian IoT (35%) &mdash; Bulan ke-2</div>
        <div class="t-desc">Target: Multi-Farm, PO, Inventori Gudang, Otomasi Dapur (BOM), Perakitan Fisik Hardware IoT ESP32 & Firmware.</div>
    </div>
    <div class="termin-box">
        <div class="t-title">Termin 3: Alur Produksi & Uji Integrasi IoT (25%) &mdash; Bulan ke-3</div>
        <div class="t-desc">Target: Kanban RPH, Stream CCTV, HACCP Validasi, Traceability QR, GIS Map Kurir, & Receiver API Sensor IoT.</div>
    </div>
    <div class="termin-box">
        <div class="t-title">Termin 4: Handover, BI, & Pelunasan (10%) &mdash; Bulan ke-4</div>
        <div class="t-desc">Target: Finansial COGS, Manajemen Aset, Analitik BI, QA Testing, UAT, Live Deployment, & Staff Training.</div>
    </div>

    <div class="section-title">BAGIAN 5: ARGUMENTASI STRATEGIS & KETENTUAN HUKUM</div>
    <div class="content-text" style="font-size: 9pt;">
        Di pasar software house Jakarta, ERP Vertikal berbasis IoT umumnya dipatok sebesar <strong>Rp 5juta &ndash; Rp 8Juta</strong>. ELCoding mampu menghadirkan penawaran efisien ini karena menggunakan repositori pustaka komponen teruji dan tim terfokus. Proyeksi ROI dicapai dalam <strong>3 hingga 5 bulan</strong> melalui penekanan waste daging (8-12%), efisiensi rute GIS (15%), dan peningkatan repeat order (20%).
        <br><br>
        <strong>Ketentuan Proteksi Bisnis, Server, & Hukum:</strong>
        <ol style="margin-top: 5px; padding-left: 20px;">
            <li style="margin-bottom: 5px;"><strong>Server & API Pihak Ketiga:</strong> Biaya Cloud VPS/Hosting dan kuota WhatsApp Gateway API di luar nilai kontrak pengembangan software dasar, dan ditanggung sepenuhnya oleh pihak {{ $mou->nama_customer }}. Pendampingan setup & pengelolaan server dapat dibantu oleh ELCoding (skema teknis dibahas terpisah).</li>
            <li style="margin-bottom: 5px;"><strong>Change Request:</strong> Permintaan fitur baru di luar 16 modul yang disepakati dikategorikan sebagai Change Request dengan biaya dan Addendum terpisah.</li>
            <li style="margin-bottom: 5px;"><strong>Garansi Sistem:</strong> Garansi bebas bug (Bug Fixing Guarantee) diberikan secara <strong>GRATIS selama 3 Bulan</strong> pasca serah terima (BAST).</li>
        </ol>
    </div>

    <table class="ttd-table">
        <tr>
            <td style="text-align: left;">
                Diajukan Oleh,<br>
                <strong>ELCoding Software Development</strong>
                <br>
                @php
                    $qrcode = (string) \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(70)->generate(url('/admin/mou/' . $mou->id . '/pdf'));
                @endphp
                <div style="margin: 10px 0;">
                    <img src="data:image/svg+xml;base64,{!! base64_encode($qrcode) !!}" alt="QR Code">
                </div>
                <strong>{{ $mou->created_by ?? 'Zaky Afrizal' }}</strong><br>
                Lead Tech & Managing Partner
            </td>
            <td style="text-align: left;">
                Disetujui Oleh,<br>
                <strong>{{ $mou->nama_customer }}</strong>
                <br>
                <div class="ttd-box"></div>
                <br>
                Direksi / Manajemen Utama
            </td>
        </tr>
    </table>
</main>
</body>
</html>
