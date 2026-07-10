<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $customerName,
        public ?string $phone,
        public string $email,
        public ?string $messageSubject,
        public string $message,
    ) {}

    public function envelope(): Envelope
    {
        $subject = trim((string) $this->messageSubject);

        return new Envelope(
            subject: $subject !== ''
                ? 'Contact form: '.$subject
                : 'New contact form message',
            replyTo: [$this->email],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-form-submitted',
        );
    }
}
