@extends('layouts.app')
@section('title', "Confirmation de la création de l'annonce")
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
            color:#FFFBFC !important;
        }
        .btn-color:hover {
            background-color: #3f4b30;
            border-color: #3f4b30;
            color:#FFFBFC !important;
        }
    </style>
@endsection
@section('content')
<div class="container margin-top block-size">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 style="font-size:30px;text-align:center;">Confirmation de la création de votre annonce</h1></div>
                
                <div class="panel-body">
                    <p>Votre annonce a bien été prise en compte!</p>   
                    <p>Notre équipe va l'étudier et revenir vers vous.</p>
                    <p>Vous pouvez dès maintenant consulter votre annonce en appuyant sur le bouton ci-dessous</p>
                    <p>Notre équipe vous remercie!</p>
                    <div class="text-center">
                    <a href= "{{ url('/user/houses') }}" class="btn btn-success btn-color">Mes annonces</a>   
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/create_house.js') }}"></script>
@endsection
