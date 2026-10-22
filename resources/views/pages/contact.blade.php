@extends('layouts.app')

@section('title', 'Contacto | Servicios Valensa')
@section('meta_description', 'Contacta a Servicios Valensa para solicitar información sobre maquinaria, accesorios para perforaciones y estudios de suelo.')
@section('content')

    <section class="valensa-page-header">
        <div class="container text-center">
            <span class="valensa-eyebrow">
                ESTAMOS PARA AYUDARTE
            </span>

            <h1 class="display-4 fw-bold text-white mt-3">
                Contáctenos
            </h1>

            <p class="text-white-50 mt-3">
                Cuéntanos sobre tu proyecto.
            </p>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-lg-5">

            <div class="row g-5">

                <div class="col-lg-5">
                    <span class="section-eyebrow">
                        HABLEMOS DE TU PROYECTO
                    </span>

                    <h2 class="fw-bold mt-3 mb-4">
                        Estamos listos para asesorarte
                    </h2>

                    <p class="text-muted lh-lg">
                        Si necesitas información sobre maquinaria,
                        herramientas, accesorios o estudios de suelo,
                        completa el formulario y nos pondremos
                        en contacto contigo.
                    </p>

                    <div class="mt-4">
                        <h5 class="fw-bold">Teléfono y WhatsApp</h5>
                        <a href="https://wa.me/50253682021" target="_blank" rel="noopener noreferrer"
                            class="text-decoration-none">
                            +502 5368-2021
                        </a>
                    </div>

                    <div class="mt-4">
                        <h5 class="fw-bold">Correo electrónico</h5>
                        <a href="mailto:web@serviciosvalensa.com" class="text-decoration-none">
                            web@serviciosvalensa.com
                        </a>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="bg-white rounded-4 shadow-sm p-4 p-lg-5">
                        <h3 class="fw-bold mb-4">
                            Envíanos un mensaje
                        </h3>

                        <livewire:contact-form />
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection