@extends('layouts.app')

@section('title', 'Liste des Matières')

@section('content')
<div class="card">
    <h1>Liste des Matières</h1>
    <a href="/matieres/create" class="btn btn-success">+ Nouvelle Matière</a>

    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Coefficient</th>
                <th>Filière</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($matieres as $matiere)
            <tr>
                <td>{{ $matiere->code }}</td>
                <td>{{ $matiere->nom }}</td>
                <td>{{ $matiere->coefficient }}</td>
                <td>{{ $matiere->filiere->nom ?? 'N/A' }}</td>
                <td>
                    <a href="/matieres/{{ $matiere->id }}" class="btn">Voir</a>
                    <a href="/matieres/{{ $matiere->id }}/edit" class="btn">Modifier</a>
                    <form action="/matieres/{{ $matiere->id }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette matière ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Aucune matière trouvée</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
