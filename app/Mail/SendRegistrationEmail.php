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
        // Retournez la vue du courrier électronique
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Sujet de l\'email')
                    ->view('mail.admindemand');
    }
    
}
