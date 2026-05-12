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
     * Muestra la vista de asignacion de reportes.
     */
    public function index()
    {
        // 1. Reportes recibidos sin asignar
        $reportes = ReportModel::whereHas('status', function ($query) {
            $query->where('description', 'Recibido');
        })
            ->whereDoesntHave('assignments')
            ->with(['ecosystem', 'weather', 'evidences.category'])
            ->get()
            ->map(function ($report) {

                // Categoria minima
                $minCategory = $report->evidences
                    ->pluck('category.description')
                    ->filter()
                    ->min();

                $category = $minCategory ?: 'Sin categoria';

                // Climatografia
                $weather = $report->weather;

                $climatografia = sprintf(
                    '%s°C / %s%% / %s km/h',
                    $weather->temperature ?? 'Sin dato',
                    $weather->humidity ?? 'Sin dato',
                    $weather->wind_speed ?? 'Sin dato'
                );

                return (object) [

                    'id_report' => $report->id_report,

                    'report_date' => $report->report_date,

                    // Ubicacion
                    'latitude' => $report->latitude,
                    'longitude' => $report->longitude,

                    'municipality' => $report->municipality,
                    'locality' => $report->locality,

                    'location' => $report->latitude . ', ' . $report->longitude,

                    // Ecosistema
                    'ecosystem' => $report->ecosystem->description ?? 'N/A',

                    // Categoria
                    'category' => $category,

                    // Descripcion
                    'description' => $report->description,

                    // Climatografia resumida
                    'climatografia' => $climatografia,

                    // Datos climaticos detallados
                    'weather_temperature' => $weather->temperature ?? null,

                    'weather_humidity' => $weather->humidity ?? null,

                    'weather_precipitation' => $weather->precipitation ?? null,

                    'weather_wind_speed' => $weather->wind_speed ?? null,

                    'weather_wind_direction' => $weather->wind_direction ?? null,

                    'weather_atmospheric_pressure' => $weather->atmospheric_pressure ?? null,

                    'weather_cloudiness' => $weather->cloudiness ?? null,
                ];
            })
            ->sortByDesc('report_date')
            ->values();

        // 2. Autoridades
        $autoridades = User::whereHas('role', function ($query) {
            $query->whereRaw('LOWER(role_type) = ?', ['autoridad']);
        })
            ->with('person')
            ->with([
                'authorityRequest' => function ($query) {
                    $query->where('status', 'approved');
                }
            ])
            ->get()
            ->map(function ($user) {

                return (object) [

                    'id_user' => $user->id_user,

                    'username' => $user->username,

                    'first_name' => $user->person->first_name ?? '',

                    'last_name' => $user->person->last_name ?? '',

                    'middle_name' => $user->person->middle_name ?? '',

                    'company_name' => $user->authorityRequest->company_name ?? 'Sin empresa',
                ];
            })
            ->sortBy('first_name')
            ->values();

        // 3. Asignaciones realizadas
        $asignaciones = AssignmentModel::with([
            'report',
            'authority.person',
            'authority.authorityRequest' => function ($q) {
                $q->where('status', 'approved');
            }
        ])
            ->get()
            ->map(function ($assignment) {

                $authority = $assignment->authority;

                $person = $authority->person ?? null;

                $company = $authority->authorityRequest->company_name ?? 'Sin empresa';

                return (object) [

                    'id_assignment' => $assignment->id_assignment,

                    'report_id' => $assignment->report_id,

                    'authority_id' => $assignment->authority_id,

                    'assignment_date' => $assignment->assignment_date,

                    'company_name' => $company,

                    'first_name' => $person->first_name ?? '',

                    'last_name' => $person->last_name ?? '',

                    'middle_name' => $person->middle_name ?? '',

                    'username' => $authority->username ?? '',
                ];
            })
            ->sortByDesc('assignment_date')
            ->values();

        return view(
            'administradores.asignar_reportes',
            compact(
                'reportes',
                'autoridades',
                'asignaciones'
            )
        );
    }

    /**
     * Crear asignacion
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'authority_id' => 'required|integer|exists:users,id_user',
        ]);

        DB::transaction(function () use ($request, $id) {

            AssignmentModel::create([

                'report_id' => $id,

                'authority_id' => $request->authority_id,

                'assignment_date' => now(),

                'attended_date' => null,
            ]);

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
     * Reasignar autoridad
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
     * Cancelar asignacion
     */
    public function cancel($id)
    {
        DB::transaction(function () use ($id) {

            $assignment = AssignmentModel::find($id);

            if ($assignment) {

                $reportId = $assignment->report_id;

                // Eliminar asignacion
                $assignment->delete();

                // Regresar reporte a recibido
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
