<x-layout>
    <x-slot name="title">Produk & Layanan</x-slot>

    @push('preload')
    <link rel="preload" as="image" href="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1920&q=80">
    @endpush

    @push('styles')
    <link rel='stylesheet' id='elementor-post-11887-css' href='{{ asset("css/post-11887.css?v=3") }}' media='all' />
    <!-- Hero Section -->
    <section class="ve-page-hero" style="background-image:url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1920&q=80');">
        <div class="ve-page-hero-overlay"></div>
        <div class="container ve-page-hero-content">
            <span class="ve-section-tag">Elcoding Academy</span>
            <h1>Layanan <span>Kami</span></h1>
            <nav aria-label="breadcrumb">
                <ol class="ve-breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Layanan</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- 2. GRID PRODUK & LAYANAN -->
    <section class="service-content">
        <div class="container">
            <div class="service-grid">
                
                @forelse($layanans as $layanan)
                <!-- Card -->
                @php
                    $themes = ['theme-1', 'theme-2', 'theme-3'];
                    $theme = $themes[$loop->index % 3];
                    $bgClass = 'card-' . $theme;
                    $btnClass = 'btn-' . $theme;
                    $textClass = 'text-' . $theme;
                @endphp
                <div class="program-card {{ $bgClass }}" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="program-card-header" style="background-image: url('{{ $layanan->image_path ? asset($layanan->image_path) : 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80' }}');">
                        @php
                            $badgeText = strtolower(trim($layanan->badge));
                            $badgeClass = 'badge-special'; // Default color
                            $badgeIcon = 'fa-star'; // Default icon
                            
                            // Status Badges
                            if (str_contains($badgeText, 'terlaris') || str_contains($badgeText, 'populer')) { $badgeClass = 'badge-terlaris'; $badgeIcon = 'fa-fire'; }
                            elseif (str_contains($badgeText, 'unggulan') || str_contains($badgeText, 'recommended') || str_contains($badgeText, 'rekomendasi')) { $badgeClass = 'badge-unggulan'; $badgeIcon = 'fa-thumbs-up'; }
                            elseif (str_contains($badgeText, 'upcoming') || str_contains($badgeText, 'baru')) { $badgeClass = 'badge-upcoming'; $badgeIcon = 'fa-clock'; }
                            elseif (str_contains($badgeText, 'special') || str_contains($badgeText, 'promo') || str_contains($badgeText, 'diskon')) { $badgeClass = 'badge-special'; $badgeIcon = 'fa-gem'; }
                            
                            // Category Badges (Layanan & Programs)
                            elseif (str_contains($badgeText, 'website') || str_contains($badgeText, 'web')) { $badgeClass = 'badge-handson'; $badgeIcon = 'fa-globe'; }
                            elseif (str_contains($badgeText, 'hosting') || str_contains($badgeText, 'server')) { $badgeClass = 'badge-design'; $badgeIcon = 'fa-server'; }
                            elseif (str_contains($badgeText, 'perpustakaan') || str_contains($badgeText, 'digital')) { $badgeClass = 'badge-crash'; $badgeIcon = 'fa-book-reader'; }
                            elseif (str_contains($badgeText, 'aplikasi') || str_contains($badgeText, 'app')) { $badgeClass = 'badge-upcoming'; $badgeIcon = 'fa-mobile-alt'; }
                            elseif (str_contains($badgeText, 'sistem') || str_contains($badgeText, 'informasi')) { $badgeClass = 'badge-unggulan'; $badgeIcon = 'fa-cogs'; }
                            
                            // Fallbacks for specific course types
                            elseif (str_contains($badgeText, 'hands-on') || str_contains($badgeText, 'praktek')) { $badgeClass = 'badge-handson'; $badgeIcon = 'fa-laptop-code'; }
                            elseif (str_contains($badgeText, 'design') || str_contains($badgeText, 'desain')) { $badgeClass = 'badge-design'; $badgeIcon = 'fa-paint-brush'; }
                            elseif (str_contains($badgeText, 'crash') || str_contains($badgeText, 'kilat')) { $badgeClass = 'badge-crash'; $badgeIcon = 'fa-rocket'; }
                        @endphp
                        @if($layanan->badge)
                        <div class="program-badge {{ $badgeClass }}"><i class="fas {{ $badgeIcon }}"></i> {{ $layanan->badge }}</div>
                        @endif
                    </div>
                    <div class="program-card-body">
                        <div class="program-header-info">
                            <h2 class="program-title">{!! nl2br(e($layanan->title)) !!}</h2>
                            <span class="start-from {{ $textClass }}">{{ $layanan->price_label ?? 'Mulai Dari' }}</span>
                            <div class="price-value">{{ $layanan->price }} <span style="font-size: 14px; font-weight: normal; color: #64748b;">{{ $layanan->price_period }}</span></div>
                        </div>
                        
                        <div class="program-features-content">
                            <p style="color: #4B5563; font-size: 14px; line-height: 1.6; margin-top: 15px; text-align: center;">{{ $layanan->short_description }}</p>
                        </div>
                    </div>
                    <div class="program-card-footer">
                        <a href="{{ url('/layanan/detail/'.$layanan->slug) }}" class="program-btn {{ $btnClass }}">Lihat Detail</a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-slate-500 py-10">Belum ada layanan tersedia.</div>
                @endforelse

            </div>
        </div>
    </section>


    <!-- CSS STYLING MURNI (Mirip Websekolah) -->
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .text-center { text-align: center; }


        /* Grid Cards */
        .service-content {
            padding: 40px 0 80px;
        }
        .service-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }
        .program-card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            position: relative;
        }
        .program-card.card-theme-1 { background-color: #F4F7FE; }
        .program-card.card-theme-2 { background-color: #F4F7FE; }
        .program-card.card-theme-3 { background-color: #F4F7FE; }
        .program-card:hover { transform: translateY(-5px); }
        
        .program-card-header {
            background-size: cover;
            background-position: center;
            height: 180px;
            position: relative;
        }
        .program-badge {
            position: absolute;
            top: 15px; 
            left: 0;
            background: #8B5CF6;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 0 16px 16px 0;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
            z-index: 2;
            text-transform: uppercase;
        }
        .program-badge.badge-terlaris {
            background: #EF4444;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        }
        .program-badge.badge-unggulan, .program-badge.badge-recommended {
            background: #10B981;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }
        .program-badge.badge-upcoming {
            background: #F59E0B;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
        }
        .program-badge.badge-special {
            background: #EC4899;
            box-shadow: 0 4px 15px rgba(236, 72, 153, 0.4);
        }
        
        .program-badge.badge-handson { background: #3B82F6; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4); }
        .program-badge.badge-design { background: #6366F1; box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4); }
        .program-badge.badge-crash { background: #14B8A6; box-shadow: 0 4px 15px rgba(20, 184, 166, 0.4); }
        
        .program-header-info {
            text-align: center;
            margin-bottom: 30px;
        }
        .program-title {
            font-size: 18px !important;
            font-weight: 700;
            color: #4B5563;
            margin: 0 0 8px 0;
            line-height: 1.4;
        }
        .start-from {
            font-size: 16px;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }
        .start-from.text-theme-1 { color: #132252; }
        .start-from.text-theme-2 { color: #132252; }
        .start-from.text-theme-3 { color: #132252; }
        
        .price-value {
            font-size: 32px !important;
            font-weight: 800;
            color: #1F2937;
            line-height: 1;
        }

        .program-card-body {
            flex-grow: 1;
            padding: 30px 20px 0 20px;
        }
        
        .program-card-footer {
            padding: 30px 10px 0 10px;
            display: flex;
            justify-content: center;
        }
        .program-btn {
            display: inline-block;
            text-align: center;
            font-weight: 600;
            font-size: 15px;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            margin-bottom: 30px;
        }
        .program-btn.btn-theme-1 { background: #132252; color: #ffffff !important; }
        .program-btn.btn-theme-1:hover { background: #0c1638; transform: translateY(-2px); }
        .program-btn.btn-theme-2 { background: #132252; color: #ffffff !important; }
        .program-btn.btn-theme-2:hover { background: #0c1638; transform: translateY(-2px); }
        .program-btn.btn-theme-3 { background: #132252; color: #ffffff !important; }
        .program-btn.btn-theme-3:hover { background: #0c1638; transform: translateY(-2px); }


        /* Responsif Mobile & Tablet */
        @media (max-width: 1024px) {
            .service-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .page-title { font-size: 32px; }
            .service-grid { grid-template-columns: 1fr; }
            .service-card { padding: 20px; }
        }
    </style>
</x-layout>