@extends('layouts.menu_usuarios')

@section('contenido')

    @vite(['resources/css/solicitud_autoridades.css'])

    <div class="card shadow-lg border-0 p-5">

        <div class="text-center mb-5">
            <h3 class="fw-bold text-success">Solicitud para ser Autoridad</h3>
            <p class="text-muted">Complete los datos de su institucion</p>
        </div>

        <form id="formSolicitudAutoridad" action="{{ route('solicitud.autoridad.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nombre de la empresa o institucion</label>
                <input type="text" class="form-control" name="company_name" placeholder="Escriba el nombre de su institucion" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Clave de la empresa</label>
                <input type="text" class="form-control" name="company_key" placeholder="Escriba la clave de la empresa" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Clave del empleado</label>
                <input type="text" class="form-control" name="employee_key" placeholder="Escriba la clave del empleado" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Ubicacion de la empresa</label>
                <input type="text" class="form-control" name="company_location" placeholder="Escriba la ubicacion de su empresa" required>
            </div>

            <div class="d-flex justify-content-end">
                <button type="button"
                        class="btn btn-success fw-bold px-5 py-2 rounded-3"
                        data-bs-toggle="modal"
                        data-bs-target="#confirmarSolicitudModal">
                    Enviar Solicitud
                </button>
            </div>

        </form>

    </div>


    <!-- MODAL CONFIRMAR SOLICITUD -->
    <div class="modal fade" id="confirmarSolicitudModal" tabindex="-1" aria-labelledby="confirmarSolicitudModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">

                <div class="modal-header bg-success text-white rounded-top-4">
                    <h5 class="modal-title" id="confirmarSolicitudModalLabel">
                        Confirmar solicitud
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"
                            aria-label="Cerrar">
                    </button>
                </div>

                <div class="modal-body text-center p-4">
                    <div class="mb-3" style="font-size: 48px;">
                        🛡️
                    </div>

                    <h5 class="fw-bold mb-2">¿Deseas enviar esta solicitud?</h5>

                    <p class="text-muted mb-0">
                        Tu solicitud sera revisada por un administrador antes de aprobar tu acceso como autoridad.
                    </p>
                </div>

                <div class="modal-footer justify-content-center border-0 pb-4">
                    <button type="button"
                            class="btn btn-secondary px-4 rounded-pill"
                            data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="button"
                            class="btn btn-success px-4 rounded-pill"
                            onclick="document.getElementById('formSolicitudAutoridad').requestSubmit();">
                        Si, enviar
                    </button>
                </div>

            </div>
        </div>
    </div>


    @if(session('success') || $errors->any())
        <div class="modal fade" id="respuestaSolicitudModal" tabindex="-1" aria-labelledby="respuestaSolicitudModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">

                    <div class="modal-header {{ session('success') ? 'bg-success' : 'bg-danger' }} text-white rounded-top-4">
                        <h5 class="modal-title" id="respuestaSolicitudModalLabel">
                            {{ session('success') ? 'Solicitud enviada' : 'Datos incorrectos' }}
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
                            <h5 class="fw-bold mb-2">Solicitud registrada correctamente</h5>

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
                const respuestaSolicitudModal = new bootstrap.Modal(document.getElementById('respuestaSolicitudModal'), {
                    backdrop: 'static',
                    keyboard: false
                });

                respuestaSolicitudModal.show();
            });
        </script>
    @endif

@endsection
