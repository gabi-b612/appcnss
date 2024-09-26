@extends('entreprise.components.base')
@section('title', 'Envoi Fichier Excel')

@include('entreprise.components.header')

@section('content')

    <div class="container mx-auto mt-40 mb-20 p-6 bg-white shadow-md rounded-lg max-w-xl">
        <h2 class="text-2xl font-bold text-black-blue mb-6">Envoyer le fichier de déclaration</h2>

        @if (session('success'))
            <div class="bg-my-green text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('declaration.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Sélectionner le fichier -->
            <div>
                <label for="excel_file" class="block text-sm font-medium text-gray-700">Choisir le fichier Excel</label>
                <input type="file" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="file" name="file" accept=".xlsx,.xls" required>
                @error('excel_file')
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
