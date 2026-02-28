<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | Incendios Forestales</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-success bg-gradient d-flex align-items-center justify-content-center min-vh-100 py-5">

<div class="card shadow-lg border-0" style="max-width:850px; width:100%;">
    <div class="card-body p-5">

        <div class="text-center mb-4">
            <img src="{{ asset('img/logo.jpeg') }}" class="img-fluid mb-3" style="max-width:100px;">
            <h3 class="fw-bold text-success">Crear Cuenta</h3>
            <p class="text-muted">Registro para el Sistema de Incendios Forestales</p>
        </div>

        <form>

            <!-- DATOS PERSONALES -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Nombre</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Apellido Paterno</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Apellido Materno</label>
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Fecha de Nacimiento</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">CURP</label>
                    <input type="text" maxlength="18" class="form-control text-uppercase">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Correo Electrónico</label>
                    <input type="email" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Teléfono</label>
                    <input type="text" class="form-control">
                </div>
            </div>

            <!-- DATOS DE USUARIO -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nombre de Usuario</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Rol</label>
                    <select class="form-select" id="roleSelect">
                        <option value="">Seleccione rol</option>
                        <option value="citizen">Ciudadano</option>
                        <option value="authority">Autoridad</option>
                        <option value="administrator">Administrador</option> <!-- Agregamos la opción de Administrador -->
                    </select>
                </div>
            </div>

            <!-- SECCIÓN AUTORIDAD (OCULTA INICIALMENTE) -->
            <div id="authoritySection" class="border rounded p-4 mt-3 bg-light" style="display:none;">
                <h5 class="fw-bold text-success mb-3">Información Institucional</h5>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nombre de la Empresa / Institución</label>
                    <input type="text" class="form-control">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Clave de la Empresa</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Clave del Empleado</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>

            <!-- SECCIÓN ADMINISTRADOR (OCULTA INICIALMENTE) -->
            <div id="administratorSection" class="border rounded p-4 mt-3 bg-light" style="display:none;">
                <h5 class="fw-bold text-success mb-3">Código de Acceso</h5>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Ingrese el Código de Acceso</label>
                    <input type="text" class="form-control" placeholder="Código de acceso único">
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="row mt-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Contraseña</label>
                    <input type="password" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Confirmar Contraseña</label>
                    <input type="password" class="form-control">
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="/" class="btn btn-outline-secondary">
                    Volver
                </a>

                <button type="button" class="btn btn-success fw-bold">
                    Registrarse
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    const roleSelect = document.getElementById('roleSelect');
    const authoritySection = document.getElementById('authoritySection');
    const administratorSection = document.getElementById('administratorSection');

    roleSelect.addEventListener('change', function() {
        if (this.value === 'authority') {
            authoritySection.style.display = 'block';
            administratorSection.style.display = 'none'; // Ocultar la sección de administrador
        } else if (this.value === 'administrator') {
            authoritySection.style.display = 'none'; // Ocultar la sección de autoridad
            administratorSection.style.display = 'block'; // Mostrar la sección de administrador
        } else {
            authoritySection.style.display = 'none';
            administratorSection.style.display = 'none';
        }
    });
</script>

</body>
</html>
