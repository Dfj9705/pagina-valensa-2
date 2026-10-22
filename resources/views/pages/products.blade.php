@extends('layouts.app')

@section('title', 'Productos | Servicios Valensa')
@section('meta_description', 'Explora el catálogo de maquinaria, herramientas y accesorios para perforación de pozos de Servicios Valensa.')
@section('content')

    <section class="valensa-page-header">
        <div class="container text-center">

            <span class="valensa-eyebrow">
                NUESTRO CATÁLOGO
            </span>

            <h1 class="display-4 fw-bold text-white mt-3">
                Productos
            </h1>

            <p class="text-white-50 mt-3">
                Equipos, herramientas y accesorios
                para perforaciones.
            </p>

        </div>
    </section>

    <section class="py-5">
        <div class="container py-lg-4">

            <livewire:catalogo-productos />

        </div>
    </section>

@endsection