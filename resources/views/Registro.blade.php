<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | Incendios Forestales</title>

    @vite(['resources/css/app.css','resources/css/registro.css','resources/js/app.js'])
</head>

<body class="body-bg">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card card-custom shadow-lg border-0">
                <div class="card-body p-5">

                    <div class="text-center mb-4">
                        <img src="{{ asset('img/logo.jpeg') }}"
                             class="logo-style mb-3 rounded-circle shadow">

                        <h2 class="fw-bold title-main">Crear Cuenta</h2>

                        <p class="text-muted">
                            Sistema de Gestion de Incendios Forestales
                        </p>
                    </div>

                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf

                        <h5 class="section-title">Datos Personales</h5>

                        <div class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Nombre</label>
                                <input
                                    type="text"
                                    name="first_name"
                                    class="form-control shadow-sm"
                                    pattern="^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+$"
                                    title="Debe iniciar con mayuscula y continuar con minusculas. Ejemplo: Juan"
                                    required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Apellido Paterno</label>
                                <input
                                    type="text"
                                    name="last_name"
                                    class="form-control shadow-sm"
                                    pattern="^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+$"
                                    title="Debe iniciar con mayuscula y continuar con minusculas. Ejemplo: Garcia"
                                    required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Apellido Materno</label>
                                <input
                                    type="text"
                                    name="middle_name"
                                    class="form-control shadow-sm"
                                    pattern="^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+$"
                                    title="Debe iniciar con mayuscula y continuar con minusculas. Ejemplo: Lopez">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Correo Electronico</label>
                                <input type="email" name="email" class="form-control shadow-sm" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Telefono</label>
                                <input type="text" name="phone" class="form-control shadow-sm">
                            </div>

                        </div>

                        <h5 class="section-title mt-4">Datos de Usuario</h5>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nombre de Usuario</label>
                                <input type="text" name="username" class="form-control shadow-sm" required>
                            </div>
                        </div>

                        <div class="row g-3 mt-1">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Contrasena</label>

                                <div class="input-group">
                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-control shadow-sm"
                                        required>

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePassword('password','icon1')">
                                        <span id="icon1">👁</span>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Confirmar Contrasena</label>

                                <div class="input-group">
                                    <input
                                        type="password"
                                        id="confirmPassword"
                                        name="password_confirmation"
                                        class="form-control shadow-sm"
                                        required>

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePassword('confirmPassword','icon2')">
                                        <span id="icon2">👁</span>
                                    </button>
                                </div>

                                <small id="mensajePassword" class="fw-semibold"></small>
                            </div>

                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">

                            <a href="{{ route('login') }}" class="btn btn-back">
                                Ya tengo una cuenta
                            </a>

                            <button
                                type="submit"
                                class="btn btn-register fw-bold"
                                id="btnRegistro">
                                Registrarse
                            </button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success') || $errors->any())
    <div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">

                <div class="modal-header {{ session('success') ? 'bg-success' : 'bg-danger' }} text-white rounded-top-4">
                    <h5 class="modal-title" id="registroModalLabel">
                        {{ session('success') ? 'Cuenta creada' : 'Datos incorrectos' }}
                    </h5>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body text-center p-4">

                    <div class="mb-3" style="font-size: 48px;">
                        {{ session('success') ? '✅' : '⚠️' }}
                    </div>

                    @if(session('success'))
                        <h5 class="fw-bold mb-2">Registro exitoso</h5>

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
                    <button
                        type="button"
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
            const registroModal = new bootstrap.Modal(document.getElementById('registroModal'), {
                backdrop: 'static',
                keyboard: false
            });

            registroModal.show();
        });
    </script>
@endif

<script>
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    const mensaje = document.getElementById("mensajePassword");
    const boton = document.getElementById("btnRegistro");

    function validarPassword(){

        if(confirmPassword.value === ""){
            mensaje.textContent = "";
            boton.disabled = false;
            return;
        }

        if(password.value === confirmPassword.value){
            mensaje.textContent = "✔ Las contrasenas coinciden";
            mensaje.style.color = "green";
            boton.disabled = false;
        }else{
            mensaje.textContent = "✖ Las contrasenas no coinciden";
            mensaje.style.color = "red";
            boton.disabled = true;
        }
    }

    password.addEventListener("keyup", validarPassword);
    confirmPassword.addEventListener("keyup", validarPassword);

    function togglePassword(inputId, iconId){
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if(input.type === "password"){
            input.type = "text";
            icon.textContent = "🙈";
        }else{
            input.type = "password";
            icon.textContent = "👁";
        }
    }
</script>

</body>
</html>
