@extends('layouts.admin-layout')
@section('contenido')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Productos</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Productos</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 col-lg-8">
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title mb-0 flex-grow-1">Productos por Sucursal</h5>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target=".bs-example-modal-xl">
                                    Registrar Producto
                                </button>
                            </div>
                        </div>
                        @if ($sucursales->isNotEmpty())
                            <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" role="tablist">
                                @foreach ($sucursales as $sucursal)
                                    <li class="nav-item">
                                        <a class="nav-link @if ($sucursal->id == $sucursal_id_activa) active @endif"
                                            href="{{ route('admin.productos.listar', ['sucursal_id' => $sucursal->id]) }}">
                                            {{ $sucursal->nombre }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <!-- end card header -->
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Listado de Productos</h5>
                            <div class="table-responsive table-card">
                                <table class="table align-middle table-hover table-striped mb-0">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th scope="col">Código</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Características</th>
                                            <th scope="col">Detalles</th>
                                            <th scope="col">Tipos</th>
                                            <th scope="col">Categoría</th>
                                            <th scope="col" style="width: 150px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($productos->isNotEmpty())
                                            @foreach ($productos as $producto)
                                                <tr>
                                                    <td class="text-center">
                                                        <span class="fw-semibold text-primary">
                                                            {{ $producto->producto->codigo ?? 'N/A' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div
                                                                class="avatar-sm bg-light rounded p-1 d-flex align-items-center justify-content-center">
                                                                @if (!empty($producto->producto->imagen_principal))
                                                                    <img src="{{ asset($producto->producto->imagen_principal) }}"
                                                                        alt="{{ $producto->nombre }}"
                                                                        class="img-fluid rounded"
                                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                                @else
                                                                    <img src="{{ asset('sin-producto.png') }}"
                                                                        alt="Sin imagen" class="img-fluid rounded"
                                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                                @endif
                                                            </div>
                                                            <span
                                                                class="ms-2">{{ $producto->producto->nombre ?? 'N/A' }}</span>
                                                        </div>
                                                    </td>

                                                    <td class="text-center">
                                                        <span class="fw-semibold text-success">
                                                            Bs
                                                            {{ number_format($producto->precio, 2) }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button"
                                                            class="btn btn-soft-info btn-sm waves-effect waves-light material-shadow-none"
                                                            data-bs-toggle="modal" data-bs-target="#caracteristicasModal"
                                                            data-producto-id="{{ $producto->producto->id }}" title="Ver">
                                                            <i class="ri-eye-line align-bottom"></i>
                                                        </button>
                                                    </td>

                                                    <td class="text-center">
                                                        <button type="button"
                                                            class="btn btn-soft-info btn-sm waves-effect waves-light material-shadow-none"
                                                            data-bs-toggle="modal" data-bs-target="#detallesModal"
                                                            data-producto-id="{{ $producto->producto->id }}" title="Ver">
                                                            <i class="ri-eye-line align-bottom"></i>
                                                        </button>

                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button"
                                                            class="btn btn-soft-info btn-sm waves-effect waves-light material-shadow-none"
                                                            data-bs-toggle="modal" data-bs-target="#tiposModal"
                                                            data-producto-id="{{ $producto->producto->id }}"
                                                            title="Ver Tipos">
                                                            <i class="ri-eye-line align-bottom"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-info fs-12 px-3 py-2">
                                                            {{ $producto->sucursales_categorias->categoria->nombre ?? 'N/A' }}
                                                        </span>

                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.productos.articulos.listar', ['id' => $producto->producto->id, 'sucursales_categorias_id' => $producto->sucursales_categorias_id]) }}"
                                                            class="btn btn-soft-info waves-effect waves-light material-shadow-none">
                                                            <i class="ri-eye-line label-icon align-middle fs-16 me-1"></i>
                                                            Ver
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">No se encontraron
                                                    productos para esta sucursal.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                {{ $productos->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>


                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    </div>

    <!--modal de registrar producto-->
    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <div class="modal-header bg-soft-success justify-content-center position-relative">
                    <h3 class="modal-title text-uppercase fw-bold text-success-emphasis text-center w-100"
                        id="myExtraLargeModalLabel">
                        <i class="ri-folder-add-line me-1"></i> Registrar Nuevo Producto
                    </h3>
                    <button type="button" class="btn-close position-absolute end-0 top-50 translate-middle-y me-3"
                        data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <form id="addformproducto" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="sucursal_id" value="{{ $sucursal_id_activa }}">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row g-3">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="codigo" class="form-label">Código</label>
                                            <input type="text" name="codigo" class="form-control" id=""
                                                placeholder="M-##">
                                        </div>

                                        <div class="col-md-9">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" id=""
                                                placeholder="Nombre del producto">
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="precio" class="form-label">Precio</label>
                                            <input type="text" name="precio" class="form-control" id=""
                                                placeholder="Precio del producto" step="0.01" min="0">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="stock" class="form-label">Stock</label>
                                            <input type="number" name="stock" class="form-control" id=""
                                                placeholder="Cantidad en stock" min="0" value="0">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="descripcion" class="form-label">Descripción</label>
                                            <textarea name="descripcion" rows="3" class="form-control" placeholder="Descripción del producto"></textarea>
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="estado" class="form-label">Estado</label>
                                            <select name="estado" class="form-select" id="">
                                                <option value="vigente">Vigente</option>
                                                <option value="no vigente">No Vigente</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="file" class="form-label">Imagen principal del
                                                        producto</label>
                                                    <input type="file" name="file" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col md-12">
                                            <label for="" class="form-label">Elija el tipo</label>
                                            <div class="row mb-3 mt-3">
                                                @foreach ($tipos as $tipo)
                                                    <div class="col-xl-3">
                                                        <div class="form-check form-check-primary mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="tipos[]" id="tipo_{{ $tipo->id }}"
                                                                value="{{ $tipo->id }}">

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
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label class="form-label">Seleccione una categoría</label>
                                <div class="row">
                                    @foreach ($categorias as $categoria)
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="categoria_id"
                                                    id="categoria_{{ $categoria->id }}" value="{{ $categoria->id }}">
                                                <label class="form-check-label fw-bold text-primary"
                                                    for="categoria_{{ $categoria->id }}">
                                                    {{ $categoria->nombre }}
                                                </label>
                                            </div>

                                            {{-- Subcategorías --}}
                                            @if ($categoria->categorias_hijosRecursive->count())
                                                @foreach ($categoria->categorias_hijosRecursive as $hijo)
                                                    <div class="form-check ms-3 mb-1">
                                                        <input class="form-check-input" type="radio"
                                                            name="categoria_id" id="categoria_{{ $hijo->id }}"
                                                            value="{{ $hijo->id }}">
                                                        <label class="form-check-label"
                                                            for="categoria_{{ $hijo->id }}">
                                                            {{ $hijo->nombre }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer mt-3">
                            <button type="button" class="btn bg-danger" data-bs-dismiss="modal"
                                style="color: white;">Cerrar</button>
                            <button type="submit" class="btn btn-success addBtn">Agregar Producto</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- modal caracteristicas -->
    <div class="modal fade" id="caracteristicasModal" tabindex="-1" aria-labelledby="caracteristicasModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="caracteristicasModalLabel">Características del Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="caracteristicas-content">
                        <!-- caracteristicas -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal detalles-->
    <div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detallesModalLabel">Detalles del Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="detalles-content">
                        <!-- detalles -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal tipos-->
    <div class="modal fade" id="tiposModal" tabindex="-1" aria-labelledby="tiposModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tiposModalLabel">Tipos y Especificaciones del Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="tipos-content">
                        <!-- tipos -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalConfigs = {
                'caracteristicasModal': {
                    contentId: 'caracteristicas-content',
                    endpoint: '/caracteristicas',
                    columns: [{
                            header: 'Icono',
                            key: 'icono',
                            render: (value) => `<i class="${value}"></i>`
                        },
                        {
                            header: 'Descripción',
                            key: 'descripcion'
                        }
                    ]
                },
                'detallesModal': {
                    contentId: 'detalles-content',
                    endpoint: '/detalles',
                    columns: [{
                            header: 'Título',
                            key: 'titulo'
                        },
                        {
                            header: 'Descripción',
                            key: 'descripcion'
                        },
                        {
                            header: 'Imagen',
                            key: 'imagen',
                            render: (value, item) =>
                                `<img src="/storage/${value}" alt="${item.titulo}" width="100">`
                        }
                    ]
                },
                'tiposModal': {
                    contentId: 'tipos-content',
                    endpoint: '/tipos-especificaciones',
                    columns: [{
                            header: 'Tipo',
                            key: 'nombre'
                        },
                        {
                            header: 'Especificaciones',
                            key: 'especificaciones',
                            render: (especificaciones) => {
                                if (!especificaciones || especificaciones.length === 0) {
                                    return 'N/A';
                                }
                                return '<ul>' + especificaciones.map(e => `<li>${e.descripcion}</li>`)
                                    .join('') + '</ul>';
                            }
                        }
                    ]
                }
            };

            function createTable(data, columns) {
                const headers = columns.map(col => `<th>${col.header}</th>`).join('');
                let rows = '';

                if (data.length > 0) {
                    rows = data.map(item => {
                        const cells = columns.map(col => {
                            const value = item[col.key];
                            return `<td>${col.render ? col.render(value, item) : value}</td>`;
                        }).join('');
                        return `<tr>${cells}</tr>`;
                    }).join('');
                } else {
                    rows = `<tr><td colspan="${columns.length}">No se encontraron registros.</td></tr>`;
                }

                return `<table class="table"><thead><tr>${headers}</tr></thead><tbody>${rows}</tbody></table>`;
            }

            Object.entries(modalConfigs).forEach(([modalId, config]) => {
                const modal = document.getElementById(modalId);
                if (!modal) return;

                modal.addEventListener('show.bs.modal', function(event) {
                    const productoId = event.relatedTarget.getAttribute('data-producto-id');
                    const modalBody = document.getElementById(config.contentId);

                    modalBody.innerHTML = 'Cargando...';

                    fetch(`/admin/productos/${productoId}${config.endpoint}`)
                        .then(response => response.json())
                        .then(data => {
                            modalBody.innerHTML = createTable(data, config.columns);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            modalBody.innerHTML = 'Error al cargar los datos.';
                        });
                });
            });
        });
    </script>
@endpush
