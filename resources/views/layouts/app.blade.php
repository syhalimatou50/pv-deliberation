<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PV Délibération - @yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        nav { 
            background: #2c3e50; 
            padding: 1rem; 
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav .nav-left { display: flex; gap: 1rem; align-items: center; }
        nav .nav-right { display: flex; gap: 1rem; align-items: center; }
        nav a { color: white; text-decoration: none; margin: 0 1rem; }
        nav a:hover { text-decoration: underline; }
        nav button {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
        }
        nav button:hover { background: #c0392b; }
        .container { max-width: 1200px; margin: 2rem auto; padding: 0 1rem; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #34495e; color: white; }
        .btn { padding: 0.5rem 1rem; background: #3498db; color: white; text-decoration: none; border-radius: 4px; display: inline-block; margin: 0.5rem 0; border: none; cursor: pointer; }
        .btn:hover { background: #2980b9; }
        .btn-success { background: #27ae60; }
        .btn-success:hover { background: #229954; }
        .btn-danger { background: #e74c3c; }
        .btn-danger:hover { background: #c0392b; }
        .alert { padding: 1rem; border-radius: 8px; margin-bottom: 1rem; animation: slideIn 0.3s ease; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .user-info {
            background: rgba(255,255,255,0.1);
            padding: 0.5rem 1rem;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-left">
            <a href="/" style="font-weight: bold; font-size: 1.2rem;">🎓 PV Délibération</a>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="/dashboard/admin">Dashboard</a>
                    <a href="/filieres">Filières</a>
                    <a href="/matieres">Matières</a>
                    <a href="/enseignants">Enseignants</a>
                    <a href="/etudiants">Étudiants</a>
                    <a href="/notes">Notes</a>
                    <a href="/deliberation">Délibération</a>
                    <a href="/absences">Absences</a>
                @elseif(auth()->user()->isEnseignant())
                    <a href="/dashboard/enseignant">Dashboard</a>
                    <a href="/notes">Notes</a>
                    <a href="/mes-absences">Mes Absences</a>
                    <a href="/salles">Salles</a>
                    <a href="/emplois-temps">Emplois du Temps</a>
                    <a href="/deliberation">Délibération</a>
                
                    
                @else
                    <a href="/dashboard/etudiant">Dashboard</a>
                @endif
            @endauth
        </div>
        <div class="nav-right">
            @auth
                <span class="user-info">👤 {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit">🚪 Déconnexion</button>
                </form>
            @else
                <a href="/login">Connexion</a>
                <a href="/register">Inscription</a>
            @endauth
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                ❌ {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <strong>Erreurs :</strong>
                <ul style="margin: 0.5rem 0 0 1.5rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
