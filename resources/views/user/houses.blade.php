@extends('layouts.app')
@section('title', 'Nos Hébergements atypikhouse')
@section('styles')
    <style>
        .margin-top {
            margin-top: 10vh;
        }
        .block-size {
            min-height: 68vh !important;
        }
        .form-horizontal .form-group {
            margin: 0;
            padding: 10px;
        }
        .card-houses {
            position: relative;
            background-color: #fff;
            transition: transform .2s;
            margin-bottom: 40px;
            width: 350px;
        }
        .img-houses-list {
            display: block;
            width: 100%;
            height: 250px;
            background-color: gray;
        }
        .card-block {
            padding: 15px 15px;
            background-color: #FFF;
        }
        .card-title a{
            color: #000 !important;
        }
        .title-houses {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
<div class="container-fluid block-container block-size" role="annonces">
    <h1 class="title" id="hebergements">Mes hébergements atypikhouse</h1>
    <div class="row text-center" style="margin-bottom: 50px;">
        <a href="{{route('house.create_step1')}}" class="btn btn-primary btn-color">Ajouter une annonce</a>
    </div>
    <div class="row">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <p>{!! \Session::get('success') !!}</p>
                </ul>
            </div>
        @endif
        <?php $nb_houses = 0; ?>
        @foreach ($houses as $house)
            <?php $nb_houses = $nb_houses + 1; ?>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">         
                <div class="card-houses text-center">       
                    <a href="{{action('UsersController@showhebergements', $house['id'])}}">
                        <img class="img-houses-list" data-src="{{ asset('img/houses/'.$house->photo) }}" alt="Hébergement insolite - {{$house->title}}">
                    </a>
                    <div class="card-block">
                        <div class="card-body">
                            <h2 class="card-title title-houses"><a href="{{route('user.showhebergements', $house['id']) }}"> {{$house->title}} </a></h2>
                        </div>
                        <p class="title">{{$house->price}}€ la nuit par personne<br></p>
                        <p>Type de bien : {{$house->category->category}}</p>
                        <p class="title-houses"> Adresse: {{$house->adresse}}</p>
                        <p><i class="fas fa-calendar"></i> Du: <?php \Date::setLocale('fr'); $startdate = Date::parse($house->start_date)->format('l j F Y'); echo($startdate);?> </p>
                        <p><i class="fas fa-calendar"></i> au:  <?php \Date::setLocale('fr'); $enddate = Date::parse($house->end_date)->format('l j F Y'); echo($enddate);?></p>
                        @if($house->statut == "En attente de validation")
                            <p>Statut: <span style="color:darkred;">{{$house->statut}}</span></p>
                        @elseif($house->statut == "Refusé")
                            <p>Statut: <span style="color:darkred;">{{$house->statut}}</span></p>
                        @else
                            <p>Statut: <span style="color:darkgreen;">{{$house->statut}}</span></p>
                        @endif
                        <div class="text-center">
                            <a href="{{route('user.showhebergements', $house['id']) }}" class="btn btn-primary btn-color">Voir</a>
                            <a href="{{route('user.editHouse', $house['id']) }}" class="btn btn-primary btn-color">Modifier</a>
                            <a href="{{route('user.deleteHouse', $house['id']) }}" class="btn btn-danger delete-annonce">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>  
        @endforeach
    </div>
    <div class="text-right mb-3 mt-3">
        <span>{{ $houses->links() }}</span>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('js/user.js') }}"></script>
    <script>
        $('span.badge.badge-pill.badge-success').remove();
    </script>
    <script>
        var nb_houses = <?php echo json_encode($nb_houses); ?>;
        console.log(nb_houses);
        if(nb_houses >= 5){
            document.getElementById("footer").className = "footer";
        } else {
            document.getElementById("footer").className = "footer_absolute"; 
        }
    </script>
@endsection