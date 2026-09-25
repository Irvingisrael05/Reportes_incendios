<?php

namespace App\Http\Controllers;

use App\Models\AssignmentModel;
use App\Models\ReportModel;
use Illuminate\Support\Facades\DB;

class AuthorityReportController extends Controller
{
    /**
     * Mostrar reportes asignados a la autoridad autenticada.
     */
    public function index()
    {
        $usuario = auth()->user();

        $asignaciones = AssignmentModel::where(
            'authority_id',
            $usuario->id_user
        )
            ->whereHas('report', function ($query) {
                $query->whereIn('status_id', [2, 3]);
            })
            ->with([
                'report.ecosystem',
                'report.weather',
                'report.category',
                'report.status'
            ])
            ->orderBy('assignment_date', 'desc')
            ->get();

        $reports = $asignaciones
            ->map(function ($asignacion) {

                $report = $asignacion->report;

                if (!$report) {
                    return null;
                }

                /*
                |--------------------------------------------------------------------------
                | RELACIONES DEL REPORTE
                |--------------------------------------------------------------------------
                */

                $weather = $report->weather;
                $ecosystem = $report->ecosystem;
                $category = $report->category;
                $status = $report->status;

                /*
                |--------------------------------------------------------------------------
                | OBJETO QUE SE ENVIA A LA VISTA
                |--------------------------------------------------------------------------
                */

                return (object) [

                    // Asignación
                    'id_assignment' => $asignacion->id_assignment,
                    'assignment_date' => $asignacion->assignment_date,
                    'attended_date' => $asignacion->attended_date,

                    // Reporte
                    'id_report' => $report->id_report,
                    'report_date' => $report->report_date,

                    'description' => $report->description,

                    'latitude' => $report->latitude,
                    'longitude' => $report->longitude,

                    'municipality' => $report->municipality,
                    'locality' => $report->locality,

                    'location' =>
                        $report->latitude . ', ' . $report->longitude,

                    // Estado
                    'status_id' => $report->status_id,

                    'status' =>
                        $status->description
                        ?? 'Sin estado',

                    // Ecosistema
                    'ecosystem' =>
                        $ecosystem->description
                        ?? 'N/A',

                    // Categoría
                    'category' =>
                        $category->description
                        ?? 'Sin categoria',

                    /*
                    |--------------------------------------------------------------------------
                    | INFORMACION CLIMATOLOGICA
                    |--------------------------------------------------------------------------
                    |
                    | NO hacemos JOIN manual.
                    | Utilizamos la relación weather que ya funciona
                    | en AdminAssignmentController.
                    |
                    */

                    'weather_temperature' =>
                        $weather->temperature ?? null,

                    'weather_humidity' =>
                        $weather->humidity ?? null,

                    'weather_precipitation' =>
                        $weather->precipitation ?? null,

                    'weather_wind_speed' =>
                        $weather->wind_speed ?? null,

                    'weather_wind_direction' =>
                        $weather->wind_direction ?? null,

                    'weather_atmospheric_pressure' =>
                        $weather->atmospheric_pressure ?? null,

                    'weather_cloudiness' =>
                        $weather->cloudiness ?? null,
                ];
            })
            ->filter()
            ->values();

        return view(
            'autoridades.reportes_asignados',
            compact('reports')
        );
    }


    /**
     * Aceptar reporte.
     *
     * 2 = Asignado
     * 3 = En Proceso
     */
    public function aceptarReporte($id)
    {
        $usuario = auth()->user();

        $asignacion = AssignmentModel::where(
            'report_id',
            $id
        )
            ->where(
                'authority_id',
                $usuario->id_user
            )
            ->first();

        if (!$asignacion) {

            return redirect()
                ->route('reportes.asignados')
                ->with(
                    'success',
                    'No se encontro una asignacion valida para este reporte.'
                );
        }

        $report = ReportModel::find($id);

        if (!$report) {

            return redirect()
                ->route('reportes.asignados')
                ->with(
                    'success',
                    'No se encontro el reporte.'
                );
        }

        if ($report->status_id == 2) {

            $report->status_id = 3;
            $report->save();
        }

        return redirect()
            ->route('reportes.asignados')
            ->with(
                'success',
                'El reporte fue aceptado y ahora esta En proceso.'
            );
    }


    /**
     * Rechazar reporte.
     *
     * Regresa a:
     * 1 = Recibido
     */
    public function rechazarReporte($id)
    {
        $usuario = auth()->user();

        DB::transaction(function () use ($id, $usuario) {

            $asignacion = AssignmentModel::where(
                'report_id',
                $id
            )
                ->where(
                    'authority_id',
                    $usuario->id_user
                )
                ->first();

            if (!$asignacion) {
                return;
            }

            $report = ReportModel::find($id);

            if (!$report) {
                return;
            }

            if ($report->status_id == 2) {

                $report->status_id = 1;
                $report->save();
            }

            $asignacion->delete();
        });

        return redirect()
            ->route('reportes.asignados')
            ->with(
                'success',
                'El reporte fue rechazado y regreso a Recibidos para reasignacion.'
            );
    }


    /**
     * Marcar reporte como atendido.
     *
     * 3 = En Proceso
     * 4 = Atendido
     */
    public function marcarAtendido($id)
    {
        $usuario = auth()->user();

        DB::transaction(function () use ($id, $usuario) {

            $asignacion = AssignmentModel::where(
                'report_id',
                $id
            )
                ->where(
                    'authority_id',
                    $usuario->id_user
                )
                ->first();

            if (!$asignacion) {
                return;
            }

            $report = ReportModel::find($id);

            if (!$report) {
                return;
            }

            if ($report->status_id == 3) {

                $report->status_id = 4;
                $report->save();
            }

            $asignacion->attended_date = now();
            $asignacion->save();
        });

        return redirect()
            ->route('reportes.asignados')
            ->with(
                'success',
                'El reporte fue marcado como atendido.'
            );
    }
}
