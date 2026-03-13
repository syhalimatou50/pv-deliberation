@extends('layouts.app')

@section('title', 'PV de Délibération - {{ $filiere->nom }}')

@section('content')
<div class="card">
    <div style="text-align: center; margin-bottom: 2rem; border-bottom: 2px solid #667eea; padding-bottom: 1rem;">
        <h1 style="color: #667eea; margin: 0;">📋 PROCÈS-VERBAL DE DÉLIBÉRATION</h1>
        <h2 style="margin: 0.5rem 0;">Filière : {{ $filiere->nom }}</h2>
        <p style="margin: 0.5rem 0;">Année Académique : {{ $annee_academique }}</p>
        <p style="margin: 0; font-size: 0.9rem; color: #666;">Date : {{ date('d/m/Y') }}</p>
    </div>

    <!-- Statistiques -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
        <div style="background: #667eea; color: white; padding: 1.5rem; border-radius: 10px; text-align: center;">
            <h3 style="margin: 0; font-size: 2rem;">{{ $stats['total'] }}</h3>
            <p style="margin: 0.5rem 0 0 0;">Étudiants</p>
        </div>
        <div style="background: #27ae60; color: white; padding: 1.5rem; border-radius: 10px; text-align: center;">
            <h3 style="margin: 0; font-size: 2rem;">{{ $stats['admis'] }}</h3>
            <p style="margin: 0.5rem 0 0 0;">Admis</p>
        </div>
        <div style="background: #e74c3c; color: white; padding: 1.5rem; border-radius: 10px; text-align: center;">
            <h3 style="margin: 0; font-size: 2rem;">{{ $stats['redouble'] }}</h3>
            <p style="margin: 0.5rem 0 0 0;">Redoublants</p>
        </div>
        <div style="background: #f39c12; color: white; padding: 1.5rem; border-radius: 10px; text-align: center;">
            <h3 style="margin: 0; font-size: 2rem;">{{ $stats['taux_reussite'] }}%</h3>
            <p style="margin: 0.5rem 0 0 0;">Taux de Réussite</p>
        </div>
    </div>

    <!-- Graphique de distribution -->
    @if(count($resultats) > 0)
    <div style="margin-bottom: 2rem; background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <h2 style="text-align: center; margin-bottom: 2rem; color: #667eea;">📊 Distribution des Notes</h2>
        <canvas id="chartDistribution" style="max-height: 350px;"></canvas>
    </div>
    @endif

    <!-- Tableau des résultats -->
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Rang</th>
                    <th>Matricule</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Moyenne</th>
                    <th>Mention</th>
                    <th>Décision</th>
                </tr>
            </thead>
            <tbody>
                @forelse($resultats as $resultat)
                    <tr style="background: {{ $resultat['decision'] == 'Admis' ? '#d4edda' : '#f8d7da' }};">
                        <td style="text-align: center; font-weight: bold;">
                            @if($resultat['rang'] == 1)
                                🏆 {{ $resultat['rang'] }}
                            @elseif($resultat['rang'] == 2)
                                🥈 {{ $resultat['rang'] }}
                            @elseif($resultat['rang'] == 3)
                                🥉 {{ $resultat['rang'] }}
                            @else
                                {{ $resultat['rang'] }}
                            @endif
                        </td>
                        <td>{{ $resultat['etudiant']->matricule }}</td>
                        <td>{{ $resultat['etudiant']->prenom }}</td>
                        <td style="font-weight: bold;">{{ strtoupper($resultat['etudiant']->nom) }}</td>
                        <td style="text-align: center; font-weight: bold; font-size: 1.1rem;">
                            {{ number_format($resultat['moyenne'], 2) }}/20
                        </td>
                        <td style="text-align: center;">
                            <span style="background: #667eea; color: white; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.9rem;">
                                {{ $resultat['mention'] }}
                            </span>
                        </td>
                        <td style="text-align: center; font-weight: bold; color: {{ $resultat['decision'] == 'Admis' ? '#27ae60' : '#e74c3c' }};">
                            {{ $resultat['decision'] }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2rem;">
                            Aucun résultat disponible pour cette filière et cette année.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Moyenne de classe -->
    @if(count($resultats) > 0)
        <div style="margin-top: 2rem; padding: 1rem; background: #f8f9fa; border-left: 4px solid #667eea;">
            <p style="margin: 0; font-size: 1.1rem;">
                <strong>Moyenne de la classe :</strong> {{ number_format($stats['moyenne_classe'], 2) }}/20
            </p>
        </div>
    @endif

    <!-- Boutons d'action -->
<div style="margin-top: 2rem; display: flex; gap: 1rem;">
    <a href="/deliberation/{{ $filiere->id }}/pdf?annee={{ $annee_academique }}" class="btn btn-danger">📄 Télécharger PDF</a>
    <button onclick="window.print()" class="btn btn-success">🖨️ Imprimer</button>
    <a href="/deliberation" class="btn">← Retour</a>
</div>

@if(count($resultats) > 0)
<script>
const ctx = document.getElementById('chartDistribution').getContext('2d');
const resultats = @json($resultats);

// Calculer la distribution par tranches
const tranches = {
    '0-5': 0,
    '5-10': 0,
    '10-12': 0,
    '12-14': 0,
    '14-16': 0,
    '16-20': 0
};

resultats.forEach(r => {
    const moy = r.moyenne;
    if (moy < 5) tranches['0-5']++;
    else if (moy < 10) tranches['5-10']++;
    else if (moy < 12) tranches['10-12']++;
    else if (moy < 14) tranches['12-14']++;
    else if (moy < 16) tranches['14-16']++;
    else tranches['16-20']++;
});

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['0-5', '5-10', '10-12', '12-14', '14-16', '16-20'],
        datasets: [{
            label: 'Nombre d\'étudiants',
            data: Object.values(tranches),
            backgroundColor: [
                '#e74c3c',
                '#f39c12',
                '#f1c40f',
                '#3498db',
                '#2ecc71',
                '#27ae60'
            ],
            borderColor: '#fff',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Répartition des moyennes par tranches'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                },
                title: {
                    display: true,
                    text: 'Nombre d\'étudiants'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Tranches de moyennes'
                }
            }
        }
    }
});
</script>
@endif

<style>
@media print {
    nav, .btn, canvas { display: none !important; }
    body { background: white !important; }
    .card { box-shadow: none !important; }
}
</style>
@endsection
