@extends('layouts.app')

@section('title', 'Mes Absences')

@section('content')
<div class="card">
    <h1>📊 Mes Absences</h1>

    <!-- Taux d'absence global -->
    <div style="margin-bottom: 2rem;">
        @php
            $couleurTaux = $tauxAbsence >= 20 ? '#dc3545' : ($tauxAbsence >= 10 ? '#ffc107' : '#28a745');
        @endphp
        <div style="background: linear-gradient(135deg, {{ $couleurTaux }} 0%, {{ $couleurTaux }}dd 100%); color: white; padding: 2rem; border-radius: 15px; text-align: center;">
            <div style="font-size: 4rem; font-weight: bold;">{{ $tauxAbsence }}%</div>
            <div style="font-size: 1.2rem;">Taux d'Absence Global</div>
            @if($tauxAbsence >= 20)
                <div style="margin-top: 1rem; font-size: 0.9rem;">⚠️ Attention : Risque d'exclusion au-delà de 20%</div>
            @endif
        </div>
    </div>

    <!-- Statistiques par matière -->
    <h2 style="margin: 2rem 0 1rem 0;">📚 Par Matière</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
        @foreach($absencesParMatiere as $stat)
            <div style="background: white; padding: 1.5rem; border-radius: 10px; border-left: 4px solid #667eea; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 1rem 0; color: #667eea;">{{ $stat['matiere']->nom }}</h3>
                <p style="margin: 0.5rem 0;"><strong>Total :</strong> {{ $stat['total'] }} absence(s)</p>
                <p style="margin: 0.5rem 0; color: #28a745;"><strong>Justifiées :</strong> {{ $stat['justifiees'] }}</p>
                <p style="margin: 0.5rem 0; color: #dc3545;"><strong>Non justifiées :</strong> {{ $stat['non_justifiees'] }}</p>
            </div>
        @endforeach
    </div>

    <!-- Liste détaillée -->
    <h2 style="margin: 2rem 0 1rem 0;">📋 Historique Complet</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Matière</th>
                <th>Type</th>
                <th>Justifiée</th>
                <th>Motif</th>
            </tr>
        </thead>
        <tbody>
            @forelse($absences as $absence)
            <tr style="background: {{ $absence->justifie ? '#d4edda' : '#f8d7da' }};">
                <td>{{ $absence->date->format('d/m/Y') }}</td>
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
                <td>{{ $absence->motif ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #28a745; font-weight: bold;">
                    🎉 Aucune absence ! Continuez comme ça !
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 2rem;">
        <a href="/dashboard/etudiant" class="btn">← Retour au Dashboard</a>
    </div>
</div>
@endsection
