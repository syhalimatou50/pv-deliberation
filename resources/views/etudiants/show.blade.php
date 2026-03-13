@extends('layouts.app')

@section('title', 'Détails Étudiant')

@section('content')
<div class="card">
    <h1>Détails de l'Étudiant</h1>
    
    <div style="margin: 2rem 0;">
        <p><strong>Matricule :</strong> {{ $etudiant->matricule }}</p>
        <p><strong>Prénom :</strong> {{ $etudiant->prenom }}</p>
        <p><strong>Nom :</strong> {{ $etudiant->nom }}</p>
        <p><strong>Date de naissance :</strong> {{ $etudiant->date_naissance }}</p>
        <p><strong>Email :</strong> {{ $etudiant->email }}</p>
        <p><strong>Filière :</strong> {{ $etudiant->filiere->nom }}</p>
        <p><strong>Créé le :</strong> {{ $etudiant->created_at->format('d/m/Y H:i') }}</p>
    </div>
    
    <a href="/etudiants/{{ $etudiant->id }}/edit" class="btn btn-success">Modifier</a>
    <a href="/etudiants" class="btn">Retour à la liste</a>
</div>
@endsection
