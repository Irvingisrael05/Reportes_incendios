<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro | Incendios Forestales</title>

    @vite(['resources/css/app.css','resources/css/Registro.css','resources/js/app.js'])

</head>

<body class="body-bg">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8 col-md-10">

            <div class="card card-custom shadow-lg border-0">

                <div class="card-body p-5">

                    <!-- LOGO Y TITULO -->

                    <div class="text-center mb-4">

                        <img src="{{ asset('img/logo.jpeg') }}"
                             class="logo-style mb-3 rounded-circle shadow">

                        <h2 class="fw-bold title-main">Crear Cuenta</h2>

                        <p class="text-muted">
                            Sistema de Gestión de Incendios Forestales
                        </p>

                    </div>


                    <!-- MENSAJE DE EXITO -->

                    @if(session('success'))
                        <div class="alert alert-success text-center fw-bold">
                            {{ session('success') }}
                        </div>
                    @endif


                    <!-- MENSAJE DE ERRORES -->

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>Faltan campos o hay errores:</strong>

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>
                    @endif


                    <form action="{{ route('register.store') }}" method="POST">

                        @csrf


                        <!-- ============================= -->
                        <!-- DATOS PERSONALES -->
                        <!-- ============================= -->

                        <h5 class="section-title">Datos Personales</h5>

                        <div class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Nombre</label>
                                <input type="text" name="first_name" class="form-control shadow-sm" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Apellido Paterno</label>
                                <input type="text" name="last_name" class="form-control shadow-sm" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Apellido Materno</label>
                                <input type="text" name="middle_name" class="form-control shadow-sm">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Correo Electrónico</label>
                                <input type="email" name="email" class="form-control shadow-sm" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Teléfono</label>
                                <input type="text" name="phone" class="form-control shadow-sm">
                            </div>

                        </div>


                        <!-- ============================= -->
                        <!-- DATOS DE USUARIO -->
                        <!-- ============================= -->

                        <h5 class="section-title mt-4">Datos de Usuario</h5>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nombre de Usuario</label>
                                <input type="text" name="username" class="form-control shadow-sm" required>
                            </div>

                        </div>


                        <div class="row g-3 mt-1">

                            <!-- PASSWORD -->

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">Contraseña</label>

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


                            <!-- CONFIRM PASSWORD -->

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">Confirmar Contraseña</label>

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


                        <!-- BOTONES -->

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


<!-- ============================= -->
<!-- SCRIPT CONTRASEÑA -->
<!-- ============================= -->

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

            mensaje.textContent = "✔ Las contraseñas coinciden";
            mensaje.style.color = "green";
            boton.disabled = false;

        }else{

            mensaje.textContent = "✖ Las contraseñas no coinciden";
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
