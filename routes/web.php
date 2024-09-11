<?php

use App\Http\Controllers\AffiliationController;
use App\Http\Controllers\EntrepriseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/demande-affiliation', [AffiliationController::class, 'create'])->name('affiliation.create');
Route::post('/demande-affiliation', [AffiliationController::class, 'store'])->name('affiliation.store');

Route::get('/entreprise-login', [EntrepriseController::class, 'showLoginForm'])->name('entreprise.showLoginForm');
Route::post('/entreprise-login', [EntrepriseController::class, 'login'])->name('entreprise.login');

