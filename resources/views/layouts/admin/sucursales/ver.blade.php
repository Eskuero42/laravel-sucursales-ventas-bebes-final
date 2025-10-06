@extends('layouts.admin-layout')
@section('contenido')
    <div class="row">
        <div class="card shadow-sm border rounded-3">
            <div class="card-header bg-soft-primary position-relative d-flex align-items-center">
                <h4 class="card-title text-uppercase fw-bold mb-0 mx-auto">
                    Lista de categorías de {{ $sucursal->nombre }}
                </h4>

                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl"
                    data-sucursal-id="{{ $sucursal->id }}">
                    Asociar categorías
                </button>

                &nbsp;
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#modalRegistrarCategoria">
                    Registrar Categoría
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($sucursal->sucursal_categorias as $s_c)
            @if ($s_c->categoria && !$s_c->categoria->categoria_id)
                <div class="col-xl-4 col-md-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">
                                {{ $s_c->categoria->nombre ?? 'Categoría sin nombre' }}
                            </h4>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-warning btn-icon waves-effect waves-light editBtn"
                                    title="Editar categoría" data-bs-obj='@json($s_c->categoria)'
                                    data-bs-toggle="modal" data-bs-target=".bs-edit-modal-lg">
                                    <i data-feather="edit-2"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <div class="bg-info-subtle rounded p-2 mb-3">
                                <img src="{{ asset($s_c->categoria->imagen) }}" alt="{{ $s_c->categoria->nombre }}"
                                    class="img-fluid rounded" style="max-height: 210px;">
                            </div>
                            <h5>
                                <p>
                                    Descripción: {{ $s_c->categoria->descripcion }}
                                </p>
                            </h5>
                            <a href="{{ route('admin.sucursales.categorias.productos.ver', $s_c->id) }}"
                                class="btn btn-info waves-effect waves-light" title="Ir a detalles del producto">
                                <i data-feather="eye"></i> Todos los productos
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!--modal de registrar-->
    <div class="modal fade" id="modalRegistrarCategoria" tabindex="-1" aria-labelledby="modalRegistrarCategoriaLabel"
        aria-modal="true">
        <div class="modal-dialog"><!-- delgado como el ejemplo -->
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-success-emphasis" id="modalRegistrarCategoriaLabel">
                        <i class="ri-folder-add-line me-1"></i> Registrar Nueva Categoría
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <form action="" id="addForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="sucursales[]" value="{{ $sucursal->id }}">
                        <div class="row g-3">
                            <!-- Nombre -->
                            <div class="col-lg-12">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="Nombre de categoría" required>
                            </div>

                            <!-- Tipo -->
                            <div class="col-lg-12">
                                <label class="form-label">Tipo</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo" id="tipo_detallado"
                                            value="detallado" required>
                                        <label class="form-check-label" for="tipo_detallado">Ropa</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo" id="tipo_no_detallado"
                                            value="no detallado">
                                        <label class="form-check-label" for="tipo_no_detallado">Otros</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Imagen -->
                            <div class="col-lg-12">
                                <label for="imagen" class="form-label">Imagen</label>
                                <input class="form-control" type="file" id="imagen" accept="image/*" name="imagen"
                                    required>
                            </div>

                            <!-- Descripción -->
                            <div class="col-lg-12">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" rows="3" name="descripcion"
                                    placeholder="Introducir descripción del producto" required></textarea>
                            </div>

                            <!-- Botones -->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success addBtn">Agregar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> <!-- modal-body -->
            </div>
        </div>
    </div>

    <!--modal de editar-->
    <div class="modal fade" id="modalReegistrarCategoria" tabindex="-1" aria-labelledby="modalReegistrarCategoriaLabel"
        aria-modal="true">
        <div class="modal-dialog modal-lg"><!-- sigue siendo grande -->
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-success-emphasis" id="modalReegistrarCategoriaLabel">
                        <i class="ri-folder-add-line me-1"></i> Registrar Nueva Categoría
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <!-- Body con grid -->
                <div class="modal-body">
                    <form action="" id="editForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="sucursal" value="{{ $sucursal->id }}">

                        <div class="row g-3">
                            <!-- Nombre -->
                            <div class="col-lg-12">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="Nombre de categoría" required>
                            </div>

                            <!-- Tipo -->
                            <div class="col-lg-12">
                                <label class="form-label">Tipo</label>
                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipo"
                                            id="tipo_detallado" value="detallado" required>
                                        <label class="form-check-label" for="tipo_detallado">
                                            Ropa
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipo"
                                            id="tipo_no_detallado" value="no detallado">
                                        <label class="form-check-label" for="tipo_no_detallado">
                                            Otros
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Imagen -->
                            <div class="col-lg-12">
                                <label for="imagen" class="form-label">Imagen</label>
                                <input class="form-control" type="file" id="imagen" accept="image/*"
                                    name="imagen" required>
                            </div>

                            <!-- Descripción -->
                            <div class="col-lg-12">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" rows="3" name="descripcion"
                                    placeholder="Introducir descripción del producto" required></textarea>
                            </div>

                            <!-- Footer de botones -->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success addBtn">Agregar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> <!-- modal-body -->
            </div>
        </div>
    </div>

    <!--modal de asociar-->
    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="asociarForm">
                    @csrf
                    <input type="hidden" name="sucursal_id" value="{{ $sucursal->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Asociar categorías a la sucursal
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="accordion" id="accordionCategorias">
                            @foreach ($categoriasPadre as $categoria)
                                <div class="col-md-6">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $categoria->id }}">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input me-2" type="checkbox" name="categorias[]"
                                                    value="{{ $categoria->id }}"
                                                    {{ in_array($categoria->id, $categoriasAsociadas) ? 'checked' : '' }}>
                                                <label class="accordion-button collapsed mb-0" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $categoria->id }}" aria-expanded="false"
                                                    aria-controls="collapse{{ $categoria->id }}">
                                                    {{ $categoria->nombre }}
                                                </label>
                                            </div>
                                        </h2>
                                        <div id="collapse{{ $categoria->id }}" class="accordion-collapse collapse"
                                            aria-labelledby="heading{{ $categoria->id }}"
                                            data-bs-parent="#accordionCategorias">
                                            <div class="accordion-body ps-5">
                                                @foreach ($categoria->categorias_hijosRecursive as $subcategoria)
                                                    <div class="form-check ms-2" style="margin-left: 20px;">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="categorias[]" value="{{ $subcategoria->id }}"
                                                            data-padre-id="{{ $categoria->id }}"
                                                            {{ in_array($subcategoria->id, $categoriasAsociadas) ? 'checked' : '' }}>
                                                        <label
                                                            class="form-check-label">{{ $subcategoria->nombre }}</label>
                                                    </div>
                                                    @foreach ($subcategoria->categorias_hijosRecursive as $subsubcategoria)
                                                        <div class="form-check ms-3" style="margin-left: 40px;">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="categorias[]" value="{{ $subsubcategoria->id }}"
                                                                data-padre-id="{{ $subcategoria->id }}"
                                                                {{ in_array($subsubcategoria->id, $categoriasAsociadas) ? 'checked' : '' }}>
                                                            <label
                                                                class="form-check-label">{{ $subsubcategoria->nombre }}</label>
                                                        </div>
                                                        @foreach ($subsubcategoria->categorias_hijosRecursive as $subsubsubcategoria)
                                                            <div class="form-check ms-4" style="margin-left: 60px;">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="categorias[]"
                                                                    value="{{ $subsubsubcategoria->id }}"
                                                                    data-padre-id="{{ $subsubcategoria->id }}"
                                                                    {{ in_array($subsubsubcategoria->id, $categoriasAsociadas) ? 'checked' : '' }}>
                                                                <label
                                                                    class="form-check-label">{{ $subsubsubcategoria->nombre }}</label>
                                                            </div>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
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
                $('#editSucursal').val(data.sucursal);

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

    <script>
        $(document).ready(function() {
            $('#asociarForm').submit(function(e) {
                e.preventDefault();
                $('.btn-primary').prop('disabled', true);

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.sucursales.categorias.asociar', $sucursal->id) }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert(response.message);
                        if (response.success) {
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = xhr.responseJSON?.message ||
                            'Error al procesar la solicitud';
                        alert(errorMessage);
                    },
                    complete: function() {
                        $('.btn-primary').prop('disabled', false);
                    }
                });
            });

            // Escucha el cambio en cualquier checkbox de subcategoría
            $(document).on('change', 'input[name="categorias[]"][data-padre-id]', function() {
                const isChecked = $(this).is(':checked');
                const padreId = $(this).data('padre-id');

                // Si se marca una subcategoría, marcar también a su padre
                if (isChecked) {
                    $(`input[name="categorias[]"][value="${padreId}"]`).prop('checked', true);
                }
            });

            // Escucha el cambio en cualquier checkbox de categoría padre
            $(document).on('change', 'input[name="categorias[]"]:not([data-padre-id])', function() {
                const isChecked = $(this).is(':checked');
                const padreId = $(this).val();

                // Si se desmarca un padre, desmarcar todas sus subcategorías
                if (!isChecked) {
                    $(`input[name="categorias[]"][data-padre-id="${padreId}"]`).prop('checked', false);
                }
            });
        });
    </script>
@endpush
