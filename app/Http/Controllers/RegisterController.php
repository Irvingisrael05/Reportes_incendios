<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function create()
    {
        return view('Registro');
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:persons',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);

        // Crear persona
        $person = PersonModel::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        // Crear usuario
        $user = UserModel::create([
            'person_id' => $person->id_person,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => 1, // Civil por defecto
            'status' => 'active'
        ]);

        return redirect()->back()->with('success','Usuario registrado correctamente');

    }

}
