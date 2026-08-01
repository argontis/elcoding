<x-layout title="Program Kursus - Elcoding Academy">

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
                <div class="program-card">
                    <div class="program-card-header" style="background-image: url('{{ $program->image_path ? asset(str_replace(' ', '%20', $program->image_path)) : asset('gambar/aset/ilustrasi-belajar.jpg') }}');">
                        @if($program->badge && $program->badge != 'Reguler')
                        <div class="program-badge {{ strtolower($program->badge) == 'terlaris' ? 'terlaris' : '' }}"><i class="fas {{ strtolower($program->badge) == 'terlaris' ? 'fa-fire' : 'fa-star' }}"></i> {{ $program->badge }}</div>
                        @endif
                    </div>
                    <div class="program-card-body">
                        <h2 class="program-title">{!! nl2br(e($program->title)) !!}</h2>
                        <ul class="program-features">
                            <li><i class="fas fa-check-circle" style="color: #2563EB;"></i> <span>Durasi belajar <strong>{{ $program->duration }}</strong></span></li>
                        </ul>
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
                        <div class="program-price-wrap">
                            <div class="price-value">{{ $program->price }}</div>
                        </div>
                        <a href="https://wa.me/6281476652656?text=Halo%20Admin%20Elcoding,%20saya%20tertarik%20dan%20ingin%20berkonsultasi%20mengenai%20program%20kursus%20{{ rawurlencode($program->title) }}.%20Mohon%20informasi%20lebih%20lanjut." target="_blank" class="program-btn">Konsultasi Sekarang <i class="fas fa-arrow-right" style="margin-left: 8px; font-size: 14px;"></i></a>
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
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }
        .program-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }
        .program-card-header {
            background-image: url('{{ asset("gambar/aset/ilustrasi-belajar.jpg") }}');
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
        .program-title {
            font-size: 22px !important;
            font-weight: 700;
            color: #1F2937;
            margin: 0 0 16px 0;
            line-height: 1.4;
        }
        .program-card-body {
            padding: 30px;
            flex-grow: 1;
        }
        .program-features {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .program-features li {
            font-size: 15px;
            color: #4B5563;
            margin-bottom: 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            line-height: 1.5;
        }
        .program-features li i {
            color: #2563EB;
            font-size: 20px;
            margin-top: 2px;
        }
        .program-features li span {
            flex: 1;
        }
        .program-features li strong {
            color: #1F2937;
        }
        
        .program-features-content { margin-top: 16px; word-wrap: break-word; overflow-wrap: break-word; word-break: break-word; }
        .program-features-content p { font-size: 15px; color: #4B5563; margin-bottom: 16px; display: flex; align-items: flex-start; gap: 12px; line-height: 1.5; }
        .program-features-content p::before { content: "\f058"; font-family: "Font Awesome 6 Free"; font-weight: 900; color: #2563EB; font-size: 20px; margin-top: 2px; }
        .program-features-content p br { display: none; }
        .program-features-content ul { list-style: none; padding: 0; margin: 0; }
        .program-features-content ul li { font-size: 15px; color: #4B5563; margin-bottom: 16px; display: flex; align-items: flex-start; gap: 12px; line-height: 1.5; }
        .program-features-content ul li::before { content: "\f058"; font-family: "Font Awesome 6 Free"; font-weight: 900; color: #2563EB; font-size: 20px; margin-top: 2px; }
        .program-features-content ol { list-style: decimal; padding-left: 20px; margin-bottom: 16px; }
        .program-features-content ol li { font-size: 15px; color: #4B5563; margin-bottom: 8px; }
        .program-features-content strong { color: #1F2937; }
        .program-card-footer {
            padding: 0 30px 30px 30px;
        }
        .program-price-wrap {
            margin-bottom: 20px;
            text-align: left;
        }
        .price-label {
            display: block;
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 4px;
        }
        .price-value {
            font-size: 24px !important;
            font-weight: 800;
            color: #2563EB;
            line-height: 1;
        }
        .program-btn {
            display: block;
            text-align: center;
            background: #2563EB;
            color: #ffffff !important;
            font-weight: 700;
            font-size: 16px;
            padding: 14px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
        }
        .program-btn:hover {
            background: #1E40AF;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .programs-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .programs-hero-title { font-size: 32px; }
            .programs-grid { grid-template-columns: 1fr; }
        }
    </style>

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "itemListElement": [
    @foreach($programs as $index => $program)
    {
      "@type": "ListItem",
      "position": {{ $index + 1 }},
      "item": {
        "@type": "Course",
        "url": "{{ url('/program-kursus') }}",
        "name": "{{ $program->title }}",
        "description": "Program Bootcamp intensif dengan durasi {{ $program->duration }}",
        "provider": {
          "@type": "Organization",
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
