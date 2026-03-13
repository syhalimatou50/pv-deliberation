<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmploiTemps;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Enseignant;
use App\Models\Salle;

class EmploiTempsController extends Controller
{
    public function index()
    {
        $filieres = Filiere::all();
        return view('emplois-temps.index', compact('filieres'));
    }

    public function show($filiere_id)
    {
        $filiere = Filiere::findOrFail($filiere_id);
        $annee = date('Y');
        
        $emplois = EmploiTemps::with(['matiere', 'enseignant', 'salle'])
            ->where('filiere_id', $filiere_id)
            ->where('annee_academique', $annee)
            ->get();

        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        $heures = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];

        return view('emplois-temps.show', compact('filiere', 'emplois', 'jours', 'heures'));
    }

    public function create()
    {
        $filieres = Filiere::all();
        $matieres = Matiere::all();
        $enseignants = Enseignant::all();
        $salles = Salle::all();
        
        return view('emplois-temps.create', compact('filieres', 'matieres', 'enseignants', 'salles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matiere_id' => 'required|exists:matieres,id',
            'filiere_id' => 'required|exists:filieres,id',
            'jour' => 'required|in:lundi,mardi,mercredi,jeudi,vendredi,samedi',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
            'type' => 'required|in:cours,td,tp',
        ]);

        $data = $request->all();
        $data['annee_academique'] = date('Y');

        // Vérifier les conflits
        $conflits = [];
        
        if ($request->salle_id) {
            if (EmploiTemps::verifierConflitSalle($request->salle_id, $request->jour, $request->heure_debut, $request->heure_fin)) {
                $conflits[] = 'La salle est déjà occupée à cet horaire.';
            }
        }

        if ($request->enseignant_id) {
            if (EmploiTemps::verifierConflitEnseignant($request->enseignant_id, $request->jour, $request->heure_debut, $request->heure_fin)) {
                $conflits[] = 'L\'enseignant a déjà un cours à cet horaire.';
            }
        }

        if (!empty($conflits)) {
            return back()->withErrors($conflits)->withInput();
        }

        EmploiTemps::create($data);
        
        return redirect('/emplois-temps/' . $request->filiere_id)->with('success', 'Cours ajouté à l\'emploi du temps !');
    }

    public function destroy($id)
    {
        $emploi = EmploiTemps::findOrFail($id);
        $filiere_id = $emploi->filiere_id;
        $emploi->delete();
        
        return redirect('/emplois-temps/' . $filiere_id)->with('success', 'Cours supprimé de l\'emploi du temps !');
    }
}
