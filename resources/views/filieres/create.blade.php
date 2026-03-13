@extends('layouts.app')

@section('title', 'Ajouter une Filière')

@section('content')
<div class="card">
    <h1>Ajouter une Filière</h1>
    
    <form action="/filieres" method="POST">
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
            <label>Description :</label><br>
            <textarea name="description" rows="4" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;"></textarea>
        </div>
        
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="/filieres" class="btn">Annuler</a>
    </form>
</div>
@endsection
