<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador | Incendios Forestales</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container-fluid py-5">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-3 col-lg-2 bg-success bg-gradient min-vh-100 p-4 text-white">
            <div class="text-center mb-4">
                <img src="{{ asset('img/logo.jpeg') }}" class="img-fluid mb-2" style="max-width:80px;">
                <h5 class="fw-bold">Panel Administrador</h5>
            </div>

            <!-- Botones en el lado izquierdo -->
            <div class="d-grid gap-3">
                <!-- Botón de Reportes -->
                <a href="{{ url('/Reportes_admin') }}" class="btn btn-light fw-semibold text-success">
                    Ver Reportes
                </a>

                <!-- Botón de Ver Usuarios -->
                <a href="{{ url('/Usuarios_registrados') }}" class="btn btn-light fw-semibold text-success">
                    Ver Usuarios Registrados
                </a>

                <!-- Botón de Asignar Reportes -->
                <a href="{{ url('/AsignarReportes') }}" class="btn btn-light fw-semibold text-success">
                    Asignar Reportes a Autoridades
                </a>
            </div>

            <div class="mt-5">
                <a href="/" class="btn btn-outline-light w-100">
                    Cerrar Sesión
                </a>
            </div>
        </div>

        <!-- CONTENIDO -->
        <div class="col-md-9 col-lg-10 p-5">
            <h3 class="fw-bold text-success mb-4">Menu Administrador</h3>

            <!-- Información de la gestión -->
            <div class="card shadow mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-success mb-3">Datos de Gestión</h4>
                    <p class="text-muted">Desde este panel puedes gestionar los reportes, asignar tareas a autoridades y visualizar todos los usuarios registrados.</p>
                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>
