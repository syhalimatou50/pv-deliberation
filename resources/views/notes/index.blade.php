@extends('layouts.app')

@section('title', 'Liste des Notes')

@section('content')
<div class="card">
    <h1>Liste des Notes</h1>
    <a href="/notes/create" class="btn btn-success">+ Nouvelle Note</a>

    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Matière</th>
                <th>Note</th>
                <th>Session</th>
                <th>Année</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notes as $note)
            <tr>
                <td>{{ $note->etudiant->prenom ?? 'N/A' }}</td>
                <td>{{ $note->etudiant->nom ?? 'N/A' }}</td>
                <td>{{ $note->matiere->nom ?? 'N/A' }}</td>
                <td>{{ $note->note }}</td>
                <td>{{ $note->session }}</td>
                <td>{{ $note->annee_academique }}</td>
                <td>
                    <a href="/notes/{{ $note->id }}" class="btn">Voir</a>
                    <a href="/notes/{{ $note->id }}/edit" class="btn">Modifier</a>
                    <form action="/notes/{{ $note->id }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">Aucune note trouvée</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
