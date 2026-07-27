{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">

    <!-- Homepage - French -->
    <url>
        <loc>https://lepresk.com/?lang=fr</loc>
        <lastmod>{{ now()->toW3cString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
        <xhtml:link rel="alternate" hreflang="en" href="https://lepresk.com/?lang=en"/>
        <xhtml:link rel="alternate" hreflang="fr" href="https://lepresk.com/?lang=fr"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="https://lepresk.com/"/>
    </url>

    <!-- Homepage - English -->
    <url>
        <loc>https://lepresk.com/?lang=en</loc>
        <lastmod>{{ now()->toW3cString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
        <xhtml:link rel="alternate" hreflang="en" href="https://lepresk.com/?lang=en"/>
        <xhtml:link rel="alternate" hreflang="fr" href="https://lepresk.com/?lang=fr"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="https://lepresk.com/"/>
    </url>

    <!-- Blog Index -->
    <url>
        <loc>https://lepresk.com/blog</loc>
        <lastmod>{{ now()->toW3cString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    <!-- Blog Posts -->
@foreach ($posts as $post)
@foreach (config('app.available_locales') as $locale)
@if ($post->hasTranslation('slug', $locale))
    <url>
        <loc>{{ route('blog.show', ['slug' => $post->getTranslation('slug', $locale), 'lang' => $locale]) }}</loc>
        <lastmod>{{ $post->updated_at->toW3cString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
@foreach (config('app.available_locales') as $altLocale)
@if ($post->hasTranslation('slug', $altLocale))
        <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ route('blog.show', ['slug' => $post->getTranslation('slug', $altLocale), 'lang' => $altLocale]) }}"/>
@endif
@endforeach
@if ($post->hasTranslation('slug', config('app.fallback_locale')))
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ route('blog.show', $post->getTranslation('slug', config('app.fallback_locale'))) }}"/>
@endif
    </url>
@endif
@endforeach
@endforeach

    <!-- Projects -->
@foreach ($projects as $project)
    <url>
        <loc>https://lepresk.com/projets/{{ $project->slug }}</loc>
        <lastmod>{{ $project->updated_at->toW3cString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
@endforeach

</urlset>
