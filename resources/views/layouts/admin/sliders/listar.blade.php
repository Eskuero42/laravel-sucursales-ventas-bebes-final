@extends('layouts.admin-layout')
@section('contenido')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center border-0">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#carruselTab" role="tab"
                                    aria-selected="true">
                                    <i class="ri-image-2-line me-1"></i> Carrusel
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#iconosTab" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="ri-star-line me-1"></i> Iconos
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            <!--carrusel-->
                            <div class="tab-pane active" id="carruselTab" role="tabpanel">
                                <div class="card-header d-flex align-items-center border-0">
                                    <h5 class="card-title mb-0 flex-grow-1">Carrusel de imágenes</h5>

                                    <button type="button" class="btn btn-soft-success waves-effect waves-light"
                                        data-bs-toggle="modal" data-bs-target="#addModal">
                                        <i class="ri-add-line align-bottom me-1"></i> Registrar
                                    </button>
                                </div>
                                <!--filtros-->
                                <div class="card-body border border-dashed border-end-0 border-start-0">
                                    <div class="row g-2">
                                        <div class="col-xl-8 col-md-8">
                                            <select class="form-control" data-choices data-choices-search-false
                                                id="idType">
                                                <option value="">Seleccionar Tipo</option>
                                                <option value="principal">Principal</option>
                                                <option value="secundario">Secundario</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-4 col-md-4 d-flex gap-2">
                                            <button class="btn btn-success w-100" onclick="filterData();">Filtrar</button>
                                            <button class="btn btn-secondary w-100" onclick="resetFilters();">Quitar
                                                Filtros</button>
                                        </div>
                                    </div>
                                </div>

                                <div id="sliderList" class="card-body"
                                    data-list='{"valueNames": ["tipo", "estado"], "page": 9, "pagination": true}'>
                                    <div class="row g-4 list">
                                        
                                        @if ($sliders->isNotEmpty())
                                            @foreach ($sliders as $slider)
                                                <div class="col-12 col-md-6 col-xl-4">
                                                    <div
                                                        class="card ribbon-box border shadow-none h-100 d-flex flex-column">
                                                        <div class="card-body p-3 d-flex flex-column">
                                                            <div class="text-center">
                                                                <img src="{{ asset($slider->imagen) }}"
                                                                    alt="{{ $slider->titulo }}"
                                                                    class="img-fluid rounded-top object-fit-cover"
                                                                    style="height: 180px; width: 100%; object-fit: cover;">
                                                            </div>

                                                            <div class="mt-3 flex-grow-1 d-flex flex-column">
                                                                <h4
                                                                    class="fw-bold text-uppercase text-dark-emphasis titulo">
                                                                    <span
                                                                        class="badge bg-baby-sky text-ligth fs-6">{{ $slider->titulo }}</span>
                                                                </h4>

                                                                <div class="mb-3">
                                                                    <div class="descripcion text-muted fs-6 overflow-auto"
                                                                        style="height: 100px;">
                                                                        {{ $slider->descripcion }}
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="bg-light-subtle rounded p-3 d-flex justify-content-around align-items-center">

                                                                    <div class="text-center flex-fill">
                                                                        <strong>Tipo</strong><br>
                                                                        @if ($slider->tipo == 'principal')
                                                                            <span
                                                                                class="badge badge-label bg-primary fs-6 tipo">
                                                                                <i class="mdi mdi-circle-medium"></i>
                                                                                {{ strtolower($slider->tipo) }}
                                                                            </span>
                                                                        @else
                                                                            <span
                                                                                class="badge badge-label bg-secondary fs-6 tipo">
                                                                                <i class="mdi mdi-circle-medium"></i>
                                                                                {{ strtolower($slider->tipo) }}
                                                                            </span>
                                                                        @endif
                                                                    </div>

                                                                    <div class="text-center flex-fill">
                                                                        <strong>Posición</strong><br>
                                                                        @if ($slider->posicion == 'izquierda')
                                                                            <span class="ms-1 text-body fs-6">
                                                                                <i
                                                                                    class="ri-arrow-left-line align-middle me-1"></i>{{ strtolower($slider->posicion) }}
                                                                            </span>
                                                                        @elseif ($slider->posicion == 'derecha')
                                                                            <span class="ms-1 text-body fs-6">
                                                                                <i
                                                                                    class="ri-arrow-right-line align-middle me-1"></i>{{ strtolower($slider->posicion) }}
                                                                            </span>
                                                                        @else
                                                                            <span class="ms-1 text-body fs-6">
                                                                                <i
                                                                                    class="ri-arrow-up-down-line align-middle me-1"></i>{{ strtolower($slider->posicion) }}
                                                                            </span>
                                                                        @endif
                                                                    </div>

                                                                    <div class="text-center flex-fill">
                                                                        <strong>Estado</strong><br>
                                                                        @if ($slider->estado == 'activo')
                                                                            <span
                                                                                class="badge badge-label bg-success fs-6 estado">
                                                                                <i class="mdi mdi-circle-medium"></i>
                                                                                {{ strtolower($slider->estado) }}
                                                                            </span>
                                                                        @else
                                                                            <span
                                                                                class="badge badge-label bg-danger fs-6 estado">
                                                                                <i class="mdi mdi-circle-medium"></i>
                                                                                {{ strtolower($slider->estado) }}
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="hstack gap-2 mt-auto">
                                                                    <button type="button"
                                                                        class="btn btn-soft-warning btn-icon waves-effect waves-light editBtn w-100"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#updateModal"
                                                                        data-bs-obj='@json($slider)'>
                                                                        <i class="ri-edit-line"></i>Editar
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-12">
                                                <div class="text-center py-4">
                                                    <h5 class="mt-2">¡Lo sentimos! No se encontraron datos.</h5>
                                                    <p class="text-muted mb-0">Intenta agregar nuevos elementos.</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="d-flex justify-content-end mt-3">
                                        <div class="pagination-wrap gap-2">
                                            <button type="button"
                                                class="page-item pagination-prev disabled">Anterior</button>
                                            <ul class="pagination listjs-pagination mb-0"></ul>
                                            <button type="button" class="page-item pagination-next">Siguiente</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!--iconos-->
                            <div class="tab-pane" id="iconosTab" role="tabpanel">
                                <div class="card-header d-flex align-items-center border-0">
                                    <h5 class="card-title mb-0 flex-grow-1">Informacion de Iconos</h5>

                                    <button type="button" class="btn btn-soft-success waves-effect waves-light"
                                        data-bs-toggle="modal" data-bs-target="#addModalIcono">
                                        <i class="ri-add-line align-bottom me-1"></i> Registrar
                                    </button>
                                </div>
                                <div class="table-responsive table-card">
                                    <table class="table table-nowrap table-striped-columns mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">Icono</th>
                                                <th scope="col">Título</th>
                                                <th scope="col">Descripción</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @if ($iconos->isNotEmpty())
                                                @foreach ($iconos as $icono)
                                                    <tr>
                                                        <td><img src="{{ asset($icono->imagen) }}"
                                                                alt="{{ $icono->titulo }}" class="img-fluid rounded"
                                                                style="height: 40px;"></td>
                                                        <td>{{ $icono->titulo }}</td>
                                                        <td>{{ $icono->descripcion }}</td>
                                                        <td>
                                                            @if ($icono->estado == 'activo')
                                                                <span class="badge bg-success">Activo</span>
                                                            @else
                                                                <span class="badge bg-danger">Inactivo</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-soft-warning btn-sm waves-effect waves-light editIconoBtn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#updateModalIcono"
                                                                data-bs-obj='@json($icono)'>
                                                                <i class="ri-edit-line"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center py-4">
                                                        <h5 class="mt-2">¡Lo sentimos! No se encontraron datos.</h5>
                                                        <p class="text-muted mb-0">Intenta agregar nuevos elementos.</p>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal para registrar carrusel -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow-sm rounded-4">
                <div class="modal-header bg-soft-success">
                    <h5 class="modal-title text-uppercase fw-bold text-success-emphasis" id="addModalLabel">
                        <i class="bx bx-image-add me-1"></i> Registrar Carrusel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <form id="addForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Imagen</label>
                            <div class="input-group">
                                <span class="input-group-text border-success-subtle">
                                    <i class="bx bx-upload"></i>
                                </span>
                                <input type="file" class="form-control form-control-sm border-success-subtle"
                                    name="imagen" id="imagen" required>
                            </div>
                            <div class="mt-2 text-center">
                                <img id="imagen-preview" src="#" alt="Vista previa de la imagen"
                                    class="img-thumbnail border-success-subtle"
                                    style="max-height: 150px; display: none;">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Título</label>
                                <div class="input-group">
                                    <span class="input-group-text border-success-subtle">
                                        <i class="bx bx-text"></i>
                                    </span>
                                    <input type="text" class="form-control form-control-sm border-success-subtle"
                                        name="titulo" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <div class="input-group">
                                    <span class="input-group-text border-success-subtle">
                                        <i class="bx bx-align-left"></i>
                                    </span>
                                    <textarea class="form-control form-control-sm border-success-subtle" name="descripcion"
                                        rows="4" placeholder="Ingrese una descripción..." required></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Tipo</label>
                                <div class="input-group">
                                    <span class="input-group-text border-success-subtle">
                                        <i class="bx bx-category"></i>
                                    </span>
                                    <select class="form-select form-select-sm border-success-subtle" name="tipo"
                                        required>
                                        <option value="principal">Principal</option>
                                        <option value="secundario">Secundario</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Posición</label>
                                <div class="input-group">
                                    <span class="input-group-text border-success-subtle">
                                        <i class="bx bx-align-justify"></i>
                                    </span>
                                    <select class="form-select form-select-sm border-success-subtle" name="posicion"
                                        required>
                                        <option value="izquierda">Izquierda</option>
                                        <option value="centro" selected>Centro</option>
                                        <option value="derecha">Derecha</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Estado</label>
                                <div class="input-group">
                                    <span class="input-group-text border-success-subtle">
                                        <i class="bx bx-toggle-left"></i>
                                    </span>
                                    <select class="form-select form-select-sm border-success-subtle" name="estado"
                                        required>
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x-circle me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-soft-success addBtn">
                            <i class="bx bx-check-circle me-1"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--modal Editar carrusel-->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-sm rounded-4">
                <div class="modal-header bg-soft-warning">
                    <h5 class="modal-title text-uppercase fw-bold text-warning-emphasis" id="updateModalLabel">
                        <i class="bx bx-edit-alt me-1"></i> Editar Carrusel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form id="updateForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="updateId">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Imagen actual</label><br>
                            <img id="previewImg" src="" alt="Imagen actual"
                                class="img-thumbnail border border-warning-subtle" style="max-height: 150px;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nueva imagen (opcional)</label>
                            <div class="input-group">
                                <span class="input-group-text border-warning-subtle">
                                    <i class="bx bx-upload"></i>
                                </span>
                                <input type="file" class="form-control form-control-sm border-warning-subtle"
                                    name="imagen" id="updateImagen">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Título</label>
                                <div class="input-group">
                                    <span class="input-group-text border-warning-subtle">
                                        <i class="bx bx-text"></i>
                                    </span>
                                    <input type="text" class="form-control form-control-sm border-warning-subtle"
                                        name="titulo" id="updateTitulo" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Descripción</label>
                                <div class="input-group">
                                    <span class="input-group-text border-warning-subtle">
                                        <i class="bx bx-align-left"></i>
                                    </span>
                                    <textarea class="form-control form-control-sm border-warning-subtle" name="descripcion" id="updateDescripcion"
                                        required rows="4"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Tipo</label>
                                <div class="input-group">
                                    <span class="input-group-text border-warning-subtle">
                                        <i class="bx bx-category"></i>
                                    </span>
                                    <select class="form-select form-select-sm border-warning-subtle" name="tipo"
                                        id="updateTipo" required>
                                        <option value="principal">Principal</option>
                                        <option value="secundario">Secundario</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Posición</label>
                                <div class="input-group">
                                    <span class="input-group-text border-warning-subtle">
                                        <i class="bx bx-align-justify"></i>
                                    </span>
                                    <select class="form-select form-select-sm border-warning-subtle" name="posicion"
                                        id="updatePosicion" required>
                                        <option value="izquierda">Izquierda</option>
                                        <option value="centro">Centro</option>
                                        <option value="derecha">Derecha</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Estado</label>
                                <div class="input-group">
                                    <span class="input-group-text border-warning-subtle">
                                        <i class="bx bx-toggle-left"></i>
                                    </span>
                                    <select class="form-select form-select-sm border-warning-subtle" name="estado"
                                        id="updateEstado" required>
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x-circle me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-soft-warning updateBtn">
                            <i class="bx bx-check-circle me-1"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal para registrar icono -->
    <div class="modal fade" id="addModalIcono" tabindex="-1" aria-labelledby="addModalIconoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow-sm rounded-4">
                <div class="modal-header bg-soft-success">
                    <h5 class="modal-title text-uppercase fw-bold text-success-emphasis" id="addModalIconoLabel">
                        <i class="bx bx-image-add me-1"></i> Registrar icono
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <form id="addIconoForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Icono (Imagen)</label>
                            <div class="input-group">
                                <span class="input-group-text border-success-subtle">
                                    <i class="bx bx-upload"></i>
                                </span>
                                <input type="file" class="form-control form-control-sm border-success-subtle"
                                    name="imagen" id="iconoImagen" required>
                            </div>
                            <div class="mt-2 text-center">
                                <img id="icono-imagen-preview" src="#" alt="Vista previa del icono"
                                    class="img-thumbnail border-success-subtle"
                                    style="max-height: 150px; display: none;">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Título</label>
                                <div class="input-group">
                                    <span class="input-group-text border-success-subtle">
                                        <i class="bx bx-text"></i>
                                    </span>
                                    <input type="text" class="form-control form-control-sm border-success-subtle"
                                        name="titulo" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <div class="input-group">
                                    <span class="input-group-text border-success-subtle">
                                        <i class="bx bx-align-left"></i>
                                    </span>
                                    <textarea class="form-control form-control-sm border-success-subtle" name="descripcion"
                                        rows="4" placeholder="Ingrese una descripción..." required></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="tipo" value="icono">
                        <input type="hidden" name="estado" value="activo">
                        <input type="hidden" name="posicion" value="centro">
                    </div>

                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x-circle me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-soft-success addIconoBtn">
                            <i class="bx bx-check-circle me-1"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--modal para editar icono-->
    <div class="modal fade" id="updateModalIcono" tabindex="-1" aria-labelledby="updateModalIconoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-sm rounded-4">
                <div class="modal-header bg-soft-warning">
                    <h5 class="modal-title text-uppercase fw-bold text-warning-emphasis" id="updateModalIconoLabel">
                        <i class="bx bx-edit-alt me-1"></i> Editar Icono
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form id="updateIconoForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="updateIconoId">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Icono Actual</label><br>
                            <img id="previewIconoImg" src="" alt="Icono actual"
                                class="img-thumbnail border border-warning-subtle" style="max-height: 150px;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nuevo Icono (opcional)</label>
                            <div class="input-group">
                                <span class="input-group-text border-warning-subtle">
                                    <i class="bx bx-upload"></i>
                                </span>
                                <input type="file" class="form-control form-control-sm border-warning-subtle"
                                    name="imagen" id="updateIconoImagen">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Título</label>
                                <div class="input-group">
                                    <span class="input-group-text border-warning-subtle">
                                        <i class="bx bx-text"></i>
                                    </span>
                                    <input type="text" class="form-control form-control-sm border-warning-subtle"
                                        name="titulo" id="updateIconoTitulo" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Descripción</label>
                                <div class="input-group">
                                    <span class="input-group-text border-warning-subtle">
                                        <i class="bx bx-align-left"></i>
                                    </span>
                                    <textarea class="form-control form-control-sm border-warning-subtle" name="descripcion"
                                        id="updateIconoDescripcion" required rows="4"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Estado</label>
                                <div class="input-group">
                                    <span class="input-group-text border-warning-subtle">
                                        <i class="bx bx-toggle-left"></i>
                                    </span>
                                    <select class="form-select form-select-sm border-warning-subtle" name="estado"
                                        id="updateIconoEstado" required>
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x-circle me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-soft-warning updateIconoBtn">
                            <i class="bx bx-check-circle me-1"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- list.js min js -->
    <script src="{{ asset('backend/assets/libs/list.js/list.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <!--crypto-orders init-->
    <script src="{{ asset('backend/assets/js/pages/crypto-orders.init.js') }}"></script>
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sliderList = new List('sliderList', {
                valueNames: ['tipo', 'estado'],
                page: 9,
                pagination: true
            });

            const tipoSelect = document.getElementById('idType');

            window.filterData = function() {
                const tipo = tipoSelect.value.trim().toLowerCase();

                sliderList.filter(item => {
                    const tipoItem = item.values().tipo.toLowerCase();
                    return tipo ? tipoItem.includes(tipo) : true;
                });
            };

            window.resetFilters = function() {
                tipoSelect.selectedIndex = 0;

                if (typeof Choices !== 'undefined') {
                    const tipoChoices = Choices.getInstanceById('idType');
                    if (tipoChoices) tipoChoices.setChoiceByValue('');
                }

                sliderList.filter();
            };
        });
    </script>

    @push('script')
        <script>
            $(document).ready(function() {

                $('#imagen').on('change', function() {
                    const [file] = this.files;
                    if (file) {
                        $('#imagen-preview').attr('src', URL.createObjectURL(file)).show();
                    }
                });

                $('#addModal').on('hidden.bs.modal', function() {
                    $('#imagen-preview').attr('src', '#').hide();
                    $('#imagen').val('');
                    $('#addForm')[0].reset();
                });

                $('#iconoImagen').on('change', function() {
                    const [file] = this.files;
                    if (file) {
                        $('#icono-imagen-preview').attr('src', URL.createObjectURL(file)).show();
                    }
                });
                $('#addModalIcono').on('hidden.bs.modal', function() {
                    $('#icono-imagen-preview').attr('src', '#').hide();
                    $('#iconoImagen').val('');
                    $('#addIconoForm')[0].reset();
                });

                $('#addForm').submit(function(e) {
                    e.preventDefault();
                    $('.addBtn').prop('disabled', true);
                    var formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('user.sliders.registrar') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            alert(res.msg);
                            $('.addBtn').prop('disabled', false);
                            if (res.success) {
                                location.reload();
                            }
                        }
                    });
                });

                $('#addIconoForm').submit(function(e) {
                    e.preventDefault();
                    $('.addIconoBtn').prop('disabled', true);
                    var formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('user.sliders.registrar') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            alert(res.msg);
                            $('.addIconoBtn').prop('disabled', false);
                            if (res.success) {
                                location.reload();
                            }
                        }
                    });
                });

                $('#sliderList').on('click', '.editBtn', function() {
                    var data = $(this).data('bs-obj');
                    $('#updateId').val(data.id);
                    $('#updateTitulo').val(data.titulo);
                    $('#updateDescripcion').val(data.descripcion);
                    $('#updateTipo').val(data.tipo);
                    $('#updatePosicion').val(data.posicion);
                    $('#updateEstado').val(data.estado);

                    if (data.imagen) {
                        $('#previewImg').attr('src', '/' + data.imagen).show();
                    } else {
                        $('#previewImg').attr('src', '').hide();
                    }

                    $('#updateImagen').val('');
                });

                $('#iconosTab').on('click', '.editIconoBtn', function() {
                    var data = $(this).data('bs-obj');
                    $('#updateIconoId').val(data.id);
                    $('#updateIconoTitulo').val(data.titulo);
                    $('#updateIconoDescripcion').val(data.descripcion);
                    $('#updateIconoEstado').val(data.estado);

                    if (data.imagen) {
                        $('#previewIconoImg').attr('src', '/' + data.imagen).show();
                    } else {
                        $('#previewIconoImg').attr('src', '').hide();
                    }
                    $('#updateIconoImagen').val('');
                });


                $('#updateImagen').on('change', function() {
                    const [file] = this.files;
                    if (file) {
                        $('#previewImg').attr('src', URL.createObjectURL(file)).show();
                    }
                });

                $('#updateIconoImagen').on('change', function() {
                    const [file] = this.files;
                    if (file) {
                        $('#previewIconoImg').attr('src', URL.createObjectURL(file)).show();
                    }
                });

                $('#updateForm').submit(function(e) {
                    e.preventDefault();
                    $('.updateBtn').prop('disabled', true);
                    var formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('user.sliders.actualizar') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            alert(res.msg);
                            $('.updateBtn').prop('disabled', false);
                            if (res.success) {
                                location.reload();
                            }
                        }
                    });
                });

                $('#updateIconoForm').submit(function(e) {
                    e.preventDefault();
                    $('.updateIconoBtn').prop('disabled', true);
                    var formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('user.sliders.actualizar') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            alert(res.msg);
                            $('.updateIconoBtn').prop('disabled', false);
                            if (res.success) {
                                location.reload();
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
