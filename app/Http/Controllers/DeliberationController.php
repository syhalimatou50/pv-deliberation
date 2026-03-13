<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filiere;
use App\Models\Etudiant;
use Barryvdh\DomPDF\Facade\Pdf;

class DeliberationController extends Controller
{
    public function index()
    {
        $filieres = Filiere::all();
        return view('deliberation.index', compact('filieres'));
    }

    public function show($filiere_id, Request $request)
    {
        $filiere = Filiere::with('matieres')->findOrFail($filiere_id);
        $annee_academique = $request->input('annee', date('Y'));

        $etudiants = Etudiant::where('filiere_id', $filiere_id)
            ->with(['notes' => function($query) use ($annee_academique) {
                $query->where('annee_academique', $annee_academique);
            }])
            ->get();

        $resultats = [];
        foreach ($etudiants as $etudiant) {
            $moyenneGenerale = $etudiant->getMoyenneGenerale($annee_academique);
            
            if ($moyenneGenerale !== null) {
                $resultats[] = [
                    'etudiant' => $etudiant,
                    'moyenne' => $moyenneGenerale,
                    'mention' => $etudiant->getMention($annee_academique),
                    'decision' => $etudiant->getDecision($annee_academique),
                ];
            }
        }

        usort($resultats, function($a, $b) {
            return $b['moyenne'] <=> $a['moyenne'];
        });

        foreach ($resultats as $key => $resultat) {
            $resultats[$key]['rang'] = $key + 1;
        }

        $stats = [
            'total' => count($resultats),
            'admis' => count(array_filter($resultats, fn($r) => $r['decision'] == 'Admis')),
            'redouble' => count(array_filter($resultats, fn($r) => $r['decision'] == 'Redouble')),
            'moyenne_classe' => count($resultats) > 0 ? round(array_sum(array_column($resultats, 'moyenne')) / count($resultats), 2) : 0,
            'taux_reussite' => count($resultats) > 0 ? round((count(array_filter($resultats, fn($r) => $r['decision'] == 'Admis')) / count($resultats)) * 100, 2) : 0,
        ];

        return view('deliberation.show', compact('filiere', 'resultats', 'stats', 'annee_academique'));
    }

    public function downloadPDF($filiere_id, Request $request)
    {
        $filiere = Filiere::with('matieres')->findOrFail($filiere_id);
        $annee_academique = $request->input('annee', date('Y'));

        $etudiants = Etudiant::where('filiere_id', $filiere_id)
            ->with(['notes' => function($query) use ($annee_academique) {
                $query->where('annee_academique', $annee_academique);
            }])
            ->get();

        $resultats = [];
        foreach ($etudiants as $etudiant) {
            $moyenneGenerale = $etudiant->getMoyenneGenerale($annee_academique);
            
            if ($moyenneGenerale !== null) {
                $resultats[] = [
                    'etudiant' => $etudiant,
                    'moyenne' => $moyenneGenerale,
                    'mention' => $etudiant->getMention($annee_academique),
                    'decision' => $etudiant->getDecision($annee_academique),
                ];
            }
        }

        usort($resultats, function($a, $b) {
            return $b['moyenne'] <=> $a['moyenne'];
        });

        foreach ($resultats as $key => $resultat) {
            $resultats[$key]['rang'] = $key + 1;
        }

        $stats = [
            'total' => count($resultats),
            'admis' => count(array_filter($resultats, fn($r) => $r['decision'] == 'Admis')),
            'redouble' => count(array_filter($resultats, fn($r) => $r['decision'] == 'Redouble')),
            'moyenne_classe' => count($resultats) > 0 ? round(array_sum(array_column($resultats, 'moyenne')) / count($resultats), 2) : 0,
            'taux_reussite' => count($resultats) > 0 ? round((count(array_filter($resultats, fn($r) => $r['decision'] == 'Admis')) / count($resultats)) * 100, 2) : 0,
        ];

        $pdf = Pdf::loadView('deliberation.pdf', compact('filiere', 'resultats', 'stats', 'annee_academique'));
        
        return $pdf->download('PV_Deliberation_'.$filiere->nom.'_'.$annee_academique.'.pdf');
    }
}
