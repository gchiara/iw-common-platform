<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-XFYX71290M"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-XFYX71290M');
        </script>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="og:url" content="https://data.integritywatch.eu" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Integrity Watch Data Hub" />
        <meta property="og:description" content="The Integrity Watch Data Hub is one of the largest databases on political integrity in Europe. Gain access to over 30 datasets, collected from 8 countries and 2 EU institutions on lobbying, political finance and provides an assets and interests declarations." />
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
                Neither the European Union institutions and bodies nor any person acting on their behalf may be held responsible for the use which may be made of the information contained therein.<br />
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
