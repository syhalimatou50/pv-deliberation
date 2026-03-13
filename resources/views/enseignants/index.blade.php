@extends('layouts.app')

@section('title', 'Liste des Enseignants')

@section('content')
<div class="card">
    <h1>👨‍🏫 Liste des Enseignants</h1>
    
    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
        <a href="/enseignants/create" class="btn btn-success">+ Nouvel Enseignant</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Spécialité</th>
                <th>Matières</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enseignants as $enseignant)
            <tr>
                <td>{{ $enseignant->prenom }}</td>
                <td style="font-weight: bold;">{{ strtoupper($enseignant->nom) }}</td>
                <td>{{ $enseignant->email }}</td>
                <td>{{ $enseignant->telephone ?? 'N/A' }}</td>
                <td>{{ $enseignant->specialite ?? 'N/A' }}</td>
                <td>
                    @if($enseignant->matieres->count() > 0)
                        <span style="background: #e3f2fd; padding: 0.25rem 0.5rem; border-radius: 4px;">
                            {{ $enseignant->matieres->count() }} matière(s)
                        </span>
                    @else
                        <span style="color: #999;">Aucune</span>
                    @endif
                </td>
                <td>
                    <a href="/enseignants/{{ $enseignant->id }}" class="btn">Voir</a>
                    <a href="/enseignants/{{ $enseignant->id }}/edit" class="btn">Modifier</a>
                    <form action="/enseignants/{{ $enseignant->id }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Êtes-vous sûr ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">Aucun enseignant trouvé</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
