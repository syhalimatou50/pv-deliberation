@extends('layouts.app')

@section('title', 'Détails Enseignant')

@section('content')
<div class="card">
    <h1>👨‍🏫 Détails de l'Enseignant</h1>
    
    <div style="margin: 2rem 0;">
        <p><strong>Prénom :</strong> {{ $enseignant->prenom }}</p>
        <p><strong>Nom :</strong> {{ $enseignant->nom }}</p>
        <p><strong>Email :</strong> {{ $enseignant->email }}</p>
        <p><strong>Téléphone :</strong> {{ $enseignant->telephone ?? 'Non renseigné' }}</p>
        <p><strong>Spécialité :</strong> {{ $enseignant->specialite ?? 'Non renseignée' }}</p>
        <p><strong>Créé le :</strong> {{ $enseignant->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <h2 style="margin: 2rem 0 1rem 0;">📚 Matières Enseignées ({{ $enseignant->matieres->count() }})</h2>
    
    @if($enseignant->matieres->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Matière</th>
                    <th>Coefficient</th>
                    <th>Filière</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enseignant->matieres as $matiere)
                <tr>
                    <td>{{ $matiere->code }}</td>
                    <td>{{ $matiere->nom }}</td>
                    <td>{{ $matiere->coefficient }}</td>
                    <td>{{ $matiere->filiere->nom }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color: #999;">Aucune matière attribuée pour le moment.</p>
    @endif
    
    <div style="margin-top: 2rem;">
        <a href="/enseignants/{{ $enseignant->id }}/edit" class="btn btn-success">Modifier</a>
        <a href="/enseignants" class="btn">Retour à la liste</a>
    </div>
</div>
@endsection
