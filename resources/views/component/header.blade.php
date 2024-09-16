
<header class="fixed w-full top-0 bg-white shadow-md z-50">
    <div class="bg-gradient-to-r from-blue-950 to-my-green text-white p-4 flex justify-center items-center gap-10">
        <div class="flex flex-row items-center space-x-4">
            <span class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.78L3 18v-2l4.35-2.63L3 12V8zM21 8v4l-7.89-4.78L21 8zM5 8v2l4.35 2.63L5 15v2l7-4.23L5 8zm10 0v4l7-4.23V8l-7 4.23z" />
                </svg>
                <span>+243 996 030 210</span>
            </span>
                <span class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.6 10.8A5.001 5.001 0 0112 17a5.001 5.001 0 01-4.6-6.2L12 8l4.6 2.8z" />
                </svg>
                <span>contact@cnss.cd</span>
            </span>
                <span class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.9l4.15-4.15a.5.5 0 01.85.35V12.5a1.5 1.5 0 01-1.5 1.5H5.5a1.5 1.5 0 01-1.5-1.5V5.5A1.5 1.5 0 015.5 4h7a.5.5 0 01.35.85L12 6.9zm0 3.2l3.85 3.85a.5.5 0 01-.35.85H5.5a.5.5 0 01-.35-.85L12 10.1z" />
                </svg>
                <span>95, Boulevard du 30 Juin B.P. 8933 Kinshasa 1 - RDC</span>
            </span>
        </div>
        <div class="flex space-x-4">
            <div class="flex items-center space-x-4">
                <img src="{{asset('img/logo_rdc.png')}}" alt="Logo CNSS" class="h-8">
            </div>
        </div>
    </div>

    <nav class="p-4 flex justify-center items-center gap-10">
        <div class="flex items-center space-x-4 ">
            <img src="{{asset('img/logo-CNSS.png')}}" alt="Logo CNSS" class="h-10 ">
        </div>
        <div class="flex space-x-5 items-center ">
            <a href="{{route('index')}}" class="text-green-400 font-semibold text-lg gap-2">Accueil</a>
            <div class="relative group">
                <a href="#" class="text-gray-800 hover:text-green-600 font-semibold">Employeur</a>
                <ul class="absolute hidden group-hover:block bg-white shadow-md mt-2 rounded">
                    <li>
                        <a href="{{route('affiliation.create')}}" class="block px-4 py-2 text-gray-800 hover:text-my-green">Demande d'affiliation</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:text-my-green">Demande d'immatriculation</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:text-my-green">Declarer le versement</a>
                    </li>
                    <li>
                        <a href="{{route('entreprise.showLoginForm')}}" class="block px-4 py-2 text-gray-800 hover:text-my-green">Se connecter</a>
                    </li>
                </ul>
            </div>
            <div class="relative group">
                <a href="#" class="text-gray-800 hover:text-my-green font-semibold">Travailleur</a>
                <div class="absolute hidden group-hover:block bg-white shadow-md mt-2 rounded">
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:text-my-green">Mon compte</a>
                </div>
            </div>
            <a href="#" class="text-gray-800 hover:text-my-green font-semibold">Contact</a>
        </div>
    </nav>
</header>
