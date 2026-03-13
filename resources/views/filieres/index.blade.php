@extends('layouts.app')

@section('title', 'Liste des Filières')

@section('content')
<div class="card">
    <h1>Liste des Filières</h1>
    <a href="/filieres/create" class="btn btn-success">+ Nouvelle Filière</a>

    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($filieres as $filiere)
            <tr>
                <td>{{ $filiere->code }}</td>
                <td>{{ $filiere->nom }}</td>
                <td>{{ $filiere->description }}</td>
                <td>
                    <a href="/filieres/{{ $filiere->id }}" class="btn">Voir</a>
                    <a href="/filieres/{{ $filiere->id }}/edit" class="btn">Modifier</a>
                    <form action="/filieres/{{ $filiere->id }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette filière ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center;">Aucune filière trouvée</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
