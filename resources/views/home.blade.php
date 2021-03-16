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
                        <img src="{{ asset('img/ti_eu_logo_white.png') }}" class="nav-logo" />
                    </div>
                    <div class="top-nav-right">
                        @if (Route::has('login'))
                            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
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
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent auctor, purus eu sagittis pulvinar, nisi tortor consequat tortor, sit amet fermentum nunc augue non nibh. Pellentesque nec semper tellus. Sed et pellentesque massa, quis vulputate orci. Aliquam tellus lorem, dapibus non leo ut, consequat malesuada tortor. Quisque consectetur, nunc et tempor suscipit, ligula erat tempus nisi, sit amet condimentum urna sapien in turpis. Pellentesque sodales porttitor ex sed tincidunt. Cras in nulla urna. Quisque nisi risus, mattis id sapien et, cursus congue velit. Proin lacus velit, maximus vitae felis in, mollis aliquet est. Nullam sit amet ligula dolor. Etiam in tellus eget leo dignissim condimentum.</p>
                    <p>Cras in justo at mi ultricies suscipit nec vitae lorem. Donec id vestibulum mauris. Suspendisse rhoncus libero at nunc vulputate scelerisque. Nulla ultrices aliquet lorem, et pulvinar massa pretium eget. Curabitur vulputate erat lorem. Integer id justo libero. Curabitur ultricies semper metus id pharetra. In ut erat consequat, pretium eros sed, mattis orci.</p>
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
                        <div class="landing-cta-text-main">Sign up or Log in</div>
                        <div class="landing-cta-text-secondary">to access our datasets database</div>
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
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fringilla libero ipsum, scelerisque efficitur nunc pharetra nec. Pellentesque mattis vestibulum elit ac lobortis. <a href="">Lorem Ipsum.</a>
            </div>            
        </footer>
        @include('cookieConsent::index')
    </body>
</html>
