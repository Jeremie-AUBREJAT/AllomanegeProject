<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSuper_adminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est authentifié
        if (Auth::check()) {
            // Vérifie si l'utilisateur a le rôle "admin" ou " Super_admin
           
                if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Super_admin') {
                    // Passe la demande au prochain middleware si l'utilisateur a le rôle requis
                    return $next($request);
            } else {
                // Redirige l'utilisateur non autorisé avec un message d'erreur
                return redirect('/')->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
            }
        } else {
            // Redirige l'utilisateur non authentifié vers la page de connexion
            return redirect('/login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }
    }
}