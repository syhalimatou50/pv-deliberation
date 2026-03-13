@extends('layouts.app')

@section('title', 'Modifier une Note')

@section('content')
<div class="card">
    <h1>Modifier la Note</h1>
    
    <form action="/notes/{{ $note->id }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1rem;">
            <label>Étudiant :</label><br>
            <select name="etudiant_id" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                @foreach($etudiants as $etudiant)
                    <option value="{{ $etudiant->id }}" {{ $note->etudiant_id == $etudiant->id ? 'selected' : '' }}>
                        {{ $etudiant->nom }} {{ $etudiant->prenom }} ({{ $etudiant->matricule }})
                    </option>
                @endforeach
            </select>
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Matière :</label><br>
            <select name="matiere_id" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}" {{ $note->matiere_id == $matiere->id ? 'selected' : '' }}>
                        {{ $matiere->nom }} ({{ $matiere->code }})
                    </option>
                @endforeach
            </select>
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Note :</label><br>
            <input type="number" name="note" step="0.01" min="0" max="20" value="{{ $note->note }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Session :</label><br>
            <select name="session" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="normale" {{ $note->session == 'normale' ? 'selected' : '' }}>Normale</option>
                <option value="rattrapage" {{ $note->session == 'rattrapage' ? 'selected' : '' }}>Rattrapage</option>
            </select>
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Année académique :</label><br>
            <input type="number" name="annee_academique" min="2020" max="2030" value="{{ $note->annee_academique }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
        <a href="/notes" class="btn">Annuler</a>
    </form>
</div>
@endsection
