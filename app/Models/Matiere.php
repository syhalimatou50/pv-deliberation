<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $fillable = ['code', 'nom', 'coefficient', 'filiere_id', 'enseignant_id'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
}
