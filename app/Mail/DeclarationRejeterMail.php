<?php

namespace App\Mail;

use App\Models\Declaration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeclarationRejeterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $declaration;

    public function __construct(Declaration $declaration)
    {
        $this->declaration = $declaration;
    }

    public function build(): DeclarationRejeterMail
    {
        return $this->subject('Votre déclaration a été rejetée')
            ->view('admin.emails.declaration.declaration_rejetee');
    }
}
