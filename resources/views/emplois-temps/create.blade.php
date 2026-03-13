@extends('layouts.app')

@section('title', 'Ajouter un Cours')

@section('content')
<div class="card">
    <h1>Ajouter un Cours à l'Emploi du Temps</h1>
    
    <form action="/emplois-temps" method="POST">
        @csrf
        
        <input type="hidden" name="filiere_id" value="{{ request('filiere') }}">
        
        <div style="margin-bottom: 1rem;">
            <label>Filière *</label>
            <select name="filiere_id" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                @foreach($filieres as $f)
                    <option value="{{ $f->id }}" {{ request('filiere') == $f->id ? 'selected' : '' }}>
                        {{ $f->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Matière *</label>
            <select name="matiere_id" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="">-- Sélectionnez --</option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}">{{ $matiere->nom }} ({{ $matiere->filiere->nom }})</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Enseignant</label>
            <select name="enseignant_id" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="">-- Aucun --</option>
                @foreach($enseignants as $enseignant)
                    <option value="{{ $enseignant->id }}">{{ $enseignant->prenom }} {{ $enseignant->nom }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Salle</label>
            <select name="salle_id" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="">-- Aucune --</option>
                @foreach($salles as $salle)
                    <option value="{{ $salle->id }}">{{ $salle->numero }} ({{ $salle->capacite }} places - {{ strtoupper($salle->type) }})</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Jour *</label>
            <select name="jour" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="lundi">Lundi</option>
                <option value="mardi">Mardi</option>
                <option value="mercredi">Mercredi</option>
                <option value="jeudi">Jeudi</option>
                <option value="vendredi">Vendredi</option>
                <option value="samedi">Samedi</option>
            </select>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
            <div>
                <label>Heure Début *</label>
                <input type="time" name="heure_debut" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            <div>
                <label>Heure Fin *</label>
                <input type="time" name="heure_fin" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
            </div>
        </div>

        <div style="margin-bottom: 1rem;">
            <label>Type *</label>
            <select name="type" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                <option value="cours">Cours</option>
                <option value="td">TD</option>
                <option value="tp">TP</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="/emplois-temps/{{ request('filiere') }}" class="btn">Annuler</a>
    </form>
</div>
@endsection
