@extends('layouts.app')
@section('title', "Détails de la réservation annulée atypikhouse")
@section('content')
<div class="container">
    <h1 class="title" id="hebergements">Détails de la réservation annulée atypikhouse</h1>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h2>{{$reservation->title}}</h2>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card-show text-center">
                        <img class="img-responsive img_house" src="{{ asset('img/houses/'.$reservation->house->photo) }}" alt="Hébergement insolite - {{$reservation->house->title}}"></a>
                        <div class="card-center">
                            <h3 class="title card-title text-center">
                                <a href="#">{{$reservation->title}}</a>
                            </h3>
                            <h3 class="price">Total payé: {{$reservation->total}}€ pour {{$reservation->nb_personnes}} personnes</h3>
                            <p>Type de bien : {{$reservation->house->category->category}}</p>
                            @if(@count($reservation->valuecatproprietes) > 0 && isset($reservation->valuecatproprietes))
                                    <label>Equipements:</label><br>
                                    @foreach($reservation->valuecatproprietes as $valuecatpropriete)
                                        @if($valuecatpropriete->reservation_id == $reservation->id)
                                            <p>{{$valuecatpropriete->propriete->propriete}}</p> 
                                        @endif
                                    @endforeach
                                @else
                                    <span>Il n'y a pas d'équipements sur cette annonce</span>
                                @endif
                            <p><i class="fas fa-calendar"></i> Du: <?php \Date::setLocale('fr'); $startdate = Date::parse($reservation->start_date)->format('l j F Y'); echo($startdate);?> </p>
                                <p><i class="fas fa-calendar"></i> au:  <?php \Date::setLocale('fr'); $enddate = Date::parse($reservation->end_date)->format('l j F Y'); echo($enddate);?></p>
                            <p class="card-text">{{$reservation->description}}</p>
                            <p>Annulation gratuite !</p>
                            <p> Adresse: {{$reservation->house->adresse}}</p>
                            <p>Téléphone de l'annonceur : {{$reservation->house->phone}}</p>
                            <p>Adresse mail de l'annonceur : {{$reservation->user->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">           
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                    <div class="panel panel-default" style="margin: 0; border-radius: 0;">
                        @foreach ($comments as $comment)
                            @if($comment->user_id != "0")
                                <div class="panel-body" style="border: solid 1px lightgray;">
                                    <div class="col-sm-9">
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                    <div class="text-right">
                                        <small><p>Posté par {{ $comment->user->prenom }} {{ $comment->user->nom }}</p></small>
                                        @if($comment->note != "0")
                                            <small><p>Note: {{$comment->note}}/5</p></small>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if($comment->children->count() > 0)
                                @foreach($comment->children as $child)
                                    <div class="panel-body alert-success" style="border: solid 1px #3c763d;">
                                        <div class="col-sm-9">
                                            <p><b>Un administrateur a répondu à {{$comment->user->prenom}} {{$comment->user->nom}}</b></p>
                                            <p>{{ $child->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
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
<script src="{{ asset('js/calendar.js') }}"></script>
@endsection
