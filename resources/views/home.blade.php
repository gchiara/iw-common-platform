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
        <meta property="og:url" content="https://data.integritywatch.eu" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Integrity Watch Data Hub" />
        <meta property="og:description" content="The Integrity Watch Data Hub is one of the largest databases on political integrity in Europe. Gain access to over 30 datasets, collected from 8 countries and 2 EU institutions on lobbying, political finance and provides an assets and interests declarations." />
        <meta property="og:image" content="https://data.integritywatch.eu/img/thumbnail.jpg" />

        <title>Integrity Watch Data Hub</title>

        <!-- Favicon -->
        <link rel='shortcut icon' type='image/x-icon' href='/img/favicon.ico' />

        <!-- Icons -->
        <script src="https://kit.fontawesome.com/663f4a7b53.js" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

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
                <h2>Welcome to the Integrity Watch <span class="yellow-text">DataHub!</span></h2>
                <div class="description-text">
                    <p>Integrity Watch is a set of user-friendly online tools that allow citizens, journalists, and civil society to monitor political integrity in their institutions. For this purpose, data on lobby meetings, financial interests of public officials, political finance and public procurement that is often scattered and difficult to access is collected, harmonised, and made easily available.</p> 
                    <p>The platforms allow you to search, rank and filter the information in an intuitive way. Thereby Integrity Watch contributes to increasing transparency, integrity, and equality of access to decision-making and to monitor for potential conflicts of interest, undue influence or even corruption.</p>
                    <p>This central hub will provide you with an overview of all existing Integrity Watch platforms deployed across the world. Are you a researcher, civil society activist, journalist or curious about the original datasets powering our Integrity Watch platforms? Register now to join the fight against political corruption and gain access to one of the largest databases on political integrity in Europe!</p> 
                </div>
                <div class="landing-info-btn">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="landing-btn yellow-btn">View the datasets <i class="fas fa-chevron-right"></i></a>
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
        </div>

        <!-- MAP -->
        <script src="https://d3js.org/d3.v7.min.js"></script>
        <script>
            const platforms = @json(
                $platforms->map(function ($d) {
                    return [
                        'title' => $d->title,
                        'url' => $d->url,
                        'country' => $d->country
                    ];
                })
            );
            const countryData = {};
            platforms.forEach(d => {
                countryData[d.country] = d;
            });
            const geojsonUrl = "{{ asset('other/europe.geo.json') }}";
            console.log(platforms);
            console.log(countryData);
        </script>
        <script>
            //D3 code here
            d3.json(geojsonUrl).then(function(geojson) {
                const tooltip = d3.select("body")
                    .append("div")
                    .attr("class", "tooltip")
                    .style("position", "absolute")
                    .style("opacity", 0);
                const width = document.getElementById("map").clientWidth;
                const height = 500;
                const projection = d3.geoMercator()
                    .center([14, 51])
                    .scale(800)
                    .translate([width / 2, height / 2]);
                const path = d3.geoPath().projection(projection);
                const svg = d3.select("#map");
                svg.selectAll("path")
                    .data(geojson.features)
                    .enter()
                    .append("path")
                    .attr("d", path)
                    .attr("fill", d => {
                        return countryData[d.properties.name_en]
                            ? "#3b94d0"
                            : "#dddddd";
                    })
                    .on("mouseover", function(event, d) {
                        if (countryData[d.properties.name_en]) {
                            d3.select(this)
                                .attr("fill", "#1d6cac");
                            tooltip.transition().duration(200).style("opacity", 0.9);
                            tooltip.html(`<div class="tooltip-title">${countryData[d.properties.name_en]['title']}</div><div class="tooltip-url">${countryData[d.properties.name_en]['url']}</div>`)
                                .style("left", (event.pageX + 10) + "px")
                                .style("top", (event.pageY - 28) + "px");
                        }
                    })
                    .on("mouseout", function(event, d) {
                        d3.select(this)
                            .attr("fill",
                                countryData[d.properties.name_en]
                                    ? "#3b94d0"
                                    : "#dddddd");
                        tooltip.transition().duration(500).style("opacity", 0);
                    })
                    /*
                    .on("mousemove", (event) => {
                        tooltip.style("left", (event.pageX + 10) + "px")
                        .style("top", (event.pageY - 28) + "px");
                    })
                    */
                    .on("click", function(event, d) {
                        const dataset = countryData[d.properties.name_en];
                        if(dataset){
                            window.open(dataset.url, "_blank");
                        }
                    });
                function drawMap() {
                    console.log('redrawing');
                    const width = document.getElementById("map").clientWidth;
                    const height = 500;
                    projection
                        .center([14, 51])
                        .scale(800)
                        .translate([width / 2, height / 2]);
                    if(width < 740) {
                        projection
                            .center([14, 51])
                            .scale(500)
                            .translate([width / 2, height / 2]);
                    }
                    svg.selectAll("path")
                        .attr("d", path);
                }
                drawMap();
                window.addEventListener("resize", drawMap);
                
            });
        </script>

        <div class="map-container" id="map-container">
            <svg id="map"></svg>
        </div>

        <div class="landing-grid-container">
            <div class="platform-boxes-container">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
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
                Neither the European Union institutions and bodies nor any person acting on their behalf may be held responsible for the use which may be made of the information contained therein.<br />
                <a href="https://integritywatch.eu/privacy-policy.pdf" target="_blank">Privacy policy</a> | For any question, please contact: <a href="mailto:rkergueno@transparency.org">rkergueno@transparency.org</a><br />
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
