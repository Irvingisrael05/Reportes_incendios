<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Mostrar la vista de login
     */
    public function index()
    {
        return view('Login');
    }

    /**
     * Procesar login y redirigir según rol
     */
    public function login(Request $request)
    {
        // Validar campos
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Intentar autenticar
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 1 = Civil, 2 = Autoridad, 3 = Administrador
            switch ($user->role_id) {
                case 3:
                    // ADMIN
                    return redirect()->route('menu_administradores');

                case 2:
                    // AUTORIDAD
                    return redirect()->route('reportes.asignados');

                case 1:
                    // CIVIL
                    return redirect()->route('menu');

                default:
                    return redirect('/dashboard');
            }
        }

        // Credenciales incorrectas
        return back()->withErrors([
            'username' => 'Usuario o contraseña incorrectos'
        ])->onlyInput('username');
    }

    /**
     * Logout del usuario
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
