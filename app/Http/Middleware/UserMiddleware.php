<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware pour vérifier si l'utilisateur est authentifié en tant que simple utilisateur.
 */
class UserMiddleware
{
    /**
     * Gère une requête entrante.
     *
     * Vérifie si l'utilisateur est authentifié et a le rôle "user". Si l'utilisateur
     * n'a pas ce rôle, il est redirigé vers la page d'accueil avec un message d'erreur.
     * Les utilisateurs non authentifiés sont redirigés vers la page de connexion.
     *
     * @param  Request  $request La requête HTTP entrante.
     * @param  Closure  $next    Le prochain middleware dans la chaîne.
     * @return mixed
     */
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