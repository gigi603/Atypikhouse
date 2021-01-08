<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Atypikhouse - @yield('title')</title>
        <meta description="@yield('meta_description')">


        {{-- Logo Navigateur --}}
        <link rel="icon" type="image/png" href="{{ asset('img/LogoNavigateur.png') }}" />

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/cookieconsent.min.css') }}" rel="stylesheet">
        <style>
            html, body {
                font-family: 'Archivo', sans-serif;
                margin: 0;
                padding: 0;
                font-size: 16px;
                max-width: 100%;
                overflow-x: hidden;
                min-height: 100%;
                background-color: #F2F2F2;
                position:relative;
                min-height:100vh;
            }
            .navbar {
                border-bottom: none;
                background-color: #FFF;
                font-size: 17px;
                padding: 20px 0 !important;
                margin: 0 !important;
            }
            .navbar-default .navbar-brand {
                color: #3f4b30;
                margin: 0 !important;
            }
            .navbar-brand {
                padding: 0 !important;
            }
            .navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-text, a {
                text-decoration: underline;
                color: #3f4b30 !important;
            }
            #logo img {
                height: 60px;
                padding: 0 !important;
            }
            .link-position {
                padding-top: 10px !important;
            }
            .title {
                text-align: center;
                color: #000;
            }
            footer {
                background-color: #ededeb;
                padding: 20px;
                position:relative;
                bottom: 0;
                width: 100%;
                clear: both;
                border: solid 1px #ededeb
            }
            footer li, a{
                list-style: none;
                text-decoration: none;
                color: #000;
            }
            .footer_absolute {
                position: absolute;
            }
            footer li a:hover{
                text-decoration: underline;
            }
            .cc-animate.cc-revoke.cc-bottom {
                background-color: #3f4b30;
                color: #fff !important;
            }
            .cc-btn.cc-allow {
                color: #fff !important;
            }
        </style>
        @yield('styles')
    </head>
    <body>
        <div id="app">
            @include('navbar')
            @yield('content')
            @include('footer')
        </div>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery.unveil.js') }}" defer></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"defer></script>
        <script src="{{ asset('js/cookie.js') }}" defer></script>
        <script src="{{ asset('js/cookieconsent.min.js') }}" defer></script>
        <script>
            $(function() {
                $("img").unveil();
            });
        </script>
        @yield('script')
    </body>
</html>

