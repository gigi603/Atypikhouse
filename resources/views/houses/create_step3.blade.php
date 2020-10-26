@extends('layouts.app')
@section('title', 'Etape 3')
@section('content')
<div class="container margin-top">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 style="font-size:30px;text-align:center;">Créer un hébergement</h1></div>
                {!! Breadcrumbs::render('page3') !!}
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('house.postcreate_step3')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <p>3. Décrivez nous votre bien et les disponibilités</p>                     
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label" for="title">Titre de votre bien</label>
                                <div class="col-md-6">
                                    <input id="title" required type="text" class="form-control" name="title" maxlength="40" value="{{
                                        old('title') ? : (isset($title) ? $title : old('title'))
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
                                                <option {{ $categorySelected == $category->id ? "selected" : "" }} {{ (old("category_id") == $category->id ? "selected":"") }}
                                                    {{ (old("category_id") ? $categorySelected = ""  : "") }} value="{{ $category->id }}" >{{ $category->category }}</option>
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
                                    <select id="select_nb_personnes" required name="nb_personnes" class="form-control">
                                        <option id="" value="" autofocus>Nombre de personnes</option>
                                        @for($i=1;$i<17;$i++)
                                            <option {{ (old("nb_personnes") == $i ? "selected" : "") }} {{ $nb_personnes == $i ? "selected" : "" }} 
                                            {{ (old("nb_personnes") ? $nb_personnes = ""  : "") }}value="{{ $i }}"  >{{ $i }}</option>
                                        @endfor 
                                    </select>
                                    @if ($errors->has('nb_personnes'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nb_personnes') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                <label for="from" class="col-md-4 control-label">Date de début</label>
                                <div class="col-md-6">
                                    <input type="text" required class="form-control" id="from" placeholder="Date de début" name="start_date" value="{{
                                        old('start_date') ? : (isset($start_date) ? $start_date : old('start_date'))
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
                                    <input type="text" required class="form-control" id="to" placeholder="Date de fin" name="end_date" value="{{
                                        old('end_date') ? : (isset($end_date) ? $end_date : old('end_date'))
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
                                    <textarea class="form-control" name="description" rows="5" id="description" placeholder="Ne pas saisir plus de 500 caractères">{{
                                        old('description') ? : (isset($description) ? $description : old('description'))
                                    }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-color">
                                        Continuer
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
    <script>let site = "{{env('APP_URL_SITE')}}";</script>
    <script src="{{ asset('js/calendarCreateAnnonce.js') }}"></script>
    <script src="{{ asset('js/create_house.js') }}"></script>
@endsection


