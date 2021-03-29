<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Icons -->
        <script src="https://kit.fontawesome.com/663f4a7b53.js" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/landing.css') }}">
        <link rel="stylesheet" href="{{ mix('css/cookie-consent.css') }}">

    </head>
    <body class="antialiased">

        <div class="landing-top-container">
            <!-- TOP BAR -->
            <div class="top-nav">
                <div class="grid grid-cols-2">
                    <div class="top-nav-left">
                        <img src="{{ asset('img/ti_logo.png') }}" class="nav-logo" />
                    </div>
                    <div class="top-nav-right">
                        @if (Route::has('login'))
                            <div class="absolute top-0 right-0 px-6 py-4 sm:block">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm text-white">View Datasets</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm text-white">Login</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 text-sm text-white">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- INFO AREA -->
            <div class="landing-info-area">
                <h1>Integrity Watch</h1>
                <div class="description-text">
                    <p>Integrity Watch is a set of user-friendly online tools that allow citizens, journalists, and civil society to monitor political integrity in their institutions. For this purpose, data on lobby meetings, financial interests of public officials, political finance and public procurement that is often scattered and difficult to access is collected, harmonised, and made easily available.</p> 
                    <p>The platforms allow you to search, rank and filter the information in an intuitive way. Thereby Integrity Watch contributes to increasing transparency, integrity, and equality of access to decision-making and to monitor for potential conflicts of interest, undue influence or even corruption.</p>
                    <p>This central hub will provide you with an overview of all existing Integrity Watch platforms deployed across the world. Are you a researcher, civil society activist, journalist or curious about the original datasets powering our Integrity Watch platforms? Register now to join the fight against political corruption and gain access to one of the largest databases on political integrity in Europe!</p> 
                </div>
                <div class="landing-info-btn">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="landing-btn yellow-btn">View Datasets <i class="fas fa-chevron-right"></i></a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="landing-btn yellow-btn">Register <i class="fas fa-chevron-right"></i></a>
                            @else
                                <a href="{{ route('login') }}" class="landing-btn yellow-btn">Login <i class="fas fa-chevron-right"></i></a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
            <!-- CTA -->
            <div class="landing-cta-container">
                <div class="landing-cta-text">
                    <div class="landing-cta-text-inner">
                        @auth
                            <div class="landing-cta-text-main">Welcome</div>
                            <div class="landing-cta-text-secondary">to the Integrity Watch datahub!</div>
                        @else
                            <div class="landing-cta-text-main">Sign up or Log in</div>
                            <div class="landing-cta-text-secondary">to access the Integrity Watch datahub!</div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <div class="landing-grid-container">
            <div class="platform-boxes-container">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($platforms->sortBy('order') as $platform)
                    <div class="platform-box">
                        <img src="/storage/images/{{ $platform->image_path }}" class="platform-box-img" />
                        <div class="platform-box-text-container">
                            <div class="platform-box-title">{{$platform->title}}</div>
                            <div class="platform-box-description">{{$platform->description}}</div>
                            <div class="platform-box-link">
                                <a href="{{$platform->url}}" class="landing-btn" target="_blank">View site <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <footer>
            <div class="footer-inner">
                <a href="https://integritywatch.eu/privacy-policy.pdf" target="_blank">Privacy policy</a> | For any question, please contact: <a href="mailto:datahub@transparency.org">datahub@transparency.org</a><br />
                <div>Platform developed by <a href="http://www.chiaragirardelli.net" target="_blank">Chiara Girardelli</a> and Transparency International EU</div>
                <div class="footer-eu-funding">
                    <img src="img/flag_yellow_low.jpg" />
                    <div class="text">This online platform was funded by the European Union’s Internal Security Fund – Police</div>
                </div>
            </div>            
        </footer>
        @include('cookieConsent::index')
    </body>
</html>
