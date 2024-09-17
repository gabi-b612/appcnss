<?php

use App\Http\Controllers\AffiliationController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\EntrepriseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/administrateur', function () {
    return view('admin.dashboard');
})->name('dashboard');



Route::get('/demande/affiliation', [AffiliationController::class, 'create'])->name('affiliation.create');
Route::post('/demande/affiliation', [AffiliationController::class, 'store'])->name('affiliation.store');

Route::get('/administratreur/login', [AuthAdminController::class, 'login'])->name('admin.login');
Route::get('/administratreur/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');
Route::post('/administratreur/login', [AuthAdminController::class, 'connexion']);
Route::get('/administratreur/affiliations/attente', [AffiliationController::class, 'affiliationsEnAttente'])->name('admin.affiliations.attente');
Route::post('/administratreur/affiliations/{affiliation}/repondre', [AffiliationController::class, 'repondre'])->name('admin.affiliations.repondre');
Route::post('/administratreur/affiliations/{affiliation}/rejet', [AffiliationController::class, 'confirmerRejet'])->name('admin.affiliations.rejet');

//Route::post('/administratreur/affiliations/{id}/repondre', [AffiliationController::class, 'repondreAffiliation'])->name('admin.affiliations.repondre');



Route::get('/entreprise/login', [EntrepriseController::class, 'showLoginForm'])->name('entreprise.showLoginForm');
Route::post('/entreprise/login', [EntrepriseController::class, 'login'])->name('entreprise.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('entreprise/dashboard', [EntrepriseController::class, 'dashboard'])->name('entreprise.dashboard');
//    Route::get('')->name('entreprise.logout');
});

