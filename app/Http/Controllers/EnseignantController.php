<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enseignant;

class EnseignantController extends Controller
{
    public function index()
    {
        $enseignants = Enseignant::with('matieres')->get();
        return view('enseignants.index', compact('enseignants'));
    }

    public function create()
    {
        return view('enseignants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:enseignants,email',
        ]);

        Enseignant::create($request->all());
        return redirect('/enseignants')->with('success', 'Enseignant ajouté avec succès !');
    }

    public function show(string $id)
    {
        $enseignant = Enseignant::with('matieres')->findOrFail($id);
        return view('enseignants.show', compact('enseignant'));
    }

    public function edit(string $id)
    {
        $enseignant = Enseignant::findOrFail($id);
        return view('enseignants.edit', compact('enseignant'));
    }

    public function update(Request $request, string $id)
    {
        $enseignant = Enseignant::findOrFail($id);
        
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:enseignants,email,' . $id,
        ]);

        $enseignant->update($request->all());
        return redirect('/enseignants')->with('success', 'Enseignant modifié avec succès !');
    }

    public function destroy(string $id)
    {
        $enseignant = Enseignant::findOrFail($id);
        $enseignant->delete();
        return redirect('/enseignants')->with('success', 'Enseignant supprimé avec succès !');
    }
}
