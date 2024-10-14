<?php

namespace App\Http\Controllers;

use App\Models\Immatriculation;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class EntrepriseController extends Controller
{
    public function dashboard(): View|Factory|Application
    {
        return view('entreprise.dashboard');
    }
    public function immatriculationEnAttente(): View|Factory|Application
    {
        $immatriculations = Immatriculation::where('etat', 'en attente')->get();
        return view('entreprise.immatriculation.attente', compact('immatriculations'));
    }

    public function immatriculationEnRejeter(): View|Factory|Application
    {
        $immatriculations = Immatriculation::where('etat', 'rejeter')->get();
        return view('entreprise.immatriculation.rejeter', compact('immatriculations'));
    }

    public function immatriculationEnApprouver(): View|Factory|Application
    {
        $immatriculations = Immatriculation::where('etat', 'accepter')->get();
        return view('entreprise.immatriculation.accepter', compact('immatriculations'));
    }
}
