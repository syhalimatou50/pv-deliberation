@extends('layouts.app')

@section('title', 'Nouvel Enseignant')

@section('content')
<div class="card">
    <h1>Nouvel Enseignant</h1>
    
    <form action="/enseignants" method="POST">
        @csrf
        
        <div style="margin-bottom: 1rem;">
            <label>Prénom *</label>
            <input type="text" name="prenom" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Nom *</label>
            <input type="text" name="nom" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Email *</label>
            <input type="email" name="email" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Téléphone</label>
            <input type="text" name="telephone" placeholder="77 123 45 67" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Spécialité</label>
            <input type="text" name="specialite" placeholder="ex: Mathématiques, Informatique..." style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="/enseignants" class="btn">Annuler</a>
    </form>
</div>
@endsection
