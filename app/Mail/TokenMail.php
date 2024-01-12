<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TokenMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $token
    )
    {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Token',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.token',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
