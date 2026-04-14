<?php

namespace App\Http\Controllers;

use App\Models\AuthorityRequestModel;
use App\Models\User;
use App\Models\RoleModel;
use Illuminate\Support\Facades\DB;

class AdminAuthorityRequestController extends Controller
{
    public function index()
    {
        $solicitudes = AuthorityRequestModel::where('status', 'pending')
            ->with('user.person')
            ->orderBy('request_date', 'desc')
            ->get()
            ->map(function ($request) {
                $user = $request->user;
                $person = $user->person ?? null;
                return (object) [
                    'id_request'      => $request->id_request,
                    'user_id'         => $request->user_id,
                    'company_name'    => $request->company_name,
                    'company_key'     => $request->company_key,
                    'employee_key'    => $request->employee_key,
                    'company_location'=> $request->company_location,
                    'status'          => $request->status,
                    'request_date'    => $request->request_date,
                    'first_name'      => $person->first_name ?? '',
                    'last_name'       => $person->last_name ?? '',
                    'middle_name'     => $person->middle_name ?? '',
                    'email'           => $person->email ?? '',
                    'username'        => $user->username ?? '',
                ];
            });

        return view('administradores.solicitudes_recibidas', compact('solicitudes'));
    }

    public function approve($id)
    {
        DB::transaction(function () use ($id) {
            $solicitud = AuthorityRequestModel::where('id_request', $id)
                ->where('status', 'pending')
                ->first();

            if (!$solicitud) {
                return;
            }

            $rolAutoridad = RoleModel::whereRaw("LOWER(role_type) = 'autoridad'")->first();
            if (!$rolAutoridad) {
                abort(500, 'No existe el rol autoridad en la tabla roles.');
            }

            // Actualizar solicitud
            $solicitud->status = 'approved';
            $solicitud->response_date = now();
            $solicitud->save();

            // Actualizar usuario
            $user = User::find($solicitud->user_id);
            if ($user) {
                $user->role_id = $rolAutoridad->id_role;
                $user->updated_at = now();
                $user->save();
            }
        });

        return redirect()
            ->route('admin.solicitudes')
            ->with('success', 'Solicitud aprobada correctamente.');
    }

    public function reject($id)
    {
        $solicitud = AuthorityRequestModel::where('id_request', $id)
            ->where('status', 'pending')
            ->first();

        if ($solicitud) {
            $solicitud->status = 'rejected';
            $solicitud->response_date = now();
            $solicitud->save();
        }

        return redirect()
            ->route('admin.solicitudes')
            ->with('success', 'Solicitud rechazada correctamente.');
    }
}
