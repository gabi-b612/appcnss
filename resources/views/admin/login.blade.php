@extends('admin.component.base')

@section('content')
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
            <h1 class="text-2xl font-bold text-center text-black-blue mb-4">Connexion Administrateur</h1>
            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Adresse Email</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded"
                           value="{{ old('email') }}" required autofocus>
                    @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Mot de Passe</label>
                    <input type="password" id="password" name="password"
                           class="w-full px-3 py-2 border border-gray-300 rounded" required>
                    @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                            class="w-full bg-my-green text-white py-2 rounded hover:bg-green-700 transition duration-300">
                        Connexion
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
