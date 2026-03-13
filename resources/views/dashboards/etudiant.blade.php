@extends('layouts.app')

@section('title', 'Dashboard Étudiant')

@section('content')
<div class="card">
    <h1 style="color: #667eea;">🎓 Mon Espace Étudiant</h1>
    <p style="color: #666; margin-bottom: 2rem;">Bienvenue, {{ auth()->user()->name }}</p>

    @if(!$etudiant)
        <div style="background: #fff3cd; padding: 2rem; border-radius: 10px; border-left: 4px solid #ffc107; margin-bottom: 2rem;">
            <h2 style="margin: 0 0 1rem 0; color: #856404;">⚠️ Profil incomplet</h2>
            <p style="margin: 0; color: #856404;">
                Votre compte utilisateur n'est pas encore lié à un profil étudiant. 
                Contactez l'administration pour finaliser votre inscription.
            </p>
        </div>
    @else
        <!-- Informations personnelles -->
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; border-radius: 10px; margin-bottom: 2rem;">
            <h2 style="margin: 0 0 1rem 0;">📋 Mes Informations</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <div>
                    <strong>Matricule :</strong> {{ $etudiant->matricule }}
                </div>
                <div>
                    <strong>Filière :</strong> {{ $etudiant->filiere->nom }}
                </div>
                <div>
                    <strong>Email :</strong> {{ $etudiant->email }}
                </div>
            </div>
        </div>

        @if($moyenne_generale !== null)
            <!-- Résultats avec badges -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(79,172,254,0.3);">
                    <div style="font-size: 3.5rem; font-weight: bold;">{{ number_format($moyenne_generale, 2) }}</div>
                    <div style="font-size: 0.9rem; opacity: 0.9;">/ 20</div>
                    <div style="font-size: 1.1rem; margin-top: 0.5rem; opacity: 0.9;">Moyenne Générale</div>
                </div>
                <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(240,147,251,0.3);">
                    <div style="font-size: 2.5rem; font-weight: bold;">{{ $mention }}</div>
                    <div style="font-size: 1.1rem; margin-top: 0.5rem; opacity: 0.9;">Mention</div>
                </div>
                <div style="background: linear-gradient(135deg, {{ $decision == 'Admis' ? '#43e97b, #38f9d7' : '#fa709a, #fee140' }}); color: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(67,233,123,0.3);">
                    <div style="font-size: 2.5rem; font-weight: bold;">
                        @if($decision == 'Admis')
                            ✅ Admis
                        @else
                            ⚠️ Redouble
                        @endif
                    </div>
                    <div style="font-size: 1.1rem; margin-top: 0.5rem; opacity: 0.9;">Décision</div>
                </div>
            </div>

            <!-- Graphique radar des notes -->
            <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 2rem;">
                <h2 style="color: #667eea; margin-bottom: 1.5rem;">📊 Visualisation de mes Notes</h2>
                <canvas id="radarChart" style="max-height: 400px;"></canvas>
            </div>

            <!-- Matières en difficulté et points forts -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                @php
                    $matieres_faibles = collect($notes_detail)->where('moyenne', '<', 10)->sortBy('moyenne');
                    $matieres_fortes = collect($notes_detail)->where('moyenne', '>=', 16)->sortByDesc('moyenne');
                @endphp

                @if($matieres_faibles->count() > 0)
                <div style="background: #fff3cd; padding: 1.5rem; border-radius: 10px; border-left: 4px solid #ffc107;">
                    <h3 style="color: #856404; margin: 0 0 1rem 0;">⚠️ Matières à améliorer ({{ $matieres_faibles->count() }})</h3>
                    @foreach($matieres_faibles->take(3) as $detail)
                        <div style="margin-bottom: 0.5rem; color: #856404;">
                            <strong>{{ $detail['matiere']->nom }}</strong> : {{ number_format($detail['moyenne'], 2) }}/20
                        </div>
                    @endforeach
                </div>
                @endif

                @if($matieres_fortes->count() > 0)
                <div style="background: #d4edda; padding: 1.5rem; border-radius: 10px; border-left: 4px solid #28a745;">
                    <h3 style="color: #155724; margin: 0 0 1rem 0;">🌟 Points forts ({{ $matieres_fortes->count() }})</h3>
                    @foreach($matieres_fortes->take(3) as $detail)
                        <div style="margin-bottom: 0.5rem; color: #155724;">
                            <strong>{{ $detail['matiere']->nom }}</strong> : {{ number_format($detail['moyenne'], 2) }}/20
                        </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Mes notes par matière -->
            <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <h2 style="color: #667eea; margin-bottom: 1.5rem;">📝 Détail par Matière</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Matière</th>
                            <th>Coefficient</th>
                            <th style="text-align: center;">Note</th>
                            <th style="text-align: center;">Note × Coef</th>
                            <th style="text-align: center;">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                            $total_coef = 0;
                        @endphp
                        @foreach($notes_detail as $detail)
                            @php
                                $total += $detail['moyenne'] * $detail['matiere']->coefficient;
                                $total_coef += $detail['matiere']->coefficient;
                                $couleur = $detail['moyenne'] >= 10 ? '#d4edda' : '#f8d7da';
                            @endphp
                            <tr style="background: {{ $couleur }};">
                                <td>{{ $detail['matiere']->nom }}</td>
                                <td style="text-align: center;">{{ $detail['matiere']->coefficient }}</td>
                                <td style="text-align: center; font-weight: bold; font-size: 1.1rem;">
                                    {{ number_format($detail['moyenne'], 2) }}/20
                                </td>
                                <td style="text-align: center;">
                                    {{ number_format($detail['moyenne'] * $detail['matiere']->coefficient, 2) }}
                                </td>
                                <td style="text-align: center;">
                                    @if($detail['moyenne'] >= 10)
                                        <span style="color: #28a745; font-weight: bold;">✓ Validé</span>
                                    @else
                                        <span style="color: #dc3545; font-weight: bold;">✗ Non validé</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr style="background: #e9ecef; font-weight: bold; font-size: 1.1rem;">
                            <td colspan="2" style="text-align: right;">TOTAL</td>
                            <td style="text-align: center;">-</td>
                            <td style="text-align: center;">{{ number_format($total, 2) }}</td>
                            <td style="text-align: center;">
                                Moyenne : {{ number_format($moyenne_generale, 2) }}/20
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <script>
                // Graphique radar des notes
                const ctx = document.getElementById('radarChart').getContext('2d');
                new Chart(ctx, {
                    type: 'radar',
                    data: {
                        labels: [
                            @foreach($notes_detail as $detail)
                                '{{ $detail['matiere']->nom }}',
                            @endforeach
                        ],
                        datasets: [{
                            label: 'Mes Notes',
                            data: [
                                @foreach($notes_detail as $detail)
                                    {{ $detail['moyenne'] }},
                                @endforeach
                            ],
                            backgroundColor: 'rgba(102, 126, 234, 0.2)',
                            borderColor: 'rgba(102, 126, 234, 1)',
                            borderWidth: 2,
                            pointBackgroundColor: 'rgba(102, 126, 234, 1)',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: 'rgba(102, 126, 234, 1)'
                        }]
                    },
                    options: {
                        scales: {
                            r: {
                                beginAtZero: true,
                                max: 20,
                                ticks: {
                                    stepSize: 5
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            </script>
        @else
            <div style="background: #e3f2fd; padding: 2rem; border-radius: 10px; border-left: 4px solid #2196f3; margin-top: 2rem;">
                <h2 style="margin: 0 0 1rem 0; color: #1976d2;">ℹ️ Aucune note disponible</h2>
                <p style="margin: 0; color: #1976d2;">
                    Vous n'avez pas encore de notes enregistrées pour cette année académique.
                </p>
            </div>
        @endif
    @endif

    <h2 style="color: #667eea; margin: 2rem 0 1rem 0;">⚡ Accès Rapide</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
        @if($etudiant)
            <a href="/releve/{{ $etudiant->id }}?annee={{ date('Y') }}" class="btn btn-success">📄 Mon Relevé de Notes</a>
        @endif
        <a href="#" class="btn btn-success">📅 Mon Emploi du Temps</a>
        <a href="/mes-absences" class="btn btn-success">📊 Mes Absences</a>
    </div>
</div>
@endsection
