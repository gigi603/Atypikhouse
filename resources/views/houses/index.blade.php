@extends('layouts.app')
@section('title', 'Nos hébergements atypikhouse')
@section('meta_description', "Atypikhouse contient des espaces atypiques un peu partout en europe notamment en france à grenoble, seine et marne")
@section('content')
<div class="container-fluid" role="annonces">
    <h1 class="title" id="hebergements">Nos hébergements atypikhouse</h1>
    <div class="text-center">
        <div class="container-fluid">
            <div class="row">
                <div class="input-group reservation-search">
                    <form class="form-horizontal" method="get" action="{{url('search')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-lg-3 col-md-3 col-sm-12 cadre">
                            <h2 class="title">Atypikhouse offre les meilleurs hébergements atypiques en Europe !</h2>
                            <div class="form-group reservation-search">
                                @include('search',['url'=>'search','link'=>'search'])
                            </div>
                        </div>
                        <?php $nb_houses = 0; ?>
                        @forelse($houses as $house)
                            @if($house->statut == "Validé")
                                <?php $nb_houses = $nb_houses + 1;?>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <div class="card-houses text-center">       
                                        <a href="{{action('UsersController@showHouse', $house['id'])}}"><img class="img-houses-list" data-src="{{ asset('img/houses/'.$house->photo) }}" alt="Hébergement insolite - {{$house->title}}"></a>
                                        <div class="card-block">
                                            <div class="card-body">
                                                <h3 class="card-title title-houses"><a href="{{action('UsersController@showHouse', $house->id)}}"> {{$house->title}} </a><br> {{$house->adresse}}<br></h3> 
                                            </div>
                                            <p class="price"> {{$house->price}}€ / nuit</p>
                                            <?php $note = 0; $i = 0; $moyenneNote = 0; ?>
                                            @foreach($house->comments as $comment)
                                                @if($comment->note > 0)
                                                    <?php $note = $note + $comment->note; $i++; ?>
                                                @endif
                                            @endforeach
                                            <?php $moyenneNote = $note; ?>
                                            @if($moyenneNote == 0)
                                                <div class="rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <img class="star-size" src="{{ asset('img/star-empty.png') }}" alt="star-empty">
                                                    @endfor
                                                    <span class="price" style="margin-top: 10px; padding-left: 5px;">{{$moyenneNote}}</span>
                                                </div>
                                            @else
                                                <?php $moyenneNote = $note / $i; ?>
                                                <div class="rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= floor($moyenneNote))
                                                            <img class="star-size" data-src="{{ asset('img/star.png') }}" alt="star">
                                                        @else
                                                            <img class="star-size" data-src="{{ asset('img/star-empty.png') }}" alt="star-empty">
                                                        @endif
                                                    @endfor
                                                    <span class="price"><?php echo number_format($moyenneNote,1);?></span>
                                                    
                                                </div>
                                            @endif
                                            <a href="{{action('UsersController@showHouse', $house->id)}}" class="btn btn-principal">Effectuer une réservation</a>
                                        </div>
                                    </div>
                                </div>
                            @endif 
                            @empty 
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <p style="color: #000;">Désolé aucunes annonces ne correspondent à vos critères</p>
                            </div>
                        @endforelse
                    </form>
                </div>                 
            </div>
            <div class="text-right mb-3 mt-3">
                <span><?php echo $houses->appends(array("category_id" => old("category_id"),
                    "start_date" => old('start_date'),
                    "end_date" => old('end_date'),
                    "nb_personnes" => old("nb_personnes") ))
                    ->links(); ?>
                </span>
            </div>  
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script>
        var nb_houses = <?php echo json_encode($nb_houses); ?>;
        console.log(nb_houses);
        if(nb_houses >= 4){
            document.getElementById("footer").className = "footer";
        } else {
            document.getElementById("footer").className = "footer_absolute"; 
        }
    </script>
@endsection