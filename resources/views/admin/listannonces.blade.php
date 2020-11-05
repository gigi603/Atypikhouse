@extends('layouts.admin')
@section('title', "Détails de l'annonce atypikhouse")
@section('content')
    <div class="card mb-3">
        <div class="card-header">
        <h1 style="font-size:20px;">
            <i class="fas fa-table"></i>
            Annonces de {{$user->prenom}} {{$user->nom}}
        </h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th> Actions</th>
                </tr>
                </thead>
                @foreach($houses as $house)
                <tbody>
                    <tr>
                        <td>{{$house->title}}</td>
                        <td><?php \Date::setLocale('fr'); $startdate = Date::parse($house->start_date)->format('l j F Y'); echo($startdate);?></td>
                        <td><?php \Date::setLocale('fr'); $enddate = Date::parse($house->end_date)->format('l j F Y'); echo($enddate);?></td>
                        <td><a href="{{action('AdminController@showannonces', $house->id)}}" class="btn btn-primary">Voir</a></td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <span>{{ $houses->links() }}</span>
                    </div>
                </div>
            </div>  
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection
