<?php

namespace App\Livewire;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class CatalogoProductos extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $buscar = '';

    public function updatedBuscar(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $movimientos = DB::table('movimientos_productos')
            ->select('pro_id')
            ->selectRaw("
                SUM(
                    CASE
                        WHEN mop_tipo IN ('entrada', 'devolucion')
                            THEN mop_cantidad
                        WHEN mop_tipo IN ('salida', 'venta')
                            THEN -mop_cantidad
                        ELSE 0
                    END
                ) AS stock_calculado
            ")
            ->groupBy('pro_id');

        $productos = Producto::query()
            ->select('productos.*')
            ->leftJoinSub($movimientos, 'inventario', function ($join) {
                $join->on(
                    'productos.pro_id',
                    '=',
                    'inventario.pro_id'
                );
            })
            ->selectRaw(
                'COALESCE(inventario.stock_calculado, 0) AS stock_disponible'
            )
            ->where('productos.pro_activo', true)
            ->when(trim($this->buscar) !== '', function ($query) {
                $termino = trim($this->buscar);

                $query->where(function ($q) use ($termino) {
                    $q->where('productos.pro_nombre', 'like', "%{$termino}%")
                        ->orWhere('productos.pro_sku', 'like', "%{$termino}%");
                });
            })
            ->orderBy('productos.pro_nombre')
            ->paginate(12);

        return view('livewire.catalogo-productos', [
            'productos' => $productos,
        ]);
    }
}
