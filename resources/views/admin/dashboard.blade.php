@extends('admin.component.base')

@include('admin.component.header')

@section('content')
    <div class=" mt-40 container mx-auto my-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">

            <!-- Bouton vers Toutes les employeurs -->
            <a href="{{route('admin.affiliations.accepter')}}" class="bg-my-green text-white text-xl font-bold py-10 px-4 rounded-lg shadow-lg text-center hover:bg-green-600 transition duration-300">
                Toutes les employeurs
            </a>

            <!-- Bouton vers Toutes les demandes d'affiliations -->
            <a href="{{route('admin.affiliations.attente')}}" class="bg-my-green text-white text-xl font-bold py-10 px-4 rounded-lg shadow-lg text-center hover:bg-green-600 transition duration-300">
                Les demandes d'affiliations
            </a>

            <!-- Bouton vers Toutes les demandes d'immatriculation -->
            <a href="" class="bg-my-green text-white text-xl font-bold py-10 px-4 rounded-lg shadow-lg text-center hover:bg-green-600 transition duration-300">
                Les demandes d'immatriculation
            </a>

            <!-- Bouton vers Les cotisations -->
            <a href="" class="bg-my-green text-white text-xl font-bold py-10 px-4 rounded-lg shadow-lg text-center hover:bg-green-600 transition duration-300">
                Les cotisations
            </a>
        </div>
    </div>
@endsection
