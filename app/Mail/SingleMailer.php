<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // Add this
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SingleMailer extends Mailable implements ShouldQueue // Implement ShouldQueue
{
    use Queueable, SerializesModels;

    public $details;
    public $subject;
    public $fromEmail;
    public $fromName;
    public $signature;

    /**
     * Create a new message instance.
     *
     * @param array $details
     * @param string $subject
     * @param string|null $fromEmail
     * @param string|null $fromName
     * @param string|null $signature
     */
    public function __construct($details, $subject, $fromEmail = null, $fromName = 'Default Sender Name', $signature)
    {
        $this->details = $details;
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
            ->view('welcome') // Specify the view
            ->with([
                'details' => $this->details,
                'signature' => $this->signature,
            ]);
    }
}
