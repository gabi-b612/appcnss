<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CotisationController extends Controller
{
    public function index(): Application|Factory|View
    {
        // Récupérer le travailleur connecté
        $travailleur = Auth::user();

        // Récupérer les cotisations du travailleur
        $cotisations = $travailleur->cotisations;

        // Retourner la vue avec les cotisations
        return view('travailleur.index', compact('cotisations'));
    }
}
