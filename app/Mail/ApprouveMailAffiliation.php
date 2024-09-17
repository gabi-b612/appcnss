<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprouveMailAffiliation extends Mailable
{
    use Queueable, SerializesModels;
    public $password;
    public $entreprise;

    /**
     * Create a new message instance.
     */
    public function __construct($entreprise, $password)
    {
        $this->entreprise = $entreprise;
        $this->password = $password;
    }

    public function build(): ApprouveMailAffiliation
    {
        return $this->view('admin.emails.affiliations.approuve')
            ->subject('Affiliation approuvée')
            ->with([
                'denomination' => $this->entreprise->denomination,
                'password' => $this->password,
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Approuve Mail Affiliation',
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
