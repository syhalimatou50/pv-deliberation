@extends('layouts.app')

@section('title', 'Emplois du Temps')

@section('content')
<div class="card">
    <h1>📅 Emplois du Temps</h1>
    <p style="color: #666; margin-bottom: 2rem;">Sélectionnez une filière pour consulter ou modifier son emploi du temps</p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
        @foreach($filieres as $filiere)
            <a href="/emplois-temps/{{ $filiere->id }}" style="text-decoration: none;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; border-radius: 15px; text-align: center; transition: transform 0.2s; cursor: pointer;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">📚</div>
                    <h2 style="margin: 0; font-size: 1.5rem;">{{ $filiere->nom }}</h2>
                    <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">{{ $filiere->code }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>

<style>
    a > div:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
    }
</style>
@endsection
