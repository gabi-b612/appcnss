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
            'document_rccm' => 'required|mimes:pdf|max:2048',
            'document_juridique' => 'required|mimes:pdf|max:2048',
            'document_id_national' => 'required|mimes:pdf|max:2048',
        ]);

        $entreprise = Entreprise::create([
            'denomination' => strtoupper($validated['denomination']),
            'adresse' => $validated['adresse'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
            'forme_juridique' => $validated['forme_juridique'],
        ]);

        if ($request->hasFile('document_rccm')) {
            $documentPathRccm = $request->file('document_rccm')->store('rccm_documents', 'public');
        }
        if ($request->hasFile('document_juridique')) {
            $documentPathJuridique = $request->file('document_juridique')->store('rccm_juridiques', 'public');
        }
        if ($request->hasFile('document_id_national')) {
            $documentPathID = $request->file('document_id_national')->store('rccm_id_nationals', 'public');
        }

        Affiliation::create([
            'entreprise_id' => $entreprise->id,
            'numero_affiliation' => '010' . rand(100000000, 999999999),
            'document_rccm' => $documentPathRccm,
            'document_juridique' => $documentPathJuridique,
            'document_id_national' => $documentPathID,
            'abreviation' => strtoupper(substr($validated['denomination'], 0, 3)),
            'etat' => 'en attente',
        ]);

        return redirect()->route('affiliation.create')->with('success', 'Demande d\'affiliation soumise avec succès.');
    }

    public function affiliationsEnAttente(): View|Factory|Application
    {
        $affiliations = Affiliation::where('etat', 'en attente')->get();
        return view('admin.affiliations.attente', compact('affiliations'));
    }


}
