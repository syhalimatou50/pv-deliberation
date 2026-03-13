@extends('layouts.app')

@section('title', 'Liste des Étudiants')

@section('content')
<div class="card">
    <h1>Liste des Étudiants</h1>
    
    <div style="display: flex; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap;">
        <a href="/etudiants/create" class="btn btn-success">+ Nouvel Étudiant</a>
    </div>

    <!-- Barre de recherche et filtres -->
    <form method="GET" action="/etudiants" style="margin-bottom: 2rem; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
        <div style="display: grid; grid-template-columns: 2fr 1fr auto; gap: 1rem; align-items: end;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">🔍 Rechercher :</label>
                <input type="text" name="search" placeholder="Nom, prénom ou matricule..." value="{{ request('search') }}" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">📚 Filière :</label>
                <select name="filiere" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="">Toutes les filières</option>
                    @foreach(\App\Models\Filiere::all() as $f)
                        <option value="{{ $f->id }}" {{ request('filiere') == $f->id ? 'selected' : '' }}>
                            {{ $f->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-success">Filtrer</button>
                <a href="/etudiants" class="btn">Réinitialiser</a>
            </div>
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Filière</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($etudiants as $etudiant)
            <tr>
                <td>{{ $etudiant->matricule }}</td>
                <td>{{ $etudiant->prenom }}</td>
                <td style="font-weight: bold;">{{ strtoupper($etudiant->nom) }}</td>
                <td>{{ $etudiant->email }}</td>
                <td>{{ $etudiant->filiere->nom ?? 'N/A' }}</td>
                <td>
                    <a href="/etudiants/{{ $etudiant->id }}" class="btn">Voir</a>
                    <a href="/releve/{{ $etudiant->id }}?annee={{ date('Y') }}" class="btn btn-success">📄 Relevé</a>
                    <a href="/etudiants/{{ $etudiant->id }}/edit" class="btn">Modifier</a>
                    <form action="/etudiants/{{ $etudiant->id }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Êtes-vous sûr ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Aucun étudiant trouvé</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
