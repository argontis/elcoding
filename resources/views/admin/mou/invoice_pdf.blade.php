<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Invoice {{ strtoupper($type) }} - {{ $mou->nama_file }}</title>
<style>
@page { margin: 45px 50px 60px 50px; }
body { font-family: Helvetica, Arial, sans-serif; margin: 0; padding: 0; font-size: 10pt; line-height: 1.5; color: #333; }

header {
    text-align: center; 
    font-size: 11pt; 
    color: #111; 
}
.header-logo { 
    position: absolute; 
    top: 5px; 
    right: 0px; 
    width: 70px; 
    height: auto; 
    z-index: -1;
}

.letterhead { width: 100%; border-bottom: 2px solid #1f497d; padding-bottom: 10px; margin-bottom: 20px; }
.letterhead .title { font-size: 14pt; font-weight: bold; color: #000; margin: 0 0 4px 0; }
.letterhead .subtitle { font-size: 10pt; color: #555; }

.invoice-title {
    text-align: right;
    font-size: 24pt;
    font-weight: bold;
    color: #1f497d;
    margin-bottom: 5px;
    margin-top: 10px;
}

.invoice-meta {
    width: 100%;
    margin-bottom: 30px;
}
.invoice-meta td {
    vertical-align: top;
}

.bill-to {
    width: 60%;
}
.bill-to-title {
    font-size: 10pt;
    font-weight: bold;
    color: #777;
    text-transform: uppercase;
    margin-bottom: 5px;
}
.bill-to-name {
    font-size: 12pt;
    font-weight: bold;
    color: #000;
}

.invoice-details {
    width: 40%;
    text-align: right;
}
.invoice-details table {
    width: 100%;
}
.invoice-details table td {
    padding: 2px 0;
}
.invoice-details .label {
    font-weight: bold;
    color: #555;
    text-align: left;
}
.invoice-details .value {
    text-align: right;
    font-weight: bold;
    color: #000;
}

.invoice-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}
.invoice-table th {
    background-color: #1f497d;
    color: white;
    padding: 10px;
    text-align: left;
    font-weight: bold;
}
.invoice-table td {
    padding: 12px 10px;
    border-bottom: 1px solid #ddd;
}
.invoice-table .amount-col {
    text-align: right;
}

.total-section {
    width: 100%;
    margin-bottom: 40px;
}
.total-section table {
    width: 50%;
    float: right;
    border-collapse: collapse;
}
.total-section table td {
    padding: 8px 10px;
}
.total-row {
    background-color: #f1f5f9;
    font-weight: bold;
    font-size: 12pt;
    color: #1f497d;
    border-top: 2px solid #1f497d;
}

.footer-section {
    margin-top: 50px;
    width: 100%;
}

.payment-info {
    float: left;
    width: 50%;
    padding: 15px;
    background-color: #f8fafc;
    border-left: 4px solid #1f497d;
    box-sizing: border-box;
}
.payment-info h4 {
    margin: 0 0 10px 0;
    color: #1f497d;
    font-size: 11pt;
}

.signature-box {
    float: right;
    width: 250px;
    text-align: center;
}
.signature-name {
    font-weight: bold;
    margin-top: 10px;
    border-bottom: 1px solid #000;
    display: inline-block;
    padding-bottom: 2px;
}

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
</style>
</head>
<body>

    <header>
        <div class="letterhead">
            @php
                $iconPath = public_path('assets/image/icon.png');
                $iconData = '';
                $iconMime = 'image/png';
                if (file_exists($iconPath)) {
                    $iconData = base64_encode(file_get_contents($iconPath));
                }
            @endphp
            @if($iconData)
                <img src="data:{{ $iconMime }};base64,{{ $iconData }}" class="header-logo">
            @endif
            <div class="title">ELCoding Software Development</div>
            <div class="subtitle">Jl. Dr. Wahidin Sudirohusodo Ruko No. 2, Pesurungan Kidul, Tegal Barat, Kota Tegal</div>
        </div>
    </header>

    <div class="invoice-title">
        INVOICE
    </div>

    <table class="invoice-meta">
        <tr>
            <td class="bill-to">
                <div class="bill-to-title">Ditagihkan Kepada:</div>
                <div class="bill-to-name">{{ $mou->nama_customer }}</div>
                <div>{{ $mou->lokasi }}</div>
            </td>
            <td class="invoice-details">
                <table>
                    <tr>
                        <td class="label">Nomor Invoice:</td>
                        <td class="value">{{ $invoice_number }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tanggal:</td>
                        <td class="value">{{ $date }}</td>
                    </tr>
                    <tr>
                        <td class="label">Referensi MoU:</td>
                        <td class="value">{{ $mou->nomor_surat }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="invoice-table">
        <thead>
            <tr>
                <th>Deskripsi</th>
                <th class="amount-col" style="width: 30%;">Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>{{ $description }}</strong><br>
                    <span style="color: #666; font-size: 9pt;">Sesuai dengan kesepakatan pada MoU Nomor: {{ $mou->nomor_surat }}</span>
                </td>
                <td class="amount-col">
                    {{ number_format($amount, 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="total-section clearfix">
        <table>
            <tr>
                <td style="text-align: left;">Subtotal</td>
                <td style="text-align: right;">Rp {{ number_format($amount, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td style="text-align: left;">Total Tagihan</td>
                <td style="text-align: right;">Rp {{ number_format($amount, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer-section clearfix">
        <div class="payment-info">
            <h4>Informasi Pembayaran:</h4>
            <p style="margin: 0;">Pembayaran dapat ditransfer melalui rekening berikut:</p>
            <p style="margin: 5px 0 0 0;">
                <strong>BANK BCA</strong><br>
                No. Rekening: <strong>0471736359</strong><br>
                Atas Nama: <strong>Muh Zaky Afrizal</strong>
            </p>
        </div>

        <div class="signature-box">
            <p style="margin: 0;">Hormat Kami,</p>
            <div style="margin: 15px 0;">
                <img src="data:image/svg+xml;base64,{!! base64_encode($qrcode) !!}" alt="QR Code" width="90" height="90">
            </div>
            <div class="signature-name">{{ $mou->created_by ?? 'Zaky Afrizal' }}</div>
            <div style="font-size: 9pt; color: #555;">ELCoding Software Development</div>
        </div>
    </div>

</body>
</html>
