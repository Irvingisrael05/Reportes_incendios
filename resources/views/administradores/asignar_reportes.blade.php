@extends('layouts.menu_administradores')

@section('contenido')
    @vite(['resources/css/asignar_reportes.css'])

    <h3 class="fw-bold text-success mb-4">
        Asignar Reportes a Autoridades
    </h3>

    <ul class="nav nav-tabs mb-4" id="tabsAsignaciones" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active"
                    id="asignar-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#asignar"
                    type="button"
                    role="tab"
                    aria-controls="asignar"
                    aria-selected="true">
                Asignar Reporte
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="ver-asignacion-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#ver-asignacion"
                    type="button"
                    role="tab"
                    aria-controls="ver-asignacion"
                    aria-selected="false">
                Ver Asignacion
            </button>
        </li>
    </ul>

    <div class="tab-content" id="tabsAsignacionesContent">

        <!-- TAB 1 -->
        <div class="tab-pane fade show active"
             id="asignar"
             role="tabpanel"
             aria-labelledby="asignar-tab">

            <h4 class="fw-bold text-success mb-3">
                Reportes Generados
            </h4>

            <div class="table-responsive mb-5">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="bg-warning text-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Ubicacion</th>
                        <th>Ecosistema</th>
                        <th>Categoria</th>
                        <th>Descripcion</th>
                        <th>Climatografia</th>
                        <th>Asignar</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($reportes as $reporte)
                        <tr>
                            <td>{{ $reporte->report_date }}</td>
                            <td>{{ $reporte->location }}</td>
                            <td>{{ $reporte->ecosystem }}</td>
                            <td>{{ $reporte->category }}</td>
                            <td>{{ $reporte->description }}</td>
                            <td>{{ $reporte->climatografia }}</td>
                            <td>
                                <form id="formAsignar{{ $reporte->id_report }}"
                                      action="{{ route('admin.asignaciones.store', $reporte->id_report) }}"
                                      method="POST">
                                    @csrf

                                    <select name="authority_id" class="form-select" required>
                                        <option value="">Seleccionar Autoridad</option>
                                        @forelse($autoridades as $autoridad)
                                            <option value="{{ $autoridad->id_user }}">
                                                {{ $autoridad->company_name }} -
                                                {{ $autoridad->first_name }}
                                                {{ $autoridad->last_name }}
                                                {{ $autoridad->middle_name ?? '' }}
                                                ({{ $autoridad->username }})
                                            </option>
                                        @empty
                                            <option value="">No hay autoridades disponibles</option>
                                        @endforelse
                                    </select>

                                    <button type="button"
                                            class="btn btn-success btn-sm mt-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalAsignar{{ $reporte->id_report }}">
                                        Asignar Reporte
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODAL CONFIRMAR ASIGNACION -->
                        <div class="modal fade" id="modalAsignar{{ $reporte->id_report }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg rounded-4">

                                    <div class="modal-header bg-success text-white rounded-top-4">
                                        <h5 class="modal-title">Confirmar asignacion</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body text-center p-4">
                                        <div class="mb-3" style="font-size: 48px;">🛡️</div>
                                        <h5 class="fw-bold">¿Deseas asignar este reporte?</h5>
                                        <p class="text-muted mb-0">
                                            El reporte sera enviado a la autoridad seleccionada.
                                        </p>
                                    </div>

                                    <div class="modal-footer justify-content-center border-0 pb-4">
                                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                            Cancelar
                                        </button>

                                        <button type="button"
                                                class="btn btn-success rounded-pill px-4"
                                                onclick="document.getElementById('formAsignar{{ $reporte->id_report }}').requestSubmit();">
                                            Si, asignar
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                No hay reportes disponibles para asignar
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 2 -->
        <div class="tab-pane fade"
             id="ver-asignacion"
             role="tabpanel"
             aria-labelledby="ver-asignacion-tab">

            <h4 class="fw-bold text-success mb-4">
                Asignacion de Reportes
            </h4>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="bg-info text-white">
                    <tr>
                        <th>Fecha</th>
                        <th>Empresa</th>
                        <th>Responsable</th>
                        <th>Usuario</th>
                        <th>Accion</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($asignaciones as $asignacion)
                        <tr>
                            <td>{{ $asignacion->assignment_date }}</td>
                            <td>{{ $asignacion->company_name }}</td>
                            <td>
                                {{ $asignacion->first_name }}
                                {{ $asignacion->last_name }}
                                {{ $asignacion->middle_name ?? '' }}
                            </td>
                            <td>{{ $asignacion->username }}</td>
                            <td class="d-flex gap-2">

                                <button type="button"
                                        class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalReasignar{{ $asignacion->id_assignment }}">
                                    Reasignar
                                </button>

                                <button type="button"
                                        class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalCancelar{{ $asignacion->id_assignment }}">
                                    Cancelar
                                </button>

                                <!-- MODAL REASIGNAR -->
                                <div class="modal fade"
                                     id="modalReasignar{{ $asignacion->id_assignment }}"
                                     tabindex="-1"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg rounded-4">

                                            <form action="{{ route('admin.asignaciones.update', $asignacion->id_assignment) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header bg-primary text-white rounded-top-4">
                                                    <h5 class="modal-title">Reasignar autoridad</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body p-4">
                                                    <div class="text-center mb-3" style="font-size: 48px;">
                                                        🔄
                                                    </div>

                                                    <p class="text-muted text-center">
                                                        Selecciona la nueva autoridad que atendera este reporte.
                                                    </p>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Seleccionar nueva autoridad</label>
                                                        <select name="authority_id" class="form-select" required>
                                                            <option value="">Seleccione una autoridad</option>
                                                            @foreach($autoridades as $autoridad)
                                                                <option value="{{ $autoridad->id_user }}"
                                                                    {{ $autoridad->id_user == $asignacion->authority_id ? 'selected' : '' }}>
                                                                    {{ $autoridad->company_name }} -
                                                                    {{ $autoridad->first_name }}
                                                                    {{ $autoridad->last_name }}
                                                                    {{ $autoridad->middle_name ?? '' }}
                                                                    ({{ $autoridad->username }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer justify-content-center border-0 pb-4">
                                                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                                        Cerrar
                                                    </button>

                                                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                                                        Guardar cambios
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <!-- MODAL CANCELAR ASIGNACION -->
                                <div class="modal fade" id="modalCancelar{{ $asignacion->id_assignment }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg rounded-4">

                                            <div class="modal-header bg-danger text-white rounded-top-4">
                                                <h5 class="modal-title">Cancelar asignacion</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body text-center p-4">
                                                <div class="mb-3" style="font-size: 48px;">⚠️</div>

                                                <h5 class="fw-bold">¿Deseas cancelar esta asignacion?</h5>

                                                <p class="text-muted mb-0">
                                                    El reporte volvera al estado Recibido y podra asignarse nuevamente.
                                                </p>
                                            </div>

                                            <div class="modal-footer justify-content-center border-0 pb-4">
                                                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                                    No, volver
                                                </button>

                                                <form action="{{ route('admin.asignaciones.cancel', $asignacion->id_assignment) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                                                        Si, cancelar
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No hay asignaciones registradas
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @if(session('success') || $errors->any())
        <div class="modal fade" id="respuestaAsignacionModal" tabindex="-1" aria-labelledby="respuestaAsignacionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">

                    <div class="modal-header {{ session('success') ? 'bg-success' : 'bg-danger' }} text-white rounded-top-4">
                        <h5 class="modal-title" id="respuestaAsignacionModalLabel">
                            {{ session('success') ? 'Proceso realizado' : 'Datos incorrectos' }}
                        </h5>

                        <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal"
                                aria-label="Cerrar">
                        </button>
                    </div>

                    <div class="modal-body text-center p-4">

                        <div class="mb-3" style="font-size: 48px;">
                            {{ session('success') ? '✅' : '⚠️' }}
                        </div>

                        @if(session('success'))
                            <h5 class="fw-bold mb-2">Operacion exitosa</h5>

                            <p class="text-muted mb-0">
                                {{ session('success') }}
                            </p>
                        @endif

                        @if($errors->any())
                            <h5 class="fw-bold mb-3">Revisa la informacion</h5>

                            <ul class="text-start mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                    </div>

                    <div class="modal-footer justify-content-center border-0 pb-4">
                        <button type="button"
                                class="btn {{ session('success') ? 'btn-success' : 'btn-danger' }} px-4 rounded-pill"
                                data-bs-dismiss="modal">
                            Entendido
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const respuestaAsignacionModal = new bootstrap.Modal(document.getElementById('respuestaAsignacionModal'), {
                    backdrop: 'static',
                    keyboard: false
                });

                respuestaAsignacionModal.show();
            });
        </script>
    @endif

@endsection
