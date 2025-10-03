@extends('layouts.admin-layout')
@section('contenido')
    <div class="row">
        <div class="col-xl-12">
            <div class="card crm-widget">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        Resumen del producto
                    </h5>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl">
                        <i class="ri-add-circle-line align-middle me-1"></i> Registrar Producto
                    </button>
                </div>

                <div class="card-body p-4">
                    <div class="row gy-4">
                        <div class="col-xl-4">
                            <div>
                                <h4 class="fw-semibold">{{ $sucursal_articulo->producto->nombre }}</h4>
                                <div class="bg-light rounded p-2 mt-3 text-center">
                                    <img src="{{ asset($sucursal_articulo->producto->imagen_principal) }}" alt="Producto"
                                        class="img-fluid rounded object-fit-contain" style="max-height: 180px;">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2">
                            <div>
                                <h6 class="text-muted text-uppercase fs-13 mb-2">Precio promedio</h6>
                                <p class="fs-5 fw-medium mb-4">Bs. {{ $sucursal_articulo->producto->precio }}</p>

                                <h6 class="text-muted text-uppercase fs-13 mb-2">Código</h6>
                                <p class="fs-5 fw-medium mb-4">{{ $sucursal_articulo->producto->codigo }}</p>
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
                                                        data-id="{{ $sucursal_articulo->producto->id }}"
                                                        data-titulo="{{ $sucursal_articulo->producto->nombre }}">
                                                        <i class="ri-pencil-fill"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-light" data-bs-toggle="modal"
                                                        data-bs-target="#nuevoDetalleModal" id="nuevoDetalleBtn">
                                                        <i class="ri-add-line"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            @if ($sucursal_articulo->producto->detalles->count())
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-hover table-nowrap mb-0">
                                                        <tbody>
                                                            @foreach ($sucursal_articulo->producto->detalles as $detalle)
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
                                                        data-id="{{ $sucursal_articulo->producto->id }}"
                                                        data-titulo="{{ $sucursal_articulo->producto->nombre }}">
                                                        <i class="ri-pencil-fill"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-light" data-bs-toggle="modal"
                                                        data-bs-target="#nuevoCaracteristicaModal" id="nuevoDetalleBtn">
                                                        <i class="ri-add-line"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!--CARACTERISTICA-->
                                            @if ($sucursal_articulo->producto->caracteristicas->count())
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-hover table-nowrap mb-0">
                                                        <tbody>
                                                            @foreach ($sucursal_articulo->producto->caracteristicas as $caracteristica)
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
                                <p class="mb-0 fs-14">{{ $sucursal_articulo->producto->descripcion }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
