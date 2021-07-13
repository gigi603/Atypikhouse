@extends('layouts.admin')
@section('content')
<div id="utilisateur">
    <h1 style="font-size:20px;">Commentaires : </h1>
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
    @foreach($comments as $comment)
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr>
                    <td>{{$comment->comment}} </td>
                    <td>Note: {{$comment->note}}/5</td>
                    <td>{{$comment->title}}
                    <td>
                        <h3 class="price">{{$comment->price}}€</h3>
                    </td>
                    <td>
                        <input type="hidden" name="_method" value="DELETE">
                        <a href="{{ route('admin.deleteComment', $comment->id) }}" class="delete-comment btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @endforeach
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <span>{{ $comments->links() }}</span>
            </div>
        </div>
    </div>  
</div>
@endsection
