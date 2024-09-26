<?php

namespace App\Http\Controllers;

use App\Mail\ApprouveMailAffiliation;
use App\Mail\ImmatriculationStatusMail;
use App\Mail\RejectedMailAffiliation;
use App\Models\Entreprise;
use App\Models\Immatriculation;
use App\Models\Travailleur;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ImmatriculationController extends Controller
{
    public function create(): View|Factory|Application
    {
        return view('entreprise.immatriculation.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'postnom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'genre' => 'required|in:M,F',
            'lieu_naissance' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|unique:travailleurs,email',
            'date_embauche' => 'required|date',
        ]);

        // Récupérer l'entreprise de l'utilisateur connecté
        $entreprise = Auth::user();

        // Créer le travailleur en liant l'entreprise
        $travailleur = Travailleur::create([
            'entreprise_id' => $entreprise->id, // L'entreprise de l'utilisateur connecté
            'nom' => $validated['nom'],
            'postnom' => $validated['postnom'],
            'prenom' => $validated['prenom'],
            'genre' => $validated['genre'],
            'lieu_naissance' => $validated['lieu_naissance'],
            'date_naissance' => $validated['date_naissance'],
            'adresse' => $validated['adresse'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
            'date_embauche' => $validated['date_embauche'],
        ]);

        $numero_matricule = substr($entreprise->denomination, 0, 3) . substr($validated['nom'], 0, 3) . substr($validated['postnom'], 0, 3) . $travailleur->id;
        Immatriculation::create([
           'travailleur_id' => $travailleur->id,
           'etat' => 'en attente',
           'numero_immatriculation' => $numero_matricule,
        ]);

        // Rediriger vers la liste des travailleurs ou une page de confirmation
        return redirect()->route('immatriculation.create')->with('success', 'La demande a ete soumise avec succès');
    }

    public function immatriculationsEnAttente(): View|Factory|Application
    {
        $immatriculations = Immatriculation::where('etat', 'en attente')->get();
        return view('admin.immatriculation.attente', compact('immatriculations'));
    }

    public function immatriculationsEnRejeter(): View|Factory|Application
    {
        $immatriculations = Immatriculation::where('etat', 'rejeter')->get();
        return view('admin.immatriculation.rejeter', compact('immatriculations'));
    }

    public function immatriculationsEnApprouver(): View|Factory|Application
    {
        $immatriculations = Immatriculation::where('etat', 'accepter')->get();
        return view('admin.immatriculation.accepter', compact('immatriculations'));
    }

    public function showImmatriculations(Entreprise $entreprise): View|Factory|Application
    {
        // Récupérer les immatriculations des travailleurs de cette entreprise
        $immatriculations = Immatriculation::whereHas('travailleur', function($query) use ($entreprise) {
            $query->where('entreprise_id', $entreprise->id)->where('etat', 'en attente');
        })->get();

        return view('admin.immatriculation.attente', compact('entreprise', 'immatriculations'));
    }

    public function showImmatriculationsRejeter(Entreprise $entreprise): View|Factory|Application
    {
        // Récupérer les immatriculations des travailleurs de cette entreprise
        $immatriculations = Immatriculation::whereHas('travailleur', function($query) use ($entreprise) {
            $query->where('entreprise_id', $entreprise->id)->where('etat', 'rejeter');
        })->get();

        return view('admin.immatriculation.rejeter', compact('entreprise', 'immatriculations'));
    }

    public function showImmatriculationsApprouver(Entreprise $entreprise): View|Factory|Application
    {
        // Récupérer les immatriculations des travailleurs de cette entreprise
        $immatriculations = Immatriculation::whereHas('travailleur', function($query) use ($entreprise) {
            $query->where('entreprise_id', $entreprise->id)->where('etat', 'accepter');
        })->get();

        return view('admin.immatriculation.accepter', compact('entreprise', 'immatriculations'));
    }

    public function confirmerRejet(Request $request, Immatriculation $immatriculation): RedirectResponse
    {
        // Validation de la raison
        $validated = $request->validate([
            'raison' => 'required|string|max:255',
        ]);

        // Envoi d'un email de rejet avec la raison
        Mail::to($immatriculation->travailleur->entreprise->email)->send(
            new ImmatriculationStatusMail(
                $immatriculation->travailleur->entreprise,$immatriculation->travailleur->nom . ' ' . $immatriculation->travailleur->postnom . ' ' . $immatriculation->travailleur->prenom,
                '00000','0000','rejeter', motif: $validated['raison']));


        // Mise à jour de l'état à rejeté
        $immatriculation->update(['etat' => 'rejeter']);
        // Redirection avec un message de succès
        return redirect()->route('admin.immatriculations', $immatriculation->travailleur->entreprise->id)->with('success', 'La demande a été rejetée et l\'email a été envoyé.');

    }

    public function repondre(Request $request, Immatriculation $immatriculation, Entreprise $entreprise)
    {
        $etat = $request->input('etat');

        if ($etat == 'approuve') {
            $travailleur = $immatriculation->travailleur;
            $generatedPassword = Str::random(10);

            // Hacher le mot de passe
            $hashedPassword = Hash::make($generatedPassword);
            // Générer un numéro de matricule unique
            $numero_matricule = substr($travailleur->entreprise->denomination, 0, 3) . substr($travailleur->nom, 0, 3) . substr($travailleur->postnom, 0, 3) . $travailleur->id;

            // Envoyer un email de confirmation à l'entreprise avec les informations de l'immatriculation et du mot de passe
            Mail::to($travailleur->entreprise->email)->send(new ImmatriculationStatusMail($entreprise,$travailleur,$numero_matricule,$generatedPassword,'accepter'));

            // Mettre à jour le travailleur avec le mot de passe généré

            $travailleur->update([
                'password' => $hashedPassword
            ]);

            $travailleur->update([
                'matricule' => $numero_matricule
            ]);

            $immatriculation->update([
                'numero_immatriculation' => $numero_matricule
            ]);
            $immatriculation->update([
                'etat' => 'accepter'
            ]);
            return redirect()->route('admin.immatriculations', $travailleur->entreprise->id)->with('success', 'Demande approuvée et email envoyé avec le mot de passe.');
        }
        if ($etat == 'rejete') {
            return view('admin.immatriculation.rejet', compact('immatriculation'));
        }
    }

}
