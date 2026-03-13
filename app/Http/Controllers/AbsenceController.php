<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\Etudiant;
use App\Models\Matiere;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::with(['etudiant', 'matiere', 'enseignant'])
            ->orderBy('date', 'desc')
            ->get();
        
        return view('absences.index', compact('absences'));
    }

    public function create()
    {
        $etudiants = Etudiant::all();
        $matieres = Matiere::all();
        
        return view('absences.create', compact('etudiants', 'matieres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'matiere_id' => 'required|exists:matieres,id',
            'date' => 'required|date',
            'type' => 'required|in:cours,td,tp',
        ]);

        $data = $request->all();
        
        // Ajouter l'enseignant connecté si c'est un enseignant
        if (auth()->user()->isEnseignant() && auth()->user()->enseignant) {
            $data['enseignant_id'] = auth()->user()->enseignant->id;
        }

        Absence::create($data);
        
        return redirect('/absences')->with('success', 'Absence enregistrée avec succès !');
    }

    public function show(string $id)
    {
        $absence = Absence::with(['etudiant', 'matiere', 'enseignant'])->findOrFail($id);
        return view('absences.show', compact('absence'));
    }

    public function edit(string $id)
    {
        $absence = Absence::findOrFail($id);
        $etudiants = Etudiant::all();
        $matieres = Matiere::all();
        
        return view('absences.edit', compact('absence', 'etudiants', 'matieres'));
    }

    public function update(Request $request, string $id)
    {
        $absence = Absence::findOrFail($id);
        
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'matiere_id' => 'required|exists:matieres,id',
            'date' => 'required|date',
            'type' => 'required|in:cours,td,tp',
        ]);

        $absence->update($request->all());
        
        return redirect('/absences')->with('success', 'Absence modifiée avec succès !');
    }

    public function destroy(string $id)
    {
        $absence = Absence::findOrFail($id);
        $absence->delete();
        
        return redirect('/absences')->with('success', 'Absence supprimée avec succès !');
    }

    // Vue pour l'étudiant connecté
    public function mesAbsences()
    {
        $user = auth()->user();
        
        if (!$user->etudiant) {
            return redirect('/dashboard/etudiant')->with('error', 'Profil étudiant non lié.');
        }

        $absences = Absence::with(['matiere', 'enseignant'])
            ->where('etudiant_id', $user->etudiant->id)
            ->orderBy('date', 'desc')
            ->get();

        $tauxAbsence = $user->etudiant->getTauxAbsence();
        
        $absencesParMatiere = $absences->groupBy('matiere_id')->map(function($group) {
            return [
                'matiere' => $group->first()->matiere,
                'total' => $group->count(),
                'justifiees' => $group->where('justifie', true)->count(),
                'non_justifiees' => $group->where('justifie', false)->count(),
            ];
        });

        return view('absences.mes-absences', compact('absences', 'tauxAbsence', 'absencesParMatiere'));
    }
}
