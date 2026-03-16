<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminAuthorityRequestController extends Controller
{
    public function index()
    {
        $solicitudes = DB::table('authority_requests as ar')
            ->join('users as u', 'ar.user_id', '=', 'u.id_user')
            ->join('persons as p', 'u.person_id', '=', 'p.id_person')
            ->select(
                'ar.id_request',
                'ar.user_id',
                'ar.company_name',
                'ar.company_key',
                'ar.employee_key',
                'ar.company_location',
                'ar.status',
                'ar.request_date',
                'p.first_name',
                'p.last_name',
                'p.middle_name',
                'p.email',
                'u.username'
            )
            ->where('ar.status', 'pending')
            ->orderBy('ar.request_date', 'desc')
            ->get();

        return view('administradores.solicitudes_recibidas', compact('solicitudes'));
    }

    public function approve($id)
    {
        DB::transaction(function () use ($id) {
            $solicitud = DB::table('authority_requests')
                ->where('id_request', $id)
                ->where('status', 'pending')
                ->first();

            if (!$solicitud) {
                return;
            }

            $rolAutoridad = DB::table('roles')
                ->whereRaw("LOWER(role_type) = 'autoridad'")
                ->first();

            if (!$rolAutoridad) {
                abort(500, 'No existe el rol autoridad en la tabla roles.');
            }

            DB::table('authority_requests')
                ->where('id_request', $id)
                ->update([
                    'status' => 'approved',
                    'response_date' => now(),
                ]);

            DB::table('users')
                ->where('id_user', $solicitud->user_id)
                ->update([
                    'role_id' => $rolAutoridad->id_role,
                    'updated_at' => now(),
                ]);
        });

        return redirect()
            ->route('admin.solicitudes')
            ->with('success', 'Solicitud aprobada correctamente.');
    }

    public function reject($id)
    {
        DB::table('authority_requests')
            ->where('id_request', $id)
            ->where('status', 'pending')
            ->update([
                'status' => 'rejected',
                'response_date' => now(),
            ]);

        return redirect()
            ->route('admin.solicitudes')
            ->with('success', 'Solicitud rechazada correctamente.');
    }
}
