<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Reportes | Incendios Forestales</title>

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

    <h3 class="fw-bold text-success mb-4">Asignar Reportes a Autoridades</h3>

    <!-- Tabla de Reportes Generados -->
    <h4 class="fw-bold text-success mb-3">Reportes Generados</h4>
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-warning text-dark">
            <tr>
                <th>Fecha de Reporte</th>
                <th>Ubicación</th>
                <th>Ecosistema</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Climatografía</th>
                <th>Asignar a Autoridad</th>
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
                <td>Calor: 32°C, Humedad: 45%, Viento: 10 km/h</td>
                <td>
                    <select class="form-select">
                        <option value="">Seleccionar Autoridad</option>
                        <option value="1">EcoProtección S.A.</option>
                        <option value="2">Protección Ambiental</option>
                        <option value="3">Cuerpo de Bomberos</option>
                    </select>
                    <button class="btn btn-success btn-sm mt-2">Asignar Reporte</button>
                </td>
            </tr>

            <!-- Reporte 2 -->
            <tr>
                <td>2026-02-24</td>
                <td>Chihuahua, México</td>
                <td>Selva</td>
                <td>Grande</td>
                <td>Gran columna de humo visible desde la distancia.</td>
                <td>Calor: 35°C, Humedad: 40%, Viento: 20 km/h</td>
                <td>
                    <select class="form-select">
                        <option value="">Seleccionar Autoridad</option>
                        <option value="1">EcoProtección S.A.</option>
                        <option value="2">Protección Ambiental</option>
                        <option value="3">Cuerpo de Bomberos</option>
                    </select>
                    <button class="btn btn-success btn-sm mt-2">Asignar Reporte</button>
                </td>
            </tr>

            <!-- Reporte 3 -->
            <tr>
                <td>2026-02-23</td>
                <td>Oaxaca, México</td>
                <td>Sabanas</td>
                <td>Pequeño</td>
                <td>Incendio en las sabanas, visible desde la carretera.</td>
                <td>Calor: 30°C, Humedad: 50%, Viento: 5 km/h</td>
                <td>
                    <select class="form-select">
                        <option value="">Seleccionar Autoridad</option>
                        <option value="1">EcoProtección S.A.</option>
                        <option value="2">Protección Ambiental</option>
                        <option value="3">Cuerpo de Bomberos</option>
                    </select>
                    <button class="btn btn-success btn-sm mt-2">Asignar Reporte</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Tabla de Asignación de Reportes a Autoridades -->
    <h4 class="fw-bold text-success mb-4">Asignación de Reportes a Autoridades</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-info text-white">
            <tr>
                <th>Fecha de Asignación</th>
                <th>Nombre de la Empresa</th>
                <th>Nombre del Responsable</th>
                <th>Usuario Asignado</th>
                <th>Acción</th>
            </tr>
            </thead>
            <tbody>
            <!-- Asignación de Reporte 1 -->
            <tr>
                <td>2026-02-25</td>
                <td>EcoProtección S.A.</td>
                <td>Juan Pérez</td>
                <td>eco_jperez</td>
                <td>
                    <button class="btn btn-danger btn-sm">Eliminar Asignación</button>
                </td>
            </tr>

            <!-- Asignación de Reporte 2 -->
            <tr>
                <td>2026-02-24</td>
                <td>Protección Ambiental</td>
                <td>Laura González</td>
                <td>eco_lgonzalez</td>
                <td>
                    <button class="btn btn-danger btn-sm">Eliminar Asignación</button>
                </td>
            </tr>

            <!-- Asignación de Reporte 3 -->
            <tr>
                <td>2026-02-23</td>
                <td>Cuerpo de Bomberos</td>
                <td>Pedro Martínez</td>
                <td>eco_pmartinez</td>
                <td>
                    <button class="btn btn-danger btn-sm">Eliminar Asignación</button>
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
