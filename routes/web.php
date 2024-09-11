<?php

use App\Http\Controllers\AffiliationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/demande-affiliation', [AffiliationController::class, 'create'])->name('affiliation.create');
Route::post('/demande-affiliation', [AffiliationController::class, 'store'])->name('affiliation.store');
