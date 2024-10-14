
@extends('admin.component.base')
@include('admin.component.header')

@section('content')
    <div class="container mt-40 mx-auto my-10">
        <h1 class="text-2xl font-bold mb-5">Rejet de l'immatriculation de {{ $immatriculation->travailleur->nom }}</h1>

        <form action="{{ route('admin.immatriculations.rejet', $immatriculation) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="raison" class="block text-gray-700">Motif du rejet</label>
                <textarea name="raison" id="raison" rows="5" class="w-full border-gray-300 p-2 rounded" required></textarea>
            </div>
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">
                Envoyer la raison par mail
            </button>
        </form>
    </div>
@endsection
