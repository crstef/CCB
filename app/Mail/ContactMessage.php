<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
        Log::info('ContactMessage building', [
            'user_email' => $this->contactData['email'],
            'admin_email' => config('mail.contact.to'),
            'from_address' => config('mail.from.address'),
        ]);
        
        $mail = $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->to($this->contactData['email'])
                    ->replyTo($this->contactData['email'], $this->contactData['first_name'] . ' ' . $this->contactData['last_name'])
                    ->subject('Mesaj nou de contact: ' . $this->contactData['subject'])
                    ->view('emails.contact-message')
                    ->with('contact', $this->contactData);
        
        // Also send to admin if configured
        $adminEmail = config('mail.contact.to');
        if ($adminEmail && $adminEmail !== $this->contactData['email']) {
            Log::info('Adding admin CC: ' . $adminEmail);
            $mail->cc($adminEmail);
        }
        
        return $mail;
    }
}
