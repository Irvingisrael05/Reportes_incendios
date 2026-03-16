<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuthorityRequestModel;
use Illuminate\Support\Facades\Auth;
use App\Models\EcosystemModel;
use App\Models\CategoryModel;

class AuthorityRequestController extends Controller
{

    // Mostrar formulario
    public function create()
    {

        $ecosystems = EcosystemModel::all();
        $categories = CategoryModel::all();

        return view('usuarios.solicitud_autoridades', compact(
            'ecosystems',
            'categories'
        ));

    }



    // Guardar solicitud
    public function store(Request $request)
    {

        $request->validate([

            'company_name' => 'required|string|max:150',
            'company_key' => 'required|string|max:100',
            'employee_key' => 'required|string|max:100',
            'company_location' => 'required|string|max:200'

        ]);

        AuthorityRequestModel::create([

            'user_id' => Auth::user()->id_user,
            'company_name' => $request->company_name,
            'company_key' => $request->company_key,
            'employee_key' => $request->employee_key,
            'company_location' => $request->company_location

        ]);

        return redirect()->back()->with('success','Solicitud enviada correctamente.');

    }

}
