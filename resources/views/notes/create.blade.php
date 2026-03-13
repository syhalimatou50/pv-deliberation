@extends('layouts.app')

@section('title', 'Ajouter une Note')

@section('content')
<div class="card">
    <h1>Ajouter une Note</h1>
    
    <form action="/notes" method="POST">
        @csrf
        
        <div style="margin-bottom: 1rem;">
            <label>Étudiant :</label><br>
            <select name="etudiant_id" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="">-- Sélectionnez un étudiant --</option>
                @foreach($etudiants as $etudiant)
                    <option value="{{ $etudiant->id }}">{{ $etudiant->nom }} {{ $etudiant->prenom }} ({{ $etudiant->matricule }})</option>
                @endforeach
            </select>
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Matière :</label><br>
            <select name="matiere_id" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="">-- Sélectionnez une matière --</option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}">{{ $matiere->nom }} ({{ $matiere->code }})</option>
                @endforeach
            </select>
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Note :</label><br>
            <input type="number" name="note" step="0.01" min="0" max="20" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Session :</label><br>
            <select name="session" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="">-- Sélectionnez --</option>
                <option value="normale">Normale</option>
                <option value="rattrapage">Rattrapage</option>
            </select>
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Année académique :</label><br>
            <input type="number" name="annee_academique" min="2020" max="2030" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;" placeholder="2024">
        </div>
        
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="/notes" class="btn">Annuler</a>
    </form>
</div>
@endsection
