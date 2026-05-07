{{-- resources/views/usuarios/generar_reportes.blade.php --}}
@extends('layouts.menu_usuarios')

@section('contenido')

    @vite([
        'resources/css/generar_reportes.css'
    ])

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <div class="card card-custom shadow-lg border-0">

        <div class="card-body p-5">

            <div class="text-center mb-5">

                <h3 class="fw-bold" style="color:#1B5E20;">
                    Nuevo Reporte de Incendio
                </h3>

                <p class="text-muted">
                    Complete la informacion requerida
                </p>

            </div>

            <form id="formReporte" action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- MAPA -->
                <div class="row mb-4">

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Seleccione ubicacion en el mapa
                        </label>

                        <div id="map" style="height: 350px;"></div>

                    </div>

                    <div class="col-md-6 d-flex flex-column justify-content-center">

                        <button type="button" class="btn-location mb-3" onclick="obtenerUbicacion()">
                            📍 Usar Ubicacion Actual
                        </button>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Latitud</label>
                            <input type="text" id="latitude" name="latitude"
                                   class="form-control" readonly required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Longitud</label>
                            <input type="text" id="longitude" name="longitude"
                                   class="form-control" readonly required>
                        </div>

                    </div>
                </div>

                <!-- ECOSISTEMA Y CATEGORIA -->
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tipo de Ecosistema</label>
                        <select class="form-select" name="ecosystem_id" required>
                            <option value="">Seleccione ecosistema</option>
                            @foreach($ecosystems as $eco)
                                <option value="{{ $eco->id_ecosystem }}">
                                    {{ $eco->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Categoria del Incendio</label>
                        <select class="form-select" name="category_id" required>
                            <option value="">Seleccione categoria</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id_category }}">
                                    {{ $cat->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <!-- DESCRIPCION -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Descripcion del Incidente
                    </label>
                    <textarea class="form-control" name="description" rows="4"
                              placeholder="Describa la situacion observada..." required></textarea>
                </div>

                <!-- IMAGEN -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Subir Evidencia
                    </label>
                    <input type="file" class="form-control" name="image" accept="image/*" capture="environment">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="button"
                            class="btn btn-main fw-bold px-5 py-2 rounded-3"
                            data-bs-toggle="modal"
                            data-bs-target="#confirmarReporteModal">
                        Generar Reporte
                    </button>
                </div>

            </form>

        </div>
    </div>


    <!-- MODAL CONFIRMAR REPORTE -->
    <div class="modal fade" id="confirmarReporteModal" tabindex="-1" aria-labelledby="confirmarReporteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">

                <div class="modal-header bg-success text-white rounded-top-4">
                    <h5 class="modal-title" id="confirmarReporteModalLabel">
                        Confirmar reporte
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"
                            aria-label="Cerrar">
                    </button>
                </div>

                <div class="modal-body text-center p-4">
                    <div class="mb-3" style="font-size: 48px;">
                        🔥
                    </div>

                    <h5 class="fw-bold mb-2">¿Deseas generar este reporte?</h5>

                    <p class="text-muted mb-0">
                        Verifica que la ubicacion, categoria y descripcion sean correctas antes de enviarlo.
                    </p>
                </div>

                <div class="modal-footer justify-content-center border-0 pb-4">
                    <button type="button"
                            class="btn btn-secondary px-4 rounded-pill"
                            data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="button"
                            class="btn btn-success px-4 rounded-pill"
                            onclick="document.getElementById('formReporte').requestSubmit();">
                        Si, generar
                    </button>
                </div>

            </div>
        </div>
    </div>


    <!-- MODAL GEOLOCALIZACION NO SOPORTADA -->
    <div class="modal fade" id="geoModal" tabindex="-1" aria-labelledby="geoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">

                <div class="modal-header bg-warning text-dark rounded-top-4">
                    <h5 class="modal-title" id="geoModalLabel">
                        Ubicacion no disponible
                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Cerrar">
                    </button>
                </div>

                <div class="modal-body text-center p-4">
                    <div class="mb-3" style="font-size: 48px;">
                        📍
                    </div>

                    <h5 class="fw-bold mb-2">No se pudo usar la ubicacion actual</h5>

                    <p class="text-muted mb-0">
                        Tu navegador no soporta geolocalizacion. Puedes seleccionar la ubicacion directamente en el mapa.
                    </p>
                </div>

                <div class="modal-footer justify-content-center border-0 pb-4">
                    <button type="button"
                            class="btn btn-warning px-4 rounded-pill"
                            data-bs-dismiss="modal">
                        Entendido
                    </button>
                </div>

            </div>
        </div>
    </div>


    @if(session('success') || $errors->any())
        <div class="modal fade" id="respuestaReporteModal" tabindex="-1" aria-labelledby="respuestaReporteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">

                    <div class="modal-header {{ session('success') ? 'bg-success' : 'bg-danger' }} text-white rounded-top-4">
                        <h5 class="modal-title" id="respuestaReporteModalLabel">
                            {{ session('success') ? 'Reporte generado' : 'Datos incorrectos' }}
                        </h5>

                        <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal"
                                aria-label="Cerrar">
                        </button>
                    </div>

                    <div class="modal-body text-center p-4">

                        <div class="mb-3" style="font-size: 48px;">
                            {{ session('success') ? '✅' : '⚠️' }}
                        </div>

                        @if(session('success'))
                            <h5 class="fw-bold mb-2">Reporte enviado correctamente</h5>

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
                        <button type="button"
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
                const respuestaReporteModal = new bootstrap.Modal(document.getElementById('respuestaReporteModal'), {
                    backdrop: 'static',
                    keyboard: false
                });

                respuestaReporteModal.show();
            });
        </script>
    @endif


    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        const map = L.map('map').setView([19.4326,-99.1332], 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        let marker;

        map.on('click', function(e){
            if(marker) map.removeLayer(marker);
            marker = L.marker(e.latlng).addTo(map);
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
        });

        function obtenerUbicacion() {
            if(navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position){
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    map.setView([lat, lng], 13);
                    if(marker) map.removeLayer(marker);
                    marker = L.marker([lat, lng]).addTo(map);
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                });
            } else {
                const geoModal = new bootstrap.Modal(document.getElementById('geoModal'));
                geoModal.show();
            }
        }
    </script>

@endsection
