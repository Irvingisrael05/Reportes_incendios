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
            <strong>Contraseña:</strong>

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
            </div>

            <small class="text-muted">
                Por seguridad, la contraseña real no puede mostrarse porque está cifrada en la base de datos.
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
