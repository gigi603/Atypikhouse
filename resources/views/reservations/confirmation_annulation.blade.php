@extends('layouts.app')
@section('title', 'Confirmation paiement sur atypikhouse')
@section('link')
@section('footer', 'footer_absolute')
@section('content')
    <div class="container margin-top block-size">
        @if (Session::has('error-stripe'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                {{ Session::get('error-stripe') }}
            </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading text-center"><h1 style="font-size:30px;">Confirmation de votre annulation</h1></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card text-center">
                            <p class="card-text">Vous avez bien annuler pour le <?php \Date::setLocale('fr'); $startdate = Date::parse($reservation->start_date)->format('l j F Y'); echo($startdate);?> au <?php \Date::setLocale('fr'); $enddate = Date::parse($reservation->end_date)->format('l j F Y'); echo($enddate);?></p>
                            <p class="card-text">Vous pouvez consulter votre annulation en allant dans la rubrique "mon espace > mes réservations annulées" ou cliquez directement sur le bouton en dessous, un email de confirmation vous a été envoyé</p>
                            <p class="card-text">Notre équipe vous remercie</p>
                            <div>
                                <a class="btn btn-success btn_reserve" href="{{ route('user.reservationsannulees') }}">Consulter mes réservations annulées</a>
                            </div> 
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
    <!-- <script src="{{ asset('js/date_french.js') }}"></script> -->
@endsection
