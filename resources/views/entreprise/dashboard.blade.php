
@extends('entreprise.component.base')

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-black-blue mb-6">Tableau de bord</h2>

        <!-- État de l'affiliation -->
        <div class="bg-gray-100 p-4 rounded-lg mb-6">
            <h3 class="text-lg font-semibold text-black-blue">État de la demande d'affiliation</h3>
            @if($entreprise->affiliations)
                <p class="mt-2 text-sm">Votre demande est actuellement :
                    <span class="font-semibold">{{ $entreprise->affiliations->etat }}</span>
                </p>
            @else
                <p class="mt-2 text-sm text-red-500">Aucune demande d'affiliation soumise.</p>
            @endif
        </div>

        <!-- Liste des travailleurs -->
        <div class="bg-gray-100 p-4 rounded-lg mb-6">
            <h3 class="text-lg font-semibold text-black-blue">Liste des travailleurs</h3>
            @if($entreprise->travailleurs->count())
                <table class="w-full table-auto">
                    <thead>
                    <tr class="bg-my-green text-white">
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Poste</th>
                        <th class="px-4 py-2">Statut d'immatriculation</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($entreprise->travailleurs as $travailleur)
                        <tr class="bg-white border-b">
                            <td class="px-4 py-2">{{ $travailleur->nom }}</td>
                            <td class="px-4 py-2">{{ $travailleur->poste }}</td>
                            <td class="px-4 py-2">{{ $travailleur->statut_immatriculation ? 'Immatriculé' : 'Non immatriculé' }}</td>
                            <td class="px-4 py-2">
                                @if(!$travailleur->statut_immatriculation)
                                    <form action="{{ route('travailleur.immatriculer', $travailleur->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-my-green text-white py-1 px-3 rounded-md shadow hover:bg-green-600">Demander immatriculation</button>
                                    </form>
                                @else
                                    <span class="text-green-600">Déjà immatriculé</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-sm text-gray-500">Aucun travailleur enregistré pour le moment.</p>
            @endif
        </div>

        <!-- Ajouter un travailleur -->
        <div class="bg-gray-100 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-black-blue mb-4">Ajouter un travailleur</h3>
            <form action="{{ route('travailleur.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" id="nom" name="nom" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" required>
                </div>

                <div>
                    <label for="poste" class="block text-sm font-medium text-gray-700">Poste</label>
                    <input type="text" id="poste" name="poste" class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" required>
                </div>

                <button type="submit" class="w-full bg-my-green text-white py-2 px-4 rounded-md shadow hover:bg-green-600">Ajouter</button>
            </form>
        </div>
    </div>
@endsection
