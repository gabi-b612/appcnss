<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ImmatriculationStatusMail extends Mailable
{
    use Queueable, SerializesModels;
    public $entreprise;
    public $travailleur;
    public $numero_matricule;
    public $mot_de_passe;
    public $etat;
    public $motif;

    public function __construct($entreprise, $travailleur = null, $numero_matricule = null, $mot_de_passe = null, $etat, $motif = null)
    {
        $this->entreprise = $entreprise;
        $this->travailleur = $travailleur;
        $this->numero_matricule = $numero_matricule;
        $this->mot_de_passe = $mot_de_passe;
        $this->etat = $etat;
        $this->motif = $motif;
    }

    public function build(): ImmatriculationStatusMail
    {
        if ($this->etat === 'accepter') {
            return $this->subject('Immatriculation acceptée')
                ->view('admin.emails.immatriculation.approuve')
                ->with([
                    'entreprise' => $this->entreprise,
                    'travailleur' => $this->travailleur,
                    'numero_matricule' => $this->numero_matricule,
                    'mot_de_passe' => $this->mot_de_passe,
                ]);
        } else {
            return $this->subject('Immatriculation rejetée')
                ->view('admin.emails.immatriculation.rejecter')
                ->with([
                    'entreprise' => $this->entreprise,
                    'motif' => $this->motif,
                ]);
        }
    }
}
