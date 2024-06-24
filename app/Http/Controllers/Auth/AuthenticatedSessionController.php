<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Vérifier si l'utilisateur est connecté et si son e-mail est vérifié
        if (Auth::check() && Auth::user()->email_verified_at === null) {
            // Déconnecter l'utilisateur
            Auth::logout();
    
            // Rediriger en arrière avec un message d'erreur
            return back()->with('error', 'Veuillez vérifier votre adresse e-mail avant de vous connecter.');
        }
    
        // Régénérer la session après la connexion
        $request->session()->regenerate();
    
        // Redirection après connexion réussie
        return redirect('/');
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
