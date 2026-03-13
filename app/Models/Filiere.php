<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $fillable = ['code', 'nom', 'description'];

    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }
}
