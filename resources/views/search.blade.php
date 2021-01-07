@section('styles')
<link href="{{asset("/fontawesome/css/all.min.css") }}" rel="stylesheet">
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
    .label-home {
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

    .btn-principal-black{
        background-color: #000;
        color: #FFF;
        border-color: #000;
        padding: 12px 24px;
        font-size: 18px;
        border-radius: 30px;
        text-align: center;
        margin: 15vh 5vh 0 5vh;
    }
    .btn-principal-black:hover {
        background-color: #FFF;
        color: #000;
        border-color: #000;
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
    .annonces-block {
        margin-top: 120px;
        min-height: 500px !important;
    }
    .hebergement-title {
        text-align: center;
        margin: 60px;
        color: #FFF;
        font-family: 'Comfortaa', cursive;
    }

    .title-houses {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .background-houses {
        background-color: #3f4b30;
    }
    .card-houses {
        position: relative;
        background-color: #fff;
        transition: transform .2s;
        margin-bottom: 40px;
        width:100%;
    }

    .card-houses:hover {
        transform: scale(1.1);
    }

    .card-block-home {
        padding: 15px 15px;
        background-color: #000;
    }

    .card-title-home a{
        color: #FFF;
    }
    .card-block {
        padding: 15px 15px;
        background-color: #FFF;
    }
    .card-body {
        display: flex;
        justify-content: flex-start;
        padding: 0;
        color: #000;
    }
    .img-houses-list {
        display: block;
        width: 100%;
        height: 250px;
        background-color: gray;
    }
    #block_home_2 {
        position: relative;
        background-color: white;
        color: #3f4b30;
        display: flex;
        flex-flow: row wrap;
        justify-content: space-around;
        padding: 5vh 0;
    }
    .block_home_2_child {
        width: 350px;
        text-align: center;
        margin: 0 20px;
        padding: 20px;
    }

    .block_home_2_child i,
    .block_home_2_child h3,
    .block_home_2_child p {
        margin: 15px 0;
        color: #3f4b30;
    }

    .nature_yours {
        background-color: #FFF;
        color: #000;
        font-family: 'Open Sans', sans-serif;
        font-family: 'Comfortaa', cursive;
        font-size: 60px;
        padding-top: 5%;
    }

    #hebergement-title{
        font-family: 'Comfortaa', cursive;
    }

    .voyage {
        border-radius: 20px;
        width:100%;
    }

    .avantage-title {
        font-family: 'Comfortaa', cursive;
    }

    .become_hote {
        background-color: #FFF;
        color: #000;
        font-family: 'Comfortaa', cursive;
        font-size: 60px;
        padding: 13% 0 5% 0;
        
    }
</style>
@endsection
        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                <label class="label-home" for="select_category_home">Type d'annonces </label>
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
                <label class="label-home" for="fromHome">Date de départ / </label>
               <label class="label-home" for="toHome">Date de retour</label><br>
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
                <label class="label-home" for="nb_personnes_id">Nombre de personnes</label>
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
