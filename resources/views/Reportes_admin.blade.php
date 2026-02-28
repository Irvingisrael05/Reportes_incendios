<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Reportes | Incendios Forestales</title>

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

    <h3 class="fw-bold text-success mb-4">Reportes de Incendios</h3>

    <!-- Reportes Recibidos -->
    <h4 class="fw-bold text-success mb-3">Reportes Recibidos</h4>
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-success text-white">
            <tr>
                <th>Fecha de Reporte</th>
                <th>Ubicación</th>
                <th>Ecosistema</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <!-- Reporte 1 -->
            <tr>
                <td>2026-02-25</td>
                <td>Valle de Bravo, México</td>
                <td>Bosque</td>
                <td>Mediano</td>
                <td>Incendio en las cercanías de la carretera principal.</td>
                <td>
                    <span class="badge bg-warning text-dark">Recibido</span>
                </td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="toggleDetails('detalleReporte1')">Ver Detalles</button>
                </td>
            </tr>
            <!-- Detalles del Reporte 1 -->
            <tr id="detalleReporte1" class="collapse">
                <td colspan="7">
                    <div class="p-3 bg-light">
                        <h5 class="fw-bold">Detalles del Reporte:</h5>
                        <ul>
                            <li><strong>Fecha de Reporte:</strong> 2026-02-25</li>
                            <li><strong>Ubicación:</strong> Valle de Bravo, México</li>
                            <li><strong>Ecosistema:</strong> Bosque</li>
                            <li><strong>Categoría:</strong> Mediano</li>
                            <li><strong>Descripción:</strong> Incendio en las cercanías de la carretera principal.</li>
                            <li><strong>Estado:</strong> Recibido</li>
                        </ul>
                        <button class="btn btn-warning btn-sm" onclick="toggleDetails('detalleReporte1')">Ocultar Detalles</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Reportes en Proceso -->
    <h4 class="fw-bold text-success mb-3">Reportes en Proceso</h4>
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-warning text-dark">
            <tr>
                <th>Fecha de Reporte</th>
                <th>Ubicación</th>
                <th>Ecosistema</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <!-- Reporte 2 -->
            <tr>
                <td>2026-02-24</td>
                <td>Chihuahua, México</td>
                <td>Selva</td>
                <td>Grande</td>
                <td>Se están movilizando las brigadas locales.</td>
                <td>
                    <span class="badge bg-warning text-dark">En Proceso</span>
                </td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="toggleDetails('detalleReporte2')">Ver Detalles</button>
                </td>
            </tr>
            <!-- Detalles del Reporte 2 -->
            <tr id="detalleReporte2" class="collapse">
                <td colspan="7">
                    <div class="p-3 bg-light">
                        <h5 class="fw-bold">Detalles del Reporte:</h5>
                        <ul>
                            <li><strong>Fecha de Reporte:</strong> 2026-02-24</li>
                            <li><strong>Ubicación:</strong> Chihuahua, México</li>
                            <li><strong>Ecosistema:</strong> Selva</li>
                            <li><strong>Categoría:</strong> Grande</li>
                            <li><strong>Descripción:</strong> Se están movilizando las brigadas locales.</li>
                            <li><strong>Estado:</strong> En Proceso</li>
                        </ul>
                        <button class="btn btn-warning btn-sm" onclick="toggleDetails('detalleReporte2')">Ocultar Detalles</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Reportes Finalizados -->
    <h4 class="fw-bold text-success mb-3">Reportes Finalizados</h4>
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-success text-white">
            <tr>
                <th>Fecha de Reporte</th>
                <th>Ubicación</th>
                <th>Ecosistema</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <!-- Reporte 3 -->
            <tr>
                <td>2026-02-23</td>
                <td>Oaxaca, México</td>
                <td>Sabanas</td>
                <td>Pequeño</td>
                <td>El incendio fue sofocado por las brigadas locales.</td>
                <td>
                    <span class="badge bg-success">Finalizado</span>
                </td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="toggleDetails('detalleReporte3')">Ver Detalles</button>
                </td>
            </tr>
            <!-- Detalles del Reporte 3 -->
            <tr id="detalleReporte3" class="collapse">
                <td colspan="7">
                    <div class="p-3 bg-light">
                        <h5 class="fw-bold">Detalles del Reporte:</h5>
                        <ul>
                            <li><strong>Fecha de Reporte:</strong> 2026-02-23</li>
                            <li><strong>Ubicación:</strong> Oaxaca, México</li>
                            <li><strong>Ecosistema:</strong> Sabanas</li>
                            <li><strong>Categoría:</strong> Pequeño</li>
                            <li><strong>Descripción:</strong> El incendio fue sofocado por las brigadas locales.</li>
                            <li><strong>Estado:</strong> Finalizado</li>
                        </ul>
                        <button class="btn btn-warning btn-sm" onclick="toggleDetails('detalleReporte3')">Ocultar Detalles</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
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
