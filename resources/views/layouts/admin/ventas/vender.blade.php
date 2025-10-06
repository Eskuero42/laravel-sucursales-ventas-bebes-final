@extends('layouts.admin-layout')
@section('contenido')
    <div class="row g-3">
        <div class="col-xl-9">
            <div class="card mb-3 border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">
                            <i class="ri-user-line text-primary"></i> 
                            Datos del Cliente
                        </h5>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="cleinte_en_la_venta" checked>
                            <label class="form-check-label fw-semibold" for="cliente">
                                Con datos del cliente
                            </label>
                        </div>
                    </div>

                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Carnet de Identidad</label>
                            <input type="text" class="form-control" placeholder="Introduzca carnet de identidad">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Celular</label>
                            <input type="number" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5><i class="ri-box-3-line text-success"></i> Productos</h5>
                        <div class="d-flex gap-2 w-50">
                            <input type="text" class="form-control" placeholder="Código del producto">
                            <select class="form-select" aria-label="Seleccionar artículo derivado">
                                <option selected>Seleccione artículo</option>
                                <option value="A-9-001">A-9-001 - Rojo / M</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive" style="max-height: 70vh; overflow-y: auto;">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Subtotal</th>
                                    <th>Con factura</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>A-9-001</td>
                                    <td>Chompa - Rojo / 5</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <button type="button" class="btn btn-light btn-sm minus material-shadow me-1">
                                                –
                                            </button>

                                            <input type="number"
                                                class="form-control form-control-sm product-quantity text-center"
                                                value="1" min="0" max="100">

                                            <button type="button" class="btn btn-light btn-sm plus material-shadow ms-1">
                                                +
                                            </button>
                                        </div>
                                    </td>
                                    <td>10 Bs</td>
                                    <td>10 Bs</td>
                                    <td class="text-center">
                                        <input class="form-check-input" type="checkbox">
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-danger">
                                            <i class="ri-delete-bin-6-line"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="sticky-side-div">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body d-flex flex-column justify-content-between" style="min-height: 85vh;">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-semibold mb-0 text-muted">Código</h6>
                            <span class="badge bg-primary-subtle text-primary fs-6 fw-semibold px-3 py-2">
                                Bb-0001
                            </span>
                        </div>

                        <div class="bg-light p-3 rounded-3 text-center mb-3">
                            <h4>Total:</h4>
                            <h2 class="text-success fw-bold">10 Bs</h2>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Método de pago</label>
                            <div class="d-flex flex-column gap-2">

                                <!-- Todos los radios con el mismo name -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="metodo_pago" id="efectivo"
                                        checked>
                                    <label class="form-check-label" for="efectivo">Efectivo</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="metodo_pago" id="qr">
                                    <label class="form-check-label" for="qr">QR</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="metodo_pago" id="tarjeta">
                                    <label class="form-check-label" for="tarjeta">Tarjeta</label>
                                </div>

                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="metodo_pago" id="pago_parcial">
                                    <label class="form-check-label" for="pago_parcial">Pago parcial</label>
                                </div>

                                <div class="border rounded p-2 mt-2 bg-light-subtle" style="display: block;">
                                    <label class="form-label mb-1 fw-semibold">Detalle de pago:</label>
                                    <div class="d-flex flex-column gap-2">
                                        <input type="number" class="form-control form-control-sm" placeholder="Efectivo Bs">

                                        <input type="number" class="form-control form-control-sm" placeholder="QR Bs">

                                        <input type="number" class="form-control form-control-sm" placeholder="Tarjeta Bs">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="text-center mt-auto">
                            <button class="btn btn-success btn-lg w-100">
                                <i class="ri-check-line"></i> 
                                Confirmar Venta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
