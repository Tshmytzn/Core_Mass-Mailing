<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WordMassMailing extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $mailFrom;
    public $mailTo;
    public $signature;
    public $mailBody;
    public $name;
    public $subject;
    public $fromName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailFrom, $fromName, $name, $subject, $mailBody, $signature)
    {
        $this->mailFrom = $mailFrom;
        $this->name = $name;
        $this->subject = $subject;
        $this->mailBody = str_replace('{$name}', $name, $mailBody);
        $this->signature = $signature;
        $this->fromName = $fromName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->mailFrom, $this->fromName)
            ->subject($this->subject)
            ->view('WordMassMailing')
            ->with([
                'name' => $this->name,
                'mailBody' => $this->mailBody,
                'signature' => $this->signature,
            ]);
    }
}
