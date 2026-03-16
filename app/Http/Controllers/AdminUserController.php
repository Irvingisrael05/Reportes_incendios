<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    public function index()
    {
        $civiles = DB::table('users as u')
            ->join('persons as p', 'u.person_id', '=', 'p.id_person')
            ->join('roles as r', 'u.role_id', '=', 'r.id_role')
            ->whereRaw("LOWER(r.role_type) = 'civil'")
            ->select(
                'u.id_user',
                'u.username',
                'u.status',
                'p.first_name',
                'p.last_name',
                'p.middle_name',
                'p.email',
                'p.phone'
            )
            ->orderBy('p.first_name')
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
                'u.status',
                'p.first_name',
                'p.last_name',
                'p.middle_name',
                'p.email',
                'p.phone',
                DB::raw("COALESCE(ar.company_name, 'Sin empresa') as company_name"),
                DB::raw("COALESCE(ar.company_key, 'Sin clave') as company_key"),
                DB::raw("COALESCE(ar.employee_key, 'Sin clave') as employee_key"),
                DB::raw("COALESCE(ar.company_location, 'Sin ubicacion') as company_location")
            )
            ->orderBy('p.first_name')
            ->get();

        return view('administradores.usuarios_registrados', compact('civiles', 'autoridades'));
    }

    public function destroy($id)
    {
        $usuario = DB::table('users')
            ->where('id_user', $id)
            ->first();

        if (!$usuario) {
            return redirect()
                ->route('admin.usuarios')
                ->with('success', 'El usuario no existe o ya fue eliminado.');
        }

        DB::transaction(function () use ($id, $usuario) {
            DB::table('assignments')->where('authority_id', $id)->delete();
            DB::table('authority_requests')->where('user_id', $id)->delete();
            DB::table('evidences')->where('user_id', $id)->delete();
            DB::table('reports')->where('user_id', $id)->delete();

            DB::table('users')->where('id_user', $id)->delete();

            DB::table('persons')->where('id_person', $usuario->person_id)->delete();
        });

        return redirect()
            ->route('admin.usuarios')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
