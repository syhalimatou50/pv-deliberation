@extends('layouts.app')

@section('title', 'Ajouter une Matière')

@section('content')
<div class="card">
    <h1>Ajouter une Matière</h1>
    
    <form action="/matieres" method="POST">
        @csrf
        
        <div style="margin-bottom: 1rem;">
            <label>Code :</label><br>
            <input type="text" name="code" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Nom :</label><br>
            <input type="text" name="nom" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Coefficient :</label><br>
            <input type="number" name="coefficient" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
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
        <a href="/matieres" class="btn">Annuler</a>
    </form>
</div>
@endsection
