
@extends('admin.component.base')
@section('title', 'Rejeter-affiliation')
@include('admin.component.header')

@section('content')
    <div class="container mt-40 mx-auto my-10">
        <h1 class="text-2xl font-bold mb-5">Raison du rejet pour {{ $affiliation->entreprise->denomination }}</h1>

        <form action="{{ route('admin.affiliations.rejet', $affiliation) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="raison" class="block text-gray-700">Raison du rejet</label>
                <textarea name="raison" id="raison" rows="5" class="w-full border-gray-300 p-2 rounded" required></textarea>
            </div>
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">
                Envoyer la raison par mail
            </button>
        </form>
    </div>
@endsection
