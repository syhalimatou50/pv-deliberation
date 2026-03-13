<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = \App\Models\Note::with(['etudiant', 'matiere'])->get();
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        $etudiants = \App\Models\Etudiant::all();
        $matieres = \App\Models\Matiere::all();
        return view('notes.create', compact('etudiants', 'matieres'));
    }

    public function store(Request $request)
    {
        \App\Models\Note::create($request->all());
        return redirect('/notes');
    }

    public function show(string $id)
    {
        $note = \App\Models\Note::with(['etudiant', 'matiere'])->findOrFail($id);
        return view('notes.show', compact('note'));
    }

    public function edit(string $id)
    {
        $note = \App\Models\Note::findOrFail($id);
        $etudiants = \App\Models\Etudiant::all();
        $matieres = \App\Models\Matiere::all();
        return view('notes.edit', compact('note', 'etudiants', 'matieres'));
    }

    public function update(Request $request, string $id)
    {
        $note = \App\Models\Note::findOrFail($id);
        $note->update($request->all());
        return redirect('/notes');
    }

    public function destroy(string $id)
    {
        $note = \App\Models\Note::findOrFail($id);
        $note->delete();
        return redirect('/notes');
    }
}
