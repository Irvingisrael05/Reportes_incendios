<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AuthorityController extends Controller
{
    public function perfil()
    {
        $usuario = auth()->user();

        $perfil = DB::table('users as u')
            ->join('persons as p', 'u.person_id', '=', 'p.id_person')
            ->leftJoin('authority_requests as ar', function ($join) {
                $join->on('u.id_user', '=', 'ar.user_id')
                    ->where('ar.status', '=', 'approved');
            })
            ->select(
                'u.id_user',
                'u.username',
                'u.password',
                'u.status',
                'p.first_name',
                'p.last_name',
                'p.middle_name',
                'p.email',
                'p.phone',
                DB::raw("COALESCE(ar.company_name, 'N/A') as company_name"),
                DB::raw("COALESCE(ar.employee_key, 'N/A') as employee_key"),
                DB::raw("COALESCE(ar.company_location, 'N/A') as company_location"),
                DB::raw("COALESCE(ar.company_key, 'N/A') as company_key")
            )
            ->where('u.id_user', $usuario->id_user)
            ->first();

        return view('autoridades.perfil_autoridad', compact('perfil'));
    }
}
