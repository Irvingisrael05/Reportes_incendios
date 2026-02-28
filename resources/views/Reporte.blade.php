<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Reporte | Incendios Forestales</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
</head>

<body class="bg-light">

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-3 col-lg-2 bg-success bg-gradient min-vh-100 p-4 text-white">
            <div class="text-center mb-4">
                <img src="{{ asset('img/logo.jpeg') }}" class="img-fluid mb-2" style="max-width:80px;">
                <h5 class="fw-bold">Panel Ciudadano</h5>
            </div>

            <div class="d-grid gap-3">
                <a href="#" class="btn btn-light fw-semibold text-success">
                    Generar Reporte
                </a>

                <!-- Correcto: El enlace para "Ver Mis Reportes" -->
                <a href="{{ url('/Reportes_usuario') }}" class="btn" style="background-color: #2D6A4F; color: white; border-radius: 25px; border: 2px solid #2D6A4F;">
                    Ver Mis Reportes
                </a>
            </div>

            <div class="mt-5">
                <a href="/" class="btn btn-outline-light w-100">
                    Cerrar Sesión
                </a>
            </div>
        </div>

        <!-- CONTENIDO -->
        <div class="col-md-9 col-lg-10 p-5">

            <div class="card shadow-lg border-0">
                <div class="card-body p-5">

                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-success">Nuevo Reporte de Incendio</h3>
                        <p class="text-muted">Complete la información requerida</p>
                    </div>

                    <form enctype="multipart/form-data">

                        <!-- UBICACIÓN AUTOMÁTICA -->
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-success"
                                    onclick="obtenerUbicacion()">
                                Usar Ubicación Actual
                            </button>
                        </div>

                        <!-- MAPA -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Seleccione ubicación en el mapa
                            </label>
                            <div id="map" class="rounded border"
                                 style="height:400px;"></div>
                        </div>

                        <!-- LAT Y LNG -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Latitud</label>
                                <input type="text" id="latitude"
                                       class="form-control" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Longitud</label>
                                <input type="text" id="longitude"
                                       class="form-control" readonly>
                            </div>
                        </div>

                        <!-- ECOSISTEMA -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Tipo de Ecosistema
                            </label>
                            <select class="form-select">
                                <option value="">Seleccione ecosistema</option>
                                <option value="1">Praderas</option>
                                <option value="2">Selva</option>
                                <option value="3">Bosque</option>
                                <option value="4">Sabanas</option>
                            </select>
                        </div>

                        <!-- CATEGORÍA -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Categoría del Incendio
                            </label>
                            <select class="form-select">
                                <option value="">Seleccione categoría</option>
                                <option value="1">Pequeño</option>
                                <option value="2">Mediano</option>
                                <option value="3">Grande</option>
                            </select>
                        </div>

                        <!-- DESCRIPCIÓN -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Descripción del Incidente
                            </label>
                            <textarea class="form-control" rows="4"
                                      placeholder="Describa la situación observada..."></textarea>
                        </div>

                        <!-- EVIDENCIA -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Subir Evidencia (Imagen)
                            </label>
                            <input type="file"
                                   class="form-control"
                                   accept="image/*">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button"
                                    class="btn btn-success fw-bold">
                                Generar Reporte
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    const map = L.map('map').setView([19.4326, -99.1332], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    let marker;

    map.on('click', function(e) {

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker(e.latlng).addTo(map);

        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
    });

    function obtenerUbicacion() {

        if (navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(function(position) {

                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                map.setView([lat, lng], 13);

                if (marker) {
                    map.removeLayer(marker);
                }

                marker = L.marker([lat, lng]).addTo(map);

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

            });

        } else {
            alert("Geolocalización no soportada.");
        }
    }
</script>

</body>
</html>
