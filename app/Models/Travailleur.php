<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Travailleur extends Model
{
    use HasFactory;

    protected $fillable = [
        'entreprise_id',
        'matricule',
        'nom',
        'postnom',
        'prenom',
        'genre',
        'lieu_naissance',
        'date_naissance',
        'adresse',
        'telephone',
        'email',
        'date_embauche',
        'password'
    ];

    // Un travailleur appartient à une entreprise
    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class);
    }

    // Un travailleur peut avoir une immatriculation
    public function immatriculation(): HasOne
    {
        return $this->hasOne(Immatriculation::class);
    }
}
