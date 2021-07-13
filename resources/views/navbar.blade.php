<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Logo -->
            <a class="navbar-brand" id="logo" href="{{ url('/') }}">
                <img src="{{ asset('img/Logo.png') }}" alt="logo du site atypikhouse" width="70">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication/Visitors Links -->
                @if (Auth::guest())
                    <li class="link-position"><a href="{{ route('home') }}/#become_hote" id="hote_link" aria-label="Devenir hôtes">Devenir hôte</a></li>                            
                    <li class="link-position"><a href="{{ route('houses') }}" aria-label="Hebergements">Nos hébergements atypikhouse</a></li>
                    <li class="link-position"><a href="{{ route('register') }}" aria-label="Inscription">Inscription</a></li>
                    <li class="link-position"><a href="{{ route('login') }}" aria-label="Connexion">Connexion</a></li>
                @else
                    <li class="link-position"><a href="{{ route('home') }}/#become_hote" id="hote_link" aria-label="Devenir hôtes">Devenir hôte</a></li>
                    <li class="link-position"><a href="{{ route('houses') }}">Nos hébergements atypikhouse</a></li>
                    <li class="dropdown link-position">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <?php
                        $posts = App\Post::orderBy('id', 'desc')->get();
                        $messages = App\Message::orderBy('id', 'desc')->get();
                        $userUnreadNotifications = Auth::user()->unreadNotifications;
                        
                        foreach($userUnreadNotifications as $userUnreadNotification) {
                            $data = $userUnreadNotification->data;
                            foreach($posts as $post){
                                if(isset($data["post_id"])){
                                    if($post->id == $data["post_id"]){
                                        $post["unread"] = true;
                                    }
                                }
                            }
                            foreach($messages as $message){
                                if(isset($data["message_id"])){
                                    if($message->id == $data["message_id"]){
                                        $message["unread"] = true;
                                    }
                                }
                            }
                        }?>
                        <?php 
                            $i = 0;
                            $a = 0;
                            $b = 0;
                            $c = 0;
                        ?>
                        
                        @foreach (Auth::user()->unreadNotifications as $notification)
                            @if($notification->type == "App\Notifications\ReplyToNewAnnonce" && $notification->read_at == null)
                                <?php $a++; ?>
                            @elseif($notification->type == "App\Notifications\ReplyToNewReservation" && $notification->read_at == null)
                                <?php $b++; ?>
                            @elseif($notification->type == "App\Notifications\ReplyToNewReservationAnnulee" && $notification->read_at == null)
                                <?php $c++; ?>
                            @else
                                <?php $i++;?>
                            @endif
                        @endforeach
                        @if($i != 0)
                            <span class="badge badge-pill badge-success">
                                <?php echo $i;?>
                            </span>
                        @endif
                        @if($a != 0)
                            <span class="badge badge-pill badge-success">
                                <?php echo $a;?>
                            </span>
                        @endif
                        @if($b != 0)
                            <span class="badge badge-pill badge-success">
                                <?php echo $b;?>
                            </span>
                        @endif
                        @if($c != 0)
                            <span class="badge badge-pill badge-success">
                                <?php echo $c;?>
                            </span>
                        @endif
                        Mon espace <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('/profile')}}">Mon profil</a></li>

                        <li><a href="{{route('user.messages')}}" id="mynotif">@if($i == 0) Mes notifications @else <span class="badge badge-pill badge-success"><?php echo $i; ?> </span>Mes notifications @endif</a></li>
                        <li><a href="{{route('user.houses')}}">@if($a == 0) Mes annonces @else <span class="badge badge-pill badge-success"><?php echo $a; ?> </span>Mes annonces @endif</a></li>
                        <li><a href="{{route('user.reservations')}}">@if($b == 0) Mes réservations en cours @else <span class="badge badge-pill badge-success"><?php echo $b; ?> </span>Mes réservations en cours @endif</a></li>
                        <li><a href="{{route('user.historiques')}}"> Mes réservations passées </a></li>
                        <li><a href="{{route('user.reservationsannulees')}}">@if($c == 0) Mes réservations annulées @else <span class="badge badge-pill badge-success"><?php echo $c; ?></span> Mes réservations annulées @endif</a></li>
                        <li><a href="{{ url('/house/create_step1') }}">Ajouter une annonce</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                Se déconnecter
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="link-position"><a href="{{ route('user.contact') }}">Contact</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>