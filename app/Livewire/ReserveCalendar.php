<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Calendar;
use App\Models\Carousel;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationMail;
use App\Mail\UserReservationMail;

/**
 * Composant Livewire pour la gestion des réservations de calendrier.
 */
class ReserveCalendar extends Component
{
    public $debut_date;
    public $fin_date;
    public $carousel_id;
    public $reservationEnregistree = false;
    public $erreurReservation = '';

    /**
     * Initialise le composant avec l'ID du carrousel (optionnel).
     *
     * @param int|null $carouselId L'identifiant du carrousel.
     */
    public function mount($carouselId = null)
    {
        // Récupère l'ID du carrousel à partir de la route ou utilise le paramètre fourni
        $this->carousel_id = $carouselId ?? request()->route('id');
        // Appelle la méthode pour obtenir les dates réservées
        $this->getReservedDates();
    }

    /**
     * Affiche le composant Livewire.
     *
     * @return \Illuminate\Contracts\View\View La vue Livewire pour la gestion des réservations de calendrier.
     */
    public function render()
    {
        return view('livewire.reserve-calendar');
    }

    /**
     * Soumet une nouvelle réservation pour le carrousel spécifié.
     */
    public function submitReservation()
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            // Si l'utilisateur n'est pas connecté, affiche un message d'erreur
            $this->erreurReservation = "Veuillez vous connecter pour effectuer une réservation ou nous envoyer un e-mail.";
            return;
        }

        // Validation des données de réservation
        $this->validate([
            'debut_date' => 'required|date',
            'fin_date' => 'required|date|after_or_equal:debut_date',
        ]);

        // Vérification de l'existence de réservations existantes pour ces dates
        $existingReservation = Calendar::where('carousel_id', $this->carousel_id)
            ->where(function ($query) {
                $query->where('debut_date', '<=', $this->fin_date)
                      ->where('fin_date', '>=', $this->debut_date);
            })->exists();

        if ($existingReservation) {
            $this->erreurReservation = 'Ces dates sont déjà réservées.';
        } else {
            $user = Auth::user();
            $carousel = Carousel::find($this->carousel_id);

            // Création d'une nouvelle réservation
            Calendar::create([
                'debut_date' => $this->debut_date,
                'fin_date' => $this->fin_date,
                'carousel_id' => $this->carousel_id,
                'user_id' => $user->id,
                'status' => 'pending',  // Statut de réservation en attente
            ]);

            // Envoi des emails de confirmation de réservation
            Mail::to(env('CONTACT_EMAIL'))->send(new ReservationMail($this->debut_date, $this->fin_date, $carousel->name, $user->name));
            Mail::to($user->email)->send(new UserReservationMail($this->debut_date, $this->fin_date, $carousel->name, $user->name, $user->email));

            // Indication que la réservation a été enregistrée avec succès
            $this->reservationEnregistree = true;
            $this->reset(['debut_date', 'fin_date']);
            $this->erreurReservation = '';
        }
    }

    /**
     * Récupère les dates réservées pour le carrousel spécifié.
     */
    public function getReservedDates()
    {
        $reservations = Calendar::where('carousel_id', $this->carousel_id)->get();
        
        // Transformation des réservations en un format adapté pour le front-end
        $reservedDates = $reservations->map(function ($reservation) {
            return [
                'start' => $reservation->debut_date,
                'end' => $reservation->fin_date,
                'status' => $reservation->status,
            ];
        });
       
        // Dispatch des dates réservées pour le front-end
        $this->dispatch('reservedDates', ['dates' => $reservedDates->toArray()]);
    }
}
