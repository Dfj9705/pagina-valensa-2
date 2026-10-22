<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $paginas = [
            [
                'url' => route('home'),
                'priority' => '1.0',
            ],
            [
                'url' => route('products.index'),
                'priority' => '0.9',
            ],
            [
                'url' => route('about'),
                'priority' => '0.7',
            ],
            [
                'url' => route('mission-vision'),
                'priority' => '0.6',
            ],
            [
                'url' => route('contact'),
                'priority' => '0.6',
            ],
        ];

        $productos = Producto::query()
            ->where('pro_activo', true)
            ->orderBy('pro_id')
            ->get([
                'pro_id',
                'updated_at',
            ]);

        return response()
            ->view('seo.sitemap', compact(
                'paginas',
                'productos'
            ))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
