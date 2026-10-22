<style>
    :root {
        --valensa-banner: url('{{ asset('images/valensa/banner-valensa.jpeg') }}');
    }
</style>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @php
            $seoTitle = trim($__env->yieldContent(
                'title',
                'Servicios Valensa | Soluciones para perforación'
            ));

            $seoDescription = trim($__env->yieldContent(
                'meta_description',
                'Herramientas, accesorios, maquinaria y soluciones especializadas para perforaciones y estudios de suelo.'
            ));

            $seoUrl = url()->current();
            $seoImage = asset('images/valensa/banner-valensa.jpeg');
        @endphp

        <title>{{ $seoTitle }}</title>

        <meta name="description" content="{{ $seoDescription }}">
        @if (!app()->environment('production'))
            <meta name="robots" content="noindex, nofollow">
        @endif
        <link rel="canonical" href="{{ $seoUrl }}">

        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Servicios Valensa">
        <meta property="og:title" content="{{ $seoTitle }}">
        <meta property="og:description" content="{{ $seoDescription }}">
        <meta property="og:url" content="{{ $seoUrl }}">
        <meta property="og:image" content="{{ $seoImage }}">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $seoTitle }}">
        <meta name="twitter:description" content="{{ $seoDescription }}">
        <meta name="twitter:image" content="{{ $seoImage }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite([
            'resources/scss/app.scss',
            'resources/css/valensa/app.css',
            'resources/js/valensa/app.js'
        ])

        @livewireStyles
        @stack('styles')
    </head>

    <body class="d-flex flex-column min-vh-100">
        <x-site.navbar />

        <main class="flex-grow-1">
            @yield('content')
        </main>

        <x-site.footer />

        @livewireScripts
        @stack('scripts')

    </body>

</html>