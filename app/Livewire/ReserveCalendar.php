<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Calendar;
use Illuminate\Http\Request;

class ReserveCalendar extends Component
{
    public $debut_date;
    public $fin_date;
    public $carousel_id;
    public $reservationEnregistree = false;
    public $erreurReservation = '';

    public function mount($carouselId = null)
    {
        // Récupérez l'ID du carrousel à partir de la route ou utilisez le paramètre fourni
        $this->carousel_id = $carouselId ?? request()->route('id');
        // Appeler la méthode pour obtenir les dates réservées
        $this->getReservedDates();
    }

    public function render()
    {
        return view('livewire.reserve-calendar');
    }

    public function submitReservation()
    {
        $this->validate([
            'debut_date' => 'required|date',
            'fin_date' => 'required|date|after_or_equal:debut_date',
        ]);

        $existingReservation = Calendar::where('carousel_id', $this->carousel_id)
            ->where(function ($query) {
                $query->where('debut_date', '<=', $this->fin_date)
                      ->where('fin_date', '>=', $this->debut_date);
            })->exists();

        if ($existingReservation) {
            $this->erreurReservation = 'Ces dates sont déjà réservées.';
        } else {
            $user = Auth::user();
            Calendar::create([
                'debut_date' => $this->debut_date,
                'fin_date' => $this->fin_date,
                'carousel_id' => $this->carousel_id,
                'user_id' => $user->id,
            ]);
            $this->reservationEnregistree = true;
            $this->reset(['debut_date', 'fin_date']);
            $this->erreurReservation = '';
        }
    }

    public function getReservedDates()
    {
        $reservations = Calendar::where('carousel_id', $this->carousel_id)->get();
        
        $reservedDates = $reservations->map(function ($reservation) {
            return [
                'start' => $reservation->debut_date,
                'end' => $reservation->fin_date,
            ];
        });
       
        $this->dispatch('reservedDates', ['dates' => $reservedDates->toArray()]);
    }
}