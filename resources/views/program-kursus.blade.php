<x-layout title="Program Kursus - Elcoding Academy">
@push('preload')
<link rel="preload" as="image" href="{{ asset('gambar/aset/Untitled-1.png') }}">
@endpush

    @push('styles')
    <link rel='stylesheet' id='elementor-post-11887-css' href='{{ asset("css/post-11887.css?v=3") }}' media='all' />
    <style>
        .custom-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 40px 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .custom-pagination .page-numbers {
            font-size: 16px;
            font-weight: 500;
            color: #4B5563;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .custom-pagination .page-numbers:hover {
            color: #4B6BF5;
        }
        .custom-pagination .page-numbers.current {
            color: #4B6BF5;
        }
        .custom-pagination .dots {
            color: #4B5563;
        }
        .custom-pagination .elementor-screen-only {
            display: none;
        }
    </style>
    @endpush
    <!-- Hero Section -->
    <section class="ve-page-hero" style="background-image:url('{{ asset('gambar/aset/Untitled-1.png') }}');">
        <div class="ve-page-hero-overlay"></div>
        <div class="container ve-page-hero-content">
            <span class="ve-section-tag">Elcoding Academy</span>
            <h1>Program <span>Kursus</span></h1>
            <nav aria-label="breadcrumb">
                <ol class="ve-breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Program Kursus</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Programs Grid Section -->
    <section class="programs-section">
        <div class="programs-container">
            
            <!-- Navigation Filter Tabs -->
            <x-filter-bar active="program-kursus" />
            <div class="programs-grid">
                
                @forelse($programs as $program)
                @php
                    $theme = $program->theme_color ?? 'theme-1';
                    $bgClass = 'card-' . $theme;
                    $btnClass = 'btn-' . $theme;
                    $textClass = 'text-' . $theme;
                @endphp
                <div class="program-card {{ $bgClass }}">
                    <div class="program-card-header" style="background-image: url('{{ $program->image_path ? asset(str_replace(' ', '%20', $program->image_path)) : asset('gambar/aset/ilustrasi-belajar.jpg') }}');">
                        @php
                            $badgeText = strtolower(trim($program->badge));
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
                        @if($program->badge && $program->badge != 'Reguler')
                        <div class="program-badge {{ $badgeClass }}"><i class="fas {{ $badgeIcon }}"></i> {{ $program->badge }}</div>
                        @endif
                    </div>
                    <div class="program-card-body">
                        <div class="program-header-info">
                            <h2 class="program-title">{!! nl2br(e($program->title)) !!}</h2>
                            <span class="start-from {{ $textClass }}">Start From</span>
                            <div class="price-value">{{ $program->price }}</div>
                        </div>
                        
                        <div class="program-features-content">
                            @if($program->features)
                                {!! $program->features !!}
                            @else
                                <ul>
                                    <li>Materi <strong>Sesuai Kurikulum Industri</strong></li>
                                    <li>Pembelajaran <strong>Project Based</strong></li>
                                    <li>Didampingi <strong>Mentor Expert</strong></li>
                                    <li>Mendapat <strong>Sertifikat Kompetensi</strong></li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="program-card-footer">
                        <a href="{{ url('/program-kursus/' . $program->id) }}" class="program-btn {{ $btnClass }}">Lihat Detail</a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-10">
                    <p class="text-gray-500">Belum ada program kursus.</p>
                </div>
                @endforelse

            </div>
            
            <!-- Pagination -->
            @if($programs->hasPages())
            <nav class="custom-pagination" aria-label="Pagination">
                {{ $programs->links() }}
            </nav>
            @endif

        </div>
    </section>

    <!-- Custom CSS -->
    <style>
        /* General */
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fcfc; }
        /* Programs Grid */
        .programs-section {
            padding: 60px 20px 100px 20px;
            background-color: #f8fafc;
        }
        .programs-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .programs-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            margin-bottom: 60px;
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
        .program-card.card-theme-1 {
            background-color: #FAF6F0;
        }
        .program-card.card-theme-2 {
            background-color: #F4F7FE;
        }
        .program-card.card-theme-3 {
            background-color: #F0FAFA;
        }
        .program-card:hover {
            transform: translateY(-5px);
        }
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
        .start-from.text-theme-1 { color: #D2A882; }
        .start-from.text-theme-2 { color: #132252; }
        .start-from.text-theme-3 { color: #1D667F; }
        
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
        
        .program-features-content { word-wrap: break-word; overflow-wrap: break-word; word-break: break-word; }
        .program-features-content ul, .program-features-content ol { list-style: none; padding: 0; margin: 0; }
        .program-features-content p, .program-features-content ul li { 
            font-size: 14px; 
            color: #4B5563; 
            padding: 12px 0; 
            margin: 0;
            display: flex; 
            align-items: center; 
            gap: 12px; 
            line-height: 1.4;
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }
        .program-features-content ul li:last-child {
            border-bottom: none;
        }
        .program-features-content p::before, .program-features-content ul li::before { 
            content: "\f058"; 
            font-family: "Font Awesome 6 Free"; 
            font-weight: 400; 
            color: #4B5563; 
            font-size: 18px; 
            min-width: 18px;
        }
        .program-features-content p br { display: none; }
        .program-features-content strong { color: #1F2937; font-weight: 600; }
        
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
        }
        .program-btn.btn-theme-1 { background: #D2A882; color: #ffffff !important; }
        .program-btn.btn-theme-1:hover { background: #b89270; transform: translateY(-2px); }
        .program-btn.btn-theme-2 { background: #132252; color: #ffffff !important; }
        .program-btn.btn-theme-2:hover { background: #0c1638; transform: translateY(-2px); }
        .program-btn.btn-theme-3 { background: #1D667F; color: #ffffff !important; }
        .program-btn.btn-theme-3:hover { background: #14495c; transform: translateY(-2px); }

        /* Responsive */
        @media (max-width: 1024px) {
            .programs-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .programs-hero-title { font-size: 28px; }
            .programs-grid { grid-template-columns: 1fr; }
            .programs-section { padding: 48px 16px 64px 16px; }
        }
    </style>

@push('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "ItemList",
  "itemListElement": [
    @foreach($programs as $index => $program)
    {
      "@@type": "ListItem",
      "position": {{ $index + 1 }},
      "item": {
        "@@type": "Course",
        "url": "{{ url('/program-kursus') }}",
        "name": "{{ $program->title }}",
        "description": "Program Bootcamp intensif dengan durasi {{ $program->duration }}",
        "provider": {
          "@@type": "Organization",
          "name": "Elcoding Academy",
          "sameAs": "{{ url('/') }}"
        }
      }
    }{{ !$loop->last ? ',' : '' }}
    @endforeach
  ]
}
</script>
@endpush
</x-layout>
