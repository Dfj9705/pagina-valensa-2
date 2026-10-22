@extends('layouts.app')

@section('title', $producto->pro_nombre . ' | Servicios Valensa')

@section(
    'meta_description',
    \Illuminate\Support\Str::limit(
        trim(strip_tags($producto->pro_descripcion ?? '')) ?:
        'Consulta información y disponibilidad de ' . $producto->pro_nombre . ' en Servicios Valensa.',
        155,
        ''
    )
)

@section('content')

    <section class="py-4 bg-white border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('products.index') }}">
                            Productos
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $producto->pro_nombre }}
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="py-5">
        <div class="container">

            <div class="row g-5">

                {{-- GALERÍA --}}
                <div class="col-lg-6">
                    <div class="producto-galeria">

                        @if(count($imagenes))
                            <div id="productoGaleria" class="carousel slide">

                                <div class="carousel-inner">

                                    @foreach($imagenes as $imagen)
                                        <div class="carousel-item
                                                                            {{ $loop->first ? 'active' : '' }}">

                                            <div class="producto-imagen-principal">
                                                <img src="{{ $imagen }}"
                                                    alt="{{ $producto->pro_nombre }} - Imagen {{ $loop->iteration }}"
                                                    class="img-fluid">
                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                                @if(count($imagenes) > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#productoGaleria"
                                        data-bs-slide="prev" aria-label="Imagen anterior">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>

                                    <button class="carousel-control-next" type="button" data-bs-target="#productoGaleria"
                                        data-bs-slide="next" aria-label="Imagen siguiente">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>

                                    <div class="producto-miniaturas mt-3">
                                        @foreach($imagenes as $imagen)
                                            <button type="button" data-bs-target="#productoGaleria"
                                                data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"
                                                aria-label="Ver imagen {{ $loop->iteration }}">
                                                <img src="{{ $imagen }}" alt="" loading="lazy">
                                            </button>
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        @else
                            <div class="producto-imagen-principal">
                                <span class="text-muted">
                                    Imagen no disponible
                                </span>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- INFORMACIÓN --}}
                <div class="col-lg-6">

                    <span class="section-eyebrow">
                        SERVICIOS VALENSA
                    </span>

                    <h1 class="display-5 fw-bold mt-3 mb-3">
                        {{ $producto->pro_nombre }}
                    </h1>

                    <p class="text-muted">
                        Código: {{ $producto->pro_sku ?: 'N/D' }}
                    </p>

                    <div class="mb-4">
                        @if($stockDisponible > 0)
                            <span class="badge bg-success fs-6">
                                Disponible
                            </span>
                        @else
                            <span class="badge bg-danger fs-6">
                                Agotado
                            </span>
                        @endif
                    </div>

                    <div class="producto-precio mb-4">
                        <small class="text-muted d-block mb-2">
                            Precio
                        </small>

                        @php
                            $precio = $producto->pro_precio_venta_max;
                        @endphp

                        @if(is_numeric($precio) && $precio > 0)
                            <h3 class="fw-bold mb-0">
                                Q {{ number_format((float) $precio, 2) }}


                            </h3>
                        @else
                            <h4 class="fw-bold mb-0">
                                Consultar precio
                            </h4>
                        @endif
                    </div>

                    <h5 class="fw-bold">Descripción</h5>

                    <div class="producto-descripcion text-muted mb-4">
                        {!! nl2br(e(strip_tags($producto->pro_descripcion ?? 'Sin descripción disponible.'))) !!}
                    </div>

                    @php
                        $mensaje = 'Hola, deseo información sobre el producto: '
                            . $producto->pro_nombre
                            . ' (SKU: ' . $producto->pro_sku . ').';

                        $whatsapp = 'https://wa.me/50253682021?'
                            . http_build_query(['text' => $mensaje]);
                    @endphp

                    <a href="{{ $whatsapp }}" target="_blank" rel="noopener noreferrer"
                        class="btn btn-primary btn-lg w-100 mb-3">
                        Consultar por WhatsApp
                    </a>

                    @if($stockDisponible <= 0)
                        <p class="small text-muted text-center">
                            Actualmente agotado.
                            Consulta por próximas existencias.
                        </p>
                    @endif

                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100">
                        Volver al catálogo
                    </a>

                </div>
            </div>
        </div>
    </section>

@endsection