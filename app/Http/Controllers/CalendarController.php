<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Models\User;
use App\Models\Carousel;
use Illuminate\Support\Facades\Session; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function viewAll()
{
    // Vérifie si l'utilisateur est authentifié et s'il est un super administrateur
    if (Auth::check() && Auth::user()->role === 'Super_admin') {
        // Récupère toutes les réservations et tous les carrousels
        $reservations = Calendar::all();
        $carousels = Carousel::all();

        // Retourne la vue avec les réservations et les carrousels
        return view('calendar.all_reservations', ['reservations' => $reservations, 'carousels' => $carousels]);
    } else {
        // Si l'utilisateur n'est pas un super administrateur ou n'est pas authentifié, redirigez-le avec un message d'erreur
        return redirect()->route('home')->with('error', 'Accès non autorisé.');
    }
}
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
    public function deleteReservation($id)
    {
        // Vérifie si l'utilisateur est authentifié et s'il est un super administrateur
        if (Auth::check() && Auth::user()->role === 'Super_admin') {
            // Recherche la réservation par son ID
            $reservation = Calendar::findOrFail($id);

            // Supprime la réservation
            $reservation->delete();

            // Redirige l'utilisateur vers une page de confirmation ou une autre vue
            return redirect()->route('calendar.index')->with('success', 'La réservation a été supprimée avec succès.');
        } else {
            // Si l'utilisateur n'est pas un super administrateur ou n'est pas authentifié, redirigez-le avec un message d'erreur
            return redirect()->route('home')->with('error', 'Accès non autorisé.');
        }
    }
}
