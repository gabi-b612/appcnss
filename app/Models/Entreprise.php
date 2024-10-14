<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Entreprise extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'denomination',
        'adresse',
        'telephone',
        'email',
        'forme_juridique',
        'password'
    ];

    // Une entreprise doit avoir une seul affiliations
    public function affiliations(): HasOne
    {
        return $this->hasOne(Affiliation::class);
    }

    // Une entreprise peut avoir plusieurs travailleurs
    public function travailleurs(): HasMany
    {
        return $this->hasMany(Travailleur::class);
    }
}
