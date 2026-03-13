<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    protected $fillable = [
        'numero',
        'batiment',
        'capacite',
        'type'
    ];

    public function emploisTemps()
    {
        return $this->hasMany(EmploiTemps::class);
    }
}
