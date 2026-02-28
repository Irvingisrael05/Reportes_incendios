<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Registrados | Incendios Forestales</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body class="bg-light">

<div class="container-fluid py-5">
    <!-- Botón Regresar en la parte superior izquierda -->
    <div class="d-flex justify-content-start mb-4">
        <a href="{{ url('/Menu_admin') }}" class="btn btn-secondary btn-lg">
            <i class="fas fa-arrow-left"></i> Regresar al Menú
        </a>
    </div>

    <h3 class="fw-bold text-success mb-4">Usuarios Registrados</h3>

    <!-- Tabla de Usuarios Pendientes de Aceptación -->
    <h4 class="fw-bold text-success mb-3">Usuarios Pendientes de Aceptación</h4>
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-warning text-dark">
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Tipo de Usuario</th>
                <th>Fecha de Registro</th>
                <th>Acción</th>
            </tr>
            </thead>
            <tbody>
            <!-- Autoridad Pendiente 1 -->
            <tr>
                <td>Mariana López</td>
                <td>mariana@example.com</td>
                <td>Autoridad</td>
                <td>2026-02-20</td>
                <td>
                    <button class="btn btn-success btn-sm">Aceptar</button>
                    <button class="btn btn-danger btn-sm">Rechazar</button>
                    <button class="btn btn-info btn-sm" onclick="toggleDetails('detalleAutoridad1')">Ver Detalles</button>
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </td>
            </tr>

            <!-- Detalles del Reporte 1 (Solo Autoridad) -->
            <tr id="detalleAutoridad1" class="collapse">
                <td colspan="5">
                    <div class="p-3 bg-light">
                        <h5 class="fw-bold">Detalles de la Autoridad:</h5>
                        <ul>
                            <li><strong>Nombre:</strong> Mariana López</li>
                            <li><strong>Correo:</strong> mariana@example.com</li>
                            <li><strong>Clave de Trabajo:</strong> ABC12345</li>
                            <li><strong>Fecha de Registro:</strong> 2026-02-20</li>
                            <li><strong>Empresa:</strong> EcoProtección S.A.</li>
                            <li><strong>Clave de Empresa:</strong> ECO12345</li>
                            <li><strong>CURP:</strong> LOPEM1234567890</li>
                            <li><strong>Teléfono:</strong> 5551234567</li>
                            <li><strong>Año de Nacimiento:</strong> 1985</li>
                            <li><strong>Nombre de Usuario:</strong> mariana_lopez</li>
                        </ul>
                        <button class="btn btn-warning btn-sm" onclick="toggleDetails('detalleAutoridad1')">Ocultar Detalles</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Tabla de Autoridades Aceptadas -->
    <h4 class="fw-bold text-success mb-3">Autoridades Aceptadas</h4>
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-success text-white">
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Clave de Trabajo</th>
                <th>Fecha de Aceptación</th>
                <th>Acción</th>
            </tr>
            </thead>
            <tbody>
            <!-- Autoridad Aceptada 1 -->
            <tr>
                <td>Laura García</td>
                <td>laura@example.com</td>
                <td>ABC12345</td>
                <td>2026-02-22</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="toggleDetails('detalleAutoridad2')">Ver Detalles</button>
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </td>
            </tr>

            <!-- Detalles de la Autoridad -->
            <tr id="detalleAutoridad2" class="collapse">
                <td colspan="5">
                    <div class="p-3 bg-light">
                        <h5 class="fw-bold">Detalles de la Autoridad:</h5>
                        <ul>
                            <li><strong>Nombre:</strong> Laura García</li>
                            <li><strong>Correo:</strong> laura@example.com</li>
                            <li><strong>Clave de Trabajo:</strong> ABC12345</li>
                            <li><strong>Fecha de Aceptación:</strong> 2026-02-22</li>
                            <li><strong>Empresa:</strong> EcoProtección S.A.</li>
                            <li><strong>Clave de Empresa:</strong> ECO12345</li>
                            <li><strong>CURP:</strong> GARL1234567890</li>
                            <li><strong>Teléfono:</strong> 5559876543</li>
                            <li><strong>Año de Nacimiento:</strong> 1990</li>
                            <li><strong>Nombre de Usuario:</strong> laura_garcia</li>
                        </ul>
                        <button class="btn btn-warning btn-sm" onclick="toggleDetails('detalleAutoridad2')">Ocultar Detalles</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Tabla de Usuarios Civiles -->
    <h4 class="fw-bold text-success mb-3">Usuarios Civiles</h4>
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-info text-white">
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Fecha de Registro</th>
                <th>Acción</th>
            </tr>
            </thead>
            <tbody>
            <!-- Civil 1 -->
            <tr>
                <td>José Pérez</td>
                <td>jose@example.com</td>
                <td>2026-02-18</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="toggleDetails('detalleCivil1')">Ver Detalles</button>
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Detalles del Civil -->
    <div id="detalleCivil1" class="collapse">
        <div class="card shadow p-4 mb-4">
            <h5 class="fw-bold">Detalles del Civil:</h5>
            <ul>
                <li><strong>Nombre:</strong> José Pérez</li>
                <li><strong>Correo:</strong> jose@example.com</li>
                <li><strong>Fecha de Registro:</strong> 2026-02-18</li>
                <li><strong>CURP:</strong> PEJH1234567890</li>
                <li><strong>Teléfono:</strong> 5553217890</li>
                <li><strong>Año de Nacimiento:</strong> 1992</li>
                <li><strong>Nombre de Usuario:</strong> jose_perez</li>
            </ul>
            <button class="btn btn-warning btn-sm" onclick="toggleDetails('detalleCivil1')">Ocultar Detalles</button>
        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript para mostrar/ocultar detalles -->
<script>
    function toggleDetails(id) {
        const details = document.getElementById(id);
        if (details.classList.contains('collapse')) {
            details.classList.remove('collapse');
        } else {
            details.classList.add('collapse');
        }
    }
</script>

</body>
</html>
