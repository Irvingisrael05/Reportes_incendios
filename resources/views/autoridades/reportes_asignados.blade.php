@extends('layouts.menu_autoridades')

@section('contenido')
    @vite(['resources/css/Reportes_Asignados.css'])

    <h3 class="fw-bold text-success mb-4">
        Reportes Asignados a la Autoridad
    </h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-success text-white">
            <tr>
                <th>Fecha de Reporte</th>
                <th>Ubicacion</th>
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
                            <form action="{{ route('autoridad.reportes.aceptar', $report->id_report) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Deseas aceptar este reporte?')">
                                @csrf
                                <button type="submit"
                                        class="btn btn-success btn-sm"
                                        title="Aceptar reporte">
                                    Aceptar
                                </button>
                            </form>

                            <form action="{{ route('autoridad.reportes.rechazar', $report->id_report) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Deseas rechazar este reporte? Regresara a Recibidos.')">
                                @csrf
                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        title="Rechazar reporte">
                                    Rechazar
                                </button>
                            </form>
                        @endif

                        @if($report->status_id == 3)
                            <form action="{{ route('autoridad.reportes.atender', $report->id_report) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Deseas marcar este reporte como atendido?')">
                                @csrf
                                <button type="submit"
                                        class="btn btn-success btn-sm"
                                        title="Marcar como atendido">
                                    Atender
                                </button>
                            </form>
                        @endif

                        <button class="btn btn-info btn-sm"
                                type="button"
                                onclick="toggleDetails('detalle{{ $report->id_report }}')">
                            Ver Detalles
                        </button>
                    </td>
                </tr>

                <tr id="detalle{{ $report->id_report }}" class="collapse">
                    <td colspan="7">
                        <div class="p-3 bg-light">
                            <h5 class="fw-bold">Detalles del Reporte</h5>
                            <ul class="mb-3">
                                <li><strong>ID Reporte:</strong> {{ $report->id_report }}</li>
                                <li><strong>Fecha de reporte:</strong> {{ $report->report_date }}</li>
                                <li><strong>Fecha de asignacion:</strong> {{ $report->assignment_date }}</li>
                                <li><strong>Ubicacion:</strong> {{ $report->location }}</li>
                                <li><strong>Latitud:</strong> {{ $report->latitude }}</li>
                                <li><strong>Longitud:</strong> {{ $report->longitude }}</li>
                                <li><strong>Ecosistema:</strong> {{ $report->ecosystem }}</li>
                                <li><strong>Categoria:</strong> {{ $report->category }}</li>
                                <li><strong>Descripcion:</strong> {{ $report->description }}</li>
                                <li><strong>Estado:</strong> {{ $report->status }}</li>
                            </ul>

                            <button class="btn btn-warning btn-sm"
                                    type="button"
                                    onclick="toggleDetails('detalle{{ $report->id_report }}')">
                                Ocultar Detalles
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        No tienes reportes asignados
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function toggleDetails(id) {
            const details = document.getElementById(id);
            details.classList.toggle('collapse');
        }
    </script>
@endsection
