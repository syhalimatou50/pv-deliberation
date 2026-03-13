<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatiereController extends Controller
{
    public function index()
    {
        $matieres = \App\Models\Matiere::with('filiere')->get();
        return view('matieres.index', compact('matieres'));
    }

    public function create()
    {
        $filieres = \App\Models\Filiere::all();
        return view('matieres.create', compact('filieres'));
    }

    public function store(Request $request)
    {
        \App\Models\Matiere::create($request->all());
        return redirect('/matieres');
    }

    public function show(string $id)
    {
        $matiere = \App\Models\Matiere::with('filiere')->findOrFail($id);
        return view('matieres.show', compact('matiere'));
    }

    public function edit(string $id)
    {
        $matiere = \App\Models\Matiere::findOrFail($id);
        $filieres = \App\Models\Filiere::all();
        return view('matieres.edit', compact('matiere', 'filieres'));
    }

    public function update(Request $request, string $id)
    {
        $matiere = \App\Models\Matiere::findOrFail($id);
        $matiere->update($request->all());
        return redirect('/matieres');
    }

    public function destroy(string $id)
    {
        $matiere = \App\Models\Matiere::findOrFail($id);
        $matiere->delete();
        return redirect('/matieres');
    }
}
