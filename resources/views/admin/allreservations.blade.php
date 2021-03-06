@extends('layouts.admin')
@section('title', 'Reservations')
@section('content')
    <div class="card mb-3">
        @if (Session::has('success'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card-header">
        <h1 style="font-size:20px;">
            Liste des réservations
        </h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Titre</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Client</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @foreach ($reservations as $reservation)  
                        <tbody>
                            <tr>
                                <td style="width:250px"><img src="{{ asset('img/houses/'.$reservation->house->photo) }}" class="photo-size"/></td>
                                <td>{{$reservation->title}}</td>
                                <td><?php \Date::setLocale('fr'); $startdate = Date::parse($reservation->start_date)->format('l j F Y'); echo($startdate);?></td>
                                <td><?php \Date::setLocale('fr'); $enddate = Date::parse($reservation->end_date)->format('l j F Y'); echo($enddate);?></td>
                                <td>{{$reservation->user->prenom}} {{$reservation->user->nom}}</td>
                                <td><a href="{{action('AdminController@showreservations', $reservation->id)}}" class="btn btn-primary btn-tableau">Voir</a><br/>
                                {{-- <a href="{{action('AdminController@disableHouse', $reservation->id)}}" class="btn btn-danger delete-annonce">Supprimer</a></td> --}}
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <span>{{ $reservations->links() }}</span>
                        </div>
                    </div>
                </div>         
            </div>
        </div>
    </div>
@endsection
