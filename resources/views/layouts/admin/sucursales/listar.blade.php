@extends('layouts.admin-layout')

@section('contenido')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Sucursales</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                        <li class="breadcrumb-item active">Sucursales</li>
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
                                        id="create-btn" data-bs-target="#exampleModalgrid">
                                        <i class="ri-add-line align-bottom me-1"></i> Registrar Sucursales
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
                                        <th>Direccion</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @if ($sucursales->isNotEmpty())
                                        @foreach ($sucursales as $n => $sucursal)
                                            <tr>
                                                <td>{{ $n + 1 }}</td>
                                                <td>{{ $sucursal->nombre }}</td>
                                                <td>{{ $sucursal->direccion }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">

                                                        <div class="edit">
                                                            <a href="{{ route('admin.sucursales.ver', $sucursal->id) }}"
                                                                class="btn btn-sm btn-primary">
                                                                <i class="ri-edit-2-line align-middle"></i> Ver
                                                            </a>
                                                        </div>
                                                        <div class="edit">
                                                            <button class="btn btn-sm btn-warning edit-item-btn editBtn"
                                                                data-bs-obj='@json($sucursal)'
                                                                data-bs-toggle="modal" data-bs-target="#showModal">
                                                                <i class="ri-edit-2-line align-middle"></i> Editar
                                                            </button>
                                                        </div>

                                                        <button class="btn btn-sm btn-danger remove-item-btn deleteBtn"
                                                            data-bs-id="{{ $sucursal->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#deleteRecordModal">
                                                            Eliminar
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">
                                                No hay sucursales registradas.
                                            </td>
                                        </tr>
                                    @endif

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

    <!-- Modal para registrar sucursales -->
    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalgridLabel">
                        <i class="ri-store-2-line me-2"></i> Registro de Sucursal
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm">
                        @csrf
                        <div class="row">
                            <!-- Columna Izquierda -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label fw-semibold">Nombre de la Sucursal</label>
                                    <input type="text" name="nombre" class="form-control border-success-subtle"
                                        id="nombre" placeholder="Ingrese nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="direccion" class="form-label fw-semibold">Dirección</label>
                                    <textarea name="direccion" class="form-control border-success-subtle" id="direccion" rows="3"
                                        placeholder="Ingrese dirección" required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="horario_inicio" class="form-label fw-semibold">Horario Inicio</label>
                                        <input type="time" name="horario_inicio"
                                            class="form-control border-success-subtle" id="horario_inicio" required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="horario_fin" class="form-label fw-semibold">Horario Fin</label>
                                        <input type="time" name="horario_fin"
                                            class="form-control border-success-subtle" id="horario_fin" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Columna Derecha - Ubicación -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="google_maps_url" class="form-label fw-semibold">Link de Google
                                        Maps</label>
                                    <input type="text" id="google_maps_url" class="form-control border-info-subtle"
                                        placeholder="Pega el link de Google Maps aquí">
                                    <button type="button" class="btn btn-sm btn-info mt-2"
                                        onclick="extraerCoordenadas()">
                                        <i class="ri-map-pin-line me-1"></i> Obtener Coordenadas
                                    </button>
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="latitud" class="form-label fw-semibold">Latitud</label>
                                        <input type="text" name="latitud" id="latitud"
                                            class="form-control border-success-subtle" readonly required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="longitud" class="form-label fw-semibold">Longitud</label>
                                        <input type="text" name="longitud" id="longitud"
                                            class="form-control border-success-subtle" readonly required>
                                    </div>
                                </div>

                                <div class="alert alert-info border-0 bg-info-subtle">
                                    <small>
                                        <strong>Instrucciones:</strong><br>
                                        1. Busca la ubicación en Google Maps<br>
                                        2. Copia el link de la barra de direcciones<br>
                                        3. Pégalo arriba y haz clic en "Obtener Coordenadas"
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="text-end mt-3">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                <i class="ri-close-line me-1"></i> Cancelar
                            </button>
                            <button type="submit" class="btn btn-success addBtn">
                                <i class="ri-check-line me-1"></i> Registrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar sucursales -->
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
                                    <label for="firstName" class="form-label fw-semibold">Nombre</label>
                                    <input type="text" id="nombre" name="nombre"
                                        class="form-control border-warning-subtle"placeholder="Ingrese su descripción"
                                        required>
                                </div>
                                <div>
                                    <label for="firstName" class="form-label fw-semibold">Direccion</label>
                                    <input type="text" id="direccion" name="direccion"
                                        class="form-control border-warning-subtle"placeholder="Ingrese su descripción"
                                        required>
                                </div>
                            </div>
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
    <!-- Modal para eliminar sucursales -->
    <div class="modal fade" id="deleteRecordModal" tabindex="-1" aria-labelledby="deleteRecordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content border-3 rounded-3 shadow-lg">
                <form id="deleteForm" action="">
                    @csrf
                    <input type="hidden" name="id" id="deleteSucursalId">
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
        // Función FUERA para que sea accesible desde onclick
        function extraerCoordenadas() {
            let url = $('#google_maps_url').val();

            if (!url) {
                alert('Por favor pega un link de Google Maps');
                return;
            }

            // Si es un link acortado
            if (url.includes('goo.gl')) {
                alert(
                    'Link acortado detectado.\n\nPor favor:\n1. Abre ese link en tu navegador\n2. Cuando cargue, copia la URL COMPLETA de la barra de direcciones\n3. Pégala aquí');
                return;
            }

            // Buscar coordenadas en varios formatos
            let match = url.match(/@(-?\d+\.\d+),(-?\d+\.\d+)/) ||
                url.match(/!3d(-?\d+\.\d+)!4d(-?\d+\.\d+)/) ||
                url.match(/ll=(-?\d+\.\d+),(-?\d+\.\d+)/);

            if (match) {
                $('#latitud').val(match[1]);
                $('#longitud').val(match[2]);
                alert('Coordenadas obtenidas correctamente');
            } else {
                alert(
                    'No se pudieron extraer las coordenadas.\n\nAsegúrate de copiar la URL completa desde la barra de direcciones.');
            }
        }

        // Ahora sí el $(document).ready
        $(document).ready(function() {
            // Limpiar formulario al cerrar modal
            $('#exampleModalgrid').on('hidden.bs.modal', function() {
                $('#addForm')[0].reset();
            });

            // Enviar formulario
            $('#addForm').submit(function(e) {
                e.preventDefault();
                $('.addBtn').prop('disabled', true);

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.sucursales.registrar') }}",
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
                    },
                    error: function(xhr) {
                        alert('Error al registrar la sucursal');
                        $('.addBtn').prop('disabled', false);
                    }
                });
            });

            //modificar
            $('#showModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var sucursal = button.data('bs-obj');

                var modal = $(this);
                modal.find('#updateId').val(sucursal.id);
                modal.find('#nombre').val(sucursal.nombre);
                modal.find('#direccion').val(sucursal.direccion);
            });

            $('#updateForm').submit(function(e) {
                e.preventDefault();
                $('.updateBtn').prop('disabled', true);

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.sucursales.editar') }}",
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
                $('#deleteSucursalId').val(id);
            });

            $('#deleteForm').submit(function(e) {
                e.preventDefault();
                $('.btnDelete').prop('disabled', true);

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.sucursales.eliminar') }}",
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
