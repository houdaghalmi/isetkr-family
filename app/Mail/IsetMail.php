<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class IsetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $replyMessage;
    public $originalMessage;

    /**
     * Create a new message instance.
     */
    public function __construct($replyMessage, $originalMessage)
    {
        $this->replyMessage = $replyMessage;
        $this->originalMessage = $originalMessage;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reply to Your Contact Message - ISETKR Family',
            from: config('mail.from.address', 'houda.ghalmi1@gmail.com'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-reply', // Changed from 'admin.messages.reply'
            with: [
                'replyMessage' => $this->replyMessage,
                'originalMessage' => $this->originalMessage,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}