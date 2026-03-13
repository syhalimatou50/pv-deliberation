<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;

class ReleveController extends Controller
{
    public function show($etudiant_id, Request $request)
    {
        $annee_academique = $request->input('annee', date('Y'));
        
        $etudiant = Etudiant::with(['filiere.matieres', 'notes' => function($query) use ($annee_academique) {
            $query->where('annee_academique', $annee_academique);
        }])->findOrFail($etudiant_id);

        $matieres = $etudiant->filiere->matieres;
        
        $notes_detail = [];
        foreach ($matieres as $matiere) {
            $moyenne = $etudiant->getMoyenneMatiere($matiere->id, $annee_academique);
            $notes_detail[] = [
                'matiere' => $matiere,
                'moyenne' => $moyenne,
            ];
        }

        $moyenne_generale = $etudiant->getMoyenneGenerale($annee_academique);
        $mention = $etudiant->getMention($annee_academique);
        $decision = $etudiant->getDecision($annee_academique);

        return view('releve.show', compact('etudiant', 'notes_detail', 'moyenne_generale', 'mention', 'decision', 'annee_academique'));
    }
}
