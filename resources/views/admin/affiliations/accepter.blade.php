
@extends('admin.component.base')
@include('admin.component.header')


@section('content')
    <div class="container mt-40  mx-auto my-10">
        <h1 class="text-2xl font-bold mb-5">Affiliations</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Dénomination</th>
                <th class="py-2 px-4 border-b">Adresse</th>
                <th class="py-2 px-4 border-b">Téléphone</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Documents</th>
                <th class="py-2 px-4 border-b">État</th>
            </tr>
            </thead>
            <tbody>
            @foreach($affiliations as $affiliation)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $affiliation->entreprise->denomination }}</td>
                    <td class="py-2 px-4 border-b">{{ $affiliation->entreprise->adresse }}</td>
                    <td class="py-2 px-4 border-b">{{ $affiliation->entreprise->telephone }}</td>
                    <td class="py-2 px-4 border-b">{{ $affiliation->entreprise->email }}</td>
                    <td class="py-2 px-4 border-b">
                        <!-- Lien pour visualiser le document RCCM -->
                        <a href="{{ asset('storage/' . $affiliation->document_rccm) }}" target="_blank" class="text-blue-600 hover:underline">RCCM</a><br>

                        <!-- Lien pour visualiser le document juridique -->
                        <a href="{{ asset('storage/' . $affiliation->document_juridique) }}" target="_blank" class="text-blue-600 hover:underline">Document juridique</a><br>

                        <!-- Lien pour visualiser le document ID national -->
                        <a href="{{ asset('storage/' . $affiliation->document_id_national) }}" target="_blank" class="text-blue-600 hover:underline">ID National</a>
                    </td>
                    <td class="py-2 px-4 border-b">{{ ucfirst($affiliation->etat) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
