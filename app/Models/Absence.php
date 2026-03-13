<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $fillable = [
        'etudiant_id',
        'matiere_id',
        'date',
        'type',
        'justifie',
        'motif',
        'enseignant_id'
    ];

    protected $casts = [
        'date' => 'date',
        'justifie' => 'boolean'
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
}
