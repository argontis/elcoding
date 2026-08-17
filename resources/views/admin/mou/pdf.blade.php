<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>{{ $mou->nama_file }}</title>
@php
if (!function_exists('cleanEntities')) {
    function cleanEntities($string) {
        if (!is_string($string)) return $string;
        while (strpos($string, '&amp;') !== false) {
            $string = str_replace('&amp;', '&', $string);
        }
        return $string;
    }
}
@endphp
<style>
@page { margin: 45px 50px 60px 50px; }
body { font-family: Helvetica, Arial, sans-serif; margin: 0; padding: 0; font-size: 9pt; line-height: 1.5; color: #333; word-wrap: normal; word-break: normal; }
.page-break { page-break-after: always; }

header {
    position: fixed; 
    top: -45px; 
    left: 0; 
    right: 0; 
    height: 45px; 
    text-align: center; 
    font-size: 11pt; 
    color: #111; 
    padding-top: 15px;
}
.header-logo { 
    position: absolute; 
    top: 2px; 
    right: -50px; 
    width: 60px; 
    height: auto; 
    z-index: -1;
}

footer { 
    position: fixed; 
    bottom: -40px; 
    left: 0; 
    right: 0; 
    height: 40px; 
    font-size: 9pt; 
    color: #777; 
}
.pagenum:before { content: ""; }

.letterhead { width: 100%; border-bottom: 2px solid #1f497d; padding-bottom: 5px; margin-bottom: 5px; margin-top: -25px; }
.letterhead .title { font-size: 13pt; font-weight: bold; color: #000; margin: 0 0 2px 0; }
.letterhead .subtitle { font-size: 10pt; color: #555; margin-top: 5px; margin-bottom: 5px; }

table.meta { width: 100%; border-collapse: collapse; font-size: 9pt; margin-bottom: 0; }
table.meta td { padding: 2px 0; vertical-align: top; line-height: 1.3; }
table.meta .label { font-weight: bold; width: 1%; white-space: nowrap; padding-right: 5px; }
table.meta .value { width: 50%; }
hr.meta-divider { border: 0; border-top: 1px solid #cbd5e1; margin-top: 8px; margin-bottom: 8px; }

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

.custom-section { margin-top: 5px; margin-bottom: 10px; }
.section-title {
    font-size: 11pt;
    font-weight: bold;
    color: #1f497d;
    margin-bottom: 5px;
    margin-top: 0px;
    border-left: 3px solid #378da1;
    padding-left: 10px;
}
.section-content {
    font-size: 9pt;
    text-align: justify;
    line-height: 1.5;
}
.section-content ul, .section-content ol { margin-top: 5px; margin-bottom: 10px; padding-left: 20px; }
.section-content p { margin-top: 0; margin-bottom: 6px; }
.section-content p.ql-indent-1 { padding-left: 0; text-indent: 30px; }
.section-content p.ql-indent-2 { padding-left: 0; text-indent: 60px; }
.section-content p.ql-indent-3 { padding-left: 0; text-indent: 90px; }
.section-content p.ql-indent-4 { padding-left: 0; text-indent: 120px; }
.section-content img { display: block; margin: 10px auto; width: 85%; max-height: 550px; height: auto; }
.section-image { margin-top: 10px; text-align: center; }
.section-image img { width: 85%; max-height: 550px; height: auto; margin-bottom: 10px; }

.note-box {
    background-color: #fffaf0;
    border-left: 4px solid #e67e22;
    border-top: 1px solid #fdf0d5;
    border-right: 1px solid #fdf0d5;
    border-bottom: 1px solid #fdf0d5;
    padding: 12px 15px;
    margin-bottom: 15px;
}
.note-title {
    font-weight: bold;
    font-size: 10pt;
    margin-bottom: 0px;
    color: #2c3e50;
}
.note-content {
    font-size: 9pt;
    color: #333;
    line-height: 1.4;
}
.note-content p {
    margin-top: 2px;
    margin-bottom: 4px;
}
.point-left-box {
    border-left: 3px solid #378da1;
    border-top: 1px solid #e2e8f0;
    border-right: 1px solid #e2e8f0;
    border-bottom: 1px solid #e2e8f0;
    padding: 8px 12px;
    margin-bottom: 10px;
    background-color: #fcfcfc;
}
.point-left-title { font-size: 10pt; font-weight: bold; color: #1f497d; margin-bottom: 3px; }
.point-left-desc { font-size: 9.5pt; color: #444; }

.point-top-box {
    border-top: 3px solid #1f497d;
    border-left: 1px solid #e2e8f0;
    border-right: 1px solid #e2e8f0;
    border-bottom: 1px solid #e2e8f0;
    padding: 8px 12px;
    margin-bottom: 10px;
    background-color: #fcfcfc;
}
.point-top-title { font-size: 10pt; font-weight: bold; color: #1f497d; margin-bottom: 3px; }
.point-top-desc { font-size: 9.5pt; color: #444; }
</style>
</head>
<body>

<header>
    @if(file_exists(public_path('assets/image/mou_icon.png')))
        @php
            $iconData = base64_encode(file_get_contents(public_path('assets/image/mou_icon.png')));
            $iconMime = mime_content_type(public_path('assets/image/mou_icon.png'));
        @endphp
        <img src="data:{{ $iconMime }};base64,{{ $iconData }}" class="header-logo">
    @endif
    ELCoding.id &ndash; Software Development | Service Center | Sale
</header>

<footer>
    <table style="width: 100%; border: none; padding: 0; margin: 0; font-size: 9pt; color: #777;">
        <tr>
            <td style="text-align: left; padding: 0; border: none;">ELCoding | {{ $mou->perihal ?? 'Surat Penawaran' }} - {{ $mou->nama_customer }}</td>
            <td style="text-align: right; padding: 0; border: none;"></td>
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
            <td style="text-align: right; width: 50%;"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($mou->tanggal)->locale('id')->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Perihal:</td>
            <td class="value">{{ $mou->perihal }}</td>
            <td style="text-align: right;"><strong>Kepada:</strong> Yth. {{ $mou->nama_customer }}</td>
        </tr>
        <tr>
            <td class="label">Lampiran:</td>
            <td class="value">{{ $mou->lampiran }}</td>
            <td style="text-align: right;"><strong>Lokasi:</strong> {{ $mou->lokasi }}</td>
        </tr>
    </table>
    
    <hr class="meta-divider">
    




    @if(isset($mou->sections) && $mou->sections->count() > 0)
        @foreach($mou->sections as $section)
        @if(!$loop->first)
            <div class="page-break"></div>
        @endif
        <div class="custom-section">
            <div class="section-title">{{ $section->title }}</div>
            
            @php
                $blocks = [];
                $isLegacy = true;
                $decoded = json_decode($section->content, true);
                if (is_array($decoded) && isset($decoded[0]['type'])) {
                    $blocks = $decoded;
                    $isLegacy = false;
                }
                if ($isLegacy) {
                    if (($section->type ?? '') === 'point_left' || ($section->type ?? '') === 'point_top') {
                        $blocks = [['type' => $section->type, 'points' => $decoded ?? []]];
                    } else {
                        $blocks = [['type' => 'text', 'content' => $section->content]];
                    }
                }
            @endphp

            @foreach($blocks as $block)
                @if($block['type'] === 'text')
                    @php
                        $processedContent = preg_replace('/<p[^>]*>\s*(<img[^>]+>)\s*<\/p>/i', '$1', cleanEntities($block['content'] ?? ''));
                        $processedContent = preg_replace('/(<img[^>]+>)/i', '<div class="section-image">$1</div>', $processedContent);
                    @endphp
                    <div class="section-content">{!! $processedContent !!}</div>
                                @elseif($block['type'] === 'note')
                    <div class="note-box">
                        @if(!empty($block['title']))
                            <div class="note-title">{{ $block['title'] }}</div>
                        @endif
                        @php
                            $processedContent = preg_replace('/<p[^>]*>\s*(<img[^>]+>)\s*<\/p>/i', '$1', cleanEntities($block['content'] ?? ''));
                            $processedContent = preg_replace('/(<img[^>]+>)/i', '<div class="section-image">$1</div>', $processedContent);
                        @endphp
                        <div class="note-content">{!! $processedContent !!}</div>
                    </div>
                @elseif($block['type'] === 'point_left')
                    @foreach($block['points'] ?? [] as $point)
                    <div class="point-left-box">
                        <div class="point-left-title">{{ cleanEntities($point['title'] ?? '') }}</div>
                        <div class="point-left-desc">{!! nl2br(htmlspecialchars(cleanEntities($point['desc'] ?? ''), ENT_QUOTES, 'UTF-8', false)) !!}</div>
                    </div>
                    @endforeach
                @elseif($block['type'] === 'point_top')
                    @foreach($block['points'] ?? [] as $point)
                    <div class="point-top-box">
                        <div class="point-top-title">{{ cleanEntities($point['title'] ?? '') }}</div>
                        <div class="point-top-desc">{!! nl2br(htmlspecialchars(cleanEntities($point['desc'] ?? ''), ENT_QUOTES, 'UTF-8', false)) !!}</div>
                    </div>
                    @endforeach
                @elseif($block['type'] === 'table')
                    <table class="block-table" style="width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 15px; font-size: 10pt;">
                        <thead>
                            <tr>
                                <th style="background-color: #1f497d; color: white; border: 1px solid #000; padding: 6px 4px; text-align: center; font-weight: bold; width: 40%;">{{ cleanEntities($block['headers'][0] ?? 'Keterangan') }}</th>
                                <th style="background-color: #1f497d; color: white; border: 1px solid #000; padding: 6px 4px; text-align: center; font-weight: bold; width: 60%;">{{ cleanEntities($block['headers'][1] ?? 'Detail') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($block['rows'] ?? [] as $row)
                            <tr>
                                <td style="border: 1px solid #000; padding: 6px 4px; vertical-align: top;">{!! nl2br(htmlspecialchars(cleanEntities($row['col1'] ?? ''), ENT_QUOTES, 'UTF-8', false)) !!}</td>
                                <td style="border: 1px solid #000; padding: 6px 4px; vertical-align: top;">{!! nl2br(htmlspecialchars(cleanEntities($row['col2'] ?? ''), ENT_QUOTES, 'UTF-8', false)) !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif($block['type'] === 'dynamic_table')
                    <table class="block-table" style="width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 15px; font-size: 9pt;">
                        <thead>
                            <tr>
                                @foreach($block['headers'] ?? [] as $hIdx => $header)
                                    @php
                                        $align = 'center';
                                        if ($hIdx === 1) $align = 'left';
                                        $width = '';
                                        if ($hIdx === 0) $width = 'width: 4%;';
                                        elseif ($hIdx === 1) $width = 'width: 55%;';
                                    @endphp
                                                                                                            @php
                                                                                $cleanHeader = cleanEntities($header);
                                    @endphp
                                    <th style="background-color: #1f497d; color: white; border: 1px solid #cbd5e1; padding: 2px 4px; line-height: 1.1; text-align: {{ $align }}; font-weight: bold; {{ $width }}">{!! nl2br(htmlspecialchars($cleanHeader, ENT_QUOTES, 'UTF-8', false)) !!}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($block['rows'] ?? [] as $rIdx => $row)
                            @php
                                $rowBg = ($rIdx % 2 !== 0) ? 'background-color: #f1f5f9;' : '';
                            @endphp
                            <tr style="{{ $rowBg }}">
                                @foreach($row as $cIdx => $cell)
                                                                                                                                                @php
                                        $align = 'center';
                                        $weight = 'normal';
                                        if ($cIdx === 1) {
                                            $align = 'left';
                                            $weight = 'bold';
                                        }
                                        
                                                                                // Clean up HTML entities safely (handle heavily nested &amp;)
                                        $cleanCell = cleanEntities($cell);
                                        $cellContent = nl2br(htmlspecialchars($cleanCell, ENT_QUOTES, 'UTF-8', false));
                                        
                                        // Replace emojis with DejaVu Sans equivalents, use green for check, red for cross
                                        $cellContent = str_replace('✔️', '<span style="font-family: \'DejaVu Sans\', sans-serif; color: #16a34a; font-size: 12pt; font-weight: bold;">✔</span>', $cellContent);
                                        $cellContent = str_replace('❌', '<span style="font-family: \'DejaVu Sans\', sans-serif; color: #dc2626; font-size: 12pt; font-weight: bold;">✖</span>', $cellContent);
                                    @endphp
                                    <td style="border: 1px solid #cbd5e1; padding: 0px 4px; line-height: 1.1; vertical-align: middle; text-align: {{ $align }}; font-weight: {{ $weight }};">{!! $cellContent !!}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endforeach
        </div>
        @endforeach
    @endif


    <div class="page-break"></div>
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
<script type="text/php">
    if (isset($pdf)) {
        $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
        $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
        $size = 9;
        $color = array(0.466, 0.466, 0.466);
        $pdf->page_text(480, 815, $text, $font, $size, $color);
    }
</script>
</body>
</html>
