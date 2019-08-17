<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $url = url('http://localhost:8000/verification/' .$token);
        // return (new MailMessage)
        //         ->greeting('Hello')
        //         ->line('Please confirm with the link or button below to activate')
        //         ->action('Click to verify your email', $url)
        //         ->line('Thank you fro using our Application');
        return $this->view('emails.mymails');

    }
}
