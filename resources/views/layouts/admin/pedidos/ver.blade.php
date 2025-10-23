@extends('layouts.admin-layout')
@section('contenido')
    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-3 border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">
                            <i class="ri-user-line text-primary"></i>
                            Datos del Cliente
                        </h5>
                    </div>

                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Carnet de Identidad</label>
                            <input type="text" class="form-control" placeholder="Introduzca carnet de identidad">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="row g-3 align-items-end mt-2">
                        <div class="col-md-4">
                            <label class="form-label">Celular</label>
                            <input type="number" class="form-control" placeholder="">
                        </div>

                        <div class="col-md-8">
                            <label class="form-label">Fecha y hora de pedido</label>
                            <input type="number" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-info text-muted">
                                <tr>
                                    <th scope="col">Productos pedidos</th>
                                    <th scope="col">Precio unitario</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col" class="text-end">Total por producto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                <img src="assets/images/products/img-8.png" alt=""
                                                    class="img-fluid d-block">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-15"><a href="apps-ecommerce-product-details.html"
                                                        class="link-primary">Biberon</a></h5>
                                                <p class="text-muted mb-0">Código: <span class="fw-medium">A-09</span></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$119.99</td>
                                    <td>02</td>

                                    <td class="fw-medium text-end">
                                        $239.98
                                    </td>
                                </tr>

                                <tr class="border-top border-top-dashed">
                                    <td colspan="3"></td>
                                    <td colspan="2" class="fw-medium p-0">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr class="border-top border-top-dashed">
                                                    <th scope="row">Total de los productos:</th>
                                                    <th class="text-end">$415.96</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-4">
            <div class="sticky-side-div d-flex flex-column">

                <div class="card rounded shadow-sm bg-light-subtle d-flex flex-column justify-content-between"
                    style="min-height: 85vh; padding:1rem;">

                    <!-- Código del pedido -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-semibold mb-0 text-muted">Código</h6>
                        <span class="badge bg-info-subtle text-info fs-6 fw-semibold px-3 py-2">Bb-0001</span>
                    </div>

                    <!-- Tabla de costos integrada al total -->
                    <div class="bg-light p-3 rounded-3">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="fw-semibold">Total de productos:</td>
                                    <td class="text-end">Bs. 88</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Total envío:</td>
                                    <td class="text-end">Bs. 15</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="text-center">
                            <h4>Total:</h4>
                            <h2 class="text-success fw-bold">103 Bs</h2>
                        </div>
                    </div>

                    <div class="mb-1">
                        <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d60339.36559714891!2d-65.273835!3d-19.054487!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2sbo!4v1760390951689!5m2!1ses-419!2sbo"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-3">

                        <button class="btn p-0 border-0" type="button">
                            <img src="{{ asset('backend\assets\images\adminBebBus\iconos\whatsapp.png') }}" alt="WhatsApp"
                                class="img-fluid" style="height:40px;">
                        </button>

                        <button class="btn p-0 border-0" type="button" data-bs-toggle="modal"
                            data-bs-target="#cancelarModal">
                            <img src="{{ asset('backend\assets\images\adminBebBus\iconos\cancelar.png') }}" alt="Cancelar"
                                class="img-fluid" style="height:40px;">
                        </button>
                    </div>

                    <!-- Botón confirmar -->
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
@endsection
