@extends('layouts.app')
@section('title', 'Etape 5')
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
                {!! Breadcrumbs::render('page5') !!}
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('house.postcreate_step5')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <p>5. Passons aux photos</p>
                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Photo</label>

                            <div class="col-md-6">
                                <input id="name" type="file" class="form-control" name="photo" required value="{{
                                    old('photo') ? : (isset($photo) ? $photo : old('photo'))
                                }}">
                                @if ($errors->has('photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-color">
                                    Créer l'hebergement
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
@section('script')
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/create_house.js') }}"></script>
@endsection
           
