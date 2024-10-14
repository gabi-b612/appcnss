@extends('admin.component.base')
@section('title', 'Acceuil-admin')


@include('admin.component.header')

@section('content')

    <div class=" mt-40 container mx-auto my-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">

            <!-- Bouton vers Toutes les employeurs -->
            <a href="{{route('admin.affiliations.accepter')}}" class="bg-my-green text-white text-xl font-bold py-10 px-4 rounded-lg shadow-lg text-center hover:bg-green-600 transition duration-300">
                Tous les employeurs
            </a>

            <!-- Bouton vers Toutes les demandes d'affiliations -->
            <a href="{{route('admin.affiliations.attente')}}" class="bg-my-green text-white text-xl font-bold py-10 px-4 rounded-lg shadow-lg text-center hover:bg-green-600 transition duration-300">
                Les demandes d'affiliation en attente
            </a>

            <!-- Bouton vers Les cotisations -->
            <a href="{{route('admin.affiliations.accepter')}}" class="bg-my-green text-white text-xl font-bold py-10 px-4 rounded-lg shadow-lg text-center hover:bg-green-600 transition duration-300">
                Les cotisations
            </a>

            <!-- Bouton vers Les cotisations -->
            <a href="{{route('admin.affiliations.rejeter')}}" class="bg-my-green text-white text-xl font-bold py-10 px-4 rounded-lg shadow-lg text-center hover:bg-green-600 transition duration-300">
                Les affiliations rejetées
            </a>
        </div>
    </div>
@endsection
