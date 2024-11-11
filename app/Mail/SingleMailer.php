<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SingleMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $subject;
    public $fromEmail; // Add a public property for dynamic "from" email.

    /**
     * Create a new message instance.
     *
     * @param array $details
     * @param string $subject
     * @param string $fromEmail (optional)
     */
    public function __construct($details, $subject, $fromEmail = null)
    {
        $this->details = $details;
        $this->subject = $subject;
        $this->fromEmail = $fromEmail; // Set the dynamic "from" email.
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
            from: $this->fromEmail ? $this->fromEmail : 'default@example.com', // Use dynamic or default "from" email.
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'welcome', // Update with the actual view path
            with: ['details' => $this->details],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
