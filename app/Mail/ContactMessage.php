<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;

    /**
     * Create a new message instance.
     */
    public function __construct(array $contactData)
    {
        $this->contactData = $contactData;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->replyTo($this->contactData['email'], $this->contactData['first_name'] . ' ' . $this->contactData['last_name'])
                    ->subject('Mesaj nou de contact: ' . $this->contactData['subject'])
                    ->view('emails.contact-message')
                    ->with('contact', $this->contactData);
    }
}
