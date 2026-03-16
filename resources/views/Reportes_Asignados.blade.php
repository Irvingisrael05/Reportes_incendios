<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Asignados | Incendios Forestales</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container-fluid py-5">

    <!-- Botón Regresar en la parte superior izquierda -->
    <div class="d-flex justify-content-start mb-4">
        <a href="{{ url('/Menu_autoridades') }}" class="btn btn-secondary btn-lg">
            <i class="fas fa-arrow-left"></i> Regresar al Menú Autoridad
        </a>
    </div>

    <h3 class="fw-bold text-success mb-4">Reportes Asignados a la Autoridad</h3>

    <!-- Tabla de Reportes Asignados -->
    <div class="table-responsive">
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
                <td>Incendio cercano a la carretera principal, alta densidad de humo.</td>
                <td>
                    <span class="badge bg-warning text-dark">En Proceso</span>
                </td>
                <td>
                    <button class="btn btn-success btn-sm" onclick="changeStatus(1)">Atendido</button>
                    <button class="btn btn-danger btn-sm" onclick="changeStatus(2)">Finalizado</button>
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
                            <li><strong>Descripción:</strong> Incendio cercano a la carretera principal, alta densidad de humo.</li>
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
                <td>Gran columna de humo visible desde la distancia.</td>
                <td>
                    <span class="badge bg-warning text-dark">En Proceso</span>
                </td>
                <td>
                    <button class="btn btn-success btn-sm" onclick="changeStatus(1)">Atendido</button>
                    <button class="btn btn-danger btn-sm" onclick="changeStatus(2)">Finalizado</button>
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
                            <li><strong>Descripción:</strong> Gran columna de humo visible desde la distancia.</li>
                            <li><strong>Estado:</strong> En Proceso</li>
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
                <td>Incendio en las sabanas, visible desde la carretera.</td>
                <td>
                    <span class="badge bg-warning text-dark">En Proceso</span>
                </td>
                <td>
                    <button class="btn btn-success btn-sm" onclick="changeStatus(1)">Atendido</button>
                    <button class="btn btn-danger btn-sm" onclick="changeStatus(2)">Finalizado</button>
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
                            <li><strong>Descripción:</strong> Incendio en las sabanas, visible desde la carretera.</li>
                            <li><strong>Estado:</strong> En Proceso</li>
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

    // Función para cambiar el estado de los reportes (simulación de cambio de estado)
    function changeStatus(statusType) {
        let statusText = '';
        let statusBadge = '';

        if (statusType === 1) {
            statusText = 'Atendido';
            statusBadge = 'bg-success';
        } else if (statusType === 2) {
            statusText = 'Finalizado';
            statusBadge = 'bg-danger';
        }

        // Aquí podrías realizar alguna acción como hacer un POST o PUT a la base de datos para actualizar el estado.
        // Simulación de cambio de estado en la tabla (esto es solo maquetado sin funcionalidad real de backend).
        alert('Estado actualizado a: ' + statusText);

        // Ejemplo de cómo cambiar el estado en la tabla:
        const badge = event.target.closest('tr').querySelector('td:nth-child(6) span');
        badge.classList.remove('bg-warning', 'text-dark');
        badge.classList.add(statusBadge);
        badge.textContent = statusText;
    }
</script>

</body>
</html>
