<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AuthorityReportController extends Controller
{
    public function index()
    {
        $usuario = auth()->user();

        $reports = DB::table('assignments as a')
            ->join('reports as r', 'a.report_id', '=', 'r.id_report')
            ->join('ecosystems as e', 'r.ecosystem_id', '=', 'e.id_ecosystem')
            ->join('report_status as rs', 'r.status_id', '=', 'rs.id_status')
            ->leftJoin('evidences as ev', 'r.id_report', '=', 'ev.report_id')
            ->leftJoin('categories as c', 'ev.category_id', '=', 'c.id_category')
            ->select(
                'a.id_assignment',
                'a.assignment_date',
                'a.attended_date',
                'r.id_report',
                'r.report_date',
                'r.description',
                'r.latitude',
                'r.longitude',
                'r.municipality',
                'r.locality',
                'r.status_id',
                DB::raw("CONCAT(r.latitude, ', ', r.longitude) as location"),
                'e.description as ecosystem',
                DB::raw("COALESCE(MIN(c.description), 'Sin categoria') as category"),
                'rs.description as status'
            )
            ->where('a.authority_id', $usuario->id_user)
            ->whereIn('r.status_id', [2, 3])
            ->groupBy(
                'a.id_assignment',
                'a.assignment_date',
                'a.attended_date',
                'r.id_report',
                'r.report_date',
                'r.description',
                'r.latitude',
                'r.longitude',
                'r.municipality',
                'r.locality',
                'r.status_id',
                'e.description',
                'rs.description'
            )
            ->orderBy('a.assignment_date', 'desc')
            ->get();

        return view('autoridades.reportes_asignados', compact('reports'));
    }

    public function aceptarReporte($id)
    {
        $usuario = auth()->user();

        $asignacion = DB::table('assignments')
            ->where('report_id', $id)
            ->where('authority_id', $usuario->id_user)
            ->first();

        if (!$asignacion) {
            return redirect()
                ->route('reportes.asignados')
                ->with('success', 'No se encontro una asignacion valida para este reporte.');
        }

        DB::table('reports')
            ->where('id_report', $id)
            ->where('status_id', 2)
            ->update([
                'status_id' => 3
            ]);

        return redirect()
            ->route('reportes.asignados')
            ->with('success', 'El reporte fue aceptado y ahora esta En proceso.');
    }

    public function rechazarReporte($id)
    {
        $usuario = auth()->user();

        DB::transaction(function () use ($id, $usuario) {
            $asignacion = DB::table('assignments')
                ->where('report_id', $id)
                ->where('authority_id', $usuario->id_user)
                ->first();

            if (!$asignacion) {
                return;
            }

            DB::table('reports')
                ->where('id_report', $id)
                ->where('status_id', 2)
                ->update([
                    'status_id' => 1
                ]);

            DB::table('assignments')
                ->where('id_assignment', $asignacion->id_assignment)
                ->delete();
        });

        return redirect()
            ->route('reportes.asignados')
            ->with('success', 'El reporte fue rechazado y regreso a Recibidos para reasignacion.');
    }

    public function marcarAtendido($id)
    {
        $usuario = auth()->user();

        DB::transaction(function () use ($id, $usuario) {
            $asignacion = DB::table('assignments')
                ->where('report_id', $id)
                ->where('authority_id', $usuario->id_user)
                ->first();

            if (!$asignacion) {
                return;
            }

            DB::table('reports')
                ->where('id_report', $id)
                ->where('status_id', 3)
                ->update([
                    'status_id' => 4
                ]);

            DB::table('assignments')
                ->where('id_assignment', $asignacion->id_assignment)
                ->update([
                    'attended_date' => now()
                ]);
        });

        return redirect()
            ->route('reportes.asignados')
            ->with('success', 'El reporte fue marcado como atendido.');
    }
}
