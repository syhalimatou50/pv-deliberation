@extends('layouts.app')

@section('title', 'Nouvelle Absence')

@section('content')
<div class="card">
    <h1>Enregistrer une Absence</h1>
    
    <form action="/absences" method="POST">
        @csrf
        
        <div style="margin-bottom: 1rem;">
            <label>Étudiant *</label>
            <select name="etudiant_id" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="">-- Sélectionnez un étudiant --</option>
                @foreach($etudiants as $etudiant)
                    <option value="{{ $etudiant->id }}">{{ $etudiant->prenom }} {{ strtoupper($etudiant->nom) }} ({{ $etudiant->matricule }})</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Matière *</label>
            <select name="matiere_id" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="">-- Sélectionnez une matière --</option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}">{{ $matiere->nom }} ({{ $matiere->filiere->nom }})</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Date *</label>
            <input type="date" name="date" value="{{ date('Y-m-d') }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Type *</label>
            <select name="type" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="cours">Cours</option>
                <option value="td">TD</option>
                <option value="tp">TP</option>
            </select>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="justifie" value="1">
                Absence justifiée
            </label>
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Motif (si justifiée)</label>
            <textarea name="motif" rows="3" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;"></textarea>
        </div>
        
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="/absences" class="btn">Annuler</a>
    </form>
</div>
@endsection
