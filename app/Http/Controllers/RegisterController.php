<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonasModel;
use App\Models\UserModel;
use App\Models\AuthorityRequestModel;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{

    public function create()
    {

        return view('Registro');

    }

    public function store(Request $request)
    {

        $request->validate([

            'first_name'=>'required',
            'last_name'=>'required',
            'username'=>'required|unique:users',
            'password'=>'required|confirmed'

        ]);

        $person = Person::create([

            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'middle_name'=>$request->middle_name,
            'phone'=>$request->phone

        ]);

        $user = User::create([

            'person_id'=>$person->id_person,
            'username'=>$request->username,
            'password'=>Hash::make($request->password),
            'role_id'=>$request->role_id,
            'status'=>'active'

        ]);

        if($request->role_id == 2){

            AuthorityRequest::create([

                'user_id'=>$user->id_user,
                'company_name'=>$request->company_name,
                'company_key'=>$request->company_key,
                'employee_key'=>$request->employee_key,
                'company_location'=>$request->company_location

            ]);

        }

        return redirect('/')->with('success','Usuario registrado correctamente');

    }

}
