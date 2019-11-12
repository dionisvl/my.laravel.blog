<?php

namespace App\Mail;

use App\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscribeEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $token;

    /**
     * Create a new message instance.
     *
     * @param Subscription $subs
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.verify')
                    ->with([
                        'token' => $this->token
                    ]);
    }
}
