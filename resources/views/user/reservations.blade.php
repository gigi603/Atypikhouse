@extends('layouts.app')
@section('title', 'Mes réservations atypikhouse')
@section('content')
<div class="container-fluid block-container block-size" role="reservations">
    @if (Session::has('success'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            {{ Session::get('success') }}
        </div>
    @endif
    <h1 class="title" id="hebergements">Mes réservations atypikhouse</h1>
    <div class="row">
        @foreach ($reservations as $reservation)
            @if($reservation->house->statut == "Validé")
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">         
                    <div class="card-houses h-100">       
                        <a href="{{action('UsersController@showreservations', $reservation['id'])}}"><img class="img-houses-list" data-src="{{ asset('img/houses/'.$reservation->house->photo) }}" alt="Hébergement insolite - {{$reservation->title}}"></a>
                        <div class="card-block">
                            <div class="card-body">
                                <h2 class="card-title title-houses"><a href="{{route('user.showreservations', $reservation['id']) }}"> {{$reservation->title}} </a></h2>
                            </div>
                            <p class="price">Total payé: {{$reservation->total}}€<br> pour {{$reservation->nb_personnes}} personne(s)</p>
                            <p>Type de bien : {{$reservation->house->category->category}}</p>
                            <p class="title-houses"> Adresse: {{$reservation->house->adresse}}</p>
                            <p><i class="fas fa-calendar"></i> Du: <?php \Date::setLocale('fr'); $startdate = Date::parse($reservation->start_date)->format('l j F Y'); echo($startdate);?> </p>
                            <p><i class="fas fa-calendar"></i> au:  <?php \Date::setLocale('fr'); $enddate = Date::parse($reservation->end_date)->format('l j F Y'); echo($enddate);?></p>
                            <a href="{{action('UsersController@showreservations', $reservation['id'])}}" class="btn btn-primary btn-color">Voir la réservation</a>
                            @if($reservation->reserved == 1)
                                <div class="text-center">
                                    <a href="{{route('user.cancelreservation', $reservation['id']) }}" class="btn btn-danger delete-reservation">Annuler ma réservation</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif  
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
@endsection