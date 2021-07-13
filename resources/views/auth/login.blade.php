@extends('layouts.app')
@section('title', 'Connectez-vous afin de pouvoir reserver des espaces atypiques')
@section('metadescription', 'Connectez-vous afin de pouvoir reserver des espaces atypiques ou de pouvoir poster vos annonces')
@section('styles')
    <style>
        .margin-top {
            margin-top: 10vh;
        }
        .block-size {
            min-height: 68vh !important;
        }
        .link-color {
            color: #3f4b30;
        }
        .link-color:hover {
            color: #3f4b30;
        }
        .link-color:active {
            color: #3f4b30;
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
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1 class="title">Se connecter</h1></div>
                    <div class="panel-body">
                        @if (Session::has('status'))
                            <div class="alert alert-success">
                                {{ Session::get('status') }}
                            </div>
                        @endif
                        @if (Session::has('errorLogin'))
                            <div class="alert alert-danger">
                                {{ Session::get('errorLogin') }}
                            </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" required class="form-control" name="email" value="{{ old('email') }}" placeholder="Saisir votre email">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Mot de passe</label>

                                <div class="col-md-6">
                                    <input id="password" required type="password" class="form-control" name="password" placeholder="Saisir votre mot de passe">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-color" aria-label="connexion">
                                        Connexion
                                    </button>
                                    <a href="{{route('password.request')}}" class="link-color">Mot de passe oubli&eacute; ?</a><br>
                                    <a href="{{route('register')}}" class="link-color">Vous n'avez pas de compte</a>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
