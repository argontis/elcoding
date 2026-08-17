<x-layout>
    <x-slot:title>Detail Portofolio - Elcoding Academy</x-slot>

    <style>
        .portfolio-header { background: #1F2937; color: #fff; padding: 80px 20px 100px; text-align: center; }
        .portfolio-title { font-size: 48px; font-weight: 800; margin: 0 0 15px; }
        .portfolio-subtitle { font-size: 20px; color: #9CA3AF; font-weight: 400; max-width: 700px; margin: 0 auto; }
        
        .portfolio-container { max-width: 1200px; margin: -60px auto 80px; padding: 0 20px; position: relative; z-index: 10; }
        .portfolio-main-img { width: 100%; height: 600px; object-fit: cover; border-radius: 24px; box-shadow: 0 25px 50px rgba(0,0,0,0.15); margin-bottom: 60px; background: #e2e8f0; }

        .portfolio-content-grid { display: grid; grid-template-columns: 1fr 350px; gap: 60px; }
        
        .portfolio-desc { flex-grow: 1; word-wrap: break-word; overflow-wrap: break-word; word-break: break-word; }
        .portfolio-desc h2 { font-size: 24px; font-weight: 700; color: #1F2937; margin-bottom: 20px; }
        .portfolio-desc p { color: #4B5563; line-height: 1.8; margin-bottom: 15px; }
        .portfolio-desc ul { list-style-type: disc; margin-left: 20px; margin-bottom: 15px; color: #4B5563; line-height: 1.8; }
        .portfolio-desc ol { list-style-type: decimal; margin-left: 20px; margin-bottom: 15px; color: #4B5563; line-height: 1.8; }
        .portfolio-desc li { margin-bottom: 8px; }
        .portfolio-desc strong { font-weight: 700; color: #1F2937; }
        .portfolio-desc a { color: #20689b; text-decoration: underline; }

        .portfolio-sidebar { background: #f8fafc; border-radius: 20px; padding: 40px 30px; border: 1px solid #e2e8f0; height: fit-content; }
        .portfolio-sidebar-item { margin-bottom: 30px; }
        .portfolio-sidebar-item:last-child { margin-bottom: 0; }
        .portfolio-sidebar-label { font-size: 14px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 8px; display: block; }
        .portfolio-sidebar-value { font-size: 18px; font-weight: 600; color: #1F2937; }
        
        .tech-stack { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
        .tech-badge { background: #E0E7FF; color: #4338CA; font-size: 14px; font-weight: 600; padding: 6px 15px; border-radius: 50px; }

        .portfolio-gallery { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-top: 50px; }
        .portfolio-gallery img { width: 100%; height: 350px; object-fit: cover; border-radius: 16px; transition: transform 0.3s ease; cursor: pointer; }
        .portfolio-gallery img:hover { transform: scale(1.02); }

        @media(max-width: 1024px) {
            .portfolio-content-grid { grid-template-columns: 1fr; gap: 40px; }
        }
        @media(max-width: 768px) {
            .portfolio-title { font-size: 36px; }
            .portfolio-main-img { height: 350px; }
            .portfolio-gallery { grid-template-columns: 1fr; }
            .portfolio-gallery img { height: 250px; }
        }
    </style>

    <div class="portfolio-header">
        <h1 class="portfolio-title">{{ $portofolio->title }}</h1>
        <p class="portfolio-subtitle">{{ $portofolio->category }}</p>
    </div>

    <div class="portfolio-container">
        <img src="{{ asset($portofolio->image_path ?? 'gambar/portofolio/Film-Islami-Kemenag.webp') }}" alt="{{ $portofolio->title }}" class="portfolio-main-img">
        
        <div class="portfolio-content-grid">
            <div class="portfolio-desc">
                <h2>Deskripsi Proyek</h2>
                @if($portofolio->content)
                    {!! $portofolio->content !!}
                @else
                    <p>Deskripsi proyek belum tersedia.</p>
                @endif
            </div>

            <div class="portfolio-sidebar">
                <div class="portfolio-sidebar-item">
                    <span class="portfolio-sidebar-label">Klien / Pemilik</span>
                    <span class="portfolio-sidebar-value">{{ $portofolio->client ?? '-' }}</span>
                </div>
                <div class="portfolio-sidebar-item">
                    <span class="portfolio-sidebar-label">Kategori</span>
                    <span class="portfolio-sidebar-value">{{ $portofolio->category }}</span>
                </div>
                <div class="portfolio-sidebar-item">
                    <span class="portfolio-sidebar-label">Tanggal Proyek</span>
                    <span class="portfolio-sidebar-value">{{ $portofolio->date ? \Carbon\Carbon::parse($portofolio->date)->format('d F Y') : '-' }}</span>
                </div>
                <div class="portfolio-sidebar-item">
                    <span class="portfolio-sidebar-label">Tahun</span>
                    <span class="portfolio-sidebar-value">{{ $portofolio->date ? \Carbon\Carbon::parse($portofolio->date)->format('Y') : $portofolio->created_at->format('Y') }}</span>
                </div>
                
                <div class="portfolio-sidebar-item" style="margin-top: 40px;">
                    <a href="https://wa.me/6281476652656?text=Halo%20Admin%20Elcoding,%20saya%20tertarik%20dengan%20proyek%20{{ urlencode($portofolio->title) }}%20dan%20ingin%20berkonsultasi%20untuk%20pembuatan%20proyek%20serupa." style="display: block; text-align: center; background: #20689b; color: #fff; padding: 15px; border-radius: 12px; font-weight: 700; text-decoration: none; transition: all 0.3s ease;">Konsultasi Proyek <i class="fab fa-whatsapp" style="margin-left: 8px;"></i></a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
