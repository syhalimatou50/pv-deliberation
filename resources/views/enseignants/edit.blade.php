@extends('layouts.app')

@section('title', 'Modifier Enseignant')

@section('content')
<div class="card">
    <h1>Modifier l'Enseignant</h1>
    
    <form action="/enseignants/{{ $enseignant->id }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1rem;">
            <label>Prénom *</label>
            <input type="text" name="prenom" value="{{ $enseignant->prenom }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Nom *</label>
            <input type="text" name="nom" value="{{ $enseignant->nom }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Email *</label>
            <input type="email" name="email" value="{{ $enseignant->email }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Téléphone</label>
            <input type="text" name="telephone" value="{{ $enseignant->telephone }}" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Spécialité</label>
            <input type="text" name="specialite" value="{{ $enseignant->specialite }}" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="/enseignants" class="btn">Annuler</a>
    </form>
</div>
@endsection
