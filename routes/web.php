<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SitemapController;
Route::view('/', 'pages.home')
    ->name('home');

Route::view('/quienes-somos', 'pages.about')
    ->name('about');

Route::view('/mision-vision', 'pages.mission-vision')
    ->name('mission-vision');

Route::view('/productos', 'pages.products')
    ->name('products.index');

Route::view('/contacto', 'pages.contact')
    ->name('contact');

Route::get('/productos/{id}', [ProductoController::class, 'show'])
    ->whereNumber('id')
    ->name('products.show');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])
    ->name('sitemap');


Route::get('/robots.txt', function () {
    if (!app()->environment('production')) {
        $contenido = "User-agent: *\nDisallow: /\n";
    } else {
        $contenido = "User-agent: *\n";
        $contenido .= "Allow: /\n";
        $contenido .= "Sitemap: " . route('sitemap') . "\n";
    }

    return response($contenido, 200)
        ->header('Content-Type', 'text/plain; charset=UTF-8');
})->name('robots');

