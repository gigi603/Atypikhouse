@extends('layouts.app')
@section('title', 'Mon profil')
@section('styles')
    <style>
        .block {
            padding: 10px;
            margin: 10vh;
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
<div class="container margin-top block-size" role="mon profil">
    <h1 class="title">Mon profil</h1>
    <div class="row">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <p>{!! \Session::get('success') !!}</p>
                </ul>
            </div>
        @endif
        <div class="container">
            <div class="block">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-sm-12 col-xs-12">
                            <form class="form-horizontal" method="POST" action="{{action('UsersController@edit', Auth::user()->id)}}" enctype="multipart/form-data">                      
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                                    <label for="nom" class="col-md-4 control-label">Nom</label>
        
                                    <div class="col-md-6">
                                        <input id="nom" type="text" class="form-control" placeholder="Saisir votre nom" name="nom" value="{{
                                            old('nom') ? : (isset(Auth::user()->nom) ? Auth::user()->nom : old('nom'))
                                        }}">
                                        @if ($errors->has('nom'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nom') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
                                    <label for="prenom" class="col-md-4 control-label">Prénom</label>
        
                                    <div class="col-md-6">
                                        <input id="prenom" type="text" class="form-control" placeholder="Saisir votre prénom" name="prenom" value="{{
                                            old('prenom') ? : (isset(Auth::user()->prenom) ? Auth::user()->prenom : old('prenom'))
                                        }}">
                                        @if ($errors->has('prenom'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('prenom') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Email</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" placeholder="Saisir votre email" name="email" value="{{
                                            old('email') ? : (isset(Auth::user()->email) ? Auth::user()->email : old('email'))
                                        }}">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-check{{ $errors->has('newsletter') ? ' has-error' : '' }}">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-6">
                                        <input type="checkbox" id="newsletter" class="form-check-input" name="newsletter" value="1" {{(Auth::user()->newsletter == 1 ? 'checked' : '')}}>
                                        <label class="form-check-label" for="newsletter">Recevoir les newsletters</label>
                                        @if ($errors->has('newsletter'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('newsletter') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                </p>
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary btn-color">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" style="margin-top:50px;margin-bottom:50px;">
                            <a href="{{route('user.deleteAccount', Auth::user()->id)}}" class="delete delete-user btn btn-danger" >Supprimer mon compte</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('js/user.js') }}"></script>
    <script>
        document.getElementById("footer").className = "footer_absolute"; 
    </script>
@endsection