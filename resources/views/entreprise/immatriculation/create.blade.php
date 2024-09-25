@extends('entreprise.components.base')
@include('entreprise.components.header')

@section('content')

    <div class="container mx-auto mt-40 mb-20 p-6 bg-white shadow-md rounded-lg max-w-xl">
        <h2 class="text-2xl font-bold text-black-blue mb-6">Demande immatriculation</h2>

        @if (session('success'))
            <div class="bg-my-green text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('immatriculation.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="nom" name="nom" value="{{ old('nom') }}" required>
                @error('nom')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Postnom -->
            <div>
                <label for="postnom" class="block text-sm font-medium text-gray-700">Postnom</label>
                <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="postnom" name="postnom" value="{{ old('postnom') }}" required>
                @error('postnom')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Prénom -->
            <div>
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                @error('prenom')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Genre -->
            <div>
                <label for="genre" class="block text-sm font-medium text-gray-700">Genre</label>
                <select class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="genre" name="genre" required>
                    <option value="">Choisir...</option>
                    <option value="M" {{ old('genre') == 'M' ? 'selected' : '' }}>Masculin</option>
                    <option value="F" {{ old('genre') == 'F' ? 'selected' : '' }}>Féminin</option>
                </select>
                @error('genre')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Lieu de naissance -->
            <div>
                <label for="lieu_naissance" class="block text-sm font-medium text-gray-700">Lieu de naissance</label>
                <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="lieu_naissance" name="lieu_naissance" value="{{ old('lieu_naissance') }}" required>
                @error('lieu_naissance')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Date de naissance -->
            <div>
                <label for="date_naissance" class="block text-sm font-medium text-gray-700">Date de naissance</label>
                <input type="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
                @error('date_naissance')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Adresse -->
            <div>
                <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="adresse" name="adresse" value="{{ old('adresse') }}" required>
                @error('adresse')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Téléphone -->
            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                @error('telephone')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Date d'embauche -->
            <div>
                <label for="date_embauche" class="block text-sm font-medium text-gray-700">Date d'embauche</label>
                <input type="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="date_embauche" name="date_embauche" value="{{ old('date_embauche') }}" required>
                @error('date_embauche')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Bouton de soumission -->
            <div>
                <button type="submit" class="w-full bg-my-green text-white py-2 px-4 rounded-md shadow hover:bg-green-600">Envoyer</button>
            </div>
        </form>
    </div>
@endsection

