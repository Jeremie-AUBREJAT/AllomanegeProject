<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Carousel;
use Illuminate\Support\Facades\View;

/**
 * Middleware pour récupérer et partager le nombre de carousels en attente ("pending").
 */
class PendingCountMiddleware
{
    /**
     * Gère une requête entrante.
     *
     * Vérifie si l'utilisateur est connecté en tant que super administrateur.
     * Récupère le nombre de carousels en attente ("pending") et le partage avec toutes les vues.
     *
     * @param  mixed  $request La requête HTTP entrante.
     * @param  Closure  $next Le prochain middleware dans la chaîne.
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Vérifier si l'utilisateur est connecté et est un super administrateur
        if (Auth::check() && Auth::user()->role === 'Super_admin') {
            // Récupérer le nombre de carousels avec le statut "pending"
            $pendingCount = Carousel::where('status', 'pending')->count();

            // Partager le 'pendingCount' avec toutes les vues
            View::share('pendingCount', $pendingCount);
        }

        return $next($request);
    }
}
