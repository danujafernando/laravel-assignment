<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInviation extends Mailable
{
    use Queueable, SerializesModels;

    protected $invitationUrl; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invitationUrl)
    {
        $this->invitationUrl = $invitationUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Invitation")
                    ->html($this->invitationUrl);
    }
}
