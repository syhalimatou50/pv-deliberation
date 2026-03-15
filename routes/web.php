<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Redirection selon le rôle après connexion
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect('/dashboard/admin');
        } elseif (auth()->user()->isEnseignant()) {
            return redirect('/dashboard/enseignant');
        } else {
            return redirect('/dashboard/etudiant');
        }
    }
    
    $stats = [
        'filieres' => \App\Models\Filiere::count(),
        'matieres' => \App\Models\Matiere::count(),
        'etudiants' => \App\Models\Etudiant::count(),
        'notes' => \App\Models\Note::count(),
    ];
    
    return view('home', compact('stats'));
})->name('home');

// Dashboards selon les rôles
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
});

Route::middleware(['auth', 'enseignant'])->group(function () {
    Route::get('/dashboard/enseignant', [DashboardController::class, 'enseignant'])->name('dashboard.enseignant');
});

Route::middleware(['auth', 'etudiant'])->group(function () {
    Route::get('/dashboard/etudiant', [DashboardController::class, 'etudiant'])->name('dashboard.etudiant');
});

// Routes protégées - Accessible uniquement par admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('filieres', \App\Http\Controllers\FiliereController::class);
    Route::resource('matieres', \App\Http\Controllers\MatiereController::class);
    Route::resource('etudiants', \App\Http\Controllers\EtudiantController::class);
    Route::resource('notes', \App\Http\Controllers\NoteController::class);
    Route::resource('enseignants', \App\Http\Controllers\EnseignantController::class);
    
    Route::get('/deliberation', [\App\Http\Controllers\DeliberationController::class, 'index'])->name('deliberation.index');
    Route::get('/deliberation/{filiere}', [\App\Http\Controllers\DeliberationController::class, 'show'])->name('deliberation.show');
    Route::get('/deliberation/{filiere}/pdf', [\App\Http\Controllers\DeliberationController::class, 'downloadPDF'])->name('deliberation.pdf');
});

Route::get('/releve/{etudiant}', [\App\Http\Controllers\ReleveController::class, 'show'])->name('releve.show')->middleware('auth');

require __DIR__.'/auth.php';
// Dans le groupe admin
Route::middleware(['auth', 'admin'])->group(function () {
    // Dans le groupe Route::middleware(['auth', 'admin'])->group(function () {
Route::middleware(['auth', 'admin'])->group(function () {
    // ... routes existantes ...
    
    Route::resource('enseignants', \App\Http\Controllers\EnseignantController::class);
    Route::resource('absences', \App\Http\Controllers\AbsenceController::class);
    Route::resource('salles', \App\Http\Controllers\SalleController::class);
    
    // Emplois du temps
    Route::get('/emplois-temps', [\App\Http\Controllers\EmploiTempsController::class, 'index'])->name('emplois-temps.index');
    Route::get('/emplois-temps/create', [\App\Http\Controllers\EmploiTempsController::class, 'create'])->name('emplois-temps.create');
    Route::post('/emplois-temps', [\App\Http\Controllers\EmploiTempsController::class, 'store'])->name('emplois-temps.store');
    Route::get('/emplois-temps/{filiere}', [\App\Http\Controllers\EmploiTempsController::class, 'show'])->name('emplois-temps.show');
    Route::delete('/emplois-temps/{id}', [\App\Http\Controllers\EmploiTempsController::class, 'destroy'])->name('emplois-temps.destroy');
});
    // ... routes existantes ...
    Route::resource('absences', \App\Http\Controllers\AbsenceController::class);
});

// Route pour l'étudiant (voir ses absences)
Route::middleware(['auth', 'etudiant'])->group(function () {
    Route::get('/mes-absences', [\App\Http\Controllers\AbsenceController::class, 'mesAbsences'])->name('mes-absences');
});

// Route accessible aussi par enseignant
Route::middleware(['auth'])->group(function () {
    Route::resource('absences', \App\Http\Controllers\AbsenceController::class)->except(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});
// Route temporaire pour créer l'admin
Route::get('/create-admin-temp', function () {
    if (\App\Models\User::where('email', 'admin@pv.com')->exists()) {
        return 'Admin existe déjà !';
    }
    
    \App\Models\User::create([
        'name' => 'Admin',
        'email' => 'admin@pv.com',
        'password' => bcrypt('admin123'),
        'role' => 'admin',
    ]);
    
    return 'Admin créé avec succès !';
});