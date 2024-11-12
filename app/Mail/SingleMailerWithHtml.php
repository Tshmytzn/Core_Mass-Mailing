<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SingleMailerWithHtml extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $subject;
    public $fromEmail;
    public $fromName;
    public function __construct($subject, $fromEmail = null, $fromName = 'Default Sender Name')
    {
        
        $this->subject = $subject;
        $this->fromEmail = $fromEmail ?? 'info@coresupporthub.com';
        $this->fromName = $fromName;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from($this->fromEmail, $this->fromName)
            ->subject($this->subject)
            ->view('MailWithHtml.Building_Software_Apps'); // Specify the view// Pass data to the view
    }
}
