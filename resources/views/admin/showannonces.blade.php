@extends('layouts.admin')
@section('title', "Détails de l'annonce atypikhouse")
@section('content')
<div class="admin-user-profil">
    @if (Session::has('success'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('success-valide'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            {{ Session::get('success-valide') }}
        </div>
    @endif
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

    <!-- Modal Répondre au commentaire-->
    <div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title">Saisir votre commentaire</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{ route('admin.addComment') }}" method="POST" id="commentForm" style="display: flex;">
                        {{ csrf_field() }}
                        <textarea class="form-control col-md-12" name="comment" cols="5" rows="10"></textarea>
                        <input type="hidden" name="house_id" value="{{ $house->id }}">
                        <input type="hidden" name="admin_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="parent_id" id="parent_id" value="">
                        <input type="hidden" name="user_id" value="0">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"  form="commentForm">Envoyer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modifier le commentaire-->
    <div class="modal fade" id="modifyComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title">Modifier ce commentaire</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{ route('admin.modifyComment') }}" method="POST" id="commentFormModify" style="display: flex;">
                        {{ csrf_field() }}
                        <textarea class="form-control col-md-12 textarea_modify_comment" name="comment" cols="5" rows="10"></textarea>
                        <input type="hidden" name="house_id" value="{{ $house->id }}">
                        <input type="hidden" name="admin_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="parent_id" id="current_id" value="">
                        <input type="hidden" name="user_id" value="0">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"  form="commentFormModify">Envoyer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container list-category" role="details-annonce">
    <h1 class="title" style="font-size:30px;text-align:center;">Détails de l'annonce atypikhouse</h1>
    <div class="panel panel-default">
        <div class="panel-heading text-center">Détails de l'annonce atypikhouse</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card-show text-center">
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
                                        @if($valuecatpropriete->reservation_id == 0 && $valuecatpropriete->active == 1)
                                            <span>{{$valuecatpropriete->propriete->propriete}} </span>
                                        @endif                             
                                    @endforeach
                                @else
                                    <p>Il n'y a pas d'équipements sur cette annonce</p> 
                                @endif 
                                <br>
                                <br>
                                <h3 class="price">Statut</h3> 
                                @if($house->statut == "Validé")      
                                    <p style="color:green">{{$house->statut}}</p><br>
                                @else 
                                    <p style="color:red">{{$house->statut}}</p><br>
                                @endif
                                <h3 class="price">Actions</h3>
                                @if($house->disponible == "oui")
                                    <a href="{{action('AdminController@editHouse', $house->id)}}" class="btn btn-primary">Modifier</a>
                                @endif
                                @if($house->disponible == "oui" && $house->statut != "Validé")
                                    <a href="{{action('AdminController@valideHouse', $house->id)}}" class="btn btn-primary">Valider l'annonce</a>
                                @endif
                                @if($house->disponible == "oui" && $house->statut == "Validé")
                                    <a href="{{action('AdminController@refuseHouse', $house->id)}}" class="btn btn-danger">Refuser l'annonce</a>
                                    <a href="{{action('AdminController@deleteHouse', $house->id)}}" class="btn btn-danger delete-annonce">Supprimer l'annonce</a>
                                @endif
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
                                    <button class="btn btn-primary passingId"
                                         data-id={{$comment->id}} onclick="$('#parent_id').val($(this).attr('data-id')); $('#comment').modal('show');">Répondre
                                    </button>
                                    <a href="{{ route('admin.deleteCommentParent', $comment->id) }}" class="btn btn-danger delete-comment">Supprimer</a>
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
                                    <div class="text-right">
                                        <button class="btn btn-primary"
                                            data-toggle="modal"
                                            data-target="#modifyComment" 
                                            data-id={{$child->id}} 
                                            onclick="$('#current_id').val($(this).attr('data-id')); 
                                                     $('#modifyComment').modal('show');
                                                     $('.textarea_modify_comment').val('<?php echo (isset($child->comment))? $child->comment : '';?>')">Modifier
                                        </button>
                                        <a href="{{ route('admin.deleteComment', $child->id) }}" class="btn btn-danger delete-comment">Supprimer</a>
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
@endsection
@section('script')
    <script src="{{ asset('js/getCommentId.js') }}"></script>
@endsection
