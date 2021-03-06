@extends('layouts.app')
@section('title', 'Conditions générales de vente')
@section('meta_description', "Nous vous mettons à disposition nos conditions générales de vente")
@section('styles')
    <style>
        .img-cgv {
            display: block;
            margin: 0 auto;
            width: 800px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h1 class="title" >Conditions Générales de vente</h1>
        <div class="block">
            <img class="img-cgv" src="{{ asset('/img/cgv/cgvpage1.png') }}" alt="cgv1"/><br/>
            <img class="img-cgv" src="{{ asset('/img/cgv/cgvpage2.png') }}" alt="cgv2"/><br/>
            <img class="img-cgv" src="{{ asset('/img/cgv/cgvpage3.png') }}" alt="cgv3"/><br/>
            <img class="img-cgv" src="{{ asset('/img/cgv/cgvpage4.png') }}" alt="cgv4"/><br/>
            <img class="img-cgv" src="{{ asset('/img/cgv/cgvpage5.png') }}" alt="cgv5"/><br/>
            <img class="img-cgv" src="{{ asset('/img/cgv/cgvpage6.png') }}" alt="cgv6"/><br/>
            <img class="img-cgv" src="{{ asset('/img/cgv/cgvpage7.png') }}" alt="cgv7"/><br/>
            <img class="img-cgv" src="{{ asset('/img/cgv/cgvpage8.png') }}" alt="cgv8"/><br/>
            <img class="img-cgv" src="{{ asset('/img/cgv/cgvpage9.png') }}" alt="cgv9"/><br/>
            <img class="img-cgv" src="{{ asset('/img/cgv/cgvpage10.png') }}" alt="cgv10"/><br/>
            <img class="img-cgv" src="{{ asset('/img/cgv/cgvpage11.png') }}" alt="cgv11"/><br/>
            <img class="img-cgv" src="{{ asset('/img/cgv/cgvpage12.png') }}" alt="cgv12"/><br/>
            <img class="img-cgv" src="{{ asset('/img/cgv/cgvpage13.png') }}" alt="cgv13"/><br/>
        </div>
    </div>
@endsection
@section('footer', 'footer')
@section('script')
@endsection
