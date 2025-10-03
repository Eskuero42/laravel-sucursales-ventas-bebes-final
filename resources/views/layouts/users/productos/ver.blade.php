@extends('layouts.layout')
@section('contenido')
    <!-- Content ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container">

                <script>
                    window.sucursalesArticulosData = @json($sucursales_articulos->keyBy('id'));
                </script>

                <div class="row gx-5 col-mb-80">
                    <main class="postcontent col-lg-8">

                        <div id="shop" class="shop row gutter-30">

                            <div class="fslider mb-0" data-animation="fade" data-pagi="false">
                                <div class="flexslider">
                                    <div class="slider-wrap">
                                        @if ($initial_sa && $initial_sa->articulo && $initial_sa->articulo->posiciones->isNotEmpty())
                                            @foreach ($initial_sa->articulo->posiciones as $posicion)
                                                <div class="slide **d-flex align-items-center justify-content-center**">
                                                    <img src="{{ asset($posicion->imagen) }}"
                                                        alt="Imagen de {{ $initial_sa->articulo->nombre }}"
                                                        class="**img-fluid** rounded **d-block mx-auto**">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="slide **d-flex align-items-center justify-content-center**">
                                                <img src="{{ asset($producto->imagen_principal) }}"
                                                    alt="Imagen de {{ $producto->nombre }}"
                                                    class="**img-fluid** rounded **d-block mx-auto**">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <aside class="sidebar col-lg-4">
                        <div class="bg-light rounded p-4 shadow-sm mb-4">
                            <h2 class="mb-2 fw-bold text-uppercase text-baby-sky">{{ $producto->nombre }}</h2>
                            <p class="mb-0 fs-5 text-dark">{{ $producto->descripcion }}</p>
                        </div>

                        <div id="product-price-container">
                            @if ($initial_sa)
                                @php
                                    $current_price = $initial_sa->precio;
                                    $has_discount =
                                        $initial_sa->descuento_habilitado && $initial_sa->descuento_porcentaje > 0;
                                    $discount_percentage = $initial_sa->descuento_porcentaje;
                                    $original_price_display = $initial_sa->precio;

                                    if ($has_discount && $discount_percentage > 0) {
                                        $original_price_display = $current_price / (1 - $discount_percentage / 100);
                                    }
                                @endphp
                                <div class="mb-3">
                                    @if ($has_discount)
                                        <span
                                            class="fs-4 fw-bold text-danger">${{ number_format($current_price, 2) }}</span>
                                        <del class="text-muted ms-2">${{ number_format($original_price_display, 2) }}</del>
                                        <span class="badge bg-danger text-white ms-2">-{{ $discount_percentage }}%</span>
                                    @else
                                        <span
                                            class="fs-4 fw-bold text-danger">${{ number_format($current_price, 2) }}</span>
                                    @endif
                                    <p class="small text-muted mb-0">Estado: {{ $initial_sa->estado }}</p>
                                </div>
                            @else
                                <div class="mb-3">
                                    <span
                                        class="fs-4 fw-bold text-danger">${{ number_format($producto->precio, 2) }}</span>
                                    <p class="small text-muted mb-0">No hay artículos disponibles para este
                                        producto.</p>
                                </div>
                            @endif
                        </div>

                        <hr>

                        <h5 class="fw-medium mb-3">Seleccionar Color:<span
                                class="product-color-value ms-1 fw-semibold"></span></h5>

                        <div id="product-color-dots" class="owl-dots">
                            @forelse ($sucursales_articulos as $sa)
                                @if ($sa->articulo)
                                    @php
                                        $image_path =
                                            $sa->articulo->posiciones->first()->imagen ?? $producto->imagen_principal;
                                        $full_image_url = asset($image_path);
                                    @endphp

                                    <button role="radio" class="owl-dot" data-sucursal-articulo-id="{{ $sa->id }}"
                                        style="background-image: url('{{ $full_image_url }}'); background-size: cover; background-position: center; border-radius: 50%; width: 40px; height: 40px; display: inline-block; margin: 5px; cursor: pointer; border: 2px solid transparent;"></button>
                                @endif
                            @empty
                                <p>No hay artículos disponibles para seleccionar.</p>
                            @endforelse
                        </div>

                        <hr>

                        <div id="product-sizes-container">
                            @foreach ($sucursales_articulos as $sa)
                                @if ($sa->articulo)
                                    @php
                                        $tallas = $sa->articulo->catalogos->filter(function ($catalogo) {
                                            return $catalogo->especificacion && $catalogo->especificacion->tipo && $catalogo->especificacion->tipo->nombre === 'Tallas';
                                        })->map(function ($catalogo) {
                                            return $catalogo->especificacion;
                                        })->unique('id');
                                    @endphp

                                    @if ($tallas->isNotEmpty())
                                        <div class="size-options-wrapper" id="sizes-for-articulo-{{ $sa->id }}" style="display: none;">
                                            <h4 class="mb-3">Tamaño</h4>
                                            <div class="row g-3">
                                                @foreach ($tallas as $talla)
                                                    <div class="col-6">
                                                        <div class="form-check custom-radio">
                                                            <input id="talla-{{ $talla->id }}-{{ $sa->id }}" class="form-check-input" type="radio" name="talla_{{ $sa->id }}" value="{{ $talla->id }}" @if($loop->first) checked @endif>
                                                            <label for="talla-{{ $talla->id }}-{{ $sa->id }}" class="form-check-label">{{ $talla->descripcion }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>

                        <button
                            class="bg-baby-gold w-100 bg-button-baby-gold text-white fw-semibold hover-baby-gold px-4 py-2 border-0">
                            AÑADIR A LA BOLSA
                        </button>

                        <hr>

                        <div class="row col-mb-50 mb-0 gx-5">
                            {{-- caracteristicas--}}
                            @if ($producto->caracteristicas->isNotEmpty())
                                @foreach ($producto->caracteristicas as $caracteristica)
                                    <div class="col-sm-6 col-lg-4">
                                        <div
                                            class="feature-box fbox-center fbox-effect p-4 bg-baby-light rounded shadow-sm h-100 text-center">
                                            <div class="mb-3">
                                                <img src="{{ asset($caracteristica->icono) }}" alt="icono"
                                                    class="img-fluid" style="width: 60px; height: 60px;">
                                            </div>
                                            <div class="fbox-content">
                                                <h6 class="mb-0 fw-semibold text-dark">
                                                    {{ $caracteristica->descripcion }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-info text-center fw-semibold my-4">
                                    Aún no se han registrado características para este producto.
                                </div>
                            @endif
                        </div>

                        <hr>

                        <div class="accordion accordion-bg accordion-border mb-0" id="accordionFlushExample">
                            {{-- detalles--}}
                            @if ($producto->detalles->isNotEmpty())
                                @foreach ($producto->detalles as $detalle)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading{{ $detalle }}">
                                            <button
                                                class="accordion-button collapsed bg-light text-dark fw-semibold px-4 py-3 rounded"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse{{ $detalle }}" aria-expanded="false"
                                                aria-controls="flush-collapse{{ $detalle }}">
                                                {{ $detalle->titulo }}
                                            </button>
                                        </h2>
                                        <div id="flush-collapse{{ $detalle }}" class="accordion-collapse collapse"
                                            aria-labelledby="flush-heading{{ $detalle }}"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body px-4 py-3 bg-light border-top">
                                                <p class="mb-2">{{ $detalle->descripcion }}</p>

                                                @if ($detalle->imagen)
                                                    <img src="{{ asset($detalle->imagen) }}" alt="imagen detalle"
                                                        class="img-thumbnail mt-3 rounded" style="max-height: 220px;">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-info text-center fw-semibold my-4">
                                    Aún no se han registrado detalles para este producto.
                                </div>
                            @endif
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- #content end -->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sucursalesArticulos = window.sucursalesArticulosData;
            const initialSaId = {{ $initial_sa->id ?? 'null' }};

            const colorDots = document.querySelectorAll('#product-color-dots .owl-dot');
            const priceContainer = document.getElementById('product-price-container');
            const sliderContainer = $('.fslider');

            let currentVisibleSizes = null;

            function updateView(saId) {
                if (!saId) return;
                const selectedSa = sucursalesArticulos[saId];
                if (!selectedSa) return;

                if (currentVisibleSizes) {
                    currentVisibleSizes.style.display = 'none';
                }
                const newSizesWrapper = document.getElementById(`sizes-for-articulo-${saId}`);
                if (newSizesWrapper) {
                    newSizesWrapper.style.display = 'block';
                    currentVisibleSizes = newSizesWrapper;
                }

                let priceHtml = '';
                const hasDiscount = selectedSa.descuento_habilitado && selectedSa.descuento_porcentaje > 0;
                let originalPrice = selectedSa.precio;
                if (hasDiscount) {
                    originalPrice = selectedSa.precio / (1 - selectedSa.descuento_porcentaje / 100);
                }
                priceHtml += '<div class="mb-3">';
                if (hasDiscount) {
                    priceHtml += `<span class="fs-4 fw-bold text-danger">${parseFloat(selectedSa.precio).toFixed(2)}</span>`;
                    priceHtml += `<del class="text-muted ms-2">${parseFloat(originalPrice).toFixed(2)}</del>`;
                    priceHtml += `<span class="badge bg-danger text-white ms-2">-${selectedSa.descuento_porcentaje}%</span>`;
                } else {
                    priceHtml += `<span class="fs-4 fw-bold text-danger">${parseFloat(selectedSa.precio).toFixed(2)}</span>`;
                }
                priceHtml += `<p class="small text-muted mb-0">Estado: ${selectedSa.estado}</p>`;
                priceHtml += '</div>';
                priceContainer.innerHTML = priceHtml;
                const slider = sliderContainer.data('flexslider');
                if (slider) {
                    while (slider.count > 0) {
                        slider.removeSlide(0);
                    }
                    if (selectedSa.articulo && selectedSa.articulo.posiciones.length > 0) {
                        selectedSa.articulo.posiciones.forEach(posicion => {
                            slider.addSlide(`<li><img src="{{ asset('') }}/${posicion.imagen}" alt="${selectedSa.articulo.nombre}"></li>`);
                        });
                    } else {
                        slider.addSlide(`<li><img src="{{ asset($producto->imagen_principal) }}" alt="{{ $producto->nombre }}"></li>`);
                    }
                }
            }
            colorDots.forEach(dot => {
                dot.addEventListener('click', function() {
                    colorDots.forEach(d => {
                        d.style.borderColor = 'transparent';
                        d.setAttribute('aria-checked', 'false');
                    });
                    this.style.borderColor = '#007bff';
                    this.setAttribute('aria-checked', 'true');

                    const saId = this.dataset.sucursalArticuloId;
                    updateView(saId);
                });
            });
            if (colorDots.length > 0) {
                colorDots[0].style.borderColor = '#007bff';
                colorDots[0].setAttribute('aria-checked', 'true');
            }
            if (initialSaId) {
                updateView(initialSaId);
            }
        });
    </script>
@endpush
