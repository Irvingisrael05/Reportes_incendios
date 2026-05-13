<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    public function index()
    {
        $baseQuery = DB::table('reports as r')
            ->join('ecosystems as e', 'r.ecosystem_id', '=', 'e.id_ecosystem')
            ->join('report_status as rs', 'r.status_id', '=', 'rs.id_status')
            ->join('users as u', 'r.user_id', '=', 'u.id_user')
            ->join('persons as p', 'u.person_id', '=', 'p.id_person')
            ->leftJoin('categories as c', 'r.category_id', '=', 'c.id_category')
            ->select(
                'r.id_report',
                'r.report_date',
                DB::raw("CONCAT(r.latitude, ', ', r.longitude) as location"),
                'r.municipality',
                'r.locality',
                'e.description as ecosystem',
                DB::raw("COALESCE(c.description, 'Sin categoria') as category"),
                'r.description',
                'rs.description as estado_real',
                'u.username',
                'p.first_name',
                'p.last_name',
                'p.middle_name'
            )
            ->orderBy('r.report_date', 'desc');

        $recibidos = (clone $baseQuery)
            ->where('r.status_id', 1)
            ->get();

        $asignados = (clone $baseQuery)
            ->where('r.status_id', 2)
            ->get();

        $proceso = (clone $baseQuery)
            ->where('r.status_id', 3)
            ->get();

        $finalizados = (clone $baseQuery)
            ->where('r.status_id', 4)
            ->get();

        $autoridades = DB::table('users as u')
            ->join('persons as p', 'u.person_id', '=', 'p.id_person')
            ->join('roles as r', 'u.role_id', '=', 'r.id_role')
            ->whereRaw("LOWER(r.role_type) = 'autoridad'")
            ->select(
                'u.id_user',
                'u.username',
                'p.first_name',
                'p.last_name',
                'p.middle_name'
            )
            ->orderBy('p.first_name')
            ->get();

        return view('administradores.reportes_recibidos', compact(
            'recibidos',
            'asignados',
            'proceso',
            'finalizados',
            'autoridades'
        ));
    }

    public function asignarYMarcarEnProceso(Request $request, $id)
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
                    'status_id' => 2
                ]);
        });

        return redirect()
            ->route('menu_administradores')
            ->with('success', 'El reporte fue asignado correctamente y ahora esta en Asignados.');
    }
}
