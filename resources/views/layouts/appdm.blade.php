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
                <a class="navbar-brand text-secondary" href="{{ url('/dm/home') }}">
                    <font size="8">{{ config('app.name', 'EasyBazar') }}</font>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- <!-- Left Side Of Navbar -->
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
                    </ul> --}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if (Auth::guard('dm')->check())
                        <li class="navbar nav-item dropdown" id="markAsRead" onclick="markNotificationsAsRead()">
                            <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (count(Auth::guard('dm')->user()->unreadNotifications))
                                    <i class="fas fa-lg fa-globe-asia"></i><span class="badge badge-danger">{{ count(Auth::guard('dm')->user()->unreadNotifications) }}</span>
                                @else
                                    <i class="fas fa-lg fa-globe-asia"></i><span class="badge">{{ count(Auth::guard('dm')->user()->unreadNotifications) }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
                                @if (count(Auth::guard('dm')->user()->unreadNotifications)==0)
                                    <a class="dropdown-item" href="#">There is no new notification for you</a>
                                @else
                                    @foreach (Auth::guard('dm')->user()->unreadNotifications as $notification)
                                    <div @if ($loop->first)
                                        class="hidden"
                                    @else
                                        class="dropdown-divider"
                                    @endif ></div>
                                    @if ($notification->data['notificationType'] == "NotifyDM")
                                    <a class="dropdown-item" href="/showRoute/{{ $notification->data['order_id'] }}">{{ $notification->data['sender_name']." has requested you near ". $notification->data['sender_address'] }}</a>
                                    @endif
                                    @endforeach
                                @endif
                                <div class="dropdown-divider"></div>
                                <a href="" data-toggle="modal" data-target="#notificationModalScrollable">See All Notifications</a>
                            </div>
                        </li>
                            <li class="navbar nav-item">
                                @if (Auth::guard('dm')->user()->on_duty)
                                    <a  href="/dm/orderStatus" class="nav-link text-secondary font-weight-bold"><i title="Delivery Status" class="fas fa-lg fa-biking" style="color:red;"></i></a>
                                @endif
                            </li>
                            <li class="navbar nav-item dropdown">
                                <a  class="nav-link dropdown-toggle font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('dm')->user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- <a class="dropdown-item" href="{{ URL::to('/userDashboard') }}">My Profile</a>
                                    <a href="{{ URL::to('/userDashboard/activities') }}" class="dropdown-item">My Activities</a> --}}
                                    <a class="dropdown-item" href="{{ route('dm.logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @if (Auth::guard('dm')->user())
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
                        @foreach (Auth::guard('dm')->user()->notifications as $notification)
                        <div @if ($loop->first)
                            class="hidden"
                        @else
                            class="dropdown-divider"
                        @endif ></div>
                        @if ($notification->data['notificationType'] == "NotifyDM")
                        <a class="dropdown-item" href="/showRoute/{{ $notification->data['order_id'] }}">{{ $notification->data['sender_name']." has requested you near ". $notification->data['sender_address'] }}</a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</body>

</html>

<script>
    function markNotificationsAsRead() {
        $.get('markAsRead');
    }
</script>
