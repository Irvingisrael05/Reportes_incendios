@extends('layouts.menu_administradores')

@section('contenido')
    @vite(['resources/css/asignar_reportes.css'])

    <h3 class="fw-bold text-success mb-4">
        Asignar Reportes a Autoridades
    </h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                                <form action="{{ route('admin.asignaciones.store', $reporte->id_report) }}" method="POST">
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

                                    <button type="submit" class="btn btn-success btn-sm mt-2">
                                        Asignar Reporte
                                    </button>
                                </form>
                            </td>
                        </tr>
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

                                <form action="{{ route('admin.asignaciones.cancel', $asignacion->id_assignment) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Deseas cancelar esta asignacion? El reporte volvera a Recibido.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Cancelar
                                    </button>
                                </form>

                                <div class="modal fade"
                                     id="modalReasignar{{ $asignacion->id_assignment }}"
                                     tabindex="-1"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.asignaciones.update', $asignacion->id_assignment) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Reasignar autoridad</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Seleccionar nueva autoridad</label>
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

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Cerrar
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        Guardar cambios
                                                    </button>
                                                </div>
                                            </form>
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

@endsection
