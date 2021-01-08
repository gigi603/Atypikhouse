@section('styles')
<style>
    @font-face {
        font-family: 'Comfortaa';
        src: url('/fonts/Comfortaa/static/Comfortaa-Bold.ttf') format('truetype');
    }
    .intro-body {
        display: table-cell;
        vertical-align: middle;
        text-align: center;
    }
    .title-intro {
        color: #000;
        font-size: 30px;
    }
    .label-custom {
        color: black;
        line-height: 1.4;
        letter-spacing: 1px;
        margin: 0;
    }
    .form-horizontal .form-group {
        margin: 0;
        padding: 10px;
    }
    .cadre {
        background-color: #FFF;
        padding: 20px 0;
        border-radius: 4px !important;
    }
    .cadre-home {
        background-color: #FFF;
        padding: 20px 0;
        border-radius: 4px !important;
        margin: 18.6vh 0;
    }
    .reservation-search {
        display:block;
    }
    .field-home {
        width: 200px;
        height: 50px;
        border-radius: 5px;
        font-size: 15px;
        margin-bottom: 20px !important;
    }
    .date-field-home {
        width: 50% !important;
        height: 50px;
        border-radius: 5px;
        margin-bottom: 20px !important;
    }
    #hebergements {
        margin-bottom: 20vh;
    }
    .btn-principal {
        background-color: #3f4b30;
        color: #FFFBFC;
        border-color: #3f4b30;
        padding: 12px 24px;
        font-size: 18px;
        border-radius: 30px;
        margin-top: 5vh;
        transition: transform .2s;
    }
    .btn-principal:hover {
        background-color: #3f4b30;
        color: #FFFBFC;
        border-color: #3f4b30;
        transform: scale(1.1);
    }

    .card-houses {
        position: relative;
        background-color: #fff;
        transition: transform .2s;
        margin-bottom: 40px;
        width:100%;
    }
    .card-block {
	padding: 15px 15px;
	background-color: #FFF;
    }

    .card-title a{
        color: #000;
    }

    .title-houses {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #000;
    }

    .img-houses-list {
        display: block;
        width: 100%;
        height: 250px;
        background-color: gray;
    }

    .price {
        font-weight: 500;
        font-size: 22px;
        color: #000;
        margin: 0;
    }

    .star-size {
        width: 30px;
        height: 30px;
    }
    .rating span {
        vertical-align: top;
    }

    .rating-comment:hover {
        float: left;
        width: 250px;
        color:#3f4b30;
    }

    /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t 
        follow these rules. Every browser that supports :checked also supports :not(), so
        it doesn’t make the test unnecessarily selective */
    .rating:not(:checked) > input {
        position:absolute;
        visibility:hidden;
    }

    .rating:not(:checked) > label {
        float:right;
        width:1em;
        padding:0;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:150%;
        color: lightgray;
        /*background-color: #3f4b30;*/
    }

    .rating:not(:checked) > label:before {
        content: '★';
        width:5px;
        height:5px;
    }

    .rating > input:checked ~ label {
        color: #3f4b30;
        background-color: #FFF;
        
    }

    .rating:not(:checked) > label:hover,
    .rating:not(:checked) > label:hover ~ label {
        color: #3f4b30;
        background-color: #FFF;
        
    }

    .rating > input:checked + label:hover,
    .rating > input:checked + label:hover ~ label,
    .rating > input:checked ~ label:hover,
    .rating > input:checked ~ label:hover ~ label,
    .rating > label:hover ~ input:checked ~ label {
        color: #3f4b30;
        
    }

    .rating > label:active {
        position:relative;
        top:2px;
        left:2px;
    }
</style>
@endsection
        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                <label class="label-custom" for="select_category_home">Type d'annonces </label>
                <select id="select_category_home" name="category_id" required class="form-control field-home">
                        @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected="selected" @endif>{{$category->category}}</option>
                        @endforeach
                </select>
                @if ($errors->has('category_id'))
                        <span class="help-block">
                                <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                @endif
        </div>
        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}{{ $errors->has('end_date') ? ' has-error' : '' }}">
                <label class="label-custom" for="fromHome">Date de départ / </label>
               <label class="label-custom" for="toHome">Date de retour</label><br>
                <input type="text" class="form-control date-field-home" required id="fromHome" placeholder="Date de départ" name="start_date" value="{{old('start_date') ? old('start_date') : Carbon\Carbon::today()->format('d/m/Y')}}" />
                <input type="text" class="form-control date-field-home" required id="toHome" placeholder="Date de retour" name="end_date" value="{{old('end_date') ? old('end_date') : Carbon\Carbon::today()->addWeek()->format('d/m/Y') }}" />
                @if ($errors->has('start_date'))
                        <span class="help-block">
                                <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                @endif
                @if ($errors->has('end_date'))
                        <span class="help-block">
                                <strong>{{ $errors->first('end_date') }}</strong>
                        </span>
                @endif
        </div>
        <div class="form-group{{ $errors->has('nb_personnes') ? ' has-error' : '' }}">
                <label class="label-custom" for="nb_personnes_id">Nombre de personnes</label>
                <select id="nb_personnes_id" name="nb_personnes" required class="form-control field-home">
                        <option id="" value="">Nombre de personnes</option>
                        <option value="1" @if(old('nb_personnes') == "1") selected="selected" @endif>1</option>
                        <option value="2" @if(old('nb_personnes') == "2") selected="selected" @else selected="selected" @endif>2</option>
                        <option value="3" @if(old('nb_personnes') == "3") selected="selected" @endif>3</option>
                        <option value="4" @if(old('nb_personnes') == "4") selected="selected" @endif>4</option>
                        <option value="5" @if(old('nb_personnes') == "5") selected="selected" @endif>5</option>
                        <option value="6" @if(old('nb_personnes') == "6") selected="selected" @endif>6</option>
                        <option value="7" @if(old('nb_personnes') == "7") selected="selected" @endif>7</option>
                        <option value="8" @if(old('nb_personnes') == "8") selected="selected" @endif>8</option>
                        <option value="9" @if(old('nb_personnes') == "9") selected="selected" @endif>9</option>
                        <option value="10" @if(old('nb_personnes') == "10") selected="selected" @endif>10</option>
                        <option value="11" @if(old('nb_personnes') == "11") selected="selected" @endif>11</option>
                        <option value="12" @if(old('nb_personnes') == "12") selected="selected" @endif>12</option>
                        <option value="13" @if(old('nb_personnes') == "13") selected="selected" @endif>13</option>
                        <option value="14" @if(old('nb_personnes') == "14") selected="selected" @endif>14</option>
                        <option value="15" @if(old('nb_personnes') == "15") selected="selected" @endif>15</option>
                        <option value="16" @if(old('nb_personnes') == "16") selected="selected" @endif>16</option>
                </select>
                @if ($errors->has('nb_personnes'))
                        <span class="help-block">
                                <strong>{{ $errors->first('nb_personnes') }}</strong>
                        </span>
                @endif
        </div>
        <button class="btn btn-principal">Rechercher</button>
@section('script')
        <script src="{{ asset('js/calendarHome.js') }}"></script>
@endsection
