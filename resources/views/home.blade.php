<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PV Délibération - Accueil</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Animation des bulles */
        .bubbles {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
            top: 0;
            left: 0;
        }
        
        .bubble {
            position: absolute;
            bottom: -100px;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            opacity: 0.5;
            animation: rise 10s infinite ease-in;
        }
        
        .bubble:nth-child(1) { width: 40px; height: 40px; left: 10%; animation-duration: 8s; }
        .bubble:nth-child(2) { width: 20px; height: 20px; left: 20%; animation-duration: 5s; animation-delay: 1s; }
        .bubble:nth-child(3) { width: 50px; height: 50px; left: 35%; animation-duration: 7s; animation-delay: 2s; }
        .bubble:nth-child(4) { width: 80px; height: 80px; left: 50%; animation-duration: 11s; animation-delay: 0s; }
        .bubble:nth-child(5) { width: 35px; height: 35px; left: 55%; animation-duration: 6s; animation-delay: 1s; }
        .bubble:nth-child(6) { width: 45px; height: 45px; left: 65%; animation-duration: 8s; animation-delay: 3s; }
        .bubble:nth-child(7) { width: 90px; height: 90px; left: 70%; animation-duration: 12s; animation-delay: 2s; }
        .bubble:nth-child(8) { width: 25px; height: 25px; left: 80%; animation-duration: 6s; animation-delay: 2s; }
        .bubble:nth-child(9) { width: 15px; height: 15px; left: 90%; animation-duration: 5s; animation-delay: 1s; }
        
        @keyframes rise {
            0% { bottom: -100px; transform: translateX(0); }
            50% { transform: translateX(100px); }
            100% { bottom: 1080px; transform: translateX(-200px); }
        }
        
        .container {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .header {
            text-align: center;
            color: white;
            margin-bottom: 3rem;
            animation: fadeInDown 1s ease;
        }
        
        .header h1 {
            font-size: 4rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: bounce 2s infinite;
        }
        
        .header p {
            font-size: 1.5rem;
            opacity: 0.9;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeInUp 1s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        
        .stat-card:nth-child(1) { animation-delay: 0.1s; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stat-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .actions {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            animation: fadeIn 1.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .actions h2 {
            color: #667eea;
            margin-bottom: 1.5rem;
            font-size: 2rem;
        }
        
        .btn-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .btn {
            padding: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 15px;
            text-align: center;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
        
        .btn:nth-child(1) { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .btn:nth-child(2) { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .btn:nth-child(3) { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .btn:nth-child(4) { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
        
        .btn-deliberation {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, #f39c12 0%, #e74c3c 100%) !important;
            font-size: 1.3rem !important;
            padding: 2rem !important;
        }
        
        .nav-menu {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            border-radius: 50px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }
        
        .nav-menu a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        
        .nav-menu a:hover {
            background: white;
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <div class="container">
        <div class="nav-menu">
            <a href="/">🏠 Accueil</a>
            <a href="/filieres">📚 Filières</a>
            <a href="/matieres">📖 Matières</a>
            <a href="/etudiants">🎓 Étudiants</a>
            <a href="/notes">📝 Notes</a>
            <a href="/deliberation">📋 Délibération</a>
        </div>

        <div class="header">
            <h1>🎓 PV Délibération</h1>
            <p>Gestion Moderne & Élégante</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📚</div>
                <div class="stat-number">{{ $stats['filieres'] }}</div>
                <div class="stat-label">Filières</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📖</div>
                <div class="stat-number">{{ $stats['matieres'] }}</div>
                <div class="stat-label">Matières</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🎓</div>
                <div class="stat-number">{{ $stats['etudiants'] }}</div>
                <div class="stat-label">Étudiants</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📝</div>
                <div class="stat-number">{{ $stats['notes'] }}</div>
                <div class="stat-label">Notes</div>
            </div>
        </div>

        <div class="actions">
            <h2>⚡ Actions Rapides</h2>
            <div class="btn-grid">
                <a href="/filieres/create" class="btn">➕ Nouvelle Filière</a>
                <a href="/matieres/create" class="btn">➕ Nouvelle Matière</a>
                <a href="/etudiants/create" class="btn">➕ Nouvel Étudiant</a>
                <a href="/notes/create" class="btn">➕ Nouvelle Note</a>
                <a href="/deliberation" class="btn btn-deliberation">📋 GÉNÉRER LE PV DE DÉLIBÉRATION</a>
            </div>
        </div>
    </div>
</body>
</html>
