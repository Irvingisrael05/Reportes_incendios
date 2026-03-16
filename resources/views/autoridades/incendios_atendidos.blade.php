@extends('layouts.menu_autoridades')

@section('contenido')
    @vite(['resources/css/Incendios_Atendidos.css'])

    <h3 class="fw-bold text-success mb-4">
        Incendios Atendidos
    </h3>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-success text-white">
            <tr>
                <th>Fecha de Reporte</th>
                <th>Fecha de Atencion</th>
                <th>Ubicacion</th>
                <th>Ecosistema</th>
                <th>Categoria</th>
                <th>Descripcion</th>
                <th>Estado</th>
            </tr>
            </thead>

            <tbody>
            @forelse($reports as $report)
                <tr>
                    <td>{{ $report->report_date }}</td>
                    <td>{{ $report->attended_date }}</td>
                    <td>{{ $report->location }}</td>
                    <td>{{ $report->ecosystem }}</td>
                    <td>{{ $report->category }}</td>
                    <td>{{ $report->description }}</td>
                    <td>
                        <span class="badge bg-success">
                            {{ $report->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        No hay incendios atendidos
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
