@extends('travailleur.components.base')
@section('title', 'Mes Cotisations')
@include('travailleur.components.header')

@section('content')
    <div class="container mt-32 mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-black-blue">Mes Cotisations</h1>

        @if(session('success'))
            <div class="bg-my-green text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($cotisations->isEmpty())
            <p class="mt-4 text-gray-600">Aucune cotisation trouvée.</p>
        @else
            <div class="mt-6">
                <table class="min-w-full bg-white border-collapse">
                    <thead>
                    <tr class="bg-black-blue text-white">
                        <th class="py-2  px-4 border-b">ID Déclaration</th>
                        <th class="py-2  px-4 border-b">Immatriculation</th>
                        <th class="py-2 px-4 border-b">Période</th>
                        <th class="py-2 px-4 border-b">Montant Brut</th>
                        <th class="py-2 px-4 border-b">Montant Cotisé</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cotisations as $cotisation)
                        <tr>
                            <td class="border justify-center px-4 py-2">{{ $cotisation->declaration_id }}</td>
                            <td class="border justify-center px-4 py-2">{{ $cotisation->travailleur->matricule }}</td>
                            <td class="border justify-center px-4 py-2">{{ $cotisation->periode }}</td>
                            <td class="border justify-center px-4 py-2">{{ $cotisation->montant_brut }}</td>
                            <td class="border justify-center px-4 py-2">{{ $cotisation->montant_cotiser }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
