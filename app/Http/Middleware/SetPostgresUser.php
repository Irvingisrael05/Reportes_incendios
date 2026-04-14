<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SetPostgresUser
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            // Usamos set_config en lugar de SET, y convertimos a texto
            DB::statement("SELECT set_config('app.current_user_id', ?, false)", [(string)$userId]);
        } else {
            // Reseteamos la variable (la dejamos sin valor)
            DB::statement("SELECT set_config('app.current_user_id', NULL, false)");
        }

        return $next($request);
    }
}