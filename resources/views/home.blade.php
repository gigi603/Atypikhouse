@extends('layouts.app')
@section('title', "Atypikhouse offre les meilleurs espaces atypiques en europe")
@section('meta_description', "Atypikhouse contient des espaces atypiques un peu partout en europe notamment en france à grenoble, seine et marne, vous pouvez réserver à tout moment et profitez de nos promotions pouvant aller jusqu'à 60% de réduction à ne pas manquer")
@section('styles')
    <link href="{{asset("/fontawesome/css/all.min.css") }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid banner">
        <div class="intro-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="input-group reservation-search">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 cadre">
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
    </div>

    
    <div class="container-fluid nature_yours">
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-center" style="font-size:50px;margin-top:10vh;">La nature vous appartient</h2>
                <h2 class="text-center" style="margin-top:5%;">Parcourez le monde et explorez des endroits inconnus</h2>
            </div>
            <div class="col-md-5">
                <img data-src="{{ asset('img/voyage_demo.jpg')}}" class="voyage"/>
            </div>
        </div>
    </div>
    <div id="block_home_2" role="avantages">
        <div id="tranquilite" class="block_home_2_child">
            <i class="fas fa-procedures fa-5x"></i>
            <h2 class="avantage-title">Tranquilité</h2>
            <p class="avantage-title">Rester au calme pendant votre séjour dans nos habitats insolite. Nos cabanes et yourtes sauront combler vos désirs les plus variés</p>
        </div>
        <div id="depaysement" class="block_home_2_child">
            <i class="fab fa-angellist fa-5x"></i>
            <h2 class="avantage-title">Dépaysement</h2>
            <p class="avantage-title">Sortez de la routine quotidienne et venez vivre des expérience unique dans des décors à couper le souffle</p>
        </div>
        <div id="money" class="block_home_2_child">
            <i class="far fa-money-bill-alt fa-5x"></i>
            <h2 class="avantage-title">Economie</h2>
            <p class="avantage-title">Profitez de promotions toute l'année sur de nombreuses locations atypique tels que les cabanes, les cocons pour amoureux et bien d'autres. </p>
        </div>
    </div>
    
    <div class="container-fluid background-houses" role="annonces">
        <h2 class="hebergement-title">Nos hebergements atypikhouse sont à votre disposition</h3>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">         
                <div class="card-houses h-100">       
                    <a href="#"><img class="img-houses-list" data-src="{{ asset('img/maison_foret.jpg') }}" alt="Hébergement insolite - maison_foret"></a>
                    <div class="card-block">
                        <div class="card-body">
                            <h3 class="card-title title-houses"><a href="#"> Des cabanes </a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">         
                <div class="card-houses h-100">       
                    <a href="#"><img class="img-houses-list" data-src="{{ asset('img/igloo_demo.jpg') }}" alt="Hébergement insolite - igloo"></a>
                    <div class="card-block">
                        <div class="card-body">
                            <h3 class="card-title title-houses"><a href="#"> Des igloos </a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">         
                <div class="card-houses h-100">       
                    <a href="#"><img class="img-houses-list" data-src="{{ asset('img/yourte_demo.jpg') }}" alt="Hébergement insolite - yourte"></a>
                    <div class="card-block">
                        <div class="card-body">
                            <h3 class="card-title title-houses"><a href="#"> Des yourtes </a></h3>
                        </div>
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
            <div class="col-md-6">
                <h3 class="text-center" style="font-size:50px;margin-top:10vh;">Partagez votre logement sur Atypikhouse</h2>
                <h3 class="text-center" style="margin-top: 5%;">Rejoignez une communauté dynamique d'hôtes, créez des expériences mémorables pour les voyageurs et gagnez de l'argent pour vivre vos passions.</p>
                @if(Auth::check())
                    <a href="{{ route('house.create_step1') }}" class="btn btn-principal">Commencer</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-principal">Commencer</a>
                @endif
            </div>
            <div class="col-md-5">
                <img data-src="{{ asset('img/proprietaire.jpg')}}" class="voyage"/>
            </div>
        </div>
    </div>
@endsection
