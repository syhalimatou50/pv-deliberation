@extends('layouts.app')

@section('title', 'Détails de la Note')

@section('content')
<div class="card">
    <h1>Détails de la Note</h1>
    
    <div style="margin: 2rem 0;">
        <p><strong>Prénom :</strong> {{ $note->etudiant->prenom }}</p>
        <p><strong>Nom :</strong> {{ $note->etudiant->nom }}</p>
        <p><strong>Matière :</strong> {{ $note->matiere->nom }}</p>
        <p><strong>Note :</strong> {{ $note->note }}/20</p>
        <p><strong>Session :</strong> {{ $note->session }}</p>
        <p><strong>Année académique :</strong> {{ $note->annee_academique }}</p>
        <p><strong>Créé le :</strong> {{ $note->created_at->format('d/m/Y H:i') }}</p>
    </div>
    
    <a href="/notes/{{ $note->id }}/edit" class="btn btn-success">Modifier</a>
    <a href="/notes" class="btn">Retour à la liste</a>
</div>
@endsection
