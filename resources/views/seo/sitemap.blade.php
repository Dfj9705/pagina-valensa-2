<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach ($paginas as $pagina)
        <url>
            <loc>{{ $pagina['url'] }}</loc>
            <priority>{{ $pagina['priority'] }}</priority>
        </url>
    @endforeach

    @foreach ($productos as $producto)
        <url>
            <loc>{{ route('products.show', $producto->pro_id) }}</loc>

            @if ($producto->updated_at)
                <lastmod>{{ $producto->updated_at->toAtomString() }}</lastmod>
            @endif

            <priority>0.8</priority>
        </url>
    @endforeach

</urlset>