<x-layout title="Blog - Elcoding Academy">
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
            <h1>Blog & <span>Artikel</span></h1>
            <nav aria-label="breadcrumb">
                <ol class="ve-breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Blog</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Blog Layout Section -->
    <section class="ve-section">
        <div class="ve-container">
            <div class="ve-row">
                <!-- Main Content (Blog Posts) -->
                <div class="ve-main-col">
                    <div class="ve-blog-grid">
                        @forelse($artikels as $artikel)
                        <div class="ve-insight-card">
                            @php 
                                $images = ['Magang-Online.webp', 'Skill-Lab.webp', 'Magang-Mahasiswa.webp'];
                                $randomImg = $images[$artikel->id % 3];
                                $bgImage = $artikel->image_path ? asset($artikel->image_path) : asset('assets/wp-content/uploads/2026/02/'.$randomImg);
                            @endphp
                            <div class="ve-insight-img" style="background-image:url('{{ $bgImage }}');"></div>
                            <div class="ve-insight-body">
                                <span class="ve-insight-cat">{{ $artikel->category }}</span>
                                <h5><a href="{{ url('/blog/' . $artikel->id) }}">{{ $artikel->title }}</a></h5>
                                <p>{{ Str::limit(strip_tags($artikel->content ?? 'Blog informatif dari Elcoding membahas berbagai topik seputar teknologi, pemrograman, dan dunia digital...'), 120) }}</p>
                                <div class="ve-insight-meta">
                                    <span><i class="far fa-calendar-alt"></i> {{ $artikel->published_at ? \Carbon\Carbon::parse($artikel->published_at)->format('F d') : $artikel->created_at->format('F d') }}</span>
                                    <a href="{{ url('/blog/' . $artikel->id) }}" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div style="grid-column: span 2; text-align: center; padding: 40px 0;">
                            <p class="text-gray-500">Belum ada blog yang ditemukan.</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($artikels->hasPages())
                    <div class="ve-pagination">
                        {{ $artikels->links() }}
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="ve-sidebar-col">
                    <div class="ve-sidebar">
                        <div class="ve-sidebar-widget">
                            <h5 class="ve-sidebar-title">Search</h5>
                            <div class="ve-search-box">
                                <form action="{{ url('/blog') }}" method="GET">
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search articles...">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="ve-sidebar-widget">
                            <h5 class="ve-sidebar-title">Categories</h5>
                            <ul class="ve-cat-list">
                                @foreach($categories as $cat)
                                <li>
                                    <a href="{{ url('/blog?search=' . urlencode($cat->category)) }}">{{ $cat->category }} <span>{{ $cat->count }}</span></a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="ve-sidebar-widget">
                            <h5 class="ve-sidebar-title">Recent Posts</h5>
                            @foreach($recentPosts as $rp)
                            @php 
                                $imagesRp = ['Magang-Online.webp', 'Skill-Lab.webp', 'Magang-Mahasiswa.webp'];
                                $randomImgRp = $imagesRp[$rp->id % 3];
                                $bgImageRp = $rp->image_path ? asset($rp->image_path) : asset('assets/wp-content/uploads/2026/02/'.$randomImgRp);
                            @endphp
                            <div class="ve-recent-post">
                                <div class="ve-rp-img" style="background-image:url('{{ $bgImageRp }}');"></div>
                                <div class="ve-rp-info">
                                    <a href="{{ url('/blog/' . $rp->id) }}">{{ Str::limit($rp->title, 45) }}</a>
                                    <span><i class="far fa-calendar-alt"></i> {{ $rp->published_at ? \Carbon\Carbon::parse($rp->published_at)->format('F d') : $rp->created_at->format('F d') }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfcfc; }
        
        .ve-section { padding: 80px 20px 100px 20px; }
        .ve-container { max-width: 1200px; margin: 0 auto; }
        .ve-row { display: flex; flex-wrap: wrap; margin: -15px; }
        .ve-main-col { width: 66.666667%; padding: 15px; }
        .ve-sidebar-col { width: 33.333333%; padding: 15px; }
        
        /* Blog Grid */
        .ve-blog-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 50px;
        }
        
        /* Cards */
        .ve-insight-card {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e9ecef;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: all 0.3s;
        }
        .ve-insight-card:hover {
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        .ve-insight-img {
            height: 220px;
            width: 100%;
            background-size: cover;
            background-position: center;
        }
        .ve-insight-body {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .ve-insight-cat {
            display: inline-block;
            align-self: flex-start;
            padding: 5px 12px;
            background-color: #e5f3f3;
            color: #4B6BF5;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .ve-insight-body h5 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.4;
        }
        .ve-insight-body h5 a {
            color: #1a202c;
            text-decoration: none;
            transition: 0.3s;
        }
        .ve-insight-body h5 a:hover {
            color: #4B6BF5;
        }
        .ve-insight-body p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 25px;
            flex-grow: 1;
        }
        .ve-insight-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #f1f5f9;
            padding-top: 15px;
            margin-top: auto;
        }
        .ve-insight-meta span {
            color: #94a3b8;
            font-size: 13px;
        }
        .ve-insight-meta span i {
            margin-right: 5px;
        }
        .ve-insight-meta .read-more {
            color: #4B6BF5;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .ve-insight-meta .read-more:hover {
            color: #3154f3;
        }

        /* Sidebar Widgets */
        .ve-sidebar-widget {
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
        }
        .ve-sidebar-title {
            font-size: 18px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 25px;
            position: relative;
        }
        .ve-sidebar-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            width: 30px;
            height: 2px;
            background-color: #4B6BF5;
        }

        /* Search */
        .ve-search-box form {
            display: flex;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
        }
        .ve-search-box input {
            flex-grow: 1;
            border: none;
            padding: 12px 15px;
            font-size: 14px;
            outline: none;
        }
        .ve-search-box button {
            background-color: #4B6BF5;
            color: #fff;
            border: none;
            padding: 0 20px;
            cursor: pointer;
            transition: 0.3s;
        }
        .ve-search-box button:hover {
            background-color: #3154f3;
        }

        /* Categories */
        .ve-cat-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .ve-cat-list li {
            margin-bottom: 12px;
        }
        .ve-cat-list li:last-child {
            margin-bottom: 0;
        }
        .ve-cat-list a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #475569;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
            transition: 0.3s;
        }
        .ve-cat-list li:last-child a {
            border-bottom: none;
            padding-bottom: 0;
        }
        .ve-cat-list a:hover {
            color: #4B6BF5;
        }
        .ve-cat-list a span {
            background-color: #f8fafc;
            color: #64748b;
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 20px;
            font-weight: 700;
        }

        /* Recent Posts */
        .ve-recent-post {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        .ve-recent-post:last-child {
            margin-bottom: 0;
        }
        .ve-rp-img {
            width: 70px;
            height: 70px;
            border-radius: 6px;
            background-size: cover;
            background-position: center;
            flex-shrink: 0;
        }
        .ve-rp-info a {
            display: block;
            color: #1a202c;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.4;
            text-decoration: none;
            margin-bottom: 5px;
            transition: 0.3s;
        }
        .ve-rp-info a:hover {
            color: #4B6BF5;
        }
        .ve-rp-info span {
            color: #94a3b8;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .ve-main-col { width: 100%; }
            .ve-sidebar-col { width: 100%; margin-top: 40px; }
        }
        @media (max-width: 767px) {
            .ve-blog-grid { grid-template-columns: 1fr; }
        }
    </style>

@push('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Blog",
  "name": "Blog - Elcoding Academy",
  "url": "{{ url('/blog') }}",
  "description": "Kumpulan blog edukatif seputar dunia programming, teknologi, dan tips karir IT.",
  "publisher": {
    "@@type": "Organization",
    "name": "Elcoding Academy",
    "logo": {
      "@@type": "ImageObject",
      "url": "{{ asset('gambar/aset/logo-elcoding.png') }}"
    }
  }
}
</script>
@endpush
</x-layout>
