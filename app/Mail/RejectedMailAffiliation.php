<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RejectedMailAffiliation extends Mailable
{
    use Queueable, SerializesModels;

     public $raison;
     public $entreprise;

    /**
     * Create a new message instance.
     */
    public function __construct($entreprise, $raison)
    {
        $this->entreprise = $entreprise;
        $this->raison = $raison;
    }

    public function build(): RejectedMailAffiliation
    {
        return $this->view('admin.emails.affiliations.reject')
            ->subject('Affiliation rejetée')
            ->with([
                'denomination' => $this->entreprise->denomination,
                'raison' => $this->raison,
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rejected Mail Affiliation',
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
