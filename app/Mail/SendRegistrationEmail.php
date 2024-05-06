<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class SendRegistrationEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     */
    public $userName;
    public $userId;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->userName = $user->name;
        $this->userId = $user->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // // Ajoutez des instructions dump pour le débogage
        // dump($this->userName); // Vérifiez le nom de l'utilisateur
        // dump($this->userId); // Vérifiez l'identifiant de l'utilisateur

        // // Vérifiez les valeurs des adresses e-mail de l'expéditeur et du destinataire
        // dump(config('mail.from.address'));
        // dump(config('mail.from.name'));

        // Retournez la vue du courrier électronique
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Sujet de l\'email')
                    ->view('mail.admindemand');
    }
    
}
