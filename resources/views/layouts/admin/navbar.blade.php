<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu bg-baby-sky">
    <!-- LOGO -->
    <div class="navbar-brand-box bg-baby-sky">
        <!-- Dark Logo-->
        <a href="#" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('backend/assets/images/adminBebBus/logos/logo1.png') }}" alt="">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('backend/assets/images/adminBebBus/logos/logobebBus1.png') }}" alt="">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="#" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('backend/assets/images/adminBebBus/logos/logo1.png') }}" alt=""
                    height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('backend/assets/images/adminBebBus/logos/logobebBus0.png') }}" alt=""
                    height="60">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link menu-link text-white bg-baby-sky" href="{{ route('user.sliders.listar') }}">
                        <img src="{{ asset('backend\assets\images\adminBebBus\iconos\carrusel.png') }}" alt="Calendario"
                            class="img-fluid avatar-xs me-2">
                        <span class="fs-3">Carrusel</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link text-white bg-baby-sky" href="{{ route('admin.sucursales.listar') }}">
                        <img src="{{ asset('backend\assets\images\adminBebBus\iconos\sucursales.png') }}" alt="Sucursales"
                            class="img-fluid avatar-xs me-2">
                        <span class="fs-3">Sucursales</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link text-white bg-baby-sky" href="{{ route('admin.categorias.listar') }}">
                        <img src="{{ asset('backend\assets\images\adminBebBus\iconos\categoria.ico') }}"
                            alt="Categorias" class="img-fluid avatar-xs me-2">
                        <span class="fs-3">Categorias</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link text-white bg-baby-sky" href="{{ route('admin.productos.listar') }}">
                        <img src="{{ asset('backend\assets\images\adminBebBus\iconos\bienes.png') }}"
                            alt="Productos" class="img-fluid avatar-xs me-2">
                        <span class="fs-3">Productos</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link text-white bg-baby-sky" href="{{-- route('admin.compras.listar') --}}">
                        <img src="{{ asset('backend\assets\images\adminBebBus\iconos\carrito.png') }}"
                            alt="Productos" class="img-fluid avatar-xs me-2">
                        <span class="fs-3">Compras</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link text-white bg-baby-sky" href="{{-- route('admin.categorias.listar') --}}">
                        <img src="{{ asset('backend\assets\images\adminBebBus\iconos\calendario.ico') }}"
                            alt="Calendario" class="img-fluid avatar-xs me-2">
                        <span class="fs-3">Calendario</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link text-white bg-baby-sky" href="{{-- route('admin.personas.listar') --}}">
                        <i class="ri-user-3-line fs-1 me-2"></i>
                        <span class="fs-3">Personas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link text-white bg-baby-sky" href="{{ route('admin.tipos.ver') }}">
                        <img src="{{ asset('backend\assets\images\adminBebBus\iconos\especificacion.png') }}"
                            alt="Calendario" class="img-fluid avatar-xs me-2">
                        <span class="fs-3">Tipos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link text-white bg-baby-sky" href="{{ route('admin.especificaciones.ver') }}">
                        <img src="{{ asset('backend\assets\images\adminBebBus\iconos\lista.png') }}"
                            alt="Calendario" class="img-fluid avatar-xs me-2">
                        <span class="fs-3">Especificaciones</span>
                    </a>
                </li>




                <!-- menu desplegable ejemplo tomar en cuenta

                    href="#sidebarsecciones
                    aria-controls="sidebarsecciones
                    id="sidebarsecciones" -->
                {{--
                <li class="nav-item">
                    <a class="nav-link menu-link text-white bg-baby-sky" href="#sidebarsecciones"
                        data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarsecciones">
                        <img src="{{ asset('backend/assets/images/adminBebBus/iconos/secciones.png') }}"
                            alt="Secciones" class="img-fluid avatar-xs me-2">
                        <span class="fs-3" data-key="t-forms">Secciones</span>
                    </a>

                    <div class="collapse menu-dropdown bg-baby-sky" id="sidebarsecciones">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('user.sliders.listar') }}"
                                    class="nav-link d-flex align-items-center text-white" data-key="t-crm">
                                    <img src="{{ asset('backend/assets/images/adminBebBus/iconos/carrusel.png') }}"
                                        alt="Carrusel" class="img-fluid avatar-xs me-2">
                                    Carrusel
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link d-flex align-items-center text-white"
                                    data-key="t-crm">
                                    <img src="{{ asset('backend/assets/images/adminBebBus/iconos/iconos.png') }}"
                                        alt="Iconos" class="img-fluid avatar-xs me-2">
                                    Iconos
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
