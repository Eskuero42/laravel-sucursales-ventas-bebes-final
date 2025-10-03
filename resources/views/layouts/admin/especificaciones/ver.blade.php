@extends('layouts.admin-layout')

@section('contenido')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Especificaciones</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                        <li class="breadcrumb-item active">Especificaciones</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Especificaciones por Tipo</h5>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#exampleModalgrid">
                        <i class="ri-add-line align-bottom me-1"></i> Registrar Especificación
                    </button>
                </div>
                <div class="card-body">
                    @if ($especificaciones->isEmpty())
                        <div class="alert alert-info">No hay especificaciones registradas.</div>
                    @else
                        <!-- Tabs -->
                        <ul class="nav nav-tabs mb-3" id="especificacionesTabs" role="tablist">
                            @foreach ($especificaciones as $nombreTipo => $items)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                        id="tab-{{ Str::slug($nombreTipo) }}-tab" data-bs-toggle="tab"
                                        data-bs-target="#tab-{{ Str::slug($nombreTipo) }}" type="button" role="tab"
                                        aria-controls="tab-{{ Str::slug($nombreTipo) }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $nombreTipo }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Contenido de los Tabs -->
                        <div class="tab-content" id="especificacionesTabsContent">
                            @foreach ($especificaciones as $nombreTipo => $items)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="tab-{{ Str::slug($nombreTipo) }}" role="tabpanel"
                                    aria-labelledby="tab-{{ Str::slug($nombreTipo) }}-tab">

                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Descripción</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($items as $n => $especificacion)
                                                    <tr>
                                                        <td>{{ $n + 1 }}</td>
                                                        <td>
                                                            @if ($nombreTipo === 'Colores')
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <span class="d-inline-block rounded-circle border"
                                                                        style="width: 20px; height: 20px; background-color: {{ $especificacion->descripcion }};"
                                                                        title="{{ $especificacion->descripcion }}"></span>
                                                                    <span
                                                                        class="text-muted">{{ $especificacion->descripcion }}</span>
                                                                </div>
                                                            @else
                                                                {{ $especificacion->descripcion }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <button
                                                                    class="btn btn-warning btn-icon waves-effect waves-light editBtn"
                                                                    data-bs-obj='@json($especificacion)'
                                                                    data-bs-toggle="modal" data-bs-target="#showModal">
                                                                    <i data-feather="edit-2"></i>
                                                                </button>

                                                                <button
                                                                    class="btn btn-danger btn-icon waves-effect waves-light deleteBtn"
                                                                    data-bs-id="{{ $especificacion->id }}"
                                                                    data-bs-toggle="modal"
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
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <!-- Modal para registrar Especificaion -->
    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content border-3 shadow-lg rounded-3">
                <div class="modal-header bg-light border-0">
                    <h5 class="modal-title text-success fw-bold d-flex align-items-center" id="exampleModalgridLabel">
                        <i class="ri-layout-grid-line me-2"></i> Registro de Datos
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" action="javascript:void(0);" method="post">
                        @csrf
                        <div class="row g-3">


                            <div class="col-xxl-12">
                                <label for="tipo_id" class="form-label fw-semibold">Seleccione Tipo</label>
                                <select name="tipo_id" id="tipo_id" class="form-select border-success-subtle" required>

                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" data-tipo-nombre="{{ $tipo->nombre }}">
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Campo de descripción (siempre presente, pero puede ocultarse si es color) -->
                            <div class="col-xxl-12" id="descripcionField">
                                <label for="descripcionText" class="form-label fw-semibold">Descripción</label>
                                <input type="text" name="descripcion" class="form-control border-success-subtle"
                                    id="descripcionText" placeholder="Ingrese su descripción">
                            </div>

                            <!-- Selector de color (solo para tipo 'Colores') -->
                            <div class="col-xxl-12" id="colorField" style="display: none;">
                                <label class="form-label">Color</label>
                                <div class="d-flex align-items-center gap-2">
                                    <input type="color" id="colorPicker" class="form-control form-control-color"
                                        style="width: 50px; height: 40px;" value="#000000">

                                    <input type="text" id="colorHexInput" class="form-control" value="#000000"
                                        placeholder="#000000" maxlength="7" readonly>
                                    <div id="color-preview"
                                        style="width: 30px; height: 30px; border: 1px solid #ccc; background-color: #000000;">
                                    </div>
                                </div>
                                <div class="form-text">Selecciona un color desde la paleta.</div>
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
    <!-- Modal para editar Especificaciones -->
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
                                    <label for="firstName" class="form-label fw-semibold">Descripción</label>
                                    <input type="text" id="descripcion" name="descripcion"
                                        class="form-control border-warning-subtle" placeholder="Ingrese su descripción"
                                        required>
                                </div>
                            </div>
                            <div class="col-xxl-12">
                                <div>
                                    <label for="tipo_id" class="form-label fw-semibold">Seleccione Tipo</label>
                                    <select id="tipo_id" name="tipo_id" class="form-select border-warning-subtle"
                                        required>
                                        <option disabled selected>Seleccione una opción</option>
                                        {{-- ejemplo de opciones dinámicas --}}
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                        @endforeach
                                    </select>
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
    <!-- Modal para eliminar Especificaciones -->
    <div class="modal fade" id="deleteRecordModal" tabindex="-1" aria-labelledby="deleteRecordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content border-3 rounded-3 shadow-lg">
                <form id="deleteForm" action="">
                    @csrf<input type="hidden" name="id" id="deleteCategoriaId">
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
                    url: "{{ route('admin.especificaciones.registrar') }}",
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
                $('#descripcion').val(data.descripcion);
            });

            $('#updateForm').submit(function(e) {
                e.preventDefault();
                $('.updateBtn').prop('disabled', true);

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.especificaciones.editar') }}",
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
                    url: "{{ route('admin.especificaciones.eliminar') }}",
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


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipoSelect = document.getElementById('tipo_id');
            const descripcionField = document.getElementById('descripcionField');
            const colorField = document.getElementById('colorField');
            const descripcionText = document.getElementById('descripcionText'); // el que se envía
            const colorPicker = document.getElementById('colorPicker');
            const colorHexInput = document.getElementById('colorHexInput');
            const colorPreview = document.getElementById('color-preview');

            function toggleFields() {
                const selectedOption = tipoSelect.options[tipoSelect.selectedIndex];
                const tipoNombre = selectedOption ? selectedOption.dataset.tipoNombre : '';

                if (tipoNombre === 'Colores') {
                    // Mostrar selector de color, ocultar input de texto
                    colorField.style.display = 'block';
                    descripcionField.style.display = 'none';

                    // Asegurar que el valor del color se copie al campo que se envía
                    const colorValue = colorPicker.value;
                    descripcionText.value = colorValue;
                    colorHexInput.value = colorValue;
                    colorPreview.style.backgroundColor = colorValue;
                } else {
                    // Mostrar input de texto, ocultar color
                    descripcionField.style.display = 'block';
                    colorField.style.display = 'none';

                    // ✅ LIMPIAR el campo de descripción para que el usuario escriba desde cero
                    descripcionText.value = '';

                    // Opcional: resetear el picker (visual)
                    colorPicker.value = '#000000';
                    colorHexInput.value = '#000000';
                    colorPreview.style.backgroundColor = '#000000';
                }
            }

            // Cuando cambia el color, actualizar descripcionText
            colorPicker.addEventListener('input', function() {
                const colorValue = this.value;
                descripcionText.value = colorValue;
                colorHexInput.value = colorValue;
                colorPreview.style.backgroundColor = colorValue;
            });

            // Cuando cambia el tipo
            tipoSelect.addEventListener('change', toggleFields);

            // Inicializar
            toggleFields();
        });
    </script>
@endpush