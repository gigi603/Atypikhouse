@extends('layouts.admin')
@section('title', "Détails de la réservation atypikhouse passée")
@section('content')
<div class="admin-user-profil">
    @if (Session::has('success-valide'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {{ Session::get('success-valide') }}
    </div>
    @endif
    <div class="container list-category">
        <div class="panel panel-default">
            <div class="panel-heading"><h1 style="font-size:30px;">Détails de la réservation atypikhouse passée</h1></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-4">
                            <div class="text-center">
                                <img class="img-responsive img_house" src="{{ asset('img/houses/'.$historique->house->photo) }}">
                                <div class="card-center">
                                    <h2 class="title card-title text-center">
                                        {{$historique->title}}
                                    </h2>
                                    <div class="block-description">
                                        <h3 class="price">Total payé: {{$historique->total}}€ pour {{$historique->nb_personnes}} personnes</h3>
                                        <p>Type de bien : {{$historique->house->category->category}}</p>
                                        <p><i class="fas fa-calendar"></i> Du: <?php \Date::setLocale('fr'); $startdate = Date::parse($historique->start_date)->format('l j F Y'); echo($startdate);?> </p>
                                            <p><i class="fas fa-calendar"></i> au:  <?php \Date::setLocale('fr'); $enddate = Date::parse($historique->end_date)->format('l j F Y'); echo($enddate);?></p>
                                        <p class="card-text">{{$historique->description}}</p>
                                        <p> Adresse: {{$historique->house->adresse}}</p>
                                        <p>Téléphone de l'annonceur : {{$historique->house->phone}}</p>
                                        <p>Adresse mail de l'annonceur : {{$historique->user->email}}</p>
                                        @if(@count($historique->valuecatproprietes) > 0 && isset($historique->valuecatproprietes))
                                            <h3 class="price">Equipements:</h3>
                                            @foreach($historique->valuecatproprietes as $valuecatpropriete)
                                                <p>{{$valuecatpropriete->propriete->propriete}}</p> 
                                            @endforeach
                                        @else 
                                            <p>Il n y a pas d'équipements sur cette reservation</p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
@endsection
