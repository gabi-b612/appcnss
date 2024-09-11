<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title')</title>
        @vite('resources/css/app.css')
        @vite('resources/js/carousel.js')
    </head>
    <body>
    <header>
        @include('component.header')
    </header>
    <div class="container mx-auto mt-20 mb-10 p-5 bg-white shadow-md rounded-lg max-w-xl sm:max-w-md md:max-w-lg">
        @yield('content')
    </div>
    </body>
</html>
