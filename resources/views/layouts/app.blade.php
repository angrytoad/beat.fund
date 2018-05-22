<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'One music lovers dream to support independent artists across the globe with a fairer deal and the tools to sell your music easily.')">

    <!-- OG GRAPH -->
    <meta property="og:title" content="@yield('og:title', 'Beat Fund - Supporting Independent Artists')" />
    <meta property="og:description" content="@yield('og:description', 'One music lovers dream to support independent artists across the globe with a fairer deal and the tools to sell your music easily.')" />
    <meta property="og:type" content="@yield('og:type','website')" />
    <meta property="og:url" content="@yield('og:url',url()->current())" />
    <meta property="og:image" content="@yield('og:image', url()->to('/images/storefront/beat_fund_square.jpg'))" />
    <meta property="og:audio" content="@yield('og:audio')" />
    <meta property="og:audio:type" content="@yield('og:audio:type')" />
    <meta property="og:music:musician" content="@yield('og:music:musician')" />
    <meta property="og:site_name" content="@yield('og:site_name','Beat Fund')" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>

    <!-- Animate -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" type="text/css">

    <script src='https://www.google.com/recaptcha/api.js'></script>

    <!-- Cookie Consent -->
    <style type="text/css"> #iubenda-cs-banner { bottom: 0px !important; left: 0px !important; position: fixed !important; width: 100% !important; z-index: 99999998 !important; background-color: black; } .iubenda-cs-content { display: block; margin: 0 auto; padding: 20px; width: auto; font-family: Helvetica,Arial,FreeSans,sans-serif; font-size: 14px; background: #000; color: #fff;} .iubenda-cs-rationale { max-width: 900px; position: relative; margin: 0 auto; } .iubenda-banner-content > p { font-family: Helvetica,Arial,FreeSans,sans-serif; line-height: 1.5; } .iubenda-cs-close-btn { margin:0; color: #fff; text-decoration: none; font-size: 14px; position: absolute; top: 0; right: 0; border: none; } .iubenda-cs-cookie-policy-lnk { text-decoration: underline; color: #fff; font-size: 14px; font-weight: 900; } </style> <script type="text/javascript"> var _iub = _iub || []; _iub.csConfiguration = {"banner":{"textColor":"#ffffff","backgroundColor":"#59a8ff","slideDown":false,"applyStyles":false},"lang":"en","siteId":1096496,"cookiePolicyId":85876449}; </script><script type="text/javascript" src="//cdn.iubenda.com/cookie_solution/safemode/iubenda_cs.js" charset="UTF-8" async></script>

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
    @include('layouts.navbar_top')
    <div id="app">
        @yield('content')
    </div>
    @include('layouts.footer')

    @include('scripts')
</body>
</html>
