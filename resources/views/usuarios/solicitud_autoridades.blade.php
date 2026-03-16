@extends('layouts.menu_usuarios')

@section('contenido')

    @vite(['resources/css/Solicitud_Autoridades.css'])

    <div class="card shadow-lg border-0 p-5">

        <div class="text-center mb-5">
            <h3 class="fw-bold text-success">Solicitud para ser Autoridad</h3>
            <p class="text-muted">Complete los datos de su institución</p>
        </div>

        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario --}}
        <form action="{{ route('solicitud.autoridad.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nombre de la empresa o institución</label>
                <input type="text" class="form-control" name="company_name" placeholder="Escriba el nombre de su institución" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Clave de la empresa</label>
                <input type="text" class="form-control" name="company_key" placeholder="Escriba la clave de la empresa" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Clave del empleado</label>
                <input type="text" class="form-control" name="employee_key" placeholder="Escriba la clave del empleado" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Ubicación de la empresa</label>
                <input type="text" class="form-control" name="company_location" placeholder="Escriba la ubicación de su empresa" required>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success fw-bold px-5 py-2 rounded-3">
                    Enviar Solicitud
                </button>
            </div>

        </form>

    </div>

@endsection
