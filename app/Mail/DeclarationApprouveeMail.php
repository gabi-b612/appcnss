<?php

namespace App\Mail;

use App\Models\Declaration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeclarationApprouveeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $declaration;

    public function __construct(Declaration $declaration)
    {
        $this->declaration = $declaration;
    }

    public function build(): DeclarationApprouveeMail
    {
        return $this->subject('Votre déclaration a été approuvée')
            ->view('admin.emails.declaration.declaration_approuvee');
    }
}
