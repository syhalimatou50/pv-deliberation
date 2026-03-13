<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salle;

class SalleController extends Controller
{
    public function index()
    {
        $salles = Salle::all();
        return view('salles.index', compact('salles'));
    }

    public function create()
    {
        return view('salles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|unique:salles,numero',
            'capacite' => 'required|integer|min:1',
            'type' => 'required|in:cours,td,tp,amphi,labo',
        ]);

        Salle::create($request->all());
        return redirect('/salles')->with('success', 'Salle ajoutée avec succès !');
    }

    public function show(string $id)
    {
        $salle = Salle::with('emploisTemps')->findOrFail($id);
        return view('salles.show', compact('salle'));
    }

    public function edit(string $id)
    {
        $salle = Salle::findOrFail($id);
        return view('salles.edit', compact('salle'));
    }

    public function update(Request $request, string $id)
    {
        $salle = Salle::findOrFail($id);
        
        $request->validate([
            'numero' => 'required|unique:salles,numero,' . $id,
            'capacite' => 'required|integer|min:1',
            'type' => 'required|in:cours,td,tp,amphi,labo',
        ]);

        $salle->update($request->all());
        return redirect('/salles')->with('success', 'Salle modifiée avec succès !');
    }

    public function destroy(string $id)
    {
        $salle = Salle::findOrFail($id);
        $salle->delete();
        return redirect('/salles')->with('success', 'Salle supprimée avec succès !');
    }
}
