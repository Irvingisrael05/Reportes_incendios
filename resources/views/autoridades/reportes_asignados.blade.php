@extends('layouts.menu_autoridades')

@section('contenido')

    @vite(['resources/css/reportes_asignados.css'])

    <h3 class="fw-bold text-success mb-4">
        Reportes Asignados a la Autoridad
    </h3>


    <div class="table-responsive">

        <table class="table table-bordered table-striped table-hover">

            <thead class="bg-success text-white">

            <tr>
                <th>Fecha de Reporte</th>
                <th>Ubicación</th>
                <th>Municipio / Localidad</th>
                <th>Vegetación</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

            </thead>


            <tbody>

            @forelse($reports as $report)

                <tr>

                    <!-- FECHA -->
                    <td>
                        {{ $report->report_date }}
                    </td>


                    <!-- UBICACION -->
                    <td>
                        {{ $report->location }}
                    </td>


                    <!-- MUNICIPIO Y LOCALIDAD -->
                    <td>

                        <strong>Municipio:</strong>
                        {{ $report->municipality ?? 'No disponible' }}

                        <br>

                        <strong>Localidad:</strong>
                        {{ $report->locality ?? 'No disponible' }}

                    </td>


                    <!-- VEGETACION -->
                    <td>
                        {{ $report->ecosystem }}
                    </td>


                    <!-- CATEGORIA -->
                    <td>
                        {{ $report->category }}
                    </td>


                    <!-- DESCRIPCION -->
                    <td>
                        {{ $report->description }}
                    </td>


                    <!-- ESTADO -->
                    <td>

                        @if($report->status_id == 2)

                            <span class="badge bg-secondary">
                                    Asignado
                                </span>

                        @elseif($report->status_id == 3)

                            <span class="badge bg-primary">
                                    En Proceso
                                </span>

                        @else

                            <span class="badge bg-warning text-dark">
                                    {{ $report->status }}
                                </span>

                        @endif

                    </td>


                    <!-- ACCIONES -->
                    <td>

                        <div class="d-flex gap-2 flex-wrap">


                            <!-- ============================= -->
                            <!-- BOTONES CUANDO ESTA ASIGNADO -->
                            <!-- ============================= -->

                            @if($report->status_id == 2)

                                <button
                                    type="button"
                                    class="btn btn-success btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#aceptarModal{{ $report->id_report }}">

                                    Aceptar

                                </button>


                                <button
                                    type="button"
                                    class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#rechazarModal{{ $report->id_report }}">

                                    Rechazar

                                </button>

                            @endif



                            <!-- ============================= -->
                            <!-- BOTON ATENDER -->
                            <!-- ============================= -->

                            @if($report->status_id == 3)

                                <button
                                    type="button"
                                    class="btn btn-success btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#atenderModal{{ $report->id_report }}">

                                    Atender

                                </button>

                            @endif



                            <!-- ============================= -->
                            <!-- BOTON VER DETALLES -->
                            <!-- ============================= -->

                            <button
                                type="button"
                                class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#detallesModal{{ $report->id_report }}">

                                Ver Detalles

                            </button>


                        </div>

                    </td>

                </tr>



                <!-- ========================================================= -->
                <!-- MODAL DETALLES DEL REPORTE -->
                <!-- ========================================================= -->

                <div
                    class="modal fade"
                    id="detallesModal{{ $report->id_report }}"
                    tabindex="-1"
                    aria-labelledby="detallesModalLabel{{ $report->id_report }}"
                    aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">

                        <div class="modal-content border-0 shadow-lg rounded-4">


                            <!-- ENCABEZADO -->

                            <div class="modal-header bg-success text-white rounded-top-4">

                                <div>

                                    <h5
                                        class="modal-title fw-bold"
                                        id="detallesModalLabel{{ $report->id_report }}">

                                        Detalles del Reporte

                                    </h5>

                                    <small>
                                        Reporte #{{ $report->id_report }}
                                    </small>

                                </div>


                                <button
                                    type="button"
                                    class="btn-close btn-close-white"
                                    data-bs-dismiss="modal"
                                    aria-label="Cerrar">
                                </button>

                            </div>



                            <!-- CUERPO -->

                            <div class="modal-body p-4">


                                <!-- ================================================= -->
                                <!-- INFORMACION GENERAL -->
                                <!-- ================================================= -->

                                <h5 class="fw-bold text-success mb-3">

                                    📋 Información del reporte

                                </h5>


                                <div class="row g-3 mb-4">


                                    <!-- FECHA DEL REPORTE -->

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">
                                                📅 Fecha del reporte
                                            </h6>

                                            <p class="mb-0">
                                                {{ $report->report_date }}
                                            </p>

                                        </div>

                                    </div>



                                    <!-- FECHA DE ASIGNACION -->

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">
                                                🕒 Fecha de asignación
                                            </h6>

                                            <p class="mb-0">

                                                {{
                                                    $report->assignment_date
                                                    ?? 'No disponible'
                                                }}

                                            </p>

                                        </div>

                                    </div>



                                    <!-- UBICACION -->

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">
                                                📍 Ubicación
                                            </h6>

                                            <p class="mb-0">
                                                {{ $report->location }}
                                            </p>

                                        </div>

                                    </div>



                                    <!-- MUNICIPIO LOCALIDAD -->

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">
                                                🏘️ Municipio / Localidad
                                            </h6>

                                            <p class="mb-1">

                                                <strong>
                                                    Municipio:
                                                </strong>

                                                {{
                                                    $report->municipality
                                                    ?? 'No disponible'
                                                }}

                                            </p>


                                            <p class="mb-0">

                                                <strong>
                                                    Localidad:
                                                </strong>

                                                {{
                                                    $report->locality
                                                    ?? 'No disponible'
                                                }}

                                            </p>

                                        </div>

                                    </div>



                                    <!-- COORDENADAS -->

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">
                                                🗺️ Coordenadas
                                            </h6>

                                            <p class="mb-1">

                                                <strong>Latitud:</strong>

                                                {{
                                                    $report->latitude
                                                    ?? 'No disponible'
                                                }}

                                            </p>


                                            <p class="mb-0">

                                                <strong>Longitud:</strong>

                                                {{
                                                    $report->longitude
                                                    ?? 'No disponible'
                                                }}

                                            </p>

                                        </div>

                                    </div>



                                    <!-- VEGETACION -->

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">
                                                🌲 Vegetación
                                            </h6>

                                            <p class="mb-0">

                                                {{
                                                    $report->ecosystem
                                                    ?? 'No disponible'
                                                }}

                                            </p>

                                        </div>

                                    </div>



                                    <!-- CATEGORIA -->

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">
                                                🔥 Categoría
                                            </h6>

                                            <p class="mb-0">

                                                {{
                                                    $report->category
                                                    ?? 'No disponible'
                                                }}

                                            </p>

                                        </div>

                                    </div>



                                    <!-- ESTADO -->

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">
                                                📌 Estado
                                            </h6>


                                            @if($report->status_id == 2)

                                                <span class="badge bg-secondary">

                                                        Asignado

                                                    </span>


                                            @elseif($report->status_id == 3)

                                                <span class="badge bg-primary">

                                                        En Proceso

                                                    </span>


                                            @else

                                                <span class="badge bg-warning text-dark">

                                                        {{ $report->status }}

                                                    </span>

                                            @endif


                                        </div>

                                    </div>



                                    <!-- DESCRIPCION -->

                                    <div class="col-md-12">

                                        <div class="border rounded-3 p-3">

                                            <h6 class="fw-bold">
                                                📝 Descripción
                                            </h6>

                                            <p class="mb-0">

                                                {{
                                                    $report->description
                                                    ?? 'Sin descripción'
                                                }}

                                            </p>

                                        </div>

                                    </div>


                                </div>



                                <hr class="my-4">



                                <!-- ================================================= -->
                                <!-- INFORMACION CLIMATOLOGICA -->
                                <!-- ================================================= -->

                                <h5 class="fw-bold text-success mb-3">

                                    🌤️ Información climatológica

                                </h5>


                                <div class="row g-3">


                                    <!-- TEMPERATURA -->

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">

                                                🌡️ Temperatura

                                            </h6>


                                            <p class="mb-1 fs-5">

                                                @if($report->weather_temperature !== null)

                                                    {{ $report->weather_temperature }} °C

                                                @else

                                                    Sin dato

                                                @endif

                                            </p>


                                            <small class="text-muted">

                                                Indica el calor actual en la zona
                                                del reporte.

                                            </small>

                                        </div>

                                    </div>



                                    <!-- HUMEDAD -->

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">

                                                💧 Humedad

                                            </h6>


                                            <p class="mb-1 fs-5">

                                                @if($report->weather_humidity !== null)

                                                    {{ $report->weather_humidity }} %

                                                @else

                                                    Sin dato

                                                @endif

                                            </p>


                                            <small class="text-muted">

                                                Mientras menor sea la humedad,
                                                más seco puede estar el ambiente.

                                            </small>

                                        </div>

                                    </div>



                                    <!-- PRECIPITACION -->

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">

                                                🌧️ Precipitación

                                            </h6>


                                            <p class="mb-1 fs-5">

                                                @if($report->weather_precipitation !== null)

                                                    {{ $report->weather_precipitation }} mm

                                                @else

                                                    Sin dato

                                                @endif

                                            </p>


                                            <small class="text-muted">

                                                Muestra si hubo lluvia reciente
                                                en la ubicación.

                                            </small>

                                        </div>

                                    </div>



                                    <!-- VELOCIDAD DEL VIENTO -->

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">

                                                🌬️ Velocidad del viento

                                            </h6>


                                            <p class="mb-1 fs-5">

                                                @if($report->weather_wind_speed !== null)

                                                    {{ $report->weather_wind_speed }} km/h

                                                @else

                                                    Sin dato

                                                @endif

                                            </p>


                                            <small class="text-muted">

                                                Ayuda a estimar qué tan rápido
                                                podría propagarse el fuego.

                                            </small>

                                        </div>

                                    </div>



                                    <!-- DIRECCION DEL VIENTO -->

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">

                                                🧭 Dirección del viento

                                            </h6>


                                            <p class="mb-1 fs-5">

                                                {{
                                                    $report->weather_wind_direction
                                                    ?? 'Sin dato'
                                                }}

                                            </p>


                                            <small class="text-muted">

                                                Indica hacia dónde puede
                                                desplazarse el humo o el incendio.

                                            </small>

                                        </div>

                                    </div>



                                    <!-- NUBOSIDAD -->

                                    <div class="col-md-6">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">

                                                ☁️ Nubosidad

                                            </h6>


                                            <p class="mb-1 fs-5">

                                                @if($report->weather_cloudiness !== null)

                                                    {{ $report->weather_cloudiness }} %

                                                @else

                                                    Sin dato

                                                @endif

                                            </p>


                                            <small class="text-muted">

                                                Representa la cantidad de cielo
                                                cubierto por nubes.

                                            </small>

                                        </div>

                                    </div>



                                    <!-- PRESION ATMOSFERICA -->

                                    <div class="col-md-12">

                                        <div class="border rounded-3 p-3 h-100">

                                            <h6 class="fw-bold">

                                                📈 Presión atmosférica

                                            </h6>


                                            <p class="mb-1 fs-5">

                                                @if($report->weather_atmospheric_pressure !== null)

                                                    {{ $report->weather_atmospheric_pressure }} hPa

                                                @else

                                                    Sin dato

                                                @endif

                                            </p>


                                            <small class="text-muted">

                                                Es un dato meteorológico que ayuda
                                                a describir las condiciones del ambiente.

                                            </small>

                                        </div>

                                    </div>


                                </div>


                            </div>



                            <!-- PIE -->

                            <div class="modal-footer justify-content-center border-0 pb-4">

                                <button
                                    type="button"
                                    class="btn btn-success rounded-pill px-5"
                                    data-bs-dismiss="modal">

                                    Entendido

                                </button>

                            </div>


                        </div>

                    </div>

                </div>



                <!-- ========================================================= -->
                <!-- MODAL ACEPTAR -->
                <!-- ========================================================= -->

                @if($report->status_id == 2)

                    <div
                        class="modal fade"
                        id="aceptarModal{{ $report->id_report }}"
                        tabindex="-1"
                        aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content border-0 shadow-lg rounded-4">


                                <div class="modal-header bg-success text-white rounded-top-4">

                                    <h5 class="modal-title">

                                        Aceptar reporte

                                    </h5>


                                    <button
                                        type="button"
                                        class="btn-close btn-close-white"
                                        data-bs-dismiss="modal">
                                    </button>

                                </div>



                                <div class="modal-body text-center p-4">

                                    <div
                                        class="mb-3"
                                        style="font-size: 48px;">

                                        ✅

                                    </div>


                                    <h5 class="fw-bold">

                                        ¿Deseas aceptar este reporte?

                                    </h5>


                                    <p class="text-muted mb-0">

                                        El reporte pasará al estado
                                        En Proceso.

                                    </p>

                                </div>



                                <div class="modal-footer justify-content-center border-0 pb-4">

                                    <button
                                        type="button"
                                        class="btn btn-secondary rounded-pill px-4"
                                        data-bs-dismiss="modal">

                                        Cancelar

                                    </button>


                                    <form
                                        action="{{ route('autoridad.reportes.aceptar', $report->id_report) }}"
                                        method="POST">

                                        @csrf


                                        <button
                                            type="submit"
                                            class="btn btn-success rounded-pill px-4">

                                            Sí, aceptar

                                        </button>

                                    </form>

                                </div>


                            </div>

                        </div>

                    </div>



                    <!-- ===================================================== -->
                    <!-- MODAL RECHAZAR -->
                    <!-- ===================================================== -->

                    <div
                        class="modal fade"
                        id="rechazarModal{{ $report->id_report }}"
                        tabindex="-1"
                        aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content border-0 shadow-lg rounded-4">


                                <div class="modal-header bg-danger text-white rounded-top-4">

                                    <h5 class="modal-title">

                                        Rechazar reporte

                                    </h5>


                                    <button
                                        type="button"
                                        class="btn-close btn-close-white"
                                        data-bs-dismiss="modal">
                                    </button>

                                </div>



                                <div class="modal-body text-center p-4">

                                    <div
                                        class="mb-3"
                                        style="font-size: 48px;">

                                        ⚠️

                                    </div>


                                    <h5 class="fw-bold">

                                        ¿Deseas rechazar este reporte?

                                    </h5>


                                    <p class="text-muted mb-0">

                                        El reporte regresará a Recibidos
                                        para que pueda ser reasignado.

                                    </p>

                                </div>



                                <div class="modal-footer justify-content-center border-0 pb-4">

                                    <button
                                        type="button"
                                        class="btn btn-secondary rounded-pill px-4"
                                        data-bs-dismiss="modal">

                                        Cancelar

                                    </button>


                                    <form
                                        action="{{ route('autoridad.reportes.rechazar', $report->id_report) }}"
                                        method="POST">

                                        @csrf


                                        <button
                                            type="submit"
                                            class="btn btn-danger rounded-pill px-4">

                                            Sí, rechazar

                                        </button>

                                    </form>

                                </div>


                            </div>

                        </div>

                    </div>

                @endif



                <!-- ========================================================= -->
                <!-- MODAL ATENDER -->
                <!-- ========================================================= -->

                @if($report->status_id == 3)

                    <div
                        class="modal fade"
                        id="atenderModal{{ $report->id_report }}"
                        tabindex="-1"
                        aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content border-0 shadow-lg rounded-4">


                                <div class="modal-header bg-success text-white rounded-top-4">

                                    <h5 class="modal-title">

                                        Marcar como atendido

                                    </h5>


                                    <button
                                        type="button"
                                        class="btn-close btn-close-white"
                                        data-bs-dismiss="modal">
                                    </button>

                                </div>



                                <div class="modal-body text-center p-4">

                                    <div
                                        class="mb-3"
                                        style="font-size: 48px;">

                                        🔥

                                    </div>


                                    <h5 class="fw-bold">

                                        ¿Deseas marcar este reporte como atendido?

                                    </h5>


                                    <p class="text-muted mb-0">

                                        Esta acción indicará que el incendio
                                        ya fue atendido por la autoridad.

                                    </p>

                                </div>



                                <div class="modal-footer justify-content-center border-0 pb-4">

                                    <button
                                        type="button"
                                        class="btn btn-secondary rounded-pill px-4"
                                        data-bs-dismiss="modal">

                                        Cancelar

                                    </button>


                                    <form
                                        action="{{ route('autoridad.reportes.atender', $report->id_report) }}"
                                        method="POST">

                                        @csrf


                                        <button
                                            type="submit"
                                            class="btn btn-success rounded-pill px-4">

                                            Sí, atender

                                        </button>

                                    </form>

                                </div>


                            </div>

                        </div>

                    </div>

                @endif


            @empty


                <tr>

                    <td colspan="8" class="text-center">

                        No tienes reportes asignados

                    </td>

                </tr>


            @endforelse

            </tbody>

        </table>

    </div>



    <!-- ============================================================= -->
    <!-- MODAL DE OPERACION EXITOSA -->
    <!-- ============================================================= -->

    @if(session('success'))

        <div
            class="modal fade"
            id="successModal"
            tabindex="-1"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 shadow-lg rounded-4">


                    <div class="modal-header bg-success text-white rounded-top-4">

                        <h5 class="modal-title">

                            Proceso realizado

                        </h5>


                        <button
                            type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                        </button>

                    </div>



                    <div class="modal-body text-center p-4">

                        <div
                            class="mb-3"
                            style="font-size: 48px;">

                            ✅

                        </div>


                        <h5 class="fw-bold">

                            Operación exitosa

                        </h5>


                        <p class="text-muted mb-0">

                            {{ session('success') }}

                        </p>

                    </div>



                    <div class="modal-footer justify-content-center border-0 pb-4">

                        <button
                            type="button"
                            class="btn btn-success rounded-pill px-4"
                            data-bs-dismiss="modal">

                            Entendido

                        </button>

                    </div>


                </div>

            </div>

        </div>



        <script>

            document.addEventListener('DOMContentLoaded', function () {

                const successModalElement =
                    document.getElementById('successModal');

                if (successModalElement) {

                    const successModal =
                        new bootstrap.Modal(
                            successModalElement,
                            {
                                backdrop: 'static',
                                keyboard: false
                            }
                        );

                    successModal.show();

                }

            });

        </script>

    @endif


@endsection
