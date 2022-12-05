<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class ResolvedTicket extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket, $filename)
    {
        $this->ticket = $ticket;
        $this->filename = $filename;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Resolved Ticket',
            from: new Address('rick.noreply@gmail.com', 'RICK Ticketing'),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.updates.resolved',
            with: [
                'Number' => $this->ticket->id,
                'FName' => $this->ticket->student->FName,
                'LName' => $this->ticket->student->LName,
                'Reason' => $this->ticket->response,
                'Assignee' => $this->ticket->user->email,
                'AssigneeFName' => $this->ticket->user->firstName,
                'AssigneeLName' => $this->ticket->user->lastName,
                'Ticket_id' => $this->ticket->id,
                'Student_id' => $this->ticket->student->id
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            Attachment::fromStorageDisk('s3', 'avatars/' . $this->filename)
        ];
    }
}
