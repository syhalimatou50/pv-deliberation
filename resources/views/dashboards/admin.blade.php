@extends('layouts.app')

@section('title', 'Dashboard Administrateur')

@section('content')
<div class="card">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; border-radius: 10px; margin-bottom: 2rem;">
        <h1 style="margin: 0 0 0.5rem 0; font-size: 2.5rem;">👨‍💼 Tableau de Bord Administrateur</h1>
        <p style="margin: 0; font-size: 1.2rem; opacity: 0.9;">Bienvenue, {{ auth()->user()->name }} - Rôle : SuperAdmin</p>
    </div>

    <!-- Statistiques principales -->
    <h2 style="color: #667eea; margin: 0 0 1.5rem 0; font-size: 1.5rem;">📊 Statistiques Globales</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(102,126,234,0.3);">
            <div style="font-size: 3.5rem; margin-bottom: 0.5rem;">📚</div>
            <div style="font-size: 3rem; font-weight: bold;">{{ $stats['filieres'] }}</div>
            <div style="font-size: 1.1rem; margin-top: 0.5rem;">Filières</div>
        </div>
        
        <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(240,147,251,0.3);">
            <div style="font-size: 3.5rem; margin-bottom: 0.5rem;">📖</div>
            <div style="font-size: 3rem; font-weight: bold;">{{ $stats['matieres'] }}</div>
            <div style="font-size: 1.1rem; margin-top: 0.5rem;">Matières</div>
        </div>
        
        <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(79,172,254,0.3);">
            <div style="font-size: 3.5rem; margin-bottom: 0.5rem;">🎓</div>
            <div style="font-size: 3rem; font-weight: bold;">{{ $stats['etudiants'] }}</div>
            <div style="font-size: 1.1rem; margin-top: 0.5rem;">Étudiants</div>
        </div>
        
        <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(67,233,123,0.3);">
            <div style="font-size: 3.5rem; margin-bottom: 0.5rem;">📝</div>
            <div style="font-size: 3rem; font-weight: bold;">{{ $stats['notes'] }}</div>
            <div style="font-size: 1.1rem; margin-top: 0.5rem;">Notes</div>
        </div>
        
        <div style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(250,112,154,0.3);">
            <div style="font-size: 3.5rem; margin-bottom: 0.5rem;">👥</div>
            <div style="font-size: 3rem; font-weight: bold;">{{ $stats['users'] }}</div>
            <div style="font-size: 1.1rem; margin-top: 0.5rem;">Utilisateurs</div>
        </div>
    </div>

    <!-- Gestion des Données -->
    <h2 style="color: #667eea; margin: 2rem 0 1rem 0; font-size: 1.5rem;">🗂️ Gestion des Données</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 3rem;">
        <a href="/filieres" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; font-size: 1.1rem; text-align: center; border-radius: 10px; text-decoration: none; transition: transform 0.2s;">
            📚 Gérer Filières
        </a>
        <a href="/matieres" class="btn" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 1.5rem; font-size: 1.1rem; text-align: center; border-radius: 10px; text-decoration: none; transition: transform 0.2s;">
            📖 Gérer Matières
        </a>
        <a href="/enseignants" class="btn" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 1.5rem; font-size: 1.1rem; text-align: center; border-radius: 10px; text-decoration: none; transition: transform 0.2s;">
            👨‍🏫 Gérer Enseignants
        </a>
        <a href="/etudiants" class="btn" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 1.5rem; font-size: 1.1rem; text-align: center; border-radius: 10px; text-decoration: none; transition: transform 0.2s;">
            🎓 Gérer Étudiants
        </a>
        <a href="/notes" class="btn" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; padding: 1.5rem; font-size: 1.1rem; text-align: center; border-radius: 10px; text-decoration: none; transition: transform 0.2s;">
            📝 Gérer Notes
        </a>
    </div>

    <!-- Planning & Suivi -->
    <h2 style="color: #667eea; margin: 2rem 0 1rem 0; font-size: 1.5rem;">📅 Planning & Suivi</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 3rem;">
        <a href="/emplois-temps" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; font-size: 1.1rem; text-align: center; border-radius: 10px; text-decoration: none; transition: transform 0.2s;">
            📅 Emplois du Temps
        </a>
        <a href="/absences" class="btn" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 1.5rem; font-size: 1.1rem; text-align: center; border-radius: 10px; text-decoration: none; transition: transform 0.2s;">
            📊 Gérer Absences
        </a>
        <a href="/salles" class="btn" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 1.5rem; font-size: 1.1rem; text-align: center; border-radius: 10px; text-decoration: none; transition: transform 0.2s;">
            🏫 Gérer Salles
        </a>
    </div>

    <!-- Génération de Documents -->
    <h2 style="color: #667eea; margin: 2rem 0 1rem 0; font-size: 1.5rem;">📋 Génération de Documents</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
        <a href="/deliberation" class="btn" style="background: linear-gradient(135deg, #f39c12 0%, #e74c3c 100%); color: white; padding: 2rem; font-size: 1.2rem; text-align: center; border-radius: 10px; text-decoration: none; transition: transform 0.2s; box-shadow: 0 5px 15px rgba(243,156,18,0.3);">
            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">📋</div>
            <strong>GÉNÉRER LE PV DE DÉLIBÉRATION</strong>
        </a>
    </div>
</div>

<style>
    a.btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2) !important;
    }
</style>
@endsection
