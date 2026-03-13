@extends('layouts.app')

@section('title', 'Modifier une Matière')

@section('content')
<div class="card">
    <h1>Modifier la Matière</h1>
    
    <form action="/matieres/{{ $matiere->id }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1rem;">
            <label>Code :</label><br>
            <input type="text" name="code" value="{{ $matiere->code }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Nom :</label><br>
            <input type="text" name="nom" value="{{ $matiere->nom }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Coefficient :</label><br>
            <input type="number" name="coefficient" value="{{ $matiere->coefficient }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label>Filière :</label><br>
            <select name="filiere_id" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere->id }}" {{ $matiere->filiere_id == $filiere->id ? 'selected' : '' }}>
                        {{ $filiere->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
        <a href="/matieres" class="btn">Annuler</a>
    </form>
</div>
@endsection
