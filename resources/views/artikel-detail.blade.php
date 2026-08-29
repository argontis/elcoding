@php 
    $images = ['Magang-Online.webp', 'Skill-Lab.webp', 'Magang-Mahasiswa.webp'];
    $randomImg = $images[$artikel->id % 3];
    $bgImage = $artikel->image_path ? asset($artikel->image_path) : asset('assets/wp-content/uploads/2026/02/'.$randomImg);
    $excerpt = Str::limit(strip_tags($artikel->content ?? 'Blog informatif dari Elcoding.'), 150);
@endphp
<x-layout>
    <x-slot:title>{{ $artikel->title }}</x-slot>
    <x-slot:description>{{ $excerpt }}</x-slot>
    <x-slot:ogImage>{{ $bgImage }}</x-slot>
    
    @push('preload')
    <link rel="preload" as="image" href="{{ $bgImage }}">
    @endpush

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfcfc; }
        
        /* Hero Section */
        .ve-page-hero-sm {
            position: relative;
            padding: 100px 20px 80px 20px;
            background-size: cover;
            background-position: center;
            background-color: #1F2937;
            text-align: center;
            color: #ffffff;
        }
        .ve-page-hero-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(17, 24, 39, 0.7);
            z-index: 1;
        }
        .ve-page-hero-content {
            position: relative;
            z-index: 2;
            max-width: 900px;
            margin: 0 auto;
        }
        .ve-insight-cat-hero {
            display: inline-block;
            padding: 5px 15px;
            background-color: #4B6BF5;
            color: #ffffff;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .ve-page-hero-content h1 {
            font-size: 42px;
            font-weight: 800;
            line-height: 1.3;
            margin: 0 0 25px 0;
        }
        .ve-post-meta-hero {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            font-size: 15px;
            color: #e2e8f0;
            font-weight: 500;
        }
        .ve-post-meta-hero span i { margin-right: 6px; color: #4B6BF5; }
        
        /* Layout */
        .ve-section { padding: 80px 20px 100px 20px; }
        .ve-container { max-width: 1200px; margin: 0 auto; }
        .ve-row { display: flex; flex-wrap: wrap; margin: -15px; }
        .ve-main-col { width: 66.666667%; padding: 15px; }
        .ve-sidebar-col { width: 33.333333%; padding: 15px; }

        /* Article Content */
        .ve-article {
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 40px;
        }
        .ve-article-featured {
            width: 100%;
            height: 450px;
            background-size: cover;
            background-position: center;
        }
        .ve-article-body {
            padding: 40px;
            font-size: 17px;
            line-height: 1.8;
            color: #475569;
            word-wrap: break-word;
        }
        .ve-article-body h1, .ve-article-body h2, .ve-article-body h3, .ve-article-body h4 {
            color: #1a202c;
            font-weight: 700;
            margin: 35px 0 15px;
        }
        .ve-article-body p { margin-bottom: 20px; }
        .ve-article-body img { max-width: 100%; border-radius: 8px; margin: 25px 0; }
        .ve-article-body ul { list-style-type: disc; margin-left: 20px; margin-bottom: 25px; }
        .ve-article-body ol { list-style-type: decimal; margin-left: 20px; margin-bottom: 25px; }
        .ve-article-body li { margin-bottom: 10px; }
        .ve-article-body a { color: #4B6BF5; text-decoration: none; font-weight: 600; }
        .ve-article-body a:hover { text-decoration: underline; }
        
        .ve-blockquote {
            border-left: 4px solid #4B6BF5;
            padding: 20px 25px;
            background-color: #e5f3f3;
            margin: 35px 0;
            border-radius: 0 8px 8px 0;
            font-size: 20px;
            font-style: italic;
            color: #1a202c;
        }
        .ve-blockquote cite {
            display: block;
            font-size: 15px;
            font-style: normal;
            font-weight: 700;
            margin-top: 10px;
            color: #64748b;
        }

        .ve-article-share {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 50px;
            padding-top: 25px;
            border-top: 1px solid #f1f5f9;
        }
        .ve-article-share strong { color: #1a202c; font-size: 16px; margin-right: 5px; }
        .ve-article-share a {
            display: flex; justify-content: center; align-items: center;
            width: 38px; height: 38px; border-radius: 50%;
            background-color: #f1f5f9; color: #475569; transition: all 0.3s;
        }
        .ve-article-share a:hover {
            background-color: #4B6BF5; color: #fff; transform: translateY(-3px); text-decoration: none;
        }

        /* Sidebar Widgets (Identical to index) */
        .ve-sidebar-widget { background-color: #ffffff; border: 1px solid #e9ecef; border-radius: 8px; padding: 30px; margin-bottom: 30px; }
        .ve-sidebar-title { font-size: 18px; font-weight: 700; color: #1a202c; margin-bottom: 25px; position: relative; }
        .ve-sidebar-title::after { content: ''; position: absolute; left: 0; bottom: -10px; width: 30px; height: 2px; background-color: #4B6BF5; }
        .ve-search-box form { display: flex; border: 1px solid #e2e8f0; border-radius: 4px; overflow: hidden; }
        .ve-search-box input { flex-grow: 1; border: none; padding: 12px 15px; font-size: 14px; outline: none; }
        .ve-search-box button { background-color: #4B6BF5; color: #fff; border: none; padding: 0 20px; cursor: pointer; transition: 0.3s; }
        .ve-search-box button:hover { background-color: #3154f3; }
        .ve-cat-list { list-style: none; padding: 0; margin: 0; }
        .ve-cat-list li { margin-bottom: 12px; }
        .ve-cat-list li:last-child { margin-bottom: 0; }
        .ve-cat-list a { display: flex; justify-content: space-between; align-items: center; color: #475569; text-decoration: none; font-size: 14px; font-weight: 600; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; transition: 0.3s; }
        .ve-cat-list li:last-child a { border-bottom: none; padding-bottom: 0; }
        .ve-cat-list a:hover { color: #4B6BF5; }
        .ve-cat-list a span { background-color: #f8fafc; color: #64748b; font-size: 12px; padding: 2px 8px; border-radius: 20px; font-weight: 700; }
        .ve-recent-post { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; }
        .ve-recent-post:last-child { margin-bottom: 0; }
        .ve-rp-img { width: 70px; height: 70px; border-radius: 6px; background-size: cover; background-position: center; flex-shrink: 0; }
        .ve-rp-info a { display: block; color: #1a202c; font-size: 14px; font-weight: 700; line-height: 1.4; text-decoration: none; margin-bottom: 5px; transition: 0.3s; font-family: 'Plus Jakarta Sans', sans-serif;}
        .ve-rp-info a:hover { color: #4B6BF5; }
        .ve-rp-info span { color: #94a3b8; font-size: 12px; display: flex; align-items: center; gap: 5px; }

        @media(max-width: 991px) {
            .ve-main-col { width: 100%; }
            .ve-sidebar-col { width: 100%; margin-top: 40px; }
            .ve-page-hero-content h1 { font-size: 32px; }
            .ve-article-featured { height: 300px; }
            .ve-article-body { padding: 25px; }
        }
        @media(max-width: 575px) {
            .ve-post-meta-hero { flex-direction: column; gap: 10px; }
        }
    </style>

    <section class="ve-page-hero-sm" style="background-image:url('{{ $bgImage }}');">
        <div class="ve-page-hero-overlay"></div>
        <div class="ve-container ve-page-hero-content">
            <span class="ve-insight-cat-hero">{{ $artikel->category }}</span>
            <h1>{{ $artikel->title }}</h1>
            <div class="ve-post-meta-hero">
                <span><i class="far fa-calendar-alt"></i> {{ $artikel->published_at ? \Carbon\Carbon::parse($artikel->published_at)->format('F d, Y') : $artikel->created_at->format('F d, Y') }}</span>
                <span><i class="far fa-user"></i> {{ $artikel->author ?? 'Admin Elcoding' }}</span>
                <span><i class="far fa-clock"></i> 5 min read</span>
            </div>
        </div>
    </section>

    <section class="ve-section">
        <div class="ve-container">
            <div class="ve-row">
                <div class="ve-main-col">
                    <article class="ve-article">
                        <div class="ve-article-featured" style="background-image:url('{{ $bgImage }}');"></div>
                        <div class="ve-article-body">
                            @if($artikel->content)
                                {!! $artikel->content !!}
                            @else
                                <p>Belum ada konten untuk blog ini.</p>
                            @endif

                            <div class="ve-article-share">
                                <strong>Share:</strong>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" title="Bagikan ke Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($artikel->title) }}" target="_blank" title="Bagikan ke Twitter (X)"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" target="_blank" title="Bagikan ke LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($artikel->title . ' - ' . request()->fullUrl()) }}" target="_blank" title="Bagikan ke WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </article>
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
@push('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Article",
  "headline": "{{ $artikel->title }}",
  "image": [
    "{{ $bgImage }}"
  ],
  "datePublished": "{{ $artikel->published_at ? \Carbon\Carbon::parse($artikel->published_at)->toIso8601String() : $artikel->created_at->toIso8601String() }}",
  "dateModified": "{{ $artikel->updated_at->toIso8601String() }}",
  "author": [{
      "@@type": "Person",
      "name": "{{ $artikel->author->name ?? 'Admin Elcoding' }}"
  }],
  "publisher": {
    "@@type": "Organization",
    "name": "Elcoding Academy",
    "logo": {
      "@@type": "ImageObject",
      "url": "{{ asset('gambar/aset/logo.png') }}"
    }
  }
}
</script>
@endpush
</x-layout>
