@extends('layouts.admin-layout')
@section('contenido')

    <div class="row">
        <div class="card shadow-sm border rounded-3">
            <div class="card-header bg-soft-primary position-relative d-flex align-items-center justify-content-between">

                {{-- 1. BOTÓN IZQUIERDO (Editar) --}}
                <button type="button" class="btn btn-secondary flex-shrink-0" data-bs-toggle="modal"
                    data-bs-target=".registro-producto">
                    <i class="bx bx-plus-circle align-middle me-1"></i> Registrar Producto
                </button>

                {{-- 2. CONTENEDOR CENTRAL: Título de Sucursal --}}
                @if ($sucursales_productos->isNotEmpty())
                    <h4 class="card-title text-uppercase fw-bold mb-0 mx-4 flex-shrink-0">
                        Sucursal:
                        {{ $sucursales_productos->first()?->sucursales_categorias?->sucursal?->nombre ?? 'Sucursal desconocida' }}
                    </h4>
                @endif

                <div class="d-flex align-items-center ms-auto">
                    @if (!empty($rutaNavegacion))
                        <nav aria-label="Ruta de navegación" class="me-3 d-none d-md-block">
                            <ol class="breadcrumb mb-0">
                                @foreach ($rutaNavegacion as $ruta)
                                    <li class="breadcrumb-item d-inline-flex {{ $loop->last ? 'active' : '' }}"
                                        @if ($loop->last) aria-current="page" @endif>
                                        {{ $ruta->nombre }}
                                    </li>
                                @endforeach
                            </ol>
                        </nav>
                    @endif
                </div>
                <!--modal de registrar producto-->
                <div class="modal fade registro-producto" tabindex="-1" role="dialog"
                    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header bg-soft-secondary justify-content-center position-relative">
                                <h3 class="modal-title text-uppercase fw-bold text-secondary-emphasis text-center w-100"
                                    id="myExtraLargeModalLabel">
                                    <i class="ri-folder-add-line me-1"></i>
                                    Registrar Producto
                                </h3>
                                <button type="button"
                                    class="btn-close position-absolute end-0 top-50 translate-middle-y me-3"
                                    data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>

                            <div class="modal-body">
                                <form id="addformproducto" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="sucursal_categoria_id" value="{{ $id }}">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="codigo" class="form-label">Código</label>
                                            <input type="text" name="codigo" class="form-control" id="producto_codigo"
                                                placeholder="M-##">
                                            <div class="invalid-feedback" id="codigo_error"></div>
                                        </div>

                                        <div class="col-md-9">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" id=""
                                                placeholder="Nombre del producto">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="precio" class="form-label">Precio Venta</label>
                                            <input type="text" name="precio" class="form-control" id=""
                                                placeholder="Precio del producto" step="0.01" min="0">
                                        </div>
                                        <div class="col md-9">
                                            <div class="mb-3">
                                                <label for="file" class="form-label">Imagen principal del
                                                    producto</label>
                                                <input type="file" name="imagen" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="" class="form-label">Detalle producto</label>
                                            <textarea name="descripcion" rows="3" class="form-control" placeholder="Descripción del producto"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col md-12">
                                            <label for="" class="form-label">Elija el tipo</label>
                                            <div class="row mb-3 mt-3">
                                                @foreach ($tipos as $tipo)
                                                    <div class="col-xl-3">
                                                        <div class="form-check form-check-primary mb-2">
                                                            <input class="form-check-input" type="checkbox" name="tipos[]"
                                                                id="tipo_{{ $tipo->id }}" value="{{ $tipo->id }}"
                                                                data-tipo-nombre="{{ $tipo->nombre }}">

                                                            <label class="form-check-label text-primary"
                                                                for="tipo_{{ $tipo->id }}">
                                                                {{ $tipo->nombre }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal-footer mt-3">
                                        <button type="button" class="btn bg-danger" data-bs-dismiss="modal"
                                            style="color: white;">Cerrar</button>
                                        <button type="submit" class="btn btn-secondary addBtn">Registrar
                                            Producto</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($sucursales_productos->isNotEmpty())
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">
                    Lista de productos de la categoria:
                    {{ $sucursales_productos->first()?->sucursales_categorias?->categoria?->nombre ?? 'Categoría desconocida' }}
                </h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row">
                    @foreach ($sucursales_productos as $s_c)
                        <div class="col-xl-4">
                            <div class="card product">
                                <div class="card-body">
                                    <div class="row gy-3 align-items-start">
                                        <div class="col-sm-auto">
                                            <div
                                                class="avatar-lg bg-light rounded p-1 d-flex align-items-center justify-content-center">
                                                <img src="{{ asset($s_c->producto->imagen_principal) }}" alt="Producto"
                                                    class="img-fluid rounded avatar-md object-fit-contain"
                                                    style="max-height: 100px;">
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="fs-16 text-truncate mb-2">{{ $s_c->producto->nombre }}</h5>
                                                <div class="text-end">
                                                    <p class="text-muted mb-1">CÓDIGO:</p>
                                                    <h6 id="ticket_price" class="product-price fw-semibold">
                                                        {{ $s_c->producto->codigo }}</h6>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center gap-2 text-muted mb-1">
                                                <span class="fw-semibold">Precio:</span>
                                                <span>Bs. <span
                                                        class="product-line-price">{{ $s_c->producto->precio }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="row align-items-center gy-3">
                                        <div class="col-sm-auto">
                                            <a href="{{ route('admin.sucursales.categorias.productos.articulos.listar', $s_c->id) }}"
                                                class="btn btn-primary btn-icon waves-effect waves-light"
                                                title="Ir a detalles del producto">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> <!-- end row -->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    @endif

    <div class="row">
        <div class="card shadow-sm border rounded-3">
            <div class="card-header bg-soft-primary position-relative d-flex align-items-center">

                @if ($sucursales_productos->isNotEmpty())
                    <h4 class="card-title text-uppercase fw-bold mb-0 mx-auto">
                        Subcategorias de:
                        {{ $sucursales_productos->first()?->sucursales_categorias?->categoria?->nombre ?? 'Categoria desconocida' }}
                    </h4>
                @endif
                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                    data-bs-target=".registrar-subcategoria">
                    <i class="bx bx-plus-circle align-middle me-1"></i> Registrar Subcategoria
                </button>

            </div>
        </div>
    </div>

    @if ($subcategorias->isNotEmpty())
        <div class="row">
            @foreach ($subcategorias as $subcategoria)
                <div class="col-xl-4 col-md-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">
                                {{ $subcategoria->nombre }}
                            </h4>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-warning btn-icon waves-effect waves-light editBtn"
                                    title="Editar categoría" data-bs-obj='@json($subcategoria)'
                                    data-bs-toggle="modal" data-bs-target=".bs-edit-modal-lg">
                                    <i data-feather="edit-2"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body text-center">
                            <div class="bg-info-subtle rounded p-2 mb-3">
                                <img src="{{ asset($subcategoria->imagen) }}" alt="{{ $subcategoria->nombre }}"
                                    class="img-fluid rounded" style="max-height: 210px;">
                            </div>
                            <h5>
                                <p>
                                    Descripción: {{ $subcategoria->descripcion }}
                                </p>
                            </h5>
                            <a href="{{ route('admin.sucursales.categorias.productos.ver', $subcategoria->id) }}"
                                class="btn btn-info waves-effect waves-light" title="Ir a detalles del producto">
                                <i data-feather="eye"></i> Todos los productos
                            </a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!--modal de registrar-->
    <div class="modal fade registrar-subcategoria" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-modal="true"
        role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-soft-success justify-content-center position-relative">
                    <h3 class="modal-title text-uppercase fw-bold text-info-emphasis text-center w-100"
                        id="myExtraLargeModalLabel">
                        <i class="ri-folder-add-line me-1"></i> Registrar Nueva SubCategoría
                    </h3>
                    <button type="button" class="btn-close position-absolute end-0 top-50 translate-middle-y me-3"
                        data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <!-- Cuerpo del modal -->
                <div class="modal-body">
                    <form action="" id="addSubcategoriaForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="sucursal" value="{{ $sucursalCategoria?->sucursal_id }}">
                        <input type="hidden" name="categoria_id" value="{{ $categoriaPadre?->id }}">
                        <input type="hidden" name="tipo" value="{{ $categoriaPadre?->tipo }}">
                        <div class="row g-3">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Nombre de categoría" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="imagen" class="form-label">Imagen</label>
                                    <input class="form-control" type="file" id="imagen" accept="image/*"
                                        name="imagen" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" rows="3" name="descripcion"
                                        placeholder="Introducir descripción del producto" required></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn bg-danger" data-bs-dismiss="modal"
                                style="color: white;">Cerrar</button>
                            <button type="submit" class="btn bg-info addBtn" style="color: white;">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal de editar subcategoria -->
    <div class="modal fade bs-edit-modal-lg" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-modal="true"
        role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-soft-warning justify-content-center position-relative">
                    <h3 class="modal-title text-uppercase fw-bold text-warning-emphasis text-center w-100"
                        id="myExtraLargeModalLabel">
                        <i class="ri-edit-box-line me-1"></i> Editar SubCategoría
                    </h3>
                    <button type="button" class="btn-close position-absolute end-0 top-50 translate-middle-y me-3"
                        data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="editSubcategoriaForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <input type="hidden" name="tipo" id="edit_tipo">
                        <input type="hidden" name="categoria_id" id="edit_categoria_id">

                        <div class="row g-3">
                            <div class="mb-3">
                                <label for="edit_nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="edit_descripcion" rows="3" name="descripcion" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="edit_imagen" class="form-label">Nueva Imagen (Opcional)</label>
                                <input class="form-control" type="file" id="edit_imagen" accept="image/*"
                                    name="imagen">
                                <small class="form-text text-muted">Sube una nueva imagen solo si deseas reemplazar la
                                    actual.</small>
                            </div>
                            <div class="text-center">
                                <img id="current_image_preview" src="" alt="Imagen Actual"
                                    class="img-fluid rounded" style="max-height: 150px;">
                            </div>
                        </div>

                        <div class="modal-footer mt-3">
                            <button type="button" class="btn bg-secondary" data-bs-dismiss="modal"
                                style="color: white;">Cerrar</button>
                            <button type="submit" class="btn bg-warning editSubmitBtn"
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
            // check de tallas y capacidades
            const tallasCheckbox = $('input[data-tipo-nombre="Tallas"]');
            const capacidadesCheckbox = $('input[data-tipo-nombre="Capacidades"]');

            tallasCheckbox.on('change', function() {
                if ($(this).is(':checked')) {
                    capacidadesCheckbox.prop('disabled', true);
                    capacidadesCheckbox.prop('checked', false);
                } else {
                    capacidadesCheckbox.prop('disabled', false);
                }
            });

            capacidadesCheckbox.on('change', function() {
                if ($(this).is(':checked')) {
                    tallasCheckbox.prop('disabled', true);
                    tallasCheckbox.prop('checked', false);
                } else {
                    tallasCheckbox.prop('disabled', false);
                }
            });

            $('#addformproducto').submit(function(e) {
                e.preventDefault();
                $('#producto_codigo').removeClass('is-invalid');
                $('#codigo_error').text('');

                $('.addBtn').prop('disabled', true);
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.productos.sucursales.registrar') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res.message);
                        if (res.success) {
                            $('#addformproducto')[0].reset();
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.codigo) {
                                $('#producto_codigo').addClass('is-invalid');
                                $('#codigo_error').text(errors.codigo[0]);
                            }
                        } else {
                            alert(xhr.responseJSON?.message || 'Error al registrar producto');
                        }
                    },
                    complete: function() {
                        $('.addBtn').prop('disabled', false);
                    }
                });
            });
            $('#addSubcategoriaForm').submit(function(e) {
                e.preventDefault();
                $('.addBtn').prop('disabled', true);
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.subcategorias.registrar') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res.message);
                        if (res.success) {
                            $('#addSubcategoriaForm')[0].reset(); // Limpiar el formulario
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

            $('.bs-edit-modal-lg').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var subcategoria = button.data('bs-obj');

                var modal = $(this);
                modal.find('#edit_id').val(subcategoria.id);
                modal.find('#edit_nombre').val(subcategoria.nombre);
                modal.find('#edit_descripcion').val(subcategoria.descripcion);
                modal.find('#edit_tipo').val(subcategoria.tipo);
                modal.find('#edit_categoria_id').val(subcategoria.categoria_id);
                var imageUrl = '{{ asset('') }}' + subcategoria.imagen;
                modal.find('#current_image_preview').attr('src', imageUrl);
                modal.find('#edit_imagen').val('');
            });

            $('#editSubcategoriaForm').submit(function(e) {
                e.preventDefault();
                $('.editSubmitBtn').prop('disabled', true);

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.categorias.editar') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res.message);
                        if (res.success) {
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        $('.editSubmitBtn').prop('disabled', false);
                        var errorMessage = xhr.responseJSON?.message ||
                            'Error al actualizar la subcategoría';
                        alert(errorMessage);
                    }
                });
            });
        });
    </script>
@endpush
