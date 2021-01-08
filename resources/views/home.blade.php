@extends('layouts.app')
@section('title', "Atypikhouse offre les meilleurs espaces atypiques en europe")
@section('meta_description', "Atypikhouse contient des espaces atypiques un peu partout en europe notamment en france à grenoble, seine et marne, vous pouvez réserver à tout moment et profitez de nos promotions pouvant aller jusqu'à 60% de réduction à ne pas manquer")
@section('styles')
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Comfortaa';
            src: url('/fonts/Comfortaa/static/Comfortaa-Bold.ttf') format('truetype');
        }
        .banner {
            background: url("/img/home.jpg") no-repeat bottom scroll;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            display: table;
            width: 100%;
            max-width: 100%;
        }
        .cadre-home {
            background-color: #FFF;
            padding: 20px 0;
            border-radius: 4px !important;
            margin: 18.6vh 0;
        }
        .intro-body {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }
        .title-intro {
            color: #000;
            font-size: 30px;
        }
        .label-custom {
            color: black;
            line-height: 1.4;
            letter-spacing: 1px;
            margin: 0;
        }
        .form-horizontal .form-group {
            margin: 0;
            padding: 10px;
        }
        .cadre {
            background-color: #FFF;
            padding: 20px 0;
            border-radius: 4px !important;
        }
        .reservation-search {
            display:block;
        }
        .field-home {
            width: 200px;
            height: 50px;
            border-radius: 5px;
            font-size: 15px;
            margin-bottom: 20px !important;
        }
        .date-field-home {
            width: 50% !important;
            height: 50px;
            border-radius: 5px;
            margin-bottom: 20px !important;
        }

        .btn-principal-black{
            background-color: #000;
            color: #FFF !important;
            border-color: #000;
            padding: 12px 24px;
            font-size: 18px;
            border-radius: 30px;
            text-align: center;
            margin: 15vh 5vh 0 5vh;
        }
        .btn-principal-black:hover {
            background-color: #FFF;
            color: #000 !important;
            border-color: #000;
        }
        .btn-principal {
            background-color: #3f4b30;
            color: #FFFBFC !important;
            border-color: #3f4b30;
            padding: 12px 24px;
            font-size: 18px;
            border-radius: 30px;
            margin-top: 5vh;
            transition: transform .2s;
        }
        .btn-principal:hover {
            background-color: #3f4b30;
            color: #FFFBFC;
            border-color: #3f4b30;
            transform: scale(1.1);
        }
        .hebergement-title {
            text-align: center;
            margin: 60px;
            color: #FFF !important;
            font-family: 'Comfortaa', cursive;
        }
        .background-houses {
            background-color: #3f4b30;
        }
        .card-houses {
            position: relative;
            background-color: #fff;
            transition: transform .2s;
            margin-bottom: 40px;
            width: 390px;
            text-align: center;
        }
        .card-block-home {
            padding: 15px 15px;
            background-color: #000;
        }
        .img-houses-list {
            display: block;
            width: 100%;
            height: 250px;
            background-color: gray;
        }
        #block_home_2 {
            position: relative;
            background-color: white;
            color: #3f4b30 !important;
            display: flex;
            flex-flow: row wrap;
            justify-content: space-around;
            padding: 5vh 0;
        }
        .block_home_2_child {
            width: 350px;
            text-align: center;
            margin: 0 20px;
            padding: 20px;
        }
        .block_home_2_child i,
        .block_home_2_child h2,
        .block_home_2_child p {
            margin: 15px 0;
            color: #3f4b30 !important;
        }
        .nature_yours {
            background-color: #FFF;
            color: #000;
            font-family: 'Open Sans', sans-serif;
            font-family: 'Comfortaa', cursive;
            font-size: 60px;
            padding-top: 5%;
        }
        #hebergement-title{
            font-family: 'Comfortaa', cursive;
        }
        .voyage {
            border-radius: 20px;
            width:100%;
        }
        .avantage-font {
            font-family: 'Comfortaa', cursive;
        }
        .become_hote {
            background-color: #FFF;
            color: #000;
            font-family: 'Comfortaa', cursive;
            font-size: 60px;
            padding: 10% 0 5% 0;  
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid banner">
        <div class="intro-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="input-group reservation-search">
                        <form class="form-horizontal" method="get" action="{{url('search')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-lg-4 col-md-4 col-sm-12 cadre-home">
                                <h1 class="title title-intro">Atypikhouse offre les meilleurs espaces atypiques en Europe !</h1>
                                <div class="form-group reservation-search">
                                    @include('search',['url'=>'search','link'=>'search'])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div class="container-fluid nature_yours">
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-center" style="font-size:50px;margin-top:10vh;">La nature vous appartient</h2>
                <h2 class="text-center" style="margin-top:5%;">Parcourez le monde et explorez des endroits inconnus</h2>
            </div>
            <div class="col-md-5">
                <img data-src="{{ asset('img/voyage_demo.jpg')}}" class="voyage" alt="voyage-atypikhouse"/>
            </div>
        </div>
    </div>
    <div id="block_home_2" role="avantages" class="avantage-font">
        <div class="block_home_2_child">
            <h2>Tranquilité</h2>
            <p>Rester au calme pendant votre séjour dans nos habitats insolite. Nos cabanes et yourtes sauront combler vos désirs les plus variés</p>
        </div>
        <div class="block_home_2_child">
            <h2>Dépaysement</h2>
            <p>Sortez de la routine quotidienne et venez vivre des expérience unique dans des décors à couper le souffle</p>
        </div>
        <div class="block_home_2_child">
            <h2>Economie</h2>
            <p>Profitez de promotions toute l'année sur de nombreuses locations atypique tels que les cabanes, les cocons pour amoureux et bien d'autres. </p>
        </div>
    </div>
    
    <div class="container-fluid background-houses" role="annonces">
        <h2 class="hebergement-title">Nos hebergements atypikhouse sont à votre disposition</h2>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">         
                <div class="card-houses">       
                    <a href="{{ route('cabanes') }}" aria-label="Cabanes Atypikhouse"><img class="img-houses-list" data-src="{{ asset('img/maison_foret.jpg') }}" alt="Hébergement insolite - maison_foret"></a>
                    <div class="card-block-home">
                        <a href="{{ route('cabanes') }}" class="btn btn-principal"> Voir nos cabanes </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">         
                <div class="card-houses text-center">       
                    <a href="{{ route('igloos') }}" aria-label="Igloos Atypikhouse"><img class="img-houses-list" data-src="{{ asset('img/igloo_demo.jpg') }}" alt="Hébergement insolite - igloo"></a>
                    <div class="card-block-home">
                        <a href="{{ route('igloos') }}" class="btn btn-principal"> Voir nos igloos </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">         
                <div class="card-houses text-center">       
                    <a href="{{ route('yourtes') }}" aria-label="Yourtes Atypikhouse"><img class="img-houses-list" data-src="{{ asset('img/yourte_demo.jpg') }}" alt="Hébergement insolite - yourte"></a>
                    <div class="card-block-home">
                        <a href="{{ route('yourtes') }}" class="btn btn-principal"> Voir nos yourtes </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"> 
                <a href="{{ route('houses') }}" class="btn btn-principal-black">Voir nos hebergements</a>
            </div>
        </div>
    </div>
    <div class="container-fluid become_hote" id="become_hote">
        <div class="row">
            <div class="col-md-6 text-center">
                <h3 class="text-center" style="font-size:50px;margin-top:10vh;">Partagez votre logement sur Atypikhouse</h3>
                <h3 class="text-center" style="margin-top: 5%;">Rejoignez une communauté dynamique d'hôtes, créez des expériences mémorables pour les voyageurs et gagnez de l'argent pour vivre vos passions.</h3>
                    @if(Auth::check())
                        <a href="{{ route('house.create_step1') }}" class="btn btn-principal" style="margin:0 auto;">Commencer</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-principal" style="margin:0 auto;">Commencer</a>
                    @endif
            </div>
            <div class="col-md-5">
                <img data-src="{{ asset('img/proprietaire.jpg')}}" class="voyage" alt="proprietaire-atypikhouse"/>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#hote_link').click(function() {
            $('html, body').animate({
                scrollTop: $("#become_hote").offset().top
            }, 1000);
        });
    </script>
@endsection