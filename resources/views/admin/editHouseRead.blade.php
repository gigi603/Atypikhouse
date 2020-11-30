@extends('layouts.admin')
@section('title', "Modifications de l'annonce")
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 style="font-size:20px;">Détail actuelle de l'annonce suite aux modifications</h1>
                    <p>Ces modifications seront prises en compte pour les prochaines reservations, elles ne s'appliquent pas à celles qui sont en cours</p>
                </div>
                <div class="panel-body">
                    @if ($success = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif
                    <form class="form-horizontal">                      
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-12 control-label">Titre</label>

                            <div class="col-md-12">
                                <input id="name" disabled type="text" class="form-control" name="title" maxlength="47" autofocus value="{{$house->title}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-12 control-label">Categorie</label>
                            <div class="col-md-12">
                                <select id="select_category" disabled required name="category_id" class="form-control">
                                    <option id="" value="">Choisissez votre categorie</option>
                                    @foreach($categories as $category)
                                        @if($category->id > 1)
                                            <option {{ $categorySelected == $category->id ? "selected" : "" }} value="{{$category->id}}">{{$category->category}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="proprietes"></div>
                        <div class="form-group">
                            <label for="name" class="col-md-12 control-label">Nombre de personnes</label>
                            <div class="col-md-12">
                                <select id="select_nb_personnes" disabled name="nb_personnes" class="form-control">
                                    <option id="" value="{{$house->nb_personnes}}" selected="selected" required autofocus>{{$house->nb_personnes}}</option>
                                    @for($i=1;$i<16;$i++)
                                    <option value={{$i}} @if (old('nb_personnes') == $i) selected="selected" @endif>{{$i}}</option>
                                    @endfor 
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-12 control-label">Adresse</label>
                            <div class="col-md-12">
                                <input type="text" disabled class="form-control" id="autocompleteadresse" name="adresse" autofocus value="{{$house->adresse}}">
                            </div>
                        </div>
                        <input id="house_id" value="{{$house->id}}" hidden readonly>

                        <div class="form-group">
                            <label for="name" class="col-md-12 control-label">Telephone</label>
                            <div class="col-md-12">
                                <input id="name" disabled type="text" class="form-control" name="phone" autofocus value="{{$house->phone}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-12 control-label">Prix la nuit par personne</label>
                            <div class="col-md-12">
                                <input id="name" type="text" disabled class="form-control" name="price" autofocus value="{{$house->price}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-12 control-label">Photo</label>
                            
                            <div class="col-md-12">
                                <img class="img-responsive img_house" src="{{ asset('img/houses/'.$house->photo) }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="col-md-12 control-label">Date de début</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" disabled id="from" placeholder="Date de début" name="start_date" value="<?php \Date::setLocale('fr'); $startdate = Date::parse($house->start_date)->format('d/m/Y'); echo($startdate);?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-12 control-label">Date de fin</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="to" disabled placeholder="Date de fin" name="end_date" value="<?php \Date::setLocale('fr'); $enddate = Date::parse($house->end_date)->format('d/m/Y'); echo($enddate);?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-12 control-label">Description</label>
                            <div class="col-md-12">
                                <p>{{$house->description}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-12 control-label">Statut</label>
                            <div class="col-md-12">
                                <select id="select_category" disabled type="text" name="statut" class="form-control">
                                    <option id="" value="{{$house->statut}}" selected="selected" required autofocus>{{$house->statut}}</option> 
                                    <option value="En attente de validation">En attente de validation</option>
                                    <option value="Validé">Validé</option>                       
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection
@section('script')
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script>let site = "{{ env('APP_URL') }}"; </script>
    <script src="{{ asset('js/calendarCreateAnnonce.js') }}"></script>
    <script src="{{ asset('js/admin_create_house_read.js') }}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOt3g2OEb6Br_DmsDwVgciAFiDdE5Qh0E=places&language=fr"></script>
    <script src="{{ asset('js/autocomplete_address.js') }}"></script>
@endsection
