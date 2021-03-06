@extends('layouts.app')
@section('title', 'Inscrivez-vous afin de réserver des espaces atypiques')
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
        p {
            color: black;
            line-height: 1.4;
            letter-spacing: 1px;
            margin: 0;
        }
        .form-horizontal .form-group {
            margin: 0;
            padding: 10px;
        }
        .label-custom {
            color: black;
            line-height: 1.4;
            letter-spacing: 1px;
            margin: 0;
        }
    </style>
@endsection
@section('content')
<div class="container margin-top block-size">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 class="title">S'inscrire</h1></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                            <label for="nom" class="col-md-4 control-label">Nom</label>

                            <div class="col-md-6">
                                <input id="nom" type="text" required class="form-control" name="nom" placeholder="Saisir votre nom" value="{{ old('nom') }}">

                                @if ($errors->has('nom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
                            <label for="prenom" class="col-md-4 control-label">Prenom</label>

                            <div class="col-md-6">
                                <input id="prenom" type="text" required class="form-control" name="prenom" placeholder="Saisir votre prénom" value="{{ old('prenom') }}">

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
                                <input id="email" type="email" required class="form-control" name="email" placeholder="Saisir votre email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email_confirmation') ? ' has-error' : '' }}">
                            <label for="email-confirm" class="col-md-4 control-label">Confirmer email</label>

                            <div class="col-md-6">
                                <input id="email-confirm" type="email" required class="form-control" name="email_confirmation" placeholder="Veuillez confirmer votre email" value="{{ old('email_confirmation') }}">
                                @if ($errors->has('email_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mot de passe</label>
                            <div class="col-md-6">
                                <input id="password" required type="password" class="form-control" placeholder="Saisir votre mot de passe" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmer mot de passe</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" required class="form-control" name="password_confirmation" placeholder="Veuillez confirmer votre mot de passe">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('date_birth') ? ' has-error' : '' }}">
                            <label for="birthday" class="col-md-4 control-label">Date de naissance</label>
                            <div class="col-md-6">
                                <input type="text" required class="form-control" id="birthday" placeholder="Saisir votre date de naissance" name="date_birth" value="{{ old('date_birth') }}" />
                                @if ($errors->has('date_birth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_birth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <a href="{{ route('cgu') }}" target="_blank" class="link-color">Voir les conditions générales d'utilisation</a>
                        </div>
                        <div class="form-check{{ $errors->has('conditions') ? ' has-error' : '' }} text-center">
                            <input type="checkbox" id="accept-cgu" class="form-check-input" name="conditions" required value="true" {{ !old('conditions') ?: 'checked' }}>
                            <label class="form-check-label" for="accept-cgu">J'accepte les conditions générales d'utilisation</label>
                            @if ($errors->has('conditions'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('conditions') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <label for="g-recaptcha-response" class="col-md-4 control-label captcha-label">Captcha</label>

                            <div class="col-md-6">
                            {!! NoCaptcha::display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-color" aria-label="m'inscrire">
                                    M'inscrire
                                </button>
                                <a href="{{route('login')}}" class="link-color">Vous avez un compte ?</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <p>Nous vous enverrons des promotions commerciales, des offres spéciales, des idées de voyage et des informations réglementaires par e-mail à condition de cocher la case autorisant notre équipe à vous envoyer des newsletters</p>
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label label-custom" for="accept-newsletter"> 
                                <input type="checkbox" id="accept-newsletter" class="form-check-input" name="newsletter" value="1" {{ old('newsletter') ? 'checked="checked"' : '' }}> Je souhaite recevoir de messages promotionnels d'Atypikhouse. Je peux également activer/désactiver cette option à tout momentdans les paramètres de mon compte ou via le lien contenu dans ce message.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/calendarSubscribeUser.js') }}"></script>
@endsection
