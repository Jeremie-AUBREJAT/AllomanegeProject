<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Carousel;
use Illuminate\Support\Facades\View;

class PendingCountMiddleware
{
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
