<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $contactName,
        public string $contactEmail,
        public string $contactSubject,
        public string $contactBody
    ) {
    }

    public function build(): static
    {
        return $this
            ->subject('Contacto Valensa: ' . $this->contactSubject)
            ->replyTo($this->contactEmail, $this->contactName)
            ->view('emails.contact');
    }
}
