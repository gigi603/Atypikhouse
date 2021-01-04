@extends('layouts.app')
@section('title', 'Détail de l"annonce atypikhouse')
@section('content')
<div class="container">
    @if (@count($errors) > 0)
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <ul>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            {{ Session::get('success') }}
        </div>
    @endif
    <h1 class="h1-title" id="hebergements">Détails de l'annonce atypikhouse</h1>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h2>{{$house->title}}</h2>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card h-100">
                        <img class="img-house-detail" src="{{ asset('img/houses/'.$house->photo) }}" alt="Hébergement insolite - {{$house->title}}"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="calendar panel panel-default">
                        <h3 class="text-center panel-heading">{{$house->title}}</h3>
                        <div class="form-horizontal">
                            <div class="form-group" style="min-height: 358px;">
                                <h4 class="price">{{$house->price}}€ la nuit par personne</h4>
                                <p>Type de bien : {{$house->category->category}}</p><br>
                                <h4 class="price">Disponibilité</h4>
                                <p><?php \Date::setLocale('fr'); $startdate = Date::parse($house->start_date)->format('l j F Y'); echo($startdate);?> au
                                <?php \Date::setLocale('fr'); $enddate = Date::parse($house->end_date)->format('l j F Y'); echo($enddate);?> </p>
                                <p>Pour {{$house->nb_personnes}} personne(s) maximum</p>
                                <p> Adresse: {{$house->adresse}}</p><br>
                                <h4 class="price">Contact de l'annonceur</h4>
                                <p> Téléphone de l'annonceur : {{$house->phone}}</p>
                                <p> Adresse mail de l'annonceur : {{$house->user->email}}</p>
                                <p>Annulation gratuite !</p><br>
                                
                                @if(@count($house->valuecatproprietes) > 0 && isset($house->valuecatproprietes))
                                    <label>Equipements:</label><br>
                                    @foreach($house->valuecatproprietes as $valuecatpropriete)
                                        @if($valuecatpropriete->reservation_id == 0 && $valuecatpropriete->active == 1)
                                            <span>{{$valuecatpropriete->propriete->propriete}} </span>
                                        @endif
                                    @endforeach
                                @else
                                    <span>Il n'y a pas d'équipements sur cette annonce</span>
                                @endif
                                <br>
                                <a href="{{route('user.editHouse', $house['id']) }}" class="btn btn-primary btn-color text-center">Modifier</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p style="margin-bottom:5%;">{{$house->description}}</p>
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
                        @foreach ($house->comments as $comment)
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
    <script src="{{ asset('js/calendarReservation.js') }}"></script>
@endsection