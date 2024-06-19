<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Models\User;
use App\Models\Carousel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserDeleteReservationMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Contrôleur pour la gestion des réservations dans le calendrier.
 */
class CalendarController extends Controller
{
    /**
     * Affiche les réservations de l'utilisateur connecté.
     *
     * Cette méthode récupère les réservations associées à l'utilisateur connecté
     * et les affiche avec les détails des carrousels réservés.
     *
     * @return \Illuminate\Contracts\View\View Vue contenant les réservations de l'utilisateur
     */
    public function viewUserReservationsFront()
    {
        // Vérifie si l'utilisateur est authentifié
        if (Auth::check()) {
            // Récupère l'ID de l'utilisateur connecté
            $userId = Auth::id();

            // Récupère les réservations de l'utilisateur connecté avec les carrousels associés
            $reservations = Calendar::where('user_id', $userId)
                ->with('carousel') // Charger la relation avec les carrousels
                ->orderByDesc('id')
                ->get();

            // Retourne la vue avec les réservations
            return view('reservationstest', ['reservations' => $reservations]);
        } else {
            // Si l'utilisateur n'est pas authentifié, redirigez-le avec un message d'erreur
            return redirect()->route('register')->with('error', 'Connectez-vous ou créez un compte');
        }
    }
    /**
     * Affiche toutes les réservations et tous les carrousels.
     *
     * Cette méthode récupère toutes les réservations et tous les carrousels
     * et les affiche si l'utilisateur est un super administrateur.
     *
     * @return \Illuminate\Contracts\View\View Vue contenant les réservations et les carrousels
     */
    public function viewAll()
    {
        // Vérifie si l'utilisateur est authentifié et s'il est un super administrateur
        if (Auth::check() && Auth::user()->role === 'Super_admin') {
            // Récupère toutes les réservations et tous les carrousels
            $reservations = Calendar::orderBy('id', 'desc')->get();
            $carousels = Carousel::all();

            // Retourne la vue avec les réservations et les carrousels
            return view('calendar.all_reservations', ['reservations' => $reservations, 'carousels' => $carousels]);
        } else {
            // Si l'utilisateur n'est pas un super administrateur ou n'est pas authentifié, redirigez-le avec un message d'erreur
            return redirect()->route('home')->with('error', 'Accès non autorisé.');
        }
    }
    /**
     * Crée une nouvelle réservation pour un carrousel spécifié.
     *
     * Cette méthode permet à un super administrateur de créer une nouvelle réservation
     * pour un carrousel spécifié à partir des données fournies dans la requête HTTP.
     *
     * @param  Request  $request La requête HTTP contenant les données du formulaire.
     * @return \Illuminate\Http\RedirectResponse Redirection vers une page de confirmation.
     */
    public function create(Request $request)
    {
        // Vérifie si l'utilisateur est authentifié et s'il est un super administrateur
        if (Auth::check() && Auth::user()->role === 'Super_admin') {
            // Vérifie si le carousel avec l'ID fourni existe
            $carousel = Carousel::find($request->input('carousel_id'));

            // Si le carousel n'existe pas, redirigez avec un message d'erreur
            if (!$carousel) {
                return redirect()->route('home')->with('error', 'Carousel non trouvé.');
            }

            // Créez une nouvelle instance de réservation avec les données du formulaire
            $reservation = new Calendar([
                'debut_date' => $request->input('debut_date'),
                'fin_date' => $request->input('fin_date'),
                'carousel_id' => $carousel->id,
                'user_id' => Auth::id(), // Utilise l'ID de l'utilisateur authentifié
                'status' => 'pending' // Définissez le statut initial de la réservation
            ]);

            // Enregistrez la nouvelle réservation
            $reservation->save();

            // Redirigez l'utilisateur vers une page de confirmation ou toute autre vue appropriée
            return redirect()->route('confirmation')->with('success', 'Réservation créée avec succès.');
        } else {
            // Si l'utilisateur n'est pas un super administrateur ou n'est pas authentifié, redirigez-le avec un message d'erreur
            return redirect()->route('home')->with('error', 'Accès non autorisé.');
        }
    }
    //affichage des reservations par Id carousel
    /**
     * Affiche toutes les réservations associées à un carrousel spécifié.
     *
     * Cette méthode permet à un administrateur ou à un super administrateur d'afficher
     * toutes les réservations associées à un carrousel spécifié par son ID.
     *
     * @param  int  $carouselId L'ID du carrousel pour lequel afficher les réservations.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View Redirection ou vue des réservations.
     */
    public function reservationsForCarousel($carouselId)
    {
        // Vérifie si l'utilisateur est authentifié et s'il est un super administrateur
        if (Auth::check() && Auth::user()->role === 'Super_admin' || 'Admin') {
            // Récupère le carrousel correspondant à l'ID spécifié
            $carousel = Carousel::findOrFail($carouselId);
            // Récupère toutes les réservations associées à l'ID du carrousel spécifié
            $reservations = Calendar::where('carousel_id', $carouselId)->get();

            // Retourne la vue avec les réservations
            return view('calendar.carousel_reservations', ['reservations' => $reservations, 'carousel' => $carousel]);
        } else {
            // Si l'utilisateur n'est pas un super administrateur ou n'est pas authentifié, redirigez-le avec un message d'erreur
            return redirect()->route('home')->with('error', 'Accès non autorisé.');
        }
    }
    //afficher le formulaire update
    /**
     * Affiche le formulaire de modification d'une réservation spécifique.
     *
     * Cette méthode permet à un super administrateur d'afficher le formulaire
     * pour modifier une réservation spécifique identifiée par son ID.
     *
     * @param  int  $reservationId L'ID de la réservation à modifier.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View Redirection ou vue du formulaire de modification.
     */
    public function showReservationEditForm($reservationId)
    {
        // Vérifie si l'utilisateur est authentifié et s'il est un super administrateur
        if (Auth::check() && Auth::user()->role === 'Super_admin') {
            // Récupère la réservation spécifique à modifier
            $reservation = Calendar::findOrFail($reservationId);

            // Récupère l'ID du carrousel associé à la réservation
            $carouselId = $reservation->carousel_id;
            Session::put('previous_url', url()->previous());
            // Récupère le carrousel associé à la réservation
            $carousel = Carousel::findOrFail($carouselId);

            // Retourne la vue avec la réservation à modifier et le carrousel associé
            return view('calendar.update_carousel_reservation', ['reservation' => $reservation, 'carousel' => $carousel]);
        } else {
            // Si l'utilisateur n'est pas un super administrateur ou n'est pas authentifié, redirigez-le avec un message d'erreur
            return redirect()->route('home')->with('error', 'Accès non autorisé.');
        }
    }
    /**
     * Met à jour une réservation spécifique.
     *
     * Cette méthode permet à un super administrateur de mettre à jour une réservation spécifique
     * identifiée par son ID avec les nouvelles valeurs fournies dans la requête.
     *
     * @param  Request  $request     La requête HTTP contenant les nouvelles données de la réservation.
     * @param  int      $id          L'ID de la réservation à mettre à jour.
     * @return \Illuminate\Http\RedirectResponse Redirection vers une page de confirmation ou une autre vue.
     */
    public function updateReservation(Request $request, $id)
    {
        // Vérifie si l'utilisateur est authentifié et s'il est un super administrateur
        if (Auth::check() && Auth::user()->role === 'Super_admin') {
            // Recherche la réservation par son ID
            $reservation = Calendar::findOrFail($id);
            $carousel = $reservation->carousel;
            // Met à jour les champs de la réservation avec les nouvelles valeurs fournies dans la requête
            $reservation->update([
                'debut_date' => $request->input('debut_date'),
                'fin_date' => $request->input('fin_date'),
                'status' => $request->input('status')
            ]);

            // Redirige l'utilisateur vers une page de confirmation ou une autre vue
            $carousel = $reservation->carousel;
            $previousUrl = Session::get('previous_url');
            // return redirect('/carousel/' . $carousel->id . '/reservations');
            return redirect($previousUrl ?? '/dashboard_SA/allreservations');
        } else {
            // Si l'utilisateur n'est pas un super administrateur ou n'est pas authentifié, redirigez-le avec un message d'erreur
            return redirect()->route('home')->with('error', 'Accès non autorisé.');
        }
    }
    /**
     * Supprime une réservation spécifique.
     *
     * Cette méthode permet à un super administrateur de supprimer une réservation spécifique
     * identifiée par son ID. Elle envoie également un email de notification à l'utilisateur concerné.
     *
     * @param  int  $id L'ID de la réservation à supprimer.
     * @return \Illuminate\Contracts\View\View Vue de confirmation avec les réservations mises à jour.
     */

