@extends('layouts.app')

@section('title', 'Liste des Absences')

@section('content')
<div class="card">
    <h1>📊 Gestion des Absences</h1>
    
    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
        <a href="/absences/create" class="btn btn-success">+ Nouvelle Absence</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Étudiant</th>
                <th>Matière</th>
                <th>Type</th>
                <th>Justifiée</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($absences as $absence)
            <tr style="background: {{ $absence->justifie ? '#d4edda' : '#f8d7da' }};">
                <td>{{ $absence->date->format('d/m/Y') }}</td>
                <td>{{ $absence->etudiant->prenom }} {{ strtoupper($absence->etudiant->nom) }}</td>
                <td>{{ $absence->matiere->nom }}</td>
                <td>
                    <span style="background: #e3f2fd; padding: 0.25rem 0.5rem; border-radius: 4px;">
                        {{ strtoupper($absence->type) }}
                    </span>
                </td>
                <td style="text-align: center;">
                    @if($absence->justifie)
                        <span style="color: #28a745; font-weight: bold;">✓ Oui</span>
                    @else
                        <span style="color: #dc3545; font-weight: bold;">✗ Non</span>
                    @endif
                </td>
                <td>
                    <a href="/absences/{{ $absence->id }}" class="btn">Voir</a>
                    <a href="/absences/{{ $absence->id }}/edit" class="btn">Modifier</a>
                    <form action="/absences/{{ $absence->id }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Êtes-vous sûr ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Aucune absence enregistrée</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
