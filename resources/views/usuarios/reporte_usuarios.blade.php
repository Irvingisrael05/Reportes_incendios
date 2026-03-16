{{-- resources/views/usuarios/reporte_usuarios.blade.php --}}
@extends('layouts.menu_usuarios')

@section('contenido')

    @vite(['resources/css/Reporte_Usuarios.css'])

    <h2 class="titulo-reportes">
        Mis Reportes de Incendio
    </h2>

    <div class="table-container">

        <table class="table table-hover table-bordered">

            <thead>
            <tr>
                <th>Fecha</th>
                <th>Latitud</th>
                <th>Longitud</th>
                <th>Ecosistema</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Detalles</th>
            </tr>
            </thead>

            <tbody>
            @forelse($reports as $report)
                <tr>
                    <td>{{ $report->report_date }}</td>
                    <td>{{ $report->latitude }}</td>
                    <td>{{ $report->longitude }}</td>
                    <td>{{ $report->ecosystem->description ?? 'N/A' }}</td>
                    <td>{{ $report->description }}</td>
                    <td>
                        @if($report->status->description == 'En proceso')
                            <span class="badge bg-warning text-dark">
                                    {{ $report->status->description }}
                                </span>
                        @elseif($report->status->description == 'Atendido')
                            <span class="badge bg-success">
                                    {{ $report->status->description }}
                                </span>
                        @else
                            <span class="badge bg-danger">
                                    {{ $report->status->description }}
                                </span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm"
                                onclick="toggleDetails('detalle{{ $report->id_report }}')">
                            Ver Detalles
                        </button>
                    </td>
                </tr>

                <!-- Fila de detalles expandibles -->
                <tr id="detalle{{ $report->id_report }}" class="collapse">
                    <td colspan="7">
                        <div class="details-box p-3 bg-light rounded">
                            <h5>Detalles del Reporte</h5>
                            <ul>
                                <li><strong>Fecha:</strong> {{ $report->report_date }}</li>
                                <li><strong>Latitud:</strong> {{ $report->latitude }}</li>
                                <li><strong>Longitud:</strong> {{ $report->longitude }}</li>
                                <li><strong>Descripción:</strong> {{ $report->description }}</li>
                                <li><strong>Estado:</strong> {{ $report->status->description }}</li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        No tienes reportes registrados
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>

    </div>

    <script>
        function toggleDetails(id) {
            const row = document.getElementById(id);
            row.classList.toggle('collapse');
        }
    </script>

@endsection
