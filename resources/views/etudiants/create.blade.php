@extends('layouts.app')

@section('title', 'Ajouter un Étudiant')

@section('content')
<div class="card">
    <h1>Ajouter un Étudiant</h1>
    
    <form action="/etudiants" method="POST">
        @csrf
        
        <div style="margin-bottom: 1rem;">
            <label>Matricule :</label><br>
            <input type="text" name="matricule" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Nom :</label><br>
            <input type="text" name="nom" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Prénom :</label><br>
            <input type="text" name="prenom" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Date de naissance :</label><br>
            <input type="date" name="date_naissance" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Email :</label><br>
            <input type="email" name="email" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Filière :</label><br>
            <select name="filiere_id" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="">-- Sélectionnez une filière --</option>
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere->id }}">{{ $filiere->nom }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="/etudiants" class="btn">Annuler</a>
    </form>
</div>
@endsection
