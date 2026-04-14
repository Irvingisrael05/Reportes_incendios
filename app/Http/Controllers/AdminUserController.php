<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PersonModel;
use App\Models\AssignmentModel;
use App\Models\AuthorityRequestModel;
use App\Models\EvidenceModel;
use App\Models\ReportModel;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    public function index()
    {
        // Civiles
        $civiles = User::whereHas('role', function ($q) {
                $q->whereRaw('LOWER(role_type) = ?', ['civil']);
            })
            ->with('person')
            ->get()
            ->map(function ($user) {
                $person = $user->person;
                return (object) [
                    'id_user'    => $user->id_user,
                    'username'   => $user->username,
                    'status'     => $user->status,
                    'first_name' => $person->first_name ?? '',
                    'last_name'  => $person->last_name ?? '',
                    'middle_name'=> $person->middle_name ?? '',
                    'email'      => $person->email ?? '',
                    'phone'      => $person->phone ?? '',
                ];
            })
            ->sortBy('first_name')
            ->values();

        // Autoridades
        $autoridades = User::whereHas('role', function ($q) {
                $q->whereRaw('LOWER(role_type) = ?', ['autoridad']);
            })
            ->with(['person', 'authorityRequest' => function ($q) {
                $q->where('status', 'approved');
            }])
            ->get()
            ->map(function ($user) {
                $person = $user->person;
                $ar = $user->authorityRequest;
                return (object) [
                    'id_user'          => $user->id_user,
                    'username'         => $user->username,
                    'status'           => $user->status,
                    'first_name'       => $person->first_name ?? '',
                    'last_name'        => $person->last_name ?? '',
                    'middle_name'      => $person->middle_name ?? '',
                    'email'            => $person->email ?? '',
                    'phone'            => $person->phone ?? '',
                    'company_name'     => $ar->company_name ?? 'Sin empresa',
                    'company_key'      => $ar->company_key ?? 'Sin clave',
                    'employee_key'     => $ar->employee_key ?? 'Sin clave',
                    'company_location' => $ar->company_location ?? 'Sin ubicacion',
                ];
            })
            ->sortBy('first_name')
            ->values();

        return view('administradores.usuarios_registrados', compact('civiles', 'autoridades'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.usuarios')->with('success', 'El usuario no existe o ya fue eliminado.');
        }

        DB::transaction(function () use ($user) {
            // Eliminar registros relacionados (usando modelos para auditar)
            AssignmentModel::where('authority_id', $user->id_user)->delete();
            AuthorityRequestModel::where('user_id', $user->id_user)->delete();
            EvidenceModel::where('user_id', $user->id_user)->delete();
            ReportModel::where('user_id', $user->id_user)->delete();

            // Eliminar usuario (esto activa el Trait Auditable)
            $user->delete();

            // Eliminar persona asociada
            PersonModel::where('id_person', $user->person_id)->delete();
        });

        return redirect()
            ->route('admin.usuarios')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}