    public function deleteReservation($id)
    {
        // Vérifie si l'utilisateur est authentifié et s'il est un super administrateur
        if (Auth::check() && Auth::user()->role === 'Super_admin') {
            // Recherche la réservation par son ID
            $reservation = Calendar::findOrFail($id);

            // Obtenir les détails de l'utilisateur et de la réservation
            $debut_date = $reservation->debut_date;
            $fin_date = $reservation->fin_date;
            $carousel_id = $reservation->carousel_id; // Assurez-vous que cela correspond à votre modèle
            $carousel_name = Carousel::find($carousel_id)->name;
            // Obtenir l'utilisateur associé à la réservation
            $user = $reservation->user;

            // Supprime la réservation
            $reservation->delete();

            // Envoyer l'email
            Mail::to($user->email)->send(new UserDeleteReservationMail($debut_date, $fin_date, $carousel_name, $user->name));

            // Récupérer les réservations et les carousels après la suppression
            $reservations = Calendar::all(); // ou la logique que vous utilisez pour récupérer les réservations
            $carousels = Carousel::all(); // ou la logique que vous utilisez pour récupérer les carousels

            // Redirige l'utilisateur vers une page de confirmation ou une autre vue
            return view('calendar.all_reservations', ['reservations' => $reservations, 'carousels' => $carousels])
                ->with('success', 'La réservation a été supprimée avec succès.');
        } else {
            // Si l'utilisateur n'est pas un super administrateur ou n'est pas authentifié, redirigez-le avec un message d'erreur
            return redirect()->route('home')->with('error', 'Accès non autorisé.');
        }
    }
}
