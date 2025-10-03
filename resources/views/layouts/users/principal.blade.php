@extends('layouts.layout')
@section('contenido')
    <style>
        .slider-element .item img {
            height: 500px;
            width: 100%;
            object-fit: cover;
            object-position: center;
        }

        .owl-carousel .owl-dots .owl-dot span {
            background: rgba(0, 0, 0, 0.4) !important;
        }
    </style>

    <!--slider principal-->
    <section id="slider" class="slider-element h-auto">
        <div class="slider-inner">
            <div class="owl-carousel carousel-widget" data-margin="0" data-items="1" data-pagi="true" data-loop="true"
                data-animate-in="rollIn" data-speed="450" data-animate-out="rollOut" data-autoplay="5000">
                @if (isset($sliders[0]))
                    @foreach ($sliders as $slider)
                        @if ($slider->tipo === 'principal')
                            <div class="item position-relative w-100">
                                <img src="{{ asset($slider->imagen) }}" alt="Slider" class="w-100">

                                @php
                                    if ($slider->posicion === 'izquierda') {
                                        $lugar = 'start-0 text-start ms-4';
                                    } elseif ($slider->posicion === 'derecha') {
                                        $lugar = 'end-0 text-end me-4';
                                    } else {
                                        $lugar = 'start-50 translate-middle-x text-center';
                                    }
                                @endphp

                                <div
                                    class="slider-caption bg-black bg-opacity-20 p-4 rounded-3 position-absolute top-50 translate-middle-y {{ $lugar }}">
                                    @if (!empty($slider->titulo))
                                        <h2 class="mb-2 text-white animate__animated animate__fadeInUp">
                                            {{ $slider->titulo }}
                                        </h2>
                                    @endif

                                    @if (!empty($slider->descripcion))
                                        <p
                                            class="d-none d-sm-block text-white animate__animated animate__fadeInUp animate__delay-2s">
                                            {{ $slider->descripcion }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="alert alert-warning border border-warning border-opacity-25 text-center p-4">
                        <i class="ri-alert-line fs-3 text-warning"></i>
                        <h5 class="mt-2 text-warning">No hay sliders principales disponibles</h5>
                        <p class="mb-0">Agrega al menos un slider con tipo <code>"principal"</code> para que se muestre en
                            esta sección.
                        </p>
                    </div>
                @endif
            </div>
        </div>

    </section>

    <!--iconos-->

    <section class="section bg-black border-top position-relative w-100">
        <div class="container">
            <div class="row align-items-stretch col-mb-50">
                @foreach ($iconos as $icono)
                    <div class="col-sm-6 col-lg-3">
                        <div class="feature-box fbox-plain fbox-dark fbox-sm text-center">
                            <div class="fbox-icon mb-3">
                                <img src="{{ asset($icono->imagen) }}" alt="Icono" width="48" height="48"
                                    style="object-fit: contain;">
                            </div>
                            <div class="fbox-content">
                                <h3 class="text-white">{{ $icono->titulo }}</h3>
                                <p class="text-white-50 mt-0 mb-0">
                                    {{ $icono->descripcion }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!--slider secundario-->
    <section id="slider" class="slider-element h-auto">
        <div class="slider-inner">
            <div class="owl-carousel carousel-widget" data-margin="0" data-items="1" data-pagi="true" data-loop="true"
                data-animate-in="rollIn" data-speed="450" data-animate-out="rollOut" data-autoplay="5000">
                @if (isset($sliders[0]))
                    @foreach ($sliders as $slider)
                        @if ($slider->tipo === 'secundario')
                            <div class="item position-relative">
                                <img src="{{ asset($slider->imagen) }}" alt="Slider" class="w-100">

                                @php
                                    if ($slider->posicion === 'izquierda') {
                                        $lugar = 'start-0 text-start ms-4';
                                    } elseif ($slider->posicion === 'derecha') {
                                        $lugar = 'end-0 text-end me-4';
                                    } else {
                                        $lugar = 'start-50 translate-middle text-center';
                                    }
                                @endphp

                                <div
                                    class="slider-caption bg-black bg-opacity-20 p-4 rounded-3 position-absolute top-50 translate-middle-y {{ $lugar }}">
                                    @if (!empty($slider->titulo))
                                        <h2 class="mb-2 text-white animate__animated animate__fadeInUp">
                                            {{ $slider->titulo }}
                                        </h2>
                                    @endif

                                    @if (!empty($slider->descripcion))
                                        <p
                                            class="d-none d-sm-block text-white animate__animated animate__fadeInUp animate__delay-2s">
                                            {{ $slider->descripcion }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="alert alert-warning border border-warning border-opacity-25 text-center p-4">
                        <i class="ri-alert-line fs-3 text-warning"></i>
                        <h5 class="mt-2 text-warning">No hay sliders principales disponibles</h5>
                        <p class="mb-0">Agrega al menos un slider con tipo <code>"secundario"</code> para que se muestre
                            en
                            esta sección.
                        </p>
                    </div>
                @endif
            </div>
            <!-- Paginacion de slider -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Content ============================================= -->
    <section class="w-100 py-5 bg-light">
        <div class="container">
            <h3 class="mb-4 text-center">Productos Destacados</h3>
            <div class="row g-4">
                @if (isset($productos))
                    @foreach ($productos as $producto)
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="#"
                                class="grid-inner d-block h-100 position-relative overflow-hidden rounded shadow-sm">

                                <img src="{{ asset($producto->imagen) }}" class="w-100 h-100 object-cover"
                                    alt="{{ $producto->nombre }}">

                                <div
                                    class="bg-black bg-opacity-20 p-3 rounded-3 position-absolute
                                    top-50 start-50 translate-middle text-center z-2">
                                    <h5 class="mb-1 text-white">{{ $producto->nombre }}</h5>
                                    <p class="d-none d-sm-block text-white small">
                                        {{ Str::limit($producto->descripcion, 60) }}
                                    </p>
                                </div>

                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-25"></div>
                            </a>
                        </div>
                    @endforeach
                @else
                 <div class="alert alert-warning border border-warning border-opacity-25 text-center p-4">
                        <i class="ri-alert-line fs-3 text-warning"></i>
                        <h5 class="mt-2 text-warning">No hay productos disponibles</h5>
                        <p class="mb-0">
                            Agrega al menos un producto para que se muestre esta sección.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- #content end -->
    <!-- Categorias por Sucursal ============================================= -->
    <section class="w-100 py-5">
        <div class="container">
            <h3 class="mb-4 text-center">Categorías por Sucursal</h3>
            <div class="row g-4">
                @if (isset($sucursalesConCategorias) && !$sucursalesConCategorias->isEmpty())
                    @foreach ($sucursalesConCategorias as $sucursal)
                        <div class="col-12">
                            <div class="fancy-title title-border">
                                <h4>{{ $sucursal->nombre }}</h4>
                            </div>
                        </div>
                        @foreach ($sucursal->sucursal_categorias as $sucursalCategoria)
                            <div class="col-12 col-md-6 col-lg-3">
                                <a href="{{ route('user.categorias.listar', $sucursalCategoria->categoria->id) }}"
                                    class="grid-inner d-block h-100 position-relative overflow-hidden rounded shadow-sm">

                                    <img src="{{ asset('storage/' . $sucursalCategoria->categoria->imagen) }}" class="w-100 h-100 object-cover"
                                        alt="{{ $sucursalCategoria->categoria->nombre }}">

                                    <div
                                        class="bg-black bg-opacity-20 p-3 rounded-3 position-absolute
                                        top-50 start-50 translate-middle text-center z-2">
                                        <h5 class="mb-1 text-white">{{ $sucursalCategoria->categoria->nombre }}</h5>
                                    </div>

                                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-25"></div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                @else
                 <div class="alert alert-warning border border-warning border-opacity-25 text-center p-4">
                        <i class="ri-alert-line fs-3 text-warning"></i>
                        <h5 class="mt-2 text-warning">No hay categorías disponibles</h5>
                        <p class="mb-0">
                            No se encontraron categorías asignadas a ninguna sucursal.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
