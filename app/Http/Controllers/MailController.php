<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlloManegeMail;

/**
 * Contrôleur pour la gestion de l'envoi de formulaire par email.
 */
class MailController extends Controller
{
    /**
     * Envoie le formulaire par email.
     *
     * Cette méthode valide les données du formulaire, récupère les données soumises,
     * et envoie un email à l'adresse de contact définie dans la configuration avec les détails du formulaire.
     *
     * @param  Request  $request La requête HTTP contenant les données du formulaire.
     * @return \Illuminate\Http\RedirectResponse Redirection après l'envoi de l'e-mail avec un message de succès.
     */
    public function sendForm(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Récupérer les données du formulaire
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $email = $request->input('email');
        $message = $request->input('message');

        Mail::to(env('CONTACT_EMAIL'))
      
        ->send(new AlloManegeMail($nom, $prenom, $email, $message));
        // Redirection après l'envoi de l'e-mail
        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès ! Nous vous contacterons bientôt.');
    }
}
