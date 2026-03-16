{{-- resources/views/usuarios/generar_reportes.blade.php --}}
@extends('layouts.menu_usuarios')

@section('contenido')

    @vite([
        'resources/css/Generar_Reportes.css'
    ])

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <div class="card card-custom shadow-lg border-0">

        <div class="card-body p-5">

            <div class="text-center mb-5">

                <h3 class="fw-bold" style="color:#1B5E20;">
                    Nuevo Reporte de Incendio
                </h3>

                <p class="text-muted">
                    Complete la información requerida
                </p>

            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- MAPA -->
                <div class="row mb-4">

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Seleccione ubicación en el mapa
                        </label>

                        <div id="map" style="height: 350px;"></div>

                    </div>

                    <div class="col-md-6 d-flex flex-column justify-content-center">

                        <button type="button" class="btn-location mb-3" onclick="obtenerUbicacion()">
                            📍 Usar Ubicación Actual
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

                <!-- ECOSISTEMA Y CATEGORÍA -->
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
                        <label class="form-label fw-semibold">Categoría del Incendio</label>
                        <select class="form-select" name="category_id" required>
                            <option value="">Seleccione categoría</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id_category }}">
                                    {{ $cat->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <!-- DESCRIPCIÓN -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Descripción del Incidente
                    </label>
                    <textarea class="form-control" name="description" rows="4"
                              placeholder="Describa la situación observada..." required></textarea>
                </div>

                <!-- IMAGEN -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Subir Evidencia
                    </label>
                    <input type="file" class="form-control" name="image" accept="image/*" capture="environment">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-main fw-bold px-5 py-2 rounded-3">
                        Generar Reporte
                    </button>
                </div>

            </form>

        </div>
    </div>

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
                alert("Geolocalización no soportada.");
            }
        }
    </script>

@endsection
