<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use App\Models\Entreprise;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AffiliationController extends Controller
{

    public function create(): View|Factory|Application
    {
        return view('affiliation.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'denomination' => 'required|string|max:255|unique:entreprises,denomination',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:15|unique:entreprises,telephone',
            'email' => 'required|email|unique:entreprises,email',
            'forme_juridique' => 'required|string',
            'password' => 'required|string|min:8',
            'document_rccm' => 'required|mimes:pdf|max:2048',
        ]);

        $entreprise = Entreprise::create([
            'denomination' => strtoupper($validated['denomination']),
            'adresse' => $validated['adresse'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
            'forme_juridique' => $validated['forme_juridique'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($request->hasFile('document_rccm')) {
            $documentPath = $request->file('document_rccm')->store('rccm_documents', 'public');
        }

        Affiliation::create([
            'entreprise_id' => $entreprise->id,
            'numero_affiliation' => '010' . rand(100000000, 999999999),
            'document_rccm' => $documentPath,
            'abreviation' => strtoupper(substr($validated['denomination'], 0, 3)),
            'etat' => 'en attente',
        ]);

        return redirect()->route('entreprise.showLoginForm')->with('success', 'Demande d\'affiliation soumise avec succès.');
    }
}
