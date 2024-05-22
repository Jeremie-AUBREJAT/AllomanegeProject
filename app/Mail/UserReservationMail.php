<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use DateTime;

class UserReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $debut_date;
    public $fin_date;
    public $carouselName;
    public $adminEmail;
    public $userName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($debut_date, $fin_date, $carouselName, $userName, $adminEmail)
    {
        $debutDate = new DateTime($debut_date);
        $finDate = new DateTime($fin_date);
        // dd($debut_date, $fin_date);
        $this->debut_date = $debutDate->format('d/m/Y');
        $this->fin_date = $finDate->format('d/m/Y');
        $this->carouselName = $carouselName;
        $this->userName = $userName;
        $this->adminEmail = $adminEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $imagePath = public_path('images/logo.jpg');
        return $this->view('Mail.user_reservation')
                    ->subject('Confirmation de votre réservation')
                    ->with([
                        'userName' => $this->userName,
                        'adminEmail' => $this->adminEmail,
                        'carouselName' => $this->carouselName,
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
