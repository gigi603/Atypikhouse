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
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="calendar panel panel-default">
                        @if(Auth::check())
                            <h3 class="text-center panel-heading">Réserver vos dates : </h3>
                            <form class="form-horizontal" method="POST" action="{{url('reservations')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group col-sm-12 col-xs-12">
                                    <input type="hidden" name="house_id" value="{{ $house->id }}">
                                    <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                        <label for="from" class="formLabel control-label">Départ : </label>
                                        <input type="text" class="form-control" required id="from" name="start_date" value="{{old('start_date') ? old('start_date') : Carbon\Carbon::today()->format('d/m/Y')}}"/>
                                        @if ($errors->has('start_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('start_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                                        <label for="to" class="formLabel control-label">Arrivée : </label>
                                        <input type="text" class="form-control" required id="to" name="end_date" value="{{old('end_date') ? old('end_date') : Carbon\Carbon::today()->addWeek()->format('d/m/Y') }}"/>
                                        @if ($errors->has('end_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('end_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <input type="hidden" name="start_date_annonce" id="start_date_annonce" value="{{$house->start_date}}"/>
                                    <input type="hidden" name="end_date_annonce" id="end_date_annonce" value="{{$house->end_date}}"/>

                                    <div class="form-group{{ $errors->has('nb_personnes') ? ' has-error' : '' }}">
                                        <label for="select_nb_personnes" for="from" class="formLabel control-label">Nombre de personnes : </label>
                                        <select id="select_nb_personnes" name="nb_personnes" required class="form-control" style="margin-top:3.5%;">
                                            <option id="" value="" autofocus>Nombre de personnes</option>
                                            @for($i=1;$i<= $house->nb_personnes;$i++)
                                            <option value={{$i}} @if (old('nb_personnes') == $i) selected="selected" @elseif($i == 2) selected="selected" @else  @endif>{{$i}}</option>
                                            @endfor 
                                        </select>
                                        @if ($errors->has('nb_personnes'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nb_personnes') }}</strong>
                                            </span>
                                        @endif
                                        
                                    </div>
                                    <input type="hidden" name="house_id" value="{{$house->id}}"/>
                                    <input type="hidden" name="category_id" value="{{$house->category_id}}"/>

                                    </div>
                                    {!! Form::submit('Réserver', array('class' => 'btn btn-success btn_reserve')) !!}
                                    
                                </form>
                            @else
                                <h3 class="text-center panel-heading">Connectez-vous </h3>
                                    <div class="form-group col-sm-12 col-xs-12">
                                        <p><b>Afin de pouvoir effectuer des réservations sur cette annonce, vous devez vous connecter</b></p>
                                    </div>
                                    <a href="{{route('login')}}" class="btn btn-success btn_reserve text-center">Me connecter </a>
                                </form>
                            @endif   
                        </div>
                    </div> 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
                                            @if($valuecatpropriete->reservation_id == 0 && && $valuecatpropriete->active == 1)
                                                <span>{{$valuecatpropriete->propriete->propriete}} </span>
                                            @endif
                                        @endforeach
                                    @else
                                        <span>Il n'y a pas d'équipements sur cette annonce</span>
                                    @endif
                                    
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
                        
                            @if (Auth::check())
                                @if(isset($client_reserved))
                                    @if(count($client_reserved) > 0 && count($commentUser) == 0)
                                        <div class="panel panel-default" style="margin: 0; border-radius: 0;">
                                            <div class="panel-body">
                                                <form action="{{ url('/comments') }}" method="POST" style="display: flex;">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="house_id" value="{{ $house->id }}">
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <input type="hidden" name="admin_id" value="0">
                                                    <input type="hidden" name="reservation_id" value="0">  
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
                            @endif
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
    <script src="{{ asset('js/calendarReservation.js') }}"></script>
@endsection
