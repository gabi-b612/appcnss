{{--@extends('admin.component.base')--}}
{{--@section('title', 'Déclarations Approuvées')--}}
{{--@include('admin.component.header')--}}

{{--@section('content')--}}
{{--    <div class="container mt-32 mx-auto px-4 py-8">--}}
{{--        <h1 class="text-2xl font-bold text-black-blue">Déclarations Approuvées pour {{ $entreprise->denomination }}</h1>--}}

{{--        @if($declarations->isEmpty())--}}
{{--            <p class="mt-4 text-gray-600">Aucune déclaration approuvée trouvée.</p>--}}
{{--        @else--}}
{{--            <div class="mt-6">--}}
{{--                <table class="min-w-full bg-white border-collapse">--}}
{{--                    <thead>--}}
{{--                    <tr class="bg-black-blue text-white">--}}
{{--                        <th class="py-2 px-4 border-b">Période Cotisée</th>--}}
{{--                        <th class="py-2 px-4 border-b">Montant Brut Imposable</th>--}}
{{--                        <th class="py-2 px-4 border-b">Montant Cotisé</th>--}}
{{--                        <th class="py-2 px-4 border-b">Date de Soumission</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach($declarations as $declaration)--}}
{{--                        <tr>--}}
{{--                            <td class="border px-4 py-2">{{ $declaration->periode_cotisee }}</td>--}}
{{--                            <td class="border px-4 py-2">{{ $declaration->montant_brut }}</td>--}}
{{--                            <td class="border px-4 py-2">{{ $declaration->montant_cotise }}</td>--}}
{{--                            <td class="border px-4 py-2">{{ $declaration->created_at->format('d/m/Y') }}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--@endsection--}}
@extends('admin.component.base')
@section('title', 'Déclarations Approuvées')
@include('admin.component.header')

@section('content')
    <div class="container mt-32 mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-black-blue">Déclarations Approuvées pour {{ $entreprise->denomination }}</h1>
        @if(session('success'))
            <div class="bg-my-green text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if($declarations->isEmpty())
            <p class="mt-4 text-gray-600">Aucune déclaration approuvée trouvée.</p>
        @else
            <div class="mt-6">
                <table class="min-w-full bg-white border-collapse">
                    <thead>
                    <tr class="bg-black-blue text-white">
                        <th class="py-2 px-4 border-b">Nom du Fichier</th>
                        <th class="py-2 px-4 border-b">Téléchargement</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($declarations as $declaration)
                        <tr>
                            <td class="border px-4 py-2">{{ $declaration->file_path }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('declaration.download', $declaration->id) }}" class="bg-my-green text-white px-4 py-2 rounded">
                                    Télécharger
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
