<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmploiTemps extends Model
{
    protected $table = 'emplois_temps'; // ← Correction : spécifier le nom de la table au pluriel
    
    protected $fillable = [
        'matiere_id',
        'enseignant_id',
        'salle_id',
        'filiere_id',
        'jour',
        'heure_debut',
        'heure_fin',
        'type',
        'annee_academique'
    ];

    protected $casts = [
        'heure_debut' => 'datetime',
        'heure_fin' => 'datetime',
    ];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    // Vérifier les conflits de salle
    public static function verifierConflitSalle($salle_id, $jour, $heure_debut, $heure_fin, $exclude_id = null)
    {
        $query = self::where('salle_id', $salle_id)
            ->where('jour', $jour)
            ->where(function($q) use ($heure_debut, $heure_fin) {
                $q->whereBetween('heure_debut', [$heure_debut, $heure_fin])
                  ->orWhereBetween('heure_fin', [$heure_debut, $heure_fin])
                  ->orWhere(function($q2) use ($heure_debut, $heure_fin) {
                      $q2->where('heure_debut', '<=', $heure_debut)
                         ->where('heure_fin', '>=', $heure_fin);
                  });
            });

        if ($exclude_id) {
            $query->where('id', '!=', $exclude_id);
        }

        return $query->exists();
    }

    // Vérifier les conflits d'enseignant
    public static function verifierConflitEnseignant($enseignant_id, $jour, $heure_debut, $heure_fin, $exclude_id = null)
    {
        $query = self::where('enseignant_id', $enseignant_id)
            ->where('jour', $jour)
            ->where(function($q) use ($heure_debut, $heure_fin) {
                $q->whereBetween('heure_debut', [$heure_debut, $heure_fin])
                  ->orWhereBetween('heure_fin', [$heure_debut, $heure_fin])
                  ->orWhere(function($q2) use ($heure_debut, $heure_fin) {
                      $q2->where('heure_debut', '<=', $heure_debut)
                         ->where('heure_fin', '>=', $heure_fin);
                  });
            });

        if ($exclude_id) {
            $query->where('id', '!=', $exclude_id);
        }

        return $query->exists();
    }
}
