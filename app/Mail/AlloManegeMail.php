<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlloManegeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nom;
    public $prenom;
    public $email;
    public $userMessage;

    /**
     * Create a new message instance.
     *
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string $userMessage
     */
    public function __construct($nom, $prenom, $email, $userMessage)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->userMessage = $userMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
        ->subject('Sujet de l\'email')
        ->view('mail.contact');
    }
}

