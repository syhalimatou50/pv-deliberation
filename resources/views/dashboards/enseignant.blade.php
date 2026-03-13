@extends('layouts.app')

@section('title', 'Dashboard Enseignant')

@section('content')
<div class="card">
    <h1 style="color: #667eea;">👨‍🏫 Tableau de Bord Enseignant</h1>
    <p style="color: #666; margin-bottom: 2rem;">Bienvenue, {{ auth()->user()->name }}</p>

    <!-- Statistiques -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 2rem; border-radius: 15px; text-align: center;">
            <div style="font-size: 3rem; margin-bottom: 0.5rem;">📖</div>
            <div style="font-size: 2.5rem; font-weight: bold;">{{ $stats['matieres'] }}</div>
            <div style="font-size: 1rem;">Matières</div>
        </div>
        <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 2rem; border-radius: 15px; text-align: center;">
            <div style="font-size: 3rem; margin-bottom: 0.5rem;">🎓</div>
            <div style="font-size: 2.5rem; font-weight: bold;">{{ $stats['etudiants'] }}</div>
            <div style="font-size: 1rem;">Étudiants</div>
        </div>
        <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 2rem; border-radius: 15px; text-align: center;">
            <div style="font-size: 3rem; margin-bottom: 0.5rem;">📝</div>
            <div style="font-size: 2.5rem; font-weight: bold;">{{ $stats['notes'] }}</div>
            <div style="font-size: 1rem;">Notes Saisies</div>
        </div>
    </div>

    <div style="background: #e3f2fd; padding: 2rem; border-radius: 10px; border-left: 4px solid #2196f3; margin-bottom: 2rem;">
        <h2 style="margin: 0 0 1rem 0; color: #1976d2;">📚 Mes Matières</h2>
        <p style="margin: 0; color: #1976d2;">
            La fonctionnalité d'attribution des matières sera bientôt disponible. 
            Vous pourrez alors gérer vos cours et saisir les notes de vos étudiants.
        </p>
    </div>

    <h2 style="color: #667eea; margin: 2rem 0 1rem 0;">⚡ Actions Rapides</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
        <a href="/notes" class="btn btn-success">📝 Saisir des Notes</a>
        <a href="/etudiants" class="btn btn-success">🎓 Voir Étudiants</a>
        <a href="#" class="btn btn-success">📅 Mon Emploi du Temps</a>
        <a href="#" class="btn btn-success">📊 Gérer les Absences</a>
    </div>
</div>
@endsection
