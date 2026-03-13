@extends('layouts.app')

@section('title', 'Détails Salle')

@section('content')
<div class="card">
    <h1>🏫 Détails de la Salle</h1>
    
    <div style="margin: 2rem 0;">
        <p><strong>Numéro :</strong> {{ $salle->numero }}</p>
        <p><strong>Bâtiment :</strong> {{ $salle->batiment ?? 'Non renseigné' }}</p>
        <p><strong>Capacité :</strong> {{ $salle->capacite }} places</p>
        <p><strong>Type :</strong> {{ strtoupper($salle->type) }}</p>
    </div>
    
    <a href="/salles/{{ $salle->id }}/edit" class="btn btn-success">Modifier</a>
    <a href="/salles" class="btn">Retour à la liste</a>
</div>
@endsection
