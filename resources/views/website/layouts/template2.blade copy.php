<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(Session::has('seo_was_set'))
    {!! SEO::generate() !!}
    @endif
    <link rel="canonical" href="{{$canonical_url}}" />
    <link rel="icon" type="image/x-icon" href="{{asset('img/favicon-32x32.png')}}">

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap4.6.1.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!--  Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    {!! settings('website_header_script') !!}
    @include('website.google_analytics')
    @stack('stylesheets')
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5ZHV46X" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="app">
        @include('website.layouts.header')
        <main>
            @yield('content')
        </main>
        <!-- @include('cookieConsent::index') -->
    </div>
    @include('website.layouts.footer')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        window.currencyConfig = {!! currencyConfig()!!};
    </script>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    @if($notification = growl_notification())
    <script type="text/javascript">
        $(function () {     
      <? php echo $notification; ?>     
    });
    </script>
    @endif

    <script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    {!! settings('website_footer_script') !!}
    @stack('scripts')
</body>

</html>