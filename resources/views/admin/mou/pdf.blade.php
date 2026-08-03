<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>{{ $mou->nama_file }}</title>
<style>
@page {
	margin: 2cm 2.5cm;
}
body {
	font-family: Arial, sans-serif;
	margin: 0;
	padding: 0;
	font-size: 11pt;
	line-height: 1.3;
}
.page {
	width: 100%;
}
.header {
	text-align: center;
	border-bottom: 2px solid #000;
	padding-bottom: 5px;
	margin-bottom: 15px;
}
.company-name {
	font-size: 14pt;
	font-weight: bold;
	color: #4472C4;
	margin: 0 0 3px 0;
}
.company-sub {
	font-size: 9pt;
	margin: 0 0 3px 0;
	font-weight: normal;
}
.company-address {
	font-size: 9pt;
	margin: 0;
	font-weight: bold;
}
.location-date {
	text-align: right;
	font-size: 11pt;
	margin: 10px 0 15px 0;
}
.recipient {
	margin-bottom: 15px;
	font-size: 11pt;
	line-height: 1.4;
}
.title {
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
table {
	width: 100%;
	border-collapse: collapse;
	margin: 10px 0;
	font-size: 10pt;
}
table th {
	background-color: #4472C4;
	color: white;
	border: 1px solid #000;
	padding: 6px 4px;
	text-align: center;
	font-weight: bold;
}
table td {
	border: 1px solid #000;
	padding: 6px 4px;
	vertical-align: top;
}
.no-col {
	width: 40px;
	text-align: center;
}
.spec-col {
	text-align: left;
}
.qty-col {
	width: 50px;
	text-align: center;
}
.harga-col {
	width: 100px;
	text-align: center;
}
.total-col {
	width: 120px;
	text-align: center;
}
.grand-total-row {
	background-color: #D9E2F3;
}
.grand-total-label {
	background-color: #4472C4;
	color: white;
	font-weight: bold;
	text-align: center;
}
.terms {
	font-size: 10pt;
	margin: 15px 0;
	line-height: 1.5;
}
.terms-title {
	font-weight: bold;
	margin-bottom: 5px;
}
.terms ol {
	margin: 5px 0;
	padding-left: 20px;
}
.terms li {
	margin: 3px 0;
}
.signature {
	margin-top: 2px;
	font-size: 11pt;
}
.sig-closing {
	margin-bottom: 2px;
}
.sig-name {
	font-weight: bold;
}
.footer {
	position: fixed;
	bottom: -40px;
	left: 0;
	width: 100%;
	text-align: center;
	padding: 10px 0;
}
</style>
</head>
<body>
<div class="page">
	<div class="header">
		<div class="company-name">CV AZZAHRA COMPUTER</div>
		<div class="company-sub">AUTHORIZED SERVICE CENTER & INFRASTRUKTUR IT</div>
		<div class="company-address">HEAD OFFICE : RUKO CITRALAND TEGAL BLOK B/11, TEGAL</div>
		<div class="company-address">BRANCH OFFICE : RUKO KRANGGAN CIBUBUR, BLOK RT16/27, Telp.(0283)34.09.09</div>
	</div>

	<div class="location-date">{{ $mou->lokasi }}, {{ \Carbon\Carbon::parse($mou->tanggal)->translatedFormat('d F Y') }}</div>

	<div class="recipient">
		Kepada Yth.<br>
		{{ $mou->nama_customer }}<br>
		Di Tempat
	</div>

	<div class="title">SURAT PENAWARAN</div>

	@if(!empty($mou->pengantar_surat))
	<div class="intro">{!! nl2br(e($mou->pengantar_surat)) !!}</div>
	@endif

	<table>
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
			@php $no = 1; @endphp
			@if($mou->items && count($mou->items) > 0)
				@foreach($mou->items as $item)
				<tr>
					<td class="no-col">{{ $no++ }}</td>
					<td class="spec-col">{{ $item->spesifikasi }}</td>
					<td class="qty-col">{{ (int)$item->qty }}</td>
					<td class="harga-col">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
					<td class="total-col">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
				</tr>
				@endforeach
			@endif
			<tr class="grand-total-row">
				<td colspan="4" style="text-align: right; padding-right: 10px;">Grand Total</td>
				<td class="grand-total-label">Rp {{ number_format($mou->grand_total, 0, ',', '.') }}</td>
			</tr>
		</tbody>
	</table>

	<div class="terms">
		<div class="terms-title">Ketentuan:</div>
		@if(!empty($mou->ketentuan))
			<div style="margin: 5px 0; padding-left: 20px;">
			{!! nl2br(e($mou->ketentuan)) !!}
			</div>
		@else
			<ol>
				<li>Semua barang diatas inden 1-2 hari</li>
				<li>Harga diatas sudah termasuk biaya instalasi</li>
				<li>Garansi perangkat selama 2 tahun</li>
				<li>Pembayaran min DP 50% dr total biaya</li>
				<li>Pembayaran bisa di transfer ke Rek <b>BCA No.Rek 0470727705 (ferry juanda)</b></li>
			</ol>
		@endif
	</div>

	<div class="signature">
		<div class="sig-closing">Hormat Kami,</div>
		
		@php
			$ttd_path = public_path('assets/image/ttd.jpeg');
			$ttd_data = '';
			if (file_exists($ttd_path)) {
				$ttd_data = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($ttd_path));
			}
		@endphp
		
		@if(isset($qrcode) && !empty($qrcode))
			<div style="margin: 10px 0;">
				<img src="data:image/svg+xml;base64,{!! base64_encode($qrcode) !!}" alt="QR Code" style="max-width: 100px; height: auto;">
			</div>
		@elseif(!empty($ttd_data))
			<img src="{{ $ttd_data }}" alt="Tanda Tangan" style="max-width: 100px; height: auto;">
		@else
			<div style="height: 100px;"></div>
		@endif
		
		<div class="sig-name">({{ $mou->created_by ?? 'Ferry Juanda.ST' }})</div>
	</div>

	@php
		$footer_path = public_path('assets/image/footer.png');
		$footer_data = '';
		if (file_exists($footer_path)) {
			$footer_data = 'data:image/png;base64,' . base64_encode(file_get_contents($footer_path));
		}
	@endphp
	@if(!empty($footer_data))
	<div class="footer">
		<img src="{{ $footer_data }}" alt="Footer" style="width: 100%; height: auto;">
	</div>
	@endif
</div>
</body>
</html>
