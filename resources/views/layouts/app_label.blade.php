<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', env('META_DESCRIPTION'))" />

    <!-- OG GRAPH -->
    <meta property="og:title" content="@yield('og:title', env('META_TITLE'))" />
    <meta property="og:description" content="@yield('og:description', env('META_DESCRIPTION'))" />
    <meta property="og:type" content="@yield('og:type','website')" />
    <meta property="og:url" content="@yield('og:url',url()->current())" />
    <meta property="og:image" content="@yield('og:image', url()->to('/images/storefront/beat_fund_square.jpg'))" />
    <meta property="og:audio" content="@yield('og:audio')" />
    <meta property="og:audio:type" content="@yield('og:audio:type')" />
    <meta property="og:music:musician" content="@yield('og:music:musician')" />
    <meta property="og:site_name" content="@yield('og:site_name','Beat Fund')" />

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="@yield('twitter:card','summary_large_image')" />
    <meta name="twitter:site" content="@yield('twitter:site','@TFreeborough')" />
    <meta name="twitter:title" content="@yield('og:title', env('META_TITLE'))" />
    <meta name="twitter:description" content="@yield('og:description', env('META_DESCRIPTION'))" />
    <meta name="twitter:image" content="@yield('og:image', url()->to('/images/storefront/beat_fund_square.jpg'))" />
    <meta name="twitter:player" content="@yield('og:audio')" />
    <meta name="twitter:player:height" content="@yield('twitter:player:height')" />
    <meta name="twitter:player:width" content="@yield('twitter:player:width')" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if(View::hasSection('title'))
            @yield('title') | Beat Fund
        @else
            {{ env('META_TITLE') }} | Beat Fund
        @endif
    </title>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>

    <!-- Animate -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" type="text/css">

    <script src='https://www.google.com/recaptcha/api.js'></script>

@include('layouts.misc.cookie_policy')

<!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '197185217577839');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=197185217577839&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->

</head>
<body>
<div id="app_label">
    @include('layouts.navbar_top')
    <div id="app">
        <div id="app_side_menu">
            @include('label.layout.side_menu')
        </div>
        <div id="app_content">
            @yield('content')
            @include('layouts.footer')
        </div>
    </div>
</div>
@include('scripts')
</body>
</html>
