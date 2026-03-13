@extends('layouts.app')

@section('title', 'Détails de la Matière')

@section('content')
<div class="card">
    <h1>Détails de la Matière</h1>
    
    <div style="margin: 2rem 0;">
        <p><strong>Code :</strong> {{ $matiere->code }}</p>
        <p><strong>Nom :</strong> {{ $matiere->nom }}</p>
        <p><strong>Coefficient :</strong> {{ $matiere->coefficient }}</p>
        <p><strong>Filière :</strong> {{ $matiere->filiere->nom }}</p>
        <p><strong>Créé le :</strong> {{ $matiere->created_at->format('d/m/Y H:i') }}</p>
    </div>
    
    <a href="/matieres/{{ $matiere->id }}/edit" class="btn btn-success">Modifier</a>
    <a href="/matieres" class="btn">Retour à la liste</a>
</div>
@endsection
