<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Incendios Forestales</title>

    @vite(['resources/css/app.css','resources/css/Login.css','resources/js/app.js'])
</head>

<body>

<div class="login-card shadow-lg">

    <div class="card-body p-5">

        <div class="text-center mb-4">

            <img src="{{ asset('img/logo.jpeg') }}"
                 class="logo-login mb-3 rounded-circle shadow">

            <h3 class="fw-bold text-success">Iniciar Sesión</h3>

            <p class="text-muted">
                Sistema de Reportes de Incendios Forestales
            </p>

        </div>

        <!-- FORMULARIO CORRECTO -->
        <form method="POST" action="{{ route('login.procesar') }}">
            @csrf

            <!-- Mostrar errores -->
            @if($errors->any())
                <div class="alert alert-danger text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label fw-semibold">Usuario</label>
                <input type="text" name="username" class="form-control shadow-sm" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Contraseña</label>
                <input type="password" name="password" class="form-control shadow-sm" required>
            </div>

            <button type="submit" class="btn btn-login w-100">
                Ingresar
            </button>

            <div class="text-center mt-4">
                <a href="{{ route('register') }}" class="link-login">
                    Crear cuenta
                </a>
            </div>

            <div class="text-center mt-2">
                <a href="/" class="text-secondary text-decoration-none">
                    Volver al inicio
                </a>
            </div>
        </form>

    </div>

</div>

</body>
</html>
