@extends('layouts.app')

@section('title', 'Modifier un Étudiant')

@section('content')
<div class="card">
    <h1>Modifier l'Étudiant</h1>
    
    <form action="/etudiants/{{ $etudiant->id }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1rem;">
            <label>Matricule :</label><br>
            <input type="text" name="matricule" value="{{ $etudiant->matricule }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Nom :</label><br>
            <input type="text" name="nom" value="{{ $etudiant->nom }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Prénom :</label><br>
            <input type="text" name="prenom" value="{{ $etudiant->prenom }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Date de naissance :</label><br>
            <input type="date" name="date_naissance" value="{{ $etudiant->date_naissance }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Email :</label><br>
            <input type="email" name="email" value="{{ $etudiant->email }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Filière :</label><br>
            <select name="filiere_id" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere->id }}" {{ $etudiant->filiere_id == $filiere->id ? 'selected' : '' }}>
                        {{ $filiere->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
        <a href="/etudiants" class="btn">Annuler</a>
    </form>
</div>
@endsection
