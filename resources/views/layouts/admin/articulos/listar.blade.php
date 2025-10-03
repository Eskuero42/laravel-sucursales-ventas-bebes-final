@extends('layouts.admin-layout')
@section('contenido')
    @php
        \Carbon\Carbon::setLocale('es');
    @endphp
    <div class="row">
        <div class="col-xl-12">
            <div class="card crm-widget">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        Resumen del producto
                    </h5>
                    @if ($sucursal_categoria)
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-xl">
                            <i class="ri-add-circle-line align-middle me-1"></i> Registrar Articulos
                        </button>
                    @else
                        <button type="button" class="btn btn-success" disabled>
                            <i class="ri-add-circle-line align-middle me-1"></i> Registrar Articulos
                        </button>
                    @endif
                </div>

                <div class="card-body p-4">
                    <div class="row gy-4">
                        <div class="col-xl-4">
                            <div>
                                <h4 class="fw-semibold">{{ $producto->nombre }}</h4>
                                <div class="bg-light rounded p-2 mt-3 text-center">
                                    <img src="{{ asset($producto->imagen_principal) }}" alt="Producto"
                                        class="img-fluid rounded object-fit-contain" style="max-height: 180px;">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2">
                            <div>
                                <h6 class="text-muted text-uppercase fs-13 mb-2">Precio promedio</h6>
                                <p class="fs-5 fw-medium mb-4">Bs. {{ $producto->precio }}</p>

                                <h6 class="text-muted text-uppercase fs-13 mb-2">Código</h6>
                                <p class="fs-5 fw-medium mb-4">{{ $producto->codigo }}</p>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card border shadow-sm">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0">Detalles del producto</h6>
                                                <div class="d-flex gap-1">
                                                    <button class="btn btn-sm btn-light btn-icon editDetalleBtn"
                                                        data-bs-toggle="modal" data-bs-target="#editarDetallesModal"
                                                        data-id="{{ $producto->id }}" data-titulo="{{ $producto->nombre }}">
                                                        <i class="ri-pencil-fill"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-light" data-bs-toggle="modal"
                                                        data-bs-target="#nuevoDetalleModal" id="nuevoDetalleBtn">
                                                        <i class="ri-add-line"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            @if ($producto->detalles->count())
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-hover table-nowrap mb-0">
                                                        <tbody>
                                                            @foreach ($producto->detalles as $detalle)
                                                                <tr>
                                                                    <td class="fw-medium">{{ $detalle->titulo }}</td>
                                                                    <td>{{ $detalle->descripcion }}</td>
                                                                    <td class="text-end">
                                                                        <div class="d-flex gap-1 justify-content-end">
                                                                            <button
                                                                                class="btn btn-sm btn-light btn-icon editBtn-uno"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#editarUnDetalleModal"
                                                                                data-detalle='@json($detalle)'>
                                                                                <i class="ri-pencil-fill"></i>
                                                                            </button>
                                                                            <button
                                                                                class="btn btn-sm btn-light btn-icon text-danger delete-detalle-btn"
                                                                                data-id="{{ $detalle->id }}"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target=".confirmarEliminarDetalleModal">
                                                                                <i class="ri-delete-bin-5-line"></i>
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <p class="text-muted mb-0">Sin detalles registrados.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="card border shadow-sm">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0">Características</h6>
                                                <div class="d-flex gap-1">
                                                    <button class="btn btn-sm btn-light btn-icon editDetalleBtn"
                                                        data-bs-toggle="modal" data-bs-target="#editarCaracteristicasModal"
                                                        data-id="{{ $producto->id }}"
                                                        data-titulo="{{ $producto->nombre }}">
                                                        <i class="ri-pencil-fill"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-light" data-bs-toggle="modal"
                                                        data-bs-target="#nuevoCaracteristicaModal" id="nuevoDetalleBtn">
                                                        <i class="ri-add-line"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!--CARACTERISTICA-->
                                            @if ($producto->caracteristicas->count())
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-hover table-nowrap mb-0">
                                                        <tbody>
                                                            @foreach ($producto->caracteristicas as $caracteristica)
                                                                <tr>
                                                                    <td style="width: 30px;">
                                                                        <img src="{{ asset('storage/' . $caracteristica->icono) }}"
                                                                            alt="Icono"
                                                                            class="img-fluid rounded object-fit-contain"
                                                                            style="max-height: 20px;">
                                                                    </td>
                                                                    <td>{{ $caracteristica->descripcion }}</td>
                                                                    <td class="text-end">
                                                                        <div class="d-flex gap-1 justify-content-end">
                                                                            <button
                                                                                class="btn btn-sm btn-light btn-icon edit-caracteristica-btn"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#editarCaracteristicaModal"
                                                                                data-caracteristica='@json($caracteristica)'>
                                                                                <i class="ri-pencil-fill"></i>
                                                                            </button>
                                                                            <button
                                                                                class="btn btn-sm btn-light btn-icon text-danger delete-caracteristica-btn"
                                                                                data-id="{{ $caracteristica->id }}"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#confirmarEliminarCaracteristicaModal">
                                                                                <i class="ri-delete-bin-5-line"></i>
                                                                            </button>

                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <p class="text-muted mb-0">Sin detalles registrados.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-4">
                        <div class="col-xl-12">
                            <div class="bg-light p-4 rounded">
                                <h6 class="text-muted text-uppercase fs-13 mb-2">Descripción:</h6>
                                <p class="mb-0 fs-14">{{ $producto->descripcion }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row gx-lg-10">
                        @foreach ($articulos as $articulo)
                            <div class="col-xl-6 mb-4 mt-2">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h4>{{ $articulo->articulo->nombre }}</h4>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div>

                                            <a class="btn btn-info comprarArticuloBtn" data-bs-toggle="modal"
                                                data-bs-target="#compraArticuloModal"
                                                data-bs-obj='@json($articulo)'
                                                data-bs-catalogos='@json($articulo->catalogos)' title="Comprar producto">
                                                <i class="ri-shopping-cart-line"></i>
                                            </a>

                                            &nbsp;

                                            <a class="btn btn-light editArticuloBtn" data-bs-toggle="modal"
                                                data-bs-target="#editArticuloModal"
                                                data-bs-obj='@json($articulo)'
                                                data-bs-catalogos='@json($articulo->catalogos)' title="Editar producto">
                                                <i class="ri-pencil-fill align-bottom"></i>
                                            </a>

                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-info fs-24">
                                                        <i class="ri-money-dollar-circle-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">Precio:</p>
                                                    <h5 class="mb-0">Bs. {{ $articulo->precio }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-info fs-24">
                                                        <i class="ri-file-copy-2-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">Precio de descuento:
                                                    </p>
                                                    <h5 class="mb-0">Bs. {{ $articulo->precio_descuento }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-info fs-24">
                                                        <i class="ri-stack-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">Stock:</p>
                                                    <h5 class="mb-0">{{ $articulo->stock }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-7">
                                        @php $carouselId = 'carouselArticulo' . $articulo->id; @endphp
                                        <div id="{{ $carouselId }}" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($articulo->articulo->posiciones as $index => $imagen)
                                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                        <img src="{{ asset($imagen->imagen) }}" class="d-block w-100"
                                                            alt="Imagen {{ $index + 1 }}">
                                                    </div>
                                                @endforeach
                                            </div>

                                            <a class="carousel-control-prev" href="#{{ $carouselId }}" role="button"
                                                data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon"></span>
                                                <span class="visually-hidden">Anterior</span>
                                            </a>
                                            <a class="carousel-control-next" href="#{{ $carouselId }}" role="button"
                                                data-bs-slide="next">
                                                <span class="carousel-control-next-icon"></span>
                                                <span class="visually-hidden">Siguiente</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="row">
                                            @foreach ($articulo->articulo->catalogos as $catalogo)
                                                <h5 class="fs-14">
                                                    {{ $catalogo->tipo->nombre }} :
                                                    {{ $catalogo->especificacion->descripcion }}
                                                </h5>
                                            @endforeach

                                            @if ($articulo->fecha_vencimiento)
                                                <h5 class="fs-14 mt-4">
                                                    Fecha de vencimiento:
                                                </h5>
                                                <h5 class="fs-14">
                                                    {{ \Carbon\Carbon::parse($articulo->fecha_vencimiento)->translatedFormat('d \d\e F \d\e Y') }}
                                                </h5>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal de registrar articulo -->
    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <div class="modal-header bg-soft-success justify-content-center position-relative">
                    <h3 class="modal-title text-uppercase fw-bold text-success-emphasis text-center w-100"
                        id="myExtraLargeModalLabel">
                        <i class="ri-folder-add-line me-1"></i> Registrar Articulo
                    </h3>
                    <button type="button" class="btn-close position-absolute end-0 top-50 translate-middle-y me-3"
                        data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <form action="" id="addFormArticulo" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="row mb-3">
                                <div class="col-xl-8">
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <label for="codigo" class="form-label">Código</label>
                                            <input type="hidden" class="form-control" id="codigo" name="codigo"
                                                value="{{ old('codigo') }}" placeholder="Se generará automáticamente"
                                                readonly>
                                            <input type="text" class="form-control" id="codigo_vista"
                                                value="Atomático" readonly>
                                        </div>
                                        <input type="hidden" name="sucursales_categorias_id"
                                            value="{{ $sucursal_categoria->id }}">

                                        <div class="col-md-5">
                                            <label class="form-label">Nombre del artículo</label>

                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="nombre_opcion"
                                                    id="usar_nombre_producto" value="producto" checked>
                                                <label class="form-check-label" for="usar_nombre_producto">
                                                    Usar nombre del producto: <strong>{{ $producto->nombre }}</strong>
                                                </label>
                                            </div>

                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="nombre_opcion"
                                                    id="usar_nombre_personalizado" value="personalizado">
                                                <label class="form-check-label" for="usar_nombre_personalizado">
                                                    Escribir un nombre diferente
                                                </label>
                                            </div>

                                            <input type="hidden" name="nombre" id="nombre-final"
                                                value="{{ $producto->nombre }}">

                                            <input type="text" class="form-control mt-2 d-none"
                                                id="nombre-personalizado" placeholder="Nombre personalizado">
                                        </div>

                                        <div class="col-md-5">
                                            <label class="form-label">Precio del artículo</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio"
                                                            name="precio_radio" id="precio_actual" value="actual"
                                                            checked>
                                                        <label class="form-check-label mb-2" for="precio_actual">
                                                            Precio actual
                                                        </label>
                                                        <input type="number" name="precio_actual" class="form-control"
                                                            value="{{ $producto->precio }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio"
                                                            name="precio_radio" id="precio_nuevo" value="nuevo">
                                                        <label class="form-check-label mb-2" for="precio_nuevo">Otro
                                                            precio</label>
                                                        <input type="number" name="precio_nuevo" value="0"
                                                            class="form-control" placeholder="introducir precio"
                                                            step="0.01" min="0" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="descuento-fijo" class="form-label">Descuento
                                                fijo</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text"><i
                                                        class="ri-money-dollar-circle-line"></i></span>
                                                <input type="number" name="descuento" class="form-control"
                                                    id="descuento-fijo" placeholder="Ej: 50.00" min="0"
                                                    step="0.01" value="0">
                                                <div class="invalid-feedback">Ingrese un valor válido</div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="descuento-porcentaje" class="form-label">Descuento
                                                porcentual</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="ri-percent-line"></i></span>
                                                <input type="number" name="descuento_porcentaje" class="form-control"
                                                    id="descuento-porcentaje" placeholder="0%" min="0"
                                                    max="100" value="0">
                                                <button class="btn btn-light" type="button" data-bs-toggle="dropdown">
                                                    <i class="ri-arrow-down-s-line"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    @foreach ([10, 20, 30, 40, 50, 60, 70, 80, 90] as $percent)
                                                        <li>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="event.preventDefault(); document.getElementById('descuento-porcentaje').value = '{{ $percent }}'">
                                                                {{ $percent }}%
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            @if ($producto->categoria && $producto->categoria->tipo === 'no asignado')
                                                <div class="form-group">
                                                    <label for="fecha_vencimiento" class="form-label">Fecha de
                                                        vencimiento</label>
                                                    <input type="date" name="fecha_vencimiento" id="fecha_vencimiento"
                                                        class="form-control" required>
                                                </div>
                                            @else
                                                <input type="hidden" name="fecha_vencimiento" value="">
                                            @endif
                                        </div>

                                        <div class="col-md-2">
                                            <label for="stock" class="form-label">Stock inicial</label>
                                            <input type="number" name="stock" class="form-control" id="stock"
                                                placeholder="Ej: 10" min="0" value="0" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        @for ($i = 1; $i <= 6; $i++)
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="imagen{{ $i }}" class="form-label">Imagen
                                                        {{ $i }}</label>
                                                    <input type="file" name="imagen[]" id="imagen">

                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="col-md-12">
                                        <label class="form-label">Elija las especificaciones del producto</label>
                                        @if ($producto->producto_tipos->isNotEmpty())
                                            <div class="d-flex flex-wrap">
                                                @foreach ($producto->producto_tipos as $productoTipo)
                                                    <div class="me-4 mb-4">
                                                        <div class="fw-bold mb-2">
                                                            {{ $productoTipo->tipo?->nombre ?? '—' }}
                                                        </div>
                                                        @foreach ($productoTipo->tipo->especificaciones as $especificacion)
                                                            <div class="form-check ms-3">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="especificaciones[{{ $productoTipo->tipo->id }}][]"
                                                                    value="{{ $especificacion->id }}"
                                                                    id="spec_{{ $especificacion->id }}">
                                                                <label class="form-check-label"
                                                                    for="spec_{{ $especificacion->id }}">
                                                                    {{ $especificacion->descripcion }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted">Este producto todavía no tiene tipos asociados.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer mt-3">
                            <button type="button" class="btn bg-danger" data-bs-dismiss="modal"
                                style="color: white;">Cerrar</button>
                            <button type="submit" class="btn bg-success addBtn" style="color: white;">Agregar
                                Producto</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal de registrar Detalles -->
    <div class="modal fade" id="nuevoDetalleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">
                        <i class="ri-add-line me-1 align-middle text-success"></i>
                        Registrar compra
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <form id="formNuevoDetalle" action="#" method="POST">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                        <div class="mb-3">
                            <label for="nuevoTitulo" class="form-label">Título</label>
                            <input type="text" class="form-control" name="titulo" id="nuevoTitulo"
                                placeholder="Título de detalle" required>
                        </div>
                        <div class="mb-3">
                            <label for="nuevaDescripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="nuevaDescripcion" rows="3"
                                placeholder="Descripción del detalle" required></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link link-secondary fw-medium" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1 align-middle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success" form="formNuevoDetalle">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Editar Detalles -->
    <div class="modal fade bs-example-modal-lg" id="editarDetallesModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">
                        <i class="ri-pencil-fill me-1 align-middle text-warning"></i>
                        Editar Detalles del Producto
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <form id="formEditarDetalles" action="#" method="POST">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                        <div class="row">
                            @foreach ($producto->detalles as $i => $detalle)
                                <input type="hidden" name="detalles[{{ $i }}][id]"
                                    value="{{ $detalle->id }}">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Título #{{ $i + 1 }}</label>
                                    <input type="text" name="detalles[{{ $i }}][titulo]"
                                        class="form-control" value="{{ $detalle->titulo }}" placeholder="Ej: Material">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Descripción</label>
                                    <textarea name="detalles[{{ $i }}][descripcion]" class="form-control" rows="2"
                                        placeholder="Ej: 100% algodón">{{ $detalle->descripcion }}</textarea>
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link link-secondary fw-medium" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1 align-middle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary" form="formEditarDetalles">
                        Guardar cambios
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- editar un detalle -->
    <div class="modal fade" id="editarUnDetalleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">
                        <i class="ri-pencil-fill me-1 align-middle text-warning"></i>
                        Editar Detalle
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditarUnDetalle" action="#" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="editDetalleId">
                        <div class="mb-3">
                            <label for="editTitulo" class="form-label">Título</label>
                            <input type="text" class="form-control" name="titulo" id="editTitulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="editDescripcion" rows="3" required></textarea>
                        </div>

                        <div class="modal-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-link link-secondary fw-medium" data-bs-dismiss="modal">
                                <i class="ri-close-line me-1 align-middle"></i> Cancelar
                            </button>
                            <button type="submit" class="btn btn-warning updateBtn-uno">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- eliminar un Detalle -->
    <div class="modal fade confirmarEliminarDetalleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="deleteDetalleForm">
                    @csrf
                    <input type="hidden" name="id" id="deleteUnDetalleId">

                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="ri-alert-line align-middle me-2"></i>
                            Eliminar Detalle
                        </h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-center">
                        <i class="ri-error-warning-line text-danger display-4"></i>
                        <p class="mt-3">
                            ¿Está seguro de que desea eliminar la categoría?
                            <br>
                            <strong>Esta acción no se puede deshacer.</strong>
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="ri-close-line align-middle me-1"></i>
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger btnDelete">
                            <i class="ri-delete-bin-line align-middle me-1"></i>
                            Eliminar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de registrar caracteristica -->
    <div class="modal fade" id="nuevoCaracteristicaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">
                        <i class="ri-add-line me-1 align-middle text-success"></i>
                        Registrar nueva característica
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <form id="formNuevoCaracteristica" action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                        <div class="mb-3">
                            <label for="nuevoIcono" class="form-label">Ícono</label>
                            <input class="form-control" type="file" name="icono" id="nuevoIcono" required>
                        </div>

                        <div class="mb-3">
                            <label for="nuevaDescripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="nuevaDescripcion" rows="3"
                                placeholder="Descripción de la característica" required></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link link-secondary fw-medium" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1 align-middle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success" form="formNuevoCaracteristica">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Editar caracteristicas -->
    <div class="modal fade bs-example-modal-lg" id="editarCaracteristicasModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">
                        <i class="ri-pencil-fill me-1 align-middle text-warning"></i>
                        Editar Características del Producto
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <form id="formEditarCaracteristicas" action="#" method="POST">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                        <div class="row">
                            @foreach ($producto->caracteristicas as $i => $caracteristica)
                                <input type="hidden" name="caracteristicas[{{ $i }}][id]"
                                    value="{{ $caracteristica->id }}">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Ícono #{{ $i + 1 }}</label>
                                    <input type="file" name="caracteristicas[{{ $i }}][icono]"
                                        class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Descripción</label>
                                    <textarea name="caracteristicas[{{ $i }}][descripcion]" class="form-control" rows="2">{{ $caracteristica->descripcion }}</textarea>
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link link-secondary fw-medium" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1 align-middle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary" form="formEditarCaracteristicas">
                        Guardar cambios
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- editar una caracteristica -->
    <div class="modal fade" id="editarCaracteristicaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">
                        <i class="ri-pencil-fill me-1 align-middle text-warning"></i>
                        Editar Característica
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditarCaracteristica" action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="editCaracteristicaId">
                        <div class="mb-3">
                            <label for="editIcono" class="form-label">Ícono (Opcional)</label>
                            <input class="form-control" type="file" name="icono" id="editIcono">
                            <div class="mt-2">
                                <img id="iconoActual" src="" alt="Ícono actual" style="height: 40px;">
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="editCaracteristicaDescripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="editCaracteristicaDescripcion" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link link-secondary fw-medium" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1 align-middle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-warning" form="formEditarCaracteristica">
                        Guardar Cambios
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- eliminar una caracteristica -->
    <div class="modal fade" id="confirmarEliminarCaracteristicaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" id="deleteCaracteristicaForm">
                    @csrf
                    <input type="hidden" name="id" id="deleteCaracteristicaId">

                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="ri-alert-line align-middle me-2"></i>
                            Eliminar Característica
                        </h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                            aria-label="Cerrar"></button>
                    </div>

                    <div class="modal-body text-center">
                        <i class="ri-error-warning-line text-danger display-4"></i>
                        <p class="mt-3">
                            ¿Estás seguro de que quieres eliminar esta característica?
                            <br>
                            <strong>Esta acción no se puede deshacer.</strong>
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="ri-close-line align-middle me-1"></i>
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger btnDeleteCaracteristica">
                            <i class="ri-delete-bin-line align-middle me-1"></i>
                            Eliminar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Lógica para radio buttons de nombre personalizado
            const nombreOpcionProducto = document.getElementById('usar_nombre_producto');
            const nombreOpcionPersonalizado = document.getElementById('usar_nombre_personalizado');
            const nombrePersonalizadoInput = document.getElementById('nombre-personalizado');
            const nombreFinalInput = document.getElementById('nombre-final');
            const productoNombre = "{{ $producto->nombre }}";

            function handleNombreChange() {
                if (nombreOpcionPersonalizado.checked) {
                    nombrePersonalizadoInput.classList.remove('d-none');
                    nombreFinalInput.value = nombrePersonalizadoInput.value;
                } else {
                    nombrePersonalizadoInput.classList.add('d-none');
                    nombreFinalInput.value = productoNombre;
                }
            }

            nombreOpcionProducto.addEventListener('change', handleNombreChange);
            nombreOpcionPersonalizado.addEventListener('change', handleNombreChange);
            nombrePersonalizadoInput.addEventListener('input', () => {
                if (nombreOpcionPersonalizado.checked) {
                    nombreFinalInput.value = nombrePersonalizadoInput.value;
                }
            });

            const precioActualRadio = document.getElementById('precio_actual');
            const precioNuevoRadio = document.getElementById('precio_nuevo');
            const precioNuevoInput = document.querySelector('input[name="precio_nuevo"]');

            function handlePrecioChange() {
                precioNuevoInput.disabled = !precioNuevoRadio.checked;
            }

            precioActualRadio.addEventListener('change', handlePrecioChange);
            precioNuevoRadio.addEventListener('change', handlePrecioChange);
            handleNombreChange();
            handlePrecioChange();
        });
    </script>

    <script>
        $(document).ready(function() {
            //registar articulo
            $('#addFormArticulo').submit(function(e) {
                e.preventDefault();
                $('.addBtn').prop('disabled', true);

                let formData = new FormData(this);
                formData.append('producto_id', "{{ $producto->id }}");
                formData.set('nombre', document.getElementById('nombre-final').value);

                $.ajax({
                    url: "{{ route('admin.articulos.registrar') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res.message);
                        if (res.success) {
                            $('#addFormArticulo')[0].reset();
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        const error = xhr.responseJSON?.message ||
                            'Error al guardar el artículo.';
                        alert(error);
                    },
                    complete: function() {
                        $('.addBtn').prop('disabled', false);
                    }
                });
            });

            //registrar detalles
            $('#formNuevoDetalle').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.registrar.detalles') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res.message);
                        if (res.success) {
                            $('#nuevoDetalleModal').modal('hide');
                            $('#formNuevoDetalle')[0].reset();
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON?.message || 'Error al registrar el detalle');
                    }
                });
            });

            //editar detalles
            $('#formEditarDetalles').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.editar.detalles') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res.message);
                        if (res.success) {
                            $('#editarDetallesModal').modal('hide');
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON?.message || 'Error al guardar detalles');
                    }
                });
            });

            //editar un detalle
            $('#formEditarUnDetalle').submit(function(e) {
                e.preventDefault();
                $('.updateBtn-uno').prop('disabled', true);
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.editar.detalle') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res.message);
                        $('.updateBtn-uno').prop('disabled', false);
                        if (res.success) {
                            location.reload();
                        }
                    },
                });
            });

            $('.editBtn-uno').click(function() {
                var data = $(this).data('detalle');
                console.log(data);
                $('#editDetalleId').val(data.id);
                $('#editTitulo').val(data.titulo);
                $('#editDescripcion').val(data.descripcion);
            });

            //eliminar un detalle
            $('.delete-detalle-btn').click(function() {
                var id = $(this).data('id');
                $('#deleteUnDetalleId').val(id);
            });

            $('#deleteDetalleForm').submit(function(e) {
                e.preventDefault();
                $('.btnDelete').prop('disabled', true);

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.eliminar.detalle') }}",
                    type: "POST",
                    data: formData,
                    success: function(res) {
                        alert(res.message);
                        $('.btnDelete').prop('disabled', false);
                        if (res.success) {
                            location.reload();
                        }
                    }
                });

            });

            // registrar caracteristicas
            $('#formNuevoCaracteristica').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.registrar.caracteristicas') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res.message);
                        if (res.success) {
                            $('#nuevoCaracteristicaModal').modal('hide');
                            $('#formNuevoCaracteristica')[0].reset();
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON?.message || 'Error al registrar característica');
                    }
                });
            });

            // editar caracteristicas
            $('#formEditarCaracteristicas').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.editar.caracteristicas') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res.message);
                        if (res.success) {
                            $('#editarCaracteristicasModal').modal('hide');
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON?.message || 'Error al guardar características');
                    }
                });
            });

            // editar una caracterIstica
            $('.edit-caracteristica-btn').click(function() {
                var data = $(this).data('caracteristica');
                console.log(data);
                $('#editCaracteristicaId').val(data.id);
                $('#editCaracteristicaDescripcion').val(data.descripcion);

                // Mostrar el ícono actual (si existe)
                $('#iconoActual').attr('src', data.icono ?? '').toggle(!!data.icono);
            });

            $('#formEditarCaracteristica').submit(function(e) {
                e.preventDefault();
                $('.btn-warning').prop('disabled', true);
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.editar.caracteristica') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res.message);
                        $('.btn-warning').prop('disabled', false);
                        if (res.success) {
                            location.reload();
                        }
                    }
                });
            });

            // eliminar una caracterIstica
            $('.delete-caracteristica-btn').click(function() {
                var id = $(this).data('id');
                $('#deleteCaracteristicaId').val(id);
            });

            $('#deleteCaracteristicaForm').submit(function(e) {
                e.preventDefault();
                $('.btnDeleteCaracteristica').prop('disabled', true);

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.eliminar.caracteristica') }}",
                    type: "POST",
                    data: formData,
                    success: function(res) {
                        alert(res.message);
                        $('.btnDeleteCaracteristica').prop('disabled', false);
                        if (res.success) {
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
@endpush
