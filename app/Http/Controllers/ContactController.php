<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use App\Mail\ContactMessage;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Store a new contact message
     */
    public function store(Request $request)
    {
        // Rate limiting - max 3 mesaje pe oră per IP
        $key = 'contact-form:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return response()->json([
                'success' => false,
                'message' => 'Prea multe încercări. Vă rugăm să încercați din nou mai târziu.'
            ], 429);
        }

        // Validare
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ], [
            'first_name.required' => 'Prenumele este obligatoriu.',
            'first_name.max' => 'Prenumele nu poate depăși 100 de caractere.',
            'last_name.required' => 'Numele de familie este obligatoriu.',
            'last_name.max' => 'Numele de familie nu poate depăși 100 de caractere.',
            'email.required' => 'Adresa de email este obligatorie.',
            'email.email' => 'Adresa de email nu este validă.',
            'email.max' => 'Adresa de email nu poate depăși 255 de caractere.',
            'phone.max' => 'Numărul de telefon nu poate depăși 20 de caractere.',
            'subject.required' => 'Subiectul este obligatoriu.',
            'subject.max' => 'Subiectul nu poate depăși 200 de caractere.',
            'message.required' => 'Mesajul este obligatoriu.',
            'message.max' => 'Mesajul nu poate depăși 2000 de caractere.',
        ]);

        try {
            // Incrementează rate limiter
            RateLimiter::hit($key, 3600); // 1 oră

            // Salvează în baza de date
            $contact = Contact::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'status' => Contact::STATUS_NEW,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Trimite email-ul
            Mail::to(config('mail.contact.to', config('mail.from.address')))
                ->send(new ContactMessage($validated));

            // Log pentru debugging
            Log::info('Contact form submitted', [
                'contact_id' => $contact->id,
                'name' => $contact->full_name,
                'email' => $contact->email,
                'subject' => $contact->subject,
                'ip' => $request->ip()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Mesajul a fost trimis cu succes! Vă vom contacta în curând.'
            ]);

        } catch (\Exception $e) {
            // Log eroarea
            Log::error('Contact form error', [
                'error' => $e->getMessage(),
                'email' => $validated['email'] ?? 'unknown',
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'A apărut o eroare la trimiterea mesajului. Vă rugăm să încercați din nou.'
            ], 500);
        }
    }
}
