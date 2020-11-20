@extends('layouts.admin')
@section('title', "Détails de l'annonce atypikhouse")
@section('content')
    <div class="card mb-3">
        <div class="card-header">
        <h1 style="font-size:20px;">
            <i class="fas fa-table"></i>
            Annonces de {{$user->prenom}} {{$user->nom}}
        </h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Photo</th>
                    <th>Titre</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th> Actions</th>
                </tr>
                </thead>
                @foreach($houses as $house)
                <tbody>
                    <tr>
                        <td style="width:250px"><img data-src="{{ asset('img/houses/'.$house->photo) }}" class="photo-size"/></td>
                        <td>
                            <p><b>{{$house->title}}</b></p>
                            <p>Note générale</p>
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
                        </td>
                        <td><?php \Date::setLocale('fr'); $startdate = Date::parse($house->start_date)->format('l j F Y'); echo($startdate);?></td>
                        <td><?php \Date::setLocale('fr'); $enddate = Date::parse($house->end_date)->format('l j F Y'); echo($enddate);?></td>
                        <td><a href="{{action('AdminController@showannonces', $house->id)}}" class="btn btn-primary">Voir</a></td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <span>{{ $houses->links() }}</span>
                    </div>
                </div>
            </div>  
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection
