<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Incendios Forestales</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-success bg-gradient d-flex align-items-center justify-content-center vh-100">

<div class="card shadow-lg border-0" style="max-width:450px; width:100%;">
    <div class="card-body p-5">

        <div class="text-center mb-4">
            <img src="{{ asset('img/logo.jpeg') }}" class="img-fluid mb-3" style="max-width:90px;">
            <h3 class="fw-bold text-success">Iniciar Sesión</h3>
            <p class="text-muted">Sistema de Reportes de Incendios Forestales</p>
        </div>

        <!-- FORMULARIO SIN FUNCIONALIDAD -->
        <form>

            <div class="mb-3">
                <label class="form-label fw-semibold">Usuario</label>
                <input type="text" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Contraseña</label>
                <input type="password" class="form-control">
            </div>

            <button type="button" class="btn btn-success w-100 fw-bold">
                Ingresar
            </button>

            <div class="text-center mt-3">
                <a href="/Registro" class="text-decoration-none text-success fw-semibold">
                    Crear cuenta
                </a>
            </div>

            <div class="text-center mt-2">
                <a href="/" class="text-decoration-none text-secondary">
                    Volver al inicio
                </a>
            </div>

        </form>

    </div>
</div>

</body>
</html>
