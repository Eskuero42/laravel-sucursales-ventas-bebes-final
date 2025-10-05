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

                        <div class="row">
                            @if ($sucursales->isNotEmpty())
                                @foreach ($sucursales as $n => $sucursal)
                                    <div class="col-xl-6 col-xxl-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <!-- Header -->
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1">
                                                        <h5 class="card-title mb-1 text-primary">{{ $sucursal->nombre }}
                                                        </h5>
                                                        <p class="text-muted mb-0">ID: {{ $sucursal->id }}</p>
                                                    </div>
                                                    <span class="badge bg-primary rounded-pill">#{{ $n + 1 }}</span>
                                                </div>

                                                <!-- Dirección -->
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-start">
                                                        <i class="ri-map-pin-2-line text-danger me-2 mt-1"></i>
                                                        <div>
                                                            <p class="mb-1 fw-medium">{{ $sucursal->direccion }}</p>
                                                            <small class="text-muted">
                                                                <i class="ri-map-pin-line align-middle"></i>
                                                                {{ $sucursal->latitud }}, {{ $sucursal->longitud }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Acciones -->
                                                <div class="d-flex gap-2 flex-wrap">
                                                    <a href="{{ route('admin.sucursales.ver', $sucursal->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="ri-eye-line align-middle me-1"></i> Ver
                                                    </a>

                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#showModal" data-id="{{ $sucursal->id }}"
                                                        data-nombre="{{ $sucursal->nombre }}"
                                                        data-direccion="{{ $sucursal->direccion }}"
                                                        data-latitud="{{ $sucursal->latitud }}"
                                                        data-longitud="{{ $sucursal->longitud }}">
                                                        <i class="ri-edit-line align-middle me-1"></i> Editar
                                                    </button>

                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#modalHorarios"
                                                        data-sucursal='@json($sucursal->load('horarios'))'>
                                                        <i class="ri-time-line align-middle me-1"></i> Horarios
                                                    </button>

                                                    <button class="btn btn-sm btn-danger deleteBtn"
                                                        data-bs-id="{{ $sucursal->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#deleteRecordModal">
                                                        <i class="ri-delete-bin-line align-middle me-1"></i> Eliminar
                                                    </button>
                                                </div>
                                                <!-- Mapa -->
                                                <div class="mb-3 mt-3">
                                                    <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow-sm">
                                                        <iframe
                                                            src="https://www.google.com/maps?q={{ $sucursal->latitud }},{{ $sucursal->longitud }}&hl=es;z=15&output=embed"
                                                            width="100%" height="140" style="border:0;"
                                                            allowfullscreen="" loading="lazy">
                                                        </iframe>
                                                    </div>
                                                </div>

                                                <!-- Horarios -->
                                                <div class="mb-4">
                                                    <h6 class="fs-14 mb-3 border-bottom pb-2">Horarios de atención</h6>
                                                    @if ($sucursal->horarios->isNotEmpty())
                                                        <div class="row g-0">
                                                            <div class="col-12 col-sm-6">
                                                                <!-- Días -->
                                                                @foreach ($sucursal->horarios as $horario)
                                                                    <div class="mb-2">
                                                                        <span class="text-capitalize fw-semibold fs-13">
                                                                            {{ $horario->dia_semana }}
                                                                        </span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <!-- Horarios -->
                                                                @foreach ($sucursal->horarios as $horario)
                                                                    <div class="mb-2">
                                                                        @if ($horario->cerrado)
                                                                            <span
                                                                                class="badge bg-danger-subtle text-danger fs-12">Cerrado</span>
                                                                        @else
                                                                            <span
                                                                                class="badge bg-success-subtle text-success fs-12">
                                                                                {{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}
                                                                                -
                                                                                {{ \Carbon\Carbon::parse($horario->hora_fin)->format('H:i') }}
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="text-muted fs-13">Sin horarios configurados</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body text-center text-muted py-5">
                                            <i class="ri-store-2-line fs-1 d-block mb-3"></i>
                                            <h5 class="mb-2">No hay sucursales registradas</h5>
                                            <p class="mb-0">Comienza agregando tu primera sucursal</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!--
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
                                                                                                                        <-- end pagination -->
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
        <div class="modal-dialog modal-xl">
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

                                <!-- Ubicación -->
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
                            </div>

                            <!-- Columna Derecha - Horarios -->
                            <div class="col-md-6">
                                <h6 class="fw-semibold mb-3 text-success">
                                    <i class="ri-time-line me-1"></i> Horarios por Día
                                </h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Día</th>
                                                <th>Hora Inicio</th>
                                                <th>Hora Fin</th>
                                                <th class="text-center">Cerrado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'] as $dia)
                                                <tr>
                                                    <td class="align-middle fw-semibold text-capitalize">
                                                        {{ $dia }}</td>
                                                    <td>
                                                        <input type="time"
                                                            name="horarios[{{ $dia }}][hora_inicio]"
                                                            class="form-control form-control-sm hora-input-{{ $dia }}"
                                                            value="08:00">
                                                    </td>
                                                    <td>
                                                        <input type="time"
                                                            name="horarios[{{ $dia }}][hora_fin]"
                                                            class="form-control form-control-sm hora-input-{{ $dia }}"
                                                            value="18:00">
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="checkbox"
                                                            name="horarios[{{ $dia }}][cerrado]"
                                                            class="form-check-input cerrado-checkbox"
                                                            data-dia="{{ $dia }}" value="1">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="alert alert-info border-0 bg-info-subtle mt-2">
                                    <small>
                                        <strong>Nota:</strong> Marca "Cerrado" para los días que la sucursal no opera.
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
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-3 shadow-lg border-3">
                <div class="modal-header bg-warning-subtle border-0">
                    <h5 class="modal-title text-warning fw-bold d-flex align-items-center" id="showModalLabel">
                        <i class="ri-edit-2-line me-2"></i> Editar Sucursal
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="updateForm">
                        @csrf
                        <input type="hidden" name="id" id="updateId">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nombre</label>
                            <input type="text" name="nombre" id="editNombre"
                                class="form-control border-warning-subtle" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Dirección</label>
                            <textarea name="direccion" id="editDireccion" class="form-control border-warning-subtle" rows="2" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label fw-semibold">Latitud</label>
                                <input type="text" name="latitud" id="editLatitud"
                                    class="form-control border-warning-subtle">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label fw-semibold">Longitud</label>
                                <input type="text" name="longitud" id="editLongitud"
                                    class="form-control border-warning-subtle">
                            </div>
                        </div>

                        <div class="text-end pt-3">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-warning updateBtn">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar horarios -->
    <div class="modal fade" id="modalHorarios" tabindex="-1" aria-labelledby="modalHorariosLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-3 shadow-lg border-3">
                <div class="modal-header bg-info-subtle border-0">
                    <h5 class="modal-title text-info fw-bold" id="modalHorariosLabel">
                        <i class="ri-time-line me-2"></i> Editar Horarios
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formHorarios">
                        @csrf
                        <input type="hidden" name="id" id="horariosSucursalId">

                        <table class="table table-bordered table-sm text-center">
                            <thead class="table-info">
                                <tr>
                                    <th>Día</th>
                                    <th>Hora de inicio</th>
                                    <th>Hora de fin</th>
                                    <th>Cerrado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'] as $dia)
                                    <tr>
                                        <td>{{ $dia }}</td>
                                        <td><input type="time" name="horarios[{{ $dia }}][hora_inicio]"
                                                id="horaInicio_{{ $dia }}" class="form-control form-control-sm">
                                        </td>
                                        <td><input type="time" name="horarios[{{ $dia }}][hora_fin]"
                                                id="horaFin_{{ $dia }}" class="form-control form-control-sm">
                                        </td>
                                        <td><input type="checkbox" name="horarios[{{ $dia }}][cerrado]"
                                                id="cerrado_{{ $dia }}" value="1"
                                                class="form-check-input"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="text-end pt-3">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-info updateHorariosBtn">Guardar</button>
                        </div>
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
                    'Link acortado detectado.\n\nPor favor:\n1. Abre ese link en tu navegador\n2. Cuando cargue, copia la URL COMPLETA de la barra de direcciones\n3. Pégala aquí'
                );
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
                    'No se pudieron extraer las coordenadas.\n\nAsegúrate de copiar la URL completa desde la barra de direcciones.'
                );
            }
        }

        // Ahora sí el $(document).ready
        $(document).ready(function() {

            // Deshabilitar campos de hora cuando se marca "Cerrado"
            $('.cerrado-checkbox').on('change', function() {
                var dia = $(this).data('dia');
                var horaInputs = $('.hora-input-' + dia);

                if ($(this).is(':checked')) {
                    horaInputs.prop('disabled', true).val('');
                } else {
                    horaInputs.prop('disabled', false);
                }
            });

            // Limpiar formulario al cerrar modal
            $('#exampleModalgrid').on('hidden.bs.modal', function() {
                $('#addForm')[0].reset();
                // Re-habilitar todos los campos de hora
                $('.cerrado-checkbox').each(function() {
                    var dia = $(this).data('dia');
                    $('.hora-input-' + dia).prop('disabled', false);
                });
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
                        var errorMsg = xhr.responseJSON?.message ||
                            'Error al registrar la sucursal';
                        alert(errorMsg);
                        $('.addBtn').prop('disabled', false);
                    }
                });
            });

            $('#showModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                $('#updateId').val(button.data('id'));
                $('#editNombre').val(button.data('nombre'));
                $('#editDireccion').val(button.data('direccion'));
                $('#editLatitud').val(button.data('latitud'));
                $('#editLongitud').val(button.data('longitud'));
            });

            $('#updateForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.sucursales.editar') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res.message);
                        if (res.success) location.reload();
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

            // Abrir modal y setear ID
            $('#modalHorarios').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var sucursal = button.data('sucursal');

                $('#horariosSucursalId').val(sucursal.id);

                // Limpiar primero todos los campos
                ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'].forEach(function(
                    dia) {
                    $('#horaInicio_' + dia).val('');
                    $('#horaFin_' + dia).val('');
                    $('#cerrado_' + dia).prop('checked', false);
                });

                // Llenar con los horarios existentes
                if (sucursal.horarios) {
                    sucursal.horarios.forEach(function(h) {
                        // Convertir la primera letra a mayúscula
                        var dia = h.dia_semana.charAt(0).toUpperCase() + h.dia_semana.slice(1)
                            .toLowerCase();

                        $('#horaInicio_' + dia).val(h.hora_inicio);
                        $('#horaFin_' + dia).val(h.hora_fin);
                        $('#cerrado_' + dia).prop('checked', h.cerrado);
                    });
                }
            });

            // Enviar horarios
            $('#formHorarios').submit(function(e) {
                e.preventDefault();
                $('.updateHorariosBtn').prop('disabled', true);

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.sucursales.editarHorarios') }}",
                    type: "POST",
                    data: formData,
                    success: function(res) {
                        $('.updateHorariosBtn').prop('disabled', false);

                        if (res.success) {
                            // Usamos alert del navegador
                            alert(res.message);
                            // Al aceptar, recargamos la página
                            location.reload();
                        } else {
                            alert("Error: " + res.message);
                        }
                    },
                    error: function(xhr) {
                        $('.updateHorariosBtn').prop('disabled', false);
                        alert("Hubo un problema al actualizar los horarios.");
                    }
                });
            });
        });
    </script>
@endpush
