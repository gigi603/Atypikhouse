@extends('layouts.app')
@section('title', 'Mes notifications')
@section('styles')
    <link href="{{ asset('css/block.css') }}" rel="stylesheet">
    <style>
        .notifications-panel {
            min-height: 500px !important;
        }
        .margin-top {
            margin-top: 10vh;
        }
        .block-size {
            min-height: 68vh !important;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid block-container block-size" id="hebergements" role="notifications">
    <h1 class="title">Mes notifications</h1>
    <div class="panel panel-default notifications-panel">
        <div class="panel-heading">Liste de mes notifications</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    @foreach ($messages as $message)
                        <div class="panel panel-default" style="margin: 0; border-radius: 0;">
                            <div class="panel-body">
                                <div class="col-sm-9">
                                    {{ $message->content }}
                                </div>
                                <div class="col-sm-3 text-right">
                                    <small>Envoyé par un administrateur</small><br/>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-right mb-3 mt-3">
                        <span>{{ $messages->links() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('span.badge.badge-pill.badge-success').remove();
    </script>
@endsection
