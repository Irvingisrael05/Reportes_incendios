@extends('layouts.menu_autoridades')

@section('contenido')
    @vite(['resources/css/reportes_asignados.css'])

    <h3 class="fw-bold text-success mb-4">
        Reportes Asignados a la Autoridad
    </h3>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-success text-white">
            <tr>
                <th>Fecha de Reporte</th>
                <th>Ubicacion</th>
                <th>Municipio / Localidad</th>
                <th>Ecosistema</th>
                <th>Categoria</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>

            <tbody>
            @forelse($reports as $report)
                <tr>
                    <td>{{ $report->report_date }}</td>

                    <td>{{ $report->location }}</td>

                    <td>
                        <strong>Municipio:</strong>
                        {{ $report->municipality ?? 'No disponible' }}
                        <br>
                        <strong>Localidad:</strong>
                        {{ $report->locality ?? 'No disponible' }}
                    </td>

                    <td>{{ $report->ecosystem }}</td>
                    <td>{{ $report->category }}</td>
                    <td>{{ $report->description }}</td>

                    <td>
                        @if($report->status_id == 2)
                            <span class="badge bg-secondary">Asignado</span>
                        @elseif($report->status_id == 3)
                            <span class="badge bg-primary">En Proceso</span>
                        @else
                            <span class="badge bg-warning text-dark">{{ $report->status }}</span>
                        @endif
                    </td>

                    <td class="d-flex gap-2 flex-wrap">
                        @if($report->status_id == 2)
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#aceptarModal{{ $report->id_report }}">
                                Aceptar
                            </button>

                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rechazarModal{{ $report->id_report }}">
                                Rechazar
                            </button>
                        @endif

                        @if($report->status_id == 3)
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#atenderModal{{ $report->id_report }}">
                                Atender
                            </button>
                        @endif

                        <button class="btn btn-info btn-sm" type="button" onclick="toggleDetails('detalle{{ $report->id_report }}')">
                            Ver Detalles
                        </button>
                    </td>
                </tr>

                <tr id="detalle{{ $report->id_report }}" class="collapse">
                    <td colspan="8">
                        <div class="p-3 bg-light">
                            <h5 class="fw-bold">Detalles del Reporte</h5>

                            <ul class="mb-3">
                                <li><strong>ID Reporte:</strong> {{ $report->id_report }}</li>
                                <li><strong>Fecha de reporte:</strong> {{ $report->report_date }}</li>
                                <li><strong>Fecha de asignacion:</strong> {{ $report->assignment_date }}</li>
                                <li><strong>Ubicacion:</strong> {{ $report->location }}</li>
                                <li><strong>Municipio:</strong> {{ $report->municipality ?? 'No disponible' }}</li>
                                <li><strong>Localidad:</strong> {{ $report->locality ?? 'No disponible' }}</li>
                                <li><strong>Latitud:</strong> {{ $report->latitude }}</li>
                                <li><strong>Longitud:</strong> {{ $report->longitude }}</li>
                                <li><strong>Ecosistema:</strong> {{ $report->ecosystem }}</li>
                                <li><strong>Categoria:</strong> {{ $report->category }}</li>
                                <li><strong>Descripcion:</strong> {{ $report->description }}</li>
                                <li><strong>Estado:</strong> {{ $report->status }}</li>
                            </ul>

                            <button class="btn btn-warning btn-sm" type="button" onclick="toggleDetails('detalle{{ $report->id_report }}')">
                                Ocultar Detalles
                            </button>
                        </div>
                    </td>
                </tr>

                @if($report->status_id == 2)
                    <!-- MODAL ACEPTAR -->
                    <div class="modal fade" id="aceptarModal{{ $report->id_report }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg rounded-4">
                                <div class="modal-header bg-success text-white rounded-top-4">
                                    <h5 class="modal-title">Aceptar reporte</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body text-center p-4">
                                    <div class="mb-3" style="font-size: 48px;">✅</div>
                                    <h5 class="fw-bold">¿Deseas aceptar este reporte?</h5>
                                    <p class="text-muted mb-0">El reporte pasara a estado En Proceso.</p>
                                </div>

                                <div class="modal-footer justify-content-center border-0 pb-4">
                                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                        Cancelar
                                    </button>

                                    <form action="{{ route('autoridad.reportes.aceptar', $report->id_report) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success rounded-pill px-4">
                                            Si, aceptar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL RECHAZAR -->
                    <div class="modal fade" id="rechazarModal{{ $report->id_report }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg rounded-4">
                                <div class="modal-header bg-danger text-white rounded-top-4">
                                    <h5 class="modal-title">Rechazar reporte</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body text-center p-4">
                                    <div class="mb-3" style="font-size: 48px;">⚠️</div>
                                    <h5 class="fw-bold">¿Deseas rechazar este reporte?</h5>
                                    <p class="text-muted mb-0">El reporte regresara a Recibidos para que pueda ser reasignado.</p>
                                </div>

                                <div class="modal-footer justify-content-center border-0 pb-4">
                                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                        Cancelar
                                    </button>

                                    <form action="{{ route('autoridad.reportes.rechazar', $report->id_report) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                                            Si, rechazar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($report->status_id == 3)
                    <!-- MODAL ATENDER -->
                    <div class="modal fade" id="atenderModal{{ $report->id_report }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg rounded-4">
                                <div class="modal-header bg-success text-white rounded-top-4">
                                    <h5 class="modal-title">Marcar como atendido</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body text-center p-4">
                                    <div class="mb-3" style="font-size: 48px;">🔥</div>
                                    <h5 class="fw-bold">¿Deseas marcar este reporte como atendido?</h5>
                                    <p class="text-muted mb-0">
                                        Esta accion indicara que el incendio ya fue atendido por la autoridad.
                                    </p>
                                </div>

                                <div class="modal-footer justify-content-center border-0 pb-4">
                                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                        Cancelar
                                    </button>

                                    <form action="{{ route('autoridad.reportes.atender', $report->id_report) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success rounded-pill px-4">
                                            Si, atender
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        No tienes reportes asignados
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if(session('success'))
        <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header bg-success text-white rounded-top-4">
                        <h5 class="modal-title">Proceso realizado</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center p-4">
                        <div class="mb-3" style="font-size: 48px;">✅</div>
                        <h5 class="fw-bold">Operacion exitosa</h5>
                        <p class="text-muted mb-0">
                            {{ session('success') }}
                        </p>
                    </div>

                    <div class="modal-footer justify-content-center border-0 pb-4">
                        <button type="button" class="btn btn-success rounded-pill px-4" data-bs-dismiss="modal">
                            Entendido
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const successModal = new bootstrap.Modal(document.getElementById('successModal'), {
                    backdrop: 'static',
                    keyboard: false
                });

                successModal.show();
            });
        </script>
    @endif

    <script>
        function toggleDetails(id) {
            const details = document.getElementById(id);
            details.classList.toggle('collapse');
        }
    </script>
@endsection
