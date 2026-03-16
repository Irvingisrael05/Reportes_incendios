<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAssignmentController extends Controller
{
    public function index()
    {
        $reportes = DB::table('reports as r')
            ->join('ecosystems as e', 'r.ecosystem_id', '=', 'e.id_ecosystem')
            ->join('weather_conditions as w', 'r.weather_id', '=', 'w.id_weather')
            ->join('report_status as rs', 'r.status_id', '=', 'rs.id_status')
            ->leftJoin('evidences as ev', 'r.id_report', '=', 'ev.report_id')
            ->leftJoin('categories as c', 'ev.category_id', '=', 'c.id_category')
            ->leftJoin('assignments as a', 'r.id_report', '=', 'a.report_id')
            ->select(
                'r.id_report',
                'r.report_date',
                DB::raw("CONCAT(r.latitude, ', ', r.longitude) as location"),
                'e.description as ecosystem',
                DB::raw("COALESCE(MIN(c.description), 'Sin categoria') as category"),
                'r.description',
                DB::raw("
                    CONCAT(
                        COALESCE(CAST(w.temperature AS TEXT), 'Sin dato'), '°C / ',
                        COALESCE(CAST(w.humidity AS TEXT), 'Sin dato'), '% / ',
                        COALESCE(CAST(w.wind_speed AS TEXT), 'Sin dato'), ' kmh'
                    ) as climatografia
                ")
            )
            ->where('rs.description', 'Recibido')
            ->whereNull('a.id_assignment')
            ->groupBy(
                'r.id_report',
                'r.report_date',
                'r.latitude',
                'r.longitude',
                'e.description',
                'r.description',
                'w.temperature',
                'w.humidity',
                'w.wind_speed'
            )
            ->orderBy('r.report_date', 'desc')
            ->get();

        $autoridades = DB::table('users as u')
            ->join('persons as p', 'u.person_id', '=', 'p.id_person')
            ->join('roles as r', 'u.role_id', '=', 'r.id_role')
            ->leftJoin('authority_requests as ar', function ($join) {
                $join->on('u.id_user', '=', 'ar.user_id')
                    ->where('ar.status', '=', 'approved');
            })
            ->whereRaw("LOWER(r.role_type) = 'autoridad'")
            ->select(
                'u.id_user',
                'u.username',
                'p.first_name',
                'p.last_name',
                'p.middle_name',
                DB::raw("COALESCE(ar.company_name, 'Sin empresa') as company_name")
            )
            ->orderBy('p.first_name')
            ->get();

        $asignaciones = DB::table('assignments as a')
            ->join('reports as rep', 'a.report_id', '=', 'rep.id_report')
            ->join('users as u', 'a.authority_id', '=', 'u.id_user')
            ->join('persons as p', 'u.person_id', '=', 'p.id_person')
            ->leftJoin('authority_requests as ar', function ($join) {
                $join->on('u.id_user', '=', 'ar.user_id')
                    ->where('ar.status', '=', 'approved');
            })
            ->select(
                'a.id_assignment',
                'a.report_id',
                'a.authority_id',
                'a.assignment_date',
                DB::raw("COALESCE(ar.company_name, 'Sin empresa') as company_name"),
                'p.first_name',
                'p.last_name',
                'p.middle_name',
                'u.username'
            )
            ->orderBy('a.assignment_date', 'desc')
            ->get();

        return view('administradores.asignar_reportes', compact(
            'reportes',
            'autoridades',
            'asignaciones'
        ));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'authority_id' => 'required|integer|exists:users,id_user',
        ]);

        DB::transaction(function () use ($request, $id) {
            DB::table('assignments')->insert([
                'report_id' => $id,
                'authority_id' => $request->authority_id,
                'assignment_date' => now(),
                'attended_date' => null,
            ]);

            DB::table('reports')
                ->where('id_report', $id)
                ->where('status_id', 1)
                ->update([
                    'status_id' => 3
                ]);
        });

        return redirect()
            ->route('admin.asignaciones')
            ->with('success', 'Reporte asignado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'authority_id' => 'required|integer|exists:users,id_user',
        ]);

        DB::table('assignments')
            ->where('id_assignment', $id)
            ->update([
                'authority_id' => $request->authority_id
            ]);

        return redirect()
            ->route('admin.asignaciones')
            ->with('success', 'Asignacion reasignada correctamente.');
    }

    public function cancel($id)
    {
        DB::transaction(function () use ($id) {
            $asignacion = DB::table('assignments')
                ->where('id_assignment', $id)
                ->first();

            if ($asignacion) {
                DB::table('assignments')
                    ->where('id_assignment', $id)
                    ->delete();

                DB::table('reports')
                    ->where('id_report', $asignacion->report_id)
                    ->update([
                        'status_id' => 1
                    ]);
            }
        });

        return redirect()
            ->route('admin.asignaciones')
            ->with('success', 'Asignacion cancelada y reporte regresado a Recibido.');
    }
}
