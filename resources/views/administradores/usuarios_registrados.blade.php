@extends('layouts.menu_administradores')

@section('contenido')

    @vite(['resources/css/usuarios_registrados.css'])

    <h3 class="fw-bold text-success mb-4">
        Usuarios Registrados
    </h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
                            <form action="{{ route('admin.usuarios.destroy', $civil->id_user) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Deseas eliminar este usuario civil?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
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
                                    onclick="toggleDetalle('detalle{{ $autoridad->id_user }}')">
                                Detalles
                            </button>
                        </td>
                        <td>
                            <form action="{{ route('admin.usuarios.destroy', $autoridad->id_user) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Deseas eliminar este usuario autoridad?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>

                    <tr class="fila-detalle" id="detalle{{ $autoridad->id_user }}" style="display:none;">
                        <td colspan="6">
                            <div class="detalle-empresa">
                                <p><strong>Empresa:</strong> {{ $autoridad->company_name }}</p>
                                <p><strong>Clave Empresa:</strong> {{ $autoridad->company_key }}</p>
                                <p><strong>Clave Empleado:</strong> {{ $autoridad->employee_key }}</p>
                                <p><strong>Ubicacion:</strong> {{ $autoridad->company_location }}</p>
                            </div>
                        </td>
                    </tr>
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

        function toggleDetalle(idDetalle) {
            let fila = document.getElementById(idDetalle);

            if (fila.style.display === "table-row") {
                fila.style.display = "none";
            } else {
                fila.style.display = "table-row";
            }
        }
    </script>

@endsection
