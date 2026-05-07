@extends('layouts.menu_autoridades')

@section('contenido')

    @vite(['resources/css/perfil_autoridad.css'])

    <h2 class="titulo-autoridad">🛡️ Mi Perfil</h2>

    <div class="card datos-autoridad shadow p-4">

        <h4 class="subtitulo mb-3">Datos Personales</h4>

        <p>
            <strong>Nombre Completo:</strong>
            {{ $perfil->first_name ?? '' }}
            {{ $perfil->last_name ?? '' }}
            {{ $perfil->middle_name ?? '' }}
        </p>

        <p>
            <strong>Correo:</strong>
            {{ $perfil->email ?? 'N/A' }}
        </p>

        <p>
            <strong>Telefono:</strong>
            {{ $perfil->phone ?? 'N/A' }}
        </p>

        <p>
            <strong>Usuario:</strong>
            {{ $perfil->username ?? 'N/A' }}
        </p>

        <div class="mb-3">
            <strong>Contrasena:</strong>

            <div class="input-group mt-2" style="max-width: 420px;">
                <input type="password"
                       id="campoPassword"
                       class="form-control"
                       value="***************"
                       readonly>

                <button class="btn btn-outline-secondary"
                        type="button"
                        onclick="togglePassword()"
                        id="btnTogglePassword">
                    Ver
                </button>

                <button class="btn btn-info text-white"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#passwordInfoModal">
                    Info
                </button>
            </div>

            <small class="text-muted">
                Por seguridad, la contrasena real no puede mostrarse porque esta cifrada en la base de datos.
            </small>
        </div>

        <h4 class="subtitulo mt-4 mb-3">Datos de la Empresa</h4>

        <p>
            <strong>Nombre de la Empresa:</strong>
            {{ $perfil->company_name ?? 'N/A' }}
        </p>

        <p>
            <strong>Clave de Empresa:</strong>
            {{ $perfil->company_key ?? 'N/A' }}
        </p>

        <p>
            <strong>Clave de Trabajo:</strong>
            {{ $perfil->employee_key ?? 'N/A' }}
        </p>

        <p>
            <strong>Ubicacion:</strong>
            {{ $perfil->company_location ?? 'N/A' }}
        </p>

    </div>

    <!-- MODAL INFORMATIVO DE CONTRASENA -->
    <div class="modal fade" id="passwordInfoModal" tabindex="-1" aria-labelledby="passwordInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">

                <div class="modal-header bg-info text-white rounded-top-4">
                    <h5 class="modal-title" id="passwordInfoModalLabel">
                        Informacion de seguridad
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"
                            aria-label="Cerrar">
                    </button>
                </div>

                <div class="modal-body text-center p-4">
                    <div class="mb-3" style="font-size: 48px;">
                        🔐
                    </div>

                    <h5 class="fw-bold mb-2">La contrasena esta protegida</h5>

                    <p class="text-muted mb-0">
                        La contrasena real no se puede mostrar porque Laravel la guarda cifrada.
                        Por eso solo se muestra una representacion con asteriscos.
                    </p>
                </div>

                <div class="modal-footer justify-content-center border-0 pb-4">
                    <button type="button"
                            class="btn btn-info text-white px-4 rounded-pill"
                            data-bs-dismiss="modal">
                        Entendido
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const campo = document.getElementById('campoPassword');
            const boton = document.getElementById('btnTogglePassword');

            if (campo.type === 'password') {
                campo.type = 'text';
                boton.textContent = 'Ocultar';
            } else {
                campo.type = 'password';
                boton.textContent = 'Ver';
            }
        }
    </script>

@endsection
