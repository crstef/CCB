<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReply extends Mailable
{
    use Queueable, SerializesModels;

    public Contact $contact;
    public string $replyMessage;
    public string $replySubject;

    /**
     * Create a new message instance.
     */
    public function __construct(Contact $contact, string $replyMessage, string $replySubject = null)
    {
        $this->contact = $contact;
        $this->replyMessage = $replyMessage;
        $this->replySubject = $replySubject ?? 'Re: ' . $this->contact->subject;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->to($this->contact->email, $this->contact->full_name)
                    ->subject($this->replySubject)
                    ->view('emails.contact-reply')
                    ->with([
                        'contact' => $this->contact,
                        'replyMessage' => $this->replyMessage,
                        'originalMessage' => $this->contact->message,
                    ]);
    }
}