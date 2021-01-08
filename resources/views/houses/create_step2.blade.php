@extends('layouts.app')
@section('title', 'Etape 2')
@section('styles')
    <style>
        .margin-top {
            margin-top: 10vh;
        }
        .block-size {
            min-height: 68vh !important;
        }
        .btn-color {
            background-color: #3f4b30;
            border-color: #3f4b30;
            color:#FFFBFC;
        }
        .btn-color:hover {
            background-color: #3f4b30;
            border-color: #3f4b30;
            color:#FFFBFC;
        }
    </style>
@endsection
@section('content')
<div class="container margin-top block-size">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 style="font-size:30px;text-align:center;">Créer un hébergement</h1></div>
                {!! Breadcrumbs::render('page2') !!}
                <div class="panel-body">
                    <form class="form-horizontal" autocomplete="off" method="POST" action="{{route('house.postcreate_step2')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <p>2. Numéro de téléphone à contacter pour l'annonce: (format de pays acceptés: france, belgique, italie, allemagne et l'espagne)</p>
                        <div class="form-group{{ $errors->any('phone') ? ' has-error' : '' }}">
                            <label for="telephone" class="col-md-4 control-label">Téléphone</label>
                            <div class="col-md-6">
                                <input type="text" required class="form-control telephonefield-size" name="phone"id="telephone" value="{{
                                    old('phone') ? : (isset($phone) ? $phone : old('phone'))
                                }}">
                                @if ($errors->any('phone'))
                                    <span class="help-block">
                                        <strong>Veuillez saisir un numéro de telephone valide</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                        <input type="hidden" id="digital-code" name="phone_country" required value=""/>
                            <input id="name" type="hidden" class="form-control" name="user_id" required autofocus value="{{ Auth::user()->id }}">
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-color" id="create_annonce_step2" >
                                    Continuer
                                </button>
                            </div>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer', 'footer_absolute')
@section('script')
    <script src="{{ asset('js/jquery.js') }}"></script>
@endsection
