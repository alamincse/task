<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskAssign extends Mailable
{
    use Queueable, SerializesModels;

    protected string $title;
    protected string $description;
    protected string $deadline;

    /**
     * Create a new message instance.
     */
    public function __construct($title, $description, $deadline)
    {
        $this->title = $title;
        $this->description = $description;
        $this->deadline = $deadline;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Task Assign',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.task',
            with: [
                'title' => $this->title,
                'description' => $this->description,
                'deadline' => $this->deadline,
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
