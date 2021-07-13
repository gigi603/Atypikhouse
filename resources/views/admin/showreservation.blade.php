@extends('layouts.admin')
@section('title', "Détails de la réservation atypikhouse")
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
            <div class="panel-heading"><h1 style="font-size:20px;">Détails de la réservation atypikhouse</h1></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-4">
                            <div class="text-center">
                                <img class="img-responsive img_house" src="{{ asset('img/houses/'.$reservation->house->photo) }}">
                                <div class="card-center">
                                    <h4 class="title card-title text-center">
                                        {{$reservation->title}}
                                    </h4>
                                    <div class="block-description">
                                        <h3 class="price">Total payé: {{$reservation->total}}€ pour {{$reservation->nb_personnes}} personnes</h3>
                                        <p>Type de bien : {{$reservation->house->category->category}}</p>

                                        <p class="card-text">{{$reservation->description}}</p>
                                        <p>Annulation gratuite !</p>
                                        <p> Adresse: {{$reservation->house->adresse}}</p><br>
                                        <h3 class="price">Disponibilité</h3>
                                        <p><i class="fas fa-calendar"></i> Du: <?php \Date::setLocale('fr'); $startdate = Date::parse($reservation->start_date)->format('l j F Y'); echo($startdate);?> </p>
                                            <p><i class="fas fa-calendar"></i> au:  <?php \Date::setLocale('fr'); $enddate = Date::parse($reservation->end_date)->format('l j F Y'); echo($enddate);?></p>
                                        <h3 class="price">Contact de l'annonceur</h3>       
                                        <p>Téléphone de l'annonceur : {{$reservation->house->phone}}</p>
                                        <p>Adresse mail de l'annonceur : {{$reservation->user->email}}</p><br><br>
                                        <p>Client ayant réservé : {{$reservation->user->prenom}} {{$reservation->user->nom}}</p><br><br>
                                        @if(@count($reservation->valuecatproprietes) > 0 && isset($reservation->valuecatproprietes))
                                            <h3 class="price">Equipements:</h3>
                                            @foreach($reservation->valuecatproprietes as $valuecatpropriete)
                                                <p>{{$valuecatpropriete->propriete->propriete}}</p> 
                                            @endforeach
                                        @else 
                                            <p>Il n'y a pas d'équipements sur cette reservation</p>
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
