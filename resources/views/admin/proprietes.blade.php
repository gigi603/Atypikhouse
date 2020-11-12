@extends('layouts.admin')
@section('title', "Propriétés de la catégorie sélectionée")
@section('content')
<div class="card mb-3">
    @if ($success = Session::get('success'))
    <div class="alert alert-success">
        {{ $success }}
    </div>
    @endif
    @if ($danger = Session::get('danger'))
        <div class="alert alert-danger">
            {{ $danger }}
        </div>
    @endif
    <div class="card-header">
        <i class="fas fa-home"></i>
    <h1 style="font-size:20px;">
        Propriétés de {{$category->category}}:</h1>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form class="form-group {{ $errors->has('propriete') ? ' has-error' : '' }}" method="POST" action="{{route('admin.register_propriete')}}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-3">
                        <label for="proprietes" class="control-label">Proprieté</label>
                    </div>
                    <div class="col-md-5">
                        <input id="proprietes" type="text" class="form-control" name="propriete" autofocus value="{{ old('propriete')}}">
                        @if ($errors->has('propriete'))
                            <span class="help-block">
                                <strong>{{ $errors->first('propriete') }}</strong>
                            </span>
                        @endif
                        <input type="hidden" class="form-control" name="category_id" required autofocus value="{{$category->id}}">
                    </div>
                    <div class="col-md-4 text-left">
                        <button class="btn btn-primary btn-color">Ajouter une propriété</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Propriétés de la catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @foreach($proprietes as $propriete)
                    <tbody>
                        <tr>
                            <td>
                                <a href="">{{$propriete->propriete}}</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.delete_propriete', $propriete->id) }}" class="delete-propriete btn btn-danger">Supprimer</a>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <span>{{ $proprietes->links() }}</span>
                </div>
            </div>
        </div>  
    </div>
    @endsection
