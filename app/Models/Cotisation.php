<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cotisation extends Model
{
    use HasFactory;
    protected $fillable = [
        'travailleur_id',
        'declaration_id', // Ajoutez cette ligne
        'montant_brut',
        'montant_cotiser',
        'periode'
    ];

    // Relation avec le travailleur
    public function travailleur(): BelongsTo
    {
        return $this->belongsTo(Travailleur::class);
    }

    // Relation avec la déclaration
    public function declaration(): BelongsTo
    {
        return $this->belongsTo(Declaration::class);
    }
}
