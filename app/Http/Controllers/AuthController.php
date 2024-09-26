<?php
namespace App\Http\Controllers;

use App\Models\Travailleur;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Entreprise;
use App\Models\Administrateur;

class AuthController extends Controller
{
    public function showLoginForm(): View|Factory|Application
    {
        return view('auth.login');
    }
    public function login(Request $request): RedirectResponse
    {
        // Valider les champs
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'type' => 'required|in:administrateur,entreprise,travailleur', // Ajoute un champ pour le type d'utilisateur
        ]);

        if ($credentials['type'] === 'entreprise') {
            $user = Entreprise::where('email', $credentials['email'])->first();
            if ($user && Hash::check($credentials['password'], $user->password)) {
                Auth::guard('entreprise')->login($user);
                $request->session()->regenerate();
                return redirect()->intended(route('entreprise.dashboard'));
            }
        } elseif ($credentials['type'] === 'administrateur') {
            $user = Administrateur::where('email', $credentials['email'])->first();
            if ($user && Hash::check($credentials['password'], $user->password)) {
                Auth::guard('administrateur')->login($user);
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard'));
            }
        } else {
            $user = Travailleur::where('email', $credentials['email'])->first();
            if ($user && Hash::check($credentials['password'], $user->password)) {
                Auth::guard('travailleur')->login($user);
                $request->session()->regenerate();
                return redirect()->intended(route('cotisations.index'));
            }
        }

        // Rediriger avec un message d'erreur si l'authentification échoue
        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ]);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
