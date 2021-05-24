@extends('layouts.admin')
@section('title', 'Utilisateurs')
@section('content')
<!-- Icon Cards-->

<div class="card mb-3">
    <div class="card-header">
      <h1 style="font-size:20px;">Liste des utilisateurs</h1>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nom / Prénom</th>
              <th>Profil</th>
              <th>Annonces</th>
              <th>Réservations en cours</th>
              <th>Réservations passées</th>
              <th>Réservations annulées</th>
              <th>Messages</th>
              <th>Compte activé</th>
              <th>Actions</th>
            </tr>
          </thead>
          @foreach($users as $user)
            <tbody>
                <tr>
                    <td>{{$user->nom}} {{$user->prenom}}</td>
                    <td><a href="{{action('AdminController@profilUser', $user['id'])}}" class="btn btn-primary">Profil</a></td>
                    <td><a href="{{action('AdminController@listannonces', $user['id'])}}" class="btn btn-success">Annonces</a></td>
                    <td><a href="{{action('AdminController@listreservations', $user['id'])}}" class="btn btn-info">Réservations</a></td>
                    <td><a href="{{action('AdminController@listhistoriques', $user['id'])}}" class="btn btn-info">Réservations passées</a></td>
                    <td><a href="{{action('AdminController@listreservationscancel', $user['id'])}}" class="btn btn-info">Réservations annulées</a></td>
                    <td><a href="{{action('AdminController@messages', $user['id'])}}" class="btn btn-info">Messages</a></td>
                    <td>{{$user->statut}}</td>
                    @if($user->statut ==  1)
                        <td><a href="{{ route('admin.disable_user', $user->id) }}" class="delete-user btn btn-danger">Désactiver</a></td>
                    @else
                        <td><a href="{{ route('admin.activate_user', $user->id) }}" class="btn btn-success">Activer</a></td>
                    @endif
                </tr>
            </tbody>
            @endforeach
        </table>
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <span>{{ $users->links() }}</span>
              </div>
          </div>
      </div>  
      </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
  </div>
</div>
</div>
@endsection
