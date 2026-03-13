@extends('layouts.app')

@section('title', 'Liste des Salles')

@section('content')
<div class="card">
    <h1>🏫 Gestion des Salles</h1>
    
    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
        <a href="/salles/create" class="btn btn-success">+ Nouvelle Salle</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Bâtiment</th>
                <th>Capacité</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($salles as $salle)
            <tr>
                <td style="font-weight: bold;">{{ $salle->numero }}</td>
                <td>{{ $salle->batiment ?? 'N/A' }}</td>
                <td>{{ $salle->capacite }} places</td>
                <td>
                    <span style="background: #e3f2fd; padding: 0.25rem 0.5rem; border-radius: 4px;">
                        {{ strtoupper($salle->type) }}
                    </span>
                </td>
                <td>
                    <a href="/salles/{{ $salle->id }}" class="btn">Voir</a>
                    <a href="/salles/{{ $salle->id }}/edit" class="btn">Modifier</a>
                    <form action="/salles/{{ $salle->id }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Êtes-vous sûr ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Aucune salle enregistrée</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
