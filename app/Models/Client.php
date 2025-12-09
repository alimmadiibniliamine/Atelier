<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'entreprise',
    ];

    // Relation avec les visites (pour plus tard)
    public function visites()
    {
        return $this->hasMany(Visite::class);
    }
}
