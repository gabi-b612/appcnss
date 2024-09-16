<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EntrepriseController extends Controller
{
    public function showLoginForm(): View|Factory|Application
    {
        return view('entreprise.showLoginForm');
    }
    public function login(Request $request): RedirectResponse
    {
        // Valider les champs
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Récupérer l'entreprise par email
        $entreprise = Entreprise::where('email', $credentials['email'])->first();

        // Vérifier si l'entreprise existe et si le mot de passe est correct
        if ($entreprise && Hash::check($credentials['password'], $entreprise->password)) {
            // Générer le token avec Sanctum
            $token = $entreprise->createToken('auth_token')->plainTextToken;

            // Authentifier l'entreprise (session-based)
            Auth::login($entreprise);

            // Rediriger vers le dashboard après une authentification réussie
            return redirect()->route('entreprise.dashboard');
        }

        // Rediriger avec un message d'erreur si l'authentification échoue
        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ]);
    }
}
