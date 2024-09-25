@extends('admin.component.base')
@section('title', 'Affiliation-approuver')
@include('admin.component.header')

@section('content')
    <div class="container mt-32 mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-black-blue">Toutes les affiliations</h1>

        @if(session('success'))
            <div class="bg-my-green text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($affiliations->isEmpty())
            <p class="mt-4 text-gray-600">Aucune affiliation trouvée.</p>
        @else
            <div class="mt-6">
                <table class="min-w-full bg-white border-collapse">
                    <thead>
                    <tr class="bg-black-blue text-white">
                        <th class="py-2 px-4 border-b">Dénomination</th>
                        <th class="py-2 px-4 border-b">Adresse</th>
                        <th class="py-2 px-4 border-b">Téléphone</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Documents</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($affiliations as $affiliation)
                        <tr>
                            <td class="border px-4 py-2">{{ $affiliation->entreprise->denomination }}</td>
                            <td class="border px-4 py-2">{{ $affiliation->entreprise->adresse }}</td>
                            <td class="border px-4 py-2">{{ $affiliation->entreprise->telephone }}</td>
                            <td class="border px-4 py-2">{{ $affiliation->entreprise->email }}</td>
                            <td class="py-2 px-4 border-b">
                                <!-- Lien pour visualiser le document RCCM -->
                                <a href="{{ asset('storage/' . $affiliation->document_rccm) }}" target="_blank" class="text-blue-600 hover:underline">RCCM</a><br>

                                <!-- Lien pour visualiser le document juridique -->
                                <a href="{{ asset('storage/' . $affiliation->document_juridique) }}" target="_blank" class="text-blue-600 hover:underline">Document juridique</a><br>

                                <!-- Lien pour visualiser le document ID national -->
                                <a href="{{ asset('storage/' . $affiliation->document_id_national) }}" target="_blank" class="text-blue-600 hover:underline">ID National</a>
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('admin.immatriculations', $affiliation->entreprise->id) }}" class="bg-my-green text-white px-4 py-2 rounded">
                                    Voir les immatriculations
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
