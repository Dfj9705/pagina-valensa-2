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

        <title>@yield('title', 'Servicios Valensa')</title>

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