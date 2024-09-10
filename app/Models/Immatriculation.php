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
}
