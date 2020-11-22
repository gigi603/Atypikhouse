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
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/cookieconsent.min.css') }}" rel="stylesheet">
        @yield('styles')
    </head>
    <body>
        <div id="app">
            @yield('content')
            <footer class="footer" role="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-3">
                            <ul>
                                <li><a href="{{ route('mentions_legales') }}">Mentions légales</a></li>
                                <li><a href="{{ route('politique_de_confidentialite') }}">Politique de confidentialité</a></li>
                                <li><a href="{{ route('cgu') }}">Conditions générales d'utilisation</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul>
                                <li><a href="{{ route('apropos') }}">A propos</a></li>
                                <li><a href="{{ route('faq') }}">FAQ</a></li>
                                <li><a href="{{ route('cgv') }}">Conditions générales de vente</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul id="reseaux">
                                <div><li><a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-square fa-2x" aria-hidden="true"></i><span class="sr-only">Facebook</span></i></a></li></div>
                                <div><li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter-square fa-2x" aria-hidden="true"><span class="sr-only">Twitter</span></i></a></li></div>
                                <div><li><a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram fa-2x" aria-hidden="true"><span class="sr-only">Instagram</span></i></a></li></div>
                                <div><li><a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube-square fa-2x" aria-hidden="true"><span class="sr-only">Youtube</span></i></a></li></div>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('script')
    </body>
</html>

