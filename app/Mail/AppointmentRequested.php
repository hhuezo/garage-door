<?php

namespace App\Mail;

use App\Models\AppointmentBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentRequested extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public AppointmentBooking $booking,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New appointment request',
            replyTo: [$this->booking->customer_email],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.appointment-requested',
        );
    }
}
