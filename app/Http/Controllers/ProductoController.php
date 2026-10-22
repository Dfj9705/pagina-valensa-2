<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function show(int $id)
    {
        $producto = Producto::query()
            ->where('pro_activo', true)
            ->where('pro_id', $id)
            ->firstOrFail();

        // Misma fórmula de inventario del administrador.
        // Una sola consulta para el producto.
        $stock = DB::table('movimientos_productos')
            ->where('pro_id', $producto->pro_id)
            ->selectRaw("
                COALESCE(SUM(
                    CASE
                        WHEN mop_tipo IN ('entrada', 'devolucion')
                            THEN mop_cantidad
                        WHEN mop_tipo IN ('salida', 'venta')
                            THEN -mop_cantidad
                        ELSE 0
                    END
                ), 0) AS stock
            ")
            ->value('stock');

        $stockDisponible = (int) ($stock ?? 0);

        $mediaUrl = rtrim(
            config('services.valensa.media_url', ''),
            '/'
        );

        $imagenes = collect($producto->pro_imagenes ?? [])
            ->filter(
                fn($ruta) =>
                    is_string($ruta) &&
                    $ruta !== '' &&
                    !str_contains($ruta, '..') &&
                    !str_contains($ruta, '\\')
            )
            ->map(
                fn($ruta) =>
                    $mediaUrl
                    ? $mediaUrl . '/' . ltrim($ruta, '/')
                    : null
            )
            ->filter()
            ->values()
            ->all();

        return view('pages.product-detail', compact(
            'producto',
            'stockDisponible',
            'imagenes'
        ));
    }
}
