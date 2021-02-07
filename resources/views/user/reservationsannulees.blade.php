@extends('layouts.app')
@section('title', 'Mes réservations annulées atypikhouse')
@section('styles')
    <style>
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

        @media screen and (max-width: 765px) {
            .card-houses {
                position: relative;
                background-color: #fff;
                transition: transform .2s;
                margin: 0 auto;
                margin-bottom: 40px;
                width:380px;
                align-items: center !important;
            }
            .col-md-3 {
                width: 100%;
            }
        }

        @media screen and (min-width: 765px) and (max-width: 1200px) {
            .col-md-3 {
                width: 50%;
            }
        }

        @media screen and (min-width: 1200px) and (max-width: 1620px){
            .col-lg-3 {
                width: 33%;
            }
        }
    </style>
@endsection
@section('content')
<div class="container-fluid block-container block-size" role="reservations-annulees">
    @if (Session::has('success'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            {{ Session::get('success') }}
        </div>
    @endif
    <h1 class="title" id="hebergements">Mes réservations annulées atypikhouse</h1>
    <div class="row">
        <?php $nb_reservations = 0; ?>
        @foreach ($reservations as $reservation)
        <?php $nb_reservations = $nb_reservations + 1; ?>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">         
                <div class="card-houses text-center">       
                    <a href="{{action('UsersController@showreservationsannulees', $reservation['id'])}}"><img class="img-houses-list" data-src="{{ asset('img/houses/'.$reservation->house->photo) }}" alt="Hébergement insolite - {{$reservation->title}}"></a>
                    <div class="card-block">
                        <div class="card-body">
                            <h2 class="card-title title-houses"><a href="{{route('user.showreservationsannulees', $reservation['id']) }}"> {{$reservation->title}} </a></h2>
                        </div>
                        <p class="price">Total payé: {{$reservation->total}}€ <br> pour {{$reservation->nb_personnes}} personne(s)</p>
                        <div class="card-infos">
                            <p>Type de bien : {{$reservation->house->category->category}}</p>
                            @foreach($reservation->house->valuecatproprietes as $valuecatpropriete)
                                @if($loop->iteration > 0)
                                    @if($valuecatpropriete->value == 0)
                                    @else
                                        <p>{{$valuecatpropriete->propriete->propriete}}: {{$valuecatpropriete->value}}</p> 
                                    @endif
                                @break   
                                @endif      
                            @endforeach      
                            <p>Annulation gratuite !</p>
                            <p><i class="fas fa-calendar"></i> Du: <?php \Date::setLocale('fr'); $startdate = Date::parse($reservation->start_date)->format('l j F Y'); echo($startdate);?> </p>
                            <p><i class="fas fa-calendar"></i> au:  <?php \Date::setLocale('fr'); $enddate = Date::parse($reservation->end_date)->format('l j F Y'); echo($enddate);?></p>
                            <p class="card-text"><?php echo(substr($reservation->house->description, 0, 30));?></p>
                            <div class="text-center">
                                <a href="{{route('user.showreservationsannulees', $reservation['id']) }}" class="btn btn-primary btn-color">Voir la reservation annulée</a>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        @endforeach
    </div>
    <div class="text-right mb-3 mt-3">
        <span>{{ $reservations->links() }}</span>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('span.badge.badge-pill.badge-success').remove();
    </script>
    <script src="{{ asset('js/user.js') }}"></script>
    <script>
        $('span.badge.badge-pill.badge-success').remove();
    </script>
    <script>
        var nb_reservations = <?php echo json_encode($nb_reservations); ?>;
        if(nb_reservations >= 4){
            document.getElementById('footer').className = 'footer';
        } else {
            document.getElementById('footer').className = 'footer_absolute'; 
        } 
    </script>
@endsection