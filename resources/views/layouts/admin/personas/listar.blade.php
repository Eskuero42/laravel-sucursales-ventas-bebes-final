@extends('layouts.admin-layout')

@section('contenido')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Lista de Personas</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#exampleModalgrid"><i
                                            class="ri-add-line align-bottom me-1"></i>Registar Nueva Persona
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
                                        <th>#</th>
                                        <th>Carnet</th>
                                        <th>Nombre Completo</th>
                                        <th>Apellidos</th>
                                        <th>Correo</th>
                                        <th>Celular</th>
                                        <th>Direccion</th>
                                        <th>Ciudad</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($personas as $n => $persona)
                                        <tr>
                                            <td>{{ $n + 1 }}</td>
                                            <td>{{ $persona->carnet }}</td>
                                            <td>{{ $persona->nombres }}</td>
                                            <td>{{ $persona->apellidos }}</td>
                                            <td>{{ $persona->correo }}</td>
                                            <td>{{ $persona->celular }}</td>
                                            <td>{{ $persona->direccion }}</td>
                                            <td>{{ $persona->ciudad->nombre }}</td>
                                            <td class="status"><span
                                                    class="badge bg-success-subtle text-success text-uppercase">Activo</span>
                                            </td>
                                            <td class="text-nowrap align-middle">
                                                <a href="{{ route('admin.personas.ver') }}"
                                                    class="btn btn-icon btn-soft-info btn-sm waves-effect waves-light me-1"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Ver detalles">
                                                    <i class="ri-eye-line fs-16"></i>
                                                </a>

                                                <button type="button"
                                                    class="btn btn-icon btn-soft-warning btn-sm waves-effect waves-light editBtn"
                                                    data-bs-obj='@json($persona)' data-bs-toggle="modal"
                                                    data-bs-target="#editModalgrid" title="Editar">
                                                    <i class="ri-edit-2-line fs-16"></i>
                                                </button>
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


    <!-- Modal para registrar Personas -->
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
                    <form id="addForm" action="javascript:void(0);">
                        @csrf
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <label class="form-label fw-semibold">Carnet</label>
                                <input type="text" name="carnet" class="form-control border-success-subtle"
                                    placeholder="Ingrese su carnet" required>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label fw-semibold">Nombres</label>
                                <input type="text" name="nombres" class="form-control border-success-subtle"
                                    placeholder="Ingrese su nombre" required>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label fw-semibold">Apellidos</label>
                                <input type="text" name="apellidos" class="form-control border-success-subtle"
                                    placeholder="Ingrese sus apellidos" required>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label fw-semibold">Correo</label>
                                <input type="email" name="correo" class="form-control border-success-subtle"
                                    placeholder="filmo@gmail.com" required>

                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label fw-semibold">Celular</label>
                                <input type="text" name="celular" class="form-control border-success-subtle"
                                    placeholder="Ingrese su número" required>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label fw-semibold">Dirección</label>
                                <input type="text" name="direccion" class="form-control border-success-subtle"
                                    placeholder="Ingrese su dirección">
                            </div>
                            <div class="col-xxl-12">
                                <label class="form-label fw-semibold">Seleccione Ciudad</label>
                                <select name="ciudad_id" class="form-select border-success-subtle" required>
                                    <option value="" selected disabled>Seleccione una ciudad</option>
                                    @foreach ($ciudades as $ciudad)
                                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
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

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar Personas -->
    <div class="modal fade" id="editModalgrid" tabindex="-1" aria-labelledby="editModalgridLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content border-3 shadow-lg rounded-3">
                <div class="modal-header bg-light border-0">
                    <h5 class="modal-title text-warning fw-bold d-flex align-items-center" id="editModalgridLabel">
                        <i class="ri-edit-2-line me-2"></i> Editar Datos
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" action="javascript:void(0);">
                        @csrf
                        <div class="row g-3">
                            <input type="hidden" name="id" id="updateId">
                            <div class="col-xxl-6">
                                <label class="form-label fw-semibold">Carnet</label>
                                <input type="text" id="carnet" name="carnet"
                                    class="form-control border-warning-subtle" placeholder="Ingrese su carnet" required>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label fw-semibold">Nombres</label>
                                <input type="text" id="nombres" name="nombres"
                                    class="form-control border-warning-subtle" placeholder="Ingrese su nombre" required>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label fw-semibold">Apellidos</label>
                                <input type="text" id="apellidos" name="apellidos"
                                    class="form-control border-warning-subtle" placeholder="Ingrese sus apellidos"
                                    required>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label fw-semibold">Correo</label>
                                <input type="email" id="correo" name="correo"
                                    class="form-control border-warning-subtle" placeholder="filmo@gmail.com">
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label fw-semibold">Celular</label>
                                <input type="text" id="celular" name="celular"
                                    class="form-control border-warning-subtle" placeholder="Ingrese su número" required>
                            </div>
                            <div class="col-xxl-6">
                                <label class="form-label fw-semibold">Dirección</label>
                                <input type="text" id="direccion" name="direccion"
                                    class="form-control border-warning-subtle" placeholder="Ingrese su dirección">
                            </div>
                            <div class="col-xxl-12">
                                <label class="form-label fw-semibold">Seleccione Ciudad</label>
                                <select id="ciudad_id" name="ciudad_id" class="form-select border-warning-subtle"
                                    required>
                                    <option value="" selected disabled>Seleccione una ciudad</option>
                                    @foreach ($ciudades as $ciudad)
                                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                        </div>
                    </form>
                </div>
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
                    url: "{{ route('admin.personas.registrar') }}",
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
                $('#carnet').val(data.carnet);
                $('#nombres').val(data.nombres);
                $('#apellidos').val(data.apellidos);
                $('#correo').val(data.correo);
                $('#celular').val(data.celular);
                $('#direccion').val(data.direccion);
                $('#ciudad_id').val(data.ciudad_id);
            });

            $('#updateForm').submit(function(e) {
                e.preventDefault();
                $('.updateBtn').prop('disabled', true);

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.personas.editar') }}",
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
        });
    </script>
@endpush
