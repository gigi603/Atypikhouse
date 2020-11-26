@extends('layouts.error')
@section('title', "Oups une erreur est survenue")
@section('meta_description', "Vous demandez l'accès à une page qui ne figure pas sur notre application")
@section('content')
    <div class="container margin-top block-size" role="Page non trouvée sur atypikhouse">
        <h1 class="h1-title">Oups, une erreur est survenue</h1>
        <div class="row">
            <div class="container">
                <div class="block">
                    Désolé mais une erreur est survenue, nous travaillons et faisons tout notre possible pour régler ce problème dans les plus bref délais.
                </div>
            </div>
        </div>
    </div>
@endsection
