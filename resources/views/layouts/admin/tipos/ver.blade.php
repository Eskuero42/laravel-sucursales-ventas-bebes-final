@extends('layouts.admin-layout')

@section('contenido')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Tipos</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                        <li class="breadcrumb-item active">Tipos</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#exampleModalgrid"><i
                                            class="ri-add-line align-bottom me-1"></i> Registrar Tipo
                                    </button>
                                </div>
                            </div>
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
                                        <th>No</th>
                                        <th>Nombre</th>
                                        <th>Especificaciones Asignados</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($tipos as $n => $tipo)
                                        <tr>
                                            <td>{{ $n + 1 }}</td>
                                            <td> {{ $tipo->nombre }}</td>
                                            <td>
                                                
                                                <div class="d-flex flex-wrap gap-2 mt-2">
                                                    @foreach ($tipo->especificaciones as $especificacion)
                                                        @if ($tipo->id == 1)
                                                            <span class="d-inline-block rounded-circle border"
                                                                style="width:20px; height:20px; background-color: {{ strtolower(trim($especificacion->descripcion)) }};"
                                                                title="{{ $especificacion->descripcion }}">
                                                            </span>
                                                        @elseif ($tipo->nombre == 'Tallas')
                                                            <span class="badge bg-info">
                                                                {{ $especificacion->descripcion }}
                                                            </span>
                                                        @elseif ($tipo->nombre == 'Capacidades')
                                                            <span class="badge bg-success">
                                                                {{ $especificacion->descripcion }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button
                                                            class="btn btn-warning btn-icon waves-effect waves-light editBtn"
                                                            data-bs-obj='@json($tipo)'
                                                            data-bs-toggle="modal" data-bs-target="#showModal">
                                                            <i data-feather="edit-2"></i>
                                                        </button>
                                                    </div>

                                                    <button
                                                        class="btn btn-danger btn-icon waves-effect waves-light deleteBtn"
                                                        data-bs-id="{{ $tipo->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#deleteRecordModal">
                                                        <i data-feather="trash-2"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>


                            </table>
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
    <!-- Modal para registrar tipos -->
    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-3 shadow-lg border-3">
                <div class="modal-header bg-light border-0">
                    <h5 class="modal-title text-success fw-bold d-flex align-items-center" id="exampleModalgridLabel">
                        <i class="ri-layout-grid-line me-2"></i> Registro de Datos
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" action="">
                        @csrf
                        <div class="row g-3">

                            <!-- Primera columna -->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="firstName" class="form-label fw-semibold">Nombre</label>
                                    <input type="text" name="nombre" class="form-control border-success-subtle"
                                        id="firstName" placeholder="Ingrese Nombre" required>
                                </div>
                            </div>
                            <!-- Botones -->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end pt-3">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                        <i class="ri-close-line align-middle"></i> Cancelar
                                    </button>
                                    <button type="submit" class="btn btn-success addBtn">
                                        <i class="ri-check-line align-middle"></i> Registrar
                                    </button>
                                </div>
                            </div>

                        </div><!--end row-->
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal para editar tipos -->
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModal" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-3 shadow-lg border-3">
            <div class="modal-header bg-light border-0">
                <h5 class="modal-title text-warning fw-bold d-flex align-items-center" id="showModal">
                    <i class="ri-layout-grid-line me-2"></i> Editar de Dato
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" action="javascript:void(0);">
                    @csrf
                    <div class="row g-3">
                        <input type="hidden" name="id" id="updateId">
                        <div class="col-xxl-12">
                            <div>
                                <label for="firstName" class="form-label fw-semibold">Tipo</label>
                                <input type="text" id="nombre" name="nombre"
                                    class="form-control border-warning-subtle" placeholder="Ingrese su descripción"
                                    required readonly>
                            </div>
                        </div>

                        <!-- 🔹 Bloque adicional solo para mostrar colores/tallas/capacidades -->
                        <div class="col-xxl-12 mt-3">
                            <label class="form-label fw-semibold">Especificaciones asignadas</label>
                            <div id="contenedorElementos" class="d-flex flex-wrap gap-2">
                                <!-- Aquí se mostrarán dinámicamente los elementos -->
                            </div>
                        </div>
                        <!-- 🔹 Fin del bloque adicional -->

                        <!-- Botones -->
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end pt-3">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                    <i class="ri-close-line align-middle"></i> Cancelar
                                </button>
                                <button type="submit" class="btn btn-warning updateBtn">
                                    <i class="ri-check-line align-middle"></i> Actualizar
                                </button>
                            </div>
                        </div>

                    </div><!--end row-->
                </form>
            </div>

        </div>
    </div>
</div>

    <!-- Modal para eliminar tipos -->
    <div class="modal fade" id="deleteRecordModal" tabindex="-1" aria-labelledby="deleteRecordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content border-3 rounded-3 shadow-lg">
                <form id="deleteForm" action="">
                    @csrf
                    <input type="hidden" name="id" id="deleteCategoriaId">
                    <div class="modal-header bg-soft-danger">
                        <h5 class="modal-title text-danger fw-bold d-flex align-items-center" id="deleteRecordModalLabel">
                            <i class="ri-alert-line me-2 fs-4"></i> Confirmar Eliminación
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="my-3">
                            <i class="ri-delete-bin-line display-4 text-danger"></i>
                            <p class="mt-3 mb-0 fs-5 text-muted">
                                ¿Estás seguro de que deseas eliminar este registro?
                            </p>
                            <p class="text-muted small">Esta acción no se puede deshacer.</p>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer justify-content-center border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="ri-close-line align-middle"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger btnDelete">
                            <i class="ri-delete-bin-line align-middle"></i> Eliminar
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            $('#addForm').submit(function(e) {
                e.preventDefault();
                $('.addBtn').prop('disabled', true);

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.tipos.registrar') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res.message);
                        $('.addBtn').prop('disabled', false);
                        if (res.success) {
                            location.reload();
                        }
                    }
                });
            });

            //modificar
            $('.editBtn').click(function() {
                var data = $(this).data('bs-obj');
                console.log(data);
                $('#updateId').val(data.id);
                $('#nombre').val(data.nombre);
            });

            $('#updateForm').submit(function(e) {
                e.preventDefault();
                $('.updateBtn').prop('disabled', true);

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.tipos.editar') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res.message);
                        $('.updateBtn').prop('disabled', false);
                        if (res.success) {
                            location.reload();
                        }
                    }
                });
            });

            // Eliminar

            $('.deleteBtn').click(function() {
                var id = $(this).data('bs-id');
                $('#deleteCategoriaId').val(id);
            });

            $('#deleteForm').submit(function(e) {
                e.preventDefault();
                $('.btnDelete').prop('disabled', true);

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.tipos.eliminar') }}",
                    type: "DELETE",
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
        });
    </script>
@endpush