@extends('layouts.admin-layout')

@section('contenido')
    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row mb-0 pb-0">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-3 p-lg-4">
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column gap-3">

                                    <!-- Avatar / Nombre -->
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-grow-1">
                                            <h1 class="fs-20 mb-2 d-flex align-items-center gap-2 fw-semibold">
                                                <i class="ri-user-3-line align-middle me-1 fs-30"></i><span>Julio Calderon
                                                    Polo</span>
                                            </h1>
                                            <div class="d-flex flex-wrap gap-2">
                                                <span class="badge bg-light text-dark fw-normal fs-16">
                                                    <i class="bx bx-id-card align-middle me-1 fs-16"></i> 12867721111
                                                </span>
                                                <span class="badge bg-light text-dark fw-normal fs-16">
                                                    <i class="ri-mail-line align-middle me-1 fs-16"></i> filmo@gmail.com
                                                </span>
                                                <span class="badge bg-light text-dark fw-normal fs-16">
                                                    <i class="ri-phone-line align-middle me-1 fs-16"></i> 76122037
                                                </span>
                                                <span class="badge bg-light text-dark fw-normal fs-16">
                                                    <i class="ri-map-pin-line align-middle me-1 fs-16"></i>
                                                    J.perez&nbsp;Sucre
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- end header row -->
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>

                <!--end row-->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total de Pedidos
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="19">0</span></h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle rounded fs-3">
                                            <i class="bx bx-shopping-bag text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Deuda Acumulada
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">Bs<span class="counter-value"
                                                data-target="559.25">0</span> </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Customers</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08 %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="183.35">0</span>M </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> My Balance</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-muted fs-14 mb-0">
                                            +0.00 %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value"
                                                data-target="165.89">0</span>k </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-wallet text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div> <!-- end row-->
            </div> <!-- end .h-100-->
        </div> <!-- end col -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Detalles de Pedidos</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" placeholder="Search...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th class="sort" data-sort="customer_name">Codigo</th>
                                        <th class="sort" data-sort="email">Fecha</th>
                                        <th class="sort" data-sort="phone">Estado</th>
                                        <th class="sort" data-sort="date">Total(bs)</th>
                                        <th class="sort" data-sort="status">Items</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    <tr>
                                        <td>1</td>
                                        <td>B43</td>
                                        <td>01-01-2025</td>
                                        <td class="status"><span
                                                class="badge bg-success-subtle text-success">Pagado</span>
                                        </td>
                                        <td>150.00</td>
                                        <td>2 Gorros</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>B43</td>
                                        <td>01-01-2025</td>
                                        <td class="status"><span
                                                class="badge bg-danger-subtle text-danger">Pendiente</span>
                                        </td>
                                        <td>150.00</td>
                                        <td>2 Gorros</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a"
                                        style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="javascript:void(0);">
                                    Next
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
