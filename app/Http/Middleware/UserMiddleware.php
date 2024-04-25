<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est authentifié
        if (Auth::check()) {
            // Vérifie si l'utilisateur a le rôle "user"
            if (Auth::user()->role !== 'user') {
                // Redirige l'utilisateur non autorisé
                return redirect('/')->with('error', 'Vous n\'avez pas les autorisations nécessaires.');
            }
        } else {
            // Redirige l'utilisateur non authentifié
            return redirect('/login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }

        // Passe la demande au prochain middleware
        return $next($request);
    }
}