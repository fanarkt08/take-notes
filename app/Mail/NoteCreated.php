<?php

namespace App\Mail;

use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NoteCreated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Note $note) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle note créée : ' . $this->note->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.note-created',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
