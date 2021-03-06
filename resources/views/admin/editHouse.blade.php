@extends('layouts.admin')
@section('title', "Modifier les informations de l'annonce")
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 style="font-size:20px;">Modifier les informations de l'annonce</h1></div>
                <div class="panel-body">
                    @if ($success = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('admin.updateHouse', $house->id) }}" enctype="multipart/form-data">                      
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 control-label">Titre</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="title" maxlength="47" autofocus value="{{$house->title}}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 control-label">Categorie</label>
                            <div class="col-md-12">
                                <select id="select_category" required name="category_id" class="form-control">
                                    <option id="" value="">Choisissez votre categorie</option>
                                    @foreach($categories as $category)
                                        @if($category->id > 1)
                                            <option {{ $categorySelected == $category->id ? "selected" : "" }} value="{{$category->id}}">{{$category->category}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="proprietes"></div>
                        <div class="form-group{{ $errors->has('nb_personnes') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 control-label">Nombre de personnes</label>
                            <div class="col-md-12">
                                <select id="select_nb_personnes" name="nb_personnes" class="form-control">
                                    <option id="" value="{{$house->nb_personnes}}" selected="selected" required autofocus>{{$house->nb_personnes}}</option>
                                    @for($i=1;$i<16;$i++)
                                    <option value={{$i}} @if (old('nb_personnes') == $i) selected="selected" @endif>{{$i}}</option>
                                    @endfor 
                                </select>
                                @if ($errors->has('nb_personnes'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nb_personnes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('adresse') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 control-label">Adresse</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="autocompleteadresse" name="adresse" autofocus value="{{$house->adresse}}">
                                @if ($errors->has('adresse'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adresse') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input id="house_id" value="{{$house->id}}" hidden>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 control-label">Telephone</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="phone" autofocus value="{{$house->phone}}">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 control-label">Prix la nuit par personne</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="price" autofocus value="{{$house->price}}">
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 control-label">Photo</label>
                            
                            <div class="col-md-12">
                                <img class="img-responsive img_house" src="{{ asset('img/houses/'.$house->photo) }}">
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label class="col-md-12"></label>
                            <div class="col-md-12">
                            <input id="name" type="file" class="form-control" name="photo" autofocus value="{{$house->photo}}">
                            @if ($errors->has('photo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 control-label">Date de début</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="from" placeholder="Date de début" name="start_date" value="<?php \Date::setLocale('fr'); $startdate = Date::parse($house->start_date)->format('d/m/Y'); echo($startdate);?>" />
                                {{-- <input id="name" type="text" class="form-control" name="start_date" maxlength="40" autofocus value="{{ old('start_date') }}"> --}}
                                @if ($errors->has('start_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-12 control-label">Date de fin</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="to" placeholder="Date de fin" name="end_date" value="<?php \Date::setLocale('fr'); $enddate = Date::parse($house->end_date)->format('d/m/Y'); echo($enddate);?>" />
                                {{-- <input id="name" type="text" class="form-control" name="end_date" maxlength="40" autofocus value="{{ old('end_date') }}"> --}}
                                @if ($errors->has('end_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-12 control-label">Description</label>

                            <div class="col-md-12">
                                <textarea class="form-control" name="description" rows="5">{{$house->description}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-12 control-label">Statut</label>
                            <div class="col-md-12">
                                <select id="select_category" type="text" name="statut" class="form-control">
                                    <option id="" value="{{$house->statut}}" selected="selected" required autofocus>{{$house->statut}}</option> 
                                    <option value="En attente de validation">En attente de validation</option>
                                    <option value="Validé">Validé</option>
                                    <option value="Refusé">Refusé</option>                          
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-color">
                                    Enregistrer
                                </button>
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
    <script src="{{ asset('js/admin_create_house.js') }}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOt3g2OEb6Br_DmsDwVgciAFiDdE5Qh0E=places&language=fr"></script>
    <script src="{{ asset('js/autocomplete_address.js') }}"></script>
@endsection
