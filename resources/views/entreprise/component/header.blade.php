<header class="bg-my-green text-white shadow-md">
    <div class="container mx-auto p-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="text-2xl font-bold">
            <a href="{{ route('entreprise.dashboard') }}">Mon Entreprise</a>
        </div>

        <!-- Navbar -->
        <nav class="flex space-x-6">
            <a href="{{ route('entreprise.dashboard') }}" class="hover:text-gray-200">Tableau de bord</a>
            <a href="#" class="hover:text-gray-200">Profil</a>
            <a href="#" class="hover:text-gray-200">Support</a>

            <!-- Déconnexion -->
            <form action="{{ route('entreprise.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="hover:text-gray-200">Déconnexion</button>
            </form>
        </nav>
    </div>
</header>
