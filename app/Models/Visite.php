<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visite extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'personne_rencontree',
        'motif',
        'arrivee_at',
        'depart_at',
        'statut',
    ];

    protected $casts = [
        'arrivee_at' => 'datetime',
        'depart_at'  => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
