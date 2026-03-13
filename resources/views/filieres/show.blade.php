@extends('layouts.app')

@section('title', 'Détails de la Filière')

@section('content')
<div class="card">
    <h1>Détails de la Filière</h1>
    
    <div style="margin: 2rem 0;">
        <p><strong>Code :</strong> {{ $filiere->code }}</p>
        <p><strong>Nom :</strong> {{ $filiere->nom }}</p>
        <p><strong>Description :</strong> {{ $filiere->description ?? 'Aucune description' }}</p>
        <p><strong>Créé le :</strong> {{ $filiere->created_at->format('d/m/Y H:i') }}</p>
    </div>
    
    <a href="/filieres/{{ $filiere->id }}/edit" class="btn btn-success">Modifier</a>
    <a href="/filieres" class="btn">Retour à la liste</a>
</div>
@endsection
