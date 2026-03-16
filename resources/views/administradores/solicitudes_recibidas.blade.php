@extends('layouts.menu_administradores')

@section('contenido')

    @vite(['resources/css/solicitudes_recibidas.css'])

    <h3 class="fw-bold text-success mb-4">
        Solicitudes para Autoridad
    </h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">

        <table class="table table-bordered table-hover table-striped">

            <thead class="encabezado-tabla">
            <tr>
                <th>Nombre Completo</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>Empresa / Institucion</th>
                <th>Clave Empresa</th>
                <th>Clave Empleado</th>
                <th>Ubicacion Empresa</th>
                <th>Acciones</th>
            </tr>
            </thead>

            <tbody>

            @forelse($solicitudes as $solicitud)
                <tr>
                    <td>
                        {{ $solicitud->first_name ?? '' }}
                        {{ $solicitud->last_name ?? '' }}
                        {{ $solicitud->middle_name ?? '' }}
                    </td>

                    <td>
                        {{ $solicitud->email ?? '' }}
                    </td>

                    <td>
                        {{ $solicitud->username ?? '' }}
                    </td>

                    <td>
                        {{ $solicitud->company_name }}
                    </td>

                    <td>
                        {{ $solicitud->company_key }}
                    </td>

                    <td>
                        {{ $solicitud->employee_key }}
                    </td>

                    <td>
                        {{ $solicitud->company_location }}
                    </td>

                    <td class="acciones d-flex gap-2">
                        <form action="{{ route('admin.solicitudes.aprobar', $solicitud->id_request) }}" method="POST"
                              onsubmit="return confirm('¿Deseas aprobar esta solicitud?')">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">
                                Aprobar
                            </button>
                        </form>

                        <form action="{{ route('admin.solicitudes.rechazar', $solicitud->id_request) }}" method="POST"
                              onsubmit="return confirm('¿Deseas rechazar esta solicitud?')">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">
                                Rechazar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        No hay solicitudes pendientes
                    </td>
                </tr>
            @endforelse

            </tbody>

        </table>

    </div>

@endsection
