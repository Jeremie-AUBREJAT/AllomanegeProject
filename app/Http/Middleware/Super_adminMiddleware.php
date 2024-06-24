<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware pour vérifier si l'utilisateur est authentifié en tant que super administrateur.
 */
class Super_adminMiddleware
{
    /**
     * Gère une requête entrante.
     *
     * Vérifie si l'utilisateur est authentifié et a le rôle "Super_admin". Si l'utilisateur
     * remplit cette condition, la requête est transmise au prochain middleware dans la chaîne.
     * Sinon, redirige l'utilisateur non autorisé vers la page d'accueil avec un message d'erreur.
     *
     * @param  Request  $request La requête HTTP entrante.
     * @param  Closure  $next    Le prochain middleware dans la chaîne.
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est authentifié
        if (Auth::check()) {
            // Vérifie si l'utilisateur a le rôle "admin"
            if (Auth::user()->role === 'Super_admin') {
                // Passe la demande au prochain middleware
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