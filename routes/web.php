<?php

use App\Http\Controllers\AffiliationController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ImmatriculationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index');
})->name('index');


// Route de la page de connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// Route pour la demande d'affiliation
Route::get('/demande/affiliation', [AffiliationController::class, 'create'])->name('affiliation.create');
Route::post('/demande/affiliation', [AffiliationController::class, 'store'])->name('affiliation.store');

// Route pour déconnexion
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route pour les administrateurs
Route::middleware(['auth:administrateur'])->group(function () {
    Route::get('/administrateur', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/administrateur/affiliations/attente', [AffiliationController::class, 'affiliationsEnAttente'])->name('admin.affiliations.attente');
    Route::post('/administrateur/affiliations/{affiliation}/repondre', [AffiliationController::class, 'repondre'])->name('admin.affiliations.repondre');
    Route::post('/administrateur/affiliations/{affiliation}/rejet', [AffiliationController::class, 'confirmerRejet'])->name('admin.affiliations.rejet');
    Route::get('/administrateur/affiliations/rejeter', [AffiliationController::class, 'affiliationsEnRejeter'])->name('admin.affiliations.rejeter');
    Route::get('/administrateur/affiliations/approuver', [AffiliationController::class, 'affiliationsEnApprouver'])->name('admin.affiliations.accepter');

//    Route::get('/administrateur/immatriculation/attente', [ImmatriculationController::class, 'immatriculationsEnAttente'])->name('admin.immatriculations.attente');
    Route::post('/administrateur/immatriculation/{immatriculation}/repondre', [ImmatriculationController::class, 'repondre'])->name('admin.immatriculations.repondre');
    Route::post('/administrateur/immatriculation/{immatriculation}/rejet', [ImmatriculationController::class, 'confirmerRejet'])->name('admin.immatriculations.rejet');
//    Route::get('/administrateur/immatriculation/rejeter', [ImmatriculationController::class, 'immatriculationsEnRejeter'])->name('admin.immatriculations.rejeter');
//    Route::get('/administrateur/immatriculation/approuver', [ImmatriculationController::class, 'immatriculationsEnApprouver'])->name('admin.immatriculations.accepter');

    Route::get('/administrateur/immatriculations/{entreprise}', [ImmatriculationController::class, 'showImmatriculations'])->name('admin.immatriculations');
    Route::get('/administrateur/immatriculations/{entreprise}/approuver', [ImmatriculationController::class, 'showImmatriculationsApprouver'])->name('admin.immatriculations.approuver');
    Route::get('/administrateur/immatriculations/{entreprise}/rejeter', [ImmatriculationController::class, 'showImmatriculationsRejeter'])->name('admin.immatriculations.rejeter');

});

// Route pour les entreprise
Route::middleware(['auth:entreprise'])->group(function () {
    Route::get('/entreprise/dashboard', [EntrepriseController::class, 'dashboard'])->name('entreprise.dashboard');
    // Demande d'immatriculation
    Route::get('/entreprise/demande/immatriculation', [ImmatriculationController::class, 'create'])->name('immatriculation.create');
    Route::post('/entreprise/demande/immatriculation', [ImmatriculationController::class, 'store'])->name('immatriculation.store');
    Route::get('/entreprise/immatriculation/attente', [EntrepriseController::class, 'immatriculationEnAttente'])->name('entreprise.immatriculation.attente');
    Route::get('/entreprise/immatriculation/rejeter', [EntrepriseController::class, 'immatriculationEnRejeter'])->name('entreprise.immatriculation.rejeter');
    Route::get('/entreprise/immatriculation/approuver', [EntrepriseController::class, 'immatriculationEnApprouver'])->name('entreprise.immatriculation.approuver');
});
