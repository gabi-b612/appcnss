<?php

namespace App\Http\Controllers;

use App\Mail\ApprouveMailAffiliation;
use App\Mail\RejectedMailAffiliation;
use App\Models\Affiliation;
use App\Models\Entreprise;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

    public function affiliationsEnRejeter(): View|Factory|Application
    {
        $affiliations = Affiliation::where('etat', 'rejeter')->get();
        return view('admin.affiliations.rejeter', compact('affiliations'));
    }

    public function affiliationsEnApprouver(): View|Factory|Application
    {
        $affiliations = Affiliation::where('etat', 'accepter')->get();
        return view('admin.affiliations.accepter', compact('affiliations'));
    }

    public function confirmerRejet(Request $request, Affiliation $affiliation): RedirectResponse
    {
        // Validation de la raison
        $validated = $request->validate([
            'raison' => 'required|string|max:255',
        ]);

        // Envoi d'un email de rejet avec la raison
        $entreprise = $affiliation->entreprise;
        Mail::to($entreprise->email)->send(new RejectedMailAffiliation($entreprise, $validated['raison']));

        // Mise à jour de l'état à rejeté
        $affiliation->update(['etat' => 'rejeter']);
        // Redirection avec un message de succès
        return redirect()->route('admin.affiliations.attente')->with('success', 'La demande a été rejetée et l\'email a été envoyé.');
    }

    public function repondre(Request $request, Affiliation $affiliation)
    {
        $etat = $request->input('etat');

        // Si l'état est approuvé
        if ($etat == 'approuve') {
            // Génération d'un mot de passe aléatoire
            $generatedPassword = Str::random(10);

            // Envoi d'un email de félicitations avec le mot de passe
            $entreprise = $affiliation->entreprise;
            $number_affiliation = $affiliation->numero_affiliation;

            Mail::to($entreprise->email)->send(new ApprouveMailAffiliation($entreprise, $generatedPassword, $number_affiliation));

            // Mise à jour de l'état de l'affiliation
            $affiliation->update(['etat' => 'accepter']);
            $entreprise->password = Hash::make($generatedPassword);
            $entreprise->save();
            // Redirection avec un message de succès
            return redirect()->route('admin.affiliations.attente')->with('success', 'Demande approuvée et email envoyé avec le mot de passe.');
        }

        // Si l'état est rejeté, rediriger vers une vue pour saisir la raison du rejet
        if ($etat == 'rejete') {
            return view('admin.affiliations.rejet', compact('affiliation'));
        }
    }
}
