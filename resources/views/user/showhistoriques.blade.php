@extends('layouts.app')
@section('title', "Détails de la reservation passée atypikhouse")
@section('content')
<div class="admin-user-profil">   
<div class="container">
    <h1 class="title" id="hebergements">Détails de la réservation passée atypikhouse</h1>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h2>{{$historique->title}}</h2>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card-show h-100">
                        <img class="img-responsive img_house" src="{{ asset('img/houses/'.$historique->house->photo) }}" alt="Hébergement insolite - {{$historique->house->title}}"></a>
                        <div class="card-center">
                            <h3 class="title card-title text-center">
                                <a href="#">{{$historique->title}}</a>
                            </h3>
                            <h3 class="price">Total payé: {{$historique->total}}€ pour {{$historique->nb_personnes}} personnes</h3>
                            <p>Type de bien : {{$historique->house->category->category}}</p>
                            @if(@count($historique->valuecatproprietes) > 0 && isset($historique->valuecatproprietes))
                                <label>Equipements:</label><br>
                                @foreach($historique->valuecatproprietes as $valuecatpropriete)
                                    @if($valuecatpropriete->reservation_id == $historique->id)
                                        <p>{{$valuecatpropriete->propriete->propriete}}</p> 
                                    @endif
                                @endforeach
                            @else
                                <span>Il n'y a pas d'équipements sur cette annonce</span>
                            @endif
                            <p><i class="fas fa-calendar"></i> Du: <?php \Date::setLocale('fr'); $startdate = Date::parse($historique->start_date)->format('l j F Y'); echo($startdate);?> </p>
                            <p><i class="fas fa-calendar"></i> au:  <?php \Date::setLocale('fr'); $enddate = Date::parse($historique->end_date)->format('l j F Y'); echo($enddate);?></p>
                            <p class="card-text">{{$historique->description}}</p>
                            <p>Annulation gratuite !</p>
                            <p> Adresse: {{$historique->house->adresse}}</p>
                            <p>Téléphone de l'annonceur : {{$historique->house->phone}}</p>
                            <p>Adresse mail de l'annonceur : {{$historique->user->email}}</p>
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
                        @if (Auth::check())
                            @if(count($client_reserved) > 0 && count($commentUser) == 0)
                                <div class="panel panel-default" style="margin: 0; border-radius: 0;">
                                    <div class="panel-body">
                                        <form action="{{ url('/comments') }}" method="POST" style="display: flex;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="house_id" value="{{ $historique->house_id }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="admin_id" value="0">
                                            <input type="hidden" name="reservation_id" value="{{ $historique->id }}">  
                                            <input type="hidden" name="parent_id" value=""> 
                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                                <label for="input_comment" class="label-home">Saisir votre avis</label>
                                                <input type="text" name="comment" placeholder="Saisir un commentaire" class="form-control" id="input_comment" style="border-radius: 0;">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 rating">
                                                <input type="radio" id="star5" name="note" value="5" /><label for="star5" title="Meh">5 stars</label>
                                                <input type="radio" id="star4" name="note" value="4" /><label for="star4" title="Kinda bad">4 stars</label>
                                                <input type="radio" id="star3" name="note" value="3" /><label for="star3" title="Kinda bad">3 stars</label>
                                                <input type="radio" id="star2" name="note" value="2" /><label for="star2" title="Sucks big tim">2 stars</label>
                                                <input type="radio" id="star1" name="note" value="1" /><label for="star1" title="Sucks big time">1 star</label>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                <input type="submit" value="Envoyer" class="btn btn_reserve" style="border-radius: 0;">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endif
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