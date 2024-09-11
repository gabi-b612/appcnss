
@extends('component.base')

@section('content')
    <div class="container mx-auto mt-40 mb-20 p-6 bg-white shadow-md rounded-lg max-w-xl">
        <h2 class="text-2xl font-bold text-black-blue mb-6">Demande d'affiliation</h2>

        @if (session('success'))
            <div class="bg-my-green text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('affiliation.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Dénomination -->
            <div>
                <label for="denomination" class="block text-sm font-medium text-gray-700">Dénomination</label>
                <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="denomination" name="denomination" value="{{ old('denomination') }}" required>
                @error('denomination')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Adresse -->
            <div>
                <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="adresse" name="adresse" value="{{ old('adresse') }}" required>
                @error('adresse')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Téléphone -->
            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                @error('telephone')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- E-mail -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Forme juridique -->
            <div>
                <label for="forme_juridique" class="block text-sm font-medium text-gray-700">Forme juridique</label>
                <select class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="forme_juridique" name="forme_juridique" required>
                    <option value="">Choisir...</option>
                    <option value="S.A.R.L." {{ old('forme_juridique') == 'S.A.R.L.' ? 'selected' : '' }}>S.A.R.L.</option>
                    <option value="S.A." {{ old('forme_juridique') == 'S.A.' ? 'selected' : '' }}>S.A.</option>
                    <option value="A.S.B.L." {{ old('forme_juridique') == 'A.S.B.L.' ? 'selected' : '' }}>A.S.B.L.</option>
                    <option value="ETS." {{ old('forme_juridique') == 'ETS.' ? 'selected' : '' }}>ETS.</option>
                </select>
                @error('forme_juridique')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-my-green focus:border-my-green sm:text-sm" id="password" name="password" required>
                @error('password')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Document RCCM -->
            <div>
                <label for="document_rccm" class="block text-sm font-medium text-gray-700">Document RCCM (PDF)</label>
                <input type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-my-green file:text-white hover:file:bg-green-600" id="document_rccm" name="document_rccm" accept="application/pdf" required>
                @error('document_rccm')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-my-green text-white py-2 px-4 rounded-md shadow hover:bg-green-600">Soumettre la demande</button>
            </div>

        </form>
    </div>
@endsection
