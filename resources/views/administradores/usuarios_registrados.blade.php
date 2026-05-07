@extends('layouts.menu_administradores')

@section('contenido')

    @vite(['resources/css/usuarios_registrados.css'])

    <h3 class="fw-bold text-success mb-4">
        Usuarios Registrados
    </h3>

    <!-- BOTONES DE SECCION -->
    <div class="mb-4">
        <button class="btn btn-success me-2" onclick="mostrarSeccion('civiles')">
            Civiles
        </button>

        <button class="btn btn-primary" onclick="mostrarSeccion('autoridades')">
            Autoridades
        </button>
    </div>

    <!-- CIVILES -->
    <div id="civiles">

        <h4 class="fw-bold text-success mb-3">
            Usuarios Civiles
        </h4>

        <div class="busqueda mb-3">
            <input
                type="text"
                id="buscarCivil"
                class="form-control"
                placeholder="Buscar civil..."
                onkeyup="buscarTabla('tablaCiviles','buscarCivil')">
        </div>

        <div class="table-responsive">
            <table id="tablaCiviles"
                   class="table table-bordered table-hover table-striped">

                <thead class="encabezado-civiles">
                <tr>
                    <th>Nombre Completo</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Usuario</th>
                    <th>Accion</th>
                </tr>
                </thead>

                <tbody>
                @forelse($civiles as $civil)
                    <tr>
                        <td>
                            {{ $civil->first_name ?? '' }}
                            {{ $civil->last_name ?? '' }}
                            {{ $civil->middle_name ?? '' }}
                        </td>
                        <td>{{ $civil->email ?? '' }}</td>
                        <td>{{ $civil->phone ?? '' }}</td>
                        <td>{{ $civil->username ?? '' }}</td>
                        <td>
                            <button type="button"
                                    class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#eliminarCivil{{ $civil->id_user }}">
                                Eliminar
                            </button>
                        </td>
                    </tr>

                    <!-- MODAL ELIMINAR CIVIL -->
                    <div class="modal fade" id="eliminarCivil{{ $civil->id_user }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg rounded-4">

                                <div class="modal-header bg-danger text-white rounded-top-4">
                                    <h5 class="modal-title">Eliminar usuario civil</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body text-center p-4">
                                    <div class="mb-3" style="font-size: 48px;">⚠️</div>

                                    <h5 class="fw-bold mb-2">¿Deseas eliminar este usuario?</h5>

                                    <p class="text-muted mb-0">
                                        Esta accion eliminara al usuario civil del sistema.
                                    </p>
                                </div>

                                <div class="modal-footer justify-content-center border-0 pb-4">
                                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                        Cancelar
                                    </button>

                                    <form action="{{ route('admin.usuarios.destroy', $civil->id_user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                                            Si, eliminar
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            No hay usuarios civiles registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

    </div>

    <!-- AUTORIDADES -->
    <div id="autoridades" style="display:none;">

        <h4 class="fw-bold text-success mb-3">
            Usuarios Autoridad
        </h4>

        <div class="busqueda mb-3">
            <input
                type="text"
                id="buscarAutoridad"
                class="form-control"
                placeholder="Buscar autoridad..."
                onkeyup="buscarTabla('tablaAutoridades','buscarAutoridad')">
        </div>

        <div class="table-responsive">
            <table id="tablaAutoridades"
                   class="table table-bordered table-hover table-striped">

                <thead class="encabezado-autoridades">
                <tr>
                    <th>Nombre Completo</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Usuario</th>
                    <th>Detalles</th>
                    <th>Accion</th>
                </tr>
                </thead>

                <tbody>
                @forelse($autoridades as $autoridad)
                    <tr>
                        <td>
                            {{ $autoridad->first_name ?? '' }}
                            {{ $autoridad->last_name ?? '' }}
                            {{ $autoridad->middle_name ?? '' }}
                        </td>
                        <td>{{ $autoridad->email ?? '' }}</td>
                        <td>{{ $autoridad->phone ?? '' }}</td>
                        <td>{{ $autoridad->username ?? '' }}</td>
                        <td>
                            <button type="button"
                                    class="btn btn-info btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detalleAutoridad{{ $autoridad->id_user }}">
                                Detalles
                            </button>
                        </td>
                        <td>
                            <button type="button"
                                    class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#eliminarAutoridad{{ $autoridad->id_user }}">
                                Eliminar
                            </button>
                        </td>
                    </tr>

                    <!-- MODAL DETALLES AUTORIDAD -->
                    <div class="modal fade" id="detalleAutoridad{{ $autoridad->id_user }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg rounded-4">

                                <div class="modal-header bg-info text-white rounded-top-4">
                                    <h5 class="modal-title">Detalles de autoridad</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body p-4">
                                    <div class="text-center mb-3" style="font-size: 48px;">🛡️</div>

                                    <p><strong>Empresa:</strong> {{ $autoridad->company_name }}</p>
                                    <p><strong>Clave Empresa:</strong> {{ $autoridad->company_key }}</p>
                                    <p><strong>Clave Empleado:</strong> {{ $autoridad->employee_key }}</p>
                                    <p><strong>Ubicacion:</strong> {{ $autoridad->company_location }}</p>
                                </div>

                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                        Cerrar
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- MODAL ELIMINAR AUTORIDAD -->
                    <div class="modal fade" id="eliminarAutoridad{{ $autoridad->id_user }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg rounded-4">

                                <div class="modal-header bg-danger text-white rounded-top-4">
                                    <h5 class="modal-title">Eliminar usuario autoridad</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body text-center p-4">
                                    <div class="mb-3" style="font-size: 48px;">⚠️</div>

                                    <h5 class="fw-bold mb-2">¿Deseas eliminar esta autoridad?</h5>

                                    <p class="text-muted mb-0">
                                        Esta accion eliminara al usuario autoridad del sistema.
                                    </p>
                                </div>

                                <div class="modal-footer justify-content-center border-0 pb-4">
                                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                        Cancelar
                                    </button>

                                    <form action="{{ route('admin.usuarios.destroy', $autoridad->id_user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                                            Si, eliminar
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No hay usuarios autoridad registrados
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

    </div>

    @if(session('success'))
        <div class="modal fade" id="successUsuariosModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">

                    <div class="modal-header bg-success text-white rounded-top-4">
                        <h5 class="modal-title">Proceso realizado</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center p-4">
                        <div class="mb-3" style="font-size: 48px;">✅</div>

                        <h5 class="fw-bold mb-2">Operacion exitosa</h5>

                        <p class="text-muted mb-0">
                            {{ session('success') }}
                        </p>
                    </div>

                    <div class="modal-footer justify-content-center border-0 pb-4">
                        <button type="button" class="btn btn-success rounded-pill px-4" data-bs-dismiss="modal">
                            Entendido
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const successUsuariosModal = new bootstrap.Modal(document.getElementById('successUsuariosModal'), {
                    backdrop: 'static',
                    keyboard: false
                });

                successUsuariosModal.show();
            });
        </script>
    @endif

    <script>
        function mostrarSeccion(seccion) {
            document.getElementById('civiles').style.display = 'none';
            document.getElementById('autoridades').style.display = 'none';
            document.getElementById(seccion).style.display = 'block';
        }

        function buscarTabla(tablaID, inputID) {
            let input = document.getElementById(inputID).value.toLowerCase();
            let tabla = document.getElementById(tablaID);
            let filas = tabla.getElementsByTagName("tr");

            for (let i = 1; i < filas.length; i++) {
                let texto = filas[i].innerText.toLowerCase();

                if (texto.includes(input)) {
                    filas[i].style.display = "";
                } else {
                    filas[i].style.display = "none";
                }
            }
        }
    </script>

@endsection
