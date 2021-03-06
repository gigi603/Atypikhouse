@extends('layouts.app')
@section('title', 'Mon annonce')
@section('styles')
    <style>
        .btn_reserve {
            color: #FFFBFC !important;
            background-color: #3f4b30;
            border-color: #3f4b30;
            border: none;
            margin: 0 20px 30px 20px;
            padding: 10px 25px;
            font-size: 16px;
        }
        .btn_reserve:hover {
            color: #FFFBFC;
            background-color: #3f4b30;
            border-color: #3f4b30;
            border: none;
            margin: 0 20px 30px 20px;
            padding: 10px 25px;
            font-size: 16px;
        }
    </style>
@endsection
@section('content')

<div class="container margin-top">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 style="font-size:30px;text-align:center;">Mon annonce</h1></div>
                <div class="panel-body">
                    @if ($success = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif
                    @if ($danger = Session::get('danger'))
                        <div class="alert alert-danger">
                            {{ $danger }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('user.updateHouse', $house->id) }}" enctype="multipart/form-data">                      
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Titre</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" placeholder="Saisir un titre à votre annonce" name="title" maxlength="47" autofocus value="{{
                                    old('title') ? : (isset($house->title) ? $house->title : old('title'))
                                }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="select_category" class="col-md-4 control-label">Categorie</label>
                            <div class="col-md-6">
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
                            <label for="select_nb_personnes" class="col-md-4 control-label">Nombre de personnes</label>
                            <div class="col-md-6">
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
                            <label for="autocompleteadresse" class="col-md-4 control-label">Adresse</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="autocomplete" placeholder="Saisir l'adresse du bien" name="adresse" autofocus value="{{
                                    old('adresse') ? : (isset($house->adresse) ? $house->adresse : old('adresse'))
                                }}">
                                @if ($errors->has('adresse'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adresse') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <label for="house_id" style="display:none">house_id</label>
                        <input id="house_id" value="{{$house->id}}" hidden>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Telephone</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="phone" placeholder="Saisir un numéro de téléphone" autofocus value="{{
                                    old('phone') ? : (isset($house->phone) ? $house->phone : old('phone'))
                                }}">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Prix / la nuit</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="price" placeholder="Saisir le prix de la nuit par personnes" value="{{
                                    old('price') ? : (isset($house->price) ? $house->price : old('price'))
                                }}">
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">                            
                            <div class="col-md-12">
                                <img class="img-responsive img_house" src="{{ asset('img/houses/'.$house->photo) }}" id="image-photo" alt="photo de l'annonce">
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="photo">Photo</label>
                            <div class="col-md-6">
                            <input id="photo" type="file" class="form-control" name="photo" autofocus value="{{
                                old('photo') ? : (isset($house->photo) ? $house->photo : old('photo'))
                            }}">
                            @if ($errors->has('photo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                            <label for="from" class="col-md-4 control-label">Date de début</label>
                            <div class="col-md-6">
                                <?php \Date::setLocale('fr'); $house->start_date = Date::parse($house->start_date)->format('d/m/Y');?>
                                <input type="text" required class="form-control" id="from" placeholder="Saisir la date de début" name="start_date" value="{{
                                    old('start_date') ? : (isset($house->start_date) ? $house->start_date : old('start_date'))
                                }}" />
                                @if ($errors->has('start_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                            <label for="to" class="col-md-4 control-label">Date de fin</label>
                            <div class="col-md-6">
                                <?php \Date::setLocale('fr'); $house->end_date = Date::parse($house->end_date)->format('d/m/Y');?>
                                <input type="text" required class="form-control" id="to" placeholder="Saisir la date de fin" name="end_date" value="{{
                                    old('end_date') ? : (isset($house->end_date) ? $house->end_date : old('end_date'))
                                }}" />
                                @if ($errors->has('end_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="description" placeholder="Saisir une description ne dépassant par 500 caractères" rows="5" id="description">{{
                                    old('description') ? : (isset($house->description) ? $house->description : old('description'))
                                }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn_reserve">
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
    <script>let site = "{{ env('APP_URL') }}"; </script>
    <script src="{{ asset('js/calendarCreateAnnonce.js') }}"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOt3g2OEb6Br_DmsDwVgciAFiDdE5Qh0E&callback=initAutocomplete&libraries=places&v=weekly&language=fr"
      defer
    ></script>
    <script src="{{ asset('js/autocomplete_address.js') }}"></script>
    <script src="{{ asset('js/edit_house.js') }}"></script>
    <script src="{{ asset('js/proprietes.js') }}"></script>
@endsection
