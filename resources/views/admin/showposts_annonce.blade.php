@extends('layouts.admin')
@section('title', 'Détails du message')
@section('content')
<div class="admin-user-profil">
    @if (Session::has('success-valide'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {{ Session::get('success-valide') }}
    </div>
    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {{ Session::get('error') }}
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1 style="font-size:20px;">Notification</h1></div>
                    
                    <div class="panel-body card-message">
                        <p>Nom / Prénom: {{$post->name}}</p>
                        <p>Email: {{$post->email}}</p>
                        <p>{{$post->content}}</p>                           
                    </div>
                </div>
                <div class="panel panel-default" style="margin: 0; border-radius: 0;">
                    <div class="panel-body text-center">
                        <a href="{{route('admin.showannonces', $house->id)}}" class="btn btn-primary">Voir l'annonce </a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
