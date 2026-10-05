<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat Kelulusan - {{ $profile->user->name }}</title>
    <style>
        @page { margin: 0; padding: 0; }
        body { 
            margin: 0; 
            padding: 0; 
            font-family: 'Helvetica', 'Arial', sans-serif;
            background-color: #ffffff;
            color: #0f172a;
        }
        .container {
            width: 90%;
            height: 90%;
            position: absolute;
            top: 5%;
            left: 5%;
            text-align: center;
            border: 2px solid #e2e8f0;
            border-radius: 30px;
            box-sizing: border-box;
            background-color: #ffffff;
        }
        .content {
            margin-top: 50px;
        }
        .logo {
            height: 50px;
            margin-bottom: 20px;
        }
        .title {
            font-size: 16px;
            font-weight: bold;
            color: #d97706; /* amber-600 */
            margin-bottom: 5px;
            letter-spacing: 2px;
        }
        .subtitle {
            font-size: 14px;
            color: #64748b; /* slate-500 */
            font-family: monospace;
            margin-bottom: 30px;
        }
        
        .divider {
            border-top: 1px solid #e2e8f0;
            width: 70%;
            margin: 0 auto;
            padding-top: 30px;
        }

        .presented-to {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 10px;
        }
        .name {
            font-size: 40px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        .institution {
            font-size: 18px;
            color: #475569; /* slate-600 */
            margin-bottom: 20px;
        }
        .description {
            font-size: 14px;
            color: #64748b; /* slate-500 */
            width: 70%;
            margin: 0 auto;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .predicate {
            font-size: 20px;
            font-weight: bold;
            color: #020617; /* slate-950 */
            background-color: #f59e0b; /* amber-500 */
            padding: 12px 30px;
            display: inline-block;
            border-radius: 16px;
            margin-bottom: 20px;
        }
        .footer-date {
            margin-top: 20px;
            font-size: 14px;
            color: #64748b;
        }
        
        .footer {
            position: absolute;
            bottom: 50px;
            right: 50px;
            text-align: center;
        }
        .sign-title {
            font-size: 14px;
            margin-bottom: 10px;
            color: #64748b;
        }
        .sign-barcode {
            width: 80px;
            margin-bottom: 5px;
        }
        .sign-line {
            width: 150px;
            border-bottom: 1px solid #cbd5e1;
            margin: 0 auto 5px auto;
        }
        .sign-name {
            font-weight: bold;
            color: #0f172a;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            @if(file_exists(public_path('gambar/aset/logo.png')))
                <img src="{{ public_path('gambar/aset/logo.png') }}" class="logo" alt="Logo">
            @endif
            
            <div class="title">SERTIFIKAT KELULUSAN MAGANG / PKL</div>
            <div class="subtitle">No. Reg: {{ $certificate->certificate_number }}</div>

            <div class="divider">
                <div class="presented-to">Diberikan secara resmi kepada:</div>
                
                <div class="name">{{ $profile->user->name }}</div>
                <div class="institution">{{ $profile->institution }} — {{ $profile->major }}</div>
                
                <div class="description">
                    Telah menyelesaikan seluruh rangkaian Praktik Kerja Lapangan (PKL) / Magang di elc.my.id 
                    pada divisi <strong style="color: #2563eb;">{{ $profile->division ?? 'IT & Development' }}</strong>
                    dengan hasil akhir predikat:
                </div>

                <div class="predicate">
                    🏆 PREDIKAT: {{ strtoupper($certificate->predicate) }}
                </div>

                <div style="margin-top: 20px;">
                    <hr style="width: 150px; margin: 0 auto 10px auto; border: 0; border-top: 1px solid #cbd5e1;">
                    <div class="footer-date">
                        Diterbitkan Tanggal<br>
                        <strong style="color:#0f172a; font-size: 16px;">{{ $certificate->issue_date ? $certificate->issue_date->format('d F Y') : date('d F Y') }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="sign-title">Pimpinan / Direktur</div>
            @if(file_exists(public_path('gambar/aset/ttd_barcode.png')))
                <img src="{{ public_path('gambar/aset/ttd_barcode.png') }}" class="sign-barcode" alt="Tanda Tangan">
            @else
                <div style="height: 80px; margin-bottom: 5px;"></div>
            @endif
            <div class="sign-line"></div>
            <div class="sign-name">Zaky Afrizal</div>
        </div>
    </div>
</body>
</html>
