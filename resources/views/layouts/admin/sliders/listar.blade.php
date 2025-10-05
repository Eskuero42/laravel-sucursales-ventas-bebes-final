@extends('layouts.admin-layout')
@section('contenido')
    <div class="container py-4">
        <h3 class="mb-4 text-center text-primary fw-bold">Selecciona una Sucursal</h3>

        <div class="row g-4">
            @foreach ($sucursales as $sucursal)
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-4 h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">{{ $sucursal->nombre }}</h5>
                            <p class="text-muted mb-1"><strong>Dirección:</strong> {{ $sucursal->direccion }}</p>
                            <p class="text-muted"><strong>Horario:</strong> {{ $sucursal->horario_inicio }} -
                                {{ $sucursal->horario_fin }}</p>
                            <a href="{{ route('user.sliders.porSucursal', $sucursal->id) }}" class="btn btn-info">
                                Ver Sliders
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
