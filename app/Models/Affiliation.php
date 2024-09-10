<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Affiliation extends Model
{
    use HasFactory;

    protected $fillable = [
        'entreprise_id',
        'numero_affiliation',
        'document_rccm',
        'abreviation',
        'etat'
    ];

    // Une affiliation appartient à une entreprise
    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class);
    }
}
