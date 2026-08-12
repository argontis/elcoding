<x-layout title="Program Kursus - Elcoding Academy">
@push('preload')
<link rel="preload" as="image" href="{{ asset('gambar/aset/Untitled-1.png') }}">
@endpush

    @push('styles')
    <link rel='stylesheet' id='elementor-post-11887-css' href='{{ asset("css/post-11887.css") }}' media='all' />
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
            color: #7C3AED;
        }
        .custom-pagination .page-numbers.current {
            color: #7C3AED;
        }
        .custom-pagination .dots {
            color: #4B5563;
        }
        .custom-pagination .elementor-screen-only {
            display: none;
        }
    </style>
    <style>
        /* Fix Hero Background Image */
        .elementor-element-691d17c::before {
            background-image: url('{{ asset("gambar/aset/Untitled-1.png") }}') !important;
            background-position: center center !important;
            background-size: cover !important;
            content: "" !important;
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            z-index: 0 !important;
        }
        .elementor-element-691d17c > .e-con-inner {
            position: relative;
            z-index: 1;
        }
    </style>
@endpush

<!-- Hero Section -->
<div class="elementor elementor-11887">
    <div class="elementor-element elementor-element-691d17c hide-hero-if e-flex e-con-boxed e-con e-parent" data-id="691d17c" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
        <div class="e-con-inner">
            <div class="elementor-element elementor-element-0b653e6 elementor-widget elementor-widget-heading" data-id="0b653e6" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
                <h1 class="elementor-heading-title elementor-size-default">Program Kursus</h1>
            </div>
            <div class="elementor-element elementor-element-89b3de6 elementor-align-center elementor-widget elementor-widget-breadcrumbs" data-id="89b3de6" data-element_type="widget" data-e-type="widget" data-widget_type="breadcrumbs.default">
                <p id="breadcrumbs"><span><span><a href="{{ url('/') }}">Home</a></span> » <span class="breadcrumb_last" aria-current="page">Program Kursus</span></span></p>
            </div>
        </div>
    </div>
</div>

    <!-- Programs Grid Section -->
    <section class="programs-section">
        <div class="programs-container">
            
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
                        @if($program->badge && $program->badge != 'Reguler')
                        <div class="program-badge {{ strtolower($program->badge) == 'terlaris' ? 'terlaris' : '' }}"><i class="fas {{ strtolower($program->badge) == 'terlaris' ? 'fa-fire' : 'fa-star' }}"></i> {{ $program->badge }}</div>
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
        .program-badge.terlaris {
            background: #EF4444;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        }
        
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
