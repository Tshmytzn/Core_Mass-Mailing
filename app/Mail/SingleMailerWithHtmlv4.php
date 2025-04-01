<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // Implement ShouldQueue
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SingleMailerWithHtmlv4 extends Mailable implements ShouldQueue // Add ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject;
    public $fromEmail;
    public $fromName;
    public $signature;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string|null $fromEmail
     * @param string|null $fromName
     * @param string|null $signature
     */
    public function __construct($subject, $fromEmail = null, $fromName = 'Default Sender Name', $signature)
    {
        $this->subject = $subject;
        $this->fromEmail = $fromEmail ?? 'info@coresupporthub.com';
        $this->fromName = $fromName;
        $this->signature = $signature;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from($this->fromEmail, $this->fromName)
            ->subject($this->subject)
            ->view('MailWithHtml.Remote_staff') // Specify your view
            ->with([
                'signature' => $this->signature // Pass data to the view
            ]);
    }
}
