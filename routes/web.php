<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VisiteController;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/stats', [DashboardController::class, 'stats']);


Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/mot-de-passe-oublie', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/mot-de-passe-oublie', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Page protégée (dashboard)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Redirection racine -> login
Route::get('/', function () {
    return redirect()->route('login');
});




// Gestion des clients (protégée par auth)
Route::middleware('auth')->group(function () {
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

    // Visites (même si ce n’est pas encore fini)
    Route::get('/visites', [VisiteController::class, 'index'])->name('visites.index');
    Route::get('/visites/create', [VisiteController::class, 'create'])->name('visites.create');
    Route::post('/visites', [VisiteController::class, 'store'])->name('visites.store');
    Route::post('/visites/{visite}/depart', [VisiteController::class, 'depart'])->name('visites.depart');


        // Historique avancé
    Route::get('/visites/historique', [VisiteController::class, 'historique'])
        ->name('visites.historique');

    // Export CSV (reprend les mêmes filtres que l'historique)
    Route::get('/visites/export', [VisiteController::class, 'export'])
        ->name('visites.export');

    // Rapport d'une visite
    Route::get('/visites/{visite}', [VisiteController::class, 'show'])
        ->name('visites.show');

});






 