<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AuthorityAttendedController extends Controller
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
            ->where('r.status_id', 4)
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
            ->orderBy('a.attended_date', 'desc')
            ->get();

        return view('autoridades.incendios_atendidos', compact('reports'));
    }
}
