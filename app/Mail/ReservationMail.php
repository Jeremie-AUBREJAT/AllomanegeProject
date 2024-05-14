<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use DateTime;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $debut_date;
    public $fin_date;
    public $carouselName;
    public $userName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($debut_date, $fin_date, $carouselName, $userName)
    {
        $debutDate = new DateTime($debut_date);
        $finDate = new DateTime($fin_date);
        // dd($debut_date, $fin_date);
        $this->debut_date = $debutDate->format('d/m/Y');
        $this->fin_date = $finDate->format('d/m/Y');
        $this->carouselName = $carouselName;
        $this->userName = $userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->debut_date, $this->fin_date);
        return $this->view('Mail.reservation')
                    ->subject('Nouvelle réservation effectuée')
                    ->with([
                        'userName' => $this->userName,
                        'carouselName' => $this->carouselName,
                        'debut_date' => $this->debut_date,
                        'fin_date' => $this->fin_date,
                    ]);
    }
}