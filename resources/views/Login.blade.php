<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion | Incendios Forestales</title>

    @vite(['resources/css/app.css','resources/css/login.css','resources/js/app.js'])
</head>

<body>

<div class="login-card shadow-lg">

    <div class="card-body p-5">

        <div class="text-center mb-4">

            <img src="{{ asset('img/logo.jpeg') }}"
                 class="logo-login mb-3 rounded-circle shadow">

            <h3 class="fw-bold text-success">Iniciar Sesion</h3>

            <p class="text-muted">
                Sistema de Reportes de Incendios Forestales
            </p>

        </div>

        <form method="POST" action="{{ route('login.procesar') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Usuario</label>
                <input type="text" name="username" class="form-control shadow-sm" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Contrasena</label>
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

@if($errors->any())
    <div class="modal fade" id="loginErrorModal" tabindex="-1" aria-labelledby="loginErrorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">

                <div class="modal-header bg-danger text-white rounded-top-4">
                    <h5 class="modal-title" id="loginErrorModalLabel">
                        Acceso no permitido
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body text-center p-4">
                    <div class="mb-3">
                        <span style="font-size: 48px;">⚠️</span>
                    </div>

                    <h5 class="fw-bold mb-2">No pudimos iniciar sesion</h5>

                    <p class="text-muted mb-0">
                        {{ $errors->first() }}
                    </p>
                </div>

                <div class="modal-footer justify-content-center border-0 pb-4">
                    <button type="button" class="btn btn-danger px-4 rounded-pill" data-bs-dismiss="modal">
                        Intentar de nuevo
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loginErrorModal = new bootstrap.Modal(document.getElementById('loginErrorModal'), {
                backdrop: 'static',
                keyboard: false
            });

            loginErrorModal.show();
        });
    </script>
@endif

</body>
</html>
