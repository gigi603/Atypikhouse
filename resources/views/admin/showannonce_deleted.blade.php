@extends('layouts.admin')
@section('title', "Détails de l'annonce supprimée atypikhouse")
@section('content')
<div class="admin-user-profil">
    <div class="container list-category" role="details-annonce">
        <h1 class="title" style="font-size:30px;text-align:center;">Détails de l'annonce atypikhouse supprimée</h1>
        <div class="panel panel-default">
            <div class="panel-heading text-center">Détails de l'annonce atypikhouse supprimée</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card-show">
                            <img class="img-responsive img_house" src="{{ asset('img/houses/'.$house->photo) }}" alt="Hébergement atypiques - {{$house->title}}">
                            <div class="card-center">
                                <h2 class="title card-title text-center">
                                    {{$house->title}}
                                </h2>
                                <div class="block-description">
                                    <h3 class="price">{{$house->price}}€ la nuit par personne</h3>
                                    <p>Type de bien : {{$house->category->category}}</p>
                                    
                                    <p class="card-text">{{$house->description}}</p>
                                    <p>Annulation gratuite !</p>
                                    <p>Adresse :  {{$house->adresse}}</p><br>
                                    <h3 class="price">Disponibilité</h3>
                                    <p><i class="fas fa-calendar"></i> Début: <?php \Date::setLocale('fr'); $startdate = Date::parse($house->start_date)->format('l j F Y'); echo($startdate);?> </p>
                                    <p><i class="fas fa-calendar"></i> Fin:  <?php \Date::setLocale('fr'); $enddate = Date::parse($house->end_date)->format('l j F Y'); echo($enddate);?></p>
                                    <p>Pour {{$house->nb_personnes}} personne(s) maximum</p> <br><br>
                                    <h3 class="price">Contact de l'annonceur</h3>       
                                    <p>Téléphone de l'annonceur : {{$house->phone}}</p>
                                    <p>Adresse mail de l'annonceur : {{$house->user->email}}</p><br><br>
                                    @if(@count($house->valuecatproprietes) > 0 && isset($house->valuecatproprietes))
                                        <h3 class="price">Equipements:</h3><br>
                                        @foreach($house->valuecatproprietes as $valuecatpropriete)
                                            @if($valuecatpropriete->reservation_id == 0)
                                                <span>{{$valuecatpropriete->propriete->propriete}} </span>
                                            @endif                             
                                        @endforeach
                                    @else
                                        <p>Il n'y a pas d'équipements sur cette annonce</p> 
                                    @endif 
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="price note-title">Notes et avis</h4>
                        <div class="col-md-3 text-center">
                            <h4 class="price moyenne-title"><?php echo number_format($moyenneNote,1);?> ({{$nbTotalNote}})</h4>
                            <div class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($moyenneNote))
                                        <img class="star-size" src="{{ asset('img/star.png') }}" alt="star">
                                    @else
                                        <img class="star-size" src="{{ asset('img/star-empty.png') }}" alt="star-empty">
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 text-center notes">
                            <span> 5 ({{$nb5etoiles}}) </span><br>
                            <span> 4 ({{$nb4etoiles}}) </span><br>
                            <span> 3 ({{$nb3etoiles}}) </span><br>
                            <span> 2 ({{$nb2etoiles}}) </span><br>
                            <span> 1 ({{$nb1etoiles}}) </span><br>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @foreach ($house->comments as $comment)
                        <div class="panel panel-default" style="margin: 0; border-radius: 0;">
                            @if($comment->user_id != "0")
                                <div class="panel-body">
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
                                    <div class="panel-body alert-success">
                                        <div class="col-sm-9">
                                            <p><b>Un administrateur a répondu à {{$comment->user->prenom}} {{$comment->user->nom}}</b></p>
                                            <p>{{ $child->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection