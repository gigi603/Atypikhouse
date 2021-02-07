@extends('layouts.app')
@section('title', 'Mes reservations passées atypikhouse')
@section('styles')
    <style>
        .form-horizontal .form-group {
            margin: 0;
            padding: 10px;
        }
        .card-houses {
            position: relative;
            background-color: #fff;
            transition: transform .2s;
            margin-bottom: 40px;
            width: 350px;
        }
        .img-houses-list {
            display: block;
            width: 100%;
            height: 250px;
            background-color: gray;
        }
        .card-block {
            padding: 15px 15px;
            background-color: #FFF;
        }
        .card-title a{
            color: #000 !important;
        }
        .title-houses {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .btn-color {
            background-color: #3f4b30;
            border-color: #3f4b30;
            color:#FFFBFC !important;
        }
        .btn-color:hover {
            background-color: #3f4b30;
            border-color: #3f4b30;
            color:#FFFBFC !important;
        }

        @media screen and (max-width: 765px) {
            .card-houses {
                position: relative;
                background-color: #fff;
                transition: transform .2s;
                margin: 0 auto;
                margin-bottom: 40px;
                width:380px;
                align-items: center !important;
            }
            .col-md-3 {
                width: 100%;
            }
        }

        @media screen and (min-width: 765px) and (max-width: 1200px) {
            .col-md-3 {
                width: 50%;
            }
        }

        @media screen and (min-width: 1200px) and (max-width: 1620px){
            .col-lg-3 {
                width: 33%;
            }
        }
    </style>
@endsection
@section('content')
<div class="container-fluid block-container block-size" role="historiques">
    <h1 class="title" id="hebergements">Mes réservations passées atypikhouse</h1>
    <div class="row">
        <?php $nb_historiques = 0; ?>
        @if(count($historiques) >= 5)
            @foreach ($historiques as $historique)
                <?php $nb_historiques = $nb_historiques + 1; ?>    
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">         
                    <div class="card-houses text-center">       
                        <a href="{{action('UsersController@showhistoriques', $historique->id)}}"><img class="img-houses-list" data-src="{{ asset('img/houses/'.$historique->house->photo) }}" alt="Hébergement insolite - {{$historique->title}}"></a>
                        <div class="card-block">
                            <div class="card-body">
                                <h2 class="card-title title-houses"><a href="{{route('user.showhistoriques', $historique->id) }}">{{$historique->title}}</a></h2>
                            </div>
                            <p class="price">Total payé: {{$historique->total}}€ <br> pour {{$historique->nb_personnes}} personne(s)</p>
                            <div class="card-infos">
                                <p>Type de bien : {{$historique->house->category->category}}</p>
                                @foreach($historique->house->valuecatproprietes as $valuecatpropriete)
                                    @if($loop->iteration > 0)
                                        @if($valuecatpropriete->value == 0)
                                        @else
                                            <p>{{$valuecatpropriete->propriete->propriete}}: {{$valuecatpropriete->value}}</p> 
                                        @endif
                                    @break   
                                    @endif      
                                @endforeach      
                                <p>Annulation gratuite !</p>
                                <p class="title-houses"> Adresse: {{$historique->house->adresse}}</p> 
                                <p><i class="fas fa-calendar"></i> Du: <?php \Date::setLocale('fr'); $startdate = Date::parse($historique->start_date)->format('l j F Y'); echo($startdate);?> </p>
                                <p><i class="fas fa-calendar"></i> au:  <?php \Date::setLocale('fr'); $enddate = Date::parse($historique->end_date)->format('l j F Y'); echo($enddate);?></p>
                                <a href="{{route('user.showhistoriques', $historique->id) }}" class="btn btn-primary btn-color">Voir la reservation passée</a>
                                @if($historique->reserved != 1)
                                    <p>Cette reservation passée a été : <span style="color:red;">Annulée</span></p>
                                @endif
                            </div>
                        </div> 
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="text-right mb-3 mt-3">
        <span>{{ $historiques->links() }}</span>
    </div>
</div>
@endsection
@section('script')
    <script>
        var nb_historiques = <?php echo json_encode($nb_historiques); ?>;
        if(nb_historiques >= 4){
            document.getElementById('footer').className = 'footer';
        } else {
            document.getElementById('footer').className = 'footer_absolute'; 
        } 
    </script>
</script>
@endsection
