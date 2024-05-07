<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth; // Importez la classe d'authentification
use App\Models\Calendar; // Importez le modèle Calendar
use Illuminate\Http\Request;

class ReserveCalendar extends Component
{
    public $debut_date;
    public $fin_date;
    public $carousel_id;
    public $reservationEnregistree = false;
    public $erreurReservation = '';



    public function render(Request $request)
    {
        // Récupérez l'ID du carrousel à partir de la route
        $this->carousel_id = $request->route('id');

        return view('livewire.reserve-calendar');
    }

    public function submitReservation()
    {
        // Validez les données du formulaire si nécessaire
        $this->validate([
            'debut_date' => 'required|date',
            'fin_date' => 'required|date|after_or_equal:debut_date',
            // autres règles de validation...
        ]);
        // Vérifiez s'il existe déjà une réservation pour les dates sélectionnées
        $existingReservation = Calendar::where('debut_date', '<=', $this->fin_date)
            ->where('fin_date', '>=', $this->debut_date)
            ->first();

        if ($existingReservation) {
            // Une réservation existe déjà pour ces dates
            // Vous pouvez ajouter un message d'erreur approprié ici
            // Par exemple : return redirect()->back()->withErrors(['message' => 'Ces dates sont déjà réservées.']);
            $this->erreurReservation = 'Ces dates sont déjà réservées.';
        } else {
            $this->erreurReservation = '';
            // Récupérez l'utilisateur authentifié
            $user = Auth::user();

            // Enregistrez la réservation dans la base de données
            Calendar::create([
                'debut_date' => $this->debut_date,
                'fin_date' => $this->fin_date,
                'carousel_id' => $this->carousel_id,
                'user_id' => $user->id,
            ]);

            // Réinitialisez les champs du formulaire après l'enregistrement
            $this->reservationEnregistree = true;
        }
    }
    public function mount($carouselId = null)
    {
        $this->carousel_id = $carouselId ?? request()->route('id');
    }
    public function updateDebutDate($value)
    {
        $this->debut_date = $value;
    }

    public function updateFinDate($value)
    {
        $this->fin_date = $value;
    }
}
