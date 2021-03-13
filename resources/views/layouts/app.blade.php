<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fringilla libero ipsum, scelerisque efficitur nunc pharetra nec. Pellentesque mattis vestibulum elit ac lobortis. <a href="">Lorem Ipsum.</a>
                </div>
            </footer>
        </div>

        @stack('modals')
        @include('cookieConsent::index')

        @livewireScripts
    </body>
</html>
