<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>@yield('title') - {{ get_company_name() }}</title>
    <link rel="icon" type="image/x-icon" href="{{asset('img/favicon-32x32.png')}}">
    <link href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" rel="stylesheet" />
</head>
@php
$logo = homepage('company_logo')
@endphp

<body>
    <div id="root">
        <div id="wrapper">
            <div class="theme-cyan">
                <div class="page-loader-wrapper" style="display: none;">
                    <div class="loader">
                        <div class="m-t-30"><img src="{{asset('storage/uploads/scholarlyhelp-logo-web-White.svg')}}"
                                alt="{{ settings('company_name') }}" width="48" height="48">
                        </div>
                        <p>Please wait...</p>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>

</body>

</html>