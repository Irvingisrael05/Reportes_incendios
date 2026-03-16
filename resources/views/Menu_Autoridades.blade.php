<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Autoridad | Incendios Forestales</title>

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
                <h5 class="fw-bold">Panel Autoridad</h5>
            </div>

            <!-- Botones en el lado izquierdo -->
            <div class="d-grid gap-3">
                <!-- Botón de Incendios Asignados -->
                <a href="{{ url('/Reportes_autoridades') }}" class="btn btn-light fw-semibold text-success">
                    Ver Incendios Asignados
                </a>

                <!-- Botón de Incendios Atendidos -->
                <a href="{{ url('/Incendios_atendidos') }}" class="btn btn-light fw-semibold text-success">
                    Ver Incendios Atendidos
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

            <h3 class="fw-bold text-success mb-4">Menu Autoridad</h3>

            <!-- Datos de la Autoridad -->
            <div class="card shadow mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-success mb-3">Datos de la Autoridad</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nombre de la Empresa:</strong> <span class="text-muted">EcoProtección S.A.</span></p>
                            <p><strong>Clave de Trabajo:</strong> <span class="text-muted">ABC12345</span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Nombre del Responsable:</strong> <span class="text-muted">Juan Pérez</span></p>
                            <p><strong>Clave del Empleado:</strong> <span class="text-muted">EMP67890</span></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>
