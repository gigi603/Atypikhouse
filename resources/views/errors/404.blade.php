@extends('layouts.error')
@section('title', "Désolé la page demandée n'existe pas")
@section('meta_description', "Vous demandez l'accès à une page qui ne figure pas sur notre application")
@section('content')
    <div class="container margin-top block-size" role="Page non trouvée sur atypikhouse">
        <h1 class="title">Page inexistante</h1>
        <div class="row">
            <div class="container">
                <div class="block">
                    Désolé mais la page que vous cherchez n'existe pas ou l'url correspondante n'est pas la bonne.
                </div>
            </div>
        </div>
    </div>
@endsection
