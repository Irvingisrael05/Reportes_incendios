@extends('layouts.menu_administradores')

@section('contenido')
    <div class="container-fluid px-0">
        <h1 class="h2 mb-4 text-success fw-bold">📋 Registros de Auditoria</h1>

        <!-- Formulario de filtros -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.audit') }}" class="row g-3 align-items-end">

                    <div class="col-md-3">
                        <label for="table" class="form-label fw-semibold">Tabla</label>
                        <select name="table" id="table" class="form-select">
                            <option value="">Todas</option>
                            @foreach($tablas as $tab)
                                <option value="{{ $tab }}" {{ request('table') == $tab ? 'selected' : '' }}>
                                    {{ $tab }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label for="operation" class="form-label fw-semibold">Operacion</label>
                        <select name="operation" id="operation" class="form-select">
                            <option value="">Todas</option>

                            <option value="INSERT"
                                {{ request('operation') == 'INSERT' ? 'selected' : '' }}>
                                INSERT
                            </option>

                            <option value="UPDATE"
                                {{ request('operation') == 'UPDATE' ? 'selected' : '' }}>
                                UPDATE
                            </option>

                            <option value="DELETE"
                                {{ request('operation') == 'DELETE' ? 'selected' : '' }}>
                                DELETE
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label for="changed_by_type" class="form-label fw-semibold">Origen</label>

                        <select name="changed_by_type"
                                id="changed_by_type"
                                class="form-select">

                            <option value="">Todos</option>

                            <option value="app"
                                {{ request('changed_by_type') == 'app' ? 'selected' : '' }}>
                                Aplicacion
                            </option>

                            <option value="postgres"
                                {{ request('changed_by_type') == 'postgres' ? 'selected' : '' }}>
                                SQL directo
                            </option>

                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="date_from" class="form-label fw-semibold">
                            Desde fecha
                        </label>

                        <input type="date"
                               name="date_from"
                               id="date_from"
                               class="form-control"
                               value="{{ request('date_from') }}">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">
                            Filtrar
                        </button>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('admin.audit') }}"
                           class="btn btn-outline-secondary w-100">
                            Limpiar
                        </a>
                    </div>

                </form>
            </div>
        </div>

        <!-- Tabla de logs -->
        <div class="card shadow-sm border-0">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Fecha/Hora</th>
                            <th>Tabla</th>
                            <th>Operacion</th>
                            <th>ID Registro</th>

                            {{-- ====================================================== --}}
                            {{-- AGREGADO:
                                 Separar usuario de Laravel y usuario PostgreSQL
                            --}}
                            {{-- ====================================================== --}}
                            <th>Usuario App</th>
                            <th>Usuario BD</th>

                            <th>Origen</th>
                            <th>IP</th>
                            <th>User Agent</th>
                            <th style="width: 80px">Detalles</th>
                        </tr>
                        </thead>

                        <tbody>

                        @forelse($logs as $log)

                            <tr>

                                <td>{{ $log->id }}</td>

                                <td>
                                    {{ $log->created_at->format('d/m/Y H:i:s') }}
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $log->table_name }}
                                    </span>
                                </td>

                                <td>

                                    @if($log->operation == 'INSERT')

                                        <span class="badge bg-success">
                                            INSERT
                                        </span>

                                    @elseif($log->operation == 'UPDATE')

                                        <span class="badge bg-warning text-dark">
                                            UPDATE
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            DELETE
                                        </span>

                                    @endif

                                </td>

                                <td>{{ $log->record_id }}</td>

                                {{-- ====================================================== --}}
                                {{-- Usuario de Laravel --}}
                                {{-- ====================================================== --}}
                                <td>

                                    @if($log->user)

                                        <span title="{{ $log->user->username }} (ID: {{ $log->changed_by_user_id }})">
                                            {{ $log->user->username }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            N/A
                                        </span>

                                    @endif

                                </td>

                                {{-- ====================================================== --}}
                                {{-- Usuario PostgreSQL --}}
                                {{-- ====================================================== --}}
                                <td>

                                    @if($log->db_user)

                                        <span class="badge bg-dark"
                                              title="Usuario conectado directamente a PostgreSQL">

                                            {{ $log->db_user }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            N/A
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($log->changed_by_type == 'app')

                                        <span class="badge bg-info">
                                            Aplicacion
                                        </span>

                                    @else

                                        <span class="badge bg-dark">
                                            SQL directo
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($log->source_ip)

                                        <code>
                                            {{ $log->source_ip }}
                                        </code>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($log->user_agent)

                                        {{ Str::limit($log->user_agent, 40) }}

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalData{{ $log->id }}">

                                        Ver

                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade"
                                         id="modalData{{ $log->id }}"
                                         tabindex="-1"
                                         aria-hidden="true">

                                        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">

                                            <div class="modal-content border-0 shadow-lg rounded-4">

                                                <div class="modal-header bg-primary text-white rounded-top-4">

                                                    <h5 class="modal-title">
                                                        Cambio en {{ $log->table_name }}
                                                        | Registro ID:
                                                        {{ $log->record_id }}
                                                    </h5>

                                                    <button type="button"
                                                            class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Cerrar">
                                                    </button>

                                                </div>

                                                <div class="modal-body p-4">

                                                    <div class="mb-3 text-muted">

                                                        <strong>Operacion:</strong>
                                                        {{ $log->operation }}
                                                        <br>

                                                        <strong>Fecha/Hora:</strong>
                                                        {{ $log->created_at->format('d/m/Y H:i:s') }}
                                                        <br>

                                                        <strong>Origen:</strong>
                                                        {{ $log->changed_by_type == 'app' ? 'Aplicacion' : 'SQL directo' }}
                                                        <br>

                                                        {{-- Usuario App --}}
                                                        <strong>Usuario App:</strong>
                                                        {{ $log->user->username ?? 'N/A' }}
                                                        <br>

                                                        {{-- Usuario PostgreSQL --}}
                                                        <strong>Usuario BD:</strong>
                                                        {{ $log->db_user ?? 'N/A' }}
                                                        <br>

                                                    </div>

                                                    <ul class="nav nav-tabs"
                                                        id="myTab{{ $log->id }}"
                                                        role="tablist">

                                                        <li class="nav-item" role="presentation">

                                                            <button class="nav-link active"
                                                                    id="old-tab-{{ $log->id }}"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#old-{{ $log->id }}"
                                                                    type="button"
                                                                    role="tab">

                                                                📄 Valores anteriores

                                                            </button>

                                                        </li>

                                                        <li class="nav-item" role="presentation">

                                                            <button class="nav-link"
                                                                    id="new-tab-{{ $log->id }}"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#new-{{ $log->id }}"
                                                                    type="button"
                                                                    role="tab">

                                                                🆕 Valores nuevos

                                                            </button>

                                                        </li>

                                                    </ul>

                                                    <div class="tab-content mt-3">

                                                        <div class="tab-pane fade show active"
                                                             id="old-{{ $log->id }}"
                                                             role="tabpanel">

                                                            <pre class="bg-light p-3 rounded border"
                                                                 style="max-height: 400px; overflow: auto;">{{ json_encode($log->old_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>

                                                        </div>

                                                        <div class="tab-pane fade"
                                                             id="new-{{ $log->id }}"
                                                             role="tabpanel">

                                                            <pre class="bg-light p-3 rounded border"
                                                                 style="max-height: 400px; overflow: auto;">{{ json_encode($log->new_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>

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

                                </td>

                            </tr>

                        @empty

                            <tr>

                                {{-- ====================================================== --}}
                                {{-- Antes era 10, ahora son 11 columnas --}}
                                {{-- ====================================================== --}}
                                <td colspan="11"
                                    class="text-center py-5 text-muted">

                                    No hay registros de auditoria.

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="card-footer bg-white">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        Mostrando
                        {{ $logs->firstItem() ?? 0 }}
                        -
                        {{ $logs->lastItem() ?? 0 }}
                        de
                        {{ $logs->total() }}
                        registros
                    </div>

                    <div>
                        {{ $logs->appends(request()->query())->links() }}
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
