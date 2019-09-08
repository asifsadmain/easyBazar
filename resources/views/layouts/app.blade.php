<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EasyBazar') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/455b88d2ea.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    

    <!-- Styles -->
    <link href="{{ asset('css/personal.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body >
    <div>
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="height:15%">
            <div class="container">
                <a class="navbar-brand text-secondary" href="{{ url('/') }}">
                    <font size="8">{{ config('app.name', 'EasyBazar') }}</font>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto">
                        <div class="container box nav-item">       
                            <br>                     
                            <div class="form-group" style="width: 300px;">
                                <input type="text" name="product_name" id="product_name" class="form-control input-lg" placeholder="Search product, brand..." />
                                <div class="dropdown-item" id="productList">
                                </div>
                            </div>
                            {{ csrf_field() }}
                        </div>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="navbar nav-item dropdown">
                                <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Login
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a  class="dropdown-item" href="{{ route('login') }}">{{ __('As User') }}</a>
                                    <a  class="dropdown-item" href="{{ route('dm.login') }}">{{ __('As DeliveryMan') }}</a>
                                </div>
                            </li>
                            @if (Route::has('register'))
                                <li class="navbar nav-item dropdown">
                                    <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Register
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a  class="dropdown-item" href="{{ route('register') }}">{{ __('As User') }}</a>
                                        <a  class="dropdown-item" href="{{ route('dm.register') }}">{{ __('As DeliveryMan') }}</a>
                                    </div>
                                </li>
                            @endif
                        @else
                            <li class="navbar nav-item">
                                <a  href="/postAd" class="nav-link text-secondary font-weight-bold"><i title="Post Ad" class="fas fa-lg fa-plus-circle"></i></a>
                            </li>
                            {{-- <li class="navbar nav-item">
                                <a  href="/notifyDM" class="nav-link text-secondary font-weight-bold"><i title="Notify DeliveryMan" class="fas fa-flag-checkered fa-lg"></i></a>
                            </li> --}}
                            <li class="navbar nav-item dropdown" id="markAsRead" onclick="markNotificationsAsRead()">
                                <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-lg fa-globe-asia"></i><span class="badge">{{ count(Auth::user()->unreadNotifications) }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
                                    @if (count(Auth::user()->unreadNotifications)==0)
                                        <a class="dropdown-item" href="#">There is no new notification for you</a>
                                    @else
                                        @foreach (Auth::user()->unreadNotifications as $notification)
                                        <div @if ($loop->first)
                                            class="hidden"
                                        @else
                                            class="dropdown-divider"
                                        @endif ></div>
                                        <a class="dropdown-item" href="">{{ $notification->data['sender_name']." is interested to buy ". $notification->data['product_name'] }}</a>
                                        @endforeach
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <a href="" data-toggle="modal" data-target="#notificationModalScrollable">See All Notifications</a>
                                </div>
                            </li>
                            <li class="navbar nav-item">
                                <a  href="/conversations" class="nav-link text-secondary font-weight-bold"><i title="Messages" class="far fa-lg fa-envelope"></i></a>
                            </li>
                            <li class="navbar nav-item dropdown">
                                <a  class="nav-link dropdown-toggle font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ URL::to('/userDashboard') }}">My Profile</a>
                                    <a href="{{ URL::to('/userDashboard/activities') }}" class="dropdown-item">My Activities</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @if (Auth::user())
        <div class="modal fade" id="notificationModalScrollable" tabindex="-1" role="dialog" aria-labelledby="notificationModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notificationModalScrollableTitle">Notifications</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach (Auth::user()->notifications as $notification)
                        <div @if ($loop->first)
                            class="hidden"
                        @else
                            class="dropdown-divider"
                        @endif ></div>
                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal">{{ $notification->data['sender_name']." is interested to buy ". $notification->data['product_name'] }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        You are about to sell the product to the selected buyer. Please select any of the two options...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</body>

</html>

<script>
    $(document).ready(function(){
    
        $('#product_name').keyup(function(){ 
            var query = $(this).val();
            if(query != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                url:"{{ route('autocomplete.fetch') }}",
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                $('#productList').fadeIn();  
                        $('#productList').html(data);
                }
                });
            }
        });
    
        $(document).on('click', 'li', function(){  
            $('#product_name').val($(this).text());  
            $('#productList').fadeOut();  
        });  
    
    });
</script>
<script>
    function markNotificationsAsRead() {
        $.get('markAsRead');
    }
</script>
