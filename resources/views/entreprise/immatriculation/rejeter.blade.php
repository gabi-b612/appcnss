
@extends('entreprise.components.base')
@section('title', 'Immatriculation-rejeter')

@include('entreprise.components.header')

@section('content')
    <div class="container mx-auto mt-32 px-4 py-8">
        <h1 class="text-2xl font-bold text-black-blue">Immatriculations Rejetées</h1>

        @if(session('success'))
            <div class="bg-my-green text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($immatriculations->isEmpty())
            <p class="mt-4 text-gray-600">Aucune immatriculation rejetée.</p>
        @else
            <div class="mt-6">
                <table class="min-w-full bg-white border-collapse">
                    <thead>
                    <tr class="bg-black-blue text-white">
                        <th class="py-2 px-4 border-b">Nom</th>
                        <th class="py-2 px-4 border-b">Postnom</th>
                        <th class="py-2 px-4 border-b">Prénom</th>
                        <th class="py-2 px-4 border-b">Genre</th>
                        <th class="py-2 px-4 border-b">État</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($immatriculations as $immatriculation)
                        @if($immatriculation->etat == 'rejeter')
                            <tr>
                                @if($immatriculation->travailleur)
                                    <td class="border px-4 py-2">{{ $immatriculation->travailleur->nom }}</td>
                                    <td class="border px-4 py-2">{{ $immatriculation->travailleur->postnom }}</td>
                                    <td class="border px-4 py-2">{{ $immatriculation->travailleur->prenom }}</td>
                                    <td class="border px-4 py-2">{{ $immatriculation->travailleur->genre }}</td>
                                @else
                                    <td class="border px-4 py-2" colspan="4" class="text-red-500">Aucun travailleur associé</td>
                                @endif
                                <td class="border px-4 py-2">{{ ucfirst($immatriculation->etat) }}</td>
                                <td class="border px-4 py-2">
                                    <!-- Bouton pour afficher/masquer les détails -->
                                    <button class="bg-my-green text-white px-4 py-2 rounded" onclick="toggleDetails({{ $immatriculation->id }})">
                                        Afficher les détails
                                    </button>
                                </td>
                            </tr>
                            <!-- Détails masqués -->
                            <tr id="details-{{ $immatriculation->id }}" class="hidden">
                                <td colspan="7" class="border px-4 py-2 bg-gray-100">
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold">Détails du travailleur :</h3>
                                        @if($immatriculation->travailleur)
                                            <p><strong>Nom :</strong> {{ $immatriculation->travailleur->nom }}</p>
                                            <p><strong>Postnom :</strong> {{ $immatriculation->travailleur->postnom }}</p>
                                            <p><strong>Prénom :</strong> {{ $immatriculation->travailleur->prenom }}</p>
                                            <p><strong>Genre :</strong> {{ $immatriculation->travailleur->genre }}</p>
                                            <p><strong>Date de naissance :</strong> {{ $immatriculation->travailleur->date_naissance }}</p>
                                            <p><strong>Lieu de naissance :</strong> {{ $immatriculation->travailleur->lieu_naissance }}</p>
                                            <p><strong>Adresse :</strong> {{ $immatriculation->travailleur->adresse }}</p>
                                            <p><strong>Téléphone :</strong> {{ $immatriculation->travailleur->telephone }}</p>
                                            <p><strong>Email :</strong> {{ $immatriculation->travailleur->email }}</p>
                                            <p><strong>Date d'embauche :</strong> {{ $immatriculation->travailleur->date_embauche }}</p>
                                        @else
                                            <p class="text-red-500">Aucun travailleur associé à cette immatriculation.</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        function toggleDetails(id) {
            var detailsRow = document.getElementById('details-' + id);
            if (detailsRow.classList.contains('hidden')) {
                detailsRow.classList.remove('hidden');
            } else {
                detailsRow.classList.add('hidden');
            }
        }
    </script>

@endsection
