@php 
    $images = ['Magang-Online.webp', 'Skill-Lab.webp', 'Magang-Mahasiswa.webp'];
    $randomImg = $images[$artikel->id % 3];
    $bgImage = $artikel->image_path ? asset($artikel->image_path) : asset('assets/wp-content/uploads/2026/02/'.$randomImg);
    $excerpt = Str::limit(strip_tags($artikel->content ?? 'Artikel informatif dari Elcoding.'), 150);
@endphp
<x-layout>
    <x-slot:title>{{ $artikel->title }}</x-slot>
    <x-slot:description>{{ $excerpt }}</x-slot>
    <x-slot:ogImage>{{ $bgImage }}</x-slot>
    
    @push('preload')
    <link rel="preload" as="image" href="{{ $bgImage }}">
    @endpush

    <style>
        .article-hero { position: relative; padding: 80px 20px 100px 20px; text-align: center; background: #1F2937; color: #fff; }
        .article-hero > * { position: relative; z-index: 1; }
        .article-category { display: inline-block; background: rgba(255, 255, 255, 0.1); color: #A78BFA; font-size: 13px; font-weight: 700; text-transform: uppercase; padding: 6px 15px; border-radius: 50px; margin-bottom: 20px; border: 1px solid rgba(255, 255, 255, 0.2); }
        .article-title { font-size: 42px; font-weight: 800; line-height: 1.3; max-width: 900px; margin: 0 auto 20px; }
        .article-meta { color: #9CA3AF; font-size: 15px; display: flex; justify-content: center; gap: 20px; align-items: center; }
        .article-meta span { display: flex; align-items: center; gap: 8px; }
        
        .article-container { max-width: 900px; margin: -50px auto 80px; padding: 0 20px; position: relative; z-index: 10; }
        .article-featured-image { width: 100%; height: 500px; object-fit: cover; border-radius: 24px; box-shadow: 0 20px 40px rgba(0,0,0,0.08); margin-bottom: 50px; background-color: #e2e8f0; }
        
        .article-content { font-size: 18px; line-height: 1.8; color: #334155; word-wrap: break-word; overflow-wrap: break-word; word-break: break-word; }
        .article-content h1 { font-size: 32px; font-weight: 800; color: #1F2937; margin: 40px 0 20px; }
        .article-content h2 { font-size: 28px; font-weight: 700; color: #1F2937; margin: 40px 0 20px; }
        .article-content h3 { font-size: 24px; font-weight: 600; color: #1F2937; margin: 30px 0 15px; }
        .article-content p { margin-bottom: 25px; }
        .article-content img { width: 100%; border-radius: 16px; margin: 30px 0; }
        .article-content blockquote { border-left: 5px solid #20689b; padding: 20px 30px; background: #f8fafc; font-style: italic; font-size: 20px; color: #1F2937; border-radius: 0 16px 16px 0; margin: 40px 0; }
        .article-content ul { list-style-type: disc; margin-left: 20px; margin-bottom: 25px; }
        .article-content ol { list-style-type: decimal; margin-left: 20px; margin-bottom: 25px; }
        .article-content li { margin-bottom: 10px; }
        .article-content a { color: #20689b; text-decoration: underline; }
        .article-content strong { font-weight: 700; }
        
        .article-share { display: flex; align-items: center; gap: 15px; margin-top: 60px; padding-top: 30px; border-top: 1px solid #e2e8f0; }
        .article-share-title { font-weight: 700; color: #1F2937; }
        .article-share a { display: inline-flex; justify-content: center; align-items: center; width: 40px; height: 40px; border-radius: 50%; background: #f1f5f9; color: #64748b; text-decoration: none; transition: all 0.3s; }
        .article-share a:hover { background: #20689b; color: #fff; transform: translateY(-3px); }

        @media(max-width: 768px) {
            .article-title { font-size: 32px; }
            .article-featured-image { height: 300px; }
            .article-content { font-size: 16px; }
        }
    </style>

    <div class="article-hero">
        <div class="article-category">{{ $artikel->category }}</div>
        <h1 class="article-title">{{ $artikel->title }}</h1>
        <div class="article-meta">
            <span><i class="far fa-calendar"></i> {{ $artikel->published_at ? \Carbon\Carbon::parse($artikel->published_at)->format('d F Y') : $artikel->created_at->format('d F Y') }}</span>
        </div>
    </div>

    <div class="article-container">
        <img src="{{ $bgImage }}" alt="{{ $artikel->title }}" class="article-featured-image">
        
        <div class="article-content">
            @if($artikel->content)
                {!! $artikel->content !!}
            @else
                <p>Belum ada konten untuk artikel ini.</p>
            @endif
        </div>

        <div class="article-share">
            <span class="article-share-title">Bagikan Artikel Ini:</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" title="Bagikan ke Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($artikel->title) }}" target="_blank" title="Bagikan ke Twitter (X)"><i class="fab fa-twitter"></i></a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" target="_blank" title="Bagikan ke LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            <a href="https://api.whatsapp.com/send?text={{ urlencode($artikel->title . ' - ' . request()->fullUrl()) }}" target="_blank" title="Bagikan ke WhatsApp"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>
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
      "url": "{{ asset('gambar/aset/logo-elcoding.png') }}"
    }
  }
}
</script>
@endpush
</x-layout>
