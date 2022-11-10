<?php

namespace App\Mail;

use App\Models\Reopen;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OngoingReopenedTicket extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reopen $reopen, Ticket $ticket)
    {
        $this->reopen = $reopen;
        $this->ticket = $ticket;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Ongoing Reopened Ticket',
            from: new Address('rick.noreply@gmail.com', 'RICK Ticketing')
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
            view: 'email.updates.ongoing-reopen',
            with: [
                'Number' => $this->ticket->id,
                'FName' => $this->ticket->student->FName,
                'LName' => $this->ticket->student->LName,
                'Type' => $this->ticket->categ->type,
                'Category' => $this->ticket->categ->name,
                'Description' => $this->ticket->description,
                'Priority' => $this->ticket->priority,
                'Response' => $this->ticket->response,
                'Assignee' => $this->reopen->user->email,
                'AssigneeFName' => $this->reopen->user->firstName,
                'AssigneeLName' => $this->reopen->user->lastName,
                'Reason' => $this->reopen->reason
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
        return [];
    }
}
