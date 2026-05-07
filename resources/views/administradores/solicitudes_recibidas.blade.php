@extends('layouts.menu_administradores')

@section('contenido')

    @vite(['resources/css/solicitudes_recibidas.css'])

    <h3 class="fw-bold text-success mb-4">
        Solicitudes para Autoridad
    </h3>

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
                        <button type="button"
                                class="btn btn-success btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#aprobarModal{{ $solicitud->id_request }}">
                            Aprobar
                        </button>

                        <button type="button"
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#rechazarModal{{ $solicitud->id_request }}">
                            Rechazar
                        </button>
                    </td>
                </tr>

                <!-- MODAL APROBAR -->
                <div class="modal fade" id="aprobarModal{{ $solicitud->id_request }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4">

                            <div class="modal-header bg-success text-white rounded-top-4">
                                <h5 class="modal-title">
                                    Aprobar solicitud
                                </h5>

                                <button type="button"
                                        class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"
                                        aria-label="Cerrar">
                                </button>
                            </div>

                            <div class="modal-body text-center p-4">
                                <div class="mb-3" style="font-size: 48px;">
                                    ✅
                                </div>

                                <h5 class="fw-bold mb-2">¿Deseas aprobar esta solicitud?</h5>

                                <p class="text-muted mb-0">
                                    El usuario pasara a tener permisos de autoridad dentro del sistema.
                                </p>
                            </div>

                            <div class="modal-footer justify-content-center border-0 pb-4">
                                <button type="button"
                                        class="btn btn-secondary rounded-pill px-4"
                                        data-bs-dismiss="modal">
                                    Cancelar
                                </button>

                                <form action="{{ route('admin.solicitudes.aprobar', $solicitud->id_request) }}" method="POST">
                                    @csrf

                                    <button type="submit"
                                            class="btn btn-success rounded-pill px-4">
                                        Si, aprobar
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- MODAL RECHAZAR -->
                <div class="modal fade" id="rechazarModal{{ $solicitud->id_request }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4">

                            <div class="modal-header bg-danger text-white rounded-top-4">
                                <h5 class="modal-title">
                                    Rechazar solicitud
                                </h5>

                                <button type="button"
                                        class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"
                                        aria-label="Cerrar">
                                </button>
                            </div>

                            <div class="modal-body text-center p-4">
                                <div class="mb-3" style="font-size: 48px;">
                                    ⚠️
                                </div>

                                <h5 class="fw-bold mb-2">¿Deseas rechazar esta solicitud?</h5>

                                <p class="text-muted mb-0">
                                    La solicitud sera rechazada y el usuario conservara su rol actual.
                                </p>
                            </div>

                            <div class="modal-footer justify-content-center border-0 pb-4">
                                <button type="button"
                                        class="btn btn-secondary rounded-pill px-4"
                                        data-bs-dismiss="modal">
                                    Cancelar
                                </button>

                                <form action="{{ route('admin.solicitudes.rechazar', $solicitud->id_request) }}" method="POST">
                                    @csrf

                                    <button type="submit"
                                            class="btn btn-danger rounded-pill px-4">
                                        Si, rechazar
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

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

    @if(session('success'))
        <div class="modal fade" id="successSolicitudModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">

                    <div class="modal-header bg-success text-white rounded-top-4">
                        <h5 class="modal-title">
                            Proceso realizado
                        </h5>

                        <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal"
                                aria-label="Cerrar">
                        </button>
                    </div>

                    <div class="modal-body text-center p-4">
                        <div class="mb-3" style="font-size: 48px;">
                            ✅
                        </div>

                        <h5 class="fw-bold mb-2">Operacion exitosa</h5>

                        <p class="text-muted mb-0">
                            {{ session('success') }}
                        </p>
                    </div>

                    <div class="modal-footer justify-content-center border-0 pb-4">
                        <button type="button"
                                class="btn btn-success rounded-pill px-4"
                                data-bs-dismiss="modal">
                            Entendido
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const successSolicitudModal = new bootstrap.Modal(document.getElementById('successSolicitudModal'), {
                    backdrop: 'static',
                    keyboard: false
                });

                successSolicitudModal.show();
            });
        </script>
    @endif

@endsection
