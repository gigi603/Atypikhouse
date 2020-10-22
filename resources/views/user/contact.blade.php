@extends('layouts.app') 
@section('title', 'Contact')
@section('meta_description', "Si vous avez une question quelconque, veuillez nous contacter via notre formulaire de contact, notre équipe fera tout pour vous répondre dans les plus bref délais")
@section('footer', 'footer_absolute')
@section('content')
    <div class="container margin-top block-size">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1 class="h1-title">Nous contacter</h1></div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('user.sendMessage') }}">
                            {{ csrf_field() }}
                            <div class="form-group"> 
                                @include('flash-message')
                                @yield('content')
                            </div>
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}"> 
                                {!! Form::label('content', 'Message : ', array('class' => 'formLabel control-label')) !!} 
                                {!! Form::textarea('content', Form::old('content'), array( 
                                    'class' => 'form-control', 
                                    'placeholder' => 'Entrer votre message', 
                                    'rows' => '8', 
                                    'cols' => '15' ,
                                    'required' => true
                                )) !!} 
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-check{{ $errors->has('agree') ? ' has-error' : '' }}">
                                <label class="form-check-label label-home" for="accept-give-infos">
                                <input type="checkbox" id="accept-give-infos" class="form-check-input" name="agree" value="true" > En soumettant ce formulaire, j'accepte que les informations saisies soient exploitées dans le cadre professionnel</label>
                                @if ($errors->has('agree'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('agree') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input type="submit" class="btn btn-success btn-color" value="Envoyer"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
