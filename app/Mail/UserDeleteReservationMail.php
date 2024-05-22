<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use DateTime;
class UserDeleteReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $debut_date;
    public $fin_date;
    public $carousel_name;
    public $user_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($debut_date, $fin_date, $carousel_name, $user_name)
    {
        $debutDate = new DateTime($debut_date);
        $finDate = new DateTime($fin_date);
        $this->debut_date = $debutDate->format('d/m/Y');
        $this->fin_date = $finDate->format('d/m/Y');
        $this->carousel_name = $carousel_name;
        $this->user_name = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $imagePath = public_path('images/logo.jpg');
        return $this->view('Mail.user_deletereservation')
                    ->subject('Suppression de votre réservation')
                    ->with([
                        'userName' => $this->user_name,
                        'carouselName' => $this->carousel_name,
                        'debut_date' => $this->debut_date,
                        'fin_date' => $this->fin_date,
                    ])
                    ->attach($imagePath, [
                        'as' => 'logo.jpg',
                        'mime' => 'image/jpeg',
                    ])
                    ->withSwiftMessage(function ($message) use ($imagePath) {
                        $message->embed($imagePath, 'logo_cid');
                    });
    }
    
}

