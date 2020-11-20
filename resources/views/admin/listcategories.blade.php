@extends('layouts.admin')
@section('title', "Catégories d'annonces")
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
        Liste des catégories d'annonces</h1>
    </div>
    <div class="card-body">
        <div class="text-center">
            <form class="form-group{{ $errors->has('category') ? ' has-error' : '' }}" method="POST" action="{{route('admin.register_category')}}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Catégorie</label>
                    </div>
                    <div class="col-md-5">
                        <input id="name" type="text" class="form-control" name="category" autofocus value="{{ old('category')}}">
                        @if ($errors->has('category'))
                            <span class="help-block">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-4 text-left">
                        <button class="btn btn-primary btn-add-category">Ajouter une catégorie</button>
                    </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Catégorie d'annonces</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @foreach($categories as $category) 
                    <tbody>
                        <tr>
                            <td>{{$category->category}}</td>
                            <td>
                                <a href="{{ route('admin.proprietes_category', $category->id)}}" class="btn btn-warning"> équipements</a>
                                <a href="{{ route('admin.delete_category', $category->id) }}" class="delete btn btn-danger">Supprimer</a>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <span>{{ $categories->links() }}</span>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>    
@endsection
