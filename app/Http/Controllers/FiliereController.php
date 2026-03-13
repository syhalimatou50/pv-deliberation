<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FiliereController extends Controller
{
    public function index()
    {
        $filieres = \App\Models\Filiere::all();
        return view('filieres.index', compact('filieres'));
    }

    public function create()
    {
        return view('filieres.create');
    }

    public function store(Request $request)
    {
        \App\Models\Filiere::create($request->all());
        return redirect('/filieres');
    }

    public function show(string $id)
    {
        $filiere = \App\Models\Filiere::findOrFail($id);
        return view('filieres.show', compact('filiere'));
    }

    public function edit(string $id)
    {
        $filiere = \App\Models\Filiere::findOrFail($id);
        return view('filieres.edit', compact('filiere'));
    }

    public function update(Request $request, string $id)
    {
        $filiere = \App\Models\Filiere::findOrFail($id);
        $filiere->update($request->all());
        return redirect('/filieres');
    }

    public function destroy(string $id)
    {
        $filiere = \App\Models\Filiere::findOrFail($id);
        $filiere->delete();
        return redirect('/filieres');
    }
}
