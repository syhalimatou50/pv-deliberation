@extends('layouts.app')

@section('title', 'Détails Absence')

@section('content')
<div class="card">
    <h1>📊 Détails de l'Absence</h1>
    
    <div style="margin: 2rem 0;">
        <p><strong>Date :</strong> {{ $absence->date->format('d/m/Y') }}</p>
        <p><strong>Étudiant :</strong> {{ $absence->etudiant->prenom }} {{ strtoupper($absence->etudiant->nom) }}</p>
        <p><strong>Matricule :</strong> {{ $absence->etudiant->matricule }}</p>
        <p><strong>Matière :</strong> {{ $absence->matiere->nom }}</p>
        <p><strong>Type :</strong> {{ strtoupper($absence->type) }}</p>
        <p><strong>Justifiée :</strong> 
            @if($absence->justifie)
                <span style="color: #28a745; font-weight: bold;">✓ Oui</span>
            @else
                <span style="color: #dc3545; font-weight: bold;">✗ Non</span>
            @endif
        </p>
        @if($absence->motif)
            <p><strong>Motif :</strong> {{ $absence->motif }}</p>
        @endif
        @if($absence->enseignant)
            <p><strong>Enregistrée par :</strong> {{ $absence->enseignant->prenom }} {{ $absence->enseignant->nom }}</p>
        @endif
        <p><strong>Créée le :</strong> {{ $absence->created_at->format('d/m/Y H:i') }}</p>
    </div>
    
    <a href="/absences/{{ $absence->id }}/edit" class="btn btn-success">Modifier</a>
    <a href="/absences" class="btn">Retour à la liste</a>
</div>
@endsection
