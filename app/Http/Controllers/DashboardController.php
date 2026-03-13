<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $stats = [
            'filieres' => \App\Models\Filiere::count(),
            'matieres' => \App\Models\Matiere::count(),
            'etudiants' => \App\Models\Etudiant::count(),
            'notes' => \App\Models\Note::count(),
            'users' => \App\Models\User::count(),
        ];
        
        return view('dashboards.admin', compact('stats'));
    }

    public function enseignant()
    {
        // Statistiques pour l'enseignant
        $stats = [
            'matieres' => \App\Models\Matiere::count(),
            'etudiants' => \App\Models\Etudiant::count(),
            'notes' => \App\Models\Note::count(),
        ];
        
        return view('dashboards.enseignant', compact('stats'));
    }

    public function etudiant()
    {
        $annee_academique = date('Y');
        $user = auth()->user();
        
        // Trouver l'étudiant lié à cet utilisateur
        $etudiant = \App\Models\Etudiant::where('user_id', $user->id)->first();
        
        if (!$etudiant) {
            // Si pas d'étudiant lié, afficher un message
            return view('dashboards.etudiant', [
                'etudiant' => null,
                'notes_detail' => [],
                'moyenne_generale' => null,
                'mention' => null,
                'decision' => null,
            ]);
        }
        
        // Récupérer les notes détaillées
        $matieres = $etudiant->filiere->matieres;
        $notes_detail = [];
        
        foreach ($matieres as $matiere) {
            $moyenne = $etudiant->getMoyenneMatiere($matiere->id, $annee_academique);
            if ($moyenne !== null) {
                $notes_detail[] = [
                    'matiere' => $matiere,
                    'moyenne' => $moyenne,
                ];
            }
        }
        
        $moyenne_generale = $etudiant->getMoyenneGenerale($annee_academique);
        $mention = $etudiant->getMention($annee_academique);
        $decision = $etudiant->getDecision($annee_academique);
        
        return view('dashboards.etudiant', compact('etudiant', 'notes_detail', 'moyenne_generale', 'mention', 'decision'));
    }
}
