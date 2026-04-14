<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthorityController extends Controller
{
    public function perfil()
    {
        $usuario = Auth::user();
        $user = User::with(['person', 'authorityRequest'])->find($usuario->id_user);

        $perfil = (object) [
            'id_user'          => $user->id_user,
            'username'         => $user->username,
            'password'         => $user->password,
            'status'           => $user->status,
            'first_name'       => $user->person->first_name ?? '',
            'last_name'        => $user->person->last_name ?? '',
            'middle_name'      => $user->person->middle_name ?? '',
            'email'            => $user->person->email ?? '',
            'phone'            => $user->person->phone ?? '',
            'company_name'     => $user->authorityRequest->company_name ?? 'N/A',
            'employee_key'     => $user->authorityRequest->employee_key ?? 'N/A',
            'company_location' => $user->authorityRequest->company_location ?? 'N/A',
            'company_key'      => $user->authorityRequest->company_key ?? 'N/A',
        ];

        return view('autoridades.perfil_autoridad', compact('perfil'));
    }
}