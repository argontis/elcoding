{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <!-- Static Routes -->
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/layanan') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/program-kursus') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/event-webinar') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/tentang-kami') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/portofolio') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/artikel') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/kontak') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>

    <!-- Dynamic Routes: Layanan -->
    @foreach ($layanans as $layanan)
        <url>
            <loc>{{ url('/layanan/detail/' . $layanan->slug) }}</loc>
            <lastmod>{{ $layanan->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    <!-- Dynamic Routes: Program Kursus -->
    @foreach ($programs as $program)
        <url>
            <loc>{{ url('/program-kursus/' . $program->id) }}</loc>
            <lastmod>{{ $program->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    <!-- Dynamic Routes: Portofolio -->
    @foreach ($portofolios as $portofolio)
        <url>
            <loc>{{ url('/portofolio/' . $portofolio->id) }}</loc>
            <lastmod>{{ $portofolio->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    <!-- Dynamic Routes: Artikel -->
    @foreach ($artikels as $artikel)
        <url>
            <loc>{{ url('/artikel/' . $artikel->id) }}</loc>
            <lastmod>{{ $artikel->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

</urlset>
