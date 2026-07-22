<x-layout title="Artikel - Elcoding Academy">

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
                <h1 class="elementor-heading-title elementor-size-default">Artikel</h1>
            </div>
            <div class="elementor-element elementor-element-89b3de6 elementor-align-center elementor-widget elementor-widget-breadcrumbs" data-id="89b3de6" data-element_type="widget" data-e-type="widget" data-widget_type="breadcrumbs.default">
                <p id="breadcrumbs"><span><span><a href="{{ url('/') }}">Home</a></span> » <span class="breadcrumb_last" aria-current="page">Artikel</span></span></p>
            </div>
        </div>
    </div>
</div>

    <!-- Blog Grid Section -->
    <section class="blog-section">
        <div class="blog-container">
            
            <div class="blog-grid">
                @forelse($artikels as $artikel)
                <div class="blog-card">
                    @php 
                        $images = ['Magang-Online.webp', 'Skill-Lab.webp', 'Magang-Mahasiswa.webp'];
                        $randomImg = $images[$loop->index % 3];
                        $bgImage = $artikel->image_path ? asset($artikel->image_path) : asset('assets/wp-content/uploads/2026/02/'.$randomImg);
                    @endphp
                    <div class="blog-img" style="background-image: url('{{ $bgImage }}');"></div>
                    <div class="blog-content">
                        <span class="blog-category">{{ $artikel->category }}</span>
                        <h4><a href="#">{{ $artikel->title }}</a></h4>
                        <div class="blog-meta"><i class="fas fa-clock"></i> {{ $artikel->published_at ? \Carbon\Carbon::parse($artikel->published_at)->format('d M Y') : $artikel->created_at->format('d M Y') }}</div>
                        <p>{{ Str::limit(strip_tags($artikel->content ?? 'Artikel informatif dari Elcoding membahas berbagai topik seputar teknologi, pemrograman, dan dunia digital...'), 120) }}</p>
                        <a href="{{ url('/artikel/' . $artikel->id) }}" class="blog-btn">BACA ARTIKEL</a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-10" style="grid-column: span 3;">
                    <p class="text-gray-500">Belum ada artikel.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($artikels->hasPages())
            <nav class="custom-pagination" aria-label="Pagination">
                {{ $artikels->links() }}
            </nav>
            @endif

        </div>
    </section>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfcfc; }
        /* Blog Section */
        .blog-section { padding: 60px 20px 100px 20px; }
        .blog-container { max-width: 1200px; margin: 0 auto; }
        .blog-grid { 
            display: grid; 
            grid-template-columns: repeat(3, 1fr); 
            gap: 30px; 
            margin-bottom: 50px;
        }
        .blog-card { 
            display: flex; 
            flex-direction: column; 
            background: #fff; 
            border: 1px solid #f0f0f0; 
            border-radius: 20px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.02); 
            overflow: hidden; 
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
        }
        .blog-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 10px 20px rgba(0,0,0,0.05); 
        }
        .blog-img { 
            width: 100%; 
            height: 220px; 
            background-size: cover; 
            background-position: center; 
            border-bottom: 1px solid #f0f0f0; 
        }
        .blog-content { 
            padding: 30px; 
            display: flex; 
            flex-direction: column; 
            flex-grow: 1; 
        }
        .blog-category {
            display: inline-block;
            align-self: flex-start;
            background: #e5f3f3;
            color: #2563EB;
            font-size: 12px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 50px;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        .blog-content h4 { 
            font-size: 20px; 
            font-weight: 700; 
            line-height: 1.4; 
            margin: 0 0 15px 0; 
        }
        .blog-content h4 a { 
            color: #1F2937; 
            text-decoration: none; 
            transition: color 0.3s ease; 
        }
        .blog-content h4 a:hover { color: #2563EB; }
        .blog-meta { 
            font-size: 13px; 
            color: #000000; 
            margin-bottom: 15px; 
            display: flex; 
            align-items: center; 
            gap: 8px; 
            font-weight: 500; 
        }
        .blog-content p { 
            font-size: 14px; 
            color: #666; 
            line-height: 1.6; 
            margin: 0 0 25px 0; 
            flex-grow: 1; 
        }
        .blog-btn { 
            display: inline-block; 
            align-self: flex-start; 
            background: #2563EB; 
            color: #fff !important; 
            font-size: 13px; 
            font-weight: 600; 
            text-transform: uppercase; 
            text-decoration: none; 
            padding: 12px 25px; 
            border-radius: 50px; 
            transition: all 0.3s ease; 
        }
        .blog-btn:hover { 
            background: #056a6b; 
        }


        /* Responsive */
        @media (max-width: 992px) { 
            .blog-grid { grid-template-columns: repeat(2, 1fr); } 
        }
        @media (max-width: 768px) { 
            .blog-grid { grid-template-columns: 1fr; } 
            .page-title { font-size: 32px; }
        }
    </style>

</x-layout>
