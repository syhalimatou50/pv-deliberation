@extends('layouts.app')

@section('title', 'Modifier Salle')

@section('content')
<div class="card">
    <h1>Modifier la Salle</h1>
    
    <form action="/salles/{{ $salle->id }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1rem;">
            <label>Numéro *</label>
            <input type="text" name="numero" value="{{ $salle->numero }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Bâtiment</label>
            <input type="text" name="batiment" value="{{ $salle->batiment }}" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Capacité *</label>
            <input type="number" name="capacite" value="{{ $salle->capacite }}" required min="1" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Type *</label>
            <select name="type" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="cours" {{ $salle->type == 'cours' ? 'selected' : '' }}>Salle de Cours</option>
                <option value="td" {{ $salle->type == 'td' ? 'selected' : '' }}>Salle de TD</option>
                <option value="tp" {{ $salle->type == 'tp' ? 'selected' : '' }}>Salle de TP</option>
                <option value="amphi" {{ $salle->type == 'amphi' ? 'selected' : '' }}>Amphithéâtre</option>
                <option value="labo" {{ $salle->type == 'labo' ? 'selected' : '' }}>Laboratoire</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="/salles" class="btn">Annuler</a>
    </form>
</div>
@endsection
