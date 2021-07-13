@extends('layouts.app')
@section('title', "Conditions générales de d'utilisation")
@section('meta_description', "Nous vous mettons à disposition nos conditions générale d'utilisation")
@section('styles')
    <style>
        .block {
            padding: 20px;
        }

        @media screen and (min-width: 1000px) and (max-width: 1920px){
            footer {
                background-color: #ededeb;
                padding: 20px;
                position: absolute;
                bottom: 0;
                width: 100%;
                clear: both;
                border: solid 1px #ededeb
            }
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h1 class="title">Conditions Générale d'utilisation</h1>
        <div class="block">
            <p>Le site accessible par l’url www.atypikhouse.fr est exploité dans le respect de la législation française. L'utilisation de ce site est régie par les présentes conditions générales.  En utilisant le site, vous reconnaissez avoir 18 ans ou plus et vous autorisez atypikhouse à vous contacter de façon personnalisée à propos de ses services pour assurer votre sécurité et améliorer les services proposés par atypikhouse. Vos données personnelles ne seront jamais communiquées à des tiers. Après avoir pris connaissance de ces conditions et les avoir acceptées, celles-ci pourront êtres modifiées à tout moment et sans préavis par la société. Eurodev Agency ne saurait être tenu pour responsable en aucune manière d’une mauvaise utilisation du service.</p>
        </div>
    </div>
@endsection
@section('footer_class', 'footer')
@section('script')
@endsection
