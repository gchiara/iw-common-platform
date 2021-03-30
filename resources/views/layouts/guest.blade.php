<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="og:url" content="https://data.integritywatch.eu" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Integrity Watch Data Hub" />
        <meta property="og:description" content="The Integrity Watch datahub is one of the largest databases on political integrity in Europe. Gain access to over 30 datasets, collected from 8 countries and 2 EU institutions on lobbying, political finance and provides an assets and interests declarations." />
        <meta property="og:image" content="https://data.integritywatch.eu/img/thumbnail.jpg" />

        <title>{{ config('app.name', 'Integrity Watch Data Hub') }}</title>

        <!-- Favicon -->
        <link rel='shortcut icon' type='image/x-icon' href='/img/favicon.ico' />

        <!-- Icons -->
        <script src="https://kit.fontawesome.com/663f4a7b53.js" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/main.css') }}">
        <link rel="stylesheet" href="{{ mix('css/cookie-consent.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
