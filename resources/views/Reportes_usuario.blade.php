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

    <style>
        /* Colores y fondo personalizado */
        :root {
            --primary-color: #2D6A4F;
            --secondary-color: #40916C;
            --background-color: #F1FAF5;
            --danger-color: #D32F2F;
            --warning-color: #FF9800;
            --text-color: #4E5B60;
        }

        body {
            background-color: var(--background-color);
            font-family: 'Arial', sans-serif;
        }

        .btn-success {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-success:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-info {
            background-color: #1E88E5;
            border-color: #1E88E5;
        }

        .btn-info:hover {
            background-color: #1976D2;
            border-color: #1976D2;
        }

        .btn-warning {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
        }

        .btn-warning:hover {
            background-color: #F57C00;
            border-color: #F57C00;
        }

        .table {
            background-color: #FFFFFF;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: var(--primary-color);
            color: white;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        .table td {
            background-color: #f9f9f9;
        }

        .badge {
            border-radius: 15px;
            padding: 5px 10px;
        }

        /* Detalles de reporte */
        .details-section {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
        }

        .details-section ul {
            list-style-type: none;
            padding: 0;
        }

        .details-section li {
            margin: 5px 0;
        }

        .collapse {
            display: none;
        }
    </style>
</head>

<body>

<div class="container-fluid py-5">

    <!-- Botón Regresar en la parte superior izquierda -->
    <div class="d-flex justify-content-start mb-4">
        <a href="{{ url('/Reporte') }}" class="btn btn-outline-secondary btn-lg">
            <i class="fas fa-arrow-left"></i> Regresar
        </a>
    </div>

    <h3 class="fw-bold text-success mb-4">Mis Reportes de Incendios</h3>

    <!-- Tabla de reportes -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
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
                <td>El humo se ve denso y el incendio está cerca de la carretera principal.</td>
                <td>
                    <span class="badge bg-warning text-dark">En Proceso</span>
                </td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="toggleDetails('detalleReporte1')">Ver Detalles</button>
                </td>
            </tr>

            <!-- Detalles del Reporte 1 -->
            <tr id="detalleReporte1" class="collapse">
                <td colspan="7">
                    <div class="details-section">
                        <h5 class="fw-bold">Detalles del Reporte:</h5>
                        <ul>
                            <li><strong>Fecha de Reporte:</strong> 2026-02-25</li>
                            <li><strong>Ubicación:</strong> Valle de Bravo, México</li>
                            <li><strong>Ecosistema:</strong> Bosque</li>
                            <li><strong>Categoría:</strong> Mediano</li>
                            <li><strong>Descripción:</strong> El humo se ve denso y el incendio está cerca de la carretera principal.</li>
                            <li><strong>Estado:</strong> En Proceso</li>
                            <li><strong>Ubicación GPS:</strong> Latitud: 19.4313, Longitud: -100.2345</li>
                            <li><strong>Fecha del Último Reporte:</strong> 2026-02-25 14:30</li>
                        </ul>
                        <button class="btn btn-warning btn-sm" onclick="toggleDetails('detalleReporte1')">Ocultar Detalles</button>
                    </div>
                </td>
            </tr>

            <!-- Reporte 2 -->
            <tr>
                <td>2026-02-24</td>
                <td>Chihuahua, México</td>
                <td>Selva</td>
                <td>Grande</td>
                <td>El incendio se ve desde lejos, gran cantidad de humo visible.</td>
                <td>
                    <span class="badge bg-success">Finalizado</span>
                </td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="toggleDetails('detalleReporte2')">Ver Detalles</button>
                </td>
            </tr>

            <!-- Detalles del Reporte 2 -->
            <tr id="detalleReporte2" class="collapse">
                <td colspan="7">
                    <div class="details-section">
                        <h5 class="fw-bold">Detalles del Reporte:</h5>
                        <ul>
                            <li><strong>Fecha de Reporte:</strong> 2026-02-24</li>
                            <li><strong>Ubicación:</strong> Chihuahua, México</li>
                            <li><strong>Ecosistema:</strong> Selva</li>
                            <li><strong>Categoría:</strong> Grande</li>
                            <li><strong>Descripción:</strong> El incendio se ve desde lejos, gran cantidad de humo visible.</li>
                            <li><strong>Estado:</strong> Finalizado</li>
                            <li><strong>Ubicación GPS:</strong> Latitud: 28.6345, Longitud: -106.2356</li>
                            <li><strong>Fecha del Último Reporte:</strong> 2026-02-24 16:45</li>
                        </ul>
                        <button class="btn btn-warning btn-sm" onclick="toggleDetails('detalleReporte2')">Ocultar Detalles</button>
                    </div>
                </td>
            </tr>

            <!-- Reporte 3 -->
            <tr>
                <td>2026-02-23</td>
                <td>Oaxaca, México</td>
                <td>Sabanas</td>
                <td>Pequeño</td>
                <td>Se ve una columna de humo en las sabanas, aún no se controlan los focos.</td>
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
                    <div class="details-section">
                        <h5 class="fw-bold">Detalles del Reporte:</h5>
                        <ul>
                            <li><strong>Fecha de Reporte:</strong> 2026-02-23</li>
                            <li><strong>Ubicación:</strong> Oaxaca, México</li>
                            <li><strong>Ecosistema:</strong> Sabanas</li>
                            <li><strong>Categoría:</strong> Pequeño</li>
                            <li><strong>Descripción:</strong> Se ve una columna de humo en las sabanas, aún no se controlan los focos.</li>
                            <li><strong>Estado:</strong> Finalizado</li>
                            <li><strong>Ubicación GPS:</strong> Latitud: 17.0689, Longitud: -96.7586</li>
                            <li><strong>Fecha del Último Reporte:</strong> 2026-02-23 11:00</li>
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
