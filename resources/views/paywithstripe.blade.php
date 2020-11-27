@extends('layouts.app')
@section('title', 'Paiement par stripe')
@section('styles')
    <link href="{{ asset('css/stripe.css') }}" rel="stylesheet">
@endsection

@section('footer', 'footer_absolute')

 
@section('content')
<div class="container margin-top block-size">
    <div class="panel panel-default marginTop">
        <div class="panel-heading text-center">
            <h1 style="font-size:30px;">Etape du paiement</h1>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card h-100 text-center">
                    <form action="{{route('addmoney.stripe')}}" method="post" id="payment-form">
                        <div class="form-row" style="padding-bottom:30px;">
                            <label for="card-element">
                            Carte de crédit
                            </label>
                            <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                            </div>

                            @if($message = Session::get('error'))
                                <div class="form-group has-error">
                                    <span class="help-block has-error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                            @endif
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                           
                            <li><a href="{{ route('cgv') }}" target="_blank" class="link-color">Voir les conditions générales de ventes</a></li>
                            <div class="form-check{{ $errors->has('agree') ? ' has-error' : '' }}">
                                <input type="checkbox" class="form-check-input" name="agree" id="form-check-label" value="true" {{ !old('agree') ?: 'checked' }}>
                                <label class="form-check-label" for="form-check-label">J'accepte les conditions générales de vente</label>
                                @if ($errors->has('agree'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('agree') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-success btn_reserve">Payer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/stripe.js') }}"></script>
@endsection

