@extends('layouts.admin')
@section('title', "Annonces modifiées atypikhouse")
@section('content')
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
    <div class="card mb-3">
        <div class="card-header">
            <h1 style="font-size:20px;">Annonces modifiées par les clients</h1>
    </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nom / Prénom</th>
                    <th>Email</th>
                    <th> Actions</th>
                </tr>
                </thead>
                @foreach($posts as $post)
                    @if($post["unread"] == true)
                        <tbody style="background-color:#dff0d8">
                            <tr>
                                <td>{{$post->name}}</td>
                                <td>{{$post->email}}</td>
                                <td><a href="{{route('admin.showmessageannonces_modified', $post->id)}}" class="btn btn-primary">Voir</a></td>
                            </tr>
                        </tbody>
                    @else
                        <tbody>
                            <tr>
                                <td>{{$post->name}}</td>
                                <td>{{$post->email}}</td>
                                <td><a href="{{route('admin.showmessageannonces_modified', $post->id)}}" class="btn btn-primary">Voir</a></td>
                            </tr>
                        </tbody>
                    @endif
                @endforeach
            </table>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <span>{{ $posts->links() }}</span>
                    </div>
                </div>
            </div>  
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection
