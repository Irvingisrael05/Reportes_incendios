{{-- resources/views/usuarios/reporte_usuarios.blade.php --}}
@extends('layouts.menu_usuarios')

@section('contenido')

    @vite(['resources/css/reporte_usuarios.css'])

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
                <th>Municipio</th>
                <th>Localidad</th>
                <th>Vegetación</th>
                <th>Categoria</th>
                <th>Descripcion</th>
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
                    <td>{{ $report->municipality ?? 'No disponible' }}</td>
                    <td>{{ $report->locality ?? 'No disponible' }}</td>

                    <td>{{ $report->ecosystem->description ?? 'N/A' }}</td>

                    <td>
                        {{ $report->category->description ?? 'Sin categoria' }}
                    </td>

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
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#detalleReporte{{ $report->id_report }}">
                            Ver Detalles
                        </button>
                    </td>
                </tr>

                <!-- MODAL DETALLES -->
                <div class="modal fade"
                     id="detalleReporte{{ $report->id_report }}"
                     tabindex="-1"
                     aria-labelledby="detalleReporteLabel{{ $report->id_report }}"
                     aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered modal-lg">

                        <div class="modal-content border-0 shadow-lg rounded-4">

                            <div class="modal-header bg-info text-white rounded-top-4">

                                <h5 class="modal-title"
                                    id="detalleReporteLabel{{ $report->id_report }}">

                                    Detalles del Reporte
                                </h5>

                                <button type="button"
                                        class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"
                                        aria-label="Cerrar">
                                </button>

                            </div>

                            <div class="modal-body p-4">

                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <strong>Fecha:</strong>
                                        <p>{{ $report->report_date }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Vegetación:</strong>
                                        <p>{{ $report->ecosystem->description ?? 'N/A' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Categoria:</strong>
                                        <p>
                                            {{ $report->category->description ?? 'Sin categoria' }}
                                        </p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Latitud:</strong>
                                        <p>{{ $report->latitude }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Longitud:</strong>
                                        <p>{{ $report->longitude }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Municipio:</strong>
                                        <p>{{ $report->municipality ?? 'No disponible' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Localidad:</strong>
                                        <p>{{ $report->locality ?? 'No disponible' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Estado:</strong><br>

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
                                    </div>

                                    <div class="col-12">
                                        <strong>Descripcion:</strong>

                                        <p class="mt-2">
                                            {{ $report->description }}
                                        </p>
                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer border-0">

                                <button type="button"
                                        class="btn btn-secondary rounded-pill px-4"
                                        data-bs-dismiss="modal">

                                    Cerrar
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            @empty
                <tr>
                    <td colspan="10" class="text-center">
                        No tienes reportes registrados
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>

    </div>

@endsection
