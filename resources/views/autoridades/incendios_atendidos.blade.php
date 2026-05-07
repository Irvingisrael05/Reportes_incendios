@extends('layouts.menu_autoridades')

@section('contenido')
    @vite(['resources/css/incendios_atendidos.css'])

    <h3 class="fw-bold text-success mb-4">
        Incendios Atendidos
    </h3>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-success text-white">
            <tr>
                <th>Fecha de Reporte</th>
                <th>Fecha de Atencion</th>
                <th>Ubicacion</th>
                <th>Ecosistema</th>
                <th>Categoria</th>
                <th>Estado</th>
                <th>Detalle</th>
            </tr>
            </thead>

            <tbody>
            @forelse($reports as $report)
                <tr>
                    <td>{{ $report->report_date }}</td>
                    <td>{{ $report->attended_date }}</td>
                    <td>{{ $report->location }}</td>
                    <td>{{ $report->ecosystem }}</td>
                    <td>{{ $report->category }}</td>
                    <td>
                        <span class="badge bg-success">
                            {{ $report->status }}
                        </span>
                    </td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-success btn-sm rounded-pill"
                            data-bs-toggle="modal"
                            data-bs-target="#detalleIncendio{{ $report->id_report }}">
                            Ver detalle
                        </button>
                    </td>
                </tr>

                <!-- MODAL DETALLE INCENDIO -->
                <div class="modal fade" id="detalleIncendio{{ $report->id_report }}" tabindex="-1" aria-labelledby="detalleIncendioLabel{{ $report->id_report }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 shadow-lg rounded-4">

                            <div class="modal-header bg-success text-white rounded-top-4">
                                <h5 class="modal-title" id="detalleIncendioLabel{{ $report->id_report }}">
                                    Detalle del incendio atendido
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
                                        <strong>Fecha de Reporte:</strong>
                                        <p>{{ $report->report_date }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Fecha de Atencion:</strong>
                                        <p>{{ $report->attended_date }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Ubicacion:</strong>
                                        <p>{{ $report->location }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Ecosistema:</strong>
                                        <p>{{ $report->ecosystem }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Categoria:</strong>
                                        <p>{{ $report->category }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <strong>Estado:</strong><br>
                                        <span class="badge bg-success">
                                            {{ $report->status }}
                                        </span>
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
                    <td colspan="7" class="text-center">
                        No hay incendios atendidos
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
