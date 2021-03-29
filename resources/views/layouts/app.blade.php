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
        <meta property="og:description" content="" />
        <meta property="og:image" content="https://data.integritywatch.eu/img/thumbnail.jpg" />

        <title>{{ config('app.name', 'Integrity Watch Data Hub') }}</title>

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

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="antialiased">
        <div class="flex flex-col h-screen justify-between min-h-screen bg-gray-100">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            <header class="page-header shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main class="page-content-main mb-auto">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer>
                <div class="footer-inner max-w-7xl mx-auto">
                    <a href="https://integritywatch.eu/privacy-policy.pdf" target="_blank">Privacy policy</a> | For any question, please contact: <a href="mailto:datahub@transparency.org">datahub@transparency.org</a><br />
                    <div>Platform developed by <a href="http://www.chiaragirardelli.net" target="_blank">Chiara Girardelli</a> and Transparency International EU</div>
                    <div class="footer-eu-funding">
                        <img src="img/flag_yellow_low.jpg" />
                        <div class="text">This online platform was funded by the European Union’s Internal Security Fund – Police</div>
                    </div>
                </div>
            </footer>
        </div>

        @stack('modals')
        @include('cookieConsent::index')

        @livewireScripts
    </body>
</html>
