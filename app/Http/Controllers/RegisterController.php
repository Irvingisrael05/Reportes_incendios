<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonModel;
use App\Models\User;
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
            'first_name' => ['required', 'regex:/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+$/u'],
            'last_name' => ['required', 'regex:/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+$/u'],
            'middle_name' => ['nullable', 'regex:/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+$/u'],
            'email' => 'required|email|unique:persons',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed'
        ], [
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.regex' => 'El nombre debe iniciar con mayuscula y continuar con minusculas. Ejemplo: Juan.',

            'last_name.required' => 'El apellido paterno es obligatorio.',
            'last_name.regex' => 'El apellido paterno debe iniciar con mayuscula y continuar con minusculas. Ejemplo: Garcia.',

            'middle_name.regex' => 'El apellido materno debe iniciar con mayuscula y continuar con minusculas. Ejemplo: Lopez.',

            'email.required' => 'El correo electronico es obligatorio.',
            'email.email' => 'El correo electronico no tiene un formato valido.',
            'email.unique' => 'Este correo electronico ya esta registrado.',

            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.unique' => 'Este nombre de usuario ya esta registrado.',

            'password.required' => 'La contrasena es obligatoria.',
            'password.confirmed' => 'Las contrasenas no coinciden.'
        ]);

        // Crear persona
        $person = PersonModel::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        // Crear usuario con Eloquent
        $user = User::create([
            'person_id' => $person->id_person,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => 1, // Civil por defecto
            'status' => 'active'
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado correctamente. Ahora inicia sesion.');
    }
}
