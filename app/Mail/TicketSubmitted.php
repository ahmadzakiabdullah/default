<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Ticket $ticket, public string $accessToken) {}

    public function envelope(): Envelope { return new Envelope(subject: __('ticket.mail_subject')); }
    public function content(): Content { return new Content(view: 'emails.ticket-submitted'); }
}
