<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = ['matricule', 'nom', 'prenom', 'date_naissance', 'email', 'filiere_id', 'user_id'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function getTauxAbsence($matiere_id = null)
    {
        $query = $this->absences();
        
        if ($matiere_id) {
            $query->where('matiere_id', $matiere_id);
        }

        $totalAbsences = $query->count();
        $totalSeances = 40; // À ajuster selon le nombre de séances réel
        
        if ($totalSeances == 0) return 0;
        
        return round(($totalAbsences / $totalSeances) * 100, 2);
    }

    public function getMoyenneMatiere($matiere_id, $annee_academique)
    {
        $notes = $this->notes()
            ->where('matiere_id', $matiere_id)
            ->where('annee_academique', $annee_academique)
            ->get();

        if ($notes->isEmpty()) {
            return null;
        }

        $noteNormale = $notes->where('session', 'normale')->first();
        $noteRattrapage = $notes->where('session', 'rattrapage')->first();

        if ($noteRattrapage) {
            return max($noteNormale ? $noteNormale->note : 0, $noteRattrapage->note);
        }

        return $noteNormale ? $noteNormale->note : null;
    }

    public function getMoyenneGenerale($annee_academique)
    {
        $matieres = $this->filiere->matieres;
        
        if ($matieres->isEmpty()) {
            return null;
        }

        $totalNotes = 0;
        $totalCoefficients = 0;

        foreach ($matieres as $matiere) {
            $moyenne = $this->getMoyenneMatiere($matiere->id, $annee_academique);
            
            if ($moyenne !== null) {
                $totalNotes += $moyenne * $matiere->coefficient;
                $totalCoefficients += $matiere->coefficient;
            }
        }

        if ($totalCoefficients == 0) {
            return null;
        }

        return round($totalNotes / $totalCoefficients, 2);
    }

    public function getMention($annee_academique)
    {
        $moyenne = $this->getMoyenneGenerale($annee_academique);

        if ($moyenne === null) {
            return 'Non évalué';
        }

        if ($moyenne >= 16) return 'Très Bien';
        if ($moyenne >= 14) return 'Bien';
        if ($moyenne >= 12) return 'Assez Bien';
        if ($moyenne >= 10) return 'Passable';
        
        return 'Ajourné';
    }

    public function getDecision($annee_academique)
    {
        $moyenne = $this->getMoyenneGenerale($annee_academique);

        if ($moyenne === null) {
            return 'En attente';
        }

        return $moyenne >= 10 ? 'Admis' : 'Redouble';
    }
}
