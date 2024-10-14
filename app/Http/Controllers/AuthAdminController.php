<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Administrateur;
use App\Models\Entreprise;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthAdminController extends Controller
{
    public function login(): View|Factory|Application
    {
        return view('admin.login');
    }
    public function connexion(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return to_route('admin.login')->with('error', 'Email ou mot de pass invalide');
    }
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return to_route('admin.login');
    }
}
