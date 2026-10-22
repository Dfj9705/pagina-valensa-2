<div>
    {{-- BUSCADOR --}}
    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="buscar-producto" class="form-label fw-semibold">
                Buscar productos
            </label>

            <input type="search" id="buscar-producto" class="form-control form-control-lg"
                wire:model.live.debounce.400ms="buscar" placeholder="Nombre o código del producto..."
                autocomplete="off">
        </div>
    </div>

    {{-- RESULTADOS --}}
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <p class="text-muted mb-0">
            {{ $productos->total() }} productos encontrados
        </p>

        <div wire:loading wire:target="buscar">
            <span class="spinner-border spinner-border-sm"></span>
            Buscando...
        </div>
    </div>

    <div class="row g-4">
        @forelse ($productos as $producto)
                @php
                    $disponible = $producto->stock_disponible > 0;
                @endphp

                <div class="col-md-6 col-lg-4" wire:key="producto-{{ $producto->pro_id }}">

                    <article class="catalogo-card h-100">

                        <div class="catalogo-card-image">
                            {{-- Imagen provisional hasta validar
                            la estructura de pro_imagenes --}}

                            @php
                                $imagenes = $producto->pro_imagenes ?? [];
                                $primeraImagen = is_array($imagenes)
                                    ? ($imagenes[0] ?? null)
                                    : null;

                                $mediaUrl = rtrim(
                                    config('services.valensa.media_url', ''),
                                    '/'
                                );

                                $imagenUrl = $primeraImagen && $mediaUrl
                                    ? $mediaUrl . '/' . ltrim($primeraImagen, '/')
                                    : null;
                            @endphp

                            @if ($imagenUrl)
                                <img src="{{ $imagenUrl }}" alt="{{ $producto->pro_nombre }}" class="catalogo-producto-img"
                                    loading="lazy"
                                    onerror="this.onerror=null;this.style.display='none';this.nextElementSibling.style.display='flex';">

                                <div class="catalogo-image-placeholder" style="display: none;">
                                    <span>Imagen no disponible</span>
                                </div>
                            @else
                                <div class="catalogo-image-placeholder">
                                    <span>Imagen no disponible</span>
                                </div>
                            @endif


                            <span class="catalogo-badge {{ $disponible ? 'disponible' : 'agotado' }}">
                                {{ $disponible ? 'Disponible' : 'Agotado' }}
                            </span>
                        </div>

                        <div class="catalogo-card-body">
                            <small class="text-muted">
                                SKU: {{ $producto->pro_sku ?: 'N/D' }}
                            </small>


                            <h3 class="h5 fw-bold mt-2">
                                <a href="{{ route('products.show', $producto->pro_id) }}"
                                    class="text-decoration-none text-reset">
                                    {{ $producto->pro_nombre }}
                                </a>
                            </h3>


                            <p class="text-muted small">
                                {{ \Illuminate\Support\Str::limit(
                strip_tags($producto->pro_descripcion ?? ''),
                110
            ) }}
                            </p>


                            <div class="mt-auto">
                                <a href="{{ route('products.show', $producto->pro_id) }}"
                                    class="btn btn-outline-primary w-100 mb-2">
                                    Ver detalles
                                </a>
                                <a href="https://wa.me/50253682021?{{ http_build_query(['text' => 'Hola, deseo información sobre el producto: ' . $producto->pro_nombre . ' (SKU: ' . $producto->pro_sku . ')']) }}"
                                    target="_blank" rel="noopener noreferrer" class="btn btn-primary w-100">
                                    Consultar producto
                                </a>
                            </div>
                        </div>

                    </article>
                </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <h3 class="h5">No encontramos productos</h3>
                    <p class="text-muted">
                        Intenta buscar con otro nombre o código.
                    </p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- PAGINACIÓN --}}
    @if ($productos->hasPages())
        <div class="mt-5">
            {{ $productos->links() }}
        </div>
    @endif
</div>