@extends('layouts.app')

@section('title', 'Emploi du Temps')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>📅 Emploi du Temps - {{ $filiere->nom }}</h1>
        <div>
            <a href="/emplois-temps/create?filiere={{ $filiere->id }}" class="btn btn-success">+ Ajouter un cours</a>
            <a href="/emplois-temps" class="btn">← Retour</a>
        </div>
    </div>

    <!-- GRILLE HEBDOMADAIRE -->
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 1000px;">
            <thead>
                <tr style="background: #2c3e50; color: white;">
                    <th style="padding: 1rem; border: 1px solid #34495e; width: 100px;">Heure</th>
                    @foreach($jours as $jour)
                        <th style="padding: 1rem; border: 1px solid #34495e; text-align: center;">
                            {{ ucfirst($jour) }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($heures as $index => $heure)
                    @if($index < count($heures) - 1)
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd; background: #f8f9fa; font-weight: bold; text-align: center;">
                                {{ $heure }}<br>{{ $heures[$index + 1] }}
                            </td>
                            @foreach($jours as $jour)
                                @php
                                    $heure_debut_slot = $heure;
                                    $heure_fin_slot = $heures[$index + 1];
                                    
                                    $cours = $emplois->first(function($e) use ($jour, $heure_debut_slot, $heure_fin_slot) {
                                        $debut = $e->heure_debut->format('H:i');
                                        $fin = $e->heure_fin->format('H:i');
                                        return $e->jour === $jour && $debut <= $heure_debut_slot && $fin > $heure_debut_slot;
                                    });
                                @endphp
                                
                                <td style="padding: 0.5rem; border: 1px solid #ddd; vertical-align: top; position: relative; min-height: 80px;">
                                    @if($cours)
                                        @php
                                            $couleurs = [
                                                'cours' => '#4facfe',
                                                'td' => '#f093fb',
                                                'tp' => '#43e97b'
                                            ];
                                            $couleur = $couleurs[$cours->type] ?? '#667eea';
                                        @endphp
                                        <div style="background: linear-gradient(135deg, {{ $couleur }} 0%, {{ $couleur }}dd 100%); color: white; padding: 0.75rem; border-radius: 8px; font-size: 0.85rem; position: relative;">
                                            <div style="font-weight: bold; margin-bottom: 0.25rem;">{{ $cours->matiere->nom }}</div>
                                            <div style="font-size: 0.75rem; opacity: 0.9;">
                                                {{ $cours->heure_debut->format('H:i') }} - {{ $cours->heure_fin->format('H:i') }}
                                            </div>
                                            @if($cours->enseignant)
                                                <div style="font-size: 0.75rem; opacity: 0.9;">
                                                    👨‍🏫 {{ $cours->enseignant->prenom }} {{ $cours->enseignant->nom }}
                                                </div>
                                            @endif
                                            @if($cours->salle)
                                                <div style="font-size: 0.75rem; opacity: 0.9;">
                                                    🏫 {{ $cours->salle->numero }}
                                                </div>
                                            @endif
                                            <div style="margin-top: 0.5rem;">
                                                <form action="/emplois-temps/{{ $cours->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Supprimer ce cours ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="background: rgba(255,255,255,0.3); border: none; color: white; padding: 0.25rem 0.5rem; border-radius: 4px; cursor: pointer; font-size: 0.7rem;">
                                                        ✕ Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Légende -->
    <div style="margin-top: 2rem; display: flex; gap: 2rem; flex-wrap: wrap;">
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <div style="width: 20px; height: 20px; background: linear-gradient(135deg, #4facfe 0%, #4facfedd 100%); border-radius: 4px;"></div>
            <span>Cours</span>
        </div>
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <div style="width: 20px; height: 20px; background: linear-gradient(135deg, #f093fb 0%, #f093fbdd 100%); border-radius: 4px;"></div>
            <span>TD</span>
        </div>
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <div style="width: 20px; height: 20px; background: linear-gradient(135deg, #43e97b 0%, #43e97bdd 100%); border-radius: 4px;"></div>
            <span>TP</span>
        </div>
    </div>
</div>
@endsection
