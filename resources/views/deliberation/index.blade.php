@extends('layouts.app')

@section('title', 'PV de Délibération')

@section('content')
<div class="card">
    <h1>📋 Procès-Verbal de Délibération</h1>
    <p style="margin: 1rem 0;">Sélectionnez une filière pour générer le PV de délibération</p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-top: 2rem;">
        @forelse($filieres as $filiere)
            <a href="/deliberation/{{ $filiere->id }}?annee={{ date('Y') }}" 
               style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                      color: white; padding: 2rem; border-radius: 15px; text-decoration: none; 
                      text-align: center; transition: transform 0.3s ease;"
               onmouseover="this.style.transform='translateY(-5px)'"
               onmouseout="this.style.transform='translateY(0)'">
                <h2 style="margin: 0 0 0.5rem 0;">{{ $filiere->nom }}</h2>
                <p style="margin: 0; opacity: 0.9;">{{ $filiere->code }}</p>
            </a>
        @empty
            <p>Aucune filière disponible. Veuillez d'abord créer des filières.</p>
        @endforelse
    </div>
</div>
@endsection
