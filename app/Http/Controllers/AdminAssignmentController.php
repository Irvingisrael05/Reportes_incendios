<?php

namespace App\Http\Controllers;

use App\Models\ReportModel;
use App\Models\AssignmentModel;
use App\Models\User;
use App\Models\PersonModel;
use App\Models\AuthorityRequestModel;
use App\Models\EcosystemModel;
use App\Models\WeatherModel;
use App\Models\ReportStatusModel;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAssignmentController extends Controller
{
    /**
     * Muestra la vista de asignación de reportes.
     */
    public function index()
    {
        // 1. Reportes recibidos sin asignar (status = 'Recibido' y sin asignación)
        $reportes = ReportModel::whereHas('status', function ($query) {
                $query->where('description', 'Recibido');
            })
            ->whereDoesntHave('assignments') // no tiene asignación relacionada
            ->with(['ecosystem', 'weather', 'evidences.category'])
            ->get()
            ->map(function ($report) {
                // Calcular categoría mínima (para simular el MIN(c.description))
                $minCategory = $report->evidences->pluck('category.description')->filter()->min();
                $category = $minCategory ?: 'Sin categoria';

                // Construir climatografía
                $weather = $report->weather;
                $climatografia = sprintf(
                    '%s°C / %s%% / %s kmh',
                    $weather->temperature ?? 'Sin dato',
                    $weather->humidity ?? 'Sin dato',
                    $weather->wind_speed ?? 'Sin dato'
                );

                return (object) [
                    'id_report'    => $report->id_report,
                    'report_date'  => $report->report_date,
                    'location'     => $report->latitude . ', ' . $report->longitude,
                    'ecosystem'    => $report->ecosystem->description ?? 'N/A',
                    'category'     => $category,
                    'description'  => $report->description,
                    'climatografia'=> $climatografia,
                ];
            })
            ->sortByDesc('report_date')
            ->values();

        // 2. Autoridades (usuarios con rol 'autoridad')
        $autoridades = User::whereHas('role', function ($query) {
                $query->whereRaw('LOWER(role_type) = ?', ['autoridad']);
            })
            ->with('person')
            ->with(['authorityRequest' => function ($query) {
                $query->where('status', 'approved');
            }])
            ->get()
            ->map(function ($user) {
                return (object) [
                    'id_user'      => $user->id_user,
                    'username'     => $user->username,
                    'first_name'   => $user->person->first_name ?? '',
                    'last_name'    => $user->person->last_name ?? '',
                    'middle_name'  => $user->person->middle_name ?? '',
                    'company_name' => $user->authorityRequest->company_name ?? 'Sin empresa',
                ];
            })
            ->sortBy('first_name')
            ->values();

        // 3. Asignaciones ya realizadas (con datos de reporte, usuario, persona, empresa)
        $asignaciones = AssignmentModel::with(['report', 'authority.person', 'authority.authorityRequest' => function ($q) {
                $q->where('status', 'approved');
            }])
            ->get()
            ->map(function ($assignment) {
                $authority = $assignment->authority;
                $person = $authority->person ?? null;
                $company = $authority->authorityRequest->company_name ?? 'Sin empresa';

                return (object) [
                    'id_assignment'   => $assignment->id_assignment,
                    'report_id'       => $assignment->report_id,
                    'authority_id'    => $assignment->authority_id,
                    'assignment_date' => $assignment->assignment_date,
                    'company_name'    => $company,
                    'first_name'      => $person->first_name ?? '',
                    'last_name'       => $person->last_name ?? '',
                    'middle_name'     => $person->middle_name ?? '',
                    'username'        => $authority->username ?? '',
                ];
            })
            ->sortByDesc('assignment_date')
            ->values();

        return view('administradores.asignar_reportes', compact('reportes', 'autoridades', 'asignaciones'));
    }

    /**
     * Almacena una nueva asignación y cambia el estado del reporte a "En proceso" (status_id = 3).
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'authority_id' => 'required|integer|exists:users,id_user',
        ]);

        DB::transaction(function () use ($request, $id) {
            // Crear asignación con Eloquent
            AssignmentModel::create([
                'report_id'      => $id,
                'authority_id'   => $request->authority_id,
                'assignment_date'=> now(),
                'attended_date'  => null,
            ]);

            // Actualizar el reporte (si está en estado Recibido = 1, lo cambiamos a En proceso = 3)
            $report = ReportModel::find($id);
            if ($report && $report->status_id == 1) {
                $report->status_id = 3;
                $report->save();
            }
        });

        return redirect()
            ->route('admin.asignaciones')
            ->with('success', 'Reporte asignado correctamente.');
    }

    /**
     * Reasigna una asignación existente (cambia la autoridad).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'authority_id' => 'required|integer|exists:users,id_user',
        ]);

        $assignment = AssignmentModel::find($id);
        if ($assignment) {
            $assignment->authority_id = $request->authority_id;
            $assignment->save();
        }

        return redirect()
            ->route('admin.asignaciones')
            ->with('success', 'Asignacion reasignada correctamente.');
    }

    /**
     * Cancela una asignación, elimina el registro y devuelve el reporte a "Recibido" (status_id = 1).
     */
    public function cancel($id)
    {
        DB::transaction(function () use ($id) {
            $assignment = AssignmentModel::find($id);
            if ($assignment) {
                $reportId = $assignment->report_id;
                // Eliminar asignación
                $assignment->delete();

                // Actualizar reporte a estado Recibido (1)
                $report = ReportModel::find($reportId);
                if ($report) {
                    $report->status_id = 1;
                    $report->save();
                }
            }
        });

        return redirect()
            ->route('admin.asignaciones')
            ->with('success', 'Asignacion cancelada y reporte regresado a Recibido.');
    }
}