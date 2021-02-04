@extends('layouts.app')
@section('title', 'Etape 1')
@section('styles')
    <style>
        .margin-top {
            margin-top: 10vh;
        }
        .block-size {
            min-height: 68vh !important;
        }
        .btn-color {
            background-color: #3f4b30;
            border-color: #3f4b30;
            color:#FFFBFC;
        }
        .btn-color:hover {
            background-color: #3f4b30;
            border-color: #3f4b30;
            color:#FFFBFC;
        }
    </style>
@endsection
@section('content')
<div class="container margin-top block-size">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 style="font-size:30px;text-align:center;">Créer un hébergement</h1></div>
                {!! Breadcrumbs::render('page1') !!}
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('house.postcreate_step1')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}  
                        <p>1. Où se situe votre bien?</p>
                        <div class="form-group{{ $errors->has('adresse') ? ' has-error' : '' }}">
                            <label for="autocomplete" class="col-md-4 control-label">Adresse</label>
                            <div class="col-md-6">
                            <input type="text" required class="form-control" id="autocomplete" name="adresse" placeholder="Saisir l'adresse du bien" value="{{
                                old('adresse') ? : (isset($adresse) ? $adresse : old('adresse'))
                            }}"/>
                                @if ($errors->has('adresse'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adresse') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input id="name" type="hidden" class="form-control" name="user_id" required autofocus value="{{ Auth::user()->id }}">
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-color" id="create_annonce_step1" >
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
@section('footer', 'footer_absolute')
@section('script')
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOt3g2OEb6Br_DmsDwVgciAFiDdE5Qh0E&callback=initAutocomplete&libraries=places&v=weekly&language=fr"
      defer
    ></script>
    <script src="{{ asset('js/autocomplete_address.js') }}"></script>
    <script>
        document.getElementById("footer").className = "footer_absolute"; 
    </script>
@endsection
