
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Atypikhouse Admin - @yield('title')</title>


  <!-- Custom styles for this template-->
  <link href="{{ asset('admin-component/css/sb-admin.css') }}" rel="stylesheet">
  <link href="{{ asset('admin-component/css/custom-admin.css') }}" rel="stylesheet">
  <link href="{{ asset('bootstrap-4.5.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
  

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="{{ route('admin.listusers') }}">Atypikhouse</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <div class="input-group-append">
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li><a class="dropdown-item" style="background-color: #f8f9fa;" href="{{ route('admin.logout') }}">Se déconnecter</a></li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.listusers') }}">
          <i class="fas fa-fw fFa-folder"></i>
          <span>Utilisateurs</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.allannonces') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Annonces</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.categories') }}">
          <i class="fas fa-fw fa-folder"></i>
          <span>Catégories d'annonces</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.allreservations') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Réservations en cours</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.allhistoriques') }}">
          <i class="fas fa-fw fa-folder"></i>
          <span>Réservations passées</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.allreservationscancel') }}">
          <i class="fas fa-fw fa-folder"></i>
          <span>Réservations annulées</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.messages') }}">
          <i class="fas fa-fw fa-folder"></i>
          <span>Messages des clients</span>
        </a>
      </li>
    </ul>
    <div id="content-wrapper">

            <div class="container-fluid">
      
              <!-- Breadcrumbs-->
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="#">Accueil</a>
                </li>
                <li class="breadcrumb-item active">@yield('title')</li>
              </ol>
      
              <!-- Icon Cards-->
              <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                  <a href="{{route('admin.messages')}}" class="admin-messages">
                  <div class="card text-white bg-black o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon">
                        <i class="fas fa-fw fa-comments"></i>
                      </div>
                      <div class="mr-5">
                        <?php $i = 0;?>
                        
                          @foreach (auth()->user()->unreadNotifications as $notification)
                            @if($notification->type == 'App\Notifications\ReplyToMessage' && $notification->read_at == null)
                              <?php $i++; ?>
                            @endif
                            @if($notification->read_at != null)
                              <?php $i = 0; ?>
                            @endif
                          @endforeach
                          @if($i != 0)
                            <span class="badge-pill badge-danger badge-new-message">{{$i}}</span> <span> nouveau(x) message(s) clients</span>
                          @else
                            {{$i}} nouveau(x) message(s) clients
                          @endif
                      </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                      <span class="float-left">View Details</span>
                      <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                      </span>
                    </a>
                  </div>
                </a>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                  <a href="{{route('admin.messages_user')}}" class="admin-messages">
                  <div class="card text-white bg-black o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon">
                        <i class="fas fa-fw fa-list"></i>
                      </div>
                      <div class="mr-5">
                          <?php $j = 0; ?>
                          @foreach (auth()->user()->unreadNotifications as $notification)
                            @if($notification->type == 'App\Notifications\ReplyToUser' && $notification->read_at == null)
                              <?php $j++; ?>
                            @endif
                            @if($notification->read_at != null)
                              <?php $j = 0; ?>
                            @endif
                          @endforeach
                          @if($j != 0)
                            <span class="badge-pill badge-danger badge-new-user">{{$j}}</span> <span> nouveau(x)  client(s)</span>
                          @else
                            {{$j}} nouveau(x) client(s)
                          @endif
                      </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                      <span class="float-left">View Details</span>
                      <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                      </span>
                    </a>
                  </div>
                </a>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                  <a href="{{route('admin.listpostsannonce')}}" class="admin-messages">
                  <div class="card text-white bg-black o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon">
                        <i class="fas fa-fw fa-shopping-cart"></i>
                      </div>
                      <div class="mr-5">
                        <?php $k = 0; ?>
                        @foreach (auth()->user()->unreadNotifications as $notification)
                          @if($notification->type == 'App\Notifications\ReplyToAnnonce' && $notification->read_at == null)
                            <?php $k++; ?>
                          @endif
                          @if($notification->read_at != null)
                            <?php $k = 0; ?>
                          @endif
                        @endforeach
                        @if($k != 0)
                          <span class="badge-pill badge-danger">{{$k}}</span> <span>nouvelle(s) annonce(s) clients</span>
                        @else
                          {{$k}} nouvelle(s) annonce(s) clients
                        @endif
                      </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                      <span class="float-left">View Details</span>
                      <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                      </span>
                    </a>
                  </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                  <a href="{{route('admin.listpostsreservation')}}" class="admin-messages">
                  <div class="card text-white bg-black o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon">
                        <i class="fas fa-fw fa-shopping-cart"></i>
                      </div>
                      <div class="mr-5">
                      <?php $l = 0; ?>
                          @foreach (auth()->user()->unreadNotifications as $notification)
                            @if($notification->type == 'App\Notifications\ReplyToReservation' && $notification->read_at == null)
                              <?php $l++; ?>
                            @endif
                            @if($notification->read_at != null)
                              <?php $l = 0; ?>
                            @endif
                          @endforeach
                          @if($l != 0)
                            <span class="badge-pill badge-danger">{{$l}}</span> <span>nouvelle(s) reservation(s) clients</span>
                          @else
                            {{$l}} nouvelle(s) reservation(s) clients
                          @endif
                      </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                      <span class="float-left">View Details</span>
                      <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="row">
                {{-- <div class="col-xl-3 col-sm-6 mb-3">
                  <a href="{{route('admin.listpostsdemandeannonce_to_delete')}}" class="admin-messages">
                  <div class="card text-white bg-black o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon">
                        <i class="fas fa-fw fa-comments"></i>
                      </div>
                      <div class="mr-5">
                        <?php $a = 0;?>
                        @foreach (auth()->user()->unreadNotifications as $notification)
                          @if($notification->type == 'App\Notifications\ReplyToAnnonceDemandeSuppression' && $notification->read_at == null)
                            <?php $a++; ?>
                          @endif
                          @if($notification->read_at != null)
                            <?php $a = 0; ?>
                          @endif 
                        @endforeach
                        @if($a != 0)
                          <span class="badge-pill badge-danger">{{$a}}</span> <span> demande(s) de suppressions d'annonce(s) par le client</span>
                        @else
                          {{$a}} nouvelle(s) demande(s) de suppression d'annonces par le client
                        @endif
                      </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                      <span class="float-left">View Details</span>
                      <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                      </span>
                    </a>
                  </div>
                </a>
                </div> --}}
                <div class="col-xl-3 col-sm-6 mb-3">
                  <a href="{{route('admin.listpostsannonce_modified')}}" class="admin-messages">
                  <div class="card text-white bg-black o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon">
                        <i class="fas fa-fw fa-comments"></i>
                      </div>
                      <div class="mr-5">
                        <?php $a = 0;?>
                        @foreach (auth()->user()->unreadNotifications as $notification)
                          @if($notification->type == 'App\Notifications\ReplyToAnnonceModification' && $notification->read_at == null)
                            <?php $a++; ?>
                          @endif
                          @if($notification->read_at != null)
                            <?php $a = 0; ?>
                          @endif 
                        @endforeach
                        @if($a != 0)
                          <span class="badge-pill badge-danger">{{$a}}</span> <span> nouvelles annonces modifiées par client</span>
                        @else
                          {{$a}} nouvelle(s) annonce(s) modifiée(s) par clients
                        @endif
                      </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                      <span class="float-left">View Details</span>
                      <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                      </span>
                    </a>
                  </div>
                </a>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                  <a href="{{route('admin.listpostsannonce_deleted')}}" class="admin-messages">
                  <div class="card text-white bg-black o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon">
                        <i class="fas fa-fw fa-list"></i>
                      </div>
                      <div class="mr-5">
                        <?php $b = 0; ?>
                        @foreach (auth()->user()->unreadNotifications as $notification)
                          @if($notification->type == 'App\Notifications\ReplyToAnnonceSuppression' && $notification->read_at == null)
                            <?php $b++; ?>
                          @endif
                          @if($notification->read_at != null)
                            <?php $b = 0; ?>
                          @endif
                        @endforeach
                        @if($b != 0)
                          <span class="badge-pill badge-danger">{{$b}}</span> <span> annonces supprimées par client</span>
                        @else
                          {{$b}} nouvelle(s) annonce(s) supprimées par clients
                        @endif
                    </div>
                  </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                      <span class="float-left">View Details</span>
                      <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                      </span>
                    </a>
                  </div>
                </a>
                </div>
                
                <div class="col-xl-3 col-sm-6 mb-3">
                  <a href="{{route('admin.listpostsreservationannulee')}}" class="admin-messages">
                  <div class="card text-white bg-black o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon">
                        <i class="fas fa-fw fa-shopping-cart"></i>
                      </div>
                      <div class="mr-5">
                        <?php $c = 0; ?>
                        @foreach (auth()->user()->unreadNotifications as $notification)
                          @if($notification->type == 'App\Notifications\ReplyToReservationAnnulation' && $notification->read_at == null)
                            <?php $c++; ?>
                          @endif
                          @if($notification->read_at != null)
                            <?php $c = 0; ?>
                          @endif
                        @endforeach
                        @if($c != 0)
                          <span class="badge-pill badge-danger">{{$c}}</span> <span> reservation(s) annulées par clients</span>
                        @else
                          {{$c}} nouvelle(s) reservation(s) annulée(s) par clients
                        @endif
                    </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                      <i class="fas fa-angle-right"></i>
                    </span>
                  </a>
                  </div>
                </div>
              </div>

        @yield('content')
    </div>
</div>
</div>

 <script src="{{ asset('js/jquery.min.js') }}"></script>
 <script src="{{ asset('bootstrap-4.5.3-dist/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('js/admin.js') }}"></script>
 <script src="{{ asset('js/jquery.unveil.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $("img").unveil();
    });
  </script>
 @yield('script')
</body>
</html>
