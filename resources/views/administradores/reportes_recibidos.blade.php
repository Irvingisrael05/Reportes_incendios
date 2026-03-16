@extends('layouts.menu_administradores')

@section('contenido')

    @vite(['resources/css/reportes_recibidos.css'])

    <h2 class="titulo-reportes">
        Gestion de Reportes de Incendio
    </h2>

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

    <ul class="nav nav-tabs mb-4" id="tabsReportes" role="tablist">

        <li class="nav-item" role="presentation">
            <button class="nav-link active"
                    id="recibidos-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#recibidos"
                    type="button"
                    role="tab"
                    aria-controls="recibidos"
                    aria-selected="true">
                Recibidos
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="asignados-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#asignados"
                    type="button"
                    role="tab"
                    aria-controls="asignados"
                    aria-selected="false">
                Asignados
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="proceso-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#proceso"
                    type="button"
                    role="tab"
                    aria-controls="proceso"
                    aria-selected="false">
                En Proceso
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="finalizados-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#finalizados"
                    type="button"
                    role="tab"
                    aria-controls="finalizados"
                    aria-selected="false">
                Finalizados
            </button>
        </li>

    </ul>

    <div class="tab-content" id="tabsContent">

        <!-- RECIBIDOS -->
        <div class="tab-pane fade show active"
             id="recibidos"
             role="tabpanel"
             aria-labelledby="recibidos-tab">

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre completo</th>
                    <th>Usuario</th>
                    <th>Ubicacion</th>
                    <th>Ecosistema</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>

                <tbody>
                @forelse($recibidos as $reporte)
                    <tr>
                        <td>{{ $reporte->report_date }}</td>
                        <td>
                            {{ $reporte->first_name ?? '' }}
                            {{ $reporte->last_name ?? '' }}
                            {{ $reporte->middle_name ?? '' }}
                        </td>
                        <td>{{ $reporte->username ?? '' }}</td>
                        <td>{{ $reporte->location }}</td>
                        <td>{{ $reporte->ecosystem }}</td>
                        <td>{{ $reporte->category }}</td>
                        <td>{{ $reporte->description }}</td>
                        <td>
                            <span class="badge bg-warning text-dark">
                                Recibido
                            </span>
                        </td>
                        <td>
                            <button type="button"
                                    class="btn btn-sm btn-outline-primary"
                                    title="Asignar autoridad"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalAsignar{{ $reporte->id_report }}">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="16"
                                     height="16"
                                     fill="currentColor"
                                     class="bi bi-pencil-square"
                                     viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706l-1.793 1.793-2.647-2.647L12.855.998a.5.5 0 0 1 .707 0z"/>
                                    <path d="M1 13.5V16h2.5l7.373-7.373-2.5-2.5z"/>
                                    <path fill-rule="evenodd" d="M1 1.5A1.5 1.5 0 0 1 2.5 0h8A1.5 1.5 0 0 1 12 1.5V4h-1V1.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v11a.5.5 0 0 0 .5.5H6v1H2.5A1.5 1.5 0 0 1 1 13.5z"/>
                                </svg>
                            </button>

                            <div class="modal fade"
                                 id="modalAsignar{{ $reporte->id_report }}"
                                 tabindex="-1"
                                 aria-labelledby="modalAsignarLabel{{ $reporte->id_report }}"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.reportes.asignar_proceso', $reporte->id_report) }}" method="POST">
                                            @csrf

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalAsignarLabel{{ $reporte->id_report }}">
                                                    Seleccionar autoridad
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>

                                            <div class="modal-body">
                                                <p><strong>Reporte:</strong> {{ $reporte->description }}</p>

                                                <div class="mb-3">
                                                    <label for="authority_id_{{ $reporte->id_report }}" class="form-label">
                                                        Autoridad
                                                    </label>
                                                    <select name="authority_id"
                                                            id="authority_id_{{ $reporte->id_report }}"
                                                            class="form-select"
                                                            required>
                                                        <option value="">Seleccione una autoridad</option>
                                                        @forelse($autoridades as $autoridad)
                                                            <option value="{{ $autoridad->id_user }}">
                                                                {{ $autoridad->first_name }}
                                                                {{ $autoridad->last_name }}
                                                                {{ $autoridad->middle_name ?? '' }}
                                                                - {{ $autoridad->username }}
                                                            </option>
                                                        @empty
                                                            <option value="">No hay autoridades disponibles</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Cancelar
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    Aceptar
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
                        <td colspan="9" class="text-center">
                            No hay reportes recibidos
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- ASIGNADOS -->
        <div class="tab-pane fade"
             id="asignados"
             role="tabpanel"
             aria-labelledby="asignados-tab">

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre completo</th>
                    <th>Usuario</th>
                    <th>Ubicacion</th>
                    <th>Ecosistema</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                </tr>
                </thead>

                <tbody>
                @forelse($asignados as $reporte)
                    <tr>
                        <td>{{ $reporte->report_date }}</td>
                        <td>
                            {{ $reporte->first_name ?? '' }}
                            {{ $reporte->last_name ?? '' }}
                            {{ $reporte->middle_name ?? '' }}
                        </td>
                        <td>{{ $reporte->username ?? '' }}</td>
                        <td>{{ $reporte->location }}</td>
                        <td>{{ $reporte->ecosystem }}</td>
                        <td>{{ $reporte->category }}</td>
                        <td>{{ $reporte->description }}</td>
                        <td>
                            <span class="badge bg-secondary">
                                Asignado
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            No hay reportes asignados
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- EN PROCESO -->
        <div class="tab-pane fade"
             id="proceso"
             role="tabpanel"
             aria-labelledby="proceso-tab">

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre completo</th>
                    <th>Usuario</th>
                    <th>Ubicacion</th>
                    <th>Ecosistema</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                </tr>
                </thead>

                <tbody>
                @forelse($proceso as $reporte)
                    <tr>
                        <td>{{ $reporte->report_date }}</td>
                        <td>
                            {{ $reporte->first_name ?? '' }}
                            {{ $reporte->last_name ?? '' }}
                            {{ $reporte->middle_name ?? '' }}
                        </td>
                        <td>{{ $reporte->username ?? '' }}</td>
                        <td>{{ $reporte->location }}</td>
                        <td>{{ $reporte->ecosystem }}</td>
                        <td>{{ $reporte->category }}</td>
                        <td>{{ $reporte->description }}</td>
                        <td>
                            <span class="badge bg-primary">
                                En Proceso
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            No hay reportes en proceso
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- FINALIZADOS -->
        <div class="tab-pane fade"
             id="finalizados"
             role="tabpanel"
             aria-labelledby="finalizados-tab">

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre completo</th>
                    <th>Usuario</th>
                    <th>Ubicacion</th>
                    <th>Ecosistema</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                </tr>
                </thead>

                <tbody>
                @forelse($finalizados as $reporte)
                    <tr>
                        <td>{{ $reporte->report_date }}</td>
                        <td>
                            {{ $reporte->first_name ?? '' }}
                            {{ $reporte->last_name ?? '' }}
                            {{ $reporte->middle_name ?? '' }}
                        </td>
                        <td>{{ $reporte->username ?? '' }}</td>
                        <td>{{ $reporte->location }}</td>
                        <td>{{ $reporte->ecosystem }}</td>
                        <td>{{ $reporte->category }}</td>
                        <td>{{ $reporte->description }}</td>
                        <td>
                            <span class="badge bg-success">
                                Finalizado
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            No hay reportes finalizados
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection
