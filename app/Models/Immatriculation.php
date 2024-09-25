<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Immatriculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'travailleur_id',
        'etat',
        'numero_immatriculation'
    ];

    // Une immatriculation appartient à un travailleur
    public function travailleur(): BelongsTo
    {
        return $this->belongsTo(Travailleur::class);
    }
    // Accès à l'entreprise via le travailleur
    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class); // Remplace Empreinte par le modèle approprié
    }
//    public function entreprise()
//    {
//        return $this->travailleur->entreprise;
//    }
}
