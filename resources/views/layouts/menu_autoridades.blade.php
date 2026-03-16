<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Autoridad</title>

    @vite([
        'resources/css/app.css',
        'resources/css/Menu_Autoridades.css',
        'resources/js/app.js'
    ])
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR ESTÁTICO -->
        <div class="col-md-3 col-lg-2 sidebar-custom min-vh-100 p-4 text-white">

            <div class="text-center mb-4">
                <img src="{{ asset('img/logo.jpeg') }}"
                     class="img-fluid mb-3 rounded-circle shadow"
                     style="max-width:90px;border:4px solid #FFC107;">
                <h5 class="fw-bold">Panel Autoridad</h5>
                <small class="text-light">Sistema de Incendios Forestales</small>
            </div>

            <!-- INFORMACIÓN DEL USUARIO -->
            <div class="user-info mt-3 p-3 text-white">
                <p><strong>Nombre:</strong><br>
                    {{ Auth::user()->person->first_name ?? '' }}
                    {{ Auth::user()->person->middle_name ?? '' }}
                    {{ Auth::user()->person->last_name ?? '' }}
                </p>

                <p><strong>Usuario:</strong><br>
                    {{ Auth::user()->username }}
                </p>

                <p><strong>Correo:</strong><br>
                    {{ Auth::user()->person->email ?? '' }}
                </p>
            </div>

            <!-- MENÚ -->
            <div class="d-grid gap-3 mt-3">
                <a href="{{ route('reportes.asignados') }}" class="btn btn-light text-warning fw-semibold rounded-3">
                    Ver Incendios Asignados
                </a>
                <a href="{{ route('incendios.atendidos') }}" class="btn btn-success rounded-3 text-white">
                    Ver Incendios Atendidos
                </a>
                <a href="{{ url('/perfil-autoridad') }}" class="btn btn-info rounded-3 text-white">
                    Ver Mi Perfil
                </a>
            </div>

            <!-- LOGOUT -->
            <div class="mt-5">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-light w-100 rounded-3">
                        Cerrar Sesión
                    </button>
                </form>
            </div>

        </div>

        <!-- CONTENIDO DINÁMICO -->
        <div class="col-md-9 col-lg-10 p-5">
            @yield('contenido')
        </div>

    </div>
</div>

</body>
</html>
