@extends('layouts.admin-layout')
@section('contenido')
    <div class="row">
        <div class="card shadow-sm border rounded-3">
            <div class="card-header bg-soft-primary position-relative d-flex align-items-center">
                <h4 class="card-title text-uppercase fw-bold mb-0 mx-auto">
                    Lista de categorías
                </h4>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                    Registrar Categoría
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($categorias as $categoria)
            <div class="col-xl-4 col-md-6">
                <div class="card card-height-100">

                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">{{ $categoria->nombre }}</h4>
                        <div class="flex-shrink-0">
                            <a href="#" class="btn btn-success btn-icon waves-effect waves-light"
                                title="Ir a detalles del producto" data-bs-toggle="modal"
                                data-bs-target=".bs-edit-modal-dialog">
                                <i data-feather="plus"></i>
                            </a>

                            <button type="button" class="btn btn-warning btn-icon waves-effect waves-light editBtn"
                                title="Editar categoría" data-bs-obj='@json($categoria)' data-bs-toggle="modal"
                                data-bs-target=".bs-edit-modal-lg">
                                <i data-feather="edit-2"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <div class="bg-info-subtle rounded p-2 mb-3">
                            <img src="{{ asset('storage/' . $categoria->imagen) }}" alt="{{ $categoria->nombre }}"
                                class="img-fluid rounded" style="max-height: 210px;">
                        </div>
                        <h5>
                            <p>
                                Descripción: {{ $categoria->descripcion }}
                            </p>
                        </h5>
                        <a href="{{-- route('admin.productos.vertodos', ['id' => $categoria->id, $categoria->tipo]) --}}" class="btn btn-info  waves-effect waves-light"
                            title="Ir a detalles del producto">
                            <i data-feather="eye"></i>Todos los productos
                        </a>

                        <a href="#" class="btn btn-primary btn-icon waves-effect waves-light"
                            title="Ir a detalles del producto">
                            <i data-feather="eye"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>


    <!--modal de registrar-->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-soft-success justify-content-center position-relative">
                    <h3 class="modal-title text-uppercase fw-bold text-success-emphasis text-center w-100"
                        id="myExtraLargeModalLabel">
                        <i class="ri-folder-add-line me-1"></i> Registrar Nueva Categoría
                    </h3>
                    <button type="button" class="btn-close position-absolute end-0 top-50 translate-middle-y me-3"
                        data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <!-- Cuerpo del modal -->
                <div class="modal-body">
                    <form action="" id="addForm" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Nombre de categoría" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Tipo</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="tipo"
                                                    id="tipo_detallado" value="detallado" required>
                                                <label class="form-check-label" for="tipo_detallado">
                                                    Ropa
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="tipo"
                                                    id="tipo_no_detallado" value="no detallado">
                                                <label class="form-check-label" for="tipo_no_detallado">
                                                    Otros
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="imagen" class="form-label">Imagen</label>
                                    <input class="form-control" type="file" id="imagen" accept="image/*"
                                        name="imagen">
                                </div>
                            </div>
                           
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" rows="3" name="descripcion"
                                        placeholder="Introducir descripción del producto" required></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Sucursales</label>
                                    <div class="d-flex flex-wrap">
                                        @foreach ($sucursales as $sucursal)
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="checkbox" name="sucursales[]"
                                                    id="sucursal_{{ $sucursal->id }}" value="{{ $sucursal->id }}">
                                                <label class="form-check-label" for="sucursal_{{ $sucursal->id }}">
                                                    {{ $sucursal->nombre }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn bg-danger" data-bs-dismiss="modal"
                                style="color: white;">Cerrar</button>
                            <button type="submit" class="btn bg-success addBtn" style="color: white;">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--modal de editar-->
    <div class="modal fade bs-edit-modal-lg" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-soft-warning justify-content-center position-relative">
                    <h3 class="modal-title text-uppercase fw-bold text-warning-emphasis text-center w-100"
                        id="myExtraLargeModalLabel">
                        <i class="ri-folder-add-line me-1"></i> Editar Categoría
                    </h3>
                    <button type="button" class="btn-close position-absolute end-0 top-50 translate-middle-y me-3"
                        data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <!-- Cuerpo del modal -->
                <div class="modal-body">
                    <form action="" id="updateForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <input type="hidden" id="editId" name="id">
                                    <label for="editNombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="editNombre" name="nombre"
                                        placeholder="Nombre de categoría">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Tipo</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="tipo"
                                                    id="edit_tipo_detallado" value="detallado">
                                                <label class="form-check-label" for="edit_tipo_detallado">
                                                    Ropa
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="tipo"
                                                    id="edit_tipo_no_detallado" value="no detallado">
                                                <label class="form-check-label" for="edit_tipo_no_detallado">
                                                    Otros
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="editImagen" class="form-label">Imagen</label>
                                    <input class="form-control" type="file" id="editImagen" accept="image/*"
                                        name="imagen">
                                    <img id="editPreview" src="" alt="Imagen actual" class="mt-2 rounded"
                                        style="max-height: 100px; display: none;">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="editDescripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="editDescripcion" rows="3" name="descripcion"
                                        placeholder="Introducir descripción del producto"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Sucursales</label>
                                    <div class="d-flex flex-wrap" id="editSucursalesCheckboxes">
                                        @foreach ($sucursales as $sucursal)
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="checkbox" name="sucursales[]"
                                                    id="edit_sucursal_{{ $sucursal->id }}" value="{{ $sucursal->id }}">
                                                <label class="form-check-label" for="edit_sucursal_{{ $sucursal->id }}">
                                                    {{ $sucursal->nombre }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn bg-danger" data-bs-dismiss="modal"
                                style="color: white;">Cerrar</button>
                            <button type="submit" class="btn bg-warning updateBtn"
                                style="color: white;">Actualizar</button>
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
                    url: "{{ route('admin.categorias.registrar') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res.message);
                        if (res.success) {
                            $('#addForm')[0].reset(); // Limpiar el formulario
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseJSON?.message ||
                            'Error al procesar la solicitud';
                        alert(errorMessage);
                    },
                    complete: function() {
                        $('.addBtn').prop('disabled', false);
                    }
                });
            });

            //modificar
            $('.editBtn').click(function() {
                var data = $(this).data('bs-obj');
                console.log(data);

                $('#editId').val(data.id);
                $('#editNombre').val(data.nombre);
                $('#editDescripcion').val(data.descripcion);
                $('#editSucursalesCheckboxes input[type="checkbox"]').prop('checked', false);
                
                if (data.sucursales && Array.isArray(data.sucursales)) {
                    data.sucursales.forEach(function(sucursal) {
                        $('#edit_sucursal_' + sucursal.id).prop('checked', true);
                    });
                }

                if (data.tipo === 'detallado') {
                    $('#edit_tipo_detallado').prop('checked', true);
                } else {
                    $('#edit_tipo_no_detallado').prop('checked', true);
                }

                // Mostrar la imagen actual
                if (data.imagen) {
                    $('#editPreview').attr('src', '/storage/' + data.imagen).show();
                } else {
                    $('#editPreview').hide();
                }

                // Limpiar el input file
                $('#editImagen').val('');
            });

            $('#updateForm').submit(function(e) {
                e.preventDefault();
                $('.updateBtn').prop('disabled', true);

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.categorias.editar') }}",
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
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseJSON?.message ||
                            'Error al procesar la solicitud';
                        alert(errorMessage);
                        $('.updateBtn').prop('disabled', false);
                    }
                });
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
