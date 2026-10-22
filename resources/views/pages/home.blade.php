
@extends('layouts.app')

@section('title', 'Inicio | Servicios Valensa')
@section('meta_description', 'Servicios Valensa ofrece maquinaria, herramientas, accesorios para perforación de pozos y soluciones especializadas en estudios de suelo.')
@section('content')

    {{-- HERO --}}
    <section class="valensa-hero">
        <div class="container position-relative">
            <div class="row align-items-center min-vh-50">
                <div class="col-lg-8">

                    <span class="valensa-eyebrow">
                        SOLUCIONES PARA PERFORACIÓN
                    </span>

                    <h1 class="display-3 fw-bold text-white mt-4 mb-4">
                        Equipos que impulsan
                        <span class="text-warning">
                            grandes proyectos.
                        </span>
                    </h1>

                    <p class="lead text-white-50 mb-4">
                        Maquinaria perforadora de pozos de agua,
                        minería y construcción. Herramientas,
                        accesorios y soluciones especializadas.
                    </p>

                    <div class="d-flex flex-wrap gap-3">

                        <a href="{{ route('products.index') }}"
                           class="btn btn-warning btn-lg px-4">
                            Ver catálogo
                        </a>

                        <a href="https://wa.me/50253682021?text=Hola,%20quiero%20m%C3%A1s%20informaci%C3%B3n"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-outline-light btn-lg px-4">
                            Solicitar información
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SERVICIOS --}}
    <section class="valensa-services py-5" id="servicios">
        <div class="container py-lg-5">

            <div class="text-center mb-5">
                <span class="section-eyebrow">
                    LO QUE OFRECEMOS
                </span>

                <h2 class="display-5 fw-bold mt-2">
                    Soluciones para cada proyecto
                </h2>

                <p class="text-muted mx-auto"
                   style="max-width: 650px">
                    Equipos, herramientas y servicios
                    especializados para la industria.
                </p>
            </div>

            <div class="row g-4">

                @php
                    $services = [
                        [
                            'title' => 'Maquinaria para perforaciones',
                            'description' => 'Equipos para pozos de agua, minería y construcción.',
                            'image' => 'feature-1.jpg',
                            'url' => route('products.index'),
                            'action' => 'Explorar maquinaria',
                        ],
                        [
                            'title' => 'Accesorios para perforaciones',
                            'description' => 'Herramientas y accesorios para tus operaciones.',
                            'image' => 'feature-2.jpg',
                            'url' => route('products.index'),
                            'action' => 'Ver accesorios',
                        ],
                        [
                            'title' => 'Estudios de suelo',
                            'description' => 'Soluciones especializadas para tus proyectos.',
                            'image' => 'feature-3.jpg',
                            'url' => 'https://wa.me/50231862624?text=Hola,%20quiero%20informaci%C3%B3n%20sobre%20estudios',
                            'action' => 'Solicitar información',
                        ],
                    ];
                @endphp

                @foreach ($services as $service)
                    <div class="col-md-6 col-lg-4">

                        <article class="service-card h-100">

                            <div class="service-card-image">
                                <img
                                    src="{{ asset('images/valensa/' . $service['image']) }}"
                                    alt="{{ $service['title'] }}"
                                    loading="lazy"
                                >
                            </div>

                            <div class="service-card-body">
                                <h3 class="h4 fw-bold">
                                    {{ $service['title'] }}
                                </h3>

                                <p class="text-muted">
                                    {{ $service['description'] }}
                                </p>

                                <a href="{{ $service['url'] }}"
                                   class="service-card-link"
                                   @if(str_starts_with($service['url'], 'https://'))
                                       target="_blank"
                                       rel="noopener noreferrer"
                                   @endif>
                                    {{ $service['action'] }}
                                    <span aria-hidden="true">&rarr;</span>
                                </a>
                            </div>

                        </article>

                    </div>
                @endforeach

            </div>
        </div>
    </section>

@endsection
