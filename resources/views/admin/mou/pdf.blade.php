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

.recipient {
    margin-bottom: 15px;
    font-size: 11pt;
    line-height: 1.4;
}
.doc-title {
    text-align: center;
    font-size: 12pt;
    font-weight: bold;
    margin: 15px 0;
    text-decoration: underline;
}
.intro {
    font-size: 11pt;
    margin: 10px 0;
    text-align: justify;
}
table.items-table {
    width: 100%;
    border-collapse: collapse;
    margin: 10px 0;
    font-size: 10pt;
}
table.items-table th {
    background-color: #1f497d;
    color: white;
    border: 1px solid #000;
    padding: 6px 4px;
    text-align: center;
    font-weight: bold;
}
table.items-table td {
    border: 1px solid #000;
    padding: 6px 4px;
    vertical-align: top;
}
.no-col { width: 40px; text-align: center; }
.spec-col { text-align: left; }
.qty-col { width: 50px; text-align: center; }
.harga-col { width: 100px; text-align: center; }
.total-col { width: 120px; text-align: center; }
.grand-total-row { background-color: #f0f4f8; }
.grand-total-label {
    background-color: #1f497d;
    color: white;
    font-weight: bold;
    text-align: center;
}
.terms {
    font-size: 10pt;
    margin: 15px 0;
    line-height: 1.5;
}
.terms-title { font-weight: bold; margin-bottom: 5px; }
.terms ol { margin: 5px 0; padding-left: 20px; }
.terms li { margin: 3px 0; }
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
            <td style="text-align: left; padding: 0; border: none;">ELCoding | {{ $mou->perihal ?? 'Surat Penawaran' }} - {{ $mou->nama_customer }}</td>
            <td style="text-align: right; padding: 0; border: none;">Halaman <span class="pagenum"></span></td>
        </tr>
    </table>
</footer>

<main>
    <div class="letterhead">
        <div class="title">ELCODING.ID</div>
        <div class="subtitle">Solusi Pengembangan Perangkat Lunak & Sistem Informasi Profesional</div>
    </div>

    <table class="meta">
        <tr>
            <td class="label">Nomor:</td>
            <td class="value">{{ $mou->nomor_surat }}</td>
            <td style="text-align: right; width: 50%;"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($mou->tanggal)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Perihal:</td>
            <td class="value">{{ $mou->perihal }}</td>
            <td style="text-align: right;"><strong>Lokasi:</strong> {{ $mou->lokasi }}</td>
        </tr>
        <tr>
            <td class="label">Lampiran:</td>
            <td class="value">{{ $mou->lampiran }}</td>
            <td style="text-align: right;"></td>
        </tr>
    </table>
    
    <hr class="meta-divider">
    
    <div class="recipient">
        Kepada Yth.<br>
        <strong>{{ $mou->nama_customer }}</strong><br>
        Di Tempat
    </div>

    <div class="doc-title">SURAT PENAWARAN</div>

    @if(!empty($mou->pengantar_surat))
    <div class="intro">{!! nl2br(e($mou->pengantar_surat)) !!}</div>
    @endif

    <table class="items-table">
        <thead>
            <tr>
                <th class="no-col">No</th>
                <th class="spec-col">Spesifikasi</th>
                <th class="qty-col">Qty</th>
                <th class="harga-col">Harga</th>
                <th class="total-col">Total harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mou->items as $index => $item)
            <tr>
                <td class="no-col">{{ $index + 1 }}</td>
                <td class="spec-col">{!! nl2br(e($item->spesifikasi)) !!}</td>
                <td class="qty-col">{{ $item->qty }}</td>
                <td class="harga-col">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="total-col">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="grand-total-row">
                <td colspan="4" style="text-align: right; padding-right: 10px;">Grand Total</td>
                <td class="grand-total-label">Rp {{ number_format($mou->grand_total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="terms">
        <div class="terms-title">Ketentuan:</div>
        <ol>
        @php
            // Memisahkan berdasarkan baris baru dan membersihkan spasi
            $termsArray = array_filter(array_map('trim', explode("\n", $mou->ketentuan)));
        @endphp
        @if(!empty($termsArray))
            @foreach($termsArray as $term)
                <li>{{ $term }}</li>
            @endforeach
        @endif
        </ol>
    </div>

    <table class="ttd-table">
        <tr>
            <td style="text-align: left;">
                Diajukan Oleh,<br>
                <strong>ELCoding Software Development</strong>
                <br>
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
