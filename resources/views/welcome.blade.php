<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reportes de Incendios Forestales</title>

    @vite(['resources/css/app.css','resources/css/welcome.css', 'resources/js/app.js'])


</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" width="75" class="me-3">
            <div>
                <span class="fw-bold fs-4 text-white">Incendios Forestales</span><br>
                <small class="text-light">Sistema de Monitoreo y Prevención</small>
            </div>
        </a>

        <div class="ms-auto d-flex">
            <a href="/Login" class="btn btn-outline-light me-2">
                Iniciar sesión
            </a>

            <a href="/Registro" class="btn btn-light text-dark">
                Registrarse
            </a>
        </div>

    </div>
</nav>

<!-- HERO -->
<section class="hero-section text-center">
    <div class="container">

        <h1 class="display-4 fw-bold">
            Protección Activa de Nuestros Ecosistemas
        </h1>

        <p class="lead mt-4">
            Plataforma tecnológica enfocada en la prevención, detección temprana
            y control estratégico de incendios forestales,
            reduciendo riesgos ambientales y protegiendo nuestro patrimonio natural.
        </p>

        <div class="mt-4">
            <a href="/Login" class="btn btn-light btn-lg px-5 fw-semibold">
                Realizar Reporte
            </a>
        </div>

    </div>
</section>

<!-- SOBRE NOSOTROS -->
<section class="py-5">
    <div class="container text-center">

        <h2 class="section-title mb-4 fw-bold">
            Comprometidos con la Prevención
        </h2>

        <div class="row justify-content-center">
            <div class="col-md-9">

                <p class="fs-5 text-muted">
                    Este sistema fue desarrollado con la finalidad de fortalecer la prevención,
                    detección temprana y contención estratégica de incendios forestales.
                    A través del monitoreo continuo y el registro oportuno de incidentes,
                    se busca reducir el impacto ambiental y proteger los ecosistemas vulnerables.
                </p>

                <p class="fs-5 text-muted">
                    La plataforma contribuye a evitar la expansión del fuego mediante
                    información estructurada en tiempo oportuno, facilitando la toma de decisiones
                    rápidas y coordinadas por parte de las autoridades responsables.
                </p>

            </div>
        </div>

    </div>
</section>

<!-- FUNCIONALIDADES -->
<section class="py-5 bg-white">
    <div class="container text-center">

        <h2 class="section-title mb-5 fw-bold">
            Acciones Clave del Sistema
        </h2>

        <div class="row">

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100 p-3">
                    <div class="card-body">
                        <h5 class="fw-bold">Registro Estratégico</h5>
                        <p class="text-muted">
                            Captura precisa de ubicación, fecha y características
                            del incidente para su evaluación inmediata.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100 p-3">
                    <div class="card-body">
                        <h5 class="fw-bold">Seguimiento Operativo</h5>
                        <p class="text-muted">
                            Supervisión del estado del incidente para asegurar
                            una respuesta coordinada y eficaz.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100 p-3">
                    <div class="card-body">
                        <h5 class="fw-bold">Prevención Estratégica</h5>
                        <p class="text-muted">
                            Identificación de zonas críticas y evaluación de riesgos
                            para anticipar posibles focos de incendio y minimizar su propagación.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- FOOTER -->
<footer class="text-center py-4 footer-custom">
    <div class="container">
        <small>© {{ date('Y') }} Sistema de Monitoreo y Prevención de Incendios Forestales</small>
    </div>
</footer>

</body>
</html>
