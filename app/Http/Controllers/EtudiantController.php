<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Etudiant::with('filiere');

        // Recherche par nom, prénom ou matricule
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', '%'.$search.'%')
                  ->orWhere('prenom', 'like', '%'.$search.'%')
                  ->orWhere('matricule', 'like', '%'.$search.'%');
            });
        }

        // Filtre par filière
        if ($request->has('filiere') && $request->filiere != '') {
            $query->where('filiere_id', $request->filiere);
        }

        $etudiants = $query->get();
        
        return view('etudiants.index', compact('etudiants'));
    }

    public function create()
    {
        $filieres = \App\Models\Filiere::all();
        return view('etudiants.create', compact('filieres'));
    }

    public function store(Request $request)
    {
        \App\Models\Etudiant::create($request->all());
        return redirect('/etudiants');
    }

    public function show(string $id)
    {
        $etudiant = \App\Models\Etudiant::with('filiere')->findOrFail($id);
        return view('etudiants.show', compact('etudiant'));
    }

    public function edit(string $id)
    {
        $etudiant = \App\Models\Etudiant::findOrFail($id);
        $filieres = \App\Models\Filiere::all();
        return view('etudiants.edit', compact('etudiant', 'filieres'));
    }

    public function update(Request $request, string $id)
    {
        $etudiant = \App\Models\Etudiant::findOrFail($id);
        $etudiant->update($request->all());
        return redirect('/etudiants');
    }

    public function destroy(string $id)
    {
        $etudiant = \App\Models\Etudiant::findOrFail($id);
        $etudiant->delete();
        return redirect('/etudiants');
    }
}
