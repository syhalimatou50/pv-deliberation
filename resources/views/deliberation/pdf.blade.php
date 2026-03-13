<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>PV Délibération - {{ $filiere->nom }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 15px; }
        .header h1 { font-size: 20px; margin-bottom: 5px; }
        .header h2 { font-size: 16px; margin-bottom: 5px; }
        .header p { font-size: 12px; color: #666; }
        .stats { display: table; width: 100%; margin-bottom: 20px; }
        .stat { display: table-cell; width: 25%; text-align: center; padding: 10px; background: #f0f0f0; border: 1px solid #ccc; }
        .stat-number { font-size: 24px; font-weight: bold; }
        .stat-label { font-size: 10px; color: #666; margin-top: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background: #333; color: white; font-weight: bold; text-align: center; }
        .center { text-align: center; }
        .admis { background: #d4edda; }
        .redouble { background: #f8d7da; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 1px solid #000; font-size: 10px; }
        .mention { display: inline-block; background: #667eea; color: white; padding: 3px 10px; border-radius: 10px; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>PROCÈS-VERBAL DE DÉLIBÉRATION</h1>
        <h2>Filière : {{ $filiere->nom }}</h2>
        <p>Année Académique : {{ $annee_academique }} | Date : {{ date('d/m/Y') }}</p>
    </div>

    <div class="stats">
        <div class="stat">
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="stat-label">Étudiants</div>
        </div>
        <div class="stat">
            <div class="stat-number">{{ $stats['admis'] }}</div>
            <div class="stat-label">Admis</div>
        </div>
        <div class="stat">
            <div class="stat-number">{{ $stats['redouble'] }}</div>
            <div class="stat-label">Redoublants</div>
        </div>
        <div class="stat">
            <div class="stat-number">{{ $stats['taux_reussite'] }}%</div>
            <div class="stat-label">Taux Réussite</div>
        </div>
    </div>

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
            @foreach($resultats as $resultat)
                <tr class="{{ $resultat['decision'] == 'Admis' ? 'admis' : 'redouble' }}">
                    <td class="center"><strong>{{ $resultat['rang'] }}</strong></td>
                    <td>{{ $resultat['etudiant']->matricule }}</td>
                    <td>{{ $resultat['etudiant']->prenom }}</td>
                    <td><strong>{{ strtoupper($resultat['etudiant']->nom) }}</strong></td>
                    <td class="center"><strong>{{ number_format($resultat['moyenne'], 2) }}/20</strong></td>
                    <td class="center">
                        <span class="mention">{{ $resultat['mention'] }}</span>
                    </td>
                    <td class="center"><strong>{{ $resultat['decision'] }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="background: #f0f0f0; padding: 10px; border-left: 4px solid #667eea;">
        <strong>Moyenne de la classe :</strong> {{ number_format($stats['moyenne_classe'], 2) }}/20
    </div>

    <div class="footer">
        <p>Document généré automatiquement le {{ date('d/m/Y à H:i') }}</p>
    </div>
</body>
</html>
