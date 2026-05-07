<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panel Administrador</title>

    @vite([
    'resources/css/app.css',
    'resources/css/menu_administradores.css',
    'resources/js/app.js'
    ])

</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->

        <div class="col-md-3 col-lg-2 sidebar-custom min-vh-100 p-4 text-white">

            <div class="text-center mb-4">

                <img src="{{ asset('img/logo.jpeg') }}"
                     class="img-fluid mb-3 rounded-circle shadow"
                     style="max-width:90px;border:4px solid #66BB6A;">

                <h5 class="fw-bold">Panel Administrador</h5>
                <small class="text-light">Sistema de Reporte Forestal</small>

            </div>

            <!-- INFO ADMIN -->

            <div class="user-info mt-3 p-3 text-white">

                <p><strong>Nombre:</strong><br>
                    {{ Auth::user()->person->first_name ?? '' }}
                    {{ Auth::user()->person->last_name ?? '' }}
                </p>

                <p><strong>Usuario:</strong><br>
                    {{ Auth::user()->username }}
                </p>

                <p><strong>Correo:</strong><br>
                    {{ Auth::user()->person->email ?? '' }}
                </p>

            </div>

            <!-- MENU -->

            <div class="d-grid gap-3">

                <a href="{{ route('menu_administradores') }}"
                   class="btn btn-light text-success fw-semibold rounded-3">
                    Ver Reportes
                </a>

                <a href="{{ route('admin.asignaciones') }}"
                   class="btn rounded-3 text-white">
                    Asignaciones
                </a>

                <a href="{{ route('admin.solicitudes') }}"
                   class="btn btn-warning fw-bold rounded-3">
                    Solicitudes de Autoridad
                </a>

                <a href="{{ route('admin.usuarios') }}"
                   class="btn rounded-3 text-white">
                    Usuarios Registrados
                </a>

                <a href="{{ route('admin.audit')}}"
                   class="btn rounded-3 text-white">
                    Auditoria
                </a>

            </div>

            <!-- LOGOUT -->

            <div class="mt-5">

                <button type="button"
                        class="btn btn-outline-light w-100 rounded-3"
                        data-bs-toggle="modal"
                        data-bs-target="#logoutModal">
                    Cerrar Sesion
                </button>

                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                </form>

            </div>

        </div>


        <!-- CONTENIDO DINAMICO -->

        <div class="col-md-9 col-lg-10 p-5">

            <div class="panel-contenido">

                @yield('contenido')

            </div>

        </div>

    </div>
</div>


<!-- MODAL CONFIRMAR CIERRE DE SESION -->

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-header bg-danger text-white rounded-top-4">
                <h5 class="modal-title" id="logoutModalLabel">
                    Cerrar sesion
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Cerrar">
                </button>
            </div>

            <div class="modal-body text-center p-4">

                <div class="mb-3" style="font-size: 48px;">
                    🚪
                </div>

                <h5 class="fw-bold mb-2">¿Seguro que deseas salir?</h5>

                <p class="text-muted mb-0">
                    Tu sesion actual se cerrara y volveras al inicio de sesion.
                </p>

            </div>

            <div class="modal-footer justify-content-center border-0 pb-4">

                <button type="button"
                        class="btn btn-secondary px-4 rounded-pill"
                        data-bs-dismiss="modal">
                    Cancelar
                </button>

                <button type="button"
                        class="btn btn-danger px-4 rounded-pill"
                        onclick="document.getElementById('logoutForm').submit();">
                    Si, cerrar sesion
                </button>

            </div>

        </div>
    </div>
</div>

</body>
</html>
