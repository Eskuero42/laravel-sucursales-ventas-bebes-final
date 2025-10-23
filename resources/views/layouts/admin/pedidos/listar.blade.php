@extends('layouts.admin-layout')
@section('contenido')
    <div class="container-fluid position-relative">

        {{-- Fecha fija (mejorada, responsive y sin tapar el header) --}}
        <div id="fecha-fija"
            class="position-fixed end-0 bg-light shadow-sm rounded p-2 me-3 d-flex align-items-center justify-content-center text-nowrap"
            style="top: 80px; font-weight:600; z-index:1040; min-width: 180px;">
            {{ $fecha ?? '' }}
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const el = document.getElementById('fecha-fija');
                if (!el.innerText.trim()) {
                    const opciones = {
                        weekday: 'long',
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    };
                    el.textContent = new Date().toLocaleDateString('es-ES', opciones);
                }

                // Ajuste automático si el header cambia de altura en móviles
                const ajustarPosicion = () => {
                    const header = document.querySelector('.navbar, header, .topbar');
                    const altura = header ? header.offsetHeight : 60;
                    el.style.top = (altura + 10) + 'px';
                };
                ajustarPosicion();
                window.addEventListener('resize', ajustarPosicion);
            });
        </script>

        <div class="row mt-4">
            <div class="col-12">
                <h4 class="mb-3">Pedidos pendientes</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-4">
                <div class="card card-light">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="assets/images/users/avatar-8.jpg" alt="" class="avatar-sm rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="card-text">Nombre de usuario</p>
                            </div>           
                        </div>
                        <h5 class="mb-1 mt-3 text-center">Bb-0001</h5>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <a href="{{ route('admin.pedidos.ver') }}" class="text-body">PEDIDO COMPLETO<i
                                    class="ri-arrow-right-s-line align-middle lh-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
