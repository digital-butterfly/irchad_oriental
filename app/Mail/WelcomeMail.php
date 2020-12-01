<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param WM $user
     */
    public function __construct($user)
    {
        $this->far=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        dd();
        return $this->subject('Bienvenue a Irchad')->markdown('emails.welcome')->with('user',$this->far);;
    }
}
