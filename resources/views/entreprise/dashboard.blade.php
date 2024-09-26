@extends('entreprise.components.base')
@section('title', 'Accueil-Entreprise')


@include('entreprise.components.header')

@section('content')
    <div class=" mt-40 container mx-auto my-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">

            <!-- Bouton vers Toutes les employeurs -->
            <a href="{{route('entreprise.immatriculation.approuver')}}" class="bg-my-green text-white text-xl font-bold py-10 px-4 rounded-lg shadow-lg text-center hover:bg-green-600 transition duration-300">
                Mes Travailleurs immatriculés
            </a>
            <!-- Bouton vers Les cotisations -->
            <a href="{{route('declaration.declarer')}}" class="bg-my-green text-white text-xl font-bold py-10 px-4 rounded-lg shadow-lg text-center hover:bg-green-600 transition duration-300">
                Declarer cotisation
            </a>
            <!-- Bouton vers Toutes les demandes d'immatriculation -->
            <a href="{{ route('immatriculation.create') }}" class="bg-my-green text-white text-xl font-bold py-10 px-4 rounded-lg shadow-lg text-center hover:bg-green-600 transition duration-300">
                Faire une demande d'immatriculation
            </a>
            <!-- Bouton vers Toutes les demandes d'immatriculation -->
            <a href="{{route('entreprise.immatriculation.attente')}}" class="bg-my-green text-white text-xl font-bold py-10 px-4 rounded-lg shadow-lg text-center hover:bg-green-600 transition duration-300">
                Les demandes d'immatriculation en attente
            </a>
            <!-- Bouton vers Toutes les demandes d'immatriculation -->
            <a href="{{route('entreprise.immatriculation.rejeter')}}" class="bg-my-green text-white text-xl font-bold py-10 px-4 rounded-lg shadow-lg text-center hover:bg-green-600 transition duration-300">
                Les demandes d'immatriculation rejetées
            </a>
        </div>
    </div>
@endsection
