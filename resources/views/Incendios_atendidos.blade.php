<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incendios Atendidos | Incendios Forestales</title>

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
            <i class="fas fa-arrow-left"></i> Regresar al Menú
        </a>
    </div>

    <h3 class="fw-bold text-success mb-4">Incendios Atendidos</h3>

    <!-- Tabla de incendios atendidos -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-success text-white">
            <tr>
                <th>Fecha de Reporte</th>
                <th>Ubicación</th>
                <th>Tipo de Ecosistema</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            <!-- Reporte 1 (Atendido) -->
            <tr>
                <td>2026-02-25</td>
                <td>Valle de Bravo, México</td>
                <td>Bosque</td>
                <td>Mediano</td>
                <td>Incendio cercano a la carretera principal, alta densidad de humo.</td>
                <td>
                    <span class="badge bg-success">Finalizado</span>
                </td>
            </tr>

            <!-- Reporte 2 (Atendido) -->
            <tr>
                <td>2026-02-24</td>
                <td>Chihuahua, México</td>
                <td>Selva</td>
                <td>Grande</td>
                <td>Gran columna de humo visible desde la distancia.</td>
                <td>
                    <span class="badge bg-success">Finalizado</span>
                </td>
            </tr>

            <!-- Reporte 3 (Atendido) -->
            <tr>
                <td>2026-02-23</td>
                <td>Oaxaca, México</td>
                <td>Sabanas</td>
                <td>Pequeño</td>
                <td>Incendio en las sabanas, visible desde la carretera.</td>
                <td>
                    <span class="badge bg-success">Finalizado</span>
                </td>
            </tr>

            </tbody>
        </table>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